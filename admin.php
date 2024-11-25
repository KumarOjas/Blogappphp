<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission to add a new post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param('ss', $title, $content);
    $stmt->execute();
    $stmt->close();

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Admin Panel</h1>
    <a href="index.php">Back to Blog</a>
    <a href="logout.php">Logout</a>
</header>

<div class="container">
    <h2>Add New Post</h2>
    <form action="admin.php" method="POST">
        <label for="title">Post Title</label>
        <input type="text" name="title" id="title" required>

        <label for="content">Post Content</label>
        <textarea name="content" id="content" rows="5" required></textarea>

        <button type="submit">Add Post</button>
    </form>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> My Blog. All rights reserved.</p>
</footer>

</body>
</html>
