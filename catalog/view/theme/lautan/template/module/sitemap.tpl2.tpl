<link rel="stylesheet" href="catalog/view/theme/lautan/stylesheet/jquery.jOrgChart.css"/>
<link rel="stylesheet" href="catalog/view/theme/lautan/stylesheet/custom.jOrgChart.css"/>
<script src="catalog/view/javascript/jquery/jquery.jOrgChart.js"></script>
<h1><?php echo $heading_title?></h1>
<?php
function traverse_recursive($page){
	echo "<li>";
	
	if($page["link"]!=""){
    	echo "<a href='".$page["link"]."'>".$page["text"]."</a>";
    	 }
    	 else {
    	  echo $page["text"];
    	  }
    	  
    	  if(isset($page["childs"]) && is_array($page["childs"])){
    	  	echo "<ul>";
    	  	foreach($page["childs"] as $child){
    	  		traverse_recursive($child);
    	  	}
    	  	echo "</ul>";
    	  }
   echo "</li>";
} 
?>
<ul id="org" style="display:none">
    <li>
    <a href=<?php echo $page_root["link"]?>> <?php echo $page_root["text"]?></a>
    <?php if(count($pages)>0){?>
    <ul>
    	<?php foreach($pages as $page){?>
    	<?php traverse_recursive($page);?>
    	<!--
    	<li>
    	  
    	<?php if($page["link"]!=""){?>
    	<a href=<?php echo $page["link"]?>> <?php echo $page["text"]?></a>
    	<?php }
    	 else {?>
    	 <?php echo $page["text"]?>
    	 <?php }?>
    	 
    	</li>-->
    	<?php }?>
    </ul>
    <?php }?>
     </li>
   </ul>            
    
    <div id="chart" class="orgChart"></div>
     <script>
    jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : '#chart',
            dragAndDrop  : false
        });
    });
    </script>