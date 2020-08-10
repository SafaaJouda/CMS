@extends('layouts.app');



@section('content')
    <div class="clearfix" xmlns="http://www.w3.org/1999/html">
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
        <a href="{{route('posts.create')}}" class="btn float-right btn-success"
           style="margin-bottom: 10px ">Add Post</a>
    </div>
    <div class="card-card-default">
        <div class="card-header" style="background-color: #6cb2eb">All Posts</div>
        @if($posts->count() > 0)
            <table class="card-body">
                <table class="table">
                    <thead >
                    <tr>
                        <th>Image</th>
                        <th>Tilte</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src=" {{asset('storage/'.$post->image)}}" alt="" width="50px" height="50px">

                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>
                                <form class="float-right ml-3" action="{{route('posts.destroy', $post->id)}}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm align-right">{{($post->trashed()? "Delete":"Trash")}}</button>

                                </form>

                                @if(!$post->trashed())
                                    <a href="{{route('posts.edit',$post->id)}}"
                                       class="btn-primary float-right btn-sm align-right">Edit
                                    </a>
                                @else
                                    <a href="{{route('trashed.restore',$post->id)}}"
                                       class="btn-primary float-right btn-sm align-right">Restore
                                    </a>
                                @endif

                            </td>

                        </tr>
                    @endforeach

                    </tbody>


                    @else
                        <div class="card-body"></div>
                        <h1 class="text-center">No Posts Yet ...</h1>
                    @endif
                </table>
            </table>
    </div>
@endsection
