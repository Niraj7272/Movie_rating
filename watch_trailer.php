<?php
include 'config.php';
session_start();

// Check if 'details' is set in the URL
if (isset($_GET['details']) && !empty($_GET['details'])) {
    $details_id = $_GET['details'];

    // Query to fetch movie details by movie_id
    $query = mysqli_query($conn, "SELECT * FROM `movies` WHERE movie_id = $details_id");

    if (mysqli_num_rows($query) > 0) {
        $fetch_data = mysqli_fetch_assoc($query);
    } else {
        echo "Movie not found.";
        exit;
    }
} else {
    // Handle the case where 'details' parameter is not present
    echo "Invalid movie ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Trailer</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <?php
    // Include header file if necessary
    include 'header.php';
    ?>

    <div class="watch_trailer_main_container">
        <div class="watch_trailer_box_one">
            <!-- Display the movie trailer -->
            <?php if (!empty($fetch_data["movies_trailer"])) { ?>
                <iframe src="<?php echo $fetch_data["movies_trailer"]; ?>" height="470px" width="1365px" frameborder="0" allowfullscreen></iframe>
            <?php } else { ?>
                <p>Trailer not available.</p>
            <?php } ?>
        </div>

        <!-- Back button -->
        <a href="javascript:history.back()" class="watch_trailer_back_button">Back</a>
    </div>
</body>

</html>
