<?php

   class Kayttaja extends BaseModel{

   	public $tunnus, $salasana;

   	public function__construct($attributes){
   		parent::__construct($attributes);
   	}

   	public static function authenticate($tunnus, $salasana){
   		$query = DB:connection()->prepare('SELECT * FROM Kayttaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
   		$query->execute(zrrzy('name'=>$name,'password'=>$password));
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
   }