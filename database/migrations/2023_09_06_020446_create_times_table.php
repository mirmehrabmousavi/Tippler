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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->smallInteger('day');
            $table->smallInteger('from');
            $table->smallInteger('to');
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
        Schema::create('timables', function (Blueprint $table) {
            $table->integer('time_id');
            $table->integer('timables_id');
            $table->string('timables_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};
