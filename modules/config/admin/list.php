<?php
if($switch=="web"){
	$where = "WHERE web_config=1";
	$title_list = "Web Content";
} else {
	$where = "WHERE web_config=0";
}
$list = getList($module, $table, $primary, $select, $where, $orderby, $limit, $page);
$paging = $list['paging'];
?>

<h2 class="content-row-title"><?php echo $title_list; ?></h2>
<?php if($switch!="web"){ ?>
	<?php addDataButton($module, "add", $title_add); ?>
<?php } ?>

<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>Name Config</th>
					<th>Key</th>
					<th>Status</th>
					<th><span class="action">Action</span></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list['data'] as $key=>$data){ ?>
				<tr>
					<td><?php echo $data['name']; ?></td>
					<td><?php echo $data['inisial']; ?></td>
					<td>
					<?php if($data['status']==1){ ?>
						<span class="badge badge-success">
							<i class="glyphicon glyphicon-eye-open"></i>
						</span>
					<?php } else { ?>
						<span class="badge badge-normal">
							<i class="glyphicon glyphicon-eye-close"></i>
						</span>
					<?php } ?>
				</td>
					<td>
					<span class="group-action btn-group pull-right">
			<?php action("edit", $module, $data['id'], $page, ""); ?>
					<?php action("delete", $module, $data['id'], $page, ""); ?>
					</span>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php pagination(urlPagingAdmin($module), $paging['page'], $paging['totalpage']); ?>
