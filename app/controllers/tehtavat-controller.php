<?php

class TehtavaController extends BaseController{

	public static function muistilista(){

		$tehtavat = Tehtava::all();

		View::make('tehtava/muistilista.html', array('tehtavat' => $tehtavat));
	}
}