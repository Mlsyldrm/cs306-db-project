<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Factory User Homepage</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; padding: 20px; }
        h3 { border-bottom: 2px solid #333; padding-bottom: 5px; margin-top: 30px; }
        
        .section-container {
            border: 1px solid #333;
            padding: 10px;
            margin-bottom: 20px;
        }
        
        .item-box { 
            border: 1px solid blue; 
            padding: 10px; 
            margin: 10px 0; 
            background-color: #fff;
        }
        
        .item-title { font-weight: bold; }
        a { color: purple; text-decoration: underline; font-size: 0.9em; display: block; margin-top: 5px;}
        a:hover { color: red; }
        
        
        .support-link { font-size: 1.2em; font-weight: bold; margin-top: 20px; display: inline-block; }
    </style>
</head>
<body>
    <h1>User Homepage</h1>

    <div class="section-container">
        <h3>Triggers:</h3>
        
        <div class="item-box">
            <span class="item-title">Trigger 1:</span> Reduces raw material stock when a product is made.
            <a href="trigger_1.php">Go to the trigger's page</a>
        </div>

        <div class="item-box">
            <span class="item-title">Trigger 2:</span> Increases machine usage count when used.
            <a href="trigger_2.php">Go to the trigger's page</a>
        </div>

        <div class="item-box">
            <span class="item-title">Trigger 3:</span> Updates warehouse employee count.
            <a href="trigger_3.php">Go to the trigger's page</a>
        </div>
    </div>

    <div class="section-container">
        <h3>Stored Procedures:</h3>

        <div class="item-box">
            <span class="item-title">Stored Procedure 1:</span> Calculates total raw materials for a product.
            <a href="procedure_1.php">Go to the procedure's page</a>
        </div>

        <div class="item-box">
            <span class="item-title">Stored Procedure 2:</span> Lists products made by a machine.
            <a href="procedure_2.php">Go to the procedure's page</a>
        </div>

        <div class="item-box">
            <span class="item-title">Stored Procedure 3:</span> Lists warehouses of an employee.
            <a href="procedure_3.php">Go to the procedure's page</a>
        </div>
    </div>

    <br>
    <a href="tickets.php" class="support-link">Go to Support Page</a>
</body>
</html>