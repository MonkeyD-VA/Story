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
        Schema::create('touches', function (Blueprint $table) {
            $table->bigIncrements('touch_id');
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('text_id');
            $table->json('position');
            $table->timestamps();
        });

        // Define foreign key constraint
        Schema::table('touches', function (Blueprint $table) {
            $table->foreign('page_id')->references('page_id')->on('pages')->onDelete('cascade');
            $table->foreign('text_id')->references('text_id')->on('texts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('touches');
    }
};
