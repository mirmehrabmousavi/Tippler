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
        Schema::create('lotteries', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id' , 10)->default(0);
            $table->text('body')->nullable();
            $table->boolean('status')->default(0);
            $table->string('title')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('round')->nullable();
            $table->string('link')->nullable();
            $table->bigInteger('user_id')->default(0)->nullable();
            $table->string('code',25)->nullable();
            $table->string('product_id' , 10)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotteries');
    }
};
