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
        Schema::create('inouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // foreign key to users table
            $table->date('date'); // date of clock-in/out
            $table->string('day'); // day of the week
            $table->time('in_time')->nullable(); // clock-in time
            $table->time('out_time')->nullable(); // clock-out time
            $table->decimal('hours', 5, 2)->nullable(); // hours worked
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inouts');
    }
};
