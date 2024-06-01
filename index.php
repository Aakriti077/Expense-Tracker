<?php
session_start(); // Start the session

include './backend/data_handling.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./inc/css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    <div class="container">
      <aside>
        <div class="top">
          <div class="logo">
            <!-- <img src="./imgs/bg.jpg" alt="logo" /> -->
            <h2><span class="danger">Expense</span>Tracker</h2>
          </div>
          <div class="close" id="close-btn">
            <span class="material-symbols-sharp"> close </span>
          </div>
        </div>

        <div class="sidebar" >
             <?php $option = isset($_GET['option']) ? $_GET['option'] : ''; ?>
          <a href="index.php?option=dashboard" class="<?php echo ($option == 'dashboard') ? 'active' : ''; ?>"  >
            <span class="material-symbols-sharp"> grid_view </span>
            <h3>Dashboard</h3>
          </a>
          <a href="index.php?option=income"  class="<?php echo ($option == 'income') ? 'active' : ''; ?>" >
            <span class="material-symbols-sharp"> payments </span>
            <h3>Income</h3>
          </a>
          <a href="index.php?option=expense"  class="<?php echo ($option == 'expense') ? 'active' : ''; ?>">
            <span class="material-symbols-sharp"> receipt_long </span>
            <h3>Expenses</h3>
          </a>
          <a href="index.php?option=report"  class="<?php echo ($option == 'report') ? 'active' : ''; ?>">
            <span class="material-symbols-sharp"> description </span>
            <h3>Reports</h3>
          </a>

           <?php if ($is_guest): ?>
          <a href="./pages/login.php" >
            <span class="material-symbols-sharp"> login </span>
            <h3>Login</h3>
          </a>

          <?php else: ?>
          <a href="index.php?logout=true" >
            <span class="material-symbols-sharp"> logout </span>
            <h3>Logout</h3>
          </a>
        </div>
        <?php endif; ?>
      </aside>

      <main>
        <?php
        //Include database
        include './db.php';

        $option = isset($_GET['option']) ? $_GET['option'] : '';

        //Switch statement to load the selected page
        switch($option){
            case 'dashboard':
                include('./pages/dashboard.php');
                break;

            case 'income':
                include('./pages/income.php');
                break;

            case 'expense':
                include('./pages/expense.php');
                break;

            case 'report':
                include('./pages/reports.php');
                break;

            default:
                include('./pages/dashboard.php');
                break;
        }

        //Close database connection
        mysqli_close($conn);

        ?>
      </main>

      <div class="right" id="right" >
        <div class="top">
          <!-- <button id="menu-btn">
            <span class="material-symbols-sharp"> menu </span>
          </button> -->

          <div class="theme-toggler">
            <span class="material-symbols-sharp active"> light_mode </span>
            <span class="material-symbols-sharp"> dark_mode </span>
          </div>
          <div class="profile">
            <div class="info">
              <p>Hey, <?php echo $user_name; ?></p>
              <small class="text-muted">User</small>
            </div>

            <div class="profile-photo" id="profile-photo">
             <input type="file" id="profile-picture-input" accept="image/*" style="display: none;" />
              <img src="./inc/imgs/profile2.png" alt="Profile Picture" id="profile-image" />
           </div>

          </div>
        </div>

        <div class="recent-updates">
          <div class="updates">
            
            <h2>Recent Updates</h2>

            <?php include './backend/recent_updates_display.php'; ?>
           
            </div>
          </div>
        </div>
      </div>
    </div>

  <script src="./inc/js/script.js"></script>
  <script src="./inc/js/theme_toggle.js"></script>

  </body>
</html>