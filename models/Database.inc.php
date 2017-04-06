<?php
/*require_once("models/Survey.inc.php");
require_once("models/Response.inc.php");*/

class Database {

	public $connection;

	/**
	 * Ouvre la base de données. Si la base n'existe pas elle
	 * est créée à l'aide de la méthode createDataBase().
	 */
	public function __construct() {

              $host_name  = "db620657341.db.1and1.com";
              $database   = "db620657341";
              $user_name  = "dbo620657341";
              $password   = "Clique2015_";
            $this->connection =new mysqli ($host_name, $user_name, $password, $database);
		if (!$this->connection) die("impossible d'ouvrir la base de données");

		//$q = $this->connection->query('SELECT name FROM sqlite_master WHERE type="table"');

		//if (count($q->fetchAll())==0) {
		//	$this->createDataBase();
		//}
	}


	/**
	 * Crée la base de données ouverte dans la variable $connection.
	 * Elle contient trois tables :
	 * - une table users(nickname char(20), password char(50));
	 * - une table surveys(id integer primary key autoincrement,
	 *						owner char(20), question char(255));
	 * - une table responses(id integer primary key autoincrement,
	 *		id_survey integer,
	 *		title char(255),
	 *		count integer);
	 */
	private function createDataBase() {
		/* TODO  */
	}

	/**
	 * Vérifie si un pseudonyme est valide, c'est-à-dire,
	 * s'il contient entre 3 et 10 caractères et uniquement des lettres.
	 *
	 * @param string $nickname Pseudonyme à vérifier.
	 * @return boolean True si le pseudonyme est valide, false sinon.
	 */
	private function checkNicknameValidity($nickname) {
                $pattern='[a-zAZ]{3,10}';
                if(preg_match_all($pattern, $nickname)){
                   return true;  
                }else{
                   return false;
                }
	}

	/**
	 * Vérifie si un mot de passe est valide, c'est-à-dire,
	 * s'il contient entre 3 et 10 caractères.
	 *
	 * @param string $password Mot de passe à vérifier.
	 * @return boolean True si le mot de passe est valide, false sinon.
	 */
	private function checkPasswordValidity($password) {	
            /* TODO  */
		$pattern='.{3,10}';
                if(preg_match_all($pattern, $password)){
                   return true;  
                }else{
                   return false;
                }
	}

	/**
	 * Vérifie la disponibilité d'un pseudonyme.
	 *
	 * @param string $nickname Pseudonyme à vérifier.
	 * @return boolean True si le pseudonyme est disponible, false sinon.
	 */
	private function checkNicknameAvailability($nickname) {
		if($this->connection->query('SELECT nickname FROM users WHERE nickname="'.$nickname.'"')){
                    return false;
                }else{
                    return true;
                }
	}

	/**
	 * Vérifie qu'un couple (pseudonyme, mot de passe) est correct.
	 *
	 * @param string $nickname Pseudonyme.
	 * @param string $password Mot de passe.
	 * @return boolean True si le couple est correct, false sinon.
	 */
	public function checkPassword($nickname, $password) {
                $password=  md5($password);
               
                
                $sql=$this->connection->query('SELECT * FROM cooks WHERE nickname="'.$nickname.'" AND password="'.$password.'"');
		$result= $sql->fetch_all();
                
             
                if(@is_null($result[0][0])){
                    $sql=$this->connection->query('SELECT * FROM suppliersFullList WHERE name="'.$nickname.'" AND password="'.$password.'"');
                    $result= $sql->fetch_all();
                    if(@is_null($result[0][0])){
                        return false;
                    }else{
                        return 'supplier';
                    }
                    
                }else{
                    return 'cook';
                }
	}

