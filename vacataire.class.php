<?php

    require_once('personne.class.php');// on appelle le fichier personne.class.php où se trouve la classe abstrète Personne
    use formateur\Personne; 
    //la classe Vacataire qui hérite de la classe Personne
    class Vacataire extends Personne{
        private $diplome; // le diplome de ce formateur vacataire

        public function __construct($numero, $nom, $prenom, $heureSup, $salaireHoraire, $diplome)
        {
            parent::__construct($numero, $nom, $prenom, $heureSup, $salaireHoraire); //on utilise parent car on a déjà ces variables dans la classe Personne (La classe mère)
            $this -> diplome = $diplome;
        }

        //on ajoute les instructions dans la méthode calculerSalaire()
        public function calculerSalaire(){
            //on va tester les valeurs données à diplome
            switch(strtolower($this->diplome)) {
                case 'licence':
                    return $this->salaireHoraire * $this->heureSup * 1.2; // si 'licence' elle retourne heureSup * salaireHoraire * 1.2 
                    break;
                case 'master':
                    return $this->salaireHoraire * $this->heureSup * 1.5; // si 'master' elle retourne heureSup * salaireHoraire * 1.5
                case 'doctora':
                    return $this->salaireHoraire * $this->heureSup * 2; // si 'doctora' elle retourne heureSup * salaireHoraire * 2
                default:
                    return "Ce diplôme est invalide"; //sinon elle retourne un message 
            }
        }

        // pour la méthode magique __toString() elle retourne les informations concernent le formateur
        public function __toString(){
			return "<br><h5>".$this->numero." - diplome ".$this->diplome.": ".strtoupper($this->nom)." ".strtoupper($this->prenom)." <br>Son salaire: ".$this->calculerSalaire()." DH</h5>";
		}
    }