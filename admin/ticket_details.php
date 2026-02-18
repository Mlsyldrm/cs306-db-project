<?php include 'mongo_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Ticket Details</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 20px; }
        .comment-box { border: 1px solid blue; padding: 10px; margin: 5px 0; width: 60%; }
        h3 { border-bottom: 2px solid black; }
        a { color: purple; text-decoration: underline; }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['id'])) {
        $ticketId = new MongoDB\BSON\ObjectId($_GET['id']);
        
        // Deactivate İşlemi
        if (isset($_POST['deactivate'])) {
            $collection->updateOne(['_id' => $ticketId], ['$set' => ['status' => false]]);
            echo "<h3>Ticket Deactivated (Resolved)</h3>";
            echo "<a href='index.php'>Back to Admin List</a>";
            exit();
        }

        // Yorum Ekleme (Admin)
        if (isset($_POST['add_comment'])) {
            $newComment = [
                'created_at' => date('Y-m-d H:i:s'),
                'username' => 'admin', 
                'comment' => $_POST['comment_text']
            ];
            $collection->updateOne(['_id' => $ticketId], ['$push' => ['comments' => $newComment]]);
        }

        $ticket = $collection->findOne(['_id' => $ticketId]);
    }
    ?>

    <form method="post">
        <button type="submit" name="deactivate">Deactivate Ticket</button>
    </form>

    <h3>Ticket Details</h3>
    <?php
        echo "<b>Username:</b> " . $ticket['username'] . "<br><br>";
        echo "<b>Body:</b> " . $ticket['body'] . "<br><br>";
        echo "<b>Status:</b> " . ($ticket['status'] ? 'Active' : 'Inactive') . "<br><br>";
        echo "<b>Created At:</b> " . $ticket['created_at'] . "<br><br>";
    ?>

    <div style="border-top: 2px solid black; margin-top: 20px;">
        <h3>Comments:</h3>
        <?php
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
        <button type="submit" name="add_comment">Add Comment</button>
    </form>
    
    <br>
    <a href="index.php">Back to Tickets</a>
</body>
</html>