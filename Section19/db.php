    <?php
    //echo "<br>Ok!<br>";
    //echo "<br>----------<br>";
    $host = "localhost";
    $username = "root";
    $password = "27031997";
    $database = "database_register_login";

    $connection = mysqli_connect($host, $username, $password, $database);

    /*if(!$connection)
    {
        die("<br>Connection failed " . mysqli_connect_error());
    }
    else
    {
        echo "<br>Connected!";
    }*/

    /*if($connection)
    {
     echo "<br>Connected!";
    }
    else
    {
     echo "<br>Not connected! -> " . mysqli_connect_error($connection);   
    }
    //mysqli_connect("localhost", "root", "27031997", "database_register_login");
    //new mysqli("localhost", "root", "27031997", "database_register_login");
    //new PDO("mysql:host=localhost", "root", "27031997", "database_register_login");
    
    echo "<br><br>----------<br>";*/

function check_query($result)
{
global $connection;
if($result)
{
    return "<br>Error " . mysqli_error($connection);
}
else
{
    return true;
}
}

function userexists($connection, $username)
{
$sql1 = "SELECT COUNT(*) AS number_of_rows FROM users WHERE username = '$username'";
$rows_sql1 = mysqli_query($connection, $sql1);
$rows_results1 = mysqli_fetch_assoc($rows_sql1);
return $rows_results1['number_of_rows'] > 0;
}

function create_user($connection, $username, $email, $password)
{
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql3 = "INSERT INTO users(username, password, email) VALUES('$username', '$hashed_password', '$email')";
return mysqli_query($connection, $sql3);
}

function updater_user($connection, $id, $new_username, $new_email)
{
        $sql = "UPDATE users SET email = '$new_email', username = '$new_username' WHERE id = '$id'";
        $result = mysqli_query($connection, $sql);
        return mysqli_query($connection, $sql);
}

function delete_user($connection, $id)
{
    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    return mysqli_query($connection, $sql);
}

?>