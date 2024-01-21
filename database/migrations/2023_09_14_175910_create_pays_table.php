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
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->string('refId' , 20)->nullable();
            $table->bigInteger('price');
            $table->bigInteger('deposit')->nullable();
            $table->string('auth' , 36)->nullable();
            $table->boolean('status');
            $table->string('time',300)->nullable();
            $table->tinyInteger('back')->default(0);
            $table->tinyInteger('method')->default(0);
            $table->tinyInteger('deliver')->default(0);
            $table->string('carrier' , 10);
            $table->bigInteger('carrier_price');
            $table->string('track')->nullable();
            $table->string('discount_off' , 3)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('property', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
