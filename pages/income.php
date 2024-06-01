<?php
include './db.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./inc/css/income.css">
</head>
<body>
    <p class="title">Income</p>
    <div class="form-container">
	    
	   <form class="form" action="./backend/add_income.php" method="Post" onsubmit="return validateForm()">

		    <div class="input-group">
			    <label for="date">Date</label>
			    <input type="date" name="date" id="date" placeholder="" max="<?php echo date('Y-m-d'); ?>">
		    </div>
		    <div class="input-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="category">
                    <option value="salary">Salary</option>
                    <option value="freelance">Freelance</option>
                    <option value="investment">Investment</option>
                    <option value="divident">Dividents</option>
                    <option value="rent">Rent</option>
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