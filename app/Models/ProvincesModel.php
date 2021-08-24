<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvincesModel extends Model
{
    use HasFactory;

    //declaring the table name and fillables
    protected $table = 'provinces';
    protected $fillable = ['region_number', 'province_name', 'region_id'];
}
