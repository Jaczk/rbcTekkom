<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capstone extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'spec_id',
        'capstone_title',
        'team_name',
        'summary',
        'member1_id',
        'member2_id',
        'member3_id',
        'lec1_id',
        'lec2_id',
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

    public function member1()
    {
        return $this->belongsTo(User::class, 'member1_id');
    }

    public function member2()
    {
        return $this->belongsTo(User::class, 'member2_id');
    }

    public function member3()
    {
        return $this->belongsTo(User::class, 'member3_id');
    }
}
