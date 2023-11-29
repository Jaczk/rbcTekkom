<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capstone extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'capstone_title',
        'team_name',
        'member1',
        'member2',
        'member3',
        'lecturer_1',
        'lecturer_2',
        'year',
        'c100',
        'c200',
        'c300',
        'c400',
        'c500',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
