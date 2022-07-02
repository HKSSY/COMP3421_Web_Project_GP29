<?php
session_start();
include('functions.php');
//Connect to database
include('php/database_connect.php');
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT permission FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
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
//$pdo = pdo_connect_mysql();
//$msg = '';

// Check if POST data is not empty
if (!isset($_POST)) {
    // Check if POST variable "title" exists,
    $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $product_price = isset($_POST['product_price']) ? $_POST['product_price'] : '';
    // The folder where the images will be stored
	$target_dir = 'product_items/';
	// The path of the new uploaded image
	$image_path = $target_dir . basename($_FILES['image']['name']);
    // Insert new record into the "products" table
    $stmt = $pdo->prepare('INSERT INTO products (name, desc, price, img) VALUES (?, ?, ?, ?)');
    $stmt->execute([ $product_name, $description, $product_price, $image_path]);
    echo"done";
}
?>

<?=template_header('Create product')?>
<div class="content">
	<h2>Create product</h2>
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
            <form action="php/upload_product.php" method="post" enctype="multipart/form-data">
                <label for="product_name">Product Name</label><br/>
                <input type="text" name="product_name" id="product_name" placeholder="Name" required><br/>
                <label for="description">Description</label><br/>
                <input type="text" name="product_description" id="product_description" placeholder="Description"><br/>
                <label for="product_price">Price</label><br/>
                <input type="number" step="0.01" name="product_price" id="product_price" placeholder="Price" required></input><br/>
                <label for="rrp">Recommended retail price</label><br/>
                <input type="number" step="0.01" name="product_rrp" id="product_rrp" placeholder="RRP" required></input><br/>
                <label for="quantity">Quantity</label><br/>
                <input type="number" name="product_quantity" id="product_quantity" placeholder="Quantity" required></input><br/>
                <label for="image">Choose Image</label><br/>
                <input type="file" name="product_image" accept="image/*" id="product_image"><br/>
                <input type="submit" value="Create" name="submit"><br/>
            </form>
        </div>
</div>
<?php
    unset($_SESSION["error"]);
    unset($_SESSION["successful"]);
?>
<?=template_footer()?>