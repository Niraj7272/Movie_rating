<?php
// Include the database connection file
include 'config.php';

// Get the current movie's ID from the query string (i.e., the movie whose details are being viewed)
$current_movie_id = isset($_GET['details']) ? $_GET['details'] : 0;

if (!$current_movie_id) {
    echo "No movie selected for recommendations.";
    exit;
}

// Fetch the genre(s) of the current movie
$genre_query = mysqli_query($conn, "
    SELECT g.genre_id, g.genre_name
    FROM movie_genres mg
    JOIN genres g ON mg.genre_id = g.genre_id
    WHERE mg.movie_id = $current_movie_id
");

if (mysqli_num_rows($genre_query) == 0) {
    echo "No genres found for this movie.";
    exit;
}

// Collect genre IDs in an array to use for fetching recommendations
$genre_ids = [];
while ($genre_row = mysqli_fetch_assoc($genre_query)) {
    $genre_ids[] = $genre_row['genre_id'];
}

// Convert the genre_ids array into a comma-separated string for SQL query
$genre_ids_str = implode(',', $genre_ids);

// Fetch recommended movies from the same genre(s), excluding the current movie
$select_movies = mysqli_query($conn, "
    SELECT m.movie_id, m.title, m.movies_poster, IFNULL(AVG(r.rating), 0) AS avg_rating
    FROM movies m
    JOIN movie_genres mg ON m.movie_id = mg.movie_id
    LEFT JOIN ratings r ON m.movie_id = r.movie_id
    WHERE mg.genre_id IN ($genre_ids_str)
    AND m.movie_id != $current_movie_id
    GROUP BY m.movie_id
    ORDER BY avg_rating DESC
    LIMIT 6
");

if (!$select_movies) {
    echo "Error: " . mysqli_error($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Recommendations</title>
  <link rel="stylesheet" href="index1.css">
</head>

<body>
  <h1 class="recommendation_heading">Recommendation</h1>
  <div class="recommendation_body">
    <div class="container_recommendation">
      <?php
      if (mysqli_num_rows($select_movies) > 0) {
        while ($fetch_movie = mysqli_fetch_assoc($select_movies)) {
          $average_rating = number_format($fetch_movie['avg_rating'], 1); // Round to 1 decimal place
          ?>
          <div class="recommendation_card">
            <img class="recommendation_background" src="admin/movies_poster/<?php echo $fetch_movie['movies_poster']; ?>">
            <div class="recommendation_card-content">
              <h3 class="recommendation_title"><span>⭐</span><?php echo $average_rating; ?> / 5</h3>
              <h3 class="recommendation_title"><?php echo $fetch_movie['title']; ?></h3>
              <a href='details.php?details=<?php echo $fetch_movie['movie_id'] ?>'><button type="button"
                  class="recommendation_button-title">Details</button></a>
            </div>
            <div class="recommendation_backdrop"></div>
          </div>
          <?php
        }
      } else {
        echo "<div class='empty_text'>No Recommendations Available Based on This Movie's Genre</div>";
      }
      ?>
    </div>
  </div>
</body>

</html>
