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
        <h1>Most Popular</h1>
        <div class="newtailer_buttons">
            <button id="prev">❮ prev</button>
            <button id="next">Next ❯</button>
        </div>
        <div class="movie-list" id="movieList">
            <div class="movie">
                <img src="hovervideos/two.jpeg" alt="House of the Dragon">
                <div class="movie-info">
                    <h2>House of the Dragon</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>8.4</span>
                    </div>
                    <p>June 16, Max</p>
                    <button name="watchlist_btn" class="watchlist_btn"><b>+ </b>  Watchlist</button>
                    <button name="details_btn" class="details_btn"><b>Details</b></button>
                </div>
            </div>
            <div class="movie">
                <img src="hovervideos/twoposter.jpeg" alt="The Boys">
                <div class="movie-info">
                    <h2>The Boys</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>8.7</span>
                    </div>
                    <p>June 13, Prime</p>
                    <button name="watchlist_btn" class="watchlist_btn"><b>+ </b>  Watchlist</button>
                    <button name="details_btn" class="details_btn"><b>Details</b></button>
                </div>
            </div>
            <div class="movie">
                <img src="hovervideos/twoposter.jpeg" alt="Gladiator II">
                <div class="movie-info">
                    <h2>Gladiator II</h2>
                    <div class="rating">
                        <span>⭐</span>
                    </div>
                    <p>November 22</p>
                    <button name="watchlist_btn" class="watchlist_btn"><b>+ </b>  Watchlist</button>
                    <button name="details_btn" class="details_btn"><b>Details</b></button>
                </div>
            </div>
            <div class="movie">
                <img src="hovervideos/oneposter.jpeg" alt="Longlegs">
                <div class="movie-info">
                    <h2>Longlegs</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>7.3</span>
                    </div>
                    <p>R</p>
                    <button name="watchlist_btn" class="watchlist_btn"><b>+ </b>  Watchlist</button>
                    <button name="details_btn" class="details_btn"><b>Details</b></button>
                </div>
            </div>
            <div class="movie">
                <img src="hovervideos/fourposter.jpeg" alt="Beverly Hills Cop: Axel F">
                <div class="movie-info">
                    <h2>Beverly Hills </h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>6.5</span>
                    </div>
                    <p>July 3, Netflix</p>
                    <button name="watchlist_btn" class="watchlist_btn"><b>+ </b>  Watchlist</button>
                    <button name="details_btn" class="details_btn"><b>Details</b></button>
                </div>
            </div>
            <div class="movie">
                <img src="hovervideos/threeposter.jpeg" alt="The Bear">
                <div class="movie-info">
                    <h2>The Bear</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>8.6</span>
                    </div>
                    <p>June 27, Hulu</p>
                    <button name="watchlist_btn" class="watchlist_btn"><b>+ </b>  Watchlist</button>
                    <button name="details_btn" class="details_btn"><b>Details</b></button>
                </div>
            </div>
        </div>
        <a href="upcomming.php" class="see-more">See more</a>
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
