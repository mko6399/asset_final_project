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
        Schema::create('images_equipment', function (Blueprint $table) {
            $table->id('image_number');
            $table->string('image_path')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('equipments_code'); // Foreign key column
            $table->foreign('equipments_code')
                ->references('equipments_code')
                ->on('equipments')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images_equipment');
    }
};
