<?php echo $header; ?><?php echo $column_right; ?>
<div id="body">
<table border=0 height="100%"> 
<tr>
<td width="28%" valign="top" class="column-left"><?php echo $column_left; ?></td>
<td valign="top"><div id="content"><?php echo $content_top; ?>

<div >
<b><?php echo $parent_category_name; ?></b>
 </div>
 <?php foreach($categories as $category) {?>
 
 <div>
  <?php echo $category["description"]?>
  </div>
  <br/>
  <?php foreach($category["products"] as $product){?>
  <span class="image" ><a
		href="index.php?route=product/product&product_id=<?php echo $product['product_id']?>">
	<img title="<?php echo $product["name"]?>"
		alt="<?php echo $product["name"]?>"
		src="<?php echo $product['image']?>"> </a>
	
	</span>
  <?php }?>
 
 <?php }?>

  <?php echo $content_bottom; ?></div></td>
</tr>
</table>


</div>

<?php echo $footer; ?>
