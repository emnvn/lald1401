<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Strict//EN">
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<!-- 
<base href="<?php echo $base; ?>" />
-->
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/color_default.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/boss_add_cart.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/boss_megamenu.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/boss_slideshow.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/boss_carousel.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/boss_homecategory.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/boss_featured.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/skeleton.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/responsive.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/news.css" />

<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>

<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script>

	function redraw_screen(){
		//return;
		var le = $( "#column-left" );
		var ce = $( "#content" );
		var sh = $( window ).height();
		var fe = $( "#footer" );
		var fy = fe.offset().top;
		// var fx = fe.offset().left;
		var fh = fe.height();
		var otherHeight = 11;
		var verMenu = $( ".ver-menu" );
		
		//var ly = le.offset().top;
		//$("#notification").html("LEFT TOP: "+le.offset().top+" Content top: "+ce.offset().top);
		//Broswer binh thuong
		if(le.offset().top==ce.offset().top){
			
		var maxContentHeight = Math.max(verMenu.height(), ce.height());
		var debug = "";
		if(sh > fy + fh){
				 debug = "D1 ";
				 //$("#notification").html("TH1 sh: "+sh+" fy: "+fy+" fh: "+fh+" le top: "+le.offset().top+" le height: "+le.height()+" ver-length: "+verMenu.offset().top+" ver-height: "+verMenu.height());	
				 le.height(sh-le.offset().top-fh-otherHeight);
		}
		else if(sh < fy+fh){
				 //$("#notification").html("TH2 sh: "+sh+" fy: "+fy+" fh: "+fh+" le top: "+le.offset().top+" le height: "+le.height()+" ver-length: "+verMenu.offset().top+" ver-height: "+verMenu.height());
				 le.height( fy-le.offset().top-otherHeight);
				 debug += "D2 ";
				 if(sh > maxContentHeight){
					// $("#notification").html("TH3 sh: "+sh+" fy: "+fy+" fh: "+fh+" le top: "+le.offset().top+" le height: "+le.height()+" ver-length: "+verMenu.offset().top+" ver-height: "+verMenu.height());
					 debug += "D3 ";
					 le.height(sh-le.offset().top-fh-otherHeight);
				 }
			 }
			 if(le.height()<ce.height()) 
			 {
				// $("#notification").html("TH4 sh: "+sh+" fy: "+fy+" fh: "+fh+" le top: "+le.offset().top+" le height: "+le.height()+" ver-length: "+verMenu.offset().top+" ver-height: "+verMenu.height());
				 le.height(ce.height());
				 debug += "D4";
			 }
		 }
		 else {
				//responsive browser
				otherHeight = 50;
				// $("#notification").html("Phone TH0: "+le.offset().top+" Content top: "+ce.offset().top+" sh:"+ sh+" fy:"+fy+" fh: "+fh);
			 	if(sh > fy + fh){
					ce.height(sh-ce.offset().top-fh-otherHeight);
					//fe.height(ce.offset().top+ce.height());
					//$("#notification").html("Phone TH1: Content top: "+ce.offset().top+" ce height:"+ ce.height());
					fe.offset({ top: ce.offset().top+ce.height()});
					//fe.offset({top:2000});
				 }
		}
	  }
	  
	  $(document).ready(function() {
	 		redraw_screen();
			$( window ).resize(function() {
			 	redraw_screen();
			});
		
		});
		
	</script>
	
	<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/lautan/stylesheet/ie8.css" />
	<![endif]-->
	<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
	<![endif]-->
	<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
	<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">
	DD_belatedPNG.fix('#logo img');
	</script>
	<![endif]-->
<?php echo $google_analytics; ?>

</head>
<body class="<?php echo $page_type?>"  data-twttr-rendered="true">

<div class="viewport">
<div id="container" class="container">
<div id="header" class="sixteen columns">
	<div class="boss_header_top">
		<div id="header-top-right">
		<div id="header-links">
		
			<div class="hor-menu">
				<a href="/"><?php echo $text_home ?></a> | 
				<a href="<?php echo $link_product ?>"><?php echo $text_our_product ?></a> | 
				<a href="<?php echo $link_career ?>"><?php echo $text_career ?></a> | 
				<a href="<?php echo $link_sitemap ?>"><?php echo $text_sitemap ?></a>
			</div>
		
			<div class="select-menu">
				<select>
					<option value="/" <?php if($menu_active=="home") {echo "selected='selected'"; } ?>><?php echo $text_home; ?></option>
					<option value="<?php echo $link_product; ?>" <?php if($menu_active=="product") {echo "selected='selected'"; } ?>><?php echo $text_our_product ?></option>
					<option value="<?php echo $link_career; ?>" <?php if($menu_active=="career") {echo "selected='selected'"; } ?>><?php echo $text_career ?></option>
					<option value="<?php echo $link_sitemap; ?>" <?php if($menu_active=="sitemap") {echo "selected='selected'"; } ?>><?php echo $text_sitemap ?></option>
				</select>
			</div>
		</div>
		
  			<div class="language_currency"><?php echo $language; ?></div>
		</div>
	</div>
	<div class="boss_header_bottom">
		  <?php if ($logo) { ?>
		  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
		  <?php } ?>
		  <div id="header-top-static">
		  </div>
	
		<div id="m-welcome-link"></div>
	</div>
  
  <div style="height:15px" id="blank"></div>
</div>

<div id="notification"></div>

<script>
$(document).ready(function() {
	$(".select-menu select").change(function() { 
		window.location = $(this).find("option:selected").val();
		}
	);
	  });

</script>
