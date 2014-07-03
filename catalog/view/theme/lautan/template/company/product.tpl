<?php echo $header; ?><?php echo $column_right; ?>
<div id="sixteen columns">

<?php echo $column_left; ?>
<div id="content"><?php echo $content_top; ?>

<h1><?php echo $heading_title; ?></h1>
<div class="product-detail-info"><?php if ($thumb || $images) { ?>
<div class="left"><?php if ($thumb) { ?>
<div class="image a_bossthemes"><a href="<?php echo $popup; ?>"
	title="<?php echo $heading_title; ?>" class="colorbox" rel="colorbox"><img
	src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>"
	alt="<?php echo $heading_title; ?>" id="image" /></a></div>
<?php } ?> <?php if ($images) { ?>
<div class="image-additional a_bossthemes">
<div class="es-carousel">
<center>
<ul class="skin-opencart">
<?php foreach ($images as $image) { ?>
	<li>
	<div class="boss-image-add"><a href="<?php echo $image['popup']; ?>"
		title="<?php echo $heading_title; ?>" class="colorbox" rel="colorbox"><img
		src="<?php echo $image['thumb']; ?>"
		title="<?php echo $heading_title; ?>"
		alt="<?php echo $heading_title; ?>" /></a></div>
	</li>
	<?php } ?>
</ul>
</center>
</div>

</div>
	<?php } ?></div>
	<?php } ?>
<div class="right" >
<div class="description"> <span><?php echo $text_model; ?></span> <?php echo $model; ?><br />
<?php echo $description?>
	</div>

</div>
</div>
<?php echo $content_bottom; ?></div>
</div>
<link
	rel="stylesheet" type="text/css"
	href="catalog/view/theme/modern/stylesheet/boss_carousel_product.css" />
<script>
  <!--
  $(document).ready(function() {
  product_resize();
  });
  $(window).resize(function() {
  product_resize();
  });
  function disableLink(e) {
  e.preventDefault();
  return false;
  }
  function product_resize() {
  if(getWidthBrowser() < 767){
  $('div.a_bossthemes a').bind('click', disableLink);
  $('#tabs').hide();
  $('h2.ta-header').show();
  } else {
  $('div.a_bossthemes a').unbind('click', disableLink);
  $('h2.ta-header').hide();
  $('#tabs').show();
  if(getWidthBrowser() < 959){
  $('#tab-related').elastislide({
  imageW : 145,
  border : 0,
  current : 0,
  margin : 0,
  onClick : true,
  minItems : 3,
  disable_touch : false
  });
  }else{
  $('#tab-related').elastislide({
  imageW : 162,
  border : 0,
  current : 0,
  margin : 0,
  onClick : true,
  minItems : 3,
  disable_touch : true
  });
  }
  $('.image-additional').elastislide({
  imageW : 98,
  border : 0,
  current : 0,
  margin : 5,
  onClick : true,
  minItems : 3,
  disable_touch : true
  });
  }
  }
  //--> 
  </script>
<script type="text/javascript"><!--
$('.colorbox').colorbox({
	overlayClose: true,
	opacity: 0.5
});
//--></script>

<?php echo $footer; ?>