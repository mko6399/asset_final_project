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


        Schema::create('agency', function (Blueprint $table) {
            $table->id('agency_id');
            $table->string('name_agency')->nullable();
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('prefix');
            $table->string('name');
            $table->string('last_name');
            $table->string('position')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->unsignedBigInteger('agency_id')->nullable(); // Foreign key column
            $table->foreign('agency_id')
                ->references('agency_id')
                ->on('agency')
                ->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('agency');
    }
};
