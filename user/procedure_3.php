<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Procedure 3</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
        .proc-box { border: 1px solid blue; padding: 15px; width: 100%; box-sizing: border-box; margin-bottom: 10px; }
        input { display: block; margin: 5px 0; width: 200px; padding: 3px; }
        button { display: block; margin-top: 10px; padding: 5px 10px; cursor: pointer; }
        a { color: purple; text-decoration: underline; }
        table { border-collapse: collapse; margin-top: 10px; width: 100%; border: 1px solid #ccc; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
    </style>
</head>
<body>

    <div class="proc-box">
        <b>Stored Procedure 3:</b> Lists all warehouses where a specific employee works.
        
        <form method="post" style="margin-top: 15px;">
            <input type="number" name="emp_id" placeholder="Parameter 1 (Employee ID)" required>
            <button type="submit" name="call">Call Procedure</button>
        </form>

        <?php
        if (isset($_POST['call'])) {
            $eid = $_POST['emp_id'];
            $result = $conn->query("CALL sp_warehouses_for_employee($eid)");

            if ($result) {
                echo "<table><tr><th>WID</th><th>Warehouse</th><th>Location</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['wid'] . "</td><td>" . $row['name'] . "</td><td>" . $row['location'] . "</td></tr>";
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