<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class HomeController extends Controller
{
    public function index(){

    	$all_publish_product=DB::table('tbl_products')
    					->leftJoin('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    					->leftJoin('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    					->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    					->where('tbl_products.publication_status',1)
    					->limit(6)
    					->get();

    				

    	$manage_publish_product=view('pages.home_content')
    					->with('all_publish_product',$all_publish_product);
    	return view('layout')
    			->with('pages.home_content',$manage_publish_product);
    	//return view('pages.home_content');
    }

    public function show_product_by_category($category_id){
        //echo $category_id;

        $product_by_category=DB::table('tbl_products')
                        ->leftJoin('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        
                        ->select('tbl_products.*','tbl_category.category_name')
                        ->where('tbl_category.category_id',$category_id)
                        ->where('tbl_products.publication_status',1)
                        ->limit(6)
                        ->get();

                    

        $manage_product_category=view('pages.category_by_product')
                        ->with('product_by_category',$product_by_category);
        return view('layouts')
                ->with('pages.category_by_product',$manage_product_category);
    }

    public function show_product_by_manufacture($manufacture_id){
        //echo $manufacture_id;
        $product_by_manufacture=DB::table('tbl_products')
                        
                        ->leftJoin('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                        ->select('tbl_products.*','tbl_manufacture.manufacture_name')
                        ->where('tbl_manufacture.manufacture_id',$manufacture_id)
                        ->where('tbl_products.publication_status',1)
                        ->limit(6)
                        ->get();

                    

        $manage_product_manufacture=view('pages.manufacture_by_product')
                        ->with('product_by_manufacture',$product_by_manufacture);
        return view('layouts')
                ->with('pages.manufacture_by_product',$manage_product_manufacture);
    
            }

    public function product_detailes_by_id($product_id){
        $product_by_details=DB::table('tbl_products')
                        ->leftJoin('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        ->leftJoin('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->where('tbl_products.product_id',$product_id)
                        ->where('tbl_products.publication_status',1)
                        
                        ->first();

                    

        $manage_product_details=view('pages.product_details')
                        ->with('product_by_details',$product_by_details);
        return view('layouts')
                ->with('pages.product_details',$manage_product_details);
    }
}
