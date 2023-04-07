
<?php

include("../config/connexion.php");


if((isset($_POST['candidat_email'])))
{
    $id =($_POST["candidat_email"]);
    $psw =($_POST["candidat_pwd"]);
	$psw_md5=md5($psw);

	if ($id&&$psw)
	{
		
		$reponse = $bdd->prepare('SELECT * FROM candidats WHERE (`email`=?)&&(`motpasse`=?)&&(etat=?)');
		$reponse->execute(array($id, $psw_md5,'valide'));
		
		
		$NumRows=$reponse->rowCount();
		
		
		if ($NumRows==1) {
			session_start();
			$row = $reponse->fetch();
			$_SESSION["id"]  = $row["idcandidat"];
			$_SESSION["prenom"]= $row["prenom"];
			$_SESSION["nom"]= $row["nom"];
			$_SESSION["email"]= $row["email"];
			//echo '<br>';
			
			
			
			$reponse->closeCursor();
			header("location:../../index.php");
		}
		else {
			$reponse->closeCursor();
			echo '<script type="text/javascript">window.alert("Identifiant ou mot de passe incorrect. R�essayer  "); location.href = "../../login.html"; </script>';
			
		}
	
	}
	else{
			header("location:../../login.html");
		}
	
}
  /* */
?>





