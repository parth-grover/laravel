<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$categories = categories::with('parent')->get();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = categories::all();
        return view('dashboard.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Categories();
		$category->title = $request->title;
		$category->content = $request->content;
		$filename = sprintf('thumbnail_%s.jpg',random_int(1,1000));
		if($request->hasFile('thumbnail')){
			$filename = $request->file('thumbnail')->storeAs('images',$filename,'public');
		}else{
			$filename = null;
		}
		$category->thumbanil = $filename;
		$category->parent_id = $request->parent_id;
		$save = $category->save();
		if($save){
			return redirect()->route('categories.index');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$categories = categories::with('childrens')->find($id);
        return view('dashboard.categories.show',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$category = categories::find($id);
		$categories = categories::all();
        return view('dashboard.categories.edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = categories::find($id);
		$category->title = $request->title;
		$category->content = $request->content;
		$filename = sprintf('thumbanil_%s.jpg',random_int(1,1000));
		if($request->hasFile('thumbanil'))
			$filename = $request->file('thumbanil')->storeAs('images',$filename,'public');
		else
			$filename = $category->thumbanil;
		$category->thumbanil = $filename;
		$category->parent_id = $request->parent_id;
		$save = $category->save();
		if($save){
			return redirect()->route("categories.index");
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {
        //
    }
}
