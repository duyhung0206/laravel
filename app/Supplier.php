<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';

    public static function create($data){
        $supplier = new Supplier();
        $supplier->name = $data['name'];
        $supplier->email = $data['email'];
        $supplier->representative = $data['representative'];
        $supplier->phone = $data['phone'];
        $supplier->address = $data['address'];
        $supplier->note = $data['note'];
        $supplier->save();
        return $supplier;
    }
}
