<?php
session_start();
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

 // si on a envoyé des données avec le formulaire


    if(!empty($_POST['id'])){ // si les variables ne sont pas vides
    
        $id = ($_POST['id']);
        
        //$id = mysqli_real_escape_string($id);
         // on sécurise nos données
      

        
        // puis on entre les données en base de données :
        
        $restaurant=$_SESSION['login'];
        
        if($q=$bdd->query('SELECT ingredient, quantity, measure, supplier, status FROM orders WHERE delivery="'.$id.'" AND restaurant="'.$restaurant.'"')){
           $arrayAnswer=$q->fetch_all();
            //echo($arrayAnswer[0]);
           if(empty($arrayAnswer)){
               echo('No commentary for this order');
           }else{
               echo json_encode($arrayAnswer);
                       
           }
            
            
        }else{
            echo('no Q');
        }
    }else{
        echo "fail to load the comments...";
    }
 
?>

