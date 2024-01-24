<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $array = [
            'name',
            'title',
            'favicon',
            'logo',
            'email',
            'number',
            'address',
            'about',
            'fanavari',
            'etemad',
            'about',
            'meta_title',
            'meta_keyword',
            'meta_desc',
            'metas',
            'zarinpal',
            'zibal',
            'idpay',
            'nextpay',
            'terminalBeh',
            'userBeh',
            'passwordBeh',
            'keySadad',
            'merchantSadad',
            'terminalSadad',
            'choicePay',
            'cardText',
            'installment',
            'spot',
            'gateway',
            'card',
            'zarinpalStatus',
            'zibalStatus',
            'nextpayStatus',
            'idpayStatus',
            'statusBeh',
            'statusSadad',
            'messageAuth',
            'messageSuccess',
            'messageSuggest',
            'messageCancel',
            'messageBack',
            'messageManager',
            'messageCounseling',
            'userSms',
            'passSms',
            'kaveKey',
            'typeSms',
            'userFaraz',
            'passFaraz',
            'numberFaraz',
        ];
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->text('value')->nullable();
            $table->tinyInteger('social_media')->default(0);
            $table->timestamps();
        });
        foreach ($array as $item) {
            DB::table('settings')->insert(
                array(
                    'key' => $item,
                    'value' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
