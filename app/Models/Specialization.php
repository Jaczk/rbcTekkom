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
}
