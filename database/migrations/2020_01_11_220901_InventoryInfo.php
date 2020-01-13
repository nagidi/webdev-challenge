<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //  Category Tale
        Schema::create('cat_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->timestamps();
        });

        //  lotcondition_ino Tale
        Schema::create('lotcondition_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lot_condition');
            $table->timestamps();
        });
         //  Tax table
         Schema::create('tax_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tax_name');
            $table->timestamps();
        });

        //  inventory Info table
        Schema::create('inventory_info', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('category');
            $table->string('lot_title');
            $table->unsignedInteger('lot_condition');
            $table->text('lot_location');
            $table->float('pre_tax_amount');
            $table->unsignedInteger('tax_name');
            $table->float('tax_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('cat_info');
        Schema::dropIfExists('lotcondition_ino');
        Schema::dropIfExists('tax_info');
        Schema::dropIfExists('inventory_info');
    }
}
