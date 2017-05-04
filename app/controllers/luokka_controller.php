<?php

class LuokkaController extends BaseController{

	public static function luokat(){

		self::check_logged_in();

		$luokat = Luokka::all();

		View::make('luokka/luokat.html', array('luokat' => $luokat));
	}

}