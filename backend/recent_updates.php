<?php
// Include your database connection code
include '../db.php';

session_start(); // Start session for user authentication

// Check if the required parameters are set in the URL
if (isset($_GET['type']) && isset($_GET['amount']) && isset($_GET['item'])) {
    // Get the values from the URL parameters
    $type = $_GET['type'];
    $amount = $_GET['amount'];
    $item = $_GET['item'];

    // Prepare the SQL INSERT statement
    $query = "INSERT INTO updates (user_id, type, items, amount, timestamp) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters and execute the statement
        $userId = $_SESSION['user_id']; // Retrieve user ID from session
        $stmt->bind_param("ssss", $userId, $type,  $item, $amount);
    
        // Execute the statement
        $stmt->execute();
    
        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Unable to prepare the statement.";
    }
} else {
    echo "Error: Required parameters are missing.";
}

// Close database connection
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Updates</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body{
            background-color: rgb(251, 246, 255);
            font-family: poppins, sans-serif;
;
        }
        /* Style for the card */
        .card {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        /* Center the card */
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Style for the button */
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: rgb(251, 246, 255);
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="center">
        <div class="card">
            <h2><?php
            // Check if the type is set in the URL
            if (isset($_GET['type'])) {
                // Get the type from the URL
                $updateType = $_GET['type'];
                // Display the update type
                echo "NRS " . number_format($amount) . " " . $type . " added successfully.";

            } else {
                // Display a generic message if the type is not set
                echo "Recent update added successfully!";
            }
            
            ?>
            </h2>
            <!-- Button to redirect to index page -->
       <a href="../index.php" class="button">Home</a>
        </div>
    </div>
    <div class="oho"></div>

   
</body>
</html>
