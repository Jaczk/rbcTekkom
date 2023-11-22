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
        'stock',
        'spec_id',
        'is_recommended',
        'spec_detail_id',
        'lib_book_code',
        'desc',
        'image',
        'qr_code'
    ];

    public function loan()
    {
        return $this->hasOne(Loan::class, 'book_id');
    }


    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'spec_id');
    }

    public function specDetail()
    {
        return $this->belongsTo(SpecDetail::class, 'spec_detail_id');
    }
}
