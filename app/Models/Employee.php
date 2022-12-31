<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_receive',
        'user_pay',
        'status',
        'amount',
        'amount_total',
        'percent',
        'month_pay',
        'date_pay',
        'parent_id',
        'created_at',
        'updated_at'
    ];
}
