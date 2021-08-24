<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitiesModel extends Model
{
    use HasFactory;

    //declaring the table name and fillables
    protected $table = 'cities';
    protected $fillable = ['region_number', 'province_name', 'city_name'];
}