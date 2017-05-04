<?php

	class Luokka extends BaseModel{

		public $kayttaja, $nimi, $maara;

		public function __construct($attributes){
   			parent::__construct($attributes);
   		}

   		public static function all(){

      		$t = new TehtavaController();
      		$tunnus = $t->get_user_logged_in();

   			$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE kayttaja = :kayttaja ORDER BY nimi ASC');

   			$query->execute(array('kayttaja' => $tunnus->tunnus));

   			$rows = $query -> fetchAll();

   			$luokat = array();

   			foreach($rows as $row){

   			$luokat[] = new Luokka(array(
   				'kayttaja' => $row['kayttaja'],
   				'nimi' => $row['nimi'],
               'maara' => self::montaTehtavaa($row['nimi'])
   			));
   			}

   			return $luokat;
   		}

   		public static function find($nimi){
   			$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE nimi = :nimi LIMIT 1');
   			$query -> execute(array('nimi' => $nimi));
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

         public function montaTehtavaa($nimi){
            $query = DB::connection()->prepare('SELECT COUNT(*) AS tehtavat FROM Tehtava, Luokka, Luokitus WHERE luokka = Luokka.nimi AND id = tehtava AND Luokka.nimi = :nimi');

            $query->execute(array( 'nimi' => $nimi));

            $row = $query -> fetch();

            return $row['tehtavat'];

         }
	}