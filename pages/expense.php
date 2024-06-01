<?php
include './db.php';

// session_start(); // Start session for user authentication

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense</title>
    <link rel="stylesheet" href="./inc/css/expense.css">
</head>
<body>
    <p class="title">Expenses</p>
    <div class="form-container">
	    
	    <form class="form" action="./backend/add_expense.php" method="Post" onsubmit="return validateForm()">
		    <div class="input-group">
			    <label for="date">Date</label>
			    <input type="date" name="date" id="date" placeholder="" max="<?php echo date('Y-m-d'); ?>" >
		    </div>
		    <div class="input-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="category">
                    <option value="food">Food</option>
                    <option value="transportation">Transportation</option>
                    <option value="housing">Housing</option>
                    <option value="utilities">Utilities</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="clothing">Clothing</option>
                    <option value="education">Education</option>
                    <option value="rent">Entertainment</option>
                    <option value="others">Others</option>
                </select> 

            </div>
            <div class="input-group">
			    <label for="item">Item</label>
			    <input type="text" name="item" id="item" placeholder=""pattern="[A-Za-z]+" title="Please enter alphabets only">
		    </div>
            <div class="input-group">
			    <label for="Amount">Amount</label>
			    <input type="text" name="amount" id="amount" placeholder="" pattern="[0-9]+(\.[0-9]+)?" title="Please enter numbers only">
		    </div>
            <div class="input-group">
			    <label for="details">Details</label>
			    <input type="text" name="details" id="details" placeholder="">
		    </div>
		    <button class="add">Add</button>
	    </form>
    </div>

</body>
</html>
