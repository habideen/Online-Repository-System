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
        Schema::create('course_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('course_info_id')->autoIncrement();
            $table->string('course_code', 10);
            $table->string('session', 9);
            $table->string('introduction', 1000)->nullable();
            $table->string('grading_information', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_infos');
    }
};
