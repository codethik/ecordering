<?php
require('../security/dataSecure.sec.php');
try
{
    $host_name  = "db620657341.db.1and1.com";
              $database   = "db620657341";
              $user_name  = "dbo620657341";
              $password   = "Clique2015_";
              
    $bdd = new mysqli($host_name, $user_name, $password, $database); 
    //print_r($bdd);
    
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if ($mysqli->connect_errno) {
    printf("Échec de la connexion : %s\n", $mysqli->connect_error);
    exit();
}

 // si on a envoyé des données avec le formulaire
$secure=new DataSecure();


 // si les variables ne sont pas vides
    
        $ing_name = ($_POST['addIng']);
        if($secure->checkTextInputs($ing_name)==false){
            die('invalid provided datas');
        }
         // on sécurise nos données
        $supplier= ($_POST['supplier']);
        $measure=($_POST['ingMeasure']);
        $category=($_POST['ingCategory']);
        
 /*var_dump($ing_name);
 var_dump($supplier);
 var_dump($measure);*/
 
 /* Requête "Select" retourne un jeu de résultats */
if ($result = $bdd->query("INSERT INTO ingredients VALUE('','".$ing_name."','".$supplier."','".$measure."','".$category."')")) {
    printf("Select a retourné %d lignes.\n", $result->num_rows);
}
    /* Libération du jeu de résultats */
    $bdd->close();
        
        // puis on entre les données en base de données :


//var_dump($q);
        /*if(!$q=$bdd->query("INSERT INTO ingredients VALUES('','.$supplier.','.$ing_name.','.$measure.')")){
            return($q);
            
            var_dump($q);
        }else{
            echo "Vous avez oublié de remplir un des champs !";
            echo 'Succes :';
            var_dump($q);
        }
         
         */

    

?>
