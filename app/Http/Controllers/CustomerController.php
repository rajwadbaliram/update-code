<?php

namespace App\Http\Controllers;

use App\customer;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

     public function show(customer $customer)
    {

        $customer_list = customer::show();
        return view('customer.customer_list')->with('customer_list',$customer_list);
    }


    public function search(Request $request, customer $customer)
    {

        $res = new customer();
        $customer_list = $res->search($request);
        
         if(count($customer_list)==0)
         {
            session()->flash('found','Customer Not Found');
            return view('index'); 
         }
         else
         {
            return view('customer.customer_list',compact('customer_list'));
         }
    }

    public function Add_customer()
    {
        return view('customer.Add_customer');
    }

    
    public function store_customer(Request $request)
    {

          $request->validate([

            'name'=>'required | min:3',
            'email'=>'required | email',
            'address'=>'required | min:3',
            'mobile'=>'required | min:10 | max:10'
        ]);

         $data = new customer();
         $data->store($request);

        // echo "<pre>";
        //  print_r($save);

        // customer::create([

        //     'name'=>request('name'),
        //     'email'=>request('email'),
        //     'address'=>request('address'),
        //     'mobile'=>request('mobile')
        // ]);
      
        return view('customer.customer_list')->with('customer_list',customer::all());

    }
    
 

    public function destroy(customer $customer)
    {
        // echo "<pre>";
        // print_r($customer);die;
        $res = new customer();
        $res->destroy($customer);

        return view('customer.customer_list')->with('customer_list',customer::all());
    }


      public function print(Request $request,$id)
    {

       $customerdata = DB::table('customers')
                ->select('customers.name','customers.email','customers.address','customers.mobile')
                ->where('customers.id',$id)
                ->get();

        $data = DB::table('customers')
                ->select('products.id','products.name','products.amount')
                ->join('products','customers.id','products.cus_id')
                ->where('customers.id',$id)
                ->get();


        $total = DB::table('products')
                ->where('products.cus_id',$id)
                ->sum('amount');
               // echo $total;die;

        return view('print_invoice',compact('customerdata','data','total'));
    }
}
