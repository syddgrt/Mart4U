<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['announcement_id','announcement_name','announcement_description'];
    protected $primaryKey = 'announcement_id';
}