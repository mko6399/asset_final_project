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
        Schema::create('location', function (Blueprint $table) {
            $table->id('location_site_code');
            $table->string('location_site_name')->nullable();
            $table->timestamps();
        });

        Schema::create('type_of_equipment', function (Blueprint $table) {
            $table->id('type_of_equipment_id');
            $table->string('name_type_of_equipment')->nullable();
            $table->timestamps();
        });

        // Schema::create('location_use', function (Blueprint $table) {
        //     $table->id('location_use_code');
        //     $table->string('location_use_name')->nullable();
        //     $table->timestamps();
        // });

        Schema::create('equipments', function (Blueprint $table) {
            $table->id('equipments_code')->nullable();
            $table->string('item_description_name')->nullable();
            $table->string('status');

            $table->string('asset_number')->nullable();


            $table->date('date_acquired')->nullable();

            $table->string('vendor')->nullable();
            $table->string('acquisition_method')->nullable();
            $table->string('price');
            $table->integer('amount');
            $table->string('additional')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('budget')->nullable();
            $table->string('serial_number')->nullable();
            $table->unsignedBigInteger('location_site_code');
            $table->foreign('location_site_code')
                ->references('location_site_code')
                ->on('location')
                ->onDelete('cascade');
            $table->unsignedBigInteger('type_of_equipment_id'); // Foreign key column
            $table->foreign('type_of_equipment_id')
                ->references('type_of_equipment_id')
                ->on('type_of_equipment')
                ->onDelete('cascade');
            $table->string('location_use_name')->nullable();
            $table->timestamps();
        });
        Schema::create('responsible', function (Blueprint $table) {
            $table->id('responsible_code');
            $table->date('date_of_use')->nullable();
            $table->string('action')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('equipments_code');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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

        Schema::dropIfExists('location');
        Schema::dropIfExists('responsible');
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('type_of_equipment');
    }
};
