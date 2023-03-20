<?php
// $url = base_url."".$_SERVER["REQUEST_URI"];
// redirectLastSlash($url);
//
// $parameter_allow[] = "category";
// $parameter_allow[] = "search";
// $parameter_allow[] = "sort";
// $parameter_allow[] = "page";
// $parameter_allow[] = "get";
//
// foreach ($list_module as $key => $value) {
// 	$file_function = base_root."/modules/".$value."/controller/function.php";
// 	if(is_file($file_function)){
// 		include_once $file_function;
// 	}
// }
//
// foreach ($list_module as $key => $value) {
// 	$file_action = base_root."/modules/".$value."/controller/action.php";
// 	if(is_file($file_action)){
// 		include_once $file_action;
// 	}
// }
//
// $web_config =  $db->all("inisial, value", "config", "WHERE status=1");
// foreach($web_config as $key=>$data){
// 	$setting[$data['inisial']] = $data['value'];
// }
//

// $page 		= $site->getPage();
// $alias 		= $site->getAlias($list_module);
// $switch 	= $site->getSwitch($alias, $parameter_allow);

$layout = "";
$template['layout'] = "";
$template['set_content'] = new theme();
$theme->start();
include_once "app/route.php";
$template['content'] = $template['set_content']->close();
$layout = $template['layout'];
?>
