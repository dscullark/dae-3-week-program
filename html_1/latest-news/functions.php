<?php
function getCategories($conn) {
    $categories = [];
    $query = "SELECT DISTINCT category FROM latest_news_db";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['category'];
    }
    return $categories;
}
?>
