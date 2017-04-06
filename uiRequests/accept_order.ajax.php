<?php
if(!empty($_POST['id'])){
    $id=$_POST['id'];
    $id= mysqli_real_escape_string($id);
}else{
    throw new Exception('bad parameters (id)');
}

try
{
    $host_name  = "db620657341.db.1and1.com";
              $database   = "db620657341";
              $user_name  = "dbo620657341";
              $password   = "Clique2015_";
              
    $bdd = new mysqli($host_name, $user_name, $password, $database); 
    print_r($bdd);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if(!$q=$bdd->query('UPDATE orders
SET status = 1
WHERE id='.$id)){
            return($q);
            var_dump($q);
            
        }else{
        echo "Vous avez oublié de remplir un des champs !";
    }
    var_dump($q);

?>

