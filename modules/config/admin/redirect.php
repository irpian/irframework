<?php 
include "include/action.php";

if($_GET['search']){
	$where .= " AND url_from LIKE '%".$_GET['search']."%' OR url_to LIKE '%".$_GET['search']."%'";
}

$list = getList($module, $table, $primary, $select, $where, $orderby, $limit, $page);
$paging = $list['paging'];
?>

<h2 class="content-row-title">
	<?php echo $title_list; ?>
</h2>
<?php addDataButton($module, $switch_add, $title_add); ?>

<div class="row">
	<div class="col-md-12">
		  <table class="table">
			<thead>
			  <tr>
				<th width="40%">From </th>
				<th width="40%">To</th>
				<th><span class="action">Action</span></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach($list['data'] as $key=>$data){ ?>
			<tr>
				<td><?php echo $data['url_from']; ?></td>
				<td><?php echo $data['url_to']; ?></td>
				<td>
					<div class="group-action btn-group pull-right">
					  <?php action("status", $module."/".$switch_status, $data['id'], $page, $data['status']); ?>
					  <?php action("edit", $module."/".$switch_edit, $data['id'], $page,""); ?>
					  <?php action("delete", $module."/".$switch_delete, $data['id'], $page,""); ?>
					</div>
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php pagination(urlPagingAdmin($module), $paging['page'], $paging['totalpage']); ?>