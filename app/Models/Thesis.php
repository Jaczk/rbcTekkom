<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'thesis_name',
        'author',
        'lecturer_1',
        'lecturer_2',
        'year',
        'abstract',
        'abs_keyword',
        'file_1',
        'file_2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
