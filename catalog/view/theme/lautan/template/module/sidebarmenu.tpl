<link rel="stylesheet" media="all" type="text/css" href="catalog/view/theme/lautan/stylesheet/sidebarmenu.css" />
<div class="ver-menu">
<?php foreach($menu_items as $item ){?>
	<div <?php if($item["active"]==true||$item["last"]==true) {echo "class='";if($item["active"]==true)echo "active ";if($item["last"]==true)echo "last"; echo "'";}?>><a href="<?php echo $item["link"]?>"><?php echo $item["text"] ?></a></div>
<?php }?>
</div>

<div class="box1" style="display:none">
  <div class="top"><img src="catalog/view/theme/default/image/menuicon.png" alt="" /><?php echo $heading_title; ?></div>
  <div id="category" class="middle">
	<div style="border-left:1px solid transparent;border-right:1px solid transparent;"></div>
  <?php echo $category; ?></div>	
  <div class="bottom">&nbsp;</div>
</div>
