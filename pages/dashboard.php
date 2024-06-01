<?php
include './db.php';

$is_guest = isset($_SESSION['user_id']) ? false : true;

if ($is_guest) {
    $total_income = 0;
    $total_expense = 0;
    $total_amount = 0;
} else {
    //  total income for all users
    $sql_income = "SELECT SUM(amount) AS total_income FROM income WHERE user_id = {$_SESSION['user_id']}";
    $result_income = mysqli_query($conn, $sql_income);
    $total_income = 0;
    if ($row_income = mysqli_fetch_assoc($result_income)) {
        $total_income = $row_income['total_income'];
    }

    // total expenses for all users
    $sql_expense = "SELECT SUM(amount) AS total_expense FROM expenses WHERE user_id = {$_SESSION['user_id']}";
    $result_expense = mysqli_query($conn, $sql_expense);
    $total_expense = 0;
    if ($row_expense = mysqli_fetch_assoc($result_expense)) {
        $total_expense = $row_expense['total_expense'];
    }

    $total_amount = $total_income - $total_expense;
}

// mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./inc/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<main>
        <div class="dashboard">Dashboard</div>

        <div class="insights">
          
          <div class="total">
            <span class="material-symbols-sharp"> paid </span>
            <div class="middle">
              <div class="left">
                <h3>Total Amount</h3>
                <h1>$<?php echo $total_amount; ?></h1>
              </div>
            </div>
          </div>

          <!-- EXPENSES -->
          <div class="expenses">
            <span class="material-symbols-sharp"> receipt_long </span>
            <div class="middle">
              <div class="left">
                <h3>Total Expenses</h3>
                <h1>$<?php echo $total_expense; ?></h1>
              </div>
            </div>
          </div>

          <!-- INCOME -->
          <div class="income">
            <span class="material-symbols-sharp"> payments </span>
            <div class="middle">
              <div class="left">
                <h3>Total Income</h3>
                <h1>$<?php echo $total_income; ?></h1>
              </div>
            </div>
          </div>
        </div>

        <div class="box">
          <canvas id="pieChart"></canvas>

        </div>
      </main>
      <script src="./inc/js/script.js"></script>
      <!-- <script src="./inc/js/index.js"></script>  -->
</body>
</html>
