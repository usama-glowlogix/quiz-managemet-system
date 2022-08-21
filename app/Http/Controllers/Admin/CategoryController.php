<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Session;
class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::orderby('created_at','ASC')->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $validator = Validator::make($data, [
            'title' => 'required', 'string', 'max:255',
            'status'=> 'required',
            ]);
        if($validator->fails()){
            return response()->json(['failed' => $validator->errors()]);
        }
        $category = Category::create($data);
        if ($category){
            return redirect('/index');
        }
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
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->all();
        $validator = Validator::make($data, [
            'title' => 'required', 'string', 'max:255',
            'status'=> 'required',
            ]);
        if($validator->fails()){
            return response()->json(['failed' => $validator->errors()]);
        }
        $category = Category::updateOrCreate(['id' => $request->id], $data);
        if($category)
        {
        Session::flash('alert-success', 'Category updated successfully');
        return redirect('/admin/categories');
        }
    }
    public function destroy($id)
    {
        $new = Category::findOrFail($id);
        $new->delete();
        Session::flash('alert-success', 'new deleted successfully');
        return redirect('/admin/categories');
    }

}
