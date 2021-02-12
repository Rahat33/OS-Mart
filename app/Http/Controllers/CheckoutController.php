<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function login_check(){
    	return view('pages.login');
    }


    public function customer_register(Request $request){
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['mobile_number'] = $request->mobile_number;
    	$data['password'] = md5($request->password);

    	$customer_id = DB::table('tbl_customer')
    			->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);

    	return Redirect::to('/check-out');

    }

    public function check_out(){
    	return view('pages.checkout');
    }

    public function customer_login(Request $request){
    	$customer_email=$request->customer_email;
    	$password=md5($request->password);
    	$result=DB::table('tbl_customer')
    			->where('customer_email',$customer_email)
    			->where('password',$password)
    			->first();
    			if ($result) {
    				Session::put('customer_name',$result->customer_name);
    				Session::put('customer_id',$result->customer_id);
    				return Redirect::to('/check-out');
    			}else{
    				Session::put('messege','Email or password is Invalied');
    				return Redirect::to('/login-check');
    			}
    }


  public function save_shipping(Request $request){
  	$data = array();
  	$data['shipping_email'] = $request->shipping_email;
  	$data['shipping_first_name'] = $request->shipping_first_name;
  	$data['shipping_last_name'] = $request->shipping_last_name;
  	$data['shipping_address'] = $request->shipping_address;
  	$data['shipping_mobile_number'] = $request->shipping_mobile_number;
  	$data['shipping_city'] = $request->shipping_city;

  	$shipping_id = DB::table('tbl_shipping')
  				->insertGetId($data);
  	Session::put('shipping_id',$shipping_id);
  	return Redirect::to('/payment');
  }

  public function payment(){
  	//return view('pages.payment');

  	$all_publish_category=DB::table('tbl_category')
    					->where('publication_status',1)
    					->get();

    	$manage_product_category=view('pages.payment')
                        ->with('all_publish_category',$all_publish_category);
        return view('layouts')
                ->with('pages.payment',$manage_product_category);
  }

  public function order_place(Request $request){
  	$payment_method = $request->payment_method;
  	$pdata = array();
  	$pdata['payment_method']=$payment_method;
  	$pdata['payment_status']='pending';

  	$payment_id=DB::table('tbl_payment')
  			->insertGetId($pdata);

  	$odata = array();
  	$odata['customer_id'] = Session::get('customer_id');
  	$odata['shipping_id'] = Session::get('shipping_id');
  	$odata['payment_id'] = $payment_id;
  	$odata['order_total'] = Cart::total();
  	$odata['order_status'] = 1;
  	$order_id = DB::table('tbl_order')
  			->insertGetId($odata);
  	$contents = Cart::content();
  	$oddata=array();

  	foreach ($contents as $v_content ) {
  		$oddata['order_id']=$order_id;
  		$oddata['product_id']=$v_content->id;
  		$oddata['product_name']=$v_content->name;
  		$oddata['price']=$v_content->price;
  		$oddata['product_sales_quantity']=$v_content->qty;
  		DB::table('tbl_order_detail')
  			->insert($oddata);
  	}

  	

  	if ($payment_method=='handcash') {
  		//return Redirect::to('/payment');
  		Cart::destroy();
  		return view('pages.handcash');

  	}elseif ($payment_method=='paypal') {
  		echo "Paypal";
  	}elseif ($payment_method=='bakash') {
  		echo "Bakash";
  	}
  	//echo $payment_getway;

  	/*$contnt = Cart::content();
  	echo $contnt;*/
  }

  public function manage_order(){
  	
$all_order_info=DB::table('tbl_order')
				->leftJoin('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
				->select('tbl_order.*','tbl_customer.customer_name')
				->get();

			

$manage_order=view('admin.manage_order')
				->with('all_order_info',$all_order_info);
return view('admin_layout')
		->with('admin.manage_order',$manage_order);
  }


  public function show_order($order_id){


  	$order_by_id=DB::table('tbl_order')
				->leftJoin('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
				->leftJoin('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
				->leftJoin('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
				->select('tbl_order.*','tbl_order_detail.*','tbl_customer.*','tbl_shipping.*')
        ->where('tbl_order.order_id',$order_id)
				->get();

			

$view_order=view('admin.view_order')
				->with('order_by_id',$order_by_id);
return view('admin_layout')
		->with('admin.view_order',$view_order);
  }

  public function unactive_order($order_id){
      DB::table('tbl_order')
        ->where('order_id',$order_id)
        ->update(['order_status' => 0]);
        Session::put('message','Unactive Category Cuccessfully......!!!!');
        return Redirect::to('/manage-order');
    }


  public function active_order($order_id){
      DB::table('tbl_order')
        ->where('order_id',$order_id)
        ->update(['order_status' => 1]);
        Session::put('message','Active Order Cuccessfully......!!!!');
        return Redirect::to('/manage-order');
    }


    public function delete_order($order_id){
      DB::table('tbl_order')
        ->where('order_id',$order_id)
        ->delete();
      Session::put('message','Delete successfully....!!');
      return Redirect::to('/manage-order');
    }

  public function customer_logout(){
    	//Session::put('admin_name',null);
    	//Session::put('admin_id',null);
    	Session::flush();
    	return Redirect::to('/');
    }

}
