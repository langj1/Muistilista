<?php

   class Kayttaja extends BaseModel{

   	public $tunnus, $salasana;

   	public function __construct($attributes){
   		parent::__construct($attributes);
   	}

   	public static function authenticate($tunnus, $salasana){
   		$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
   		$query->execute(array('tunnus'=>$tunnus,'salsana'=>$salasana));
   		$row = $query->fetch();
   		if($row){
   			$kayttaja = new Kayttaja(array(
   				'tunnus' => $row['tunnus'],
   				'salasana' => $row['salasana']
   				));
   			return $kayttaja;
   		}else{
   			return null;
   		}
   	}

   	public static function find($tunnus){
   		$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE tunnus = :tunnus LIMIT 1');
   		$query -> execute(array('tunnus' => $tunnus));
   		$row = $query -> fetch();

   		if($row){
   			$kayttaja = new Kayttaja(array(
   				'tunnus' => $row['tunnus'],
   				'salasana' => $row['salasana'],
   				));

   			return $kayttaja;
   		}

   		return null;
   	}
   }