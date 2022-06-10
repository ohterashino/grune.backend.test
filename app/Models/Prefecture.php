<?php

namespace App\Models;

class Prefecture extends \App\Models\Base\Prefecture
{
	protected $fillable = [
		'id',
		'name',
		'display_name',
		'area_id'
	];

	public static function selectlist()
	{
			$prefs = Prefecture::all();
			$list = array();
			$list += array( "" => "選択してください" ); //selectlistの先頭を空に
			foreach ($prefs as $pref) {
				$list += array( $pref->id => $pref->display_name );
			}
			return $list;
	}
}
