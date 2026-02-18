<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Procedure 1</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
       
        .proc-box { 
            border: 1px solid blue; 
            padding: 15px; 
            width: 100%; 
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        
        input { display: block; margin: 5px 0; width: 200px; padding: 3px; }
        button { display: block; margin-top: 10px; padding: 5px 10px; cursor: pointer; }
        a { color: purple; text-decoration: underline; }
        
        
        table { border-collapse: collapse; margin-top: 10px; width: 100%; border: 1px solid #ccc; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
    </style>
</head>
<body>

    <div class="proc-box">
        <b>Stored Procedure 1:</b> Calculates total raw materials used for a specific product.
        
        <form method="post" style="margin-top: 15px;">
            <input type="number" name="pid" placeholder="Parameter 1 (Product ID)" required>
            <button type="submit" name="call">Call Procedure</button>
        </form>

        <?php
        if (isset($_POST['call'])) {
            $pid = $_POST['pid'];
            $result = $conn->query("CALL sp_total_rawmaterial_for_product($pid)");

            if ($result) {
                echo "<table><tr><th>Product</th><th>Total Used</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['product_name'] . "</td><td>" . $row['total_rawmaterial_used'] . "</td></tr>";
                }
                echo "</table>";
                $conn->next_result();
            } else { echo "Error: " . $conn->error; }
        }
        ?>
    </div>

    <a href="index.php">Go to homepage</a>
</body>
</html>