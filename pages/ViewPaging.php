<div>
            <h1 style="text-align: center;">
                <?php 
                      $fillter="&id_category=0";
                      if ($catID!=0)
                        {
                          $fillter="&id_category=$catID";
                        }
                        else {
                            if ($CompanyID!=0)
                            {
                              $fillter="&id_Company=$CompanyID";
                            }
                        }

                      if($current_page>1 && $totalPage>1) {
                          echo '<a href="index.php?page='.($current_page-1).$fillter.'"><  </a>';
                        }
                      for($i=1;$i<=$totalPage;$i++){
                          if($i==$current_page){
                            echo '<span class="color--theme">'.$i.' </span>';
                          }
                          else {
                            echo '<a href="index.php?page='.$i.$fillter.'">'.$i.' </a>';
                          }
                      }
                      if ($current_page<$totalPage && $totalPage>1){
                        echo '<a href="index.php?page='.($current_page+1).$fillter.'">></a>';
                      }
                  ?> 
              </h1>
       </div>   