<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CartModel extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $primaryKey = 'id';
    protected $dates = ['updated_at'];
    protected $fillable =
    [   
        'user_id', 
        'product_id',
        'product_name',
        'product_image',
        'product_quantity',
        'product_price',
        'product_current_price',
        'cart_created_at',
        'cart_status'
    ];
}

