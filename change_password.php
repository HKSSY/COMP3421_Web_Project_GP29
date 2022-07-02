<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include('functions.php');
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
//Connect to database
include('php/database_connect.php');
?>

<?=template_header('Profile')?>
<div class="content">
    <h2>Change password</h2>
        <div>
            <p>Please fill in all fields:</p>
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
            <form action="php/change_password.php" method="post" autocomplete="off">
                <input type="password" name="current_password" placeholder="Current password" id="current_password" required>
                <input type="password" name="new_Password" placeholder="New password" id="new_Password" required>
                <input type="password" name="confirm_Password" placeholder="Confirm Password" id="confirm_Password" required>
                <input type="submit" value="Confirm">
            </form>
        </div>
</div>
<?php
    unset($_SESSION["error"]);
    unset($_SESSION["successful"]);
?>
<?=template_footer()?>