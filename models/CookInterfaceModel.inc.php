<?php
require_once('models/Model.inc.php');

/*
 * this model is used to load the dashboard of a cook
 */

class CookInterfaceModel extends Model {
    
    /*@var Arrays loaded from the main database
     * 
     */
    
    private $ingredients;
    private $suppliersList;
    private $ordersList;
    
    function __construct() {
      
        $this->ingredients = Array();
        $this->suppliersList = Array();
        $this->ordersList = Array();
    }
    
/*Setters*/
    
   

    function setIngredients($ingredients) {
        $this->ingredients = $ingredients;
    }

    function setSuppliersList($suppliersList) {
        $this->suppliersList = $suppliersList;
    }
    
    function setOrdersList($ordersList) {
        $this->ordersList = $ordersList;
    }
    
/*Getters*/
    


function getIngredients() {
    return $this->ingredients;
}

function getSuppliersList() {
    return $this->suppliersList;
}

function getOrdersList() {
    return $this->ordersList;
}




}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

