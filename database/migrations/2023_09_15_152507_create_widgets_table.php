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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->bigInteger('number')->default(0);
            $table->string('more')->nullable();
            $table->string('height')->nullable();
            $table->string('move')->nullable();
            $table->text('description')->nullable();
            $table->string('background',400)->nullable();
            $table->string('slug')->nullable();
            $table->string('background2',400)->nullable();
            $table->bigInteger('count')->nullable();
            $table->tinyInteger('sort')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->boolean('status')->nullable();
            $table->tinyInteger('responsive')->default(0);
            $table->string('brands',400)->nullable();
            $table->string('cats',400)->nullable();
            $table->text('ads1')->nullable();
            $table->text('ads2')->nullable();
            $table->text('ads3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
