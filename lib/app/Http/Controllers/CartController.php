<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Model\Product;
use Mail;
class CartController extends Controller
{
    //
    public function getadd($id)
    {
    	$product = Product::find($id);
    	Cart::add(['id' => $id, 'name' => $product->prod_name, 'qty' => 1, 'price' =>$product->prod_price, 'options' => ['img' => $product->prod_img]]);
    	return redirect('cart/show');

    }
    public function getShowCart()
    {
    	$item['keys']=Cart::content();
    	$item['total']=Cart::total();
    	return view('frontend.cart',$item);
    }
    public function getdelete($id)
    {
    	if($id=='all')
    	{
    		Cart::destroy();
    		return back();
    	}else

    	{
    		Cart::remove($id);
    			return back();
    	}
    }
    public function getUpdateCart (Request $request)
    {
    	Cart::update($request->rowId, $request->qty);
    }
    public function postShowCart(Request $request)
    {
    	$data['info'] = $request->all();
    	$email =  $request->email;
    	$data['total']=Cart::total();
    	$data['cart']=Cart::content();
    	Mail::send('frontend.email', $data, function ($message) use ($email) {
    	    $message->from('nluat134@gmail.com', 'Nguyễn Văn Luật');
    	
    	
    	    $message->to($email, $email);
    	
    	    $message->cc('luatnguyen165@gmail.com', 'Thiên Vương');
    	
    	    $message->subject('Xác Nhận đơn Hàng');
    	
    	});
    	Cart::destroy();
    	return redirect('complete');
    }
    public function GETcomplete()
    {
    	return view('frontend.complete');
    }
}
