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
			'tarkeys' => $this->tarkeysaste($params['tarkeys']),
			'lisatieto' => $params['lisatieto'],
			'kayttaja' => 'Jonne'
			));
		$tehtava->save();

		Redirect::to('/muistilista');
		
	}

	public static function uusi(){
		View::make('tehtava/uusi.html');
	}

	public static function muokkaa($id){
		$tehtava = Tehtava::find($id);
		View::make('tehtava/muokkaa.html', array('attributes' => $tehtava));
	}

	public static function update($id){
		$params = $_POST;

		$attributes = array(
			'id' => $id,
			'nimi' => $params['nimi'],
			'tarkeys' => $this->tarkeysaste($params['tarkeys']),
			'lisatieto' => $params['lisatieto'],
			'kayttaja' => 'Jonne'
		);

		$tehtava = new Tehtava($attributes);
		$errors = $tehtava->errors();

		if(count($errors) > 0){
			View::make('tehtava/muokka.html', array('errors' => $errors, 'attributes' => $attributes));
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

	public static function tarkeysaste($tarkeys){

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

		return $tarkeys;
	}
}