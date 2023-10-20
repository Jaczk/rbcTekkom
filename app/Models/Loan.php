<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'return_date',
        'period',
        'is_returned',
        'fine'
    ];

    public function bookLoan()
    {
        return $this->hasMany(BookLoan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
