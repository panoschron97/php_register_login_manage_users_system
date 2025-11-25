<?php 
include "db.php";
include "functions.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login application with sql and php!</title>
    <link rel="stylesheet" href="css\\style.css">
    <link rel="stylesheet" href="css\\admin.css">
</head>
<body class= "<?php echo getpageclass(); ?>">