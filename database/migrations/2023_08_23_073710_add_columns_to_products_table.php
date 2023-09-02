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
        Schema::table('products', function (Blueprint $table) {
            // Add the new columns
            $table->text('short_desc')->nullable();
            $table->text('shipping_returns')->nullable();

            // Change the description column type to text
            $table->text('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Reverse the changes made in the "up" method
            $table->string('description')->change();
            $table->dropColumn(['short_desc', 'shipping_returns']);
        });
    }
};
