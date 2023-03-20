<?php
$title_module = "Modules";
$list = listModule(); //db
?>

<h2 class="content-row-title"><?php echo $title_module; ?></h2>
<div class="row">
	<div class="col-md-12">
	  <table class="table">
	  <thead>
		<tr>
			<th>Module Name</th>
			<th><span class="action">Action</span></th>
		</tr>
	  </thead>
	  <tbody>
		<?php
		insertModule("home"); //home instal dulu
		insertModule("user"); //home instal dulu
		insertModule("config"); //home instal dulu
		
		foreach($list as $data){ 
			if(in_array($data, $list_module)){
			insertModule($data);
			$getModule = $db->value("*", "module", "WHERE name='".$data."' ");
			?>
			<tr>
				<td><?php echo name($data); ?></td>
			 	<td><span class="group-action btn-group pull-right">
				<?php action("status", $module."/status-module", $getModule['id'], $page, $getModule['status']); ?></span></td>
			</tr>
		<?php 
			}
		} ?>
	  </tbody>
	</table>
	</div>
</div>
