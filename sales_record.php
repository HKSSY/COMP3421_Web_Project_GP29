<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include('functions.php');
//Connect to database
include('php/database_connect.php');
// Check user permission
$stmt = $con->prepare('SELECT permission FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($permission);
$stmt->fetch();
$stmt->close();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
} elseif ($permission != 1){
    header('Location: index.php');
	exit;
}  
$stmt = $con->prepare("SELECT * FROM sales_record");
$stmt->execute();
$result = $stmt->get_result();
?>

<?=template_header('Sales record list')?>
<div class="content_list">
    <h2>Sales record list</h2>
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
        <?php
            if ($result->num_rows > 0) { //If we can find users on the database
                $button_build_1 = '<input type="submit" value="View" onclick="window.location.href=';
                $button_build_2 = ';">';
                echo "<table><tr><th>Sales ID</th><th>Product ID</th><th>Product name</th><th>Product price</th><th>User ID</th><th>Date added</th></tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>".htmlspecialchars($row[0])."</td>";
                    echo "<td>".htmlspecialchars($row[1])."</td>";
                    echo "<td>".htmlspecialchars($row[2])."</td>";
                    echo "<td>".htmlspecialchars($row[3])."</td>";
                    echo "<td>".htmlspecialchars($row[4])."</td>";
                    echo "<td>".htmlspecialchars($row[5])."</td>";
                }
                echo "</table>";
            } else {
                echo "<p>No product found</p>";
            }
        ?>
    </div>
</div>
<?php
    unset($_SESSION["error"]);
    unset($_SESSION["successful"]);
?>
<?=template_footer()?>