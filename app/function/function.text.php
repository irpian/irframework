<?php
function name($name){
	$name = ucwords($name);
	return $name;
}

function ribuan($angka) {
	$hasil =  number_format($angka,0, ", ", ".");
	return $hasil;
}

function rupiah($angka) {
	$hasil =  "Rp. ".number_format($angka,0, ", ", ".")." ,-";
	return $hasil;
}

function tag($content){
	$explode = explode(",", $content);
	$tag = '<div id="tag" class="row">';
	foreach ($explode as $key => $value) {
		$tag .= '<div class="col-md-6"><h3 class="tag">'.rtrim($value, "").'</h3></div>';
	}
	$tag .= "</div>";
	return $tag;
}

function nameToSeo($name, $seo=""){ //$seo, $name
	if($name==""){
		$name = $seo;
	}
	$name = str_replace("-", "_", strtolower($name));
	$name = str_replace(" ", "-", strtolower($name));
	return $name;
}

function seoToName($name){
	$name = str_replace("-", " ", ucwords($name));
	$name = str_replace("_", "-", ucwords($name));
	return $name;
}

function brief($document, $jumlah){
	$search = array ("'<script[^>]*?>.*?</script>'si",
				"'<[\/\!]*?[^<>]*?>'si",
				"'([\r\n])[\s]+'",
				"'&(quot|#34);'i",
				"'&(amp|#38);'i",
				"'&(lt|#60);'i",
				"'&(gt|#62);'i",
				"'&(nbsp|#160);'i",
				"'&(iexcl|#161);'i",
				"'&(cent|#162);'i",
				"'&(pound|#163);'i",
				"'&(copy|#169);'i",
				"'&#(\d+);'i");
	$replace = array ("", "", "\\1", "\"", "&", "<", ">", " ", chr(161), chr(162), chr(163), chr(169), "chr(\\1)");
	$text = preg_replace ($search, $replace, $document);
	$text = substr($text,0, $jumlah);
	return $text;
}
 ?>
