<?php
session_start();


if (!isset($_SESSION["id"])) {
    header("Location: login.html");
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$database = "user_journey";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["credits"])) {
    
    $id = $_SESSION["id"];
    $selectedCredits = intval($_POST["credits"]);

   
    $query = "SELECT credits FROM user_journey.login WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $currentCredits = intval($row["credits"]);

        // new credits
        $newTotalCredits = $currentCredits + $selectedCredits;

        // upload credits
        $updateQuery = "UPDATE user_journey.login SET credits = $newTotalCredits WHERE id = $id";
        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) 
        {
            echo "success"; 
        } 
        else 
        {
            echo "Failed to update credits.";
        }
    } 
    else 
    {
        echo "Failed to fetch current credits.";
    }

    mysqli_close($connection);
}
?>
