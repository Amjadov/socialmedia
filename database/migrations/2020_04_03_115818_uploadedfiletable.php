<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class uploadedfiletable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploadedfile', function (Blueprint $table) {
            $table->id();
			$table->string('filetype');
            $table->string('originalname')->nullable();
			$table->string('extension')->nullable();
            $table->string('realpath')->nullable();
            $table->string('size')->nullable();
			$table->string('memetype')->nullable();
			$table->string('savedestination')->nullable();
			$table->string('savedname')->nullable();
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
		Schema::dropIfExists('uploadedfile');
    }
}
