<?php include 'mongo_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
        .ticket-box { border: 1px solid blue; padding: 10px; margin-bottom: 10px; }
        a { color: purple; text-decoration: underline; }
    </style>
</head>
<body>
    <h2>Admin Ticket List</h2>

    <?php
    
    $tickets = $collection->find(['status' => true]);

    foreach ($tickets as $ticket) {
        echo "<div class='ticket-box'>";
        echo "<b>Status:</b> Active<br>";
        echo "<b>Body:</b> " . $ticket['body'] . "<br>";
        echo "<b>Created At:</b> " . $ticket['created_at'] . "<br>";
        echo "<b>Username:</b> " . $ticket['username'] . "<br>";
        echo "<a href='ticket_details.php?id=" . $ticket['_id'] . "'>View Details</a>";
        echo "</div>";
    }
    ?>
</body>
</html>