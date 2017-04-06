<?php
require_once 'Mollie/API/Autoloader.php';
$mollie = new Mollie_API_Client;
$mollie->setApiKey("test_55hGVhhfcPfPgyAzstjUns9DBPw9rJ");
$payment = $mollie->payments->create(array(
        "amount"      => 10.00,
        "description" => "Access ecordering",
        "redirectUrl" => "http://ecordering.be/reg/registrationSubmit.php",
    ));
//change the payement id to fake an unsuscribed member 
$payment_id = 'tr_WDqYK6vllg';
//_____________________________________________________


    if ($mollie->payments->get($payment->id)!=$payement_id)
    {   
        //   
    }else{
        $result=$mollie->payments->get($payment->id);
        header("Location: " . $payment->getPaymentUrl());
        exit;
    }


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
if($_POST['userKind']==="Cook"){

    //if(!empty($_POST['companyName'])){ // si les variables ne sont pas vides
    
        $companyName = htmlspecialchars($_POST['companyName']);
        $phone = htmlspecialchars($_POST['phone']);
        $adress= htmlspecialchars($_POST['adress']);
        $city= htmlspecialchars($_POST['city']);
        $mail = htmlspecialchars($_POST['email']);
        $password = md5($_POST['password']);

         // on sécurise nos données
        
        // puis on entre les données en base de données :


        
        try{

        	$q=$bdd->query('INSERT INTO cooks (`nickname`,`password`,`restaurant`,`adress`,`phone`) VALUES("'.$companyName.'","'.$password.'","'.$companyName.'","'.$adress.'","'.$phone.'")');
        	header('Location: http://www.ecordering.be/registrationSuccess.php');
            
            
          
            
        }
        catch (Exception $e)
        {
        	echo($e->getMessage());
        	
        }
    } elseif ($_POST['userKind']==="Supplier") {

        $companyName = htmlspecialchars($_POST['companyName']);
        $phone = htmlspecialchars($_POST['phone']);
        $adress= htmlspecialchars($_POST['adress']);
        $city= htmlspecialchars($_POST['city']);
        $mail = htmlspecialchars($_POST['email']);
        $password = md5($_POST['password']);

         // on sécurise nos données
      
        
        // puis on entre les données en base de données :


        
        try{

        	$q=$bdd->query('INSERT INTO suppliersFullList (`name`,`password`,`adress`,`city`,`phone`) VALUES("'.$companyName.'","'.$password.'","'.$adress.'","'.$city.'","'.$phone.'")');
        	header('Location: http://ecordering.be/registrationSuccess.php');
            
            
          
            
        }
        catch (Exception $e)
        {
        	echo($e->getMessage());
        	
        }
    	
    }else{
        echo "Vous avez oublié de remplir un des champs !";
        
    }

//}

?>