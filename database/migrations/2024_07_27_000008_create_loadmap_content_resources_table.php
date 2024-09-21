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
        Schema::create('loadmap_content_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loadmap_content_id');
            $table->string('title', 255);
            $table->text('link_url');
            $table->text('image_path')->nullable();
            $table->string('alt', 255)->nullable();
            $table->timestamps();

            $table->foreign('loadmap_content_id')->references('id')->on('loadmap_contents')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loadmap_content_resources');
    }
};
