<?php ?>
<?php //echo $categories_tree;?>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/tree_category/dtree.css" media="all" />
<script src="catalog/view/javascript/tree_category/dtree.js"></script>
<div class="box">

  <div class="box-heading"><?php echo $heading_title; ?></div>
        <div class="box-nav2">
            <script type="text/javascript">
                <!--
                d = new dTree('d');
                d.add(0,-1,'');
                d.add(70,72,"node 1","#");
                d.add(71,72,"node 2","#");
                <?php //print $categories_tree;?>
                document.write(d);
                alert(d);
                //-->
            </script>
        </div>
        
        </div>
