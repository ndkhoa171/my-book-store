<?php
include 'extension/connection.php';
ob_start();
session_start();
if (isset($_GET["role"])) {
  $_SESSION["role"] = $_GET["role"];
  $_SESSION["customerName"] = $_GET["customerName"];
  $_SESSION["customerid"] = $_GET["customerid"];
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js" style="background-color: rgb(250, 250, 250);">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MyBookStore</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

  <!-- -------New product--------- -->
  <link rel="stylesheet" href="extension/css/bootstrap.min.css">
  <link rel="stylesheet" href="extension/css/plugins.css">
  <link rel="stylesheet" href="extension/style.css">

  <!-- Cusom css -->
  <link rel="stylesheet" href="extension/css/custom.css">

  <!-- Modernizer js -->
  <script src="extension/js/vendor/modernizr-3.5.0.min.js"></script>

  <!-- font -->
  <link href="extension\fonts\font1.css" rel="stylesheet">
  <link href="extension\fonts\font2.css" rel="stylesheet">
  <link href="extension\fonts\font3.css" rel="stylesheet">

  <link rel="shortcut icon" href="./AdminDashboard/favicon.ico" />

</head>

<body>

  <!-- Navigation -->
  <?php include 'pages/Title.php' ?>

  <!-- Page Content -->

  <div class="container">
    <div class="row" id="content">
      <div class="col-lg-3">
        <!-- Search -->
        <?php include 'pages/FormSeach.php' ?>
        <!-- /Search -->

        <!-- ListCategory -->
        <?php include 'pages/ListCategory.php' ?>
        <!-- /ListCategory -->

        <!-- ListCompany -->
        <?php include 'pages/ListCompany.php' ?>
        <!-- /ListCompany -->
      </div>
      <!-- /.col-lg-3 -->

      <!-- col-lg-9 -->
      <div class="col-lg-9">
      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="image_book/panal01.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="image_book/nen1.png" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="image_book/pannal03.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="image_book/nen2.png" alt="Third slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="image_book/nen3.png" alt="Third slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="image_book/nen4.png" alt="Third slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="image_book/nen5.png" alt="Third slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="image_book/nen6.png" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <?php
        if (isset($_GET["act"]))
          $act = $_GET["act"];
        else
          $act = "index";

        switch ($act) {
          case "index":
            include('pages/pIndex.php');
            break;
          case "Detail":
            include('pages/Detail_Product.php');
            break;
          case "ListProduct":
            include('pages/pIndex.php');
            break;
          case "cart":
            include('pages/cart.php');
            break;
          default:
            include('pages/pIndex.php');
            break;
        }   ?>
      </div>
      <!-- /col-lg-9 -->
    </div>
    <!-- /.row -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </footer>
  </div>
  <!-- /.container -->





  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- --------------Neww  product---------------- -->
  <script src="extension/js/vendor/jquery-3.2.1.min.js"></script>
  <script src="extension/js/popper.min.js"></script>
  <script src="extension/js/bootstrap.min.js"></script>
  <script src="extension/js/plugins.js"></script>
  <script src="extension/js/active.js"></script>
</body>

</html>