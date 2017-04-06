<?php

	class UserController extends BaseController{
		public static function login(){
			View::make('user/login.html');
		}

		public static function handle_login(){
			$params = $_POST;

			$user = User::authenticate($params['tunnus'], $params['salasana']);

			if(!$user){
				View::make('user/login.html', array('error' => 'Väärä tunnus tai salasana!', 'tunnus' => $params['tunnus']));
			}else{
				$_SESSION['user'] = $user->id;

				Redirect::to('/muistilista', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
			}
		}
	}