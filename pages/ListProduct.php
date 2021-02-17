<?php

  $query_Product=mysqli_query($conn,$sql_Product.$paging->get_limit());
?>
<div class="row">
        <?php while ($row=mysqli_fetch_array($query_Product)) { ?> 
          
          <div class="col-lg-4 col-md-6 mb-4">
          <a href="index.php?act=Detail&id_product=<?php echo $row['ProductID']?>">
            <div class="card h-100">
              <img class="card-img-top"  width="100%"style src="<?php echo $row['Path']?> "alt=""></a>
              <div class="card-body">
                <h4 style="text-align: center;" class="card-title">
                  <a href="index.php?act=Detail&id_product=<?php echo $row['ProductID']?>"><?php echo $row['ProductName'] ?></a>
                </h4>
                <h6 style="text-align: center;">Giá: <?php echo $row['UnitPrice']?> VNÐ</h6>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>