<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientOrderModel extends Model
{
    use HasFactory;
    //declaring the table name and fillables
    protected $table = 'orders';
    protected $fillable = ['client_id', 'mode_of_payment', 'total_payment', 'total_payment', 'status', 'product_ids'];

    protected $casts = [
        'product_ids' => 'array'
    ];
}
