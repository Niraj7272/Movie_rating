<?php
session_start();
include 'config.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to rate the movie'); window.location.href='errorpage.php';</script>";
    exit();
}

// Check if form is submitted
if (isset($_POST['submit_btn'])) {

    // Get user_id from the session (since user is logged in)
    $user_id = $_SESSION['user_id']; // User ID from session
    $movie_id = mysqli_real_escape_string($conn, $_GET['details']); // Movie ID from URL
    $rating = mysqli_real_escape_string($conn, $_POST['rating']); // Get rating from form and sanitize
    $comment = mysqli_real_escape_string($conn, $_POST['comment']); // Get optional comment
    $rated_at = date("Y-m-d H:i:s"); // Current timestamp

    // Validate: Ensure a rating has been selected
    if (!isset($rating) || empty($rating)) {
        echo "<script>alert('Please select a rating'); window.location.href='rating_page.php';</script>";
        exit();
    }

    // Check if the user has already rated this movie
    $check_query = "SELECT * FROM ratings WHERE movie_id='$movie_id' AND user_id='$user_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('You have already rated this movie'); window.location.href='details.php?details=$movie_id';</script>";
    } else {
        // Insert the rating into the database
        $insert_query = "INSERT INTO ratings (movie_id, user_id, rating, comment, rated_at)
                         VALUES ('$movie_id', '$user_id', '$rating', '$comment', '$rated_at')";

        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('Rating submitted successfully'); window.location.href='details.php?details=$movie_id';</script>";
        } else {
            echo "<script>alert('Error submitting rating: " . mysqli_error($conn) . "'); window.location.href='details.php?details=$movie_id';</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Rating System</title>
    <style>
        .rating_container {
            background: gray;
            margin-left: 400px;
            margin-right: 400px;
            height: 390px;
            margin-top: 100px;
            padding: 10px;
        }

        h1 {
            color: white;
            text-align: center;
            font-size: 45px;
        }

        h2 {
            text-align: center;
            font-size: 30px;
        }

        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            font-size: 2rem;
            width: fit-content;
            display: flex;
            justify-content: center;
            margin-left: 190px;
            margin-top: 30px;
            gap: 7px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            color: lightgray;
            cursor: pointer;
        }

        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: gold;
        }

        .rating_btn {
            margin-left: 150px;
            padding: 10px;
            font-size: 15px;
            margin-top: 20px;
            color: black;
            background: yellow;
            cursor: pointer;
        }

        .back_btn {
            background: red;
            width: 180px;
            text-align: center;
            padding: 5px 24px;
            font-size: 25px;
            text-decoration: none;
            margin-left: 20px;
            color: white;
            cursor: pointer;
        }

        .comment_area {
            display: block;
            width: 80%;
            margin: 20px auto;
            font-size: 16px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    include 'config.php';
    $details_id = $_GET['details'];

    // Fetch movie details
    $select_product = mysqli_query($conn, "SELECT * FROM movies WHERE movie_id=$details_id");

    if (mysqli_num_rows($select_product) > 0) {
        $movie = mysqli_fetch_assoc($select_product);
    ?>
        <div class="rating_container">
            <h1>Rate Us</h1>
            <h2><?php echo $movie['title']; ?></h2>
            <form action="" method="POST">
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5" title="5 stars">★</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4" title="4 stars">★</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3" title="3 stars">★</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2" title="2 stars">★</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1" title="1 star">★</label>
                </div>

                <textarea name="comment" class="comment_area" placeholder="Leave a comment (optional)"></textarea>

                <button type="submit" name="submit_btn" class="rating_btn">Submit Rating</button>
                <a href="details.php?details=<?php echo $movie['movie_id']; ?>" class="back_btn">Back</a>
            </form>
        </div>
    <?php
    } else {
        echo 'No movie found.';
    }
    ?>
</body>

</html>
