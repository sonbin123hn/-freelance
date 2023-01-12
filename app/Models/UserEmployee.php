<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        "userId",
        "employeeId",
        'created_at',
        'updated_at'
    ];
}
