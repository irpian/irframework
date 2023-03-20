<?php
include "include/action.php";

$list = getList($module, $table, $primary, $select, $where, $orderby, $limit, $page);
$paging = $list['paging'];
?>

<h2 class="content-row-title">
	<?php echo $title_list; ?>
</h2>
<?php addDataButton($module, "add-account", $title_add); ?>

<div class="row">
	<div class="col-md-12">
		  <table class="table">
			<thead>
			  <tr>
				<th width="40%">Name </th>
				<th width="30%">Url</th>
				<th><span class="action">Action</span></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach($list['data'] as $key=>$data){ ?>
			<tr>
				<td ><?php echo $data['name']; ?></td>
				<td><?php echo $data['url']; ?></td>
				<td>
					<span class="group-action btn-group pull-right">
						<?php action("status", $module."/status-account", $data['id'], $page, $data['status']); ?>
						<?php action("edit", $module."/edit-account", $data['id'], $page, ""); ?>
						<?php action("delete", $module."/delete-account", $data['id'], $page, ""); ?>
					</span>
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php pagination(urlPagingAdmin($module), $paging['page'], $paging['totalpage']); ?>