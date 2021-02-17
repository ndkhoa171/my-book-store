<?php
$sql_Category = "SELECT * FROM categories";
$query_Category = mysqli_query($conn, $sql_Category);
$sql_PubshingCompany = "SELECT * FROM publishingcompanys";
$query_PubshingCompany = mysqli_query($conn, $sql_PubshingCompany);
?>
<h2 class="my-4">Tìm kiếm </h2>
<form class="list-group">
  <div class="list-group-item">
    <label>Tên sách:</label>
    <input type="text" placeholder="Tên sách?" name="_nameBook">
  </div>
  <div class="list-group-item">
    <label>Phân loại:</label>
    <select name="_categoryBook" id="categoryBook"  style="width:185px;">
      <option value="">Tất cả</option>
      <?php while ($row_cat = mysqli_fetch_array($query_Category)) { ?>
        <option value="<?php echo $row_cat['CategoryName'] ?>"><?php echo $row_cat['CategoryName'] ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="list-group-item">
    <label>Sản xuất:</label>
    <select name="_companyBook" id="companyBook" style="width:185px;">
      <option value="">Tất cả</option>
      <?php while ($row_cat = mysqli_fetch_array($query_PubshingCompany)) { ?>
        <option value="<?php echo $row_cat['PublishingCompanyName'] ?>"><?php echo $row_cat['PublishingCompanyName'] ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="list-group-item">
    <label>Tác giả:</label>
    <input type="text" placeholder="Tác giả?" name="_authorBook">
  </div>
  <div class="list-group-item">
    <label style="font-weight: bold;">Giá:</label><br>
    <label style="color: gray; font-size: 12;">Chọn khoảng giá:</label><br>
    <input pattern="[0-9]*" type="text" name="From_Price" placeholder="Giá từ" style="width: 95px;" value="0">
    <span>-</span>
    <input pattern="[0-9]*" type="text" name="To_Price" placeholder="Giá đến" style="width: 95px;" value="0">
    <input type="submit" class="btn" name="search_button" style="background: #e59285 none repeat scroll 0 0;color: #fff; font-size: 14px;text-transform: uppercase;margin-top: 10px;" value="Search">
  </div>
</form>