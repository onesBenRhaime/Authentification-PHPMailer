<?php
/*--------------------------
Déconnexion
--------------------------
*/
session_start();
session_destroy();
header("location:login.html");


?>