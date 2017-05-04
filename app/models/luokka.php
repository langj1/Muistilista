<?php

	class luokka extends BaseModel{

		public $id, $kayttaja, $nimi;

		public function __construct($attributes){
   			parent::__construct($attributes);
      		$this->validators = array('validate_nimi');
   		}

   		public static function all(){

      		$t = new TehtavaController();
      		$tunnus = $t->get_user_logged_in();

   			$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE kayttaja = :kayttaja');

   			$query->execute(array('kayttaja' => $tunnus->tu));

   			$rows = $query -> fetchAll();

   			$luokat = array();

   			foreach($rows as $row){

   			$luokat[] = new Luokka(array(
   				'id' => $row['id'],
   				'kayttaja' => $row['kayttaja'],
   				'nimi' => $row['nimi']
   			));
   			}

   			return $luokat;
   		}

   		public static function find($id){
   			$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE id = :id LIMIT 1');
   			$query -> execute(array('id' => $id));
   			$row = $query -> fetch();

   			if($row){
   				$luokka = new Luokka(array(
   					'id' => $row['id'],
   					'kayttaja' => $row['kayttaja'],
   					'nimi' => $row['nimi']
   				));

   				return $luokka;
   			}

   			return null;
   		}

         public static function find($nimi){
            $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE nimi = :nimi LIMIT 1');
            $query -> execute(array('nimi' => $nimi));
            $row = $query -> fetch();

            if($row){
               $luokka = new Luokka(array(
                  'id' => $row['id'],
                  'kayttaja' => $row['kayttaja'],
                  'nimi' => $row['nimi']
               ));

               return $luokka;
            }

            return null;
         }

   		public function save(){

      		$query = DB::connection()->prepare('INSERT INTO Luokka(kayttaja, nimi) VALUES(:kayttaja, :nimi) RETURNING id');

      		$query->execute(array('kayttaja' => $this->kayttaja, 'nimi' => $this->nimi));

      		$row = $query->fetch();

      		$this->id = $row['id'];
    	   }
	}