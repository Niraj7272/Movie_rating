<?php
session_start();
include 'config.php';

// Fetch movies from the database
$query = "SELECT * FROM movies LIMIT 5"; // Fetch 5 movies for example
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
    <!-- <link rel="stylesheet" href="index.css"> -->
    <style>
        body {
            margin: 0;
            overflow: hidden; /* Prevents scrollbars */
        }

        .background-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1; /* Sends it to the back */
        }

        .background-slider img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures the image covers the entire area */
            position: absolute;
            animation: slide 20s infinite; /* Change duration for speed */
        }

        @keyframes slide {
            0% { opacity: 1; }
            20% { opacity: 1; }
            25% { opacity: 0; }
            95% { opacity: 0; }
            100% { opacity: 1; }
        }

        .content {
            position: absolute;
            top: 65%;
            left: 10%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .poster {
            margin-top: 20px;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }

        .poster img {
            width: 200px; /* Size of the small poster */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="background-slider">
        <?php foreach ($movies as $movie): ?>
            <img src="admin/movies_poster/<?php echo htmlspecialchars($movie['movies_poster'], ENT_QUOTES, 'UTF-8'); ?>" alt="">
        <?php endforeach; ?>
    </div>

    <div class="content">
        <div class="poster">
            <img src="admin/movies_poster/<?php echo !empty($movies) ? htmlspecialchars($movies[0]['movies_poster'], ENT_QUOTES, 'UTF-8') : 'hovervideos/default.jpg'; ?>" alt="">
            <h1><?php echo !empty($movies) ? htmlspecialchars($movies[0]['title'], ENT_QUOTES, 'UTF-8') : 'Movie Title'; ?></h1>
            <p><?php echo !empty($movies) ? htmlspecialchars($movies[0]['release_date'], ENT_QUOTES, 'UTF-8') : 'Movie Description'; ?></p>
        </div>
    </div>

    <script>
        const movieTitles = [
            <?php foreach ($movies as $movie): ?>
                "<?php echo htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8'); ?>",
            <?php endforeach; ?>
        ];

        const movieDescriptions = [
            <?php foreach ($movies as $movie): ?>
                "<?php echo htmlspecialchars($movie['description'], ENT_QUOTES, 'UTF-8'); ?>",
            <?php endforeach; ?>
        ];

        let currentIndex = 0;

        function changeContent() {
            currentIndex = (currentIndex + 1) % movieTitles.length;
            document.querySelector('.poster img').src = "admin/movies_poster/" + moviePosters[currentIndex];
            document.querySelector('.poster h1').textContent = movieTitles[currentIndex];
            document.querySelector('.poster p').textContent = movieDescriptions[currentIndex];
        }

        setInterval(changeContent, 4000); // Change content every 4 seconds
    </script>
</body>
</html>
