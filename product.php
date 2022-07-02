<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>

<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src=<?=htmlspecialchars($product['img'], ENT_QUOTES, 'UTF-8')?> width="500" height="500" alt="<?=htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8')?>">
    <div>
        <h1 class="name"><?=htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8')?></h1>
        <span class="price">
            &dollar;<?=htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8')?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=htmlspecialchars($product['rrp'], ENT_QUOTES, 'UTF-8')?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=cart" onsubmit="getLocation()" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=htmlspecialchars($product['quantity'], ENT_QUOTES, 'UTF-8')?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8')?>">
            <?php if ($product['quantity'] <= 0): ?>
                <input disabled type="submit" value="Sold Out">
            <?php else: ?>
                <input type="submit" value="Add To Cart">
            <?php endif; ?>
            <p id="demo"></p>
        </form>
        <div class="description">
            <?=htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8')?>
        </div>
    </div>
</div>
<script src="js/geolocation.js"></script> <!-- Get the user location -->
<?=template_footer()?>