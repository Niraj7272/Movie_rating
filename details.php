<?php
session_start();
include "config.php";
$details_id = $_GET['details'];

if (isset($_GET['details'])) {
    $details_id = $_GET['details'];
    $query = mysqli_query($conn, "select * from `movies` WHERE movie_id=$details_id");
    if (mysqli_num_rows($query) > 0) {
        $fetch_data = mysqli_fetch_assoc($query);
    }
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
    <?php include "header.php" ;?>
    
    <form method="post" action="">
    <div class="detail_container">
        <div class="detail_first_box">
             <img src="admin/movies_poster/<?php echo $fetch_data["movies_poster"]; ?>" height="500px" width="400px" class="detail_image">
        </div>
        <div class="detail_second_box">
            <embed src="<?php echo $fetch_data["movies_trailer"]; ?>" height="370px" width="800px" type="">
           <h1><?php echo $fetch_data["title"]; ?><a href="rating.php?details=<?php echo $fetch_data['movie_id'] ?>" class="rate_me_btn">Rate</a></h1>
           <hr><br>
           <h3>Date Of Release: <?php echo $fetch_data["release_date"]; ?></h3><br>
            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi nulla animi quidem eveniet, nihil ea sapiente modi possimus magni consectetur? Voluptatibus delectus adipisci aliquid repudiandae aspernatur in illo porro ab.</span><br><br>
            <button onclick="alert('Login To Continue')" type="submit" class="detail_add-to-watchlist-btn">Add To Watchlist</button>
            <a href="index.php" class="detail_back">Back</a>

        </div>
    </div>
    </form>
    <?php
     include 'footer.php';
    ?>
   
</body>
</html>