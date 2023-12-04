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
        Schema::create('resident_company_bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resident_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('resident_order_id');
            $table->timestamp('booking_datetime');

            $table->foreign('resident_id')->references('id')->on('residents');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('resident_order_id')->references('id')->on('resident_orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_company_bookings');
    }
};
