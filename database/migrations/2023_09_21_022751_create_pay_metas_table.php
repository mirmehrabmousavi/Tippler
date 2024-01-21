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
        Schema::create('pay_metas', function (Blueprint $table) {
            $table->id();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('track')->nullable();
            $table->string('guarantee_name')->nullable();
            $table->bigInteger('price')->nullable();
            $table->smallInteger('count');
            $table->smallInteger('status');
            $table->tinyInteger('method')->default(0);
            $table->tinyInteger('deliver')->default(0);
            $table->tinyInteger('discount_off')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('product_id')->nullable()->default(0);
            $table->bigInteger('collect_id')->nullable()->default(0);
            $table->unsignedBigInteger('pay_id');
            $table->foreign('pay_id')->references('id')->on('pays');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_metas');
    }
};
