<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'book_name',
        'publisher',
        'author',
        'isbn_issn',
        'condition',
        'is_available',
        'spec_id',
        'is_recommended',
        'spec_detail_id',
        'lib_book_code',
        'year_entry',
        'desc',
        'image'
    ];

    public function loan()
    {
        return $this->hasMany(Loan::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'spec_id');
    }

    public function specDetail()
    {
        return $this->belongsTo(SpecDetail::class);
    }

}
