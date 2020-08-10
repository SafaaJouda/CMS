@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="card-card-default">
            <div class="card-header">{{isset($post)? "Update Post" : "Add New Post"}}</div>
            <form action="{{isset($post) ? route('posts.update',$post->id): route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                    <div class="form-group">
                        <label for="post title">Title:</label>
                        <input type="text" name="title"  class="form-control" placeholder="Add New Post"
                               value="{{isset($post)? $post->title: ""}}">
                    </div>
                    <div class="form-group">
                        <label for="post description">Description:</label>
                        <textarea class="form-control" rows="2" name="description">{{isset($post)? $post->description: ""}}</textarea>

                    </div>
                    <div class="form-group">
                        <label for="post content">Content:</label>
                        <textarea class="form-control" rows="2" name="contentt">{{isset($post)? $post->content: ""}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="post image">Post Image</label>
                        <input type="file" name="image"  class="form-control" >
                    </div>
                    @if(isset($post))
                        <div class="form-group">
                            <img src="{{ asset('storage/'. $post->image)}}" style="width: 100%">
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="selectCategory">Select a Category</label>
                        <select name="categoryID" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $post->category_id == $category->id ? 'selected' : '' }} >
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(!$tags->count()<=0)
                        <div class="form-group">
                            <label for="selectTag">Select a Tag</label>
                            <select name="tags[]" class="form-control" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}"
                                            {{--{{ $post->hasTag($tag->id)? 'selected':'' }}--}}

                                        @if($post->hasTag($tag->id))
                                            selected
                                        @endif
                                        >
                                        {{$tag->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group">
                        <button type="submit" class="btn btn-success" >
                            {{ isset($post)? "Update" :"Add"}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


