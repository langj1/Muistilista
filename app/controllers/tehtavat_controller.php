<?php

class TehtavaController extends BaseController{

	public static function muistilista(){

		$tehtavat = Tehtava::all();

		View::make('tehtava/muistilista.html', array('tehtavat' => $tehtavat));
	}

	public static function store(){

		$params = $_POST;

		$tehtava = new Tehtava(array(
			'nimi' => $params['nimi'],
			'luokka' => $params['luokka'],
			'tarkeys' => $params['tarkeys'],
			'lisatieto' => $params['lisatieto'],
			'kayttaja' => 'Jonne'
			));
		$tehtava->save();

		Redirect::to('/muistilista');
		
	}

	public static function uusi(){
		View::make('tehtava/uusi.html');
	}
}