<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->date('birthday')->nullable();
            $table->bigInteger('inn')->unique();
            $table->bigInteger('snils')->unique();
        });
	    Schema::table('workers', function (Blueprint $table) {
		    $table->integer('organizations_id')->unsigned();
		    $table->foreign('organizations_id')->references('id')->on('organizations');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker');
    }
}
