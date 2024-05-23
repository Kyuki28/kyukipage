<?php 
 
include 'config.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
 
?>

<html>
    <head>
        <title>REGISTER PAGE</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                outline: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }

            body {
                background-image: url(assets/images/cover2.jpg);
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }

            .container-login {
                position: absolute;
                left: 50%;
                top: 50%;
                padding: 50px 25px;
                transform: translate(-50%, -50%);
                width: 300px;
                background-color: rgba(255, 255, 255, 0.459);
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.596);
                border-radius: 50px;
                display: grid;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(2px);
            }

            .h1-login {
                text-align: center;
                color:  rgba(0, 255, 255, 0.767);
                text-shadow: 1px 1px 1px black;
                margin-bottom: 20px;
                text-transform: uppercase;
                border-bottom: 2px solid rgba(0, 105, 105, 0.767);
            }

            .label-login {
                color: rgb(0, 112, 112);
                font-size: 15px;
                text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.144);
            }

            .input-login {
                width: calc(100% -20px);
                padding: 8px 20px;
                margin-bottom: 15px;
                border: none;
                background-color: transparent;
                border-bottom: 1px solid rgba(0, 105, 105, 0.767);
                color: rgb(3, 97, 97);
                transition: 0.2s;
            }
            
            .input-login:hover {
                transform: scale(1.03);
                transition: 0.2s;
                box-shadow: 0 0 5px rgba(0, 80, 80, 0.644);
            }

            .button-login {
                width: 100%;
                padding: 5px 0;
                border: none;
                background-color: rgba(0, 80, 80, 0.644);
                color: azure;
                font-size: 15px;
                border-radius: 50px;
                transition: 0.2s ease;
            }
            
            .button-login:hover {
                transform: scale(1.03);
                transition: 0.2s ease;
                box-shadow: 0 0 10px rgba(0, 80, 80, 0.644);
            }
            
            .login-register {
                font-size: 15px;
                color: rgb(0, 80, 80);
            }
            
            .a-login-register {
                list-style-type: none;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container-login">
            <!--login page-->
            <h1 class="h1-login">REGISTER</h1>
            <form class="form-login">
                <label class="label-login">Username</label><br>
                <input class="input-login" type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required><br>
                <label class="label-login">Email</label><br>
                <input class="input-login" type="email" placeholder="Email" name="email" value="<?php echo $email;?>" required/><br>
                <label class="label-login">Password</label><br>
                <input class="input-login" type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required/><br>
                <label class="label-login"> Confirm Password</label><br>
                <input class="input-login" type="password" placeholder="Confirm password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required/><br>
                <button name="submit" class="button-login">Register</button>

                <p class="login-register">Anda sudah mempunyai akun? <a href="index.php" class="a-login-register">Log in</a></p>

            </form>
            <!--login page end-->
        </div>
    </body>
</html>