<?php
include 'connection.php';

//PAGING
$result = mysqli_query($conn, 'select count(ProductID) as total from products');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 12;
$total_page = ceil($total_records / $limit);

$range = 5;
$middle = ceil($range / 2);

$min = 1;
$max = $total_page;
if ($total_page > $range) {
  $min = $current_page - $middle + 1;
  $max = $current_page + $middle - 1;

  if ($min < 1) {
    $min = 1;
    $max = $range;
  } else if ($max > $total_page) {
    $max = $total_page;
    $min = $total_page - $range + 1;
  }
}

if ($current_page > $total_page)
  $current_page = $total_page;
else if ($current_page < 1)
  $current_page = 1;

$start = ($current_page - 1) * $limit;
$query_products = "select * from products limit ";
$query_products .= $start;
$query_products .= ",";
$query_products .= $limit;

//GET DATA
$products = mysqli_query($conn, $query_products);
$categories = mysqli_query($conn, "select * from categories");
$publishingCompanys = mysqli_query($conn, "select * from publishingcompanys");

//UPDATE
if (isset($_POST['edit'])) {
  $discontinued = $_POST['discontinuedCheckbox'] ? 1 : 0;
  $query_update = "update products set ProductName= '" . $_POST['productNameText'] . "',CategoryID= " . $_POST['categoryIdSelect'] . ",PublishingCompanyID= " . $_POST['publishingCompanyIdSelect'] . ",Author= '" . $_POST['authorText'] . "',UnitPrice= " . $_POST['unitPriceText'] . ",UnitsInStock= " . $_POST['unitsInStockText'] . ",UnitsOnOrder= " . $_POST['unitsOnOrderText'] . ",Description= '" . $_POST['descriptionTextarea'] . "',Discontinued= " . $discontinued . " where ProductID= " . $_POST['productIdText'] . "";
  if (!mysqli_query($conn, $query_update))
    echo $sql . "<br>" . mysqli_error($conn);
  else
    header("Location:" . "./sua-xoa-sach.php");
}

