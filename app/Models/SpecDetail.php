<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'spec_detail_id',
        'desc'
    ];
    
    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
