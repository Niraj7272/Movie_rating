<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    // First, delete related rows from the movies table
    $delete_movies_query = mysqli_query($conn, "DELETE FROM `movies` WHERE language_id = $delete_id") or die("Failed to delete movies!");

    // Then, delete the language
    $delete_language_query = mysqli_query($conn, "DELETE FROM `language` WHERE language_id = $delete_id") or die("Failed to delete language!");

    if($delete_language_query){
        echo "Language deleted";
        header('location:language_table.php');
    } else {
        echo "Language not deleted";
        header('location:language_table.php');
    }
}

?>