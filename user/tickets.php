<?php include 'mongo_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Ticket List</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
        .ticket-box { border: 1px solid blue; padding: 10px; margin-bottom: 10px; }
        a { color: purple; text-decoration: underline; }
        h3 { border-bottom: 2px solid black; padding-bottom: 5px; }
    </style>
</head>
<body>
    <form action="tickets.php" method="get">
        <?php
        
        $activeUsers = $collection->distinct('username', ['status' => true]);
        ?>
        
        <select name="username">
            <?php foreach ($activeUsers as $user): ?>
                <option value="<?php echo $user; ?>" <?php if(isset($_GET['username']) && $_GET['username'] == $user) echo 'selected'; ?>>
                    <?php echo $user; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Select</button>
    </form>
    <br>
    <a href="create_ticket.php">Create a Ticket</a> | <a href="index.php">Back to Home</a>

    <h3>Results:</h3>

    <?php
    if (isset($_GET['username'])) {
        $selectedUser = $_GET['username'];
        
        $tickets = $collection->find(['username' => $selectedUser, 'status' => true]);

        foreach ($tickets as $ticket) {
            echo "<div class='ticket-box'>";
            echo "<b>Status:</b> " . ($ticket['status'] ? 'Active' : 'Resolved') . "<br>";
            echo "<b>Body:</b> " . $ticket['body'] . "<br>";
            echo "<b>Created At:</b> " . $ticket['created_at'] . "<br>";
            echo "<b>Username:</b> " . $ticket['username'] . "<br>";
            
            echo "<a href='ticket_details.php?id=" . $ticket['_id'] . "'>View Details</a>";
            echo "</div>";
        }
    }
    ?>
</body>
</html>