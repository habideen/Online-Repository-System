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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('title');
            $table->string('last_name', 30);
            $table->string('first_name', 30);
            $table->string('middle_name', 30)->nullable();
            $table->string('gender', 1); // M / F
            $table->string('awards')->nullable(); //BSc., BTech, B. Edu...
            $table->string('phone_1', 11);
            $table->string('phone_2', 11)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('image_ext', 10)->nullable(); //image extension
            $table->unsignedInteger('department_id');
            $table->string('office_address', 100)->nullable();
            $table->string('account_type', 10); // Student, Lecture, Admin
            $table->string('enabled', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
