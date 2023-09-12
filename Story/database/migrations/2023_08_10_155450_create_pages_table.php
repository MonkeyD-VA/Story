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
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('page_id');
            $table->integer('page_number');
            $table->unsignedBigInteger('story_id');
            $table->string('image_background');
            $table->timestamps();
        });

        // Define foreign key constraint
        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('story_id')->references('story_id')->on('stories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
