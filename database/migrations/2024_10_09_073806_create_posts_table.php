<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
            $table->id();
			$table->string('title');
            $table->string('thumbnail')->nullable();
			$table->text('content');
            $table->unsignedBigInteger('category_id');
            $table->date('publish_date');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}
