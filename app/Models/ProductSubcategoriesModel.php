<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcategoriesModel extends Model
{
    use HasFactory;

    //declaring the table name and fillables
    protected $table = 'product_subcategories';
    protected $fillable = ['subcategory_name', 'category_name', 'category_id'];
}
