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
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('position_id');
            $table->unsignedBigInteger('touch_id');
            $table->integer('x');
            $table->integer('y');
            $table->integer('width');
            $table->integer('height');
            $table->integer('screenX')->nullable();
            $table->integer('screenY')->nullable();
            $table->timestamps();
        });

        // Define foreign key constraint
        Schema::table('positions', function (Blueprint $table) {
            $table->foreign('touch_id')->references('touch_id')->on('touches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
