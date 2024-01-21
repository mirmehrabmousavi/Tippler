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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en');
            $table->string('slug');
            $table->string('weight' , 10)->nullable();
            $table->smallInteger('type')->default(0);
            $table->bigInteger('variety')->default(0);
            $table->string('off' , 3)->nullable();
            $table->bigInteger('price');
            $table->bigInteger('offPrice');
            $table->bigInteger('prePrice')->nullable();
            $table->string('product_id' , 15)->nullable();
            $table->string('currency_id' , 15)->default(0);
            $table->string('user_id' , 10)->default(1);
            $table->smallInteger('count');
            $table->string('score',50)->nullable();
            $table->smallInteger('maxCart')->nullable();
            $table->text('image3d')->nullable();
            $table->integer('imageCount3d')->nullable();
            $table->integer('imageFirstCount')->nullable();
            $table->string('letterLottery',3)->nullable();
            $table->smallInteger('numLottery1')->nullable();
            $table->smallInteger('numLottery2')->nullable();
            $table->string('prepare',50)->nullable();
            $table->string('suggest',50)->nullable();
            $table->string('note',100)->nullable();
            $table->boolean('showcase')->default(0);
            $table->boolean('original')->default(0);
            $table->boolean('used')->default(0);
            $table->boolean('lotteryStatus')->default(0);
            $table->boolean('inquiry')->default(0);
            $table->boolean('prebuy')->default(0);
            $table->text('image');
            $table->text('short')->nullable();
            $table->text('body')->nullable();
            $table->text('rate')->nullable();
            $table->text('specifications')->nullable();
            $table->text('ability')->nullable();
            $table->text('colors')->nullable();
            $table->text('size')->nullable();
            $table->string('alt_image')->nullable();
            $table->tinyInteger('publish')->default(0);
            $table->longText('meta_title')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_desc')->nullable();
            $table->bigInteger('views')->unsigned()->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
