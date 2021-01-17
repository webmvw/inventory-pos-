<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function view(){
    	$allCategorys = Category::latest()->get();
    	return view('admin.pages.category.view-category', compact('allCategorys'));
    }

    public function add(){
    	return view('admin.pages.category.add-category');
    }

    public function store(Request $request){
    	$category = new Category;
    	$category->name = $request->name;
    	$category->created_by = Auth::user()->id;
    	$category->save();
    	return redirect()->route('categorys.view')->with("success", "Category Added Successfully!!");
    }


    public function edit($id){
    	$getCategory = Category::find($id);
    	return view('admin.pages.category.edit-category', compact('getCategory'));
    }

    public function update(Request $request, $id){
    	$getCategory = Category::find($id);
    	$getCategory->name = $request->name;
    	$getCategory->updated_by = Auth::user()->id;
    	$getCategory->save();
    	return redirect()->route('categorys.view')->with("info", "Category updated Successfully!!");
    }

    public function delete($id){
    	$getCategory = Category::find($id);
    	$getCategory->delete();
    	return redirect()->route('categorys.view')->with("info", "Category deleted Successfully!!");
    }
}
