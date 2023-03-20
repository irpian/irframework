<?php
include "include/action.php";

if($_SESSION['filter'][$module]['search']!=""){
	$search = $_SESSION['filter'][$module]['search'];
	$where .= " AND ( url LIKE '%".$_SESSION['filter'][$module]['search']."%' ) ";
}

if($_SESSION['filter'][$module]['publish']!=""){
	$publish = $_SESSION['filter'][$module]['publish'];
	if($publish=="0" || $publish=="1"){
		$where .= " AND status=".$_SESSION['filter'][$module]['publish'];
	}
} else {
	$publish = "100";
}

if(isset($_SESSION['filter'][$module]['sort'])!=""){
	$orderby = "";
	$sort = $_SESSION['filter'][$module]['sort'];
	switch($_SESSION['filter'][$module]['sort']){
		case 'asc';
			$orderby = "ORDER BY $primary DESC ";
		break;

		case 'desc';
			$orderby = "ORDER BY $primary ASC ";
		break;

		case 'az';
			$orderby = "ORDER BY url ASC ";
		break;

		case 'za';
			$orderby = "ORDER BY url DESC ";
		break;
	}
}

if(isset($_SESSION['filter'][$module]['category'])!="" && $_SESSION['filter'][$module]['category'] > 0){
	$category_filter = $_SESSION['filter'][$module]['category'];
	$where .= " AND account=".$_SESSION['filter'][$module]['category'];
}

$list = getList($module, $table, $primary, $select, $where, $orderby, $limit, $page);
$paging = $list['paging'];
?>


<h2 class="content-row-url">
	<?php echo $url_list; ?>
</h2>

<?php include "include/formSearch.php"; ?>

<div class="row">
	<div class="col-md-12">
		  <table class="table">
			<thead>
			  <tr>
				<th width="60%">Name </th>
				<th width="60%">Account </th>
				<th><span class="action">Action</span></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach($list['data'] as $key=>$data){ ?>
			<tr>
				<td><img src="<?php echo $data['url']; ?>" height="100"></td>
				<td>
					<?php
						$get_account = $db->value("name", $table2, "WHERE id='".$data['account']."' ");
						echo $get_account;
					?>
				</td>
				<td>
					<div class="group-action btn-group pull-right">
					  <?php action("status", $module, $data['id'], $page, $data['status']); ?>
					  <?php action("edit", $module, $data['id'], $page, ""); ?>
					  <?php action("delete", $module, $data['id'], $page, ""); ?>
					</div>
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php pagination(urlPagingAdmin($module), $paging['page'], $paging['totalpage']); ?>
