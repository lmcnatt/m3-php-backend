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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student1_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('student2_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('coach_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('notes');
            $table->string('dance_style');
            $table->date('lesson_date');
            $table->string('video')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
