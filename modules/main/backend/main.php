<div class="content-row">
	<div class="row">
	  <div class="col-md-12">
		<?php 
		foreach ($list_module as $key =>$value) { 
			$file_home = base_root."/modules/".$value."/admin/home.php"; 
			if(is_file($file_home) && $value!="home"){ 
				include_once $file_home; 
			} 
		}
		?>

		<?php 
		for ($i=0; $i < 20; $i++) { 
			//echo "https://www.latlong.net/c/?lat=-7.7598".rand(101,999)."&long=110.2439".rand(101,999)."<br>";
		}
		?>
	  </div>
	</div>
</div>