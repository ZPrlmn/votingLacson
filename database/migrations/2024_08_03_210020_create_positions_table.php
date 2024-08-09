<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // This column should be 'name'
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            // Drop the 'name' column if rolling back
            $table->dropColumn('name');
        });
    }
};
