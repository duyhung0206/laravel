<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Mockery\Exception;
use Validator;
use App\Product;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.product', ['products' => $products]);
    }

    public function pagecreate(){
        $suppliers = Supplier::all();
        return view('product.create', ['suppliers' => $suppliers]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'sku' => 'required|unique:product|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('product/pagecreate')
                ->withErrors($validator)
                ->withInput();
        }else{
            $product = Product::create($request->all());
            return redirect('product/listproducts')
                ->with('notify', "Add new product '$product->name' success !")
                ->withInput();
        }
    }

    public function delete($id){
        try{
            $product = Product::find($id);
            $name = $product->name;
            $product->delete();
            return redirect('product/listproducts')
                ->with('notify', "Delete product '$name' success !")
                ->withInput();
        }catch (\Exception $e){
            return redirect('product/listproducts')
                ->with('notify_error', $e->getMessage())
                ->withInput();
        }

    }

    public function pageedit($id){
        try{
            $product = Product::find($id);
            $suppliers = Supplier::all();
            return view('product.edit', ['product' => $product,'suppliers' => $suppliers]);
        }catch (\Exception $e){
            return redirect('product/listproducts')
                ->with('notify_error', $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Request $request){
        try {
            $data = $request->all();
            $productId = $data['product_id'];
            $product = Product::find($productId);

            if ($product->sku == $data['sku']){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'sku' => 'required|unique:product|max:255',
                ]);
            }

            if ($validator->fails()) {
                return redirect('product/pageedit/' . $productId)
                    ->with('validate_error', $validator->messages()->getMessages())
                    ->with('tab_info', 1)
                    ->withInput();
            } else {
                    $product->name = $data['name'];
                $product->sku = $data['sku'];
                $product->supplier_id = $data['supplier_id'];
                $product->description = $data['description'];
                $product->save();
                return redirect('product/pageedit/' . $productId)
                    ->with('notify', "Change info product success !")
                    ->with('tab_info', 1)
                    ->withInput();
            }
        }catch (\Exception $e){
            return redirect('product/pageedit/' . $productId)
            ->with('notify_error', $e->getMessage())
            ->with('tab_info', 1)
            ->withInput();
        }

    }
}
