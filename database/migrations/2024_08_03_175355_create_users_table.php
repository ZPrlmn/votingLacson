<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('student_id')->unique(); // Student ID as a string
            $table->string('first_name');
            $table->string('last_name');
            $table->string('course');
            $table->integer('year');
            $table->boolean('has_voted');
            $table->timestamps();

            // Set 'student_id' as the primary key
            $table->primary('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
