<?php

class TehtavaController extends BaseController{

	public static function muistilista(){

		self::check_logged_in();

		$tehtavat = Tehtava::all();

		View::make('tehtava/muistilista.html', array('tehtavat' => $tehtavat));
	}

	public static function store(){

		$params = $_POST;

		$tarkeys = $params['tarkeys'];

		$kayttaja = self::get_user_logged_in()->tunnus;

		$tehtava = new Tehtava(array(
			'nimi' => $params['nimi'],
			'tarkeys' => $tarkeys,
			'lisatieto' => $params['lisatieto'],
			'kayttaja' => $kayttaja
			));

		$tehtava->save();

		$haku = Luokka::find($params['luokka']);

		if(empty($haku)){

			$luokka = new Luokka(array(
			'kayttaja' => $kayttaja,
			'nimi' => $params['luokka']
			));

			$luokka->save();

		}

		$luokitus = new Luokitus(array(
			'luokka' => $params['luokka'],
			'tehtava' => $tehtava->id
			));

		$luokitus->save();

		Redirect::to('/muistilista');
		
	}

	public static function uusi(){

		self::check_logged_in();

		View::make('tehtava/uusi.html');
	}

	public static function muokkaa($id){

		self::check_logged_in();

		$tehtava = Tehtava::find($id);
		View::make('tehtava/muokkaa.html', array('tehtava' => $tehtava));
	}

	public static function update($id){

		$params = $_POST;
		
		$tarkeys = $params['tarkeys'];



		$attributes = array(
			'id' => $id,
			'nimi' => $params['nimi'],
			'tarkeys' => $tarkeys,
			'lisatieto' => $params['lisatieto'],
			'kayttaja' => self::get_user_logged_in()->tunnus
		);

		$tehtava = new Tehtava($attributes);
		$errors = $tehtava->errors();

		if(count($errors) > 0){
			View::make('tehtava/muokkaa.html', array('errors' => $errors, 'attributes' => $attributes));
		}else{
			$tehtava->update();

			Redirect::to('/muistilista', array('message' => 'Muokkaus onnistunut!'));
		}
	}

	public static function poista($id){
		$tehtava = new Tehtava(array('id' => $id));

		$tehtava->poista();

		Redirect::to('/muistilista', array('message' => 'Poisto onnistunut!'));
	}

}