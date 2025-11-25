<?php 

//include "db.php";

include "partials/header.php";
include "partials/navigation.php";

$error = "";
$success = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
$username = mysqli_real_escape_string($connection, $_POST["username"]);
$password = mysqli_real_escape_string($connection, $_POST["password"]);
$email = mysqli_real_escape_string($connection, $_POST["email"]);
$confirm_password = mysqli_real_escape_string($connection, $_POST["confirm_password"]);

if(strlen($username) > 15)
{
$error = "<br>Username must have max 15 characters!";
//echo $error;
//$error = "";
}
else
{
if(strlen($email) > 50)
{
$error = "<br>Email must have max 50 characters!";
//echo $error;
//$error = "";   
}
else
{
if(strlen($password) > 60)
{
$error = "<br>Password must have max 60 characters!";
//echo $error;
//$error = "";   
}
else
{
if($password !== $confirm_password)
{
$error = "<br>Password don't match!";
//echo $error;
//$error = "";
}
else
{
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
$error = "<br>Email isn't valid!";
//echo $error;
//$error = "";
}
else
{
if(userexists($connection, $username) && emailexists($connection, $email))
{
    $error = "<br>Username and email already exists!";
    //echo $error;
    //$error = "";
}
else
{
if(userexists($connection, $username))
{
    $error = "<br>Username already exists!";
    //echo $error;
    //$error = "";
}
else
{
if(emailexists($connection, $email))
{
    $error = "<br>Email already exists!";
    //echo $error;
    //$error = "";
}
else
{
$username = strtolower($username);
$password = strtolower($password);
$email = strtolower($email);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql3 = "INSERT INTO users(username, password, email) VALUES('$username', '$hashed_password', '$email')";
if(mysqli_query($connection, $sql3))
{
    /*$success = "<br>Data inserted successfully!";
    echo $success;
    $error = "";
    echo "<br>Redirecting in 5 seconds to home page!";
    sleep(5);
    header("Location: login.php");
    exit();*/

    $_SESSION["logged_in"] = true;
    $_SESSION["username"] = $username; 
    //$success =  "<br>Password is valid!";
    //echo $success;
    //$success = "";
    sleep(5);
    //header("Location: admin.php");
    redirect("admin.php");
    exit();
}
else
{
    $error = "<br>Something went wrong! -> " . mysqli_error($connection);
   //echo $error;
   //$error = "";
}
}
}
}
}
}
}
}
}
}
?>


<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page!</title>
</head>
<body>-->

<div class = "container">
<div class="form-container">

    <form method="POST" action="">
    <h2>Create your account</h2>
    <?php if($error): ?>
    <p style = "color:red">   
    <?php echo $error; $error = ""; ?> </p> 
    <?php endif; ?>
    <label for="username">Username:</label>
    <input value="<?php echo isset($username) ? $username : ""; ?>" placeholder="Enter your username" type="username" name="username" required>
    <label for="password">Password:</label>
    <input placeholder="Enter your password" type="password" name="password" required>
    <label for="email">Email:</label>
    <input value="<?php echo isset($email) ? $email : ""; ?>" placeholder="Enter your email" type="email" name="email" required>
    <label for="confirm_password">Confirm password:</label>
    <input placeholder="Confirm your password" type="password" name="confirm_password" required>
    <input type="submit" value="Register">
</form>
</div>
</div>

<!--</body>
</html>-->

<?php

include "partials/footer.php";

?>

<?php mysqli_close($connection); ?>