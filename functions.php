<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'sp8xY4eA`(.#V?hw';
    $DATABASE_NAME = 'comp3421_db';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
    session_destroy();
    session_start();
	//$_SESSION['loggedin'] = 'yes';
	//if(!isset($_SESSION['loggedin'])) {
	//	header('Location: sign_up.php');
	//	exit;
	//}
}

// Display alert message
/*function alert_msg($msg) {
    echo ('<script>alert("'.$msg.'")</script>');
}
<meta http-equiv="Content-Security-Policy" content="img-src 'self'; frame-src 'self'">
*/

// Template header, feel free to customize this
function template_header($title) {
// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
//If logged in, display the logout button and the profile button. 
if (isset($_SESSION['loggedin'])) {
    $login_logout_button = '<a href="php/logout.php"><i class="fas fa-sign-out-alt"></i></a>';
    $profile_button = '<a href="profile.php" ><i class="fas fa-user"></i></a>';
}else{
    $login_logout_button = '<a href="login.php"><i class="fas fa-sign-in-alt"></i></a>';
}
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
        <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
        <link rel="manifest" href="img/site.webmanifest">
        <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="img/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="img/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        <!-- link to css -->
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/slideshow_gallery.css" rel="stylesheet" type="text/css">
		<link href="css/payment_form.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <a href="index.php" style="text-decoration: none"><h1>Computer Parts Shop</h1></a>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                </nav>
                <div class="link-icons">
                    $profile_button
                    <a href="index.php?page=cart"><i class="fas fa-shopping-cart"></i><span>$num_items_in_cart</span></a>
                    <!--<a href="newcart.php"><i class="fas fa-poll-h"></i></a>-->
                    $login_logout_button
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year Computer Parts Shop</p>
            </div>
        </footer>
        <script src="js/slideshow_gallery.js"></script> <!-- Run slideshow gallery in java -->
        <!--<script src="js/geolocation.js"></script> <!-- Get the user location -->
    </body>
</html>
EOT;
}
?>