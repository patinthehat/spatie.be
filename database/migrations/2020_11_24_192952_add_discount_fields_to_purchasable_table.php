<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('purchasables', function (Blueprint $table) {
            $table->string('discount_name')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->timestamp('discount_starts_at')->nullable();
            $table->timestamp('discount_expires_at')->nullable();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('coupon_code');
            $table->dropColumn('coupon_percentage');
            $table->dropColumn('coupon_valid_from');
            $table->dropColumn('coupon_expires_at');
            $table->dropColumn('coupon_label');
        });
    }
};
