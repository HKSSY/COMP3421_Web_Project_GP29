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
//Connect to database
include('php/database_connect.php');
$result = mysqli_query($con,"SELECT * FROM products");  
?>

<?=template_header('Profile')?>
<div class="content_list">
    <h2>Products list</h2>
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
            if ($result->num_rows > 0) { //If we can find product on the database
                $button_build_1 = '<input type="submit" value="View" onclick="window.location.href=';
                $button_build_2 = ';">';
                echo "<table><tr><th>Product id</th><th>Name</th><th>Description</th><th>Price</th><th>RRP</th><th>Quantity</th><th>Image</th><th>Date added</th><th>Data update</th></tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>".htmlspecialchars($row[0])."</td>";
                    echo "<td>".htmlspecialchars($row[1])."</td>";
                    echo "<td>".htmlspecialchars($row[2])."</td>";
                    echo "<td>".htmlspecialchars($row[3])."</td>";
                    echo "<td>".htmlspecialchars($row[4])."</td>";
                    echo "<td>".htmlspecialchars($row[5])."</td>";
                    if ($row[6] != ""){
                        echo "<td><img src='".$row[6]."'width=auto height='50'></td>";
                    }
                    echo "<td>".$row[7]."</td>";
                    echo "<td>".$button_build_1."'update_product.php?id=".$row[0]."'".$button_build_2."</td></tr>";
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