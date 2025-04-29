<?php
include 'functions.php';
$conn = dbConnect();

$categories = getCategories($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category'];
    $author_id = $_POST['author'];

    $stmt = $conn->prepare("INSERT INTO news (title, content, category_id, author_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $title, $content, $category_id, $author_id);
    $stmt->execute();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
        input, select, textarea { width: 100%; margin-bottom: 12px; padding: 10px; }
    </style>
</head>
<body>
<h2>Post a News Article</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <select name="category" required>
        <option value="">Select Category</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <select name="author" required>
        <option value="1">Jane Doe</option>
        <option value="2">John Smith</option>
        <option value="3">Alice Johnson</option>
    </select>
    <input type="submit" value="Publish">
</form>
</body>
</html>
