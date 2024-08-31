<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('feedbacks', function (Blueprint $table) {
        $table->id();
        $table->text('message');
        $table->integer('rating');
        $table->foreignId('lease_id')->constrained();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('user_name')->default('Anonymous');
        $table->string('user_image')->default('/assets/img/image_not_available.png');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
