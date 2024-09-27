<?php
session_start();
include 'config.php';
$where = "";

if (isset($_GET['search']) && !empty($_GET['search'])) {
  $search = mysqli_real_escape_string($conn, $_GET['search']);
  $where = "WHERE title LIKE '%$search%'";
}
$select_movies = "SELECT * FROM movies $where";
$fetch_movies = mysqli_query($conn, $select_movies);


// Fetch all movies
$select_products = mysqli_query($conn, "SELECT * FROM movies $where ORDER BY movie_id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Ratings</title>
  <link rel="stylesheet" href="index1.css">
</head>

<body>
  <?php include 'header.php'; ?>

  <h1 class="movies_heading">All Movies</h1>
  <div class="movies_body">
    <div class="container">
      <?php
      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
          // Get movie rating
          $movie_id = $fetch_product['movie_id'];
          $rating_query = mysqli_query($conn, "SELECT AVG(rating) AS avg_rating FROM ratings WHERE movie_id = $movie_id");
          $rating_data = mysqli_fetch_assoc($rating_query);
          $average_rating = number_format($rating_data['avg_rating'], 1); // Round to 1 decimal place
      
          ?>
          <div class="card">
            <img class="background" src="admin/movies_poster/<?php echo $fetch_product['movies_poster']; ?>">
            <div class="card-content">
              <h3 class="title"><span>⭐</span><?php echo $average_rating; ?> / 5</h3>
              <h3 class="title"><?php echo $fetch_product['title']; ?></h3>
              <a href='details.php?details=<?php echo $fetch_product['movie_id'] ?>'><button type="button"
                  class="button-title">Details</button></a>
            </div>
            <div class="backdrop"></div>
          </div>
          <?php
        }
      } else {
        echo "<div class='empty_text'>No Movies Available</div>";
      }
      ?>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>