<?php 
function loginForm(){ 
session_start(); 
global $_GET;

if($_GET['action']=="forgot"){
    $action = "forgot";
} else {
    $action = "";
}

if($action=="forgot"){
    $url_form = "forgot"; 
    $title = "Lupa Password";
    $name_form = "Email";
    $button_value = "Kirim";
    $keterangan = "Url konfirmasi Lupa Password akan dikirim kirim ke Email";
} else {
    $url_form = "login"; 
    $title = "Login Admin";
    $name_form = "User";
    $button_value = "Login";
    $keterangan = "";
}
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Login Admin</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="<?php echo base_admin; ?>/assets/css/site.min.css">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?php echo base_admin; ?>/assets/js/site.min.js"></script>
  <style>
    body {
    font-family:Arial, Helvetica, sans-serif;
    line-height:200%;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #303641;
    color: #C1C3C6
  }
  .alert{
    color:#fff;
  }
  </style>
</head>
<body>
  <div class="container">
  
    <form class="form-signin" role="form" name="form1" method="post" action="<?php echo base_admin."/".$url_form; ?>">
    <h3 class="form-signin-heading"><?php echo $title; ?></h3>
    <?php 
    if($action=="forgot"){
      forgotPasswordCek();
    } else {
      loginCek();
    } 

    $verification = $_GET['verification'];
    if($verification!=""){ 
      forgotPasswordProcess($verification);
    }
    ?>
    <div class="form-group">
      <div class="input-group">
      <div class="input-group-addon">
        <i class="glyphicon glyphicon-user"></i>
      </div>
      <input type="text" class="form-control" name="user" id="username" placeholder="<?php echo $name_form; ?>" autocomplete="off" />
      </div>
    </div>
    
    <?php if($action=="forgot"){  } else {?>
    <div class="form-group">
      <div class="input-group">
      <div class="input-group-addon">
        <i class=" glyphicon glyphicon-lock "></i>
      </div>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
      </div>
    </div>
    <?php } ?>

     <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="<?php echo $button_value; ?>"><?php echo $button_value; ?></button>
    </div>

      <p>
      <?php if($action=="forgot"){ ?>
        <p>Link Reset password akan dikirim ke email</p>
        <i class="pull-right"><a href="<?php echo base_admin; ?>/login" class="forgot">Login</a></i>
      <?php } else {?>
        <i class="pull-right"><a href="<?php echo base_admin; ?>/forgot" class="forgot">Forgot Password</a></i>
      <?php } ?>
      </p>

    </form>

  </div>
  <div class="clearfix"></div>
  <br><br>
  <!--footer-->
  <div class="container">
    <div class="site-footer login-footer form-signin">
    <div class="copyright clearfix text-center">
      <p> &copy; Copyright 2018 Excrozer Design <a href="<?php echo base_url; ?>">irpian.com</a></p>
    </div>
    </div>
  </div>
  </body>
</html>
<?php } ?>

<?php
  loginForm();
?>