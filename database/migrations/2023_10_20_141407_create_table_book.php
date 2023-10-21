<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('publisher');
            $table->string('author');
            $table->string('isbn_issn');
            $table->enum('condition', ['broken', 'new', 'normal']);
            $table->tinyInteger('is_available')->default(1);
            $table->integer('spec_id');
            $table->integer('spec_detail_id');
            $table->string('lib_book_code');
            $table->integer('year_entry');
            $table->integer('is_reccomended');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_book');
    }
};
