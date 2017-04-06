<?php
require_once('models/Model.inc.php');

class SupplierInterfaceModel extends Model {
    
    /*@var Arrays loaded from the main database
     * 
     */
    
  
    private $ordersList;
    private $notifOrders;
    private $tommorowsList;
    private $ingredientsList;
    private $commentsList;
    
    function __construct() {
      
       
        $this->ordersList = Array();
        $this->notifOrders =0;
        $this->tommorowsList= Array();
        $this->ingredientsList=Array();
        $this->commentsList=Array();
    }
/*Setters*/
    
   
    
    function setOrdersList($ordersList) {
        $this->ordersList = $ordersList;
    }
    
    function setIngredientsList($ingredients){
        $this->ingredientsList = $ingredients;
    }
    
    function setNotifOrders($notifOrders){
        if(empty($notifOrders) || $notifOrders===0){
            $this->notifOrders = 0;
        }else{
            $this->notifOrders = $notifOrders;
        }
    }
    
    function setTommorowsList($tommorowsList){
        $this->tommorowsList = $tommorowsList;
    }
    
    function setCommentsList($commentsList){
        $this->commentsList = $commentsList;
    }
    
/*Getters*/
    



function getOrdersList() {
    return $this->ordersList;
}

function getNotifOrders() {
    return $this->notifOrders;
}

function getTommorowsList() {
    return $this->tommorowsList;
}

function getIngredientsList() {
    return $this->ingredientsList;
}
function getCommentsList(){
    return $this->commentsList;
}

}
?>