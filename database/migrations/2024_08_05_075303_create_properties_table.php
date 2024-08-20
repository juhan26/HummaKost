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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->decimal('rental_price', 10, 2);
            $table->text('description');
            $table->text('address');
            $table->integer('capacity');
            $table->enum('gender_target',['male','female']);
            $table->decimal('langtitude', 10, 8);
            $table->decimal('longtitude', 11, 8);
            $table->enum('status',['available','full']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};