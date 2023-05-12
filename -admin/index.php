<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

error_reporting(0);
session_start();
include_once "../config.php";
include_once "../include/db.php";
include_once "../include/class.form.php";
include_once "../include/function.php";
include_once "../include/function.admin.php";
include_once "../include/function.module.php";
include_once "../include/function.install.php";

foreach ($list_module as $key =>$value) {
    $file_function = base_root."/modules/".$value."/controller/function.php";
    if(is_file($file_function)){
        include_once $file_function;
    }
}

$in_admin = 1;
$page = getPage($_GET['page']);

autoRedierctModuleNonActive($_GET['action'], base_admin);
realAdmin();

if($_SESSION[$session_admin]==""){
    include_once "include/login.php";
    die();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $website; ?> - Admin Panel</title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
        <link rel="shortcut icon" href="<?php echo base_admin; ?>/assets/img/icon.png" />
        <link rel="stylesheet" href="<?php echo base_admin; ?>/assets/css/site.min.css" />
        <link rel="stylesheet" href="<?php echo base_admin; ?>/assets/css/custom.css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_admin; ?>/assets/js/site.min.js"></script>
    </head>
    <body>
        <!--nav-->
        <nav role="navigation" class="navbar navbar-custom">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo base_admin; ?>" class="navbar-brand">Admin Panel</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="<?php echo base_url.''; ?>" target="_blank">Preview</a></li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">User <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li class="dropdown-header">Setting</li>
                                <li>
                                    <a>
                                        User :
                                        <?php echo $_SESSION[$session_admin]; ?>
                                    </a>
                                </li>
                                <li><a href="<?php echo base_admin.'/user/change-password'; ?>">Ganti Password</a></li>
                                <li class="divider"></li>
                                <li class=""><a href="<?php echo base_admin.'/logout'; ?>">Signout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!--header-->
        <div class="container-fluid">
            <!--documents-->
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
                    <ul class="list-group panel">
                        <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>Menu</b></li>
                        <?php  menuAdmin(0, $_GET['action']); ?>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-9 content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href="javascript:void(0);" class="toggle-sidebar"> <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>
                                <?php echo titleMainPage($_GET['action']); ?>
                            </h3>
                        </div>

                        <div class="panel-body">
                            <div class="content-row">
                                <?php include "include/switch.php"; ?>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <!-- panel body -->
                    </div>
                </div>
                <!-- content -->
            </div>
        </div>

        <!--footer-->
        <div class="footers container-fluid">
            <div class="content-row text-center">
                &copy; Copyright 2020 Excrozer Design
            </div>
        </div>

        <script type="text/javascript">
            $(function () {
                $(".filter").change(function () {
                    $(".form-filter").submit();
                });
            });
        </script>
    </body>
</html>
