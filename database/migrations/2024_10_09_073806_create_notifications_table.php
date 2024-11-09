<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->string('content');
            $table->unsignedBigInteger('donation_request_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}
