<?php

require_once("models/MessageModel.inc.php");
require_once("models/Survey.inc.php");
require_once("models/Response.inc.php");
require_once("actions/Action.inc.php");

class AddSurveyAction extends Action {

	/**
	 * Traite les données envoyées par le formulaire d'ajout de sondage.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * Sinon, la fonction ajoute le sondage à la base de données. Elle transforme
	 * les réponses et la question à l'aide de la fonction PHP 'htmlentities' pour éviter
	 * que du code exécutable ne soit inséré dans la base de données et affiché par la suite.
	 *
	 * Un des messages suivants doivent être affichés à l'utilisateur :
	 * - "La question est obligatoire.";
	 * - "Il faut saisir au moins 2 réponses.";
	 * - "Merci, nous avons ajouté votre sondage.".
	 *
	 * Le visiteur est finalement envoyé vers le formulaire d'ajout de sondage pour lui
	 * permettre d'ajouter un nouveau sondage s'il le désire.
	 * 
	 * @see Action::run()
	 */
	public function run() {
            if($this->getSessionLogin()===null){
                $this->setMessageView('vous devez être connecté');
                return;    
            }
            if(isset($_POST['questionSurvey'])){
                $questionSurvey=htmlentities($_POST['questionSurvey']);
                if(!empty($_POST['responseSurvey1']) && !empty($_POST['responseSurvey2'])){
                    $this->setModel(new Survey($this->getSessionLogin(),$questionSurvey));       
                   $id=1;
                    for($i=0;$i<5;$i++){
                        $step='responseSurvey'.$id;
                        $id++;
                    @$this->getModel()->addResponse($_POST[$step]);
                    }
                    $model=$this->getModel();
                   
                    if($this->database->saveSurvey($model)){
                        
                       if($this->database->saveResponse($model)){
                            /*
                             * @tofix: switch the db fnction perms to "private"; 
                            */ 
                            $this->setModel(new MessageModel);
                            $this->getModel()->setMessage('Ajoutez un nouveau sondage');
                            $this->setView(getViewByName('AddSurveyForm'));
                            return;
                        }else{
                           $this->setMessageView('Impossible de sauvegarder les reponses du sondage dans la BDD');
                        return; 
                        } 
                    }else{
                        $this->setMessageView('Impossible de sauvegarder le sondage dans la BDD');
                        return;
                    }
                }else{
                    $this->setMessageView('Il faut au moins deux réponses');
                    return;
                }
            }else{
                $this->setMessageView('La question est obligagtoire');
                return;
            }
            
		/* TODO  */
	}

}

?>
