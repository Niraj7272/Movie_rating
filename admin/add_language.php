<?php
include '../config.php';
session_start();
?>
<?php
if(isset($_POST['add_movie_language'])){
    $name = $_POST['name'];

    $insert = "INSERT INTO language(language_title) VALUES('$name')";

    mysqli_query($conn, $insert);
    header('location:login.php');
} else {
    echo " ";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie Language page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="addmovietype_container_body">
    <div class="addmovietype_container">
        <form action="" method="post">
         <h1 class="addmovietype_heading">Add Movies Language</h1>
         <input type="text" name="name" placeholder="Enter Movie Language" class="addmovietype_inputbox" required ><br>
         <input type="submit" class="addmovietype_btn" value="Add Language" name="add_movie_language" >
        <a href="" class="addmovietype_cancel_btn">Cancel</a>
        </form>
    </div>
</body>
</html>