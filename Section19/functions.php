<?php 

function is_user_logged_in()
{
return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true;
}

function redirect($location)
{
    header("Location: login.php");
    exit();
}

function setactiveclass($pagename)
{
$current_page = basename($_SERVER["PHP_SELF"]);
return ($current_page === $pagename) ? "active" : "";
}

function getpageclass()
{
return basename($_SERVER["PHP_SELF"], ".php");
}

function userexists($connection, $username)
{
$sql1 = "SELECT COUNT(*) AS number_of_rows FROM users WHERE username = '$username'";
$rows_sql1 = mysqli_query($connection, $sql1);
$rows_results1 = mysqli_fetch_assoc($rows_sql1);
return $rows_results1['number_of_rows'] > 0;
}

function emailexists($connection, $email)
{
$sql2 = "SELECT COUNT(*) AS number_of_rows FROM users WHERE email = '$email'";
$rows_sql2 = mysqli_query($connection, $sql2);
$rows_results2 = mysqli_fetch_assoc($rows_sql2);
return $rows_results2['number_of_rows'] > 0;
}

?>