<?php
/*--------------------------
D�connexion
--------------------------
*/
session_start();
session_destroy();
header("location:login.html");


?>