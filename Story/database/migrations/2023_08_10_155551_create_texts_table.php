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
        Schema::create('texts', function (Blueprint $table) {
            $table->bigIncrements('text_id');
            $table->text('text_content');
            $table->unsignedBigInteger('audio_id')->nullable();
            $table->string('audio_file')->nullable();
            $table->integer('audio_time')->nullable();
            $table->string('text_type');
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('texts');
    }
};
