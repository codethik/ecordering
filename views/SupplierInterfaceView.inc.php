<?php

require_once("views/View.inc.php");

class SupplierInterfaceView extends View {
	
	/**
	 * Affiche une page sans contenu.
	 *
	 * Le modèle passé en paramètre est une instance de la classe 'Model'.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody($model) {
			$ordersArray=$model->getOrdersList();
			$delivNum=$model->getNotifOrders();
			$tommorowsArray=$model->getTommorowsList();
			$ingredientsListArray=$model->getIngredientsList();
			$commentsArray=$model->getCommentsList();
            require("templates/supplierinterface.inc.php");
        }
        
}        
?>
