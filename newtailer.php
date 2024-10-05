<?php
error_reporting(0);
session_start();
include 'config.php';

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{

}


if (isset($_POST['add_to_watchlist'])) {
    $movie_id = $_POST['movie_id'];
   

    // Select watchlist data based on condition
    $select_watchlist = mysqli_query($conn, "SELECT * FROM `watchlist` WHERE movie_id='$movie_id' AND user_id='$user_id'");
    
    if (mysqli_num_rows($select_watchlist) > 0) {
        echo "<script type='text/javascript'>alert('Movie already added to watchlist')</script>";
    } else {
        // Insert movie data into watchlist table
        $insert_movies = mysqli_query($conn, "INSERT INTO `watchlist` (movie_id, user_id) VALUES ('$movie_id', '$user_id')");
        if ($insert_movies) {
            echo "<script type='text/javascript'>alert('Movie added to Watchlist Successfully')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Failed to add movie to watchlist')</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Movies</title>
    <link rel="stylesheet" href="index.css">
</head>

<body class="newtailer_body">
    <div class="container">
        <h1>All Movies</h1>
        <div class="newtailer_buttons">
            <button id="prev">❮ prev</button>
            <button id="next">Next ❯</button>
        </div>
        <div class="movie-list" id="movieList">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM movies ORDER BY movie_id DESC");

            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                    // Fetch average rating for each movie
                    $movie_id = $fetch_product['movie_id'];
                    $rating_query = mysqli_query($conn, "SELECT AVG(rating) AS avg_rating FROM ratings WHERE movie_id = $movie_id");
                    $rating_data = mysqli_fetch_assoc($rating_query);
                    $average_rating = number_format($rating_data['avg_rating'], 1); // Round to 1 decimal place
                    ?>
                    <form method="post" action="">
                        <div class="movie">
                            <img src="admin/movies_poster/<?php echo $fetch_product["movies_poster"]; ?>" alt="Movie Poster">
                            <div class="movie-info">
                                <h2><?php echo $fetch_product["title"]; ?></h2>
                                <div class="rating">
                                    <span>⭐</span>
                                    <span><?php echo $average_rating; ?> / 5</span>
                                </div>
                                <p><?php echo $fetch_product["release_date"]; ?></p>
                                <input type="hidden" name="movie_id" value="<?php echo $fetch_product["movie_id"]; ?>">
                                <input type="hidden" name="movie_title" value="<?php echo $fetch_product["title"]; ?>">
                                <input type="hidden" name="movie_rating" value="><?php echo $average_rating; ?>">
                                <input type="hidden" name="movie_release" value="<?php echo $fetch_product["release_date"]; ?>">
                                <input type="hidden" name="movie_poster" value="<?php echo $fetch_product["movies_poster"]; ?>">


                                
                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <button type="submit" class="watchlist_btn" name="add_to_watchlist"><b>+ </b> Watchlist</button>
                                <?php } else { ?>
                                    <button onclick="alert('Login To Continue')" type="button" class="watchlist_btn"><b>+ </b> Watchlist</button>
                                <?php } ?>
                                
                                <a href='details.php?details=<?php echo $fetch_product['movie_id'] ?>'>
                                    <button type="button" class="details_btn" name="details">Details</button>
                                </a>
                            </div>
                        </div>
                    </form>
                    <?php
                }
            } else {
                echo "<div class='empty_text'>No Movies Available</div>";
            }
            ?>
        </div>
        <a href="movies.php" class="see-more">See more</a>
    </div>

    <script>
        const movieList = document.getElementById('movieList');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');

        prevButton.addEventListener('click', () => {
            movieList.scrollBy({
                left: -200,
                behavior: 'smooth'
            });
        });

        nextButton.addEventListener('click', () => {
            movieList.scrollBy({
                left: 200,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>
