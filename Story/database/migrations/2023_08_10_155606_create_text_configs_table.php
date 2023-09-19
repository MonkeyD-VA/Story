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
        Schema::create('text_configs', function (Blueprint $table) {
            $table->unsignedBigInteger('text_id');
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('position');
            $table->string('type');
            $table->timestamps();
        });

        // Define foreign key constraint
        Schema::table('text_configs', function (Blueprint $table) {
            $table->foreign('text_id')->references('text_id')->on('texts')->onDelete('cascade');
            $table->foreign('page_id')->references('page_id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_configs');
    }
};
