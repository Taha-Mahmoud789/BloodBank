<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('phone');
			$table->string('password');
			$table->string('d_o_b');
			$table->string('last_donation_date')->nullable();
			$table->string('email');
			$table->smallInteger('pin_code')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('blood_type_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
