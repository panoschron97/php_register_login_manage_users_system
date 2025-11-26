<?php 

function is_user_logged_in()
{
return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true;
}

function redirect($location)
{
    header("Location: $location");
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

function emailexists($connection, $email)
{
$sql2 = "SELECT COUNT(*) AS number_of_rows FROM users WHERE email = '$email'";
$rows_sql2 = mysqli_query($connection, $sql2);
$rows_results2 = mysqli_fetch_assoc($rows_sql2);
return $rows_results2['number_of_rows'] > 0;
}

?>