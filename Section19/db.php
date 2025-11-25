    <?php
    //echo "<br>Ok!<br>";
    //echo "<br>----------<br>";
    $connection = mysqli_connect("localhost", "root", "27031997", "database_register_login");
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

function check_query($connection, $result)
{
if($result)
{
    return "<br>Error " . mysqli_error($connection);
}
else
{
    return true;
}
}

?>