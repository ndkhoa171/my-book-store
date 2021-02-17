<section id="cart">
  <div id="listCart" style="margin-top: 20px;" class="table-responsive">
    <table id="tbCart" class="table">
      <thead class="thead-light">
        <tr>
          <th>STT</th>
          <th>Ảnh sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>Đơn giá</th>
          <th>Số lượng</th>
          <th>Thành tiền</th>
          <th></th>
        </tr>
      </thead>
      <?php
      if (isset($_SESSION["cart"])) {
        $total = 0;
        foreach ($_SESSION["cart"] as $key => $value) {
      ?>
          <tr>
            <td>1</td>
            <td><img style="height: 50px; width: 50px; margin-left: auto; margin-right: auto;" src="<?php echo $value["image"] ?>"></td>
            <td> <?php echo $value["name"] ?> </td>
            <td><?php echo $value["price"] ?></td>
            <td>
              <input style="width: 80px;" type="number" class="form-control" value="<?php echo $value["num"] ?>" name="quantity" min="1" onchange="updateCart(<?php echo $key ?>)" id="quantity_<?php echo $key; ?>">
            </td>
            <td><?php echo $total += $value["price"] * $value["num"]; ?><sup><u></u></sup></td>
            <td><a href="javascript:void(0)" onclick="deleteCart(<?php echo $key ?>)"><i class="fa fa-trash-o"></i></a></td>
          </tr>
      <?php }
      } ?>
      <tr>
        <td colspan="4">
          <button style="background: #e59285 none repeat scroll 0 0;color: #fff; font-size: 14px;text-transform: uppercase;" class="btn">Cập nhật giỏ hàng</button>
        </td>
        <td>
          Tổng cộng:
        </td>
        <td colspan="2">
          <strong> <?php if (isset($total)) echo $total; ?><sup><u>đ</u></sup></strong>
        </td>
      </tr>
    </table>
  </div>
  <nav class="navbar">
    <a href="index.php?act=ListProduct" class="btn" style="background: #e59285 none repeat scroll 0 0;color: #fff; font-size: 14px;text-transform: uppercase;">Mua thêm</a>
    <form action="pages/pay.php">
      <input type="submit" name="Button_Pay" style="background: #e59285 none repeat scroll 0 0;color: #fff; font-size: 14px;text-transform: uppercase;" value="Đặt hàng" class="btn">
    </form>
  </nav>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    function updateCart(id) {
      num = $("#quantity_" + id).val();
      $.post('pages/updateCart.php', {
        'id': id,
        'num': num
      }, function(data) {
        //sau khi update
        $("#listCart").load("index.php?act=cart #tbCart");
      });
    }

    function deleteCart(id) {
      $.post('pages/updateCart.php', {
        'id': id,
        'num': 0
      }, function(data) {
        //sau khi update
        $("#listCart").load("index.php?act=cart #tbCart");
      });
    }
  </script>
</section>