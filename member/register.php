<!--
/**
*@version HTML 5
*/
-->
<!DOCTYPE html>
<?php
	/* Connexion à la base de données */
	include '../database/config.php';
	/* Si on appuie sur le bouton d'inscription alors continuer */
	if(isset($_POST['register_form'])){
		/* On sécurise les variables pour éviter les attaques par injection de code */
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$conf_mail = htmlspecialchars($_POST['conf_mail']);
		$password = sha1($_POST['password']);
		$conf_password = sha1($_POST['conf_password']);
		/* Si les champs ne sont pas vides */
		if(!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['conf_mail']) && !empty($_POST['password']) && !empty($_POST['conf_password'])){

			$pseudolength = strlen($pseudo);
			/* Si la taille ne dépasse pas 255 caracteres */
			if($pseudolength <= 255){
				/* Si le mail correspond au mail de confirmation */
				if($mail == $conf_mail){
					/* Si il s'agit bien d'une adresse email valide */
					if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
						$reqmail = $bdd->prepare("SELECT mail FROM member WHERE mail = ?");
						$reqmail->execute(array($mail));
						/* On récupère le nombre de résultats possibles: 1 si il existe, o sinon */
						$mailexist = $reqmail->rowCount();
						/* Si le mail existe dans la base de données */
						if ($mailexist == 0){
							/* Si le mot de passe correspond au mot de passe de confirmation */
							if($password == $conf_password){
								$reqinsert = $bdd->prepare("INSERT INTO member(pseudo, mail, password) VALUES (?, ?, ?)");
								$reqinsert->execute(array($pseudo,$mail,$password));
							}else{
								$erreur = "";
							}
						}else{
							$erreur = "";
						}
					}
					else{
						$erreur = "";
					}
				}
				else{
					$erreur = "";
				}
			}
			else{
				$erreur = "";
			}
		}
		else{
			$erreur = "";
		}
	}
?>

<html>
	<head>
		<title>Inscription - Devybolt</title>
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
				<table>
					<tr>
						<td>
							<label for="pseudo">Pseudo :</label>
							<input type="text" name="pseudo" placeholder="Pseudo" id="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo;} ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label for="mail">Mail :</label>
							<input type="email" name="mail" placeholder="Mail" id="mail">
						</td>
					</tr>
					<tr>
						<td>
							<label for="conf_mail">Confirmation du mail :</label>
							<input type="email" name="conf_mail" placeholder="Confirmation mail" id="conf_mail">
						</td>
					</tr>
					<tr>
						<td>
							<label for="password">Mot de passe :</label>
							<input type="password" name="password" placeholder="Mot de passe" id="password">
						</td>
					</tr>
					<tr>
						<td>
							<label for="conf_password">Confirmation du mot de passe :</label>
							<input type="password" name="conf_password" placeholder="Confirmation mot de passe" id="conf_password">
						</td>
					</tr>
				</table>
				<input type="submit" name="register_form" value="Inscription">
			</form>
			<?php 
				if(isset($erreur)){
					echo $erreur;
				} 
			?>
		</header>

	</body>
</html>
