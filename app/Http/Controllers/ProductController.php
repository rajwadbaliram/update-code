<?php

namespace App\Http\Controllers;

use App\product;
use App\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
   
     public function show(product $product)
    {
        $product_list = product::show();

        return view('product.product_list')->with('product_list',product::all());
    }

    public function store_product(Request $request)
    {
        $data = new product();
        $data->store_product($request);
       
        return view('customer.customer_list')->with('customer_list',customer::all());
    }
   
 

   public function add_product(Product $product,$id)
    {

       $result = customer::find($id);
        return view('product.add_product',compact('result'));
    }

    
    public function destroy(Product $product)
    {
        $res = new product();
        $data = $res->destroy($product);
        //echo $data;die;

        return view('product.product_list')->with('product_list',product::all());
    }
}
