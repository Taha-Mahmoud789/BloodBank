<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPostsTable extends Migration {

	public function up()
	{
		Schema::create('client_posts', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Ensure this matches clients.id type
            $table->unsignedBigInteger('post_id'); // Assuming this is also a foreign key
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('client_posts');
	}
}
