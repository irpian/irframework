<?php
function isAdmin(){
	global $db;
	global $config;
	$session_admin = $config['session_admin'];
	$user = $_SESSION[$session_admin];
	$id = $_SESSION["admin_id"];
	$count_admin = $db->row("id", "admin", "WHERE name='$user' AND id='$id' AND status='1' ");
	if($count_admin=0 || $count_admin > 1){
		logout();
	}
}

function isUserRoot($id){
	if($id=="1"){
		return true;
	} else {
		return false;
	}
}

function loginCek(){
	global $_POST;
	global $db;
	global $config;
	$session_admin = $config['session_admin'];

	$login_failed_count = $_SESSION["login_failed"];
	if($_POST['login']){
		$user = $db->xxs($db->injection($_POST['user']));
		$password = $db->xxs($db->injection($_POST['password']));

		if ($user==""){ $pesan[] = "User Empty"; }
		if ($password==""){ $pesan[] = "Password Empty"; }

		$password_encript = encript($password);
		$count_admin = $db->row("id", "admin", "WHERE name='$user' AND password='$password_encript' AND status='1' ");

		if($_SESSION["login_failed"] >10){
			$pesan[] = "Try Again Later";
			$count_admin = 0;
		}

		if($count_admin==1){
			$db->update("admin", "login='".date("Y-m-d H:i:s")."'", "WHERE name='$user'");
			$data = $db->value("id", "admin", "WHERE name='$user'");
			$_SESSION[$session_admin] = $user;
			$_SESSION["admin_id"] = $data['id'];
			echo "<meta http-equiv='refresh' content='0; url=".base_admin."'>";
		} else {
			if($login_failed_count==""){
				$_SESSION["login_failed"] = 1;
			} else {
				$_SESSION["login_failed"] = $login_failed_count+1;
			}
			$pesan[] = "User Not Found, Please Check your User Or Password";
		}

		if($pesan > 0){
			echo errorList($pesan);
		}
	}
}

	function forgotPasswordCek(){
		global $db;
		$site_name = config("site_name");
		$login_failed_count = $_SESSION["password_failed"];

		if($_POST['login']){
			$user = $db->xxs($db->injection($_POST['user']));
			if (trim($user)==""){ $pesan[] = "User Empty"; }

			$password_encript = encript($pwd);
			$count_admin = $db->row("id", "admin", "WHERE email='$user'");
			$select_admin = $db->value("email, password", "admin", "WHERE email='$user' ");

			if($count_admin==1){
				$url_forgot_password = urlForgotPassword($select_admin['email'], $select_admin['password']);

				$penerima = $select_admin['email'];
				$subject = $site_name." - Lupa Password";
				$content="
				<b>Lupa Password $site_name</b><br>
				Ganti Password : ".$url_forgot_password;

				sendEmail($penerima, $subject, $content);
				echo success("Url Lupa Password Telah dikirim ke Email ");
			} else {
				if($login_failed_count==""){
					$_SESSION["password_failed"] = 1;
				} else {
					$_SESSION["password_failed"] = $login_failed_count+1;
				}
				$pesan[] = "User Not Found, Please Check your User Or Password";
				echo errorList($pesan);
			}

		}
	}

function forgotPasswordUrl($email, $password){
	$verification = encript(encript($email).encript($password));
	return '<a href="'.base_url.'/admin/forgot/'.$verification.'">Klik Disini</a>';
}

function forgotPasswordProcess($verification){
	global $db;
	$found = 0;
	$list_user = $db->all("id, email, name, password", "admin", "WHERE status=1");
	$new_password = newPassword();
	$new_password_save = encript($new_password);

	foreach ($list_user as $key => $data) {
		$encript_user = encript(encript($data['email']).encript($data['password']));
		if($encript_user==$verification){
			$found = 1;
			resetPassword($data['email'], $data['name'], $new_password);
			$db->update("admin", "password='".$new_password_save."'", "WHERE id='".$data['id']."' ");
			break;
		}
	}

	if($found == 0){
		$pesan[] = "Request Reset Password Not Valid";
		echo errorList($pesan);
	}
}

function passwordReset($email, $user, $new_password){
	$site_name = config("site_name");

	$subject = $site_name." - Reset Password";
	$content="$site_name : <br>
	<b>New Password</b><br>
	User : $user <br>
	Password : ".$new_password;

	sendEmail($email, $subject, $content);
	echo success("Password baru telah dikirim ke Email ");
}

function passwordNew(){
	$encript = encript(date("His"));;
	$new_password = substr($encript, 0, 10);
	return $new_password;
}

function logout($session_admin){
	unset($_SESSION[$session_admin]);
	unset($_SESSION);
}

?>
