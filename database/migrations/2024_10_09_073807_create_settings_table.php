<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
            $table->id();
			$table->string('notification_settings_text');
			$table->longText('about_app');
			$table->string('phone');
			$table->string('email');
			$table->string('fb_link');
			$table->string('ins_link');
			$table->string('tw_link');
			$table->string('yt_link');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
