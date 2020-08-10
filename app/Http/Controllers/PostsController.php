<?php

namespace App\Http\Controllers;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Category;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('checkCategory')->only('create');
}
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
       $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->contentt,
            'image' =>$request->image->store('images','public'),
            'category_id'=>$request->categoryID
        ]);
        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }

        session()->flash("success", "Post created successfully");
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories= Category::all();
        $tags= Tag::all();
        return view('posts.create')->with(['post'=>$post,'categories'=>$categories,'tags'=>$tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','description','content','category_id']);

        if($request->hasFile('image')){
            $image=$request->image->store('images','public');
            Storage::disk('public')->delete($post->image);
            $data['image']=$image;
        }
        $post->update($data);
        session()->flash("success", "Post updated successfully");
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::withTrashed()->where('id',$id)->first();
        if($post->trashed()){
            $post->forceDelete();
            Storage::delete($post->image);
            session()->flash("success", "Post deleted successfully");
        }
        else {
            $post->delete();
            session()->flash("success", "Post trashed successfully");
        }

        return redirect(route('posts.index'));

    }
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view ('posts.index')->withPosts($trashed);
    }
    public function restore($id){
        Post::withTrashed()->where('id',$id)->restore();
        session()->flash("success", "Post restored successfully");
        return redirect()->route('posts.index');
    }

}
