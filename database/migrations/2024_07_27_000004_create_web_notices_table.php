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
        Schema::create('web_notices', function (Blueprint $table) {
            $table->id();
            $table->timestamp('last_read_datetime');
            $table->unsignedBigInteger('received_user_id');
            $table->timestamps();

            $table->foreign('received_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_notices');
    }
};
