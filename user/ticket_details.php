<?php include 'mongo_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Ticket Details</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
        .comment-box { border: 1px solid blue; padding: 10px; margin: 5px 0; width: 60%; }
        h3 { border-bottom: 2px solid black; }
        a { color: purple; text-decoration: underline; }
    </style>
</head>
<body>
    <h3>Ticket Details</h3>

    <?php
    if (isset($_GET['id'])) {
        
        $ticketId = new MongoDB\BSON\ObjectId($_GET['id']);
        $ticket = $collection->findOne(['_id' => $ticketId]);

        echo "<b>Username:</b> " . $ticket['username'] . "<br><br>";
        echo "<b>Body:</b> " . $ticket['body'] . "<br><br>";
        echo "<b>Status:</b> " . ($ticket['status'] ? 'Active' : 'Inactive') . "<br><br>";
        echo "<b>Created At:</b> " . $ticket['created_at'] . "<br><br>";
    }

    
    if (isset($_POST['add_comment'])) {
        $newComment = [
            'created_at' => date('Y-m-d H:i:s'),
            'username' => $_POST['comment_user'],
            'comment' => $_POST['comment_text']
        ];

        
        $collection->updateOne(
            ['_id' => $ticketId],
            ['$push' => ['comments' => $newComment]]
        );
        
        
        header("Location: ticket_details.php?id=" . $_GET['id']);
    }
    ?>

    <div style="border-top: 2px solid black; margin-top: 20px;">
        <h3>Comments:</h3>
        <?php
        
        $ticket = $collection->findOne(['_id' => $ticketId]);
        if (isset($ticket['comments'])) {
            foreach ($ticket['comments'] as $c) {
                echo "<div class='comment-box'>";
                echo "<b>Created At:</b> " . $c['created_at'] . "<br>";
                echo "<b>Username:</b> " . $c['username'] . "<br>";
                echo "<b>Comment:</b> " . $c['comment'];
                echo "</div>";
            }
        }
        ?>
    </div>

    <br>
    <form method="post">
        <textarea name="comment_text" placeholder="Add a comment" required style="width: 300px;"></textarea><br>
        <input type="text" name="comment_user" placeholder="Your Username" required><br>
        <button type="submit" name="add_comment">Add Comment</button>
    </form>
    
    <br>
    <a href="tickets.php">Back to Tickets</a>
</body>
</html>