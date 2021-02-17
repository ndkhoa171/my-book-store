<?php
  $sql_Product_New="SELECT * from products join photos on products.ProductID = photos.ProductID order by products.Created_Add desc limit 0,10";
  $query_Product_New=mysqli_query($conn,$sql_Product_New);
?>

<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2" style="margin-top: 10px;">Sản phẩm <span class="color--theme">Mới</span></h2>
							<p>Trước những cuốn sách, tất cả mọi thứ đều mờ nhạt đi.(A.Sêkhốp)</p>
						</div>
					</div>
				</div>
        <div style="margin-left: 50px;" style="margin-right: 100px;" class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
          <!-- Start Single Product -->
          <?php while ($row_Product_New=mysqli_fetch_array($query_Product_New)) {?>
          <div class="product product__style--3">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
              <div class="product__thumb">
              <a href="index.php?act=Detail&id_product=<?php echo $row_Product_New['ProductID']?>"><img  src="<?php echo $row_Product_New['Path']?>" alt="product image"></a>
              </div>
              <div>
                <h4 style="text-align: center;" ><a href="index.php?act=Detail&id_product=<?php echo $row_Product_New['ProductID']?>" style="color: rgb(23, 86, 221);"><?php echo $row_Product_New['ProductName'] ?></a></h4>
                <h5 style="text-align: center;"><?php echo $row_Product_New['UnitPrice']?> VNÐ</h5>
                <p style="font-style: italic; text-align: center;" >NSX: <?php echo $row_Product_New['Created_Add']?> </p>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>