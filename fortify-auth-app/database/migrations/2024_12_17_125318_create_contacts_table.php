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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('fname');             // First Name
            $table->string('lname');             // Last Name
            $table->string('contact')->unique(); // Primary Contact (unique to avoid duplicates)
            $table->string('secondary_contact')->nullable(); // Secondary Contact (nullable)
            $table->string('email')->unique();   // Email
            $table->date('dob');                 // Date of Birth
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
