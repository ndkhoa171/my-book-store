<?php 
    $sql_PubshingCompany="SELECT * FROM publishingcompanys";
    $query_PubshingCompany=mysqli_query($conn,$sql_PubshingCompany);
?>
<h2 class="my-4">Nhà xuất bản </h2>
<div class="list-group">
    <?php while ($row_cat=mysqli_fetch_array($query_PubshingCompany)) { ?>
    <a href="index.php?act=ListProduct&id_Company=<?php echo $row_cat['PublishingCompanyID']?>" class="list-group-item"><?php echo $row_cat['PublishingCompanyName']?> </a>
    <?php }?>
    <a href="index.php?act=ListProduct&id_Company=0" class="list-group-item">Tất cả NXB</a>
</div>