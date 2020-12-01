<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\model\Category;
use App\Http\Requests\AddProductRequest;
use DB;
use  App\Http\Requests\EditProductRequest;

class ProductController extends Controller
{
    //
    public function getProduct()
    {
        $data['data'] = DB::table('vp_products')->join('vp_category','vp_category.cate_id','=','vp_products.prod_cate')->orderBy('prod_id')->get();
    	return view('backend.product',$data);
    }
    public function getAdd()
    {
    	$data['cate']= Category::all();
    	return view('backend.addproduct',$data);
    }
    public function postAdd(AddProductRequest $request)
    {
    	$product = new Product();
    	$product ->prod_name =  $request->name;
    	$product->prod_slug = str_slug($request->name);
    	$filename = $request->img->getClientOriginalName();
    	$product->prod_img =  $filename;
    	$product->prod_assesories = $request->accessories;
    	$product->prod_warranty = $request->warranty;
    	$product->prod_condition  =  $request->condition;
    	$product->prod_promotion  = $request->promotion;
    	$product->prod_price = $request->price;
    	$product->prod_status = $request->status;
    	$product->prod_featured  =  $request->featured;
    	$product ->prod_description = $request->description;
    	$product->prod_cate = $request->cate;
    	$product ->save();
    	$request->img->StoreAs('product/',$filename);
    	return back()->with('success', 'Thêm Thành Công');
    }
    public function getEditProduct($id)
    {
    	$data['product_list'] = Product::find($id);
        $data['catelist'] = Category::all();
    	return view('backend.editproduct',$data);
    }
    public function postEditProduct(EditProductRequest $request,$id)
    {
        $product =  Product::find($id);
        $product ->prod_name =  $request->name;
        $product->prod_slug = str_slug($request->name);
        $filename = $request->img->getClientOriginalName();
        $product->prod_img =  $filename;
        $product->prod_assesories = $request->accessories;
        $product->prod_warranty = $request->warranty;
        $product->prod_condition  =  $request->condition;
        $product->prod_promotion  = $request->promotion;
        $product->prod_price = $request->price;
        $product->prod_status = $request->status;
        $product->prod_featured  =  $request->featured;
        $product ->prod_description = $request->description;
        $product->prod_cate = $request->cate;
        $product ->save();
        $request->img->StoreAs('product/',$filename);
        return back()->with('success', 'Sửa Thành Công');


    }
    public function getDeleteProduct($id)
    {
        Product::destroy($id);
    	return back()->with('success','Xóa Thành Công');
    }

}
