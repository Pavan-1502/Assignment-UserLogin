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

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
    } else {
        // Handle the case where the user is not authenticated
        // Redirect to the login page or show an error message
        header("Location: login.html");
        exit;
    }
    // Fetch user credits and send JSON response
    $query = "SELECT credits FROM user_journey.login WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $credits = $row["credits"];
    
        echo json_encode(["credits" => $credits]);
    } else {
        echo json_encode(["error" => "Failed to fetch credits."]);
    }
    
    mysqli_close($connection);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
    } else {
        // Handle the case where the user is not authenticated
        // Redirect to the login page or show an error message
        header("Location: login.html");
        exit;
    }
    // Perform credit deduction and send JSON response
    $query = "SELECT credits FROM user_journey.login WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $currentCredits = $row["credits"];
    
        if ($currentCredits >= 1) {
            $newCredits = $currentCredits - 1;
    
            $updateQuery = "UPDATE user_journey.login SET credits = $newCredits WHERE id = $id";
            $updateResult = mysqli_query($connection, $updateQuery);
    
            if ($updateResult) {
                echo json_encode(["success" => true, "message" => "Class Joined"]);
            } else {
                echo json_encode(["error" => "Failed to update credits."]);
            }
        } else {
            echo json_encode(["error" => "Insufficient credits."]);
        }
    } else {
        echo json_encode(["error" => "Failed to fetch current credits."]);
    }
    
    mysqli_close($connection);
}
?>
