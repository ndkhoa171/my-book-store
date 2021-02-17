
<?php 
    include 'extension/pagination.php';

    // Tìm tổng số trang
    $result=mysqli_query($conn,$sql_Product);
    // $rows = $db->query('SELECT id FROM table');
    $total =  mysqli_num_rows($result);

    $config = array(
    'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
    'total_record'  => $total, // Tổng số record
    'limit'         => 12,// limit
    'link_full'     => 'index.php?page={page}',// Link full có dạng như sau: domain/com/page/{page}
    'link_first'    => 'index.php',// Link trang đầu tiên
    'range'         => 5 // Số button trang bạn muốn hiển thị 
    );

    $paging = new Pagination();
    $paging->init($config);

    // Phần hiển thị truy vấn data
    // $data = $db->query('SELECT * FROM table '.$paging->get_limit());
    // foreach($data as $row) {
    include 'pages/ListProduct.php';
    // hiển thị vòng lặp database
    //}
?>

    <!-- Phần hiển thị phân trang -->
    <div> 
<?php   
    echo $paging->html();
?>
     </div>   
<?php



    // $totalItem=0;
    // $totalPage=0;
    
    // $result=mysqli_query($conn,$sql_Product);
    // $totalItem = mysqli_num_rows($result);
    // $limit = 12;
    // $totalPage= ceil($totalItem/$limit);
    // $current_page = isset($_GET['page'])?$_GET['page'] : 1;
    
    // if($current_page>$totalPage){
    //     $current_page=$totalPage;
    // }
    // else if($current_page<1){
    //     $current_page=1;
    // }

    // $start=($current_page-1)*$limit;
    
?>