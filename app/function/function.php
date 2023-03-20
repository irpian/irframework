<?php
//time
function timeZone(){
	$timezone = "Asia/Jakarta";
	if(function_exists('date_default_timezone_set')){
		date_default_timezone_set($timezone);
	}
}

function bulan($bulan){
	if($bulan=="01"){ $hasil = "Januari"; }
	elseif($bulan=="02"){ $hasil = "Februari";}
	elseif($bulan=="03"){ $hasil = "Maret";}
	elseif($bulan=="04"){ $hasil = "April";}
	elseif($bulan=="05"){ $hasil = "Mei";}
	elseif($bulan=="06"){ $hasil = "Juni";}
	elseif($bulan=="07"){ $hasil = "Juli";}
	elseif($bulan=="08"){ $hasil = "Agustus";}
	elseif($bulan=="09"){ $hasil = "September";}
	elseif($bulan=="10"){ $hasil = "Oktober";}
	elseif($bulan=="11"){ $hasil = "November";}
	elseif($bulan=="12"){ $hasil = "Desember";}
	else{ $hasil = $bulan; }
	return $hasil;
}

function waktu($time, $status){
	if($status=="1"){ $hasil=substr($time,6,4)."-".substr($time,3,2)."-".substr($time,0,2); } //eng
	elseif($status=="2"){ $hasil=substr($time,6,4)."-".substr($time,3,2)."-".substr($time,0,2)." ".substr($time,11,8); } //eng + time
	elseif($status=="3"){ $hasil=substr($time,8,2)."-".substr($time,5,2)."-".substr($time,0,4); } //ind
	elseif($status=="4"){ $hasil=substr($time,8,2)."-".substr($time,5,2)."-".substr($time,0,4)." ".substr($time,11,8); } //ind + time
	elseif($status=="5"){ $hasil=substr($time,11,8); } // ambil jam
	else{ $hasil = $time; } //apa adanya
	return $hasil;
}



//content
function status($status1, $status2, $status) {
	if($status=="1"){
		$hasil = $status1;
	}else{
		$hasil = $status2;
	}
	return $hasil;
}

function ifReady($content, $backup_content=""){
	if($content!=""){
		$selected_content = $content;
	} else {
		$selected_content = $backup_content;
	}
	return $selected_content;
}

function ifReadyAtribute($content, $atribute=""){
	if($atribute!=""){
		return $content;
	} else {
		return "";
	}
}

function image($data_image, $directory_image, $url_image, $no_image=""){
	if($data_image){
		$image = $directory_image.$data_image;
	} elseif($data_image=="" && $url_image!=""){
		$image = $url_image;
	} else {
		if($no_image!=""){
			$image =$no_image;
		} else {
			$image = "";
		}
	}
	return $image;
}

function encript($value){
	return md5($value);
} 
?>
