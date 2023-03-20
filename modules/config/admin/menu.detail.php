<h2 class="content-row-title"><?php echo $title_detail; ?></h2>

<?php 
$get_parent = $db->value($select, $table, "WHERE $primary='".$_GET['id']."'");
$parent_menu = " - ".$get_parent['name'];
if($get_parent['position']==1){
	$_GET['select']="admin";
	$switch = "add-menu-admin";
} else {
	$_GET['select']="puclic";
	$switch = "add-menu";
}

$id = $_GET['id'];
$query_parent = " AND $child_parent='".$_GET['id']."'";
?>
<a href="#add-menu" class="btn btn-primary pull-left" data-toggle="collapse">Add Sub Menu</a>
<div class="clear"></div>
<div class="collapse" id="add-menu">
	<div class="pd-tb24">
		<?php include "menu.action.php"; ?> 
	</div>
</div>
<?php 
	$module="config"; 
	$switch="detail-menu"; 
?>
<script>
	$(".input-menu-parent").val("<?php echo $_GET['id']; ?>");
	$(".input-menu-icon").remove();
</script>