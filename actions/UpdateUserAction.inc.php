<?php

require_once("models/MessageModel.inc.php");
require_once("actions/Action.inc.php");

class UpdateUserAction extends Action {

	/**
	 * Met à jour le mot de passe de l'utilisateur en procédant de la façon suivante :
	 *
	 * Si toutes les données du formulaire de modification de profil ont été postées
	 * ($_POST['updatePassword'] et $_POST['updatePassword2']), on vérifie que
	 * le mot de passe et la confirmation sont identiques.
	 * S'ils le sont, on modifie le compte avec les méthodes de la classe 'Database'.
	 *
	 * Si une erreur se produit, le formulaire de modification de mot de passe
	 * est affiché à nouveau avec un message d'erreur.
	 *
	 * Si aucune erreur n'est détectée, le message 'Modification enregistrée.'
	 * est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
            
		if(isset($_POST['updatePassword'])&& isset($_POST['updatePassword2'])){
                    if(($_POST['updatePassword']) == ($_POST['updatePassword2'])){
                        $pass=$_POST['updatePassword'];
                        $login=$this->getSessionLogin();
                        $this->database->updateUser($login,$pass);
                        $this->setModel(new MessageModel());
                        $this->getModel()->setMessage('nouveau password enregistré!');
                        $this->getModel()->setLogin($login);
                        $this->setView(getViewByName('Message'));
                    }else{
                        $this->createUpdateUserFormView('Les mdp doivent correspondre');
                    }
                }else{
                    $this->createUpdateUserFormView('Remplissez les champs svp');
                }
	}

	private function createUpdateUserFormView($message) {
		$this->setModel(new MessageModel());
		$this->getModel()->setMessage($message);
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(getViewByName("UpdateUserForm"));
	}

}

?>
