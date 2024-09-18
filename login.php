<?php 
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM users WHERE email ='$email' AND password ='$pass'";
    $query = mysqli_query($conn, $select);
    $row = mysqli_num_rows($query);
    if($row == 1){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        $fetch=  mysqli_fetch_array($query);
        $_SESSION['user_id'] = $fetch['user_id'];
        $_SESSION['fname'] = $fetch['fname'];
        $_SESSION['user_type'] = $fetch['user_type'];

   header('location:index.php');
    }else{
    
        $error[] = 'Invalid Email Or Password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <section>
        <div class="loginform-box">
            <div class="loginform-value">
                <form action="" method="post">
                    <h2 class="login_head">Login</h2>
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<span class="error-msg">'.$error.'</span>';
                        }
                    }
                    ?>
                    <div class="logininputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="email">Email</label>

                    </div>
                    <div class="logininputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="password">Password</label>

                    </div>
                    <!-- <div class="loginforget">
                        <label for=""><input type="checkbox">Remember Me <a href="#">Forget Password</a></label>
                    </div> -->
                    <input type="submit" name="submit" class="loginbtn" value="Log in">
                    <div class="loginregister">
                        <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>