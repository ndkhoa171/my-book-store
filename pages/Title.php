<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php?&id_category=0">My Book Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <?php
        if (isset($_SESSION["role"])) {
          $role = $_SESSION["role"];
          if ($role == 'admin') {
        ?><li class="nav-item">
              <a class="nav-link" href="AdminDashboard/index.php">Manage</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Login/index.php">Log out</a>
            </li>
          <?php } else { ?>
            <li class="nav-item active">
              <p class="nav-link" ><?php echo "Xin chào, ".$_SESSION["customerName"] ?></p>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Login/index.php">Log out</a>
            </li>
          <?php } ?>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="Login/index.php">Login</a>
          </li>
        <?php } ?>
        <?php
          	$numberCart = 0;
          	if(isset($_SESSION["cart"])){
          		foreach ($_SESSION["cart"] as $key => $value) {
          			$numberCart++;
          		}
          	}
          ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php if($numberCart>=1) echo "index.php?act=cart"; else echo "#"; ?>"><i></i>GIỎ HÀNG <span id="numberCart"><?php echo $numberCart; ?></span></a>
          </li>
      </ul>
    </div>
  </div>
</nav>