<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sub_menu_id');
            $table->foreign('sub_menu_id')->references('id')->on('sub_menus');
            $table->string('sub_sub_menu_name');
            $table->string('sub_sub_menu_display');
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
        Schema::dropIfExists('sub_sub_menus');
    }
}
