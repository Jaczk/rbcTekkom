<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'spec_char',
        'desc'
    ];
    
    public function book()
    {
        return $this->hasMany(Book::class);
    }

    public function theses()
    {
        return $this->hasMany(Thesis::class,'spec_id');
    }

    public function capstone()
    {
        return $this->hasMany(Capstone::class,'spec_id');
    }
}
