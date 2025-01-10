<?php
include '../config.php';
session_start();
$user_id = $_SESSION["user_id"];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('404! PAGE NOT FOUND'); window.location.href='../login.php';</script>";
    exit();
}

// Fetch user info
$select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id='$user_id'");
$fetch_user = mysqli_fetch_assoc($select_user);

// Pagination Logic
$records_per_page = 5;  
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

// Fetch the total number of movies
$total_movies_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM movies");
$total_movies = mysqli_fetch_assoc($total_movies_query)['total'];
$total_pages = ceil($total_movies / $records_per_page);

// Fetch movies with genre, language, and type for the current page
$query = "
    SELECT 
        movies.movie_id, movies.title, movies.release_date, movies.movies_poster, 
        GROUP_CONCAT(genres.genre_name SEPARATOR ', ') AS genre_names, 
        language.language_title, type.type_title 
    FROM 
        movies 
    LEFT JOIN movie_genres ON movies.movie_id = movie_genres.movie_id 
    LEFT JOIN genres ON movie_genres.genre_id = genres.genre_id
    LEFT JOIN language ON movies.language_id = language.language_id 
    LEFT JOIN type ON movies.type_id = type.type_id 
    GROUP BY movies.movie_id 
    LIMIT $start_from, $records_per_page";
$rows = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
<div class="sidebar">
    <div class="logo"><h4>Movie Rating</h4></div>
    <ul class="menu">
        <li><a href="dashboard.php"><i><img src="../admin/icons/dashboard.png" class="side-icon"></i><span>Dashboard</span></a></li>
        <li><a href="../profile.php"><i><img src="../admin/icons/profile.png" class="side-icon"></i><span>Profile</span></a></li>
        <li class="active"><a href="movies_table.php"><i><img src="../admin/icons/movies.png" class="side-icon"></i><span>Movies</span></a></li>
        <li><a href="users_table.php"><i><img src="../admin/icons/add-user.png" class="side-icon"></i><span>Users</span></a></li>
        <li><a href="genre_table.php"><i><img src="../admin/icons/addgenre.png" class="side-icon"></i><span>Add Genre</span></a></li>
        <li><a href="language_table.php"><i><img src="../admin/icons/addlanguage.png" class="side-icon"></i><span>Add Language</span></a></li>
        <li><a href="type_table.php"><i><img src="../admin/icons/addtype.png" class="side-icon"></i><span>Add Type</span></a></li>
        <li class="logout">
            <?php
            if (isset($_SESSION['user_type'])) {
                echo '<a href="logout.php" onclick="return confirm(\'Are you sure you want to logout?\');"><i><img src="../admin/icons/log-out.png" class="side-icon"></i><span>Logout</span></a>';
            }
            ?>
        </li>
    </ul>
</div>

<!-- main body section -->
<div class="main-content">
    <div class="header-wrapper">
        <div class="header-title"><h2>All Movies</h2></div>
        <div class="user-info">
            <a href="../profile.php"><img src="../admin/profile/<?php echo $fetch_user['profile_image'] ?>" alt=""></a>
            <select onchange="location = this.value;">
                <option value="../profile.php">Profile</option>
                <option value="../index.php">Home</option>
                <option value="../logout.php" onclick="return confirm('Are you sure you want to logout?');">Logout</option>
            </select>
        </div>
    </div>

    <div class="tabular-wrapper">
        <h3 class="main-title">Movies List</h3>
        <a href="add_movies.php" class="add-admin-btn">Add Movies</a>
        <div class="table-container">
            <?php
            if (mysqli_num_rows($rows) > 0) {
                echo '<table>
                        <thead>
                            <tr>
                                <th>SI No</th>
                                <th>Movies Title</th>
                                <th>Release Date</th>
                                <th>Rating</th>
                                <th>Genres</th>
                                <th>Language</th>
                                <th>Type</th>
                                <th>Poster</th>
                                <th>Action</th>
                            </tr>
                        </thead>';
                $i = $start_from + 1;
                while ($row = mysqli_fetch_assoc($rows)) {
                    $movie_id = $row['movie_id']; // Get movie ID for current row
                    // Fetch average rating for the current movie
                    $rating_query = mysqli_query($conn, "SELECT AVG(rating) AS avg_rating FROM ratings WHERE movie_id = $movie_id");
                    $rating_data = mysqli_fetch_assoc($rating_query);
                    $average_rating = number_format($rating_data['avg_rating'], 1); // Round to 1 decimal place                
                    echo "<tr>
                        <td>$i</td>
                        <td>{$row['title']}</td>
                        <td>{$row['release_date']}</td>
                        <td>{$average_rating} / 5</td>
                        <td>{$row['genre_names']}</td>
                        <td>{$row['language_title']}</td>
                        <td>{$row['type_title']}</td>
                        <td><img src='movies_poster/{$row['movies_poster']}' height='100px'></td>
                        <td>
                            <a href='movies_delete.php?delete={$row['movie_id']}' class='delete_product_btn' onclick='return confirm(\"Are you sure you want to delete?\");'>
                                <i class='fas fa-trash'></i>
                            </a>
                        </td>
                    </tr>";
                    $i++;
                }
                echo '</table>';
            } else {
                echo "<div class='empty_text'>No Movies Available</div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Pagination Section -->
    <div class="pagination">
        <?php if ($total_pages > 1) { ?>
            <ul>
                <?php if ($page > 1) { ?>
                    <li><a href="movies_table.php?page=<?php echo $page - 1; ?>">Previous</a></li>
                <?php } ?>
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li><a href="movies_table.php?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a></li>
                <?php } ?>
                <?php if ($page < $total_pages) { ?>
                    <li><a href="movies_table.php?page=<?php echo $page + 1; ?>">Next</a></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>
</body>
</html>
