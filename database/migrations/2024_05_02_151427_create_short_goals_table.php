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
        Schema::create('short_goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cour_id');
            $table->unsignedBigInteger('goal_id');
            $table->foreign('cour_id')->references('id')->on('short_cours')->onDelete('cascade');
            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_goals');
    }
};
