<?php

// session_start ();
// Include your database connection code
include './db.php';

// Check if the user is logged in and if their name is set in the session
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Retrieve user ID from session

    // Query to fetch updates from the database
    $query = "SELECT * FROM updates WHERE user_id='$userId' ORDER BY timestamp DESC LIMIT 11";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any updates
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row of the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Extract data from the row
                // $userId = $row['user_id'];
                $type = $row['type'];
                $amount = $row['amount'];

                // Display the update information
                if ($type == 'income') {
                    echo '<div class="card" style="background-color:#42E393;padding:10px ;margin:2px;border-radius:4px;">';
                    echo '<h5>NRS ' . number_format($amount) . ' added '  . '.</h5>';
                    echo '</div>';
                } else {
                    echo '<div class="card" style="background-color:#FF6D6A;padding:10px ;margin:2px;border-radius:4px;">';
                    echo '<h5>NRS ' . number_format($amount) . ' reduced ' . '.</h5>';
                    echo '</div>';
                }
            }
        } else {
            // Display a message if there are no updates
            echo "No updates found.";
        }
    } else {
        // Display an error message if the query fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Display a message if the user is not logged in
    echo "Please log in to view updates.";
}

// Close the database connection
mysqli_close($conn);
?>
