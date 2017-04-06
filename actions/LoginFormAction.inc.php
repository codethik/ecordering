<?php

require_once("models/MessageModel.inc.php");
require_once("actions/Action.inc.php");

class LoginFormAction extends Action {

	/**
	 * Dirige l'utilisateur vers le formulaire d'inscription.
	 *
	 * @see Action::run()
	 */	
	public function run() {
		$this->setModel(new MessageModel());
		$this->setView(getViewByName("LoginForm"));
	}

}

?>

