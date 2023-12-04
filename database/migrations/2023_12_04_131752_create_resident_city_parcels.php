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
        Schema::create('resident_city_parcels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resident_id');
            $table->unsignedBigInteger('city_parcel_id');

            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('city_parcel_id')->references('id')->on('city_parcels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_city_parcels');
    }
};
