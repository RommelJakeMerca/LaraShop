<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionsModel extends Model
{
    use HasFactory;

    //declaring the table name and fillables
    protected $table = 'regions';
    protected $fillable = ['region_number', 'region_name'];
}
