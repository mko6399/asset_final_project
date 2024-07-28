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
        Schema::create('durable_articles', function (Blueprint $table) {
            $table->id('durable_articles_id'); // ใช้ `id` แทน `bigIncrements`
            $table->string('name_durable_articles');
            $table->foreignId('users')->constrained('users', 'id');
            $table->foreignId('location_id')->constrained('location', 'location_id');
            $table->foreignId('type_of_equipment_id')->constrained('type_of_equipment', 'type_of_equipment_id');
            $table->string('status_d_a');
            $table->string('additional');
            $table->string('usage_in');
            $table->timestamp('status_modification_date')->nullable();
            $table->string('budget');
            $table->integer('reference_number')->nullable();
            $table->integer('amount');
            $table->timestamp('date_received')->nullable();
            $table->string('serial_number');
            $table->string('seller');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('durable_articles');
    }
};
