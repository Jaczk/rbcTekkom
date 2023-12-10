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
        Schema::create('capstones', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('spec_id');
            $table->string('capstone_title');
            $table->string('team_name');
            $table->text('summary');
            $table->integer('member1_id');
            $table->integer('member2_id');
            $table->integer('member3_id');
            $table->integer('lec1_id');
            $table->integer('lec2_id');
            $table->integer('year');
            $table->string('c100');
            $table->string('c200');
            $table->string('c300');
            $table->string('c400');
            $table->string('c500');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capstones');
    }
};
