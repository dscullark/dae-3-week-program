<?php
include 'functions.php';
$conn = dbConnect();

$title = "Latest News Site";         // string
$totalViews = 205;                   // integer
$isLive = true;                      // boolean

$categories = getCategories($conn);
$newsItems = getNews($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body { font-family: Arial; background: #f0f0f0; margin: 0; }
        header, nav, main { padding: 20px; }
        nav a { margin-right: 15px; }
        article { background: #fff; padding: 15px; margin: 20px 0; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<header>
    <h1><?= $title ?></h1>
    <p>Total Views: <?= $totalViews ?></p>
    <?php if ($isLive): ?>
        <p>Status: ✅ Website is live</p>
    <?php else: ?>
        <p>Status: ❌ Website offline</p>
    <?php endif; ?>
</header>

<nav>
    <?php foreach ($categories as $cat): ?>
        <a href="#"><?= htmlspecialchars($cat['name']) ?></a>
    <?php endforeach; ?>
    <a href="admin.php">Admin Panel</a>
</nav>

<main>
    <?php foreach ($newsItems as $news): ?>
        <article>
            <h2><?= htmlspecialchars($news['title']) ?></h2>
            <small>By <?= htmlspecialchars($news['author']) ?> | Category: <?= htmlspecialchars($news['category']) ?> | <?= $news['created_at'] ?></small>
            <p><?= htmlspecialchars($news['content']) ?></p>
        </article>
    <?php endforeach; ?>
</main>
</body>
</html>
