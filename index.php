<?php
session_start();
include 'config.php';
$where = "";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "WHERE title LIKE '%$search%'";
} 
$select_movies = "SELECT * FROM movies $where" ;
$fetch_movies = mysqli_query($conn, $select_movies);

// Fetch all movies
$select_products = mysqli_query($conn, "SELECT * FROM movies ORDER BY movie_id DESC");


// Fetch movies from the database
$query = "SELECT * FROM movies";
$result = $conn->query($query);
$movies = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .home_second-box {
            overflow: hidden;
            position: relative;
            height: 500px; /* Adjust based on your image size */
        }

        .image-container {
            position: absolute;
            width: 25%;
            transition: transform 0.5s ease;
        }

        .image-container img {
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="home_mainbox">
        <div class="home_box">
            <div class="home_firstbox">
                <img src="admin/movies_poster/<?php echo !empty($movies) ? htmlspecialchars($movies[0]['poster2'], ENT_QUOTES, 'UTF-8') : 'hovervideos/default.jpg'; ?>" alt="" id="slideimage">
            </div>
            <script>
                const moviePosters = [
                    <?php foreach ($movies as $movie): ?>
                        "admin/movies_poster/<?php echo htmlspecialchars($movie['poster2'], ENT_QUOTES, 'UTF-8'); ?>",
                    <?php endforeach; ?>
                ];

                let currentIndex = 0;

                function changeImage() {
                    document.getElementById("slideimage").src = moviePosters[currentIndex];
                    currentIndex = (currentIndex + 1) % moviePosters.length;
                }
                
                setInterval(changeImage, 4000);
            </script>

            <div class="home_second">
                <h1 class="up_next">Up Next</h1>
                <div class="home_second-box" id="upNextImages">
                        <div class="image-container">
                            <img src="admin/movies_poster/<?php echo !empty($movies) ? htmlspecialchars($movies[0]['movies_poster'], ENT_QUOTES, 'UTF-8') : 'hovervideos/default.jpg'; ?>" alt="" id="slideimage">
                            <img src="admin/movies_poster/<?php echo !empty($movies) ? htmlspecialchars($movies[0]['movies_poster'], ENT_QUOTES, 'UTF-8') : 'hovervideos/default.jpg'; ?>" alt="" id="slideimage">
                            <img src="admin/movies_poster/<?php echo !empty($movies) ? htmlspecialchars($movies[0]['movies_poster'], ENT_QUOTES, 'UTF-8') : 'hovervideos/default.jpg'; ?>" alt="" id="slideimage">
                            <img src="admin/movies_poster/<?php echo !empty($movies) ? htmlspecialchars($movies[0]['movies_poster'], ENT_QUOTES, 'UTF-8') : 'hovervideos/default.jpg'; ?>" alt="" id="slideimage">
                        </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'newtailer.php'; ?>
    <?php include 'toprating.php'; ?>
    <?php include 'mostpopular.php'; ?>
    <?php include 'footer.php'; ?>

    <script>
        const imageContainers = document.querySelectorAll('.image-container');
        let currentIndex = 0;

        function slideImages() {
            // Move the current image up
            imageContainers[currentIndex].style.transform = 'translateY(-100%)';

            // Update the index for the next image
            currentIndex = (currentIndex + 1) % imageContainers.length;

            // Move the next image into view
            imageContainers[currentIndex].style.transform = 'translateY(0)';
        }

        // Initial setup: move all but the first image out of view
        imageContainers.forEach((container, index) => {
            if (index !== 0) {
                container.style.transform = 'translateY(100%)';
            }
        });

        setInterval(slideImages, 4000); // Change images every 4 seconds
    </script>
</body>
</html>
