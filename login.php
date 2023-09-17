<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "user_journey";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = $_POST["password"];

    $query = "SELECT * FROM user_journey.login WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) 
    {
        $row = mysqli_fetch_assoc($result);
        $resultPassword = $row['password'];
        if ($password == $resultPassword) 
        {
            $_SESSION["id"] = $row["id"];
            header('Location:class.html');
            exit;
        } 
        else 
        {
            echo "Login failed. Incorrect password.";
        }
    } 
    else
    {
        echo "Login failed. User not found.";
    }

    mysqli_close($connection);
}
?>
