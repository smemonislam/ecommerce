<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_name',
        'warehouse_address',
        'warehouse_phone'
    ];

    public static function arrayForSelect() 
    {
    	$arr = [];
    	$warehouses = Warehouse::all();
        foreach ($warehouses as $warehouse) {
            $arr[$warehouse->id] = $warehouse->warehouse_name;
        } 

        return $arr;
    }
}
