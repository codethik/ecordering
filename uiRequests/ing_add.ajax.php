<?php

try
{
    $host_name  = "db620657341.db.1and1.com";
              $database   = "db620657341";
              $user_name  = "dbo620657341";
              $password   = "Clique2015_";
              
    $bdd = new mysqli($host_name, $user_name, $password, $database); 
    
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

 // si on a envoyé des données avec le formulaire


    if(!empty($_POST['ing_id'])){ // si les variables ne sont pas vides
    
        $ing_name = ($_POST['ing_id']);
         // on sécurise nos données
        $cook= ($_POST['cookName']);

        $ing_name= mysqli_real_escape_string($ing_name);
        $cook= mysqli_real_escape_string($ing_name);

        var_dump($bdd);
        // puis on entre les données en base de données :


        
        if(!$q=$bdd->query('INSERT INTO cooksCart ("cook","ing_id") VALUES("'.$cook.'","'.$ing_name.'")')){
            return($q);
            
        }
    }else{
        echo "Vous avez oublié de remplir un des champs !";
    }



?>
