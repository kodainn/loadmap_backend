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
        Schema::create('web_notice_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('web_notice_id');
            $table->string('message', 255);
            $table->text('link_url')->nullable();
            $table->timestamps();

            $table->foreign('web_notice_id')->references('id')->on('web_notices')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_notice_messages');
    }
};
