<?php
// session_start();

include './db.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; 
} else {
    die("User is not logged in.");
}

$total_amount = 0;

// Total expense amount for a specific user
$expenseQuery = "SELECT SUM(amount) AS total_expense
FROM expenses
WHERE user_id = '$userId'";

// to fetch total expense amount
$expenseResult = mysqli_query($conn, $expenseQuery);
$expenseRow = mysqli_fetch_assoc($expenseResult);
$total_expense = $expenseRow['total_expense'];

// Total income amount 
$incomeQuery = "SELECT SUM(amount) AS total_income
FROM income
WHERE user_id = '$userId'";

// to fetch total income amount
$incomeResult = mysqli_query($conn, $incomeQuery);
$incomeRow = mysqli_fetch_assoc($incomeResult);
$total_income = $incomeRow['total_income'];

$total_amount = $total_income - $total_expense;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./inc/css/reports.css">
</head>
<body>
    <p class="title">Reports</p>
    <div class="report_container">

        <section>

        
        <?php 

        // echo $total_amount;
        if ($total_amount < 0) {
            echo '<div class="card">';
            echo '<h2>Financial Unstable</h2>';
            echo '<div class="card_details">';
            echo '<img src="./inc/imgs/uncanny.png" alt="" srcset="">';
            echo '<p>Your balance is less than 0. Please start saving and budgeting wisely.</p>';
            echo '</div>';
            echo '</div>';
        }elseif ($total_amount >= 0 && $total_amount < 100) {
            echo '<div class="card">';
            echo '<h2>Financial Challenged</h2>';
            echo '<div class="card_details">';
            echo '<img src="./inc/imgs/normal.png" alt="" srcset="">';
            echo '<p>Your balance is positive but low. Consider saving and managing expenses carefully.</p>';
            echo '</div>';
            echo '</div>';
        } elseif ($total_amount >= 100 && $total_amount < 1000) {
            echo '<div class="card">';
            echo '<h2>Financial Stable</h2>';
            echo '<div class="card_details">';
            echo '<img src="./inc/imgs/happyyy.png" alt="" srcset="">';
            echo '<p>Your balance is healthy. Keep up the good work and continue managing your finances effectively.</p>';
            echo '</div>';
            echo '</div>';
        } elseif ($total_amount >= 1000 && $total_amount < 10000) {
            echo '<div class="card">';
            echo '<h2>Financial Good</h2>';
            echo '<div class="card_details">';
            echo '<img src="./inc/imgs/veryhappy.png" alt="" srcset="">';
            echo '<p>Your balance is strong. Consider investing or saving for long-term financial goals.</p>';
            echo '</div>';
            echo '</div>';
        } elseif ($total_amount >= 10000) {
            echo '<div class="card">';
            echo '<h2>Financial Excellent</h2>';
            echo '<div class="card_details">';
            echo '<img src="./inc/imgs/superhappy.png" alt="" srcset="">';
            echo '<p>Congratulations! You have a substantial balance. Consider diversifying investments or saving for major expenses.</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        </section>
    </div>
</body>
</html>
