<?php
session_start();
require '../config.php';

// Fetch all genres
$select_genres = mysqli_query($conn, "SELECT * FROM `genres`");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input and insert movie details
    $movie_name = mysqli_real_escape_string($conn, $_POST['moviename']);
    $release_date = mysqli_real_escape_string($conn, $_POST['releasedate']);
    $type_id = mysqli_real_escape_string($conn, $_POST['type']);
    $language_id = mysqli_real_escape_string($conn, $_POST['language']);
    
    // Insert the movie into the movies table
    $insert_movie = "INSERT INTO `movies` (`title`, `release_date`, `language_id`, `type_id`) 
                     VALUES ('$movie_name', '$release_date', '$language_id', '$type_id')";
    if (mysqli_query($conn, $insert_movie)) {
        $movie_id = mysqli_insert_id($conn); // Get the last inserted movie_id
        
        // Insert genres into the movie_genres table
        if (isset($_POST['genres'])) {
            foreach ($_POST['genres'] as $genre_id) {
                $insert_genre = "INSERT INTO `movie_genres` (`movie_id`, `genre_id`) 
                                 VALUES ('$movie_id', '$genre_id')";
                mysqli_query($conn, $insert_genre);
            }
        }
        echo "Movie added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movies Page</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body class="add_movie_main_container_body">
    <div class="add_movies_container">
        <form action="" method="POST" enctype="multipart/form-data" >
            <h1 class="add_movies_header">Add MOVIES</h1>
            
            <!-- Movie Name Input -->
            <input type="text"  placeholder="Enter Movie Name" name="moviename" required class="add_movies_inputbox">
            
            <!-- Release Date Input -->
            <input type="date" placeholder="Date of release" name="releasedate" required class="add_movies_inputbox">
            
            <!-- Movie Type Dropdown -->
            <select name="type" class="inputboxone" required>
                <?php
                $select_type = mysqli_query($conn, "SELECT * FROM `type`");
                while ($row_type = mysqli_fetch_assoc($select_type)) {
                    echo "<option value='{$row_type['type_id']}'>{$row_type['type_title']}</option>";
                }
                ?>
            </select>  

            <!-- Movie Language Dropdown -->
            <select name="language" class="inputboxone" required>
                <?php
                $select_language = mysqli_query($conn, "SELECT * FROM `language`");
                while ($row_language = mysqli_fetch_assoc($select_language)) {
                    echo "<option value='{$row_language['language_id']}'>{$row_language['language_title']}</option>";
                }
                ?>
            </select>
                <input name="image"  class="add_movies_inputbox" type="file">
                <input type="url" id="videoURL" class="add_movies_inputbox" placeholder="Enter YouTube Video URL" required>

            <!-- Custom Genre Multi-select Dropdown -->
            <div class="dropdown">
                <button type="button" class="dropbtn">Select Genres</button>
                <div class="dropdown-content">
                    <?php
                    while ($row_genre = mysqli_fetch_assoc($select_genres)) {
                        echo "<label><input type='checkbox' name='genres[]' value='{$row_genre['genre_id']}'> {$row_genre['genre_name']}</label>";
                    }
                    ?>
                </div>
            </div>

            <br><br>
            <!-- Submit Button -->
            <input type="submit" value="Add Movie" class="add_movies_submit-button">
            <a href="" class="add_movies_back">Back</a>
        </form>
    </div>

    <script>
        // Toggle dropdown menu visibility
        document.querySelector('.dropbtn').addEventListener('click', function() {
            this.parentNode.classList.toggle('active');
        });

        // Prevent collapse on selecting genre options
        document.querySelector('.dropdown-content').addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent dropdown collapse
        });

        // Close dropdown if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                let dropdowns = document.querySelectorAll('.dropdown');
                dropdowns.forEach(function(dropdown) {
                    if (dropdown.classList.contains('active')) {
                        dropdown.classList.remove('active');
                    }
                });
            }
        };
    </script>
</body>
</html>
