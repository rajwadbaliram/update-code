<?php

namespace App;
use DB;
use App\product;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{

  protected $fillable = ['name','email','address','mobile'];

  	// DISPLAY CUSTOMER
	public static function show()
	{
		 $value=DB::table('customers')->get();
    	return $value;
	}

		//STORE CUSTOMER
	public function store($request)
	{
		$data['name'] = $request->input('name');
		$data['email'] = $request->input('email');
		$data['address'] = $request->input('address');
		$data['mobile'] = $request->input('mobile');
		
		DB::table('customers')->insert($data);
	}

	// SEARCH CUSTOMER
	public function search($request)
	{
		 $search = $request->input('search');
		 $customer_list = customer::where('name','like','%'.$search.'%')->get();

		 return $customer_list;
	}

	// DELETE CUSTOMER 
	public static function destroy($customer)
	{
		DB::delete('delete from customers where id=?',[$customer->id]);
		DB::delete('delete from products where cus_id = ?',[$customer->id]);
	}

}
