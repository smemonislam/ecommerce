<?php

namespace App\Models\Admin;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_point_name',
        'pickup_point_address',
        'pickup_point_phone',
        'pickup_point_phone_two'
    ];

    public function product(){
        return $this->hasOne(Product::class);
    }
}
