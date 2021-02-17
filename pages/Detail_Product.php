<?php
$ProductID = $_GET['id_product'];
$sql_Product_Detail = "SELECT * FROM products join photos on products.ProductID = photos.ProductID
    join publishingcompanys  join categories on products.CategoryID = categories.CategoryID and products.PublishingCompanyID=publishingcompanys.PublishingCompanyID 
    where products.ProductID=" . $ProductID;
$sql_Product_NumberViews = "UPDATE products set Numberviews = Numberviews + 1 where (products.ProductID =" . $ProductID . ")";


$query_Product_Detail = mysqli_query($conn, $sql_Product_Detail);
$product_Detail = mysqli_fetch_array($query_Product_Detail);

$catID = $product_Detail['CategoryID'];
$proID = $product_Detail['ProductID'];
$sql_Product_Category = "SELECT * from products join photos on products.ProductID = photos.ProductID where products.CategoryID=$catID and products.ProductID<>$proID limit 0,5";

$query_NumberViews = mysqli_query($conn, $sql_Product_NumberViews);
$query_Product_Category = mysqli_query($conn, $sql_Product_Category);
?>

<head>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #e59285;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #fbecea;
      padding: 10px 15px;
    }
  </style>


</head>

<!-- Detail Product -->
<div class="wn__single__product">
  <div class="row">
    <div class="col-lg-6 col-12">
      <img id="anh" width="100%" style src="<?php echo  $product_Detail['Path'] ?> " alt=""></a>
    </div>
    <div class="col-lg-6 col-12">
      <div class="product__info__main">
        <h1 id="ProName"><?php echo $product_Detail['ProductName'] ?></h1>
        <div class="price-box">
          <h2 id="ProPrice">Giá bán: <?php echo $product_Detail['UnitPrice'] ?> VNÐ </h2>
        </div>
        <div class="product__overview"> </div>
        <div class="box-tocart d-flex">
          <span>Số lượng </span>
          <input id="qty" class="input-text qty" name="qty" min="1" value="1" title="Qty" type="number">
          <div class="addtocart__actions">
            <button class="tocart" type="submit" onclick="addCart(<?php echo $product_Detail['ProductID']; ?>)" title="Add to Cart">Thêm vào giỏ</button>
          </div>
          <div class="product-addto-links clearfix">
            <a class="wishlist" href="#"></a>
            <a class="compare" href="#"></a>
          </div>
        </div>

        <div class="product-share">
          <table>
            <tr>
              <th colspan="2" style="text-align: center;">THÔNG TIN CHI TIẾT</th>
            </tr>
            <tr>
              <td>Số lược xem</th>
              <td><?php echo $product_Detail['NumberViews'] ?></th>
            </tr>
            <tr>
              <td>Số lượng bán</td>
              <td><?php echo $product_Detail['UnitsOnOrder'] ?></td>
            </tr>
            <tr>
              <td>Tác giả</td>
              <td><?php echo $product_Detail['Author'] ?></td>
            </tr>
            <tr>
              <td>Nhà sản xuất</td>
              <td><?php echo $product_Detail['PublishingCompanyName'] ?></td>
            </tr>
            <tr>
              <td>Thể loại</td>
              <td><?php echo $product_Detail['CategoryName'] ?></td>
            </tr>
            <tr>
              <td>Ngày xuất bản</td>
              <td><?php echo $product_Detail['Created_Add'] ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <br><br>
  <h1>MÔ TẢ SẢN PHẨM</h1>
  <?php echo $product_Detail['Description'] ?>

  <!-- /.col-lg-9 -->
  <!-- Category -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section__title text-center">
          <h2 class="title__be--2" style="margin-top: 10px;">Sản phẩm <span class="color--theme">Cùng loại</span></h2>
        </div>
      </div>
    </div>
  </div>
  <div style="margin-left: 50px;" style="margin-right: 100px;" class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
    <!-- Start Single Product -->
    <?php while ($row_Product_Category = mysqli_fetch_array($query_Product_Category)) { ?>
      <div class="product product__style--3">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="product__thumb">
            <a href="index.php?act=Detail&id_product=<?php echo $row_Product_Category['ProductID'] ?>"><img src="<?php echo $row_Product_Category['Path'] ?>" alt="product image"></a>
          </div>
          <div>
            <h4><a href="index.php?act=Detail&id_product=<?php echo $row_Product_Category['ProductID'] ?>" style="color: rgb(23, 86, 221);"><?php echo $row_Product_Category['ProductName'] ?></a></h4>
            <h5 style="text-align: center;"><?php echo $row_Product_Category['UnitPrice'] ?>000 VNÐ</h5>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <!-- /Category -->

</div>
<!-- /.Detail Product -->
<script>
  function addCart(id) {
    num = $("#qty").val();
    $.post('pages/addCart.php', {
      'id': id,
      'num': num
    }, function(data) {
      img = $("#anh").attr("src");
      $('#nameCart').text($('#ProName').text());
      $('#priceCart').text($('#ProPrice').text());
      $('#numCart').text(num);
      $("#anhMoldal").attr({
        'src': img,
      })
      $('#showCart').modal();
      $("#numberCart").text(data);
    });

  }
</script>
<div class="modal fade" id="showCart" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">Thông tin mua hàng</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <img id="anhMoldal" src="">
          </div>
          <div class="col-md-6">
            <p>Tên sách: <span id="nameCart"> </span></p>
            <p><span id="priceCart"> </span></p>
            <p>Số lượng: <span id="numCart"> </span></p>
            <p style="margin-top: 30px;">ĐÃ THÊM VÀO GIỎ HÀNG</p>
          </div>
        </div>

      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->