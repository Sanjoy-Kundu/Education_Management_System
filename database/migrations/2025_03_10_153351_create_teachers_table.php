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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('qualification')->nullable(); // Qualification (e.g., SSC, HSC, BSc, MSc, PhD)
            $table->string('institution')->nullable();   // Institution (e.g., XYZ High School ....)
            $table->integer('duration')->nullable();     // Duration (e.g., 2 years)
            $table->year('year_of_graduation')->nullable(); // Year of Graduation (e.g., 2020)
            $table->decimal('result')->nullable(); // Result (e.g., 3.4 out of 5)
            $table->integer('experience')->nullable(); // Years of experience
            $table->string('subject')->nullable();    // Subject taught (e.g., Math, Science)
            $table->date('joining_date');              // Date the teacher joined
            $table->decimal('salary')->nullable(); // Teacher's salary
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('profile_picture')->nullable(); // Profile picture
            $table->string('cv')->nullable(); // CV file
            $table->string('id_card')->nullable()->unique(); // ID card
            $table->string('passport')->nullable()->unique(); // Passport
            $table->string('bank_account')->nullable()->unique(); // Bank account
            $table->string('tin')->nullable()->unique(); // Tax identification number
            $table->string('nid')->nullable()->unique(); // National ID number
            $table->string('driving_license')->nullable()->unique(); // Driving license
            $table->longText('description')->nullable(); // Passport issuing country
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
