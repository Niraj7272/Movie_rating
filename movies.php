<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expandable Cards with Flexbox</title>
  <link rel="stylesheet" href="index1.css">
</head>

<body>
  <?php
  include 'header.php'
    ?>
    <h1 class="movies_heading">All Movies</h1>
  <div class="movies_body">
    <div class="container">
      <?php
      $select_products = mysqli_query($conn, "select * from movies ORDER BY movie_id DESC");

      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
          // echo $fetch_product['name'];
          ?>
          <form method="post" action="">
            <div class="card">
              <img class="background" src="admin/movies_poster/<?php echo $fetch_product["movies_poster"]; ?>">
              <div class="card-content">
                <h3 class="title"><span>⭐</span>6.2/10</h3>
                <h3 class="title"><?php echo $fetch_product["title"]; ?></h3>
                <a href='details.php?details=<?php echo $fetch_product['movie_id'] ?>'><button type="button"
                    class="button-title" name="details">Details</button></a>

              </div>
              <div class="backdrop"></div>
            </div>
          </form>
          <?php
        }
      } else {
        echo "<div class='empty_text'>No Movies Available</div>";
      }
      ?>
    </div>
  </div>
  <?php
include 'footer.php'
  ?>
</body>

</html>