<?php
    $sql_Product_BestSeller="SELECT * from products join photos on products.ProductID = photos.ProductID order by products.UnitsOnOrder desc limit 0,10";
    $query_Product_BestSeller=mysqli_query($conn,$sql_Product_BestSeller);
?>
<div class="container">
        <div class="section__title text-center">
          <h2 class="title__be--2" style="margin-top: 10px;">Sản phẩm <span class="color--theme">Bán chạy</span></h2>
        </div>
        <div class="slider center">
              <!-- Single product start -->
              <?php while ($row_Product_BestSeller=mysqli_fetch_array($query_Product_BestSeller)) {?>
                  <div class="product product__style--3">
                      <div class="product__thumb">
                          <a class="first__img" href="index.php?act=Detail&id_product=<?php echo $row_Product_BestSeller['ProductID']?>"><img  src="<?php echo $row_Product_BestSeller['Path']?>" alt="product image"></a>
                      </div>
                      <div >
                            <h6 ><a href="index.php?act=Detail&id_product=<?php echo $row_Product_BestSeller['ProductID']?>" style="color: rgb(23, 86, 221);"><?php echo $row_Product_BestSeller['ProductName'] ?></a></h6>
                            <h7 style="text-align: center;"><?php echo $row_Product_BestSeller['UnitPrice']?>000 VNÐ</h7>
                            <p style="font-style: italic; text-align: center;" >Đã bán: <?php echo $row_Product_BestSeller['UnitsOnOrder']?> </p>
                      </div>
                  </div>
              <?php } ?>
          </div>     
    </div>