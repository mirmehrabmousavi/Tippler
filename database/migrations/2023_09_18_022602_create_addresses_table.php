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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('post' , 10);
            $table->string('name',50);
            $table->string('state' , 50);
            $table->string('city' , 50);
            $table->string('plaque' , 3);
            $table->string('unit' , 3)->nullable();
            $table->string('number',11);
            $table->boolean('status')->default(0);
            $table->boolean('show')->default(1);
            $table->timestamps();
        });
        Schema::create('addressables', function (Blueprint $table) {
            $table->integer('address_id');
            $table->integer('addressables_id');
            $table->string('addressables_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
