<div id="tabs" class="htabs">
<?php foreach($pages as $page){?>
<a href="#tab-TabContent-<?php echo $page["information_id"]?>" <?php if(isset($active_id) && $page["information_id"]== $active_id) echo "class='selected'" ?>><span><b><?php echo $page["title"];?></b></span></a>
<?php }?>
</div>
<span style="clear:both"></span>
<div>
<?php foreach($pages as $page){?>
<div id="tab-TabContent-<?php echo $page["information_id"]?>" class="tab-content-information"><?php echo $page["description"];?></div>
<?php }?>
</div>

<script type="text/javascript"><!--
$('#tabs a').tabs();
var ele = $("#tabs a").first();
<?php for($i = 1 ; $i < $active_index ; $i++) {?>
ele = ele.next();
<?php } ?>
ele.click();
//var active = $( "#tabs a" ).tabs( "option", "active",1 );
//alert(active);
//--></script>