<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Exception;
use Validator;
use App\Customer;
use Illuminate\Support\Facades\View;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customer.customer', ['customers' => $customers]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('customer/pagecreate')
                ->withErrors($validator)
                ->withInput();
        }else{
            $customer = Customer::create($request->all());
            return redirect('customer/listcustomers')
                ->with('notify', "Add new customer '$customer->name' success !")
                ->withInput();
        }
    }

    public function delete($id){
        try{
            $customer = Customer::find($id);
            $name = $customer->name;
            $customer->delete();
            return redirect('customer/listcustomers')
                ->with('notify', "Delete customer '$name' success !")
                ->withInput();
        }catch (\Exception $e){
            return redirect('customer/listcustomers')
                ->with('notify_error', $e->getMessage())
                ->withInput();
        }

    }

    public function pageedit($id){
        try{
            $customer = Customer::find($id);
            return view('customer.edit', ['customer' => $customer]);
        }catch (\Exception $e){
            return redirect('customer/listcustomers')
                ->with('notify_error', $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        $data = $request->all();
        $customerId = $data['customer_id'];
        if ($validator->fails()) {
            return redirect('customer/pageedit/'.$customerId)
                ->with('validate_error', $validator->messages()->getMessages())
                ->with('tab_info', 1)
                ->withInput();
        }else{
            $customer = Customer::find($customerId);
            $customer->name = $data['name'];
            $customer->email = $data['email'];
            $customer->phone = $data['phone'];
            $customer->address = $data['address'];
            $customer->note = $data['note'];
            $customer->save();
            return redirect('customer/pageedit/'.$customerId)
                ->with('notify', "Change info customer success !")
                ->with('tab_info', 1)
                ->withInput();
        }
    }
}
