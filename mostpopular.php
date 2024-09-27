<?php
error_reporting(0);
session_start();
include 'config.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Handle if the user is not logged in
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Popular Movies</title>
    <link rel="stylesheet" href="index.css">
</head>

<body class="newtailer_body">
    <div class="container">
        <h1>Most Popular Movies</h1>
        <div class="newtailer_buttons">
            <button id="prev">❮ prev</button>
            <button id="next">Next ❯</button>
        </div>
        <div class="movie-list" id="movieList">
            <?php
            // Query to fetch movies, ordered by the number of users who rated the movie
            $query = "
                SELECT m.movie_id, m.title, m.release_date, m.movies_poster, 
                       COUNT(r.rating) AS num_ratings,
                       COALESCE(AVG(r.rating), 0) AS avg_rating
                FROM movies m
                LEFT JOIN ratings r ON m.movie_id = r.movie_id
                GROUP BY m.movie_id
                ORDER BY num_ratings DESC
            ";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($movie = mysqli_fetch_assoc($result)) {
                    $movie_id = $movie['movie_id'];
                    $average_rating = number_format($movie['avg_rating'], 1); // Round to 1 decimal place
                    ?>
                    <form method="post" action="">
                        <div class="movie">
                            <img src="admin/movies_poster/<?php echo $movie['movies_poster']; ?>" alt="Movie Poster">
                            <div class="movie-info">
                                <h2><?php echo $movie['title']; ?></h2>
                                <div class="rating">
                                    <span>⭐</span>
                                    <span><?php echo $average_rating; ?> / 5</span>
                                </div>
                                <p><?php echo $movie['release_date']; ?></p>
                                <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">

                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <button type="submit" class="watchlist_btn" name="add_to_watchlist"><b>+ </b> Watchlist</button>
                                <?php } else { ?>
                                    <button onclick="alert('Login To Continue')" type="button" class="watchlist_btn"><b>+ </b> Watchlist</button>
                                <?php } ?>
                                
                                <a href='details.php?details=<?php echo $movie['movie_id'] ?>'>
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