	/**
	 * Ajoute un nouveau compte utilisateur si le pseudonyme est valide et disponible et
	 * si le mot de passe est valide. La méthode peut retourner un des messages d'erreur qui suivent :
	 * - "Le pseudo doit contenir entre 3 et 10 lettres.";
	 * - "Le mot de passe doit contenir entre 3 et 10 caractères.";
	 * - "Le pseudo existe déjà.".
	 *
	 * @param string $nickname Pseudonyme.
	 * @param string $password Mot de passe.
	 * @return boolean|string True si le couple a été ajouté avec succès, un message d'erreur sinon.
	 */
	public function addUser($nickname, $password) {
		if(checkNicknameValidity($nickname)){
                    if(checkPasswordValidity($password)){
                        
                         if($this->connection->query('INSERT INTO users(nickname, password) VALUES ("'.$nickname.'","'.$password.'")')){
                             return true;
                         }else{
                             return false;
                         }
                        
                    }else{
                        return 'Le password est invalide';
                    }
                }else{
                    return 'Le pseudo est valide';
                }
		
	}

	/**
	 * Change le mot de passe d'un utilisateur.
	 * La fonction vérifie si le mot de passe est valide. S'il ne l'est pas,
	 * la fonction retourne le texte 'Le mot de passe doit contenir entre 3 et 10 caractères.'.
	 * Sinon, le mot de passe est modifié en base de données et la fonction retourne true.
	 *
	 * @param string $nickname Pseudonyme de l'utilisateur.
	 * @param string $password Nouveau mot de passe.
	 * @return boolean|string True si le mot de passe a été modifié, un message d'erreur sinon.
	 */
	public function updateUser($nickname, $password) {
		/* TODO  */
		return true;
	}

	/**
	 * Sauvegarde un sondage dans la base de donnée et met à jour les indentifiants
	 * du sondage et des réponses.
	 *
	 * @param Survey $survey Sondage à sauvegarder.
	 * @return boolean True si la sauvegarde a été réalisée avec succès, false sinon.
	 */
	public function saveSurvey(&$survey) {
           $sql=$this->connection->query('SELECT MAX(id) FROM surveys');
           $result=$sql->fetch();// Array
           var_dump($result);
           $id=(($result[0]));
           $survey->setId($id);
           
            $this->connection->query('INSERT INTO surveys VALUES ("'.$survey->getId().'","'.$survey->getOwner().'","'.$survey->getQuestion().'")');
            $responses=$survey->getResponses();
            foreach ($responses as $response) {
                $this->connection->query('INSERT INTO responses VALUES ("'.$survey->getId().'","'.$response.'"');
                
            }
               return true;
            
           
		
	}

	/**
	 * Sauvegarde une réponse dans la base de donnée et met à jour son indentifiant.
	 *
	 * @param Response $response Réponse à sauvegarder.
	 * @return boolean True si la sauvegarde a été réalisée avec succès, false sinon.
	 */
	public function saveResponse(&$response) {
		
            var_dump($response);
                $sql=$this->connection->query('SELECT MAX(id) FROM responses');
                $result=$sql->fetch();// Array
                $id=($result[0]); //Type INT
                $response->setId($id);
                foreach ($response->getResponses() as $title){       
                    $this->connection->query('INSERT INTO responses VALUES ("'.$response->getId().'",""'.$title.'")');
                }
                return true;
	}

	/**
	 * Charge l'ensemble des sondages créés par un utilisateur.
	 *
	 * @param string $owner Pseudonyme de l'utilisateur.
	 * @return array(Survey)|boolean Sondages trouvés par la fonction ou false si une erreur s'est produite.
	 */
	public function loadSurveysByOwner($owner) {
            $sql=$this->connection->query('SELECT * FROM surveys WHERE owner="'.$owner.'"');
            $arraySurveys=$this->connection->fetchAll($sql);
            return $arraySurveys;//type Array
            /* TODO  */
            
	}

	/**
	 * Charge l'ensemble des sondages dont la question contient un mot clé.
	 *
	 * @param string $keyword Mot clé à chercher.
	 * @return array(Survey)|boolean Sondages trouvés par la fonction ou false si une erreur s'est produite.
	 */
	public function loadSurveysByKeyword($keyword) {
            $sql=$this->connection->query('SELECT * FROM surveys WHERE question LIKE "%'.$keyword.'%"');
            $arraySurveys=$this->connection->fetchAll($sql);
            return $arraySurveys;//type Array
		/* TODO  */
	}


