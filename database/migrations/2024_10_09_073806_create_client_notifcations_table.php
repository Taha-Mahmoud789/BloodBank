<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientNotifcationsTable extends Migration {

	public function up()
	{
		Schema::create('client_notifications', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('notification_id');
			$table->boolean('is_read');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('client_notifications');
	}
}
