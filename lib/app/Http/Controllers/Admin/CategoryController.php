<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
class CategoryController extends Controller
{
    //
    public function getCategory()
    {
    	$data['catelist']= Category::all();
    	return view('backend.category',$data);
    }
     public function postCategory(AddCategoryRequest $request)
    {
    	$category =  new Category();
    	$category->cate_name = $request->name;
    	$category->cate_slug = str_slug($request->name);
    	$category->save();
    	return back();
    }
    public function getEditCategory($id)
    {
    	$data['edit_name']= Category::find($id);
    	return view('backend.editcategory',$data);
    }
    public function postEditCategory(EditCategoryRequest $request,$id)
    {
    	$category = Category::find($id);
    	$category->cate_name = $request->name;
    	$category->cate_slug = str_slug($request->name);
    	$category->save();
    	return back()->with('success', 'Sửa Thành Công');
    }
   
    public function getDeleteCategory($id)
    {
    	Category::destroy($id);
    	return back()->with('notice','Xóa Thành Công');
    }
}
