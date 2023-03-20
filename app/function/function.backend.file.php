<?php
function uploadDefault($upload_file, $folder){
	$newphoto1 = $upload_file;
	$uploaddir1 = "$folder";
	$namagambar = $upload_file;
	$uploadfile1 = $uploaddir1 . basename($namagambar);
	if (move_uploaded_file($_FILES["file"]['tmp_name'], $uploadfile1)) {
		//echo "Gambar berhasil di upload<br>";
	} else {
		//echo "Gambar Gagal di upload<br>";
	}
}

function uploadResize($fupload_name, $folder, $h1, $w1){
	$vdir_upload = $folder;
	$vfile_upload = $vdir_upload . $fupload_name;
	move_uploaded_file($_FILES["file"]["tmp_name"], $vfile_upload);
	$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);
	$dst_width = $w1;
	$dst_height = $h1;
	$im = imagecreatetruecolor($dst_width, $dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
	imagejpeg($im, $vdir_upload. "" .$fupload_name);
}
?>
