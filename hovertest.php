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
        .home_mainbox, .home_firstbox {
            width: 98.7vw;
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Set the background image for poster2 */
        .home_firstbox {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Smaller poster image (poster_image) overlay */
        .overlay-image {
            margin-right: 1200px;
            width: 100px;
            height: 100px;
            margin-top: 95px;
        }

        .overlay-image img {
            width: 200px;
            height: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);
        }

        /* Black transparent overlay at the bottom */
        .title-overlay {
            position: absolute;
            bottom: 0;
            width: 1100px;
            background:  rgba(0, 0, 0, 0.575); /* Black transparent color */
            padding: 20px;
            margin-left: 240px;
            height: 100px;
            text-align: center;
        }

        /* Movie title in white */
        .title-overlay h2 {
            color: white;
            font-size: 24px;
            margin: 0;
        }
    </style>
</head>
<body>

<div class="header_mainbox">
        <div class="header_navbar">
            <div class="header_logo">
                <img src="Rlogo.jpg" width="60px">
            </div>
            <div class="header_searchbox">
                <form method="GET" action="movies.php">
                    <input class="search_box" type="search" name="search" placeholder="Search Movies"
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button class="" type="submit">Search</button>
                </form>

            </div>
            <nav>
                <ul>
                    <li>
                        <h1 class="rating_pro">RATING Pro</h1>
                    </li>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <?php
                    if (isset($_SESSION['user_type'])) {
                        if ($_SESSION['user_type'] == 'admin') {
                            echo '<li><a href="admin/dashboard.php">Admin</a></li>';
                        } else {
                            echo '<li><a href="profile.php">Profile</a></li>';
                        }
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '<li><a href="logout.php" onclick="return confirm(\'You Are Sure You Want To Logout?\');"><button class="btnlogin"><b>Logout</b></button></a></li>';
                    } else {
                        echo '<li><a href="login.php"><button class="btnlogin">Login</button></a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="home_mainbox">
        <div class="home_firstbox" id="backgroundPoster" style="background-image: url('admin/movies_poster/<?php echo !empty($movies) ? htmlspecialchars($movies[0]['poster2'], ENT_QUOTES, 'UTF-8') : 'hovervideos/default.jpg'; ?>');">
            <!-- Overlay with poster_image -->
            <div class="overlay-image">
                <img src="admin/movies_poster/<?php echo !empty($movies) ? htmlspecialchars($movies[0]['movies_poster'], ENT_QUOTES, 'UTF-8') : 'hovervideos/default.jpg'; ?>" alt="Poster Image" id="posterImage" >
            </div>

            <!-- Black transparent overlay with movie title -->
            <div class="title-overlay">
                <h2 id="movieTitle"><?php echo !empty($movies) ? htmlspecialchars($movies[0]['title'], ENT_QUOTES, 'UTF-8') : 'No Movie Title'; ?></h2>
            </div>
        </div>

        <script>
            const moviePosters = [
                <?php foreach ($movies as $movie): ?>
                    {
                        background: "admin/movies_poster/<?php echo htmlspecialchars($movie['poster2'], ENT_QUOTES, 'UTF-8'); ?>",
                        poster: "admin/movies_poster/<?php echo htmlspecialchars($movie['movies_poster'], ENT_QUOTES, 'UTF-8'); ?>",
                        title: "<?php echo htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8'); ?>"
                    },
                <?php endforeach; ?>
            ];

            let currentIndex = 0;

            function changeImage() {
                const currentMovie = moviePosters[currentIndex];
                
                // Update the background image
                document.getElementById("backgroundPoster").style.backgroundImage = `url(${currentMovie.background})`;
                
                // Update the smaller poster image
                document.getElementById("posterImage").src = currentMovie.poster;

                // Update the movie title
                document.getElementById("movieTitle").innerText = currentMovie.title;

                currentIndex = (currentIndex + 1) % moviePosters.length;
            }

            setInterval(changeImage, 4000);
        </script>
    
    </div>
</body>
</html>
