<?php
	namespace formateur;
	//la classe abstraite personne
	abstract class Personne{
		protected $numero; 
		protected $nom;
		protected $prenom;
		protected $heureSup; //heures Suplémentaires
		protected $salaireHoraire; // salaire par heure
		
		//constructeur de la classe personne
		public function __construct($numero, $nom, $prenom, $heureSup, $salaireHoraire){
			$this->numero = $numero;
			$this->nom = $nom;
			$this->prenom = $prenom;
			$this->heureSup = $heureSup;
			$this->salaireHoraire = $salaireHoraire;
		}

		//La methode abstraite calculerSalaire() qui on va définie dans les classes filles 
		abstract public function calculerSalaire();

		//getter avec la methode magique
		public function __get($name){
			if(property_exists($this, $name)){
				return $this->$name;
			}
		}
		//setter avec la methode magique
		public function __set($name,$value){
			if(property_exists($this, $name)){
				$this->$name=$value;
			}
		}

		// la methode magique __toString() qui renvoie les informations du personne 
		public function __toString(){
			return $this->numero.": ".strtoupper($this->nom)." ".strtoupper($this->prenom);
		}
		
	}

?>