<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    public static function create($data){
        $product = new Product();
        $product->name = $data['name'];
        $product->sku = $data['sku'];
        $product->supplier_id = $data['supplier_id'];
        $product->description = $data['description'];
        $product->save();
        return $product;
    }
}
