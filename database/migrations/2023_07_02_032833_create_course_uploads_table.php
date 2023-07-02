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
        Schema::create('course_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_info_id');
            $table->uuid('user_id');
            $table->string('material_information', 5000);
            $table->string('materials_link', 5000)->nullable(); //drive_link: documents must be uploaded to an online drive.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_uploads');
    }
};
