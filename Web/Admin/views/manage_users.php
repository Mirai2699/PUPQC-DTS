<?php
    
   include("../utilities/Header.php");
   include("../utilities/BaseJs.php");
   include("../utilities/Notification.php");
   include("../utilities/navibar.php");
    include("../utilities/Tables.php");

?>

   
      <title>PUPQC-DTS | Manage Users</title>   
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left" >
      <!--BEGIN CONTENT-->
       <div class="content" > 
          <section class="main-content">
               <!--START BREADCRUMBS-->
               <div class="col-md-12">
                   <h2 style="margin-top: 15px">Manage Users</h2>
                   <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 50px; width: 100%"></div> 
               </div>
              <!--END BREADCRUMBS-->

             <!--END HEADING CONTENT-->
            
             <!--START BODY CONTENT-->
             <div class="row" style="background-color: white">
               <div class="col-md-12" >
                 <div class="box-info" >
                       <div class="panel-heading" style="background-color: #666666; ">
                         <h4 style="color: white; font-size: 25px">View Accounts and Users Details</h4>
                         <div class="row" style="padding:1px; background-color:white;"></div>
                       </div>
                       <br>
                       <!--adv-table start-->
                       <div class="adv-table">
                            <table id="datatables" class="table table-striped table-no-border">
                               <thead>
                               <tr>
                                   <th style="display: none">account_ID</th>
                                   <th>User Employee</th>
                                   <th>Account Username</th>
                                   <th>Account User Role</th>
                                   <th>Date Last Modified</th>
                                   <th>Status</th>
                                   <th style="text-align: center">Action</th>
                               </tr>
                               </thead>
                               <tbody>
                               <?php
                                   $view_query = mysqli_query($connection,"SELECT * FROM `t_accounts` AS ACC 
                                                                           INNER JOIN `r_user_role` AS USR 
                                                                           INNER JOIN `t_employees` AS EMP 
                                                                            INNER JOIN `r_office` AS OFF
                                                                            ON  ACC.acc_user_role = USR.usr_ID
                                                                            and EMP.emp_office = OFF.office_ID
                                                                            and ACC.acc_empID = EMP.emp_ID");
                                   while($row = mysqli_fetch_assoc($view_query))
                                   {
                                       $ID = $row["acc_ID"];
                                       $emp_lname = $row["emp_lastname"];
                                       $emp_mname = $row["emp_middlename"];
                                       $emp_fname = $row["emp_firstname"];
                                       $emp_office = $row["emp_office"];
                                       $emp_pos = $row["emp_position"];
                                       $emp_pic = $row["emp_picture"];
                                       $acc_username = $row["acc_username"];
                                       $acc_password = $row["acc_password"];
                                       $acc_user_role = $row["acc_user_role"];
                                       $acc_role = $row["usr_desc"];
                                       $acc_mod_date = $row["acc_mod_date"];
                                       $acc_active_flag = $row["acc_active_flag"];

                                       $compname = $emp_lname.', '.$emp_fname;
                                                   
                               ?>      
                                   <tr class="gradeX">
                                       <td style="display: none"><?php echo $ID; ?></td>
                                       <td width=""><?php echo $compname; ?></td>
                                       <td width=""><?php echo $acc_username ?></td>
                                       <td width=""><?php echo $acc_role; ?></td>
                                       <td width=""><?php echo $acc_mod_date; ?></td>
                                       <td width=""><?php echo $acc_active_flag; ?></td>
                                       <td style='width:12%'>
                                           <center>
                                               <a data-toggle="modal" href="#edit<?php echo $ID?>" class="btn btn-warning btn-round">
                                                       <i class="fa fa-edit" data-size="16" title="Modify Details"></i>
                                                       &nbsp;Edit
                                               </a>   
                                               <a data-toggle="modal" href="#archive<?php echo $ID?>" class="btn btn-danger btn-round">
                                                       <i class="fa fa-power-off" data-size="16" title="Toggle Status"></i>
                                               </a>            
                                           </center>
                                       </td>
                                   </tr>  
                               <?php } ?>
                               </tbody>
                           </table>
                       </div>
                       <!--adv-table end-->
                   
                 </div>
               </div>
             </div>
          </section>
       </div>
       <!--START INCLUDE MODAL-->
       <?php include("get_view_modal_manage_account.php"); ?>
       <!--END INCLUDE MODAL-->
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->

   <!--ON PAGE RESOURCES-->
   

   


   </body>
</html>