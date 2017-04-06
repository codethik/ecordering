<?php

require_once("models/Model.inc.php");
require_once("actions/Action.inc.php");
require_once("models/CookInterfaceModel.inc.php");
require_once('models/SupplierInterfaceModel.inc.php');

class LoginAction extends Action {

	/**
	 * Traite les données envoyées par le visiteur via le formulaire de connexion
	 * (variables $_POST['nickname'] et $_POST['password']).
	 * Le mot de passe est vérifié en utilisant les méthodes de la classe Database.
	 * Si le mot de passe n'est pas correct, on affecte la chaîne "erreur"
	 * à la variable $loginError du modèle. Si la vérification est réussie,
	 * le pseudo est affecté à la variable de session et au modèle.
	 *
	 * @see Action::run()
	 */
	public function run() {

            if($userKind=$this->database->checkPassword($_POST['nickname'],$_POST['password'])){
                
                
                if($userKind==='cook'){
                $this->setModel(new CookInterfaceModel());
                $this->setSessionLogin($_POST['nickname']);
                
                
               /* $this->setSessionLogin($this->getLogin());*/
                $this->getModel()->setIngredients($this->database->loadIngredients($this->getSessionLogin()));
                $this->getModel()->setSuppliersList($this->database->loadSuppliersList($this->getSessionLogin()));
                $this->getModel()->setOrdersList($this->database->loadOrdersList($this->getSessionLogin()));
                
                
                $this->setView(getViewByName('CookInterface'));
                }else if($userKind==='supplier'){
                    $this->setModel(new SupplierInterfaceModel());
                    $this->setSessionLogin($_POST['nickname']);
                    $this->getModel()->setNotifOrders($this->database->loadNotifOrders($this->getSessionLogin()));
                    $this->getModel()->setOrdersList($this->database->loadSuppliersOrdersList($this->getSessionLogin()));
                    $this->getModel()->setTommorowsList($this->database->loadTommorowsList($this->getSessionLogin()));
                    $this->getModel()->setIngredientsList($this->database->loadSuppliersIngredients($this->getSessionLogin()));
                    $this->getModel()->setCommentsList($this->database->loadCommentsList($this->getSessionLogin()));
                    
                    $this->setView(getViewByName('SupplierInterface'));
                    
                    
                }
            } else {
                
         
                if($this->setSessionLogin($this->getSessionLogin())===NULL){
                    $this->setModel(new Model());
                    $this->setView(getViewByName('LoginForm'));
                    echo('error login');
                    $this->getModel()->setLoginError('Erreur dans l\'identifiant ou le mot de passe');
                    echo('error login');
                
                } else if($this->getSessionUserKind()==='cook'){
                     $this->setModel(new CookInterfaceModel());
                     $this->setSessionLogin($this->getSessionLogin());
                     $this->getModel()->setIngredients($this->database->loadIngredients($this->getSessionLogin()));
                     $this->getModel()->setSuppliersList($this->database->loadSuppliersList($this->getSessionLogin()));
                     $this->getModel()->setOrdersList($this->database->loadOrdersList($this->getSessionLogin()));
                    
                     $this->setView(getViewByName('CookInterface'));
                } else {
                    $this->setModel(new SupplierInterfaceModel());
                     $this->setSessionLogin($this->getSessionLogin());
         
                     $this->getModel()->setOrdersList($this->database->loadSuppliersOrdersList($this->getSessionLogin()));
                     $this->setView(getViewByName('SupplierInterface'));
                }
                
            }
            
            
	}

}

?>
