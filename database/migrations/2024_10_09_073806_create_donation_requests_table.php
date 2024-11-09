<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
            $table->id();
			$table->string('patient_name');
			$table->string('patient_phone');
			$table->string('hospital_name');
			$table->tinyInteger('patient_age');
			$table->tinyInteger('bags');
			$table->string('num');
			$table->string('hospital_address');
			$table->text('details');
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('blood_type_id');
            $table->unsignedBigInteger('city_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
