<?php

  class Tehtava extends BaseModel{

  	public $id, $kayttaja, $nimi, $tarkeys, $lisatieto;

  	public function __construct($attributes){
   		parent::__construct($attributes);
   	}

   	public static function all(){

   		$query = DB::connection()->prepare('SELECT * FROM Tehtava');

   		$query->execute();

   		$rows = $query -> fetchAll();

   		$tehtavat = array();

   		foreach($rows as $row){

   			$tehtavat[] = new Tehtava(array(
   				'id' => $row['id'],
   				'kayttaja' => $row['kayttaja'],
   				'nimi' => $row['nimi'],
   				'tarkeys' => $row['tarkeys'],
   				'lisatieto' => $row['lisatieto']
   			));
   		}

   		return $tehtavat;
   	}

   	public static function find($id){
   		$query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE id = :id LIMIT 1');
   		$query -> execute(array('id' => $id));
   		$row = $query -> fetch();

   		if($row){
   			$tehtava = new Tehtava(array(
   				'id' => $row['id'],
   				'kayttaja' => $row['kayttaja'],
   				'nimi' => $row['nimi'],
   				'tarkeys' => $row['tarkeys'],
   				'lisatieto' => $row['lisatieto']
   				));

   			return $tehtava;
   		}

   		return null;
   	}

    public function save(){

      $query = DB::connection()->prepare(INSERT INTO Tehtava(kayttaja, nimi, luokka, tarkeys, lisatieto) VALUES(:kayttaja, :nimi, :luokka, :tarkeys, :lisatieto) RETURNING id);

      $query->execute(array('kayttaja' => $this->kayttaja, 'nimi' => $this->nimi, 'luokka' => $this->luokka, 'tarkeys' => $this->tarkeys, 'lisatieto => $this->lisatieto'));

      $row = $query->fetch();

      $this->id = $row['id'];
    }
  }