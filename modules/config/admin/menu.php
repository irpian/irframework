<?php
//$query_parent 
//set in detail-menu

if($query_parent==""){
	$query_parent = " AND $child_parent='0' ";
}

if($_GET['select']=="admin"){
	sorting($table, "WHERE $field_group='1' $query_parent", $field_orderby, $primary);
	$list = getList($module, $table, $primary, $select, "WHERE $field_group='1' $query_parent", $orderby, $limit, $page);
	$filter_admin = "active";
	$filter_url = "-admin";
	$atribute_page = " Admin";
} else {
	sorting($table, "WHERE $field_group='0' $query_parent", $field_orderby, $primary);
	$list = getList($module, $table, $primary, $select, "WHERE $field_group='0' $query_parent", $orderby, $limit, $page);
	$filter_public = "active";
	$filter_url = "";
	$atribute_page = "";
}
?>

<?php if($switch!="detail-menu") { ?>
	<h2 class="content-row-title"><?php echo $title_list." ".$_GET['select']; ?></h2>
<?php } ?>

<div class="row">
<div class="col-md-12">
	<div class="panel">
	<?php if($switch=="detail-menu"){ }else{ ?>
	<ul id="myTab" class="nav nav-tabs nav-justified">
		<li class="<?php echo $filter_public; ?>"><a href="<?php echo base_admin."/config/menu/select/"; ?>public">Public</a></li>
		<li class="<?php echo $filter_admin; ?>"><a href="<?php echo base_admin."/config/menu/select/"; ?>admin">Admin</a></li>
	</ul>
	<?php } ?>
	<div id="myTabContent" class="tab-content">
		<?php if($switch=="detail-menu"){ }else{ ?>
		<div class="pull-left"> 
		<a href="<?php echo base_admin."/".$module."/add-menu".$filter_url; ?>" class="btn btn-primary btn-block pull-right">Add Menu<?php echo $atribute_page; ?></a> 
		</div>
		<?php } ?>
		<div class="clear"></div>
		
		<div class="tab-pane active">
		<form action="" method="post" name="form_list_sort">
		<table class="table">
			<thead>
			<tr>
				<th>Name Menu</th>
				<th>SubMenu</th>
				<th>Sort</th>
				<th><span class="action">Action</span></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($list['data'] as $key=>$data){ ?>
			<tr>
				<td><?php echo $data['name']; ?></td>
				<td>
				<?php 
				$array_action = array(
				$module."/".$switch_edit.$filter_url,
				$module."/".$switch_delete,
				$module."/".$switch_status.$filter_url
				);
				listSubPanel($module, "Menu", $table, "parent", $data['id'], $primary, "name", "status", $field_orderby, $array_action, $page); ?>
				</td>
				<td width="200">
				<?php 
				if($_GET['select']=="admin"){
					sortingSet($select, $table, "WHERE $field_group='1' $query_parent ORDER BY $field_orderby ASC", "name", $data['id'], $primary, $field_orderby, $key); 
				} else {
					sortingSet($select, $table, "WHERE $field_group='0' $query_parent ORDER BY $field_orderby ASC", "name", $data['id'], $primary, $field_orderby, $key); 
				}
				if($data[$field_orderby]==0){
					echo "<meta http-equiv='refresh' content='0; url='>";
				}
				?>
				</td>
				<td>
				<span class="group-action btn-group pull-right">
				<?php 
					action("status", $module."/".$switch_status.$filter_url, $data['id'], $page, $data['status']); 
					action("edit", $module."/".$switch_edit.$filter_url, $data['id'], $page, "");
					if(!$_GET['detail']){ 
						action("detail", $module."/".$switch_detail, $data['id'], $page, ""); 
					} 
					action("delete", $module."/".$switch_delete, $data['id'], $page, "");
				?>
				</span>
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
		
		</form>
		</div>
	</div>
	</div>
</div>
</div>
<?php pagination(urlPagingAdmin($module), $paging['page'], $paging['totalpage']); ?>
