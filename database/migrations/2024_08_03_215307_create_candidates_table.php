<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('student_id'); // Foreign key to users table
            $table->foreignId('position_id')->constrained()->onDelete('cascade'); // Foreign key to positions table
            $table->integer('votes')->default(0);
            $table->string('image')->nullable(); // New column for storing image path
            $table->timestamps();

            // Foreign key constraint for student_id
            $table->foreign('student_id')->references('student_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['student_id']);
            $table->dropForeign(['position_id']);
        });

        Schema::dropIfExists('candidates');
    }
};
