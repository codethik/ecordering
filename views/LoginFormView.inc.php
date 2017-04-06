<?
require_once("views/View.inc.php");

class LoginFormView extends View {
	
	/**
	 * Affiche le formulaire d'inscription.
	 * Le modèle passé en paramètre est une instance de la
	 * classe 'MessageModel'.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody($model) {
		require("templates/loginform.inc.php");
	}

}
?>

