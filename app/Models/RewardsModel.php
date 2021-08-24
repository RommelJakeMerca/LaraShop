<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardsModel extends Model
{
    use HasFactory;
    
    protected $table = 'rewards_models';
    protected $dates =
    [
        'original_date',
        'expiration_date'
    ];

    public function clientUser() 
    {
        return $this->belongsTo('App\Models\ClientUser', 'user_id', 'id');
    }
}
