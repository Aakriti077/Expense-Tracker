<?php
// Include your database connection code
include '../db.php';

session_start(); // Start session for user authentication

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Retrieve and decode JSON data
// $data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve form data
    $date = ($_POST['date']);
    $category = ($_POST['category']);
    $item = ($_POST['item']);
    $amount = ($_POST['amount']);
    $details = ($_POST['details']);

    // Check if any of the form fields are empty
    if (empty($date) || empty($category) || empty($item) || empty($amount) || empty($details)) {
        // Display an alert message if any field is empty
        echo "<script>alert('Please fill in all the fields.'); window.history.back();</script>"; // Changed
        exit(); // Added to stop further execution
    }else {
        // Check if user is logged in
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id']; // Retrieve user ID from session
        } else {
            // Handle the case if user is not logged in
            // die("User is not logged in.");
            echo '<script>alert("User is not logged in."); window.history.back();</script>';
    exit(); 
        }

        // Example SQL query to insert expense data
        $query = "INSERT INTO expenses(`user_id`, `date`, `category`, `item`, `amount`, `details`) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $userId, $date, $category, $item, $amount, $details);

        // After successfully adding expense, redirect to recent_updates.php
        if ($stmt->execute()) {
            // Expense added successfully, redirect to recent_updates.php
            $updateType = 'expense'; // Set the update type
            
            // Redirect to recent_updates.php after sending data
            echo '<script>
                    // Send the user to recent_updates.php with the data
                    window.location.href = "./recent_updates.php?type=' . $updateType . '&amount=' . $amount . '&item=' . $item . '"; 
                    // Display index.php in the URL
                    window.history.replaceState({}, document.title, "../index.php");
                  </script>';
            exit(); // Make sure to exit after redirection
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close database connection
    mysqli_close($conn);
}
?>
