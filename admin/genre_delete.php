<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $delete_query=mysqli_query($conn,"Delete from `genres` where genre_id=$delete_id") or die("query failed!");
    if($delete_query){
        echo"Genre  deleted";
        header('location:genre_table.php');
    }else{
        echo"Genre not deleted";
        header('location:genre_table.php');
    }
}
?>