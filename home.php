<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4'); //select 4 latest products
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>
<!-- Slideshow Gallery -->
<div class="featured">
    <!-- Container for the image gallery -->
	<div class="container">
	
	  <!-- Full-width images with number text -->
	  <div class="mySlides">
	    <div class="numbertext">1 / 6</div>
	      <img src="product_items/banner_imgs/banner_1.jpg" style="width:70%" class="center">
	  </div>
	
	  <div class="mySlides">
	    <div class="numbertext">2 / 6</div>
	      <img src="product_items/banner_imgs/banner_2.jpg" style="width:70%" class="center">
	  </div>
	
	  <div class="mySlides">
	    <div class="numbertext">3 / 6</div>
	      <img src="product_items/banner_imgs/banner_3.jpg" style="width:70%" class="center">
	  </div>
	
	  <div class="mySlides">
	    <div class="numbertext">4 / 6</div>
	      <img src="product_items/banner_imgs/banner_4.jpg" style="width:70%" class="center">
	  </div>
	
	  <div class="mySlides">
	    <div class="numbertext">5 / 6</div>
	      <img src="product_items/banner_imgs/banner_5.jpg" style="width:70%" class="center">
	  </div>
	
	  <div class="mySlides">
	    <div class="numbertext">6 / 6</div>
	      <img src="product_items/banner_imgs/banner_6.jpg" style="width:70%;" class="center">
	  </div>
	
	  <!-- Next and previous buttons -->
	  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	  <a class="next" onclick="plusSlides(1)">&#10095;</a>
	
	  <!-- Image text -->
	  <div class="caption-container">
	    <p id="caption"></p>
	  </div>
	
	  <!-- Thumbnail images -->
	  <div class="row">
	    <div class="column">
	      <img class="demo cursor" src="product_items/banner_imgs/banner_1.jpg" style="width:100%" onclick="currentSlide(1)">
	    </div>
	    <div class="column">
	      <img class="demo cursor" src="product_items/banner_imgs/banner_2.jpg" style="width:100%" onclick="currentSlide(2)">
	    </div>
	    <div class="column">
	      <img class="demo cursor" src="product_items/banner_imgs/banner_3.jpg" style="width:100%" onclick="currentSlide(3)">
	    </div>
	    <div class="column">
	      <img class="demo cursor" src="product_items/banner_imgs/banner_4.jpg" style="width:100%" onclick="currentSlide(4)">
	    </div>
	    <div class="column">
	      <img class="demo cursor" src="product_items/banner_imgs/banner_5.jpg" style="width:100%" onclick="currentSlide(5)">
	    </div>
	    <div class="column">
	      <img class="demo cursor" src="product_items/banner_imgs/banner_6.jpg" style="width:100%" onclick="currentSlide(6)">
	    </div>
	  </div>
	</div>
</div>
<!-- content -->
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
		<!-- show the four latest products -->
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8')?>" class="product">
            <img src=<?=htmlspecialchars($product['img'], ENT_QUOTES, 'UTF-8')?> width="200" height="200" alt="<?=htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8')?>">
            <span class="name"><?=htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8')?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?=htmlspecialchars($product['rrp'], ENT_QUOTES, 'UTF-8')?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>