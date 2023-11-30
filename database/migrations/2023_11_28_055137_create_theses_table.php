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
        Schema::create('theses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('spec_id');
            $table->string('thesis_name');
            $table->string('author');
            $table->integer('lec1_id');
            $table->integer('lec2_id');
            $table->integer('year');
            $table->text('abstract');
            $table->text('abs_keyword');
            $table->text('file_1');
            $table->text('file_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theses');
    }
};
