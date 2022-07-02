<?php
session_start();
//Connect to database
include('database_connect.php');
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['product_name'], $_POST['product_description'], $_POST['product_price'], $_POST['product_rrp'], $_POST['product_quantity'])) {
	// Could not get the data that should have been sent.
	$error = "Please fill in at least one field.";
	$_SESSION["error"] = $error;
	header("location: ../products_list.php");
	exit;
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['product_name']) and empty($_POST['product_description']) and empty($_POST['product_price']) and empty($_POST['product_rrp']) and empty($_POST['product_quantity']) and empty($_FILES['product_image'])) {
	// One or more values are empty.
	$error = "Please fill in at least one field.";
	$_SESSION["error"] = $error;
	header("location: ../products_list.php"); 
	exit;
}

// We need to check if the product with that name exists.
if ($stmt = $con->prepare('SELECT id FROM products WHERE id = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the product name is a string so we use "s"
	$stmt->bind_param('s', $_GET['id']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	$stmt->bind_result($id);
	$stmt->fetch();
	if ($stmt->num_rows > 0) {
		$stmt = $con->prepare('SELECT * FROM products WHERE id = ?');
		// In this case we can use the account ID to get the account info.
		$stmt->bind_param('i', $_GET['id']);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name, $description, $price, $rrp, $quantity, $img, $date_added);
		$stmt->fetch();
		$stmt->close();
		if ($_POST['product_name'] == "" ){
			$_POST['product_name'] = $name;
		}
		if ($_POST['product_description'] == ""){
			$_POST['product_description'] = $product_description;
		}
		if ($_POST['product_price'] == ""){
			$_POST['product_price'] = $price;
		}
		if ($_POST['product_rrp'] == ""){
			$_POST['product_rrp'] = $rrp;
		}
		if ($_POST['product_quantity'] == ""){
			$_POST['product_quantity'] = $quantity;
		}
		if ($_FILES['product_image']['name'] == ""){
			$stmt = $con->prepare('UPDATE products SET name = ?, description = ?, price = ?, rrp = ?, quantity = ? WHERE id = ?');
			$stmt->bind_param('ssssii', $_POST['product_name'], $_POST['product_description'], $_POST['product_price'], $_POST['product_rrp'], $_POST['product_quantity'], $id);
			$stmt->execute();
			$successful = "Product information was updated successfully.";
			$_SESSION["successful"] = $successful;
			header("location: ../products_list.php"); 
		} else {
			unlink("../".$img);
			$target_dir = '../product_items/';
			// The path of the new uploaded image
			$rename_image_name = round(microtime(true));
			$image_path = $target_dir . $rename_image_name . basename($_FILES['product_image']['name']);
				// Check to make sure the image is valid
				if (!empty($_FILES['product_image']['tmp_name']) && getimagesize($_FILES['product_image']['tmp_name'])) {
					if (file_exists($image_path)) {
						$error = "Image already exists, please choose another or rename that image.";
						$_SESSION["error"] = $error;
						header("location: ../products_list.php"); 
						exit;
				} else if ($_FILES['product_image']['size'] > 2000000) {
					$error = "Image file size too large, please choose an image less than 2000kb.";
					$_SESSION["error"] = $error;
					header("location: ../products_list.php"); 
					exit;
				} else {
					// Everything checks out now we can move the uploaded image
					move_uploaded_file($_FILES['product_image']['tmp_name'], $image_path);
					//Insert image info into the database (title, description, image path, and date added)
					$target_dir = 'product_items/';
					// The path of the new uploaded image
					$image_path = $target_dir . $rename_image_name . basename($_FILES['product_image']['name']);
					$stmt = $con->prepare('UPDATE products SET name = ?, description = ?, price = ?, rrp = ?, quantity = ?, img = ? WHERE id = ?');
					$stmt->bind_param('ssssisi', $_POST['product_name'], $_POST['product_description'], $_POST['product_price'], $_POST['product_rrp'], $_POST['product_quantity'], $image_path, $id);
					$stmt->execute();
					$successful = "Product information was updated successfully.";
					$_SESSION["successful"] = $successful;
					header("location: ../products_list.php"); 
				}
			}else{
				$error = "Please upload an image.";
				$_SESSION["error"] = $error;
				header("location: ../products_list.php");
				exit;
			}
		}
	}
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all fields.
	$error = "Temporarily cannot create product, please try again later.";
	$_SESSION["error"] = $error;
	header("location: ../sign_up.php");
	exit;
}
$con->close();
?>