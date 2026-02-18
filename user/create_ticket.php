<?php include 'mongo_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Ticket</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
        input, textarea { display: block; margin-bottom: 10px; width: 300px; }
        a { color: purple; text-decoration: underline; }
    </style>
</head>
<body>
    <a href="tickets.php">View Tickets</a><br>
    <a href="index.php">Home</a>

    <h2>Create a Ticket</h2>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <textarea name="body" placeholder="Describe your issue..." required></textarea>
        <button type="submit" name="create">Create Ticket</button>
    </form>

    <?php
    if (isset($_POST['create'])) {
        $insertOneResult = $collection->insertOne([
            'username' => $_POST['username'],
            'body' => $_POST['body'],
            'status' => true, 
            'created_at' => date('Y-m-d H:i:s'), 
            'comments' => [] 
        ]);

        if ($insertOneResult->getInsertedCount() == 1) {
            
            header("Location: ticket_confirmation.php");
            exit();
        }
    }
    ?>
</body>
</html>