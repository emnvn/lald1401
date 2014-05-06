
<div id="tabs" class="htabs">
<?php foreach($pages as $page){?>
<a href="#tab-TabContent-<?php echo $page["information_id"]?>"><span><b><?php echo $page["title"];?></b></span></a>
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
//--></script>