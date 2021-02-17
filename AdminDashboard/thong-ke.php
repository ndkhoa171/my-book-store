<?php
include 'connection.php';

//GET DATA
$bestSellingProducts = mysqli_query($conn, "select p.ProductName, sum(od.Quantity * od.UnitPrice) as total from orderdetails od join products p on od.ProductID_fk = p.ProductID group by od.ProductID_fk order by total desc limit 0,5");

$monthlyRevenue = mysqli_query($conn, "select month(o.Create_At) as month, sum(o.TotalPrice) as revenue from orders o group by month order by month");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Mangage - MyBookStore</title>
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
                        <input type="search" id="searchText" class="form-control" placeholder="Search Here" />
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
                        <a class="nav-link" data-toggle="collapse" href="#quanlisach" aria-expanded="false" aria-controls="ui-basic">
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
                        <a class="nav-link" href="./thong-ke.php">
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
                                    <div id="columnchart" style="width: 750px; height: 500px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div id="piechart" style="width: 500px; height: 500px;"></div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawPieChart);
    google.charts.setOnLoadCallback(drawColumnChart);

    function drawPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tên sản phẩm', 'doanh thu'],
            <?php
            while ($row = mysqli_fetch_array($bestSellingProducts)) {
                echo "['" . $row["ProductName"] . "', " . $row["total"] . "],";
            }
            ?>
        ]);
        var options = {
            title: '5 SẢN PHẨM ĐẠT DOANH THU CAO NHẤT',
            is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }

    function drawColumnChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tháng', 'doanh thu'],
            <?php
            while ($row = mysqli_fetch_array($monthlyRevenue)) {
                echo "['" . $row["month"] . "', " . $row["revenue"] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'DOANH THU THEO THÁNG',
            is3D: true,
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart'));
        chart.draw(data, options);
    }
</script>

</html>