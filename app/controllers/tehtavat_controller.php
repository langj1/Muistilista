<?php

class TehtavaController extends BaseController{

	public static function muistilista(){

		$tehtavat = Tehtava::all();

		View::make('tehtava/muistilista.html', array('tehtavat' => $tehtavat));
	}

	public static function store(){

		$params = $_POST;

		$tarkeys = $params['tarkeys'];

		if($tarkeys == 'option1'){
			$tarkeys = 1;
		} else if($tarkeys == 'option2'){
			$tarkeys = 2;
		} else if($tarkeys == 'option3'){
			$tarkeys = 3;
		} else if($tarkeys == 'option4'){
			$tarkeys = 4;
		} else if($tarkeys == 'option5'){
			$tarkeys = 5;
		} 

		$tehtava = new Tehtava(array(
			'nimi' => $params['nimi'],
			'luokka' => $params['luokka'],
			'tarkeys' => $tarkeys,
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