	/**
	 * Enregistre le vote d'un utilisateur pour la réponse d'indentifiant $id.
	 *
	 * @param int $id Identifiant de la réponse.
	 * @return boolean True si le vote a été enregistré, false sinon.
	 */
	public function vote($id) {
            $sql=$this->connection->query('select count FROM responses where id="'.$id.'"');
            $result=fetch($sql);//type Array -> last value of count
            $result=($result[0]*1)+1; //type Int
            $sql=  $this->connection->query('UPDATE responses SET count="'.$result.'" WHERE id="'.$id.'"');
		/* TODO  */
	}

	/**
	 * Construit un tableau de sondages à partir d'un tableau de ligne de la table 'surveys'.
	 * Ce tableau a été obtenu à l'aide de la méthode fetchAll() de PDO.
	 *
	 * @param array $arraySurveys Tableau de lignes.
	 * @return array(Survey)|boolean Le tableau de sondages ou false si une erreur s'est produite.
	 */
	private function loadSurveys($arraySurveys) {
		$surveys = array();
		/* TODO  */
		return $surveys;
	}

	/**
	 * Construit un tableau de réponses à partir d'un tableau de ligne de la table 'responses'.
	 * Ce tableau a été obtenu à l'aide de la méthode fetchAll() de PDO.
	 *
	 * @param array $arraySurveys Tableau de lignes.
	 * @return array(Response)|boolean Le tableau de réponses ou false si une erreur s'est produite.
	 */
	private function loadResponses(&$survey, $arrayResponses) {
		/* ToDo  */
	}
        
        /*
         * Load the suppliers ingredients list from db. PDO->FetchAll
         * @param Text | supplier name
         * @return array(Ingredients)
         * 
         */
        public function loadSuppliersIngredients($supplier){
            $sql=$this->connection->query('SELECT ingredient, measure, id, category FROM ingredients WHERE supplier="'.$supplier.'"');
            $results=$sql->fetch_all();
            if(is_array($results)){
                return $results;
            }else{
                throw new Exception('Model | loadSuppliersIngredients function did not return an object Array');
            }
        }
        /** PROVISOIRE **/
        
        public function loadIngredients(){
            $sql=$this->connection->query('SELECT ingredient, supplier, measure, id FROM ingredients');
            $results=$sql->fetch_all();
            if(is_array($results)){
                return $results;
            }else{
                throw new Exception('Model | loadSuppliersIngredients function did not return an object Array');
            }
        }
        
        
        
        /*
         * Load the suppliers list from db. PDO->FetchAll
         * @param Text | cooks name
         * @return array(Suppliers)
         * 
         */
        public function loadSuppliersList($cookName){
            $sql=$this->connection->query('SELECT name,category FROM suppliersList WHERE cookName="'.$cookName.'"');
            $results=$sql->fetch_all();
            if(is_array($results)){
                return $results;
            }else{
                throw new Exception('Model | loadSuppliersList function did not return an object Array');
            }
        }
        
        /*
         * Load the number of deliveries requests. list from db. PDO->FetchAll
         * @param Text | supplier name
         * @return Int
         * 
         */
        public function loadNotifOrders($supplierName){
            $sql=$this->connection->query('SELECT COUNT(*) FROM orders WHERE supplier="'.$supplierName.'"');
            $results=$sql->fetch_all();
            if(is_array($results)){
                return $results;
            }else{
                throw new Exception('Model | loadNotifOrders function did not return an object Array');
            }
        }
        
        
        
        /* Load the orders previously made by a cook
         * @param Text | name of the logged cook
         * @return Array |the results of ingredients rdered, the status and the date of requested delivery
         */
        
        public function loadOrdersList($cookname) {
            $sql=$this->connection->query('SELECT id, count(ingredient), delivery, restaurant FROM orders  GROUP BY delivery having restaurant="'.$cookname.'" AND delivery >= DATE( NOW() ) order by delivery');
            $results=$sql->fetch_all();
            if(is_array($results)){
                return $results;
            }else{
                throw new Exception('Model | loadSuppliersList function did not return an object Array');
            }
        }
         /* Load the commments previously made by a cook
         * @param Text | name of the logged supplier
         * @return Array |the id of each order linked and the comment itself
          * WARNING : This function is only used for supplier. Cooks'one is an AJAX file.
         */
        
        
        
