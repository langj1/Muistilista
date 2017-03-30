<?php

   class Kayttaja extends BaseModel{

   	public $tunnus, $salasana;

   	public function__construct($attributes){
   		parent::__construct($attributes);
   	}
   }