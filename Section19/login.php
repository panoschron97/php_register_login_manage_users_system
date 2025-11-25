<?php 

include "partials/header.php";
include "partials/navigation.php";

//include "db.php";
//session_start();

if(is_user_logged_in())
{
    header("Location: admin.php");
    exit();
}

$error = "";
$success = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
$username = mysqli_real_escape_string($connection, $_POST["username"]);
$password = mysqli_real_escape_string($connection, $_POST["password"]);

$username = strtolower($username);
$password = strtolower($password);

$sql1 = "SELECT * FROM users WHERE username = '$username' LIMIT 1";

$rows_sql1 = mysqli_query($connection, $sql1);

if(mysqli_num_rows($rows_sql1) == 1)
{
$rows_results1 = mysqli_fetch_assoc($rows_sql1);

$hashed_password = $rows_results1["password"];

if(password_verify($password, $hashed_password))
{ 
$_SESSION["logged_in"] = true;
$_SESSION["username"] = $rows_results1["username"];   
sleep(5);
redirect("admin.php");
//$success =  "<br>Password is valid!";
//echo $success;
//$success = "";
//header("Location: admin.php");
exit();
}
else
{
$error = "<br>Wrong credentials!";
//echo $error;
}
}
else
{
 $error = "<br>User not found!";  
 //echo $error; 
}
}
?>


<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page!</title>
</head>
<body>-->

<div class= "container">
<div class="form-container">

    <form method="POST" action="">
    <h2>Login</h2>
    <?php if($error): ?>
    <p style = "color:red">   
    <?php echo $error; $error = ""; ?> </p> 
    <?php endif; ?>
    <label for="username">Username:</label>
    <input type="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <input type="submit" value="Login">
</form>
</div>
</div>

<!--</body>
</html>-->

<?php

include "partials/footer.php";

?>

<?php mysqli_close($connection); ?>