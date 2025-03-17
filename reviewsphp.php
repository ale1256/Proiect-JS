<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, restname, city, rate, subject FROM reviews";
$result = $conn->query($sql);

$ranking_sql = "SELECT restname, AVG(rate) as avg_rate FROM reviews GROUP BY restname ORDER BY avg_rate DESC LIMIT 3";
$ranking_result = $conn->query($ranking_sql);

$comments_sql = "SELECT review_id, name, comment, created_at FROM comments ORDER BY created_at DESC";
$comments_result = $conn->query($comments_sql);
$comments = [];
if ($comments_result->num_rows > 0) {
    while($comment_row = $comments_result->fetch_assoc()) {
        $comments[$comment_row['review_id']][] = $comment_row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Review List</title>
    <link rel="stylesheet" href="cssreviews.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <h1>Reviews</h1>
    <div class="reviews-container">
        <div class="ranking">
            <h2>Our Top 3 Restaurants Based on Our Reviews</h2>
            <ol>
            <?php
                if ($ranking_result->num_rows > 0) {
         while($row = $ranking_result->fetch_assoc()) {
                    echo "<li><strong>" . $row["restname"] . "</strong> (" . number_format($row["avg_rate"], 2) . " stars)</li>";
                             }
}               else {
                     echo "<li><strong>No rankings available</strong></li>";
}
?>

            </ol>
        </div>
        <div class="reviews">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='review-container'>";
                    echo "<h3>" . $row["restname"] . " (" . $row["rate"] . " stars)</h3>";
                    echo "<p><strong>Reviewed by:</strong> " . $row["name"] . " <strong>from</strong> " . $row["city"] . "</p>";
                    echo "<p>" . $row["subject"] . "</p>";

                    if (!empty($comments[$row['id']])) {
                        foreach ($comments[$row['id']] as $comment) {
                            echo "<div class='comment'>";
                            echo "<p><strong>" . $comment['name'] . ":</strong> " . $comment['comment'] . "</p>";
                            echo "<p><em>" . $comment['created_at'] . "</em></p>";
                            echo "</div>";
                        }
                    }

                    echo "<form action='comsubs.php' method='post'>";
                    echo "<input type='hidden' name='review_id' value='" . $row['id'] . "'>";
                    echo "<label for='name'>Name:</label>";
                    echo "<input type='text' name='name' required>";
                    echo "<label for='comment'>Comment:</label>";
                    echo "<textarea name='comment' required></textarea>";
                    echo "<button type='submit'>Submit</button>";
                    echo "</form>";

                    echo "</div>";
                }
            } else {
                echo "<div class='review-container'>0 results</div>";
            }
            $conn->close();
            ?>
        </div>
    </div>
    <footer>
        <div class="social-icons">
            <i class="fa fa-instagram"></i>
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
        <div class="home-icon">
            <a class="nav" href="interfata.php"><i class="fa fa-home"></i></a>
        </div>
    </footer>
</body>
</html>
