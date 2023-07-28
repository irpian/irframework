<?php
//query
function setQuery($post, $unset, $admin=1){
	global $db;
	$set = "";
	foreach ($post as $key => $value) {
		if(!in_array($key, $unset)){
			if($admin==1){
				$set .= " ".$key."='".$value."', " ;
			} else {
				$set .= " ".$key."='".$db->xxs($db->injection($value))."', " ;
			}
		}
	}
	$setAll = substr($set, 0, -2); //koma & spasi
	return $setAll;
}

function unsetPost($post){
	foreach ($post as $key => $value) {
		$_POST[$key] = "";
	}
	return $_POST;
}

function defaultUnsetQuery($unset){
	if($unset!="" && is_array($unset)){
		$array = $unset;
	} else {
		$array = array("id", "image_hidden", "file_hidden", "submit");
	}
	return $array;
}

function config($inital){
	global $db;
	$value = $db->value("value", "config", "WHERE inisial='".$inital."' AND status='1' ");
	return $value;
}

//function getList($module, $table, $primary="id", $select="*", $where=" WHERE 1 ", $orderby=" id DESC ", $limit=10, $page){
function getList($module, $table, $primary, $select, $where, $orderby, $limit, $page){
	global $db;
		$total_row = $db->row($primary, $table, $where);
		$totalPage = totalPage($total_row, $limit);
		$start = limitStart($page, $limit);
		if($total_row > 0){
			$orderby_limit = $orderby." LIMIT {$start}, {$limit}";
			$list['data'] = $db->all($select, $table, "$where $orderby_limit");
			$list['paging']['module'] = $module;
			$list['paging']['page'] = $page;
			$list['paging']['totalpage'] = $totalPage;
			$list['record'] = $total_row;
			$list['qry'] = "SELECT $select FROM $table $where $orderby_limit";
			$list['report'] = "Found ".$total_row." Data $select $table $where $orderby_limit";
		} else {
			$list['qry'] = "SELECT $select FROM $table $where $orderby_limit";
			$list['report'] = "Data Not Found";
		}
		return $list;
}

//function getDetail($select="*", $table, $primary="id", $id){
function getDetail($select, $table, $primary, $id){
	global $db;
	$data = $db->value($select, $table, " WHERE $primary='".$id."'");
	return $data;
}

function getSeo($parameter, $parameter_allow){
	if(!in_array($parameter, $parameter_allow) && $parameter!="page"){
		$seo =  str_replace(" ", "-", strtolower($parameter));
	} else {
		$seo =  '';
	}

	return $seo;
}

function setViewer($table, $fieldAndValue, $where){
	global $db;
	$db->update($table, $fieldAndValue, $where);
}

//paging
function getPage($parse_page){
	if($parse_page=="" || $parse_page<0){
		$page = 1;
	}elseif(!is_numeric($parse_page)){
		//redirect404();
		$page = 1;
	}else{
		$page = $parse_page;
	}
	return $page;
}

function totalPage($total_row, $limit){
	$total_page = $total_row/$limit;
	if((int)$total_page < $total_page){
		 $total_page = (int)$total_page+1;
	}
	return $total_page;
}

function limitStart($page, $limit){
	$start = $limit * ($page-1);
	return $start;
}

function pagination($action, $page, $total){
	$paging = "";

	if($action<>""){
		$action= "/".$action."/";
	} else {
		$action="";
	}

	if($total > 1){
	?>
	<div class="row content-row-pagination">
		<div class="col-md-4">
			<div class="pagination">
				<?php echo("Page {$page} From {$total}  "); ?>
			</div>
		</div>
		<div class="col-md-8">
		<ul class="pagination pull-right">
			<?php
			if($page<=1){
				echo '<li class="active"><a href="#">Prev</a></li>';
			}else{
				$prev = $page-1;
				echo '<li><a class="'.$paging.'" href="'.base_url.$action.$prev.'">Prev</a></li>';
			}

			if($page < 1){
				$page = 1;
			}
			//-------------------------------------------------------------------------------------------
			if($page > 3){
				$first = '<li class="'.$paging.'"><a href="'.base_url.$action.'1">1</a></li>';
			}else {
				$first = "";
			}
			$number = ( $page > 3 ? "<li><a class='disable'>...</a></li>" : "" );
			echo "$first";
			for($i = $page - 2;$i < $page; $i++) {
				if($i < 1){
					continue;
				}
				$number .= '<li class="'.$paging.'"><a href="'.base_url.$action.$i.'">'.$i.'</a></li>';
			}
			//-------------------------------------------------------------------------------------------
			$number .= "<li class='active'><a href='#'>$page</a></li>";
			for($i=$page+1;$i<($page+3);$i++) {
				if($i > $total ){
					break;
				}
				$number .= '<li class="'.$paging.'"><a href="'.base_url.$action.$i.'">'.$i.'</a></li>';
			}
			//-------------------------------------------------------------------------------------------
			$number.= ($page+2<$total ? '<li class="disable"><a href="#">...</a></li>
			<li class="'.$paging.'"><a href="'.base_url.$action.$total.'">'.$total.'</a></li>' : "" );
			echo "$number";

			if($page>=$total){
				echo '<li class="active"><a href="#">Next</a></li>';
			}else{
				$next = $page+1;
				echo '<li class="'.$paging.'"><a href="'.base_url.$action.$next.'">Next</a></li>';

			} ?>
		</ul>
		</div>
	</div>
	<?php } ?>
	<?php
}
?>
