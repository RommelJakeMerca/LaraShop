<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreBranchesModel extends Model
{
    use HasFactory;

    //declaring the table name and fillables
    protected $table = 'store_branches';
    protected $fillable = ['region_id', 'province_id', 'city_id', 'region_number', 'province_under', 'city_under', 'branch_name', 'branch_address'];
}
