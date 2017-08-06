<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Exception;
use Validator;
use App\Supplier;
use Illuminate\Support\Facades\View;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.supplier', ['suppliers' => $suppliers]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('supplier/pagecreate')
                ->withErrors($validator)
                ->withInput();
        }else{
            $supplier = Supplier::create($request->all());
            return redirect('supplier/listsuppliers')
                ->with('notify', "Add new supplier '$supplier->name' success !")
                ->withInput();
        }
    }

    public function delete($id){
        try{
            $supplier = Supplier::find($id);
            $name = $supplier->name;
            $supplier->delete();
            return redirect('supplier/listsuppliers')
                ->with('notify', "Delete supplier '$name' success !")
                ->withInput();
        }catch (\Exception $e){
            return redirect('supplier/listsuppliers')
                ->with('notify_error', $e->getMessage())
                ->withInput();
        }

    }

    public function pageedit($id){
        try{
            $supplier = Supplier::find($id);
            return view('supplier.edit', ['supplier' => $supplier]);
        }catch (\Exception $e){
            return redirect('supplier/listsuppliers')
                ->with('notify_error', $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        $data = $request->all();
        $supplierId = $data['supplier_id'];
        if ($validator->fails()) {
            return redirect('supplier/pageedit/'.$supplierId)
                ->with('validate_error', $validator->messages()->getMessages())
                ->with('tab_info', 1)
                ->withInput();
        }else{
            $supplier = Supplier::find($supplierId);
            $supplier->name = $data['name'];
            $supplier->email = $data['email'];
            $supplier->representative = $data['representative'];
            $supplier->phone = $data['phone'];
            $supplier->address = $data['address'];
            $supplier->note = $data['note'];
            $supplier->save();
            return redirect('supplier/pageedit/'.$supplierId)
                ->with('notify', "Change info supplier success !")
                ->with('tab_info', 1)
                ->withInput();
        }
    }
}
