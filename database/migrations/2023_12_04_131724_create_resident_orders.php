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
        Schema::create('resident_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('resident_id');
            $table->integer('budget');
            $table->timestamp('valid_till');
            $table->timestamp('reset_date');
            $table->timestamp('deactivated_date')->nullable();

            $table->foreign('resident_id')->references('id')->on('residents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_orders');
    }
};
