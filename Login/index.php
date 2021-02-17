<?php
if (isset($_SESSION['role'])) {
    unset($_SESSION['role']);
}
if (isset($_SESSION['customerName'])) {
    unset($_SESSION['customerName']);
}
if (isset($_SESSION['customerid'])) {
    unset($_SESSION['customerid']);
}
$sai = "";
$user = "";
if (isset($_GET['saipass'])) {
    $sai = "Sai tên tài khoản hoặc mật khẩu!";
    $user = $_GET['user'];
}
?>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">

<body>
    <div class="loginbox">
        <img src="avatar.png" class="avatar">
        <h1>ĐĂNG NHẬP</h1>
        <form method="post" action="xuly.php">
            <p>Tên đăng nhập</p>
            <input type="text" name="username" value="<?php echo $user; ?>" onclick="Change()" onchange="Change()" placeholder="Nhập tên đăng nhập" required>
            <p>Mật khẩu</p>
            <input type="password" name="password" onclick="Change()" onchange="Change()" placeholder="Nhập mật khẩu" required>
            <span id='message' style="margin-left: 15px; color: red;"><?php echo $sai; ?></span>
            <div style="margin-top: 8px;">
                <button type="submit" name="login" class="loginbutton" id="login" value="Login">Đăng nhập</button>
                <a href="Register/index.php">Bạn chưa có tài khoản?</a>
            </div>
        </form>
    </div>
    <script>
        function Change() {
            document.getElementById('message').innerHTML = '';
        }
    </script>
</body>

</head>

</html>