        public function loadCommentsList($supplier) {
            $sql=$this->connection->query('Select id_order, comment FROM orders, comments WHERE id_order=orders.id AND supplier="'.$supplier.'"');
            
            $results=$sql->fetch_all();
            if(is_array($results)){
                return $results;
            }else{
                throw new Exception('Model | loadCommentsList function did not return an object Array');
            }
        }
        
        
        
        /* Load the orders for tommorow, grouped by ingredient and total amount of each
         * @param Text | name of the logged supplier
         * @return Array |the results of ingredients rdered, the status and the date of requested delivery
         */
        
        public function loadTommorowsList($supplier) {
            date_default_timezone_set('UTC');
            $tommorow= date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
            
            $sql=$this->connection->query('SELECT ingredient, SUM(quantity), measure FROM orders WHERE supplier="'.$supplier.'" AND delivery = "'.$tommorow.'" GROUP BY ingredient');
            $results=$sql->fetch_all();
            if(is_array($results)){
                return $results;
            }else{
                throw new Exception('Model | loadSuppliersList function did not return an object Array');
            }
        }
        
        
        /* Load the orders previously made by a cook
         * @param Text | name of the logged cook
         * @return Array |the results of ingredients rdered, the status and the date of requested delivery
         */
        
        public function loadSuppliersOrdersList($suppliername) {
            $sql=$this->connection->query('select delivery, ingredient, restaurant, status, id, quantity, measure from orders where supplier="'.$suppliername.'" ORDER BY delivery');
            $results=$sql->fetch_all();
            if(is_array($results)){
                return $results;
            }else{
                throw new Exception('Model | loadSuppliersList function did not return an object Array');
            }
        }
        
        /*
         * @see: SendCookOrderAction::run()
         * @params: $ing => ingredient name / $qty = quantity of ... / $cookName = name of the orderer
         * @return:Boolean / TRUE : if the function succeed in save every params into  the DB
         */
        
        public function cookOrderDispatcher($ing,$qty,$cookName,$delivDate){
            //Get the category
            $sqlA=$this->connection->query('SELECT DISTINCT category FROM ingredients WHERE ingredient="'.$ing.'"');
            $sqlA=$sqlA->fetch_all();
            $cat=$sqlA[0][0];
            
            //Get the measure
            $sqlA2=$this->connection->query('SELECT DISTINCT measure FROM ingredients WHERE ingredient="'.$ing.'"');
            $sqlA2=$sqlA2->fetch_all();
            $mea=$sqlA2[0][0];
            //Get the supplier associated to this category
            $sqlB=$this->connection->query('SELECT DISTINCT supplier FROM ingredients WHERE ingredient="'.$ing.'"');
            $sqlB=$sqlB->fetch_all();
            $sup=$sqlB[0][0];
            //If the supplier is not an active user, send an invitation, else, go to the stamping step
            $sqlC=$this->connection->query('SELECT * FROM suppliersFullList WHERE  name="'.$sup.'" AND active="TRUE"');
            $sqlC=$sqlC->fetch_all();
            if(empty($sqlC[0][0])){
                return 'mail unset';
                // !!!!! TODO: The function needs to be set with dynamic variables. !!!!!
                // The message
                $message = "Bonjour,\r\Vous avez reçu une commande sur Ecordering, nouvelle plateforme de commande instantané pour la restauration. Il semblerait que vous ne soyez pas encore inscrit. Ne vous inuqietez pas, c'est gratuit et beaucoup plus simple pour gerer vos commandes.\r\nLine 3";

                // In case any of our lines are larger than 70 characters, we should use wordwrap()
                $message = wordwrap($message, 70, "\r\n");

                // Send
                mail('supplier@example.com', 'le restaurant Marc vous a envoyé une commande sur Ecordering', $message);
            }
            //The order is prepared and stamped with the right supplier
            $stampedOrder='INSERT INTO orders (ingredient,delivery,restaurant,supplier,quantity,measure) VALUES("'.$ing.'", "'.$delivDate.'","'.$cookName.'","'.$sup.'",'.$qty.',"'.$mea.'")';
            $sqlFinal=$this->connection->query($stampedOrder);
            if($sqlFinal){
                return $ing;
            }else{
                throw new Exception('failed to save order : '.$ing);
            }
            
            
  
        }
        
}

?>
