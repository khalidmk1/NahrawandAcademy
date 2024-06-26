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
        Schema::create('short_cours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('host_id');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('image_flex')->nullable();
            $table->text('description')->nullable();
            $table->string('video')->nullable();
            $table->text('tags')->nullable();
            $table->softDeletes();
            $table->foreign('host_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_cours');
    }
};
