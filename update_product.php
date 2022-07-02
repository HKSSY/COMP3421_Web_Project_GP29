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
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM products WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();
$stmt->store_result();
?>

<?=template_header('Editing product information')?>

<div class="content">
	<h2>Editing product information</h2>
	<div>
		<?php
			if ($stmt->num_rows < 1) {
				echo"<p>Product not found</p></div></div></body></html>";
				template_footer();
				exit;
			} else {
				$stmt->bind_result($id, $name, $description, $price, $rrp, $quantity, $img, $date_added);
				$stmt->fetch();
				$stmt->close();
			}
		?>
		<p>Product details are below:</p>
		<table>
		<tr>
			<td>Product image:</td>
				<td><img src="<?=htmlspecialchars($img, ENT_QUOTES, 'UTF-8')?>" width=auto height="200"></td>
			</tr>
			<tr>
			<td>ID:</td>
				<td><?=htmlspecialchars($id, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Name:</td>
				<td><?=htmlspecialchars($name, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><?=htmlspecialchars($description, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Price:</td>
				<td><?=htmlspecialchars($price, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>RRP:</td>
				<td><?=htmlspecialchars($rrp, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Quantity:</td>
				<td><?=htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
			<tr>
				<td>Date added:</td>
				<td><?=htmlspecialchars($date_added, ENT_QUOTES, 'UTF-8')?></td>
			</tr>
		</table>
	</div>
	<div>
		<form action="php/update_product_checker.php?id=<?=htmlspecialchars($id, ENT_QUOTES, 'UTF-8')?>" method="post" enctype="multipart/form-data">
			<label for="product_name">Product Name</label><br/>
			<input type="text" name="product_name" id="product_name" placeholder="Name"><br/>
			<label for="description">Description</label><br/>
			<input type="text" name="product_description" id="product_description" placeholder="Description"><br/>
			<label for="product_price">Price</label><br/>
			<input type="number" step="0.01" name="product_price" id="product_price" placeholder="Price"></input><br/>
			<label for="rrp">Recommended retail price</label><br/>
			<input type="number" step="0.01" name="product_rrp" id="product_rrp" placeholder="RRP"></input><br/>
			<label for="quantity">Quantity</label><br/>
			<input type="number" name="product_quantity" id="product_quantity" placeholder="Quantity"></input><br/>
			<label for="image">Choose Image</label><br/>
			<input type="file" name="product_image" accept="image/*" id="product_image"><br/>
			<input type="submit" value="Update" name="submit"><br/>
		</form>
		<input type="button" id="tips" value="Remove"><br/>
	</div>
</div>
<div class="popup">
	<button id="close">&times;</button>
	<h2>Confirm?</h2>
	<p>
		Are you sure you want to delete this product?
	</p>
	<a href="php/remove_product.php?id=<?=htmlspecialchars($id, ENT_QUOTES, 'UTF-8')?>">Delete</a>
</div>
<script src="js/pop_up_window.js"></script>

<?=template_footer()?>