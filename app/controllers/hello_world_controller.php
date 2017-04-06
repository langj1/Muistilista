<?php

  //require 'app/models/tehtava.php';
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //View::make('home.html');
      echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä

      $lenkki = new Tehtava(array(
        'nimi' => '',
        'tarkeys' => 1,
        'kayttaja' => 'Jonne',
        'lisatieto' => 'pitkä lenkki'
      ));

      $errors = $lenkki->errors();

      Kint::dump($errors);

      //View::make('helloworld.html');
    }

    public static function login(){
      View::make('suunnitelmat/kirjautumissivu.html');
    }

    public static function muistilista(){
      View::make('suunnitelmat/muistilista.html');
    }

    public static function lisaa(){
      View::make('suunnitelmat/lisaa.html');
    }
  }
