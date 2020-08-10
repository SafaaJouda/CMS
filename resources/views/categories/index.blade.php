@extends('layouts.app');

@section('content')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
    @endif
    <div class="clearfix">
        @if(request()->session()->has("success"))
            <div class="alert alert-success text-left ml-3" >
                {{ request()->session()->get("success") }}
                <button type="button" class="close float-left" data-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true" >&times;</span>
                </button>
            </div>
        @endif

        @if(request()->session()->has("error"))
            <div class="alert alert-error text-right">
                {{ request()->session()->get("error") }}
                <button type="button" class="close float-left" data-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <a href="{{route('categories.create')}}" class="btn float-right btn-success"
           style="margin-bottom: 10px ">Add Categories</a>
    </div>
    <div class="card-card-default">
        <div class="card-header" style="background-color: #6cb2eb">All Categories</div>
        <div class="card-body">
            <table class="table">
                @foreach($categories as $category)
                    <tr>
                        <td>
                            {{$category->name}}
                        </td>
                        <td>
                            <form class="float-right ml-3" action="{{route('categories.destroy', $category->id)}}
                                " method="POST" >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>

                            </form>



                            <a href="{{route('categories.edit',$category->id)}}" class="btn-primary float-right btn-sm">Edit</a>
                        </td>

                    </tr>
                    @endforeach
                    </ul>

            {{-- <thead>
             <tr>
                 <th scope="col">#</th>
                 <th scope="col">First</th>
                 <th scope="col">Last</th>
                 <th scope="col">Handle</th>
             </tr>
             </thead>
             <tbody>
             <tr>
                 <th scope="row">1</th>
                 <td>Mark</td>
                 <td>Otto</td>
                 <td>@mdo</td>
             </tr>--}}
        </div>
    </div>
@endsection
