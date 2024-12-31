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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('from_id')->nullable(); // Sender's ID
            $table->unsignedBigInteger('to_id'); // Recipient's ID
            $table->string('title'); // Notification title
            $table->text('message'); // Notification message
            $table->text('description')->nullable(); // Optional detailed description
            $table->timestamps(); // Created at and Updated at timestamps

            // Define foreign key constraints if needed
            $table->foreign('from_id')->references('id' )->on('users')->onDelete('set null');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
