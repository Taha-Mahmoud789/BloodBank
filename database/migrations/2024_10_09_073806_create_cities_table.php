<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->id();
			$table->string('name');
            $table->unsignedBigInteger('governorate_id');
            $table->timestamps();
//            $table->foreign('governorate_id')
//                ->references('id')->on('governorates')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}
