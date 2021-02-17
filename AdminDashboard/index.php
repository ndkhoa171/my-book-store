<?php
include 'connection.php';

$topProducts = mysqli_query($conn, "select p.ProductID, p.ProductName, count(od.ProductID_fk) as total from orderdetails od join products p on od.ProductID_fk = p.ProductID group by od.ProductID_fk order by total desc limit 0,20");

$topCustomers = mysqli_query($conn, "select c.CustomerName, c.Tel, (sum(od.Quantity) * sum(od.UnitPrice)) as total from customers c join orders o on c.CustomerID = o.CustomerID join orderdetails od on o.OrderID = od.OrderID group by c.CustomerName order by total desc limit 0,10");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Mange - MyBookStore</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/shared/style.css" />
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/demo_1/style.css" />
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="favicon.ico" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <form class="ml-auto search-form d-none d-md-block" action="#">
          <div class="form-group">
            <input type="search" class="form-control" placeholder="Search Here" />
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
                <p class="font-weight-light text-muted mb-0">admin</p>
              </div>
              <a class="dropdown-item" href="../index.php" onclick="close_window();return false;" style="cursor: pointer">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
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
      <!-- partial:partials/_sidebar.html -->
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
            <a class="nav-link" data-toggle="collapse" href="#quanlisach" aria-expanded="false" aria-controls="quanlisach">
              <i class="menu-icon typcn typcn-coffee"></i>
              <span class="menu-title">Quản lí sách</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="quanlisach">
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
              <i class="menu-arrow"> </i>
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
          <!-- Page Title Header Starts-->
          <div class="row page-title-header">
            <div class="col-md-12">
              <div class="page-header-toolbar">
                <div class="filter-wrapper">
                  <div class="dropdown ml-lg-auto ml-3 toolbar-item">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownexport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Xuất
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownexport">
                      <button class="dropdown-item" id="exportDOCX">DOCX</button>
                      <button class="dropdown-item" id="exportPDF" onclick="toPDF()">PDF</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Page Title Header Ends-->
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">TOP 20 SẢN PHẨM BÁN CHẠY NHẤT</h4>
                      </div>
                      <div class="table-responsive" id="topProductsTable">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th>Mã sách</th>
                              <th>Tên sách</th>
                              <th style="text-align: right;">Số lượng bán</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($topProducts)) {  ?>
                              <tr>
                                <td>
                                  <?php echo $row["ProductID"] ?>
                                </td>
                                <td>
                                  <?php echo $row["ProductName"] ?>
                                </td>
                                <td style="text-align: right;">
                                  <?php echo $row["total"] ?>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body" id="topCustomersTable">
                      <h4 class="card-title mb-0">TOP 10 KHÁCH HÀNG MUA NHIỀU NHẤT</h4>
                      <?php while ($row = mysqli_fetch_array($topCustomers)) { ?>
                        <div class="d-flex mt-3 py-2 border-bottom">
                          <div class="wrapper ml-2">
                            <p class="mb-n1 font-weight-semibold">
                              <?php echo $row["CustomerName"] ?>
                            </p>
                            <small>
                              <?php echo $row["Tel"] ?>
                            </small>
                          </div>
                          <small class="text-muted ml-auto">
                            <?php echo number_format($row["total"]) ?>
                          </small>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="assets/js/shared/off-canvas.js"></script>
  <script src="assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/demo_1/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>

  <!-- PDF -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</body>

<script>
  window.exportDOCX.onclick = function() {
    if (!window.Blob) {
      alert('Your legacy browser does not support this action.');
      return;
    }
    var html, link, blob, url, css;
    css = (
      '<style>' +
      '@page WordSection1{size: 841.95pt 595.35pt;mso-page-orientation: landscape;}' +
      'div.WordSection1 {page: WordSection1;}' +
      'table{border-collapse:collapse;}td{border:1px gray solid;width:5em;padding:2px;}' +
      '</style>'
    );
    html = window.topProductsTable.innerHTML;
    blob = new Blob(['\ufeff', css + html], {
      type: 'application/msword'
    });
    url = URL.createObjectURL(blob);
    link = document.createElement('A');
    link.href = url;
    link.download = 'top-san-pham-ban-chay';
    document.body.appendChild(link);
    if (navigator.msSaveOrOpenBlob) navigator.msSaveOrOpenBlob(blob, 'top-san-pham-ban-chay.doc');
    else link.click();
    document.body.removeChild(link);
  };

  function toPDF() {
    html2canvas(document.getElementById('topProductsTable'), {
      onrendered: function(canvas) {
        var data = canvas.toDataURL();
        var docDefinition = {
          content: [{
            image: data,
            width: 500
          }]
        };
        pdfMake.createPdf(docDefinition).download("top-san-pham-ban-chay.pdf");
      }
    });
  }
</script>

</html>