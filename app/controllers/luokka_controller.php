<?php

class LuokkaController extends BaseController{

	public static function luokat(){

		self::check_logged_in();

		$luokat = Luokka::all();

		View::make('luokka/luokat.html', array('luokat' => $luokat));
	}

	public static function luokka($nimi){

		self::check_logged_in();

		$tehtavat = Tehtava::etsiTehtavat($nimi);

		View::make('luokka/luokka.html', array('tehtava' => $tehtavat));
	}

}