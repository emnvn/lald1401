<link rel="stylesheet" media="all" type="text/css" href="catalog/view/theme/lautan/stylesheet/sidebarmenu.css" />


<div class="ver-menu">
<?php foreach($menu_items as $item ){?>
	<div <?php if($item["active"]==true||$item["last"]==true) {echo "class='";if($item["active"]==true)echo "active ";if($item["last"]==true)echo "last"; echo "'";}?>><a href="<?php echo $item["link"]?>"><?php echo $item["text"] ?></a></div>
<?php }?>
</div>

<!-- 
<div class="ver-menu">
	<div class="active"><a href="#">overview</a></div>
	<div><a href="#">business line</a></div>
	<div><a href="#">production</a></div>
	<div><a href="#">distribution</a></div>
	<div><a href="#">factory</a></div>
	<div class="last"><a href="#">contact us</a></div>
</div>
 -->
<!-- 
<ul class="ver-menu">
	<li class="active"><a href="#">overview</a></li>
	<li><a href="#">business line</a></li>
	<li><a href="#">production</a></li>
	<li><a href="#">distribution</a></li>
	<li><a href="#">factory</a></li>
	<li class="last"><a href="#">contact us</a></li>	
</ul>
-->
<div class="box1" style="display:none">
  <div class="top"><img src="catalog/view/theme/default/image/menuicon.png" alt="" /><?php echo $heading_title; ?></div>
  <div id="category" class="middle">
	<div style="border-left:1px solid transparent;border-right:1px solid transparent;"></div>
  <?php echo $category; ?></div>	
  <div class="bottom">&nbsp;</div>
</div>
