<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    //declaring the table name and fillables
    protected $table = 'beneficiary_info';
    protected $fillable = ['user_id', 'name_of_beneficiary', 'relationship', 'email', 
    'phone_number', 'region_chosen', 'province', 'city', 'selected_store', 
    'selected_branch', 'time_of_pickup'];
}
