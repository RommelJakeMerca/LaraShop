<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;
    //declaring the table name and fillables
    protected $table = 'products';
    protected $fillable = ['product_image', 'category_name', 'subcategory_name', 'product_name', 'category_id'
    , 'subcategory_id', 'product_description', 'product_price', 'stocks'];
}
