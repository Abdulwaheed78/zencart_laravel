<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add the new related_products column
            $table->text('related_products')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Reverse the changes made in the "up" method
            $table->dropColumn('related_products');
        });
    }
};
