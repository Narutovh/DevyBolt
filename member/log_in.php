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
	/* Si on appuie sur le bouton de connexion alors continuer */
	if(isset($_POST['log_in_form'])){
		/* On sécurise les variables pour éviter les attaques par injection de code */
		$log_mail = htmlspecialchars($_POST['log_mail']);
		$log_password = sha1($_POST['log_password']);
		/* Si les champs ne sont pas vides */
		if(!empty($log_mail) && !empty($log_password)){
			$requser = $bdd->prepare("SELECT * FROM member WHERE mail = ? AND password = ?");
			$requser->execute(array($log_mail,$log_password));
			/* On récupère le nombre de résultats possibles: 1 si il existe, o sinon */
			$userexist = $requser->rowCount();
			if($userexist == 1){
				/* On récupère les informations dans la variable userinfo */
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['pseudo'] = $userinfo['pseudo'];
				$_SESSION['mail'] = $userinfo['mail'];
				/* On redirige l'utilisateur sur sa page de profil */
				header("Location: profil.php?id=".$_SESSION['id']);
			}else{

			}
		}else{
			
		}
	}
?>

<html>
	<head>
		<title>Connexion - Devybolt</title>
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

			<form method="POST" action="">
				<input type="email" name="log_mail" placeholder="Mail">
				<input type="password" name="log_password" placeholder="Mot de passe">
				<input type="submit" name="log_in_form" value="Connexion">
			</form>
			<?php 
				if(isset($erreur)){
					echo $erreur;
				} 
			?>
		</header>

	</body>
</html>
