<?php echo $header; ?><?php echo $column_right; ?>
<div id="sixteen columns">

<?php echo $column_left; ?>
<div id="content"><?php echo $content_top; ?>

<div class="welcome">
<?php echo $parent_category_name; ?>
 </div>
 <?php foreach($categories as $category) {?>
 
 <div style="clear:left">
  <?php echo $category["description"]?>
  </div>
  <br/>
  <?php foreach($category["products"] as $product){?>
  <div class="image" ><a
		href="index.php?route=company/product&product_id=<?php echo $product['product_id']?>">
	<img title="<?php echo $product["name"]?>"
		alt="<?php echo $product["name"]?>"
		src="<?php echo $product['image']?>"> </a><br/>
		<?php echo $product["name"]?>
	
	</div>
  <?php }?>
 
 <?php }?>

  <?php echo $content_bottom; ?></div>
</div>

<?php echo $footer; ?>
