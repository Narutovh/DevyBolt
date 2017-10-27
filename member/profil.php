<!--
/**
*@version HTML 5
*/
-->
<!DOCTYPE html>
<?php
	session_start();
	/* Connexion à la base de données */
	include '../database/config.php';
	/* Si l'id existe et l'id supérieur à 0 */
	if(isset($_GET['id']) AND $_GET['id'] > 0){
		/* On récupère et on sécurise la variable id pour avoir une variable de type Int */
		$getid = intval($_GET['id']);
		$requser = $bdd->prepare('SELECT id, pseudo FROM member WHERE id = ?');
		$requser->execute(array($getid));
		$userinfo = $requser->fetch();
?>

<html>
	<head>
		<title>Profil de <?php echo $userinfo['pseudo']; ?>- Devybolt</title>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--<meta http-equiv="refresh" content="30"> -->
		<link rel="stylesheet" href="mystyle.css">
	</head>
	
	<body>

		<header>

			<p>Pseudo = <?php echo $userinfo['pseudo']; ?></p>
			<?php 
				/* Si l'd de la base de données correspond à l'id de session alors on est sur le profil connecté */
				if(isset($_SESSION['id']) && $userinfo['id'] == $_SESSION['id']){
					echo "edit";
				} 
			?>
			<a href="log_out.php">log</a>
		</header>

	</body>
</html>
<?php
}
?>