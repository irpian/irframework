<?php
$title_list		= "Theme";
$list 			= listTheme();
$setTheme		= config("theme");

if($_GET['select']<>""){
	changeTheme($_GET['select']);
	$setTheme = config("theme");
}
?>

<h2 class="content-row-title">
	<?php echo $title_list; ?>
</h2>

<div class="row">
	<div class="col-md-12">
		<?php foreach($list as $data){ ?>
		<div class="col-sm-6 col-md-3">
			<div class="thumbnail"> 
			<img class="img-rounded" src="<?php echo base_url."/themes/".$data."/preview.png"; ?>">
				<div class="caption text-center">
					<h3><?php echo $data; ?></h3>
					<p>
					<?php if($data==$setTheme){ ?>
					<a href="#" class="btn btn-default">Theme Selected</a>
					<?php } else { ?>
					<a href="<?php echo base_admin."/config/theme/select/".$data; ?>" class="btn btn-primary">Select Theme</a> 
					<?php } ?>
					</p>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
