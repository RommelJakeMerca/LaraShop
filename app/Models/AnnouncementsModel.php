<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementsModel extends Model
{
    use HasFactory;

    //declaring the table name and fillables
    protected $table = 'announcements';
    protected $fillable = ['announcement_urgency', 'announcement_subject', 'announcement_details', 'announcement_image'];
}
