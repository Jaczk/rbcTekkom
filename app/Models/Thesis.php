<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spec_id',
        'thesis_name',
        'author',
        'lec1_id',
        'lec2_id',
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

    public function spec()
    {
        return $this->belongsTo(Specialization::class, 'spec_id');
    }

    public function lec1()
    {
        return $this->belongsTo(Lecturer::class, 'lec1_id');
    }

    public function lec2()
    {
        return $this->belongsTo(Lecturer::class, 'lec2_id');
    }
}
