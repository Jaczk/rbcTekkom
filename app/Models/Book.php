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
        'spec_detail_code',
        'lib_book_code',
        'year_entry',
        'image'
    ];

    public function bookLoans()
    {
        return $this->hasMany(BookLoan::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function specDetail()
    {
        return $this->belongsTo(SpecDetail::class);
    }

}
