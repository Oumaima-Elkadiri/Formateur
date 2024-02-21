<?php
    require_once('personne.class.php');// on appelle le fichier personne.class.php où se trouve la classe abstrète Personne
    use formateur\Personne;
    //la classe Formateur qui hérite de la classe Personne
    class Formateur extends Personne{
        private $salaireFixe; // le salaire fixe du formateur occasionnel 
        private $niveau; // Le niveau de ce formateur
        public function __construct($numero, $nom, $prenom, $heureSup, $salaireHoraire, $salaireFixe, $niveau)
        {
            parent::__construct($numero, $nom, $prenom, $heureSup, $salaireHoraire);//on utilise parent car on a déjà ces variables dans la classe Personne (La classe mère)
            $this -> salaireFixe = $salaireFixe;
            $this -> niveau = $niveau;
        }
        //on ajoute les instructions dans la méthode calculerSalaire()
        public function calculerSalaire(){
            switch(strtolower($this->niveau)) {
                //on va tester les valeurs données au niveau
                case 'junior':
                    return $this->salaireFixe + ($this->salaireHoraire * $this->heureSup);// si 'junior' elle retourne heureSup * salaireHoraire   plus le slaire fixe
                    break;
                case 'intermédiaire':
                    return $this->salaireFixe + ($this->salaireHoraire * 1.5 * $this->heureSup);// si 'intermédiaire' elle retourne heureSup * 1.5 * salaireHoraire   plus le slaire fixe
                case 'senior':
                    return $this->salaireFixe + ($this->salaireHoraire * 2 * $this->heureSup);// si 'senior' elle retourne heureSup * 2 * salaireHoraire   plus le slaire fixe
                default:
                    return "Il existe 3 niveaux: junior, intermédiaire et senior"; //sinon elle affiche un message que le niveau doit égale les trois valeurs précédentes
            }
        }

        public function __toString(){
			return "<br><h5>".$this->numero." - Niveau ".$this->niveau.": ".strtoupper($this->nom)." ".strtoupper($this->prenom)." <br>Son salaire total: ".$this->calculerSalaire()." DH</h5>";
		}
    }