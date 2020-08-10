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
        <a href="{{route('tags.create')}}" class="btn float-right btn-success"
           style="margin-bottom: 10px ">Add Tags</a>
    </div>
    <div class="card-card-default">
        <div class="card-header" style="background-color: #6cb2eb">All Tags</div>
        <div class="card-body">
            <table class="table">
                @foreach($tags as $tag)
                    <tr>
                        <td>
                            {{$tag->name}}
                            <button type="button" class="btn btn-primary">
                                Posts <span class="badge badge-primary align-center">{{$tag->posts->count()}}</span>
                                <span class="sr-only  ">unread messages</span>
                            </button>
                        </td>


                        <td>
                            <form class="float-right ml-3" action="{{route('tags.destroy', $tag->id)}}
                                " method="POST" >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>

                            </form>



                            <a href="{{route('tags.edit',$tag->id)}}" class="btn-primary float-right btn-sm">Edit</a>
                        </td>

                    </tr>
                    @endforeach
                    </ul>


        </div>
    </div>
@endsection
