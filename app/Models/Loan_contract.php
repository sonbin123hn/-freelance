<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan_contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        "loanValue",
        "loanTime",
        "signature",
        "prive",
        "userId",
        "status",
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
