<?php

  class Tehtava extends BaseModel{

  	public $id, $kayttaja, $nimi, $tarkeys, $lisatieto, $luokka;

  	public function __construct($attributes){
   		parent::__construct($attributes);
      $this->validators = array('validate_nimi');
   	}

   	public static function all(){

      $t = new TehtavaController();
      $tunnus = $t->get_user_logged_in();

   		$query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE kayttaja = :kayttaja');

   		$query->execute(array('kayttaja' => $tunnus->tunnus));

   		$rows = $query -> fetchAll();

   		$tehtavat = array();

   		foreach($rows as $row){

   			$tehtavat[] = new Tehtava(array(
   				'id' => $row['id'],
   				'kayttaja' => $row['kayttaja'],
   				'nimi' => $row['nimi'],
   				'tarkeys' => $row['tarkeys'],
   				'lisatieto' => $row['lisatieto']
          'luokka' => self::etsiLuokat($row['nimi'])
   			));
   		}

   		return $tehtavat;
   	}

   	public static function find($id){
   		$query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE id = :id LIMIT 1');
   		$query -> execute(array('id' => $id));
   		$row = $query -> fetch();

      $tehtava = array();

   		if($row){
   			$tehtava[] = new Tehtava(array(
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

      $query = DB::connection()->prepare('INSERT INTO Tehtava(kayttaja, nimi, tarkeys, lisatieto) VALUES(:kayttaja, :nimi, :tarkeys, :lisatieto) RETURNING id');

      $query->execute(array('kayttaja' => $this->kayttaja, 'nimi' => $this->nimi, 'tarkeys' => $this->tarkeys, 'lisatieto' => $this->lisatieto));

      $row = $query->fetch();

      $this->id = $row['id'];
    }

    public function update(){
      $query = DB::connection()->prepare('UPDATE Tehtava SET (nimi, tarkeys, lisatieto) = (:nimi, :tarkeys, :lisatieto)');

      $query->execute(array('nimi' => $this->nimi, 'tarkeys' => $this->tarkeys, 'lisatieto' => $this->lisatieto));
    }

    public function validate_nimi(){
      $validate = 'validate_not_empty';
      return $this->{$validate}($this->$nimi);
    }

    public function poista(){
      $query = DB::connection()->prepare('DELETE FROM Tehtava WHERE id=:id');

      $query->execute(array('id' => $this->id));
    }
    
    public static function etsiLuokat($nimi){
      $query = DB::connection()->prepare('SELECT * FROM Luokitus WHERE tehtava = :tehtava LIMIT 1');
      $query -> execute(array('tehtava' => $nimi));
      $row = $query -> fetch();

      $tehtava = array();

      if($row){

        return $row['luokka'];
      }

      return null;
    }

  }