<?php

namespace App\Models;

use App\Models\Thesis;
use App\Models\Capstone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nip',
        'image',
    ];

    public function theses1()
    {
        return $this->hasMany(Thesis::class, 'lec1_id');
    }

    public function theses2()
    {
        return $this->hasMany(Thesis::class, 'lec2_id');
    }

    public function capstone1()
    {
        return $this->hasMany(Capstone::class, 'lec1_id');
    }

    public function capstone2()
    {
        return $this->hasMany(Capstone::class, 'lec2_id');
    }
}
