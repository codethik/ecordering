<?php
if(!empty($_POST['id'])){
    $id=$_POST['id'];
}else{
    throw new Exception('bad parameters (id)');
}

try
{
    $bdd = new PDO('sqlite:Database.sqlite'); 
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if($bdd->query('UPDATE orders
SET status = "STOCK"
WHERE id='.$id)){
            return(true);
            
        }else{
        echo "Vous avez oublié de remplir un des champs !";
    }


?>