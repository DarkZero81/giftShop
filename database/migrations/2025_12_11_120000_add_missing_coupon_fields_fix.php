<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('coupons', function (Blueprint $table) {
        // التحقق من عدم وجود العمود قبل إنشائه
        if (!Schema::hasColumn('coupons', 'max_uses')) {
            $table->integer('max_uses')->nullable();
        }
    });
}
public function down()
{
    Schema::table('coupons', function (Blueprint $table) {
        if (Schema::hasColumn('coupons', 'max_uses')) {
            $table->dropColumn('max_uses');
        }
    });
}

};
