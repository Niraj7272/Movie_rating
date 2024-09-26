<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header page</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="header_mainbox">
        <div class="header_navbar">
            <div class="header_logo">
                <img src="Rlogo.jpg" width="60px">
            </div>
            <div class="header_searchbox">
                <form method="GET" action="movies.php">
                    <input class="search_box" type="search" name="search" required placeholder="Search Movies"
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
</body>

</html>