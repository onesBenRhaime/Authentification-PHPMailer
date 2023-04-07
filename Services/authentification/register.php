<?php
include("../config/connexion.php");

if (isset($_POST["candidat_nom"]) &&	isset($_POST["candidat_prenom"])  &&	isset($_POST["candidat_email"]) &&	isset($_POST["candidat_motpasse"])){
	
	$prenom_fr_et =($_POST["candidat_prenom"]);
	$nom_fr_et=($_POST["candidat_nom"]);
	$email_et=($_POST["candidat_email"]);
	$pwd_et=($_POST["candidat_motpasse"]);
	$bytes = random_bytes(5);
	$token_et= bin2hex($bytes);
	
	$pwd_et_md5=md5($pwd_et);
	echo $pwd_et;
		try {
				$reponse = $bdd->prepare("INSERT INTO candidats (`etat`, `prenom`,  `nom`, `email`, `motpasse`,`token`) VALUES (?,?,?,?,?,?)");

				$reponse->execute(array('desactiver',$prenom_fr_et,$nom_fr_et,$email_et,$pwd_et_md5,$token_et));
				$reponse->closeCursor();
				// Envoi de mail en utilisant PHPMailer 'https://github.com/PHPMailer/PHPMailer/tree/5.2-stable'
				//_______________________________
				require './phpmailer/PHPMailerAutoload.php';
				// creation d un object mail
				$mail = new PHPMailer();
				// configurer SMTP
				$mail->isSMTP();
				$mail->Host = 'smtp.mailtrap.io';
				$mail->SMTPAuth = true;
				$mail->Username = '635a694a395b32';// recuperer à partir de mailtrap
				$mail->Password = 'd8e4005d9b6e90';
				$mail->SMTPSecure = 'tls';
				$mail->Port = 2525;

				$mail->setFrom('admin@PIL.com', 'You');
				$mail->addAddress($email_et, 'Me');
				$mail->Subject = 'Confimation de creation de compte!';
				// creer le contenue du mail
				$mail->isHTML(TRUE);
				$mail->Body = '<html></h1><br>Cliquez sur ce lien pour activer votre compte:<br><br> <a href="http://127.0.0.1/dsi21/Services/authentification/confirm.php?id='.$email_et.'&token='.$token_et.'">http://127.0.0.1/dsi21/Services/authentification/confirm.php?id='.$email_et.'&token='.$token_et.'</a></html>' ; 
				// envoyer le mail
				if(!$mail->send()){
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo '<script type="text/javascript">window.alert("Inscription  valide!  "); location.href = "../../login.html"; </script>';
				}
				//////////////////////////////////////////////////////
				//echo '<script type="text/javascript">window.alert("Inscription  valide. Réessayer  "); location.href = "../../login.html"; </script>';
				//header("location:../../login.html");
		} catch (Exception $e) {
			//echo $e->getMessage();
			echo '<script type="text/javascript">window.alert("Inscription non valide. Réessayer  "); location.href = "../../register.html"; </script>';
			
			
		}
	
}
else {
	echo "Error: ";
	header("location:../../login.html");
}


?>