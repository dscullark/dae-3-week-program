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

// Fetch categories from the database
$categories_sql = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_sql);
$categories = [];
if (mysqli_num_rows($categories_result) > 0) {
    while ($row = mysqli_fetch_assoc($categories_result)) {
        $categories[] = $row;
    }
}

// Fetch the latest news
$news_sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT 6";
$news_result = mysqli_query($conn, $news_sql);
$newsItems = [];
if (mysqli_num_rows($news_result) > 0) {
    while ($row = mysqli_fetch_assoc($news_result)) {
        $newsItems[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest News</title>
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
        <section class="top-news">
            <h2>Latest News</h2>
            <div class="news-items">
                <?php foreach ($newsItems as $news): ?>
                    <article class="news-item">
                        <h4><?php echo htmlspecialchars($news['title']); ?></h4>
                        <p class="date"><?php echo htmlspecialchars($news['created_at']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Latest News. <a href="#">Privacy Policy</a></p>
    </footer>

</body>
</html>
