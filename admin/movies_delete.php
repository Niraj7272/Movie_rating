<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    // First, delete related rows from the movie_genres table
    $delete_genres_query = mysqli_query($conn, "DELETE FROM `movie_genres` WHERE movie_id = $delete_id") or die("Failed to delete movie genres!");

    // Then, delete the movie
    $delete_movie_query = mysqli_query($conn, "DELETE FROM `movies` WHERE movie_id = $delete_id") or die("Failed to delete movie!");

    if($delete_movie_query){
        echo "Movie deleted";
        header('location:movies_table.php');
    } else {
        echo "Movie not deleted";
        header('location:movies_table.php');
    }
}

?>