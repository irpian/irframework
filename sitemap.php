<?php
error_reporting(0);
include "config.php";
require_once "include/db.php";
require_once "include/function.php";
require_once "include/function.module.php";
header('Content-type: application/xml');

$sitemap_last_update = "2020-10-10"; //Y-m-d 
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
$page = $_GET['page'];
$page = getPage($page);
?>

<?php 
foreach ($list_module as $key =>$value) { 
	$file_sitemap = base_root."/modules/".$value."/controller/sitemap.php"; 
	if(is_file($file_sitemap)){ 
		include_once $file_sitemap; 
	} 
}
?>

</urlset>