//DELETE
if (isset($_POST['delete'])) {
  $query_delete = "delete from products where ProductID= " . $_POST['productIdText'] . "";
  if (!mysqli_query($conn, $query_delete))
    echo $sql . "<br>" . mysqli_error($conn);
  else
    header("Location:" . "./sua-xoa-sach.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Mange - MyBookStore</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./assets/css/shared/style.css" />
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="./assets/css/demo_1/style.css" />
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="favicon.ico" />

  <style>
    .pagination {
      display: inline-block;
    }

    .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
    }

    .pagination a.active {
      background-color: #4CAF50;
      color: white;
      border-radius: 5px;
    }

    .pagination a:hover:not(.active) {
      background-color: #ddd;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="../index.html">
          <img src="../assets/images/logo-mini.svg" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <form class="ml-auto search-form d-none d-md-block" action="#">
          <div class="form-group">
            <input type="search" class="form-control" id="searchText" placeholder="Search Here" />
          </div>
        </form>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="admin.jpg" alt="Profile image" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="admin.jpg" alt="Profile image" />
                <p class="mb-1 mt-3 font-weight-semibold">Admin</p>
              </div>
              <a class="dropdown-item" href="../index.php" onclick="close_window();return false;" style="cursor: pointer;">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category">Main Menu</li>
          <li class="nav-item">
            <a class="nav-link" href="./index.php">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Báo cáo</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Quản lí sách</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="them-sach.php">Thêm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sua-xoa-sach.php">Chỉnh sửa - Xóa</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#quanlitheloai" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Quản lí thể loại</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="quanlitheloai">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="them-the-loai.php">Thêm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sua-xoa-the-loai.php">Chỉnh sửa - Xóa</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#quanlinhaxuatban" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Quản lí nhà xuất bản</span>
              <i class="menu-arrow"> </i>
            </a>
            <div class="collapse" id="quanlinhaxuatban">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="them-nha-xuat-ban.php">Thêm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sua-xoa-nha-xuat-ban.php">Chỉnh sửa - Xóa</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#quanlitaikhoan" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Quản lí tài khoản</span>
              <i class="menu-arrow"> </i>
            </a>
            <div class="collapse" id="quanlitaikhoan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="them-tai-khoan.php">Thêm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sua-xoa-tai-khoan.php">Chỉnh sửa - Xóa</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#quanlidonhang" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Quản lí đơn hàng</span>
              <i class="menu-arrow"> </i>
            </a>
            <div class="collapse" id="quanlidonhang">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="them-don-hang.php">Thêm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sua-xoa-don-hang.php">Chỉnh sửa - Xóa</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="thong-ke.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Thống kê</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">DANH SÁCH SẢN PHẨM</h4>
                  <table class="table table-hover" id="table">
                    <thead>
                      <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Ngày tạo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($row = mysqli_fetch_array($products)) {
                      ?>
                        <tr>
                          <td>
                            <?php echo ($row["ProductID"]) ?>
                          </td>
                          <td>
                            <?php echo ($row["ProductName"]) ?>
                          </td>
                          <td hidden>
                            <?php echo ($row["CategoryID"]) ?>
                          </td>
                          <td hidden>
                            <?php echo ($row["PublishingCompanyID"]) ?>
                          </td>
                          <td hidden>
                            <?php echo ($row["Author"]) ?>
                          </td>
                          <td hidden>
                            <?php echo ($row["UnitPrice"]) ?>
                          </td>
                          <td hidden>
                            <?php echo ($row["UnitsInStock"]) ?>
                          </td>
                          <td hidden>
                            <?php echo ($row["UnitsOnOrder"]) ?>
                          </td>
                          <td hidden>
                            <?php echo ($row["Description"]) ?>
                          </td>
                          <td hidden>
                            <?php echo ($row["Discontinued"]) ?>
                          </td>
                          <td>
                            <?php echo ($row["Created_Add"]) ?>
                          </td>
                          <td>
                            <button type="submit" class="btn btn-secondary">Chọn</button>
                          </td>
                        </tr>
                      <?php } ?>
                  </table>
                </div>
                <div class="card-body align-items-center d-flex justify-content-center">
                  <div class="pagination">
                    <?php
                    if ($current_page > 1 && $total_page > 1) {
                      echo '<a href="sua-xoa-sach.php?page=' . ($current_page - 1) . '">&laquo</a>';
                    }
                    for ($i = $min; $i <= $max; $i++) {
                      if ($i == $current_page) {
                        echo '<a href="sua-xoa-sach.php?page=' . $i . '" class="active">' . $i . '</a>';
                      } else {
                        echo '<a href="sua-xoa-sach.php?page=' . $i . '">' . $i . '</a>';
                      }
                    }
                    if ($current_page < $total_page && $total_page > 1) {
                      echo '<a href="sua-xoa-sach.php?page=' . ($current_page + 1) . '">&raquo</a>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">CHỈNH SỬA SẢN PHẨM</h4>
                  <form class="forms-sample" method="POST">
                    <div class="form-group">
                      <label>Mã sản phẩm</label>
                      <input type="text" class="form-control" name="productIdText" id="productIdText" required readonly />
                    </div>
                    <div class="form-group">
                      <label>Tên sản phẩm</label>
                      <input type="text" class="form-control" name="productNameText" id="productNameText" required />
                    </div>
                    <div class="form-group">
                      <label>Thể loại</label>
                      <select class="form-control" name="categoryIdSelect" id="categoryIdSelect">
                        <?php
                        while ($row = mysqli_fetch_array($categories)) {
                        ?>
                          <option value="<?php echo $row['CategoryID'] ?>">
                            <?php echo $row['CategoryName'] ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nhà xuất bản</label>
                      <select class="form-control" name="publishingCompanyIdSelect" id="publishingCompanyIdSelect">
                        <?php
                        while ($row = mysqli_fetch_array($publishingCompanys)) {
                        ?>
                          <option value="<?php echo $row['PublishingCompanyID'] ?>">
                            <?php echo $row['PublishingCompanyName'] ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class=" form-group">
                      <label>Tác giả</label>
                      <input type="text" class="form-control" name="authorText" id="authorText" required />
                    </div>
                    <div class=" form-group">
                      <label>Đơn giá</label>
                      <input type="text" class="form-control" name="unitPriceText" id="unitPriceText" required />
                    </div>
                    <div class="form-group">
                      <label>Đơn giá trên kệ</label>
                      <input type="text" class="form-control" name="unitsInStockText" id="unitsInStockText" required />
                    </div>
                    <div class="form-group">
                      <label>Đơn giá trên đơn hàng</label>
                      <input type="text" class="form-control" name="unitsOnOrderText" id="unitsOnOrderText" required />
                    </div>
                    <div class="form-group">
                      <label>Mô tả</label>
                      <textarea class="form-control" name="descriptionTextarea" rows="5" id="descriptionTextarea" required></textarea>
                    </div>
                    <div class="form-check form-check-flat">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="discontinuedCheckbox" name="discontinuedCheckbox" />
                        Tiếp tục kinh doanh sản phẩm này ?
                      </label>
                    </div>
                    <div style="margin-top: 30px;">
                      <button type="submit" name="edit" class="btn btn-warning mr-2">
                        Sửa
                      </button>
                      <button type="submit" name="delete" class="btn btn-danger">
                        Xóa
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">FIT - HCMUS</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="./assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="./assets/js/shared/off-canvas.js"></script>
  <script src="./assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="./assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
  <!-- End custom js for this page-->
</body>

<script>
  $('.table tbody').on('click', '.btn-secondary', function() {
    var currow = $(this).closest('tr');
    var col0 = currow.find('td:eq(0)').text();
    var col1 = currow.find('td:eq(1)').text();
    var col2 = currow.find('td:eq(2)').text();
    var col3 = currow.find('td:eq(3)').text();
    var col4 = currow.find('td:eq(4)').text();
    var col5 = currow.find('td:eq(5)').text();
    var col6 = currow.find('td:eq(6)').text();
    var col7 = currow.find('td:eq(7)').text();
    var col8 = currow.find('td:eq(8)').text();
    var col9 = currow.find('td:eq(9)').text();

    $("#productIdText").val(col0.trim());
    $("#productNameText").val(col1.trim());
    $("#categoryIdSelect").val(col2.trim()).change();
    $("#publishingCompanyIdSelect").val(col3.trim()).change();
    $("#authorText").val(col4.trim());
    $("#unitPriceText").val(col5.trim());
    $("#unitsInStockText").val(col6.trim());
    $("#unitsOnOrderText").val(col7.trim());
    $("#descriptionTextarea").val(col8.trim());
    col9 == 1 ? $("#discontinuedCheckbox").prop('checked', true) :
      $("#discontinuedCheckbox").prop('checked', false);
  })

  $(document).ready(function() {
    $("#searchText").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#table tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

</html>