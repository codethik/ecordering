<form method="post" action="<? echo $_SERVER['PHP_SELF']; ?>?action=Logout" >
	<div class="nickname"><? echo $model->getLogin(); ?></div> 
	<input class="submit" type="submit" value="Déconnexion" />
</form>
