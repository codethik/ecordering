<?
require_once("views/View.inc.php");

class CookInterfaceView extends View {
	
	/**
	 * Affiche une page sans contenu.
	 *
	 * Le modèle passé en paramètre est une instance de la classe 'Model'.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody($model) {
			$suppliersListArray=$model->getSuppliersList();
			$ingredientsListArray=$model->getIngredients();
            require("templates/cookinterface.inc.php");
        }

}
?>