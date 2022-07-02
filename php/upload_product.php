<?php
session_start();
//Connect to database
include('database_connect.php');
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['product_name'], $_POST['product_description'], $_POST['product_price'], $_POST['product_rrp'], $_POST['product_quantity'])) {
	// Could not get the data that should have been sent.
	$error = "Please fill in all fields.";
	$_SESSION["error"] = $error;
	header("location: ../create_product.php");
	exit;
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['product_name']) || empty($_POST['product_description']) || empty($_POST['product_price']) || empty($_POST['product_rrp']) || empty($_POST['product_quantity'])) {
	// One or more values are empty.
	$error = "Please fill in all fields.";
	$_SESSION["error"] = $error;
	header("location: ../create_product.php"); 
	exit;
}
// We need to check if the product with that name exists.
if ($stmt = $con->prepare('SELECT id FROM products WHERE name = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the product name is a string so we use "s"
	$stmt->bind_param('s', $_POST['product_name']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	$stmt->bind_result($id);
	$stmt->fetch();
	if ($stmt->num_rows > 0) {
		// Product already exists
		$error = "The product already exists. The duplicate product id is: ".$id;
		$_SESSION["error"] = $error;
		header("location: ../create_product.php"); 
		} else { 
			// Verify product image
			if (isset($_FILES['product_image'], $_POST['product_name'])) {
				// The folder where the images will be stored
				$target_dir = '../product_items/';
				// The path of the new uploaded image
				$rename_image_name = round(microtime(true));
				$image_path = $target_dir . $rename_image_name . basename($_FILES['product_image']['name']);
				// Check to make sure the image is valid
				if (!empty($_FILES['product_image']['tmp_name']) && getimagesize($_FILES['product_image']['tmp_name'])) {
					if (file_exists($image_path)) {
						$error = "Image already exists, please choose another or rename that image.";
						$_SESSION["error"] = $error;
						header("location: ../create_product.php"); 
						exit;
				} else if ($_FILES['product_image']['size'] > 2000000) {
					$error = "Image file size too large, please choose an image less than 2000kb.";
					$_SESSION["error"] = $error;
					header("location: ../create_product.php"); 
					exit;
				} else {
					// Everything checks out now we can move the uploaded image
					move_uploaded_file($_FILES['product_image']['tmp_name'], $image_path);
					//Insert image info into the database (title, description, image path, and date added)
					$target_dir = 'product_items/';
					// The path of the new uploaded image
					$image_path = $target_dir . $rename_image_name . basename($_FILES['product_image']['name']);
					$stmt = $con->prepare('INSERT INTO products (name, description, price, rrp, quantity, img, date_added) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
					$stmt->bind_param('ssssss', $_POST['product_name'], $_POST['product_description'], $_POST['product_price'], $_POST['product_rrp'], $_POST['product_quantity'], $image_path);
					$stmt->execute();
					$successful = "Product created successfully.";
					$_SESSION["successful"] = $successful;
					header("location: ../products_list.php"); 
				}
			} else {
				$error = "Please upload an image.";
				$_SESSION["error"] = $error;
				header("location: ../create_product.php");
				exit;
			}
		}
	}
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all fields.
	$error = "Temporarily cannot create product, please try again later.";
	$_SESSION["error"] = $error;
	header("location: ../sign_up.php"); 
}
$con->close();
?>