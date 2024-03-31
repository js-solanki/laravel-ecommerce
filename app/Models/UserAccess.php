<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $table = 'user_access';

    protected $fillable = ['user_id', 'role_id']; 
}
