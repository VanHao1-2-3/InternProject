<?php
include_once "Model/connect.php";
include_once "Model/product.php";
include_once "Model/cart.php";
include_once "Model/user.php";
include_once "Model/bill.php";
include_once "Model/page.php";
include_once "Model/validate.php";
include_once 'mail/index.php';
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
  <!-- Basic Page Needs -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FreshMart - Organic, Fresh Food, Van Hao</title>

  <meta name="keywords" content="Organic, Fresh Food, Farm Store">
  <meta name="description" content="FreshMart - Organic, Fresh Food, Farm Store HTML Template">
  <meta name="author" content="tivatheme">

  <!-- Favicon -->
  <link rel="shortcut icon" href="./View/img/favicon.png"">

  <!-- Mobile Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700" rel="stylesheet">

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="./View/libs/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="./View/libs/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="./View/libs/font-material/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="./View/libs/nivo-slider/css/nivo-slider.css">
  <link rel="stylesheet" href="./View/libs/nivo-slider/css/animate.css">
  <link rel="stylesheet" href="./View/libs/nivo-slider/css/style.css">
  <link rel="stylesheet" href="./View/libs/owl.carousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="./View/libs/slider-range/css/jslider.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="./View/css/style.css">
  <link rel="stylesheet" href="./View/css/reponsive.css">
  <link rel="stylesheet" href="./View/css/rating.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <script src="js/addons/rating.js"></script> -->
  <style>
    .fontSize {
      font-size: 19px;
    }
  </style>
</head>
<?php
if (!isset($_GET['action']) || $_GET['action'] == 'homeCtrl') {
  include_once "./View/homeBody.php";
} else {
  include_once "./View/ortherBody.php";
}
?>
<!-- <script src=""></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
	<!-- Vendor JS -->
	<script src="./View/libs/jquery/jquery.js"></script>
	<script src="./View/libs/bootstrap/js/bootstrap.js"></script>
	<script src="./View/libs/jquery.countdown/jquery.countdown.js"></script>
	<script src="./View/libs/nivo-slider/js/jquery.nivo.slider.js"></script>
	<script src="./View/libs/owl.carousel/owl.carousel.min.js"></script>
	<script src="./View/libs/slider-range/js/tmpl.js"></script>
	<script src="./View/libs/slider-range/js/jquery.dependClass-0.1.js"></script>
	<script src="./View/libs/slider-range/js/draggable-0.1.js"></script>
	<script src="./View/libs/slider-range/js/jquery.slider.js"></script>
	<script src="./View/libs/elevatezoom/jquery.elevatezoom.js"></script>

	<!-- Template CSS -->
	<script src="./View/js/main.js"></script>
</html>