<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Trigger 1</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
        
        .trigger-box { 
            border: 1px solid blue; 
            padding: 15px; 
            width: 100%; 
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        button { 
            display: block; 
            margin: 5px 0; 
            padding: 5px 10px; 
            background-color: #f0f0f0; 
            border: 1px solid #999; 
            cursor: pointer;
        }
        .result-message { margin-top: 15px; font-weight: bold; color: green; }
        a { color: purple; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="trigger-box">
        <b>Trigger 1:</b> This trigger automatically reduces the stock quantity of a raw material when used in a product.
        
        <form method="post">
            <button type="submit" name="case1">Case 1 (Use 10 Polypropylene)</button>
            <button type="submit" name="case2">Case 2 (Use 20 Steel Plate)</button>
            <button type="submit" name="case3">Case 3 (Use 15 Copper Wire)</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<div class='result-message'>";
            
            
            if (isset($_POST['case1'])) {
                
                $rid = 51; $pid = 71; $amount = 10;
            } elseif (isset($_POST['case2'])) {
                
                $rid = 55; $pid = 71; $amount = 20;
            } elseif (isset($_POST['case3'])) {
                
                $rid = 56; $pid = 74; $amount = 15;
            }

            
            $res = $conn->query("SELECT qty, name FROM RawMaterial WHERE rid=$rid");
            
            if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                echo "Before: Stock for " . $row['name'] . " is " . $row['qty'] . "<br>";

                
                $conn->query("DELETE FROM MadeFrom WHERE pid=$pid AND rid=$rid"); 
                
                
                if ($conn->query("INSERT INTO MadeFrom (pid, rid, amount) VALUES ($pid, $rid, $amount)")) {
                    
                    $row2 = $conn->query("SELECT qty FROM RawMaterial WHERE rid=$rid")->fetch_assoc();
                    echo "After: Stock is now " . $row2['qty'];
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Error: Raw Material ID not found.";
            }

            echo "</div>";
        }
        ?>
    </div>

    <a href="index.php">Go to homepage</a>

</body>
</html>