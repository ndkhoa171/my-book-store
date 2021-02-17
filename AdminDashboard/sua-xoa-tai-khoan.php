<?php
include 'connection.php';

//PAGING
$result = mysqli_query($conn, 'select count(AccountID) as total from accounts');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;
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
$query_accounts = "select * from accounts order by Role desc limit ";
$query_accounts .= $start;
$query_accounts .= ",";
$query_accounts .= $limit;

//GET DATA
$accounts = mysqli_query($conn, $query_accounts);

//UPDATE
if (isset($_POST['edit'])) {
    $query_update = "update accounts set Password= '" . $_POST['passwordPassword'] . "', Role= '" . $_POST['roleText'] . "' where AccountID= '" . $_POST['accountIDText'] . "'";
    if (!mysqli_query($conn, $query_update))
        echo $sql . "<br>" . mysqli_error($conn);
    else
        header("Location:" . "./sua-xoa-tai-khoan.php");
}

//DELETE
if (isset($_POST['delete'])) {
    $query_delete = "delete from accounts where AccountID= '" . $_POST['accountIDText'] . "'";
    if (!mysqli_query($conn, $query_delete))
        echo $sql . "<br>" . mysqli_error($conn);
    else
        header("Location:" . "./sua-xoa-tai-khoan.php");
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
                                <p class="mb-1 mt-3 font-weight-semibold">Admim</p>
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
                                    <a class="nav-link" href="sua-xoa-the-loai.php">Chỉnh sửa - Xóa</a>
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
                                    <h4 class="card-title">DANH SÁCH TÀI KHOẢN</h4>
                                    <table class="table table-hover" id="table">
                                        <thead>
                                            <tr>
                                                <th>Tên tài khoản</th>
                                                <th>Vai trò</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($accounts)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo ($row["AccountID"]) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($row["Role"]) ?>
                                                    </td>
                                                    <td hidden>
                                                        <?php echo ($row["Password"]) ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-secondary">Chọn</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                    </table>
                                </div>
                                <div class="card-body align-items-center d-flex justify-content-center">
                                    <div class="pagination">
                                        <?php
                                        if ($current_page > 1 && $total_page > 1) {
                                            echo '<a href="sua-xoa-tai-khoan.php?page=' . ($current_page - 1) . '">&laquo</a>';
                                        }
                                        for ($i = $min; $i <= $max; $i++) {
                                            if ($i == $current_page) {
                                                echo '<a href="sua-xoa-tai-khoan.php?page=' . $i . '" class="active">' . $i . '</a>';
                                            } else {
                                                echo '<a href="sua-xoa-tai-khoan.php?page=' . $i . '">' . $i . '</a>';
                                            }
                                        }
                                        if ($current_page < $total_page && $total_page > 1) {
                                            echo '<a href="sua-xoa-tai-khoan.php?page=' . ($current_page + 1) . '">&raquo</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">CHỈNH SỬA TÀI KHOẢN</h4>
                                    <form class="forms-sample" method="POST">
                                        <div class="form-group">
                                            <label>Tên tài khoản</label>
                                            <input type="text" class="form-control" name="accountIDText" id="accountIDText" required readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Mật khẩu cũ</label>
                                            <input type="text" class="form-control" name="oldPasswordText" readonly id="oldPasswordText" />
                                        </div>
                                        <div class="form-group">
                                            <label>Mật khẩu mới</label>
                                            <input type="password" class="form-control" name="passwordPassword" id="passwordPassword" />
                                        </div>
                                        <div class="form-group">
                                            <label>Vai trò</label>
                                            <input type="text" class="form-control" name="roleText" id="roleText" required />
                                        </div>
                                        <button type="submit" name="edit" class="btn btn-warning">
                                            Lưu
                                        </button>
                                        <button type="submit" name="delete" class="btn btn-danger">Xóa</button>
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

        $("#accountIDText").val(col0.trim());
        $("#roleText").val(col1.trim());
        $("#oldPasswordText").val(col2.trim());
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