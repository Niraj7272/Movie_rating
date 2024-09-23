<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 on IMDb this week</title>
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
            $select_products = mysqli_query($conn, "select * from movies ORDER BY movie_id DESC");

            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                    // echo $fetch_product['name'];
                    ?>
                    <form method="post" action="">
                        <div class="movie">
                            <img src="admin/movies_poster/<?php echo $fetch_product["movies_poster"]; ?>"
                                alt="House of the Dragon">
                            <div class="movie-info">
                                <h2><?php echo $fetch_product["title"]; ?></h2>
                                <div class="rating">
                                    <span>⭐</span>
                                    <span>8.4</span>
                                </div>
                                <p><?php echo $fetch_product["release_date"]; ?></p>
                                <!-- <button name="watchlist_btn" class="watchlist_btn"><b>+ </b> Watchlist</button> -->
                                <?php
                        if(isset($_SESSION['user_id'])){?>
                            <button type="submit" class="watchlist_btn" name="add_to_watchlist"><b>+ </b> Watchlist</button>

                       <?php }else{?>
                        <button onclick="alert('Login To Continue')" type="submit" class="watchlist_btn"><b>+ </b> Watchlist</button>
                      <?php }?>
                                <a href='details.php?details=<?php echo $fetch_product['movie_id'] ?>'><button type="button"
                  class="details_btn" name="details">Details</button></a>
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