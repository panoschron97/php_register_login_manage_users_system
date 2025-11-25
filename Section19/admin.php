<?php
include "partials/header.php";
include "partials/navigation.php";

$error ="";

if(!is_user_logged_in())
{
    redirect("login.php");
}

$result = mysqli_query($connection, "SELECT id, username, email FROM users");

if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(isset($_POST['edit_user'])){

        $user_id = mysqli_real_escape_string($connection, $_POST['id']);
        $new_username = mysqli_real_escape_string($connection, $_POST['username']);
        $new_email = mysqli_real_escape_string($connection, $_POST['email']);

if(strlen($$new_username) > 15)
{
$error = "<br>Username must have max 15 characters!";
$_SESSION['message'] = $error;
$_SESSION['msg_type'] = "error";
sleep(5);
redirect("admin.php");
exit();
}
else
{
if(strlen($$new_email) > 50)
{
$error = "<br>Email must have max 50 characters!";
$_SESSION['message'] = $error;
$_SESSION['msg_type'] = "error";
sleep(5);
redirect("admin.php");
exit();  
}
else
{
if(!filter_var($new_email, FILTER_VALIDATE_EMAIL))
{
$error = "<br>Email isn't valid!";
$_SESSION['message'] = $error;
$_SESSION['msg_type'] = "error";
sleep(5);
redirect("admin.php");
exit();
}
else
{
if(userexists($connection, $new_username) && emailexists($connection, $new_email))
{
$error = "<br>Username and email already exists!";
$_SESSION['message'] = $error;
$_SESSION['msg_type'] = "error";
sleep(5);
redirect("admin.php");
exit();
}
else
{
if(userexists($connection, $new_username))
{
$error = "<br>Username already exists!";
$_SESSION['message'] = $error;
$_SESSION['msg_type'] = "error";
sleep(5);
redirect("admin.php");
exit();
}
else
{
if(emailexists($connection, $new_email))
{
$error = "<br>Email already exists!";
$_SESSION['message'] = $error;
$_SESSION['msg_type'] = "error";
sleep(5);
redirect("admin.php");
exit();
}
else
{
$new_username = strtolower($new_username);
$new_email = strtolower($new_email);

        $sql = "UPDATE users SET email = '$new_email', username = '$new_username' WHERE id = '$user_id'";
        $result = mysqli_query($connection, $sql);
        $query_status = check_query($connection, $result);

        if($query_status == true){
            $_SESSION['message'] = "User updated successfully to {$new_username}!";
            $_SESSION['msg_type'] = "success";
            sleep(5);
            redirect("admin.php");
            exit();
        }
}
}
}
}
}
}
}
elseif(isset($_POST['delete_user']))
    {
        $user_id = mysqli_real_escape_string($connection, $_POST['id']);
        $sql = "DELETE FROM users WHERE id = '$user_id'";
        $result = mysqli_query($connection, $sql);
        $query_status = check_query($connection, $result);
        if($query_status == true){

            $_SESSION['message'] = "User deleted successfully with id : {$user_id}!";
            $_SESSION['msg_type'] = "success";
            sleep(5);
            redirect("admin.php");
            exit();
        }

    }
}
?>
<h1>Manage users</h1>
<div class="container">

    <?php if(isset($_SESSION['message'])): ?>
        <div class="notification <?php echo $_SESSION['msg_type']; ?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['msg_type'])
            ?>
        </div>
    <?php endif; ?>
    <table class="user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $user['id'];  ?></td>
            <td><?php echo $user['username'];  ?></td>
            <td><?php echo $user['email'];  ?></td>
            </td>
            <td>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                    <button class="edit" type="submit" name="edit_user">Edit</button>
                </form>
                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <button class="delete" type="submit" name="delete_user">Delete</button>
                </form>
            </td>
        </tr>

        <?php endwhile; ?>

        </tbody>
    </table>
</div>

<?php

include "partials/footer.php";

?>