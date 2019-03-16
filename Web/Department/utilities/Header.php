<?php 
     include ("../../../db_con.php");
     session_start();
        $type = $_SESSION['UserRole'];
        if(!isset($_SESSION['UserName']) && $type!="2"){
          header('Location: 404.html?err=1');
        }
   
?> 
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PUPQC-DTS</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="" name="description">
		<meta content="" name="author">
		<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400italic,400,300,700">
		<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Squada+One">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/global/plugins/font-awesome/css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/global/plugins/ionicons/css/ionicons.min.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/global/plugins/simple-line-icons/simple-line-icons.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/global/plugins/animate.css/animate.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/global/plugins/iCheck/skins/all.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/global/css/style.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/assets/css/page-demo.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/assets/css/style-admin.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/assets/css/style-plugins.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/assets/css/style-responsive.css">
		<link type="text/css" rel="stylesheet" href="../../../resources-web/assets/css/themes/default.css" id="theme-color">
		<link rel="icon" href="../../../resources-web/images/PUPLogo.png">
	</head>

