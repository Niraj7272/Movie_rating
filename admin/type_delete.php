<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    // First, delete related rows from the ratings table
    $delete_ratings_query = mysqli_query($conn, "DELETE FROM `ratings` WHERE movie_id IN (SELECT movie_id FROM `movies` WHERE type_id = $delete_id)") or die("Failed to delete ratings!");

    // Then, delete related rows from the movie_genres table
    $delete_genres_query = mysqli_query($conn, "DELETE FROM `movie_genres` WHERE movie_id IN (SELECT movie_id FROM `movies` WHERE type_id = $delete_id)") or die("Failed to delete movie genres!");

    // Then, delete related rows from the movies table
    $delete_movies_query = mysqli_query($conn, "DELETE FROM `movies` WHERE type_id = $delete_id") or die("Failed to delete movies!");

    // Finally, delete the type
    $delete_type_query = mysqli_query($conn, "DELETE FROM `type` WHERE type_id = $delete_id") or die("Failed to delete type!");

    if($delete_type_query){
        echo "Type deleted";
        header('location:type_table.php');
    } else {
        echo "Type not deleted";
        header('location:type_table.php');
    }
}
?>
