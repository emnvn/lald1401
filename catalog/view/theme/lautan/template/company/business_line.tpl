<?php echo $header; ?><?php echo $column_right; ?>
<div id="body">
<?php echo $column_left; ?>
<div id="content"><?php echo $content_top; ?>
<div class="welcome">
<?php echo $parent_category_name; ?>
 </div>

<ul class="business_line">
<?php foreach($menu_items as $item ){?>
	<li><a href="<?php echo $item["link"]?>"><?php echo $item["text"] ?></a></li>
<?php }?>
</ul>
  <?php echo $content_bottom; ?></div>


</div>

<?php echo $footer; ?>
