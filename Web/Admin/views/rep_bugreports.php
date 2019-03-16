<?php
    
    include("../utilities/Header.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/Tables.php");


?>  
      <title>PUPQC-DTS | Reported Bugs</title>
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                    <h2 style="margin-top: 15px">Reported Bugs</h2>
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
                        <h4 style="color: white; font-size: 25px">View Users' Reporting Logs</h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                      </div>
                      <br>
                      <!--adv-table start-->
                      <div class="adv-table">
                       <table id="datatables" class="table table-striped table-no-border">
                          <thead>
                          <tr>
                              <th style="display: none">ID No.</th>
                              <th>Reported By:</th>
                              <th>Report Description</th>
                              <th>Date and Time Stamp</th>
                              <th style="text-align: center">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                              $view_query = mysqli_query($connection,"SELECT * FROM `t_report_bug` AS RB 
                                                                      INNER JOIN `t_accounts` AS ACC 
                                                                      ON RB.rb_reporter = ACC.acc_ID
                                                                      INNER JOIN `t_employees` AS EMP
                                                                      ON ACC.acc_empID = EMP.emp_ID
                                                                      ORDER BY RB.rb_ID DESC");
                              while($row = mysqli_fetch_assoc($view_query))
                              {
                                  $ID = $row["rb_ID"];
                                  $emp_lname = $row["emp_lastname"];
                                  $emp_mname = $row["emp_middlename"];
                                  $emp_fname = $row["emp_firstname"];

                                  $compname = $emp_fname.' '.$emp_lname;
                                  $rb_desc = $row["rb_desc"];
                                  $rb_timestamp = $row["rb_timestamp"];
                                              
                          ?>      
                              <tr class="gradeX">
                                  <td style="display: none"><?php echo $ID; ?></td>
                                  <td width=""><?php echo $compname ?></td>
                                  <td width=""><?php echo $rb_desc; ?></td>
                                  <td width=""><?php echo $rb_timestamp; ?></td>
                                  <td width="">
                                    <center>
                                      <a href="#" data-toggle="modal" class="btn btn-primary"><i class="fa fa-eye"></i> View More</a>
                                    </center>   
                                  </td>
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

                                                
