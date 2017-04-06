<?php
require_once("models/Model.inc.php");
require_once("actions/Action.inc.php");
require_once("models/CookInterfaceModel.inc.php");
require_once("actions/LoginAction.inc.php");
require_once ('actions/LoginFormAction.inc.php');

class SendCookOrderAction extends Action{
    public function run() {
        
        if(isset($_POST['ing1']) && isset($_POST['mea1']) && isset($_POST['qty1']) && isset($_POST['delivDate'])){
            if($this->getSessionLogin()!== null){
                $cookName=$this->getSessionLogin();
                $ing1=($_POST['ing1']);
                $mea1=($_POST['mea1']);
                $qty1=($_POST['qty1']);
                $delivDate=($_POST['delivDate']);
                $this->database->cookOrderDispatcher($ing1,$qty1,$mea1,$cookName,$delivDate);
               
                //reload a cook interface
                $this->setModel(new CookInterfaceModel());
               
               if($this->getSessionLogin()===NULL){
                   @LoginFormAction::run();
                   return;
               }
                
                
               /* $this->setSessionLogin($this->getLogin());*/
                $this->getModel()->setIngredients($this->database->loadIngredients($this->getSessionLogin()));
                $this->getModel()->setSuppliersList($this->database->loadSuppliersList($this->getSessionLogin()));
                $this->getModel()->setOrdersList($this->database->loadOrdersList($this->getSessionLogin()));
          
                
                $this->setView(getViewByName('CookInterface'));
                
                
                
                }else{
                
                
                }
                
                
            }
        
        }
        
    }


?>