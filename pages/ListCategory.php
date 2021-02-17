<?php 
    $sql_Category="SELECT * FROM categories";
    $query_Category=mysqli_query($conn,$sql_Category);
?>

<h2 class="my-4">Loại sách </h2>
<div class="list-group">
    <?php while ($row_cat=mysqli_fetch_array($query_Category)) { ?>
    <a href="index.php?act=ListProduct&id_category=<?php echo $row_cat['CategoryID']?>" class="list-group-item"><?php echo $row_cat['CategoryName']?> </a>
    <?php }?>
    <a href="index.php?act=ListProduct&id_category=0" class="list-group-item">Tất cả sách</a>
</div>