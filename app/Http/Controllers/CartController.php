<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use DB;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
    	$qty=$request->qty;
    	$product_id=$request->product_id;
    	$product_info=DB::table('tbl_products')
    				->where('product_id',$product_id)
    				->first();

    				//echo "<pre>";
    				//print_r($product_info);
    				//echo "</pre>";
    	$data['qty']=$qty;
    	$data['id']=$product_info->product_id;
    	$data['name']=$product_info->product_name;
    	$data['price']=$product_info->price;
    	$data['options']['image']=$product_info->product_image;

    	Cart::add($data);
    	return Redirect::to('/show-cart');
    }

    public function show_cart(){
    	$all_publish_category=DB::table('tbl_category')
    					->where('publication_status',1)
    					->get();

    	$manage_product_category=view('pages.add_to_cart')
                        ->with('all_publish_category',$all_publish_category);
        return view('layouts')
                ->with('pages.add_to_cart',$manage_product_category);
    }

    public function delete_to_cart($rowId){
    	Cart::update($rowId,0);
    	return Redirect::to('/show-cart');
    }

    public function update_cart(Request $request){
    	$qty = $request->qty;
    	$rowId = $request->rowId;
    	Cart::update($rowId,$qty);
    	return Redirect::to('/show-cart');
    	//echo $qty;
    	//echo "<br>";
    	//echo $rowId;
    }
}
