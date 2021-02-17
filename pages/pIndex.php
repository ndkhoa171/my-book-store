        
        <?php        
        $catID=0;
        $CompanyID=0;
        $sql_Product="SELECT * FROM products join photos join categories join publishingcompanys on products.ProductID = photos.ProductID 
        and categories.CategoryID=products.CategoryID and publishingcompanys.PublishingCompanyID=products.PublishingCompanyID where 1=1 ";
        
        if(isset($_GET["id_category"]))
        {
          $catID = $_GET["id_category"];
          if($catID!=0)
          {
            $sql_Product=  $sql_Product." and products.CategoryID = $catID ";
          }
        }
    
        if(isset($_GET["id_Company"]))
        {
          $CompanyID = $_GET["id_Company"];
          if($CompanyID!=0)
          {
            $sql_Product=$sql_Product." and products.PublishingCompanyID = $CompanyID ";
          }
        }
        
        include 'pages/HandleSearch.php'; //add query conditions
        
        //include 'pages/Paging.php'; // calculate paging information
    
        // $sql_Product=$sql_Product." LIMIT $start, $limit";   
        ?>

        <!-- NewProduct -->
        <?php include 'pages/NewProduct.php' ?>
        <!-- /NewProduct -->

        <!-- Message -->
        <?php include 'pages/Message.php'?>
        <!-- /Message -->
        
        <!-- ListProduct -->
         <!-- //include 'pages/ListProduct.php'  -->
        <!-- /ListProduct -->
        <!-- /.col-lg-9 -->

        <!-- Paging -->
        <?php 
        //include 'pages/ViewPaging.php';
        include 'pages/Paging.php';
        ?>
        <!-- /Paging -->

        <!-- BestSeller -->
        <?php
            include 'pages/BestSeller.php';    
        ?>
        <!-- /BestSeller --> 