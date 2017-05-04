<?php

	class luokka extends BaseModel{

		public $kayttaja, $nimi;

		public function __construct($attributes){
   			parent::__construct($attributes);
      		$this->validators = array('validate_nimi');
   		}

   		public static function all(){

      		$t = new TehtavaController();
      		$tunnus = $t->get_user_logged_in();

   			$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE kayttaja = :kayttaja');

   			$query->execute(array('kayttaja' => $tunnus->tunnus));

   			$rows = $query -> fetchAll();

   			$luokat = array();

   			foreach($rows as $row){

   			$luokat[] = new Luokka(array(
   				'kayttaja' => $row['kayttaja'],
   				'nimi' => $row['nimi']
   			));
   			}

   			return $luokat;
   		}

   		public static function find($nimi){
   			$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE nimi = :nimi LIMIT 1');
   			$query -> execute(array('id' => $nimi));
   			$row = $query -> fetch();

   			if($row){
   				$luokka = new Luokka(array(
   					'kayttaja' => $row['kayttaja'],
   					'nimi' => $row['nimi']
   				));

   				return $luokka;
   			}

   			return null;
   		}


   		public function save(){

      		$query = DB::connection()->prepare('INSERT INTO Luokka(kayttaja, nimi) VALUES(:kayttaja, :nimi)');

      		$query->execute(array('kayttaja' => $this->kayttaja, 'nimi' => $this->nimi));
    	   }
	}