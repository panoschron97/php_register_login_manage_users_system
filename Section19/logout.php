<?php 

include "functions.php";

session_start();

$_SESSION = [];

session_destroy();

redirect("lesson19.php");

?>