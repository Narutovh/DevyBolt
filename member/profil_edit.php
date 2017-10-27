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
	if(isset($_SESSION['id'])){
		$requser = $bdd->prepare("SELECT * FROM member WHERE id = ?");
		$requser->execute(array($_SESSION['id']));
		$userinfo = $requser->fetch();
		
		if(isset($_POST['new_pseudo']) && !empty($_POST['new_pseudo']) && $_POST['new_pseudo'] != $userinfo['pseudo']){
			$new_pseudo = htmlspecialchars($_POST['new_pseudo']);
			$insertnewpseudo = $bdd->prepare("UPDATE member SET pseudo = ? WHERE id = ?");
			$insertnewpseudo->execute(array($new_pseudo,$_SESSION['id']));
			header("Location: profil.php?id=".$_SESSION['id']);
		}
	if(isset($_POST['new_pseudo']) && $_POST['new_pseudo'] == $userinfo['pseudo']){
		
	}
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

			
			<form method="POST" action="">
				<table>
					<tr>
						<td>
							<label for="new_pseudo">Pseudo :</label>
							<input type="text" name="new_pseudo" placeholder="Pseudo" id="new_pseudo" value="<?php if(isset($pseudo)){ echo $pseudo;} ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label for="new_mail">Mail :</label>
							<input type="email" name="new_mail" placeholder="Mail" id="new_mail">
						</td>
					</tr>
					<tr>
						<td>
							<label for="new_conf_mail">Confirmation du mail :</label>
							<input type="email" name="new_conf_mail" placeholder="Confirmation mail" id="new_conf_mail">
						</td>
					</tr>
					<tr>
						<td>
							<label for="new_password">Mot de passe :</label>
							<input type="password" name="new_password" placeholder="Mot de passe" id="new_password">
						</td>
					</tr>
					<tr>
						<td>
							<label for="new_conf_password">Confirmation du mot de passe :</label>
							<input type="password" name="new_conf_password" placeholder="Confirmation mot de passe" id="new_conf_password">
						</td>
					</tr>
				</table>
				<input type="submit" name="edit_form" value="Inscription">
			</form>
			<a href="log_out.php">log</a>
		</header>

	</body>
</html>
<?php
}else{
	header("Location: log_in.php");
}
?>