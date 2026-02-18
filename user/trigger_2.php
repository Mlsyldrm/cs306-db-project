<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Trigger 2</title>
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
        <b>Trigger 2:</b> Increases usage count of a machine when assigned to a product.
        
        <form method="post">
            <button type="submit" name="case1">Case 1 (Use Assembly Robot)</button>
            <button type="submit" name="case2">Case 2 (Use Press Machine)</button>
            <button type="submit" name="case3">Case 3 (Use Welding Unit)</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<div class='result-message'>";
            
            
            if (isset($_POST['case1'])) { 
                $mid = 62; $pid = 71; 
            } elseif (isset($_POST['case2'])) { 
                $mid = 61; $pid = 71; 
            } elseif (isset($_POST['case3'])) { 
                $mid = 63; $pid = 73; 
            }

            
            $row = $conn->query("SELECT usage_count, name FROM Machine WHERE mid=$mid")->fetch_assoc();
            echo "Before: Usage count for " . $row['name'] . " is " . $row['usage_count'] . "<br>";

            
            $conn->query("DELETE FROM MadeByMachine WHERE pid=$pid AND mid=$mid"); 
            
            if ($conn->query("INSERT INTO MadeByMachine (pid, mid) VALUES ($pid, $mid)")) {
                
                $row2 = $conn->query("SELECT usage_count FROM Machine WHERE mid=$mid")->fetch_assoc();
                echo "After: Usage count is now " . $row2['usage_count'];
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