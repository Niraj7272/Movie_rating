<?php
session_start();
include "config.php";
$details_id = $_GET['details'];

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{

}

if (isset($_GET['details'])) {
    $details_id = $_GET['details'];
    $query = mysqli_query($conn, "select * from `movies` WHERE movie_id=$details_id");
    if (mysqli_num_rows($query) > 0) {
        $fetch_data = mysqli_fetch_assoc($query);
    }
}

if (isset($_POST['add_to_watchlist'])) {   

    // Select watchlist data based on condition
    $select_watchlist = mysqli_query($conn, "SELECT * FROM `watchlist` WHERE movie_id='$details_id' AND user_id='$user_id'");
    
    if (mysqli_num_rows($select_watchlist) > 0) {
        echo "<script type='text/javascript'>alert('Movie already added to watchlist')</script>";
    } else {
        // Insert movie data into watchlist table
        $insert_movies = mysqli_query($conn, "INSERT INTO `watchlist` (movie_id, user_id) VALUES ('$details_id', '$user_id')");
        if ($insert_movies) {
            echo "<script type='text/javascript'>alert('Movie added to Watchlist Successfully')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Failed to add movie to watchlist')</script>";
        }
    }
}

// Fetch average rating for this movie
$rating_query = mysqli_query($conn, "SELECT AVG(rating) AS avg_rating FROM `ratings` WHERE movie_id = $details_id");
$rating_data = mysqli_fetch_assoc($rating_query);
$average_rating = number_format($rating_data['avg_rating'], 1); // Round to 1 decimal place

// Fetch users who commented and their profile images
$comment_query = "SELECT u.full_name, u.profile_image, r.comment, r.rating, r.rated_at
                  FROM ratings r
                  JOIN users u ON r.user_id = u.user_id
                  WHERE r.movie_id = $details_id AND r.comment IS NOT NULL AND r.comment != ''";
$comment_result = mysqli_query($conn, $comment_query);

//fetching genre
$genre_query = mysqli_query($conn, "SELECT g.genre_name FROM genres g 
                                    JOIN movie_genres mg ON g.genre_id = mg.genre_id 
                                    WHERE mg.movie_id = $details_id");
$genres = [];
while ($row = mysqli_fetch_assoc($genre_query)) {
    $genres[] = $row['genre_name'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail page</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <?php include "header.php"; ?>

    <form method="post" action="">
        <div class="detail_container">
            <div class="detail_first_box">
                <img src="admin/movies_poster/<?php echo $fetch_data["movies_poster"]; ?>" height="500px" width="400px"
                    class="detail_image">
                <h3 class="avg_rating">Rating: <?php echo $average_rating; ?> / 5</h3>
                <!-- Display User Comments and Profile Images -->
                <div class="comment_section">
                    <h2>User Reviews</h2>
                    <?php
                    if (mysqli_num_rows($comment_result) > 0) {
                        echo "<div class='review_slider_vertical'>";
                        while ($comment_row = mysqli_fetch_assoc($comment_result)) {
                            echo "<div class='user_comment'>";
                            // Profile Image
                            echo "<img src='admin/profile/" . $comment_row['profile_image'] . "' alt='Profile Image' class='profile-circle'>";
                            echo "<strong>" . $comment_row['full_name'] . "</strong> rated: " . $comment_row['rating'] . "/5";
                            echo "<p>" . $comment_row['comment'] . "</p>";
                            echo "<p><em>Rated on: " . $comment_row['rated_at'] . "</em></p>";
                            echo "</div>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No user reviews available for this movie.</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="detail_second_box">
                <embed src="<?php echo $fetch_data["movies_trailer"]; ?>" height="370px" width="800px" type="">
                <h1><?php echo $fetch_data["title"]; ?><a
                        href="rating.php?details=<?php echo $fetch_data['movie_id'] ?>" class="rate_me_btn">Rate</a>
                </h1>
                <hr><br>
                <h3>Genre:  <?php echo implode(', ', $genres);?></h3>
                <h3>Date Of Release: <?php echo $fetch_data["release_date"]; ?></h3><br>
                <span><?php echo $fetch_data["movie_summery"]; ?></span><br><br>
                    <?php
                        if(isset($_SESSION['user_id'])){?>
                            <button type="submit" class="detail_add-to-watchlist-btn" name="add_to_watchlist">Add To Watchlist</button>

                       <?php }else{?>
                        <button onclick="alert('Login To Continue')" type="submit" class="detail_add-to-watchlist-btn">Add To Watchlist</button>
                      <?php }?>
                
                <a href="javascript:history.back()" class="detail_back">Back</a>

            </div>
        </div>
    </form>
    <?php
    include 'recommendation.php';
    include 'footer.php';
    ?>


    <button id="prevBtn">Previous</button>
    <button id="nextBtn">Next</button>

    <script>
        const slider = document.querySelector('.review_slider_vertical');

        // Scroll down to the next review
        document.getElementById('nextBtn').addEventListener('click', () => {
            const height = slider.clientHeight;
            slider.scrollBy({ top: height, behavior: 'smooth' });
        });

        // Scroll up to the previous review
        document.getElementById('prevBtn').addEventListener('click', () => {
            const height = slider.clientHeight;
            slider.scrollBy({ top: -height, behavior: 'smooth' });
        });
    </script>



</body>

</html>