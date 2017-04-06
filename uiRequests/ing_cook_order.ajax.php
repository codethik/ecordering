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

if ($mysqli->connect_errno) {
    printf("Échec de la connexion : %s\n", $mysqli->connect_error);
    exit();
}

$cookName=$_SESSION['login'];
$ing=$_POST['ing1'];
$qty=$_POST['qty1'];
$delivDate=$_POST["deliv1"];






//Get the category
            $sqlA=$bdd->query('SELECT DISTINCT category FROM ingredients WHERE ingredient="'.$ing.'"');
            $sqlA=$sqlA->fetch_all();
            $cat=$sqlA[0][0];
            print_r($cat);
            
            //Get the measure
            $sqlA2=$bdd->query('SELECT DISTINCT measure FROM ingredients WHERE ingredient="'.$ing.'"');
            $sqlA2=$sqlA2->fetch_all();
            $mea=$sqlA2[0][0];
            print_r($mea);
            
            //Get the supplier associated to this category
            $sqlB=$bdd->query('SELECT DISTINCT supplier FROM ingredients WHERE ingredient="'.$ing.'"');
            $sqlB=$sqlB->fetch_all();
            $sup=$sqlB[0][0];
            print_r($sup);
            //If the supplier is not an active user, send an invitation, else, go to the stamping step
            $sqlC=$bdd->query('SELECT * FROM suppliersFullList WHERE  name="'.$sup.'"');
            $sqlC=$sqlC->fetch_all();
            print_r($sqlC);
            if(empty($sqlC[0][0])){
                return 'mail unset';
                // !!!!! TODO: The function needs to be set with dynamic variables. !!!!!
                // The message
                $message = "Bonjour,\r\Vous avez reçu une commande sur Ecordering, nouvelle plateforme de commande instantané pour la restauration. Il semblerait que vous ne soyez pas encore inscrit. Ne vous inuqietez pas, c'est gratuit et beaucoup plus simple pour gerer vos commandes.\r\nLine 3";

                // In case any of our lines are larger than 70 characters, we should use wordwrap()
                $message = wordwrap($message, 70, "\r\n");

                // Send
                mail('supplier@example.com', 'le restaurant Marc vous a envoyé une commande sur Ecordering', $message);
            }
            //The order is prepared and stamped with the right supplier
            $stampedOrder='INSERT INTO orders (ingredient,delivery,restaurant,supplier,quantity,measure) VALUES("'.$ing.'", "'.$delivDate.'","'.$cookName.'","'.$sup.'",'.$qty.',"'.$mea.'")';
            
            $sqlFinal=$bdd->query($stampedOrder);
            var_dump('Before comment:'.$sqlFinal);
            if($_POST['comment1']!=''){
                $comment=$_POST['comment1'];
                
                $orderId=$bdd->query('SELECT id from orders ORDER BY id DESC');
                $orderId=$orderId->fetch_all();
                $orderId=$orderId[0][0];
                var_dump($orderId);
                try {
                    $testComment=$bdd->query('INSERT INTO comments (comment,user,id_order) VALUES ("'.$comment.'", "'.$cookName.'","'.$orderId.'")');
                    var_dump($testComment);
                } catch (Exception $ex) {
                    echo('not able to save the comment');
                }
                
            }
            
            if($sqlFinal){
                return $ing;
                var_dump('sql final success');
            }else{
                throw new Exception('failed to save order : '.$ing);
            }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

