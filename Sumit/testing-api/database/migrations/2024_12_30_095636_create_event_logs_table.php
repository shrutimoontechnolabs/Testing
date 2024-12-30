<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_logs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id')->nullable(); // Optional, for logged-in users
            $table->string('event_name'); // Name of the event (e.g., "page_view")
            $table->string('event_label')->nullable(); // Optional label (e.g., "Homepage")
            $table->json('metadata')->nullable(); // JSON field for extra details (e.g., browser info)
            $table->timestamps(); // Created_at and Updated_at fields
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_logs');
    }
};
