
<?php
include("../config/connexion.php");


if((isset($_POST['candidat_email'])))
{
    $id =($_POST["candidat_email"]);

		
		$reponse = $bdd->prepare('SELECT * FROM candidats WHERE (`email`=?)&&(etat=?)');
		$reponse->execute(array($id,'valide'));
		
		
		$NumRows=$reponse->rowCount();
		
		
		if ($NumRows==1) {
			session_start();
			$row = $reponse->fetch();
			
			//envoi mail
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
				$mail->addAddress($row["email"], 'Me');
				$mail->Subject = 'Confimation de creation de compte!';
				// creer le contenue du mail
				$mail->isHTML(TRUE);
				$psw =($row["motpasse"]);
				$MP=md5($psw);
				$mail->Body = '<html></h1><br>Ton mot de passe est :<br><br> '.$MP.'</html>' ; 
				// envoyer le mail
				if(!$mail->send()){
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo '<script type="text/javascript">window.alert("consulter ton email  "); location.href = "../../login.html"; </script>';
				}
			$reponse->closeCursor();
			
		}
		else {
			$reponse->closeCursor();
			echo '<script type="text/javascript">window.alert("email invalide. Réessayer  "); location.href = "../../forgot-password.html"; </script>';
			
		}
	
	
	
}
  /* */
?>