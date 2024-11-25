<?php
include 'db.php';
session_start();

// Handle form submission to add a new post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param('ss', $title, $content);
    $stmt->execute();
    $stmt->close();

    // Reload the page after submitting
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add the styles here (same as previous CSS) */
    </style>
</head>
<body>

<header>
    <h1>Welcome to My Blog</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="admin.php">Admin Dashboard</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</header>

<div class="container">
    <h2>Recent Posts</h2>
    <?php
    $posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    if ($posts->num_rows > 0) {
        while ($post = $posts->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<h2>{$post['title']}</h2>";
            echo "<p>" . substr($post['content'], 0, 150) . "...</p>";
            echo "<a href='post.php?id={$post['id']}'>Read More</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No posts available. Please check back later!</p>";
    }
    ?>

    <!-- Form to add new post -->
    <h2>Add a New Post</h2>
    <form action="index.php" method="POST">
        <label for="title">Post Title</label>
        <input type="text" name="title" id="title" required>

        <label for="content">Post Content</label>
        <textarea name="content" id="content" rows="5" required></textarea>

        <button type="submit" name="submit_post">Add Post</button>
    </form>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> My Blog. All rights reserved.</p>
</footer>

</body>
</html>
