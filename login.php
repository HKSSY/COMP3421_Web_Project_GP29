<?php
session_start();
// If the user is logged in redirect to the home page
if (isset($_SESSION['loggedin'])) {
	header('location: index.php');
	exit;
} elseif (isset($_COOKIE['rememberme_user_id'], $_COOKIE['rememberme_user_password'])) {
    header("location: php/decrypt_cookie_auth.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Security-Policy" content="default-src *; script-src 'self' 'unsafe-inline' 'unsafe-eval'; img-src 'self'">
        <title>Login</title>
        <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
        <link rel="manifest" href="img/site.webmanifest">
        <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="img/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="img/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        <link href="css/login.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="header">
            <div class="content-wrapper">
                <a href="index.php"><h1>Computer Parts Shop</h1></a>
                <nav>
                </nav>
                <div class="link-icons">
                </div>
            </div>
        </div>
        <div class="login">
            <h1>Login</h1>
            <?php
                if(isset($_SESSION["error"])){
                    $error = $_SESSION["error"];
                    echo "<p class='error'>";
                    echo "<span>$error</span>";
                    echo "<p>";
                }
            ?>
            <?php
                if(isset($_SESSION["successful"])){
                    $successful = $_SESSION["successful"];
                    echo "<p class='successful'>";
                    echo "<span>$successful</span>";
                    echo "<p>";
                }
            ?>
            <form action="php/authenticate.php" method="post"> 
                <input type="text" name="user_id" placeholder="Email" id="user_id" required>
                <input type="password" name="password" placeholder="Password" id="password" required>
                <p>
                    <input type="checkbox" id="login_remember" name="login_remember"> 
                    <label for="login_remember">Remember me</label>
                    <br>    
                    Don’t have account ? <a href="sign_up.php">Sign up</a>
                </p>
                <input type="submit" value="Login">          
            </form>
        </div>
        <div class="footer">
            <div class="content-wrapper">
                <p>&copy; <script src="js/year.js"></script> Computer Parts Shop</p>
            <div>
        </div>
    </body>
    <script type = "text/javascript">
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>   
</html>
<?php
    unset($_SESSION["error"]);
    unset($_SESSION["successful"]);
?>