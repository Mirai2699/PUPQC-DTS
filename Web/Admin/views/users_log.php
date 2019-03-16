<?php
    
    include("../utilities/Header.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/Tables.php");


?>  
      <title>PUPQC-DTS | Users' Logs</title>
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                    <h2 style="margin-top: 15px">View Users' Logs</h2>
                    <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 50px; width: 100%"></div> 
             </div>
            <!--END BREADCRUMBS-->


            <!--START INNER CONTENT-->

            <!--START BODY CONTENT-->
            <div class="row" style="background-color: white">
              <div class="col-md-12">
                <div class="box-info">
                  <div class="col-md-12">
                  <!--box-info start-->
                    <div class="box-info">
                      <div class="panel-heading" style="background-color: #666666; ">
                        <h4 style="color: white; font-size: 25px">View Users' Logs</h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                      </div>
                      <br>
                      <!--adv-table start-->
                      <div class="adv-table">
                       <table id="datatables" class="table table-striped table-no-border">
                          <thead>
                          <tr>
                              <th>Log No.</th>
                              <th>Account Username</th>
                              <th>Account User Type</th>
                              <th>Date of Access</th>
                              <th>Time of Access</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                              $view_query = mysqli_query($connection,"SELECT * FROM `t_users_log` AS LOG 
                                                                      INNER JOIN `t_accounts` AS ACC 
                                                                      INNER JOIN `r_user_role` AS USR 
                                                                      ON LOG.log_userID = ACC.acc_ID and
                                                                      LOG.log_usertype = USR.usr_ID ORDER BY LOG.Log_No DESC");
                              while($row = mysqli_fetch_assoc($view_query))
                              {
                                  $No = $row["log_No"];
                                  $username = $row["acc_username"];
                                  $userrole = $row["usr_desc"];
                                  $log_date = $row["log_datestamp"];
                                  $log_time = $row["log_timestamp"];
                                  
                                              
                          ?>      
                              <tr class="gradeX">
                                  <td><?php echo $No; ?></td>
                                  <td width=""><?php echo $username ?></td>
                                  <td width=""><?php echo $userrole; ?></td>
                                  <td width=""><?php echo $log_date ?></td>
                                  <td width=""><?php echo $log_time ?></td>
                              </tr>  
                          <?php } ?>
                          </tbody>
                        </table>
                      </div><!--adv-table end-->
                    </div>
                    <!--box-info end-->
                  </div>
                </div>
              </div>
            </div>
            <!--END BODY CONTENT-->

            <!--END INNER CONTENT-->


          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->
   </body>
</html>

                                                
