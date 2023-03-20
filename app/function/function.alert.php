<?php
    function alertErrorList($pesan){
    	echo '<div class="alert alert-danger">';
    	$urut_pesan=0;
    	foreach($pesan as $indeks=>$pesan_tampil) {
    			$urut_pesan++;
    			echo "<font>";
    			echo "$urut_pesan . $pesan_tampil <br>";
    			echo "</font>";
    	}
    	echo "</div>";
    }

    function alertError($error){
    	echo '<div class="alert alert-danger">';
    	echo $error;
    	echo "</div>";
    }

    function alertSuccess($success){
    	echo '<div class="alert alert-success">';
    	echo $success;
    	echo "</div>";
    }

    function alertFailed($failed){
    	echo '<div class="alert alert-info">';
    	echo $failed;
    	echo "</div>";
    }
?>
