<?php
session_start();
//Connect to database
include('database_connect.php');

// We need to check if the product with that name exists.
if ($stmt = $con->prepare('SELECT id, img FROM products WHERE id = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the product name is a string so we use "s"
	$stmt->bind_param('i', $_GET['id']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	$stmt->bind_result($id, $img);
	$stmt->fetch();
	if ($stmt->num_rows > 0) {
		// Product exists
		unlink("../".$img);
		$stmt = $con->prepare('DELETE FROM products WHERE id = ?');
		$stmt->bind_param('i', $_GET['id']);
		$stmt->execute();
		$successful = "Product deleted successfully.";
		$_SESSION["successful"] = $successful;
		header("location: ../products_list.php"); 
		} else {
			// Product not found
			$error = "This product does not exists.";
			$_SESSION["error"] = $error;
			header("location: ../products_list.php"); 
		}
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all fields.
	$error = "Temporarily cannot delete product, please try again later.";
	$_SESSION["error"] = $error;
	header("location: ../update_product.php"); 
}
$con->close();
?>