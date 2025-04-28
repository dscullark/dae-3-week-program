<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "latest_news_db"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch categories for the dropdown
$categories_sql = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_sql);
$categories = [];
if (mysqli_num_rows($categories_result) > 0) {
    while ($row = mysqli_fetch_assoc($categories_result)) {
        $categories[] = $row;
    }
}

// Handle form submission to insert new news
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_news'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category'];

    // Insert news into database
    $insert_sql = "INSERT INTO news (title, content, category_id, created_at) VALUES ('$title', '$content', '$category_id', NOW())";
    if (mysqli_query($conn, $insert_sql)) {
        echo "News article created successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle form submission to insert new category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_category'])) {
    $category_name = $_POST['category_name'];

    // Insert category into database
    $insert_category_sql = "INSERT INTO categories (name) VALUES ('$category_name')";
    if (mysqli_query($conn, $insert_category_sql)) {
        echo "Category added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create News</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navigation -->
    <header>
        <div class="top-header">
            <div class="left-links">
                <a href="#">Help</a>
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php foreach ($categories as $category): ?>
                    <li><a href="category.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                <?php endforeach; ?>
                <li><a href="admin.php">Create News</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <section class="create-news">
            <h2>Create News Article</h2>
            <form method="POST">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>

                <label for="content">Content</label>
                <textarea name="content" id="content" required></textarea>

                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" name="create_news">Submit News</button>
            </form>

            <h2>Add New Category</h2>
            <form method="POST">
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name" required>

                <button type="submit" name="create_category">Add Category</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Latest News. <a href="#">Privacy Policy</a></p>
    </footer>

</body>
</html>
