<?php
$array_menu = $db->all("*", "menu", "WHERE parent='0' AND position=0 AND status=1  ORDER BY orderby ASC");
?>
<nav id="nav-menu-container">
	<ul class="nav-menu">
		<?php
		foreach($array_menu as $key=>$data){
			$count_child = $db->row("*", "menu", "WHERE parent='".$data['id']."' AND position=0 AND status=1");
			if ($count_child==0){ ?>

				<?php if(preg_match("/http:/",$data['url']) || preg_match("/https:/",$data['url'])){ ?>
					<li>
						<a href="<?php echo $data['url']; ?>" target="_blank">
							<?php echo $data['name']; ?>
						</a>
					</li>
				<?php } else { ?>
					<li>
						<a href="<?php echo base_url."/".$data['url']; ?>">
							<?php echo $data['name']; ?>
						</a>
					</li>
				<?php } ?>



			<?php }else{ ?>
				<li class="menu-has-children">
					<a href=""><?php echo $data['name']; ?> </a>
					  <ul>
					<?php
					$array_sub_menu = $db->all("*", "menu", "WHERE parent='".$data['id']."' AND position=0 AND status=1 ORDER BY orderby ASC"); 
					 foreach($array_sub_menu as $key=>$data){ ?>
						 <li><a href="<?php echo base_url."/".$data['url']; ?>"><?php echo $data['name']; ?></a></li>
					<?php } ?>
					  </ul>
				</li>
			<?php
			}
		} ?>
		<li>
			<span id="icon-search" class="cursor-pointer">
				<i class="ion-ios-search"></i>
			</span>

			
		</li>
	</ul>
	<div class="container hide" id="search">
		<div class="clear"></div>
		<form action="<?php echo base_url."/search"; ?>" class="search right" method="post">
			<input type="text" class="form-control" value="Search" name="search" title="search" onfocus="this.value=''">
		</form>
		
	</div>
</nav>