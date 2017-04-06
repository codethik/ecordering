<?php
session_start();
$login=$_SESSION['login'];
echo($login);
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


    if(!empty($_POST['id'])){ // si les variables ne sont pas vides
    
        $id = ($_POST['id']);
          
        // puis on entre les données en base de données :


        
        if(!$q=$bdd->query('DELETE FROM ingredients WHERE id='.$id)){
            return($q);
            echo('not deleted');
            
        }else{
            echo($id.' deleted');
            $bdd->close();
        }
    }else{
        echo "Vous avez oublié de remplir un des champs !";
    }

echo('end of script');

?>

