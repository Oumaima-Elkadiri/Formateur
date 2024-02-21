<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<style>
  #vacataire, #formateur {
    display: none;
  }
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="number" min="0" name="numero" class="form-control" id="numero" placeholder="Saisir votre numéro" required>
                        <label for="numero">Numéro</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nom" class="form-control" id="nom" placeholder="Saisir votre nom" required>
                        <label for="nom">Nom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Saisir votre prénom" required>
                        <label for="prenom">Prénom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="heuresup" min="0" class="form-control" id="heuresup" placeholder="Nombre des heures supplémentaires" required>
                        <label for="heuresup">Heures supplémentaires</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="salairehoraire" min="0" class="form-control" id="salairehoraire" placeholder="Salaire horaire" required>
                        <label for="salairehoraire">Salaire horaire</label>
                    </div>
                    <div class="checkbox mb-3">
                        <label class="row" style="text-align: center;">
                            <div style="font-size: 20px;" class="col"><input type="radio" name="type" id='checkF' value="formateur"> Formateur occasionnel</div>
                            <div style="font-size: 20px;" class="col"><input type="radio" name="type" id='checkV' value="vacataire">  Formateur vacataire</div>
                        </label>
                    </div>
                    <!-- La partie des champs du formateur occasionnel-->
                    <div id="formateur">
                        <div class="form-floating mb-3">
                            <input type="number" name="salaireFixe" min="0" class="form-control" id="salaireFixe" placeholder="Votre salaire fixe">
                            <label for="salaireFixe">Salaire fixe</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select  name="niveau" id="niveau" class="form-control" >
                                <option>Choisir votre niveau</option>
                                <option value="junior">Junior</option>
                                <option value="intermédiaire">Intermédiaire</option>
                                <option value="senior">Senior</option>
                            </select>
                            <label for="niveau">Niveau</label>
                        </div>
                    </div>
                    <!--Fin-->
                    <!-- La partie des champs du formateur vacataire-->
                    <div id="vacataire">
                        <div class="form-floating mb-3">
                            <select  name="diplome" id="diplome" class="form-control" >
                                <option>Choisir votre diplome</option>
                                <option value="licence">Licence</option>
                                <option value="master">Master</option>
                                <option value="doctora">Doctora</option>
                            </select>
                            <label for="diplome">Diplome</label>
                        </div>
                    </div>
                    <!--Fin-->
                    <button class="w-100 btn btn-lg btn-primary" name="Ajouter" id="ajouter" type="submit" disabled>Ajouter</button>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
     
    <?php
    //on appelle les deux fichiers  où se trouvent les deux classes Vacataire et Formateur
        require_once('formateur.class.php');
        require_once('vacataire.class.php');
        
        if(!isset($_SESSION['formateur'])){ // si la session formateur n'existe pas on la créera
            $_SESSION['formateur'] = [];
        }
        if(isset($_POST['Ajouter'])){ // si on a cliqué sur le bouton ajouter
            $numero = $_POST['numero'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $heuresup = $_POST['heuresup'];
            $salairehoraire = $_POST['salairehoraire']; 
            //on a récupéré les cinq données saisient où on a ajouter required 
            //on va tester manuellement les autres champs s'ils sont saisis
            if(isset($_POST['type'])){// si isset le type du formateur
                if($_POST['type'] == 'formateur'){ // si le type de formateur est occasionnel
                    // on va tester si isset les chemps du salaireFixe et de niveau seulement
                    if(isset($_POST['salaireFixe']) && !empty($_POST['salaireFixe'])){ 
                        $salaireFixe = $_POST['salaireFixe']; // on ajoute la valeur saisie dans le champ de salaireFixe dans cette variable
                        if(isset($_POST['niveau']) && !empty($_POST['niveau'])){
                            $niveau = $_POST['niveau'];// on ajoute la valeur saisie dans le champ de niveau dans cette variable
                            // créer cune instance de la la classe Formateur
                            $f = new Formateur($numero, $nom, $prenom, $heuresup, $salairehoraire, $salaireFixe, $niveau);
                            $_SESSION['formateur'][]=$f; // on l'ajoute dans la session formateur
                            echo $f; //et on affiche les informations retournées dans __toString()
                        }else{
                            echo "Choisissez votre niveau!!";
                        }
                    }else{
                        echo "Insérez Le salaire fixe!!";
                    }
                    
                }else{// si le type de formateur est vacataire
                    if(isset($_POST['diplome']) && !empty($_POST['diplome'])){// on va tester si isset le chemp diplome seulement
                        $diplome = $_POST['diplome'];// on ajoute la valeur saisie dans le champ de salaireFixe dans cette variable
                        //puis on crée une instance de la classe Vacataire
                        $v = new Vacataire($numero, $nom, $prenom, $heuresup, $salairehoraire, $diplome);
                        $_SESSION['formateur'][]=$v;//on l'ajoute dans la session formateur
                        echo $v; //et on affiche les informations retournées dans __toString()
                    }else{
                        echo "Choisissez votre diplome!!";
                    }
                    
                }
            }
        }
    ?>
    </div> 
    <script src="JS/bootstrap.min.js"></script>
    <script>
        var checkF = document.getElementById('checkF');
        var formateur = document.getElementById('formateur');
        var checkV = document.getElementById('checkV');
        var vacataire = document.getElementById('vacataire');

        var ajouter = document.getElementById('ajouter');
        //si on a cliqué sur le boutton radio de formateur 
        checkF.addEventListener('click', function() {
            formateur.style.display = 'block';//afficher les champs de formateur occasionnel
            vacataire.style.display = 'none';// n'en montrer pas les champs de formateur vacataire
            ajouter.disabled = false; // rendre le boutton ajouter non disbled
        });


        //si on a cliqué sur le boutton radio de vacataire 
        checkV.addEventListener('click', function() {
            vacataire.style.display = 'block';//afficher les champs de formateur vacataire
            formateur.style.display = 'none';// n'en montrer pas les champs de formateur occasionnel
            ajouter.disabled = false;// rendre le boutton ajouter non disbled
        });


    </script>
</body>
</html>