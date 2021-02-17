<?php
include 'Region.php'
?>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">

<body>
    <h2>Đăng ký mới</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="post" action="xuly.php" id="dangky">
                <h1>Đăng ký</h1>
                <input type="text" placeholder="Tên đăng nhập" title="Có ít nhất 5 ký tự, không có ký tự đặc biệt" pattern="^[A-Za-z0-9]{5,}$" id="username" name="username" required />
                <input type="password" placeholder="Mật khẩu" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" onchange="check_pass()" title="Mật khẩu có thiểu tám ký tự, ít nhất một chữ cái và một số" id="Pass" name="Pass" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                <input type="password" id="xacnhan" name="xacnhan" placeholder="Nhập lại mật khẩu" onchange="check_pass()" />
                <span id='message'></span>
                <button type="button" style="margin-top: 20px;" onclick="postform()" id="check" name="check">Hoàn tất</button>
            </form>

        </div>
        <div class="form-container sign-in-container">
            <form method="post" action="xuly.php" id="dangky">
                <h1>Điền thông tin</h1>
                <input type="text" id="name" placeholder="Họ tên" required />
                <input type="date" id="date" placeholder="Ngày sinh" required />
                <input type="email" id="email" placeholder="Email liên hệ" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                <select id="address" required class="custom-select">
                    <?php
                    for ($i = 0; $i < count($name); $i++) { ?>
                        <option><?php echo $name[$i] ?></option>
                    <?php } ?>
                </select>
                <span id='message2'></span>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Để giữ kết nối với chúng tôi, vui lòng đăng ký bằng thông tin cá nhân của bạn</p>
                    <button class="ghost" id="signIn">Quay lại</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Nhập thông tin cá nhân của bạn và bắt đầu hành trình với chúng tôi</p>
                    <button class="ghost" onclick="next()" id="signUp">Tiếp theo</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');


    /*signUpButton.addEventListener('click', () => {
        container.classList.add('right-panel-active');
    });*/

    signInButton.addEventListener('click', () => {
        container.classList.remove('right-panel-active');
    });

    function postform() {

        name = document.getElementById('name').value;
        birth = document.getElementById('date').value;
        email = document.getElementById('email').value
        var sel = document.getElementById('address');
        var opt = sel.options[sel.selectedIndex];
        address = opt.text;
        username = document.getElementById('username').value;
        pass = document.getElementById('Pass').value;
        xacnhan = document.getElementById('xacnhan').value;
        if (username.length < 5) {
            alert("Đăng ký thất bại, tên tài khoản phải trên 5 ký tự!");
            return;
        }
        if (pass.length < 8) {
            alert("Đăng ký thất bại, mật khẩu phải trên 8 ký tự!");
            return;
        }
        if (pass != xacnhan) {
            alert("Đăng ký thất bại, mật khẩu xác nhận không trùng khớp!");
            return;
        }

        $.post('xuly.php', {
            'name': name,
            'birth': birth,
            'email': email,
            'address': address,
            'username': username,
            'xacnhan': xacnhan
        }, function(data) {
            if (data == 1) {
                alert("Đăng ký thất bại, tên tài khoản đã tồn tại!");
            }
            if (data == 2) {
                alert("Đăng kí thành công, hãy đăng nhập lần đầu tiên!");
                location.assign("../index.php");
            }
            if (data == 3) {
                alert("Đăng ký thất bại!");
            }
        });

    }

    function check_pass() {
        if (document.getElementById('Pass').value == "" || document.getElementById('xacnhan').value == "") {
            document.getElementById('message').innerHTML = '';
            document.getElementById('check').disabled = false;
        } else if (document.getElementById('Pass').value == document.getElementById('xacnhan').value) {
            document.getElementById('check').disabled = false;
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Trùng khớp';

        } else {
            document.getElementById('check').disabled = true;
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Không trùng khớp';
        }
    }

    function next() {
        // var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        document.getElementById('message2').style.color = 'red';
        document.getElementById('message2').innerHTML = 'Hãy điền đầy đủ thông tin!';
        if (document.getElementById('name').value == "") {
            return;
        }
        if (document.getElementById('address').selectedIndex == 0) {
            return;
        }
        // if(pattern.test(document.getElementById('email').value) == false)
        // {
        //     document.getElementById('message2').innerHTML = 'Email không hợp lệ';
        // 	return;
        // }
        if (document.getElementById('date').value == "") {
            return;
        }
        document.getElementById('message2').innerHTML = '';
        container.classList.add('right-panel-active');

    }
</script>
</head>

</html>