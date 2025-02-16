<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('referrers', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('uuid');
            $table->integer('discount_percentage')->nullable();
            $table->timestamp('discount_period_ends_at')->nullable();
            $table->timestamps();
        });

        Schema::create('referrer_purchasable', function (Blueprint $table) {
            $table->foreignId('referrer_id')->constrained();
            $table->foreignId('purchasable_id')->constrained();
            $table->timestamps();
        });

        Schema::create('referrer_purchases', function (Blueprint $table) {
            $table->foreignId('referrer_id')->constrained();
            $table->foreignId('purchase_id')->constrained();
            $table->timestamps();
        });
    }
};
