<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoriesModel extends Model
{
    use HasFactory;

    //declaring the table name and fillables
    protected $table = 'product_categories';
    protected $fillable = ['category_image', 'category_name'];
}
