<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','cus_id','name','amount'];


    // DISPLAY PRODUCTS TABLE
    public static function show()
    {
    	$data = DB::table('products')->get();
    	return $data;
    }

    // STORE PRODUCT
    public function store_product($request)
    {
    	$data['id'] = $request->input('id');
    	$data['cus_id'] = $request->input('cus_id');
    	$data['name'] = $request->input('name');
    	$data['amount'] = $request->input('amount');

    	DB::table('products')->insert($data);
    }

    // DELETE SPECIFIC PRODUCTS
    public static function destroy($product)
    {
    	DB::delete('delete from products where id=?',[$product->id]);
    }

    
}

