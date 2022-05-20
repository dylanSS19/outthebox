<?php

class Connexion{

	static public function connect(){

		$link = new PDO("mysql:host=midigitalsat.com;dbname=empresas",
			            "admin",
			            "Heriberto9109");

		$link->exec("set names utf8");

		return $link;

	}

}