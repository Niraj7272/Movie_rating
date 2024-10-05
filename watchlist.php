<?php
include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('404! PAGE NOT FOUND'); window.location.href='login.php';</script>";
    exit();
}

//removing selected item
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "Delete from `watchlist` where watchlist_id=$remove_id");
    header('location:watchlist.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Watchlist page</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <?php
    include 'header.php';
    $user_id = $_SESSION["user_id"];
    ?>
    <div class="watchlist_mainbox">
        <div class="watchlist_firstbox">
            <h1>Your Watchlist</h1>
            <p>Your Watchlist is the place to track the titles you want to watch. You can sort your Watchlist by the popularity score and arrange your titles in the order you want to see them.</p>
        </div>
        <div class="watchlist_secondbox">
            <div class="watchlist_secondbox_table">
                <table style="width:110%">
                    <?php
                    // Modified SQL query to exclude the non-existent rating column
                    $select_movies = mysqli_query($conn, "SELECT w.watchlist_id, w.user_id, w.movie_id, m.title AS movie_title, m.release_date, m.movies_poster AS image FROM watchlist w JOIN movies m ON w.movie_id = m.movie_id WHERE w.user_id = '$user_id'");

                    if (mysqli_num_rows($select_movies) > 0) {
                        while ($fetch_movies = mysqli_fetch_assoc($select_movies)) {
                            ?>
                            <tr>
                                <td class="table_one">
                                    <img src="admin/movies_poster/<?php echo $fetch_movies['image']; ?>" alt="" width="100px">
                                    <h3 class="table_one_one">
                                        <?php echo $fetch_movies['movie_title']; ?><br>
                                        <?php echo $fetch_movies['release_date']; ?>
                                    </h3>
                                    <div class="watclist_action">
                                        <a href="details.php?details=<?php echo $fetch_movies['movie_id']; ?>" class="view_watchlist_btn"><i class="fa-solid fa-eye"></i></a>  |
                                        <a href="watchlist.php?remove=<?php echo $fetch_movies['watchlist_id'] ?>"
                                            class="delete_watchlist_btn"
                                            onclick="return confirm('Are you sure you want to delete');">
                                            <i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php

                        }
                    } else {
                        echo "<div class='watchlist_empty_text'>Your Watchlist Is Empty</div>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>