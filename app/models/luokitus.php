<?php
	
	class Luokitus extends BaseModel{

		public $luokka, $tehtava;

		public function __construct($attributes){
   			parent::__construct($attributes);

   		}

   		public static function find($id){
   			$query = DB::connection()->prepare('SELECT * FROM Luokitus WHERE id = :id LIMIT 1');
   			$query -> execute(array('id' => $id));
   			$row = $query -> fetch();

   			if($row){
   				$luokitus = new Luokitus(array(
   					'luokka' => $row['luokka'],
   					'tehtava' => $row['tehtava']
   				));

   				return $luokitus;
   			}

   			return null;
   		}

    	public function save(){

      		$query = DB::connection()->prepare('INSERT INTO Luokitus(luokka, tehtava) VALUES(:luokka, :tehtava)');

      		$query->execute(array('luokka' => $this->luokka, 'tehtava' => $this->tehtava));

    	   
    	}

      public function update(){
        $query = DB::connection()->prepare('UPDATE Luokitus SET (luokka) = (:luokka) WHERE tehtava = :id');

        $query->execute(array('luokka' => $this->luokka, 'id' => $this->tehtava));
    }

	}