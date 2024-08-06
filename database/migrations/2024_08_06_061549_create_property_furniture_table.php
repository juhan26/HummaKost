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
        Schema::create('property_furniture', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('furniture_id');
            $table->foreign('furniture_id')->references('id')->on('furnitures')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_furniture');
    }
};
