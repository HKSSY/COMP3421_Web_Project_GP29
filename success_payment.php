<?=template_header('Place Order')?>
<?php
if (!isset($_SESSION["payment_done"])){
	header('Location: index.php');
	exit;
	}
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT id, quantity FROM `products`;'); //Select product items quantity
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are no products in the cart
if ($products_in_cart) {
	//echo $_SESSION['cart'][$product_id];
	$array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}else{
	header('Location: index.php?page=cart');
    exit;
}

foreach ($products as $product){
	//Update stock
	$new_quantity = $product['quantity'] - 1;
	$stmt = $pdo->prepare('UPDATE products SET quantity = ? WHERE id = ?');
	$stmt->bindParam(1, $new_quantity, PDO::PARAM_INT);
	$stmt->bindParam(2, $product['id'], PDO::PARAM_INT);
	$stmt->execute();
	
	// Save products records
	$stmt = $pdo->prepare('INSERT INTO sales_record (product_name, product_id, product_price, user_id) VALUES (?, ?, ?, ?)');
	$stmt->bindParam(1, $product['name'], PDO::PARAM_STR);
	$stmt->bindParam(2, $product['id'], PDO::PARAM_INT);
	$stmt->bindParam(3, $product['price'], PDO::PARAM_STR);
	$stmt->bindParam(4, $_SESSION['id'], PDO::PARAM_INT);
	$stmt->execute();
}
?>
<link rel="stylesheet" href="./css/count_down.css">
<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
    <h1>It will redirect to home page in 4 seconds...</h1>
    <?php
    	unset($_SESSION['payment_done']);	// Delete the payment session
	    unset($_SESSION['cart']);	// Delete the shopping cart items
	    header( "refresh:4;url=index.php" );	// Redirect to index page in 4 sec
    ?>
</div>
<div id="app"></div>
<script src="js/count_down.js" charset="utf-8"></script>
<?=template_footer()?>