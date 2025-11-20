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
        Schema::create('vaccination_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('User ID:belong to users table');
            $table->string('name')->nullable();
            $table->enum('type', ['Childhood', 'Adult', 'Travel', 'Booster', 'Unknown'])->nullable();
            $table->string('primary_dose_date')->nullable();
            $table->enum('status', ['Completed', 'Missed'])->nullable();
            $table->string('hospital')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccination_trackings');
    }
};
