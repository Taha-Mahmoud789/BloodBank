<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodTypeClientsTable extends Migration {

	public function up()
	{
		Schema::create('blood_type_clients', function(Blueprint $table) {
            $table->id(); // This creates an unsignedBigInteger
            $table->unsignedBigInteger('client_id'); // Ensure this matches clients.id
            $table->unsignedBigInteger('blood_type_id'); // Ensure this matches blood_types.id
            $table->timestamps();

//            // Define foreign key constraints
//            $table->foreign('client_id')->references('id')->on('clients')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//            $table->foreign('blood_type_id')->references('id')->on('blood_types')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('blood_type_clients');
	}
}
