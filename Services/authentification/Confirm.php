<?php
include("../config/connexion.php");

if (isset($_GET['id']) AND isset($_GET['token'])) // 
{
	
	try {
				$reponse = $bdd->prepare("UPDATE candidats SET etat='valide' WHERE email=? AND token = ?");

				$reponse->execute(array($_GET['id'],$_GET['token']));
				$reponse->closeCursor();
				echo '<script type="text/javascript">window.alert("Compte activer!  "); location.href = "../../login.html"; </script>';
		} catch (Exception $e) {
			//echo $e->getMessage();
			echo '<script type="text/javascript">window.alert("Inscription non valide. Réessayer  "); location.href = "../../register.html"; </script>';
			
			
		}

}
else // Il manque des paramètres, on avertit le visiteur
{
	header("location:../../login.html");
}
?>