<?php
session_start();
/** Debug superglobal settings **/



/** End of superglobals settings**/


function getActionByName($name) {
	$name .= 'Action';
	require("actions/$name.inc.php");
	return new $name();
}

function getViewByName($name) {
	$name .= 'View';
	require("views/$name.inc.php");
	return new $name();
}

function getAction() {
	if (!isset($_REQUEST['action'])) $action = 'Default';
	else $action = $_REQUEST['action'];

	$actions = array('Default',
			'SignUpForm',
			'SignUp',
			'Logout',
			'Login',
                        'LoginForm',
			'UpdateUserForm',
			'UpdateUser',
			'AddSurveyForm',
			'AddSurvey',
                        'SendCookOrder'/*,
			'GetMySurveys',
			'Search',
			'Vote'*/);

	if (!in_array($action, $actions)) $action = 'Default';
	return getActionByName($action);
}


$action = getAction();
$action->run();
$view = $action->getView();
$model = $action->getModel();
$view->run($model);
?>

