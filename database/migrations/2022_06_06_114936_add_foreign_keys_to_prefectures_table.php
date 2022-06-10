<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPrefecturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('prefectures', function(Blueprint $table)
		{
			$table->foreign('area_id', 'fx_prefectures_areas1')->references('id')->on('areas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('prefectures', function(Blueprint $table)
		{
			$table->dropForeign('fx_prefectures_areas1');
		});
	}

}
