<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Watchlist page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
    <div class="watchlist_mainbox">
        <div class="watchlist_firstbox">
            <h1>Your Watchlist</h1>
            <p>Your Watchlist is the place to track the titles you want to watch. You can sort your Watchlist by the IMDb rating, popularity score and arrange your titles in the order you want to see them.</p>
        </div>
        <div class="watchlist_secondbox">
            <div class="watchlist_secondbox_table">
                <table style="width:110%">
                    <tr>
                         <td class="table_one">
                            <img src="hovervideos/one.jpg" alt="" width="150px">
                            <h3 class="table_one_one">
                                House Of The Dragon<br>
                                2022  20 eps  TV-MA
                            </h3>
                        </td>
                         <td>View Delete</td>
                    </tr>
                </table>
                <table style="width:110%">
                    <tr>
                         <td class="table_one">
                            <img src="hovervideos/one.jpg" alt="" width="150px">
                            <h3 class="table_one_one">
                                House Of The Dragon<br>
                                2022  20 eps  TV-MA
                            </h3>
                        </td>
                         <td>View Delete</td>
                    </tr>
                </table>
            </div>
                <div class="watchlist_secondbox_one">
                    <h1>More To Explore.</h1>
            
                    <table style="width:70%">
                    <tr>
                         <td class="watchlist_secondbox_one_one">
                            <a href="watchlist.php"><h1>Your Watchlist</h1></a>
                            <img src="hovervideos/one.jpg" alt="" width="30px" class="watchlist_secondbox_one_a">
                        </td>
                    </tr>
                </table>
                <table style="width:70%">
                    <tr>
                         <td class="watchlist_secondbox_one_two">
                            <a href="myrating.php"><h1>Your Rating</h1></a>
                            <img src="hovervideos/one.jpg" alt="" width="30px" class="watchlist_secondbox_one_a">
                        </td>
                    </tr>
                </table><br><br><br>
                <table style="width:70%">
                    <tr>
                         <td class="watchlist_secondbox_one_three">
                            <h1>Feedback</h1>
                            <a href=""><h2>Tell what you think about this feature.</h2></a>
                        </td>
                    </tr>
                </table><br>
                </div>
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
</body>
</html>