<?php
@include 'config.php';

if(isset($_POST['submit'])){
    $fname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['conform_password']);

    $select = "SELECT * FROM users WHERE email = '$email' ";
    
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result)>0){
        $error[] = 'user already exist!';
    }else{
        $insert = "INSERT INTO users(fullname, email, phone,password) VALUES ('$fname', '$email', '$phone', '$pass')";
        mysqli_query($conn, $insert);
        header('location:login.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>SignUp page</title>
    <link rel ="stylesheet" href ="index.css">
    <style>
        
    </style>
</head>
<body>


<section>
        <div class="loginformbox">
            <div class="loginform-value">
                <form action="#" method="post">
                    <h2 class="login_head">Sign Up</h2>
                    <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        };
                    };
                    ?>
                    <div class="logininputbox">
                        <input type="text" name="fullname" required>
                        <label for="fullname">Fullname</label>
                    </div>
                    <div class="logininputbox">
                        <input type="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="logininputbox">
                        <input type="number" name="phone" required>
                        <label for="phone_no">Phone No</label>
                    </div>
                    <div class="logininputbox">
                        <input type="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="logininputbox">
                        <input type="password" name="conform_password" required>
                        <label for="conform_password">Conform Password</label>
                    </div>
                     <!-- <button>Submit</button>  -->
                    <input type="submit" name="submit" class="loginbtn" value="Sign up">
                    <div class="loginregister">
                        <p>Have an account <a href="Login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>