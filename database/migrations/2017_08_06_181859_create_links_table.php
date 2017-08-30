<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('links', function (Blueprint $table){
            $table->engine='MyISAM';
            $table->increments('links_id');
            $table->string('links_name')->default()->comment('链接名称');
            $table->string('links_url')->default()->comment('链接地址');
            $table->string('links_title')->default()->comment('标题');
            $table->integer('links_order')->default(0)->comment('排序');
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
        Schema::drop('links');
    }
}
