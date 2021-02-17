<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
              <h2 class="title__be--2" style="margin-top: 10px;"> 
                    <?php 
                      if($CompanyID!=0)
                      {
                        $query_Product=mysqli_query($conn,$sql_Product);  
                        $nameCompany = mysqli_fetch_array($query_Product);
                        echo "Sản xuất: " ?> <span class="color--theme" > <?php echo $nameCompany["PublishingCompanyName"] ?> </span> <?php
                      }
                      else if ($catID!=0)
                          {
                            $query_Product=mysqli_query($conn,$sql_Product);  
                            $nameCategory = mysqli_fetch_array($query_Product);
                            echo "Loại sách: " ?> <span class="color--theme" > <?php echo $nameCategory["CategoryName"] ?> </span> <?php
                          }
                          else
                          {
                            if(isset($_GET['search_button']))
                            {
                              echo "Kết quả tìm kiếm: ";
                            }
                            else
                            {
                              echo "Tất cả sách";
                            }
                          }
                    ?>
                </h2>
						</div>
					</div>
        </div>