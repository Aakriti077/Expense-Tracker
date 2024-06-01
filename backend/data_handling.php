<?php
// Check if the user is logged in and if their name is set in the session
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';

//logout
if(isset($_GET['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: ./pages/login.php");
    exit;
}

// Check if the user is a guest
$is_guest = ($user_name === 'Guest');

//for income
// Include your database connection code
include './db.php';

// Example SQL query to fetch total income amount
$sql = "SELECT SUM(amount) AS total_income FROM income";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_income = $row['total_income'];
} else {
    $total_income = 0;
}

// Close database connection
mysqli_close($conn);

//for expense
// Include your database connection code
include './db.php';

// Example SQL query to fetch total income amount
$sql = "SELECT SUM(amount) AS total_expense FROM expenses";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_expense = $row['total_expense'];
} else {
    $total_expense = 0;
}

// Close database connection
mysqli_close($conn);


//for total
// Include your database connection code
include './db.php';

// Initialize total amount
$total_amount = 0;

// Example SQL query to fetch total income amount
$sql = "SELECT SUM(amount) AS total_income FROM income";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_income = $row['total_income'];
    $total_amount += $total_income; // Update total amount with income
}

// Example SQL query to fetch total expense amount
$sql = "SELECT SUM(amount) AS total_expense FROM expenses";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_expense = $row['total_expense'];
    $total_amount -= $total_expense; // Update total amount with expense
}

// Close database connection
mysqli_close($conn);


?>