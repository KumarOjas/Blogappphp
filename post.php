<?php
include 'db.php';
session_start();
$post_id = $_GET['id'];
$post = $conn->query("SELECT * FROM posts WHERE id = $post_id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $post['title']; ?></title>
</head>
<body>
    <h1><?php echo $post['title']; ?></h1>
    <p><?php echo $post['content']; ?></p>
    <hr>
    <h3>Comments</h3>
    <?php
    $comments = $conn->query("SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC");
    while ($comment = $comments->fetch_assoc()) {
        echo "<p>{$comment['comment']}</p><hr>";
    }
    ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST">
            <textarea name="comment" placeholder="Add a comment" required></textarea><br>
            <button type="submit">Submit</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            $comment = $_POST['comment'];
            $conn->query("INSERT INTO comments (post_id, user_id, comment) VALUES ($post_id, $user_id, '$comment')");
            header("Refresh:0");
        }
        ?>
    <?php endif; ?>
</body>
</html>
