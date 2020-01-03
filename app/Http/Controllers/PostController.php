<?php

namespace App\Http\Controllers;
use App\user;
use App\post;
use App\categories;
use Illuminate\Http\Request;
use Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$posts = Post::with(['categories','user'])->get();
		return view('dashboard.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = categories::all();
		return view('dashboard.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$filename = sprintf('photo_%s.jpg',random_int(1,1000));
		if($request->hasFile('thumbnail')){
			$filename = $request->file('thumbnail')->storeAs('posts',$filename,'public');
		}else{
			$filename = null;
		}
        $posts = [
			'user_id' => 1,
			'title' => $request->title,
			'content' => $request->content,
			'slug' => $request->title,
			'thumbnail' => $filename
		];
		$posts = Post::create($posts);
		if($posts){
			$posts->categories()->attach($request->categories);
			return redirect()->route('posts.index');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['categories','user'])->find($id);
		return view('dashboard.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = categories::all();
		$post = Post::with(['categories','user'])->find($id);
		//Gate::authorize('edit-allowed', $post->user->id);
		$response = Gate::inspect('edit-allowed',$post->user_id);
		if($response->denied()){
			return redirect()->route('posts.index')->with('status',$response->message());
		}
		return view('dashboard.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$post = Post::find($id);
        $filename = sprintf('photo_%s.jpg',random_int(1,1000));
		if($request->hasFile('thumbnail')){
			$filename = $request->file('thumbnail')->storeAs('posts',$filename,'public');
		}else{
			$filename = $post->thumbnail;
		}
		$post->title = $request->title;
		$post->content = $request->content;
		$post->slug = $request->title;
		$post->thumbnail = $filename;
		if($post->save()){
			$post->categories()->sync($request->categories);
			return redirect()->route('posts.index');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
