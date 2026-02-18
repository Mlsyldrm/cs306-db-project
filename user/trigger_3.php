<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Trigger 3</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
        .trigger-box { border: 1px solid blue; padding: 15px; width: 100%; box-sizing: border-box; margin-bottom: 10px; }
        button { display: block; margin: 5px 0; padding: 5px 10px; background-color: #f0f0f0; border: 1px solid #999; cursor: pointer; }
        .result-message { margin-top: 15px; font-weight: bold; color: green; }
        a { color: purple; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="trigger-box">
        <b>Trigger 3:</b> Updates warehouse employee count on new assignment.
        
        <form method="post">
            <button type="submit" name="case1">Case 1 (Assign to Central Warehouse)</button>
            <button type="submit" name="case2">Case 2 (Assign to Aegean Warehouse)</button>
            <button type="submit" name="case3">Case 3 (Assign to Bursa Logistics Center)</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<div class='result-message'>";
            
            
            if (isset($_POST['case1'])) { 
                $wid = 31; $emp = 41; 
            } elseif (isset($_POST['case2'])) { 
                $wid = 32; $emp = 42; 
            } elseif (isset($_POST['case3'])) { 
                $wid = 33; $emp = 45; 
            }

            
            $row = $conn->query("SELECT employee_count, name FROM Warehouse WHERE wid=$wid")->fetch_assoc();
            echo "Before: Count for " . $row['name'] . " is " . $row['employee_count'] . "<br>";

            
            $conn->query("DELETE FROM WorksInWarehouse WHERE emp_id=$emp AND wid=$wid"); 
            
            if ($conn->query("INSERT INTO WorksInWarehouse (emp_id, wid) VALUES ($emp, $wid)")) {
                
                $row2 = $conn->query("SELECT employee_count FROM Warehouse WHERE wid=$wid")->fetch_assoc();
                echo "After: Count is now " . $row2['employee_count'];
            } else {
                echo "Error: " . $conn->error;
            }

            echo "</div>";
        }
        ?>
    </div>

    <a href="index.php">Go to homepage</a>
</body>
</html>