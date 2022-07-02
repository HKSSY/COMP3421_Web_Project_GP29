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

<?=template_header('Change profile image')?>
<div class="content">
    <h2>Change profile image</h2>
    <div>
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
        <form action="php/upload_profile_image_checker.php" method="post" enctype="multipart/form-data">
            <label for="image">Choose Image</label>
            <input type="file" name="image" accept="image/*" id="image">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" maxlength="30">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" maxlength="40">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
</div>

<?php
    unset($_SESSION["error"]);
    unset($_SESSION["successful"]);
?>
<?=template_footer()?>