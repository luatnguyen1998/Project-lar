<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Comment;
class FrontendController extends Controller
{
    //
    public function getHome()
    {
    	$data['featured'] =Product::where('prod_featured',1)->orderBy('prod_id','desc')->take(8)->get();
    	$data['new'] =Product::orderBy('prod_id','desc')->take(8)->get();
    	return view('frontend.home',$data);
    }
    public function getDetail($id)
    {
    	$item['com_list'] = Comment::find($id);
    	$item['product'] = Product::find($id);
    	return view('frontend.details',$item);

    }
    public function getCategory($id)
    {

    	$item['cate_name']= Category::find($id);
    	$item['items'] = Product::where('prod_cate',$id)->orderBy('prod_id','desc')->paginate(8);
    	return view('frontend.category',$item);
    }
    public function postDetail(Request $request,$id)
    {
    	$com = new Comment();
    	$com->com_name =  $request->name;
    	$com->com_email = $request->email;
    	$com->com_content =  $request->content;
    	$com->com_prod =  $id;
    	$com->save();
    	return back();
    }
    public function getSearch(Request $request)
    {
    	$result = $request->result;
    	$data['keword'] = $result;
    	$result = str_replace(' ','%',$result);
    	$data['items'] = Product::where('prod_name','like','%'.$result.'%')->get();

    	return view('frontend.search',$data);
    }
}
