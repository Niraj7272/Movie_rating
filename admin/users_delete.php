<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    // First, delete related rows from the ratings table
    $delete_ratings_query = mysqli_query($conn, "DELETE FROM `ratings` WHERE user_id = $delete_id") or die("Failed to delete ratings!");

    // Then, delete the user
    $delete_user_query = mysqli_query($conn, "DELETE FROM `users` WHERE user_id = $delete_id") or die("Failed to delete user!");

    if($delete_user_query){
        echo "User deleted";
        header('location:users_table.php');
    } else {
        echo "User not deleted";
        header('location:users_table.php');
    }
}

?>