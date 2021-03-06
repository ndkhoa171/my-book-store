<?php
include 'connection.php';

//PAGING
$result = mysqli_query($conn, 'select count(OrderID) as total from orders');
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
$query_orders = "select * from orders o join status_purchase sp on o.StatusID = sp.StatusID order by OrderID desc limit ";
$query_orders .= $start;
$query_orders .= ",";
$query_orders .= $limit;

//GET DATA
$orders = mysqli_query($conn, $query_orders);
$customers = mysqli_query($conn, "select * from customers");

//INSERT
$create_At = strval(date_create()->format('Y-m-d'));
if (isset($_POST['submit'])) {
    $query = "insert into orders(CustomerID, TotalPrice, Create_At, Create_Update, Is_Delete, ShippedDate, StatusID) values (" . $_POST['customerIDSelect'] . ", " . $_POST['totalPriceText'] . ", '" . $create_At . "', null, null, '" . $_POST['shippedDateDate'] . "', 1)";
    if (!mysqli_query($conn, $query))
        echo $sql . "<br>" . mysqli_error($conn);
    else
        header("Location:" . "./them-don-hang.php");
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
                                    <h4 class="card-title">DANH SÁCH ĐƠN HÀNG</h4>
                                    <table class="table table-hover" id="table">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Mã khách hàng</th>
                                                <th>Tổng tiền</th>
                                                <th>Ngày tạo</th>
                                                <th>Ngày giao hàng</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($orders)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo ($row["OrderID"]) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($row["CustomerID"]) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($row["TotalPrice"]) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($row["Create_At"]) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($row["ShippedDate"]) ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        switch ($row["StatusID"]) {
                                                            case 1: ?>
                                                                <label class="badge badge-primary">
                                                                    <?php echo $row["Value"]  ?>
                                                                </label>
                                                                <?php break; ?>
                                                            <?php
                                                            case 2: ?>
                                                                <label class="badge badge-info">
                                                                    <?php echo $row["Value"]  ?>
                                                                </label>
                                                                <?php break; ?>
                                                            <?php
                                                            case 3: ?>
                                                                <label class="badge badge-warning">
                                                                    <?php echo $row["Value"]  ?>
                                                                </label>
                                                                <?php break; ?>
                                                            <?php
                                                            case 4: ?>
                                                                <label class="badge badge-success">
                                                                    <?php echo $row["Value"]  ?>
                                                                </label>
                                                                <?php break; ?>
                                                            <?php
                                                            case 5: ?>
                                                                <label class="badge badge-danger">
                                                                    <?php echo $row["Value"]  ?>
                                                                </label>
                                                                <?php break; ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                    </table>
                                </div>
                                <div class="card-body align-items-center d-flex justify-content-center">
                                    <div class="pagination">
                                        <?php
                                        if ($current_page > 1 && $total_page > 1) {
                                            echo '<a href="them-don-hang.php?page=' . ($current_page - 1) . '">&laquo</a>';
                                        }
                                        for ($i = $min; $i <= $max; $i++) {
                                            if ($i == $current_page) {
                                                echo '<a href="them-don-hang.php?page=' . $i . '" class="active">' . $i . '</a>';
                                            } else {
                                                echo '<a href="them-don-hang.php?page=' . $i . '">' . $i . '</a>';
                                            }
                                        }
                                        if ($current_page < $total_page && $total_page > 1) {
                                            echo '<a href="them-don-hang.php?page=' . ($current_page + 1) . '">&raquo</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">THÊM ĐƠN HÀNG</h4>
                                    <form class="forms-sample" method="POST">
                                        <div class="form-group">
                                            <label>Khách hàng</label>
                                            <select class="form-control" name="customerIDSelect">
                                                <?php
                                                while ($row = mysqli_fetch_array($customers)) {
                                                ?>
                                                    <option value="'<?php echo $row['CustomerID'] ?>'">
                                                        <?php echo $row['CustomerID'] ?> -
                                                        <?php echo $row['CustomerName'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class=" form-group">
                                            <label>Tổng tiền</label>
                                            <input type="text" class="form-control" name="totalPriceText" required />
                                        </div>
                                        <div class=" form-group">
                                            <label>Ngày giao hàng</label>
                                            <input type="date" class="form-control" name="shippedDateDate" required />
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success mr-2">
                                            Thêm
                                        </button>
                                        <button class="btn btn-dark" onclick="cancel()">Hủy</button>
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
    $(document).ready(function() {
        $("#searchText").on("keydown", function() {
            var value = $(this).val().toLowerCase();
            $("#table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function cancel() {
        var totalPrice = document.getElementsByName("totalPrice");
        totalPrice.values = "";
    }
</script>

</html>