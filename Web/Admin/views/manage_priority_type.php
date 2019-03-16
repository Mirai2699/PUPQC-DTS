<?php
    
    include("../utilities/Header.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/Tables.php");


?>
      <title>PUPQC-DTS | Manage Priority Types</title>
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                 <h2 style="margin-top: 15px">Manage Priority Types</h2>
                 <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 50px; width: 100%"></div> 
             </div>
            <!--END BREADCRUMBS-->


            <!--START INPUT TYPE -->
            <div class="row" style="background-color: white">
              <div class="col-md-12" >
                <div class="box-info">

                       <div class="panel-heading" style="background-color: #002846; ">
                           <h4 style="color: white; font-size: 25px">Add Priority Type</h4>
                           <div class="row" style="padding:1px; background-color:white;"></div>
                       </div>
                       <br>
                       <form action="../functionalities/insert_func.php" method="POST">
                         <div class="col-md-4">
                             <label><b>Priority Type Description:</b></label>
                             <input type="text" class="form-control" name="prio_desc" required/>
                         </div>
                         <div class="col-md-1">
                             <label><b>Date Count:</b></label>
                             <input type="number" class="form-control" name="prio_date_count" min="1" max="100" required/>
                         </div>
                         <div class="col-md-1">
                             <button class="btn btn-success" type="submit" name="add_prior_type" style="margin-top: 26px"><i class="fa fa-save"></i> Save</button>
                         </div>
                       </form> 

                  </div>
                </div>
              </div>
             <!--END INPUT TYPE -->

             <!--START TABLE-->
             <div class="row" style="background-color: white">
               <div class="col-md-12" style="margin-top: 50px;">
                 <div class="box-info" >
                       <div class="panel-heading" style="background-color: #666666; ">
                         <h4 style="color: white; font-size: 25px">View Priority Types</h4>
                         <div class="row" style="padding:1px; background-color:white;"></div>
                       </div>
                       <br>
                       <!--adv-table start-->
                       <div class="adv-table">
                         <table id="datatables" class="table table-striped table-no-border">
                           <thead>
                           <tr>
                               <th style="display:none">ID</th>
                               <th>Priority Type Description</th>
                               <th>Date Count Limit</th>
                               <th>Date Modified</th>
                               <th style="text-align: center">Action</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                               $view_query = mysqli_query($connection,"SELECT * FROM `r_priority_type` WHERE priority_stat = 1");
                               while($row = mysqli_fetch_assoc($view_query))
                               {
                                   $ID = $row["priority_ID"];
                                   $priotype_name = $row["priority_desc"];
                                   $priotype_dc = $row["priority_date_count"];
                                   $priotype_stat = $row["priority_stat"];
                                   $priotype_datestamp = $row["priority_timestamp"];
                                               
                           ?>      
                               <tr class="gradeX">
                                   <td style="display: none"><?php echo $ID; ?></td>
                                   <td width=""><?php echo $priotype_name ?></td>
                                   <td width=""><?php echo $priotype_dc ?></td>
                                   <td width=""><?php echo $priotype_datestamp; ?></td>
                                   <td width="20%">
                                     <center>
                                       <a data-toggle="modal" href="#edit<?php echo $ID?>" class="btn btn-round btn-warning">
                                         <i class="fa fa-edit"></i>&nbsp;
                                         Edit
                                       </a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a data-toggle="modal" href="#archive<?php echo $ID?>" class="btn btn-round btn-danger">
                                         <i class="fa fa-archive"></i>&nbsp;
                                         Archive
                                       </a>
                                     </center>
                                   </td>
                               </tr>  
                           <?php } ?>
                           </tbody>
                         </table>
                       </div>
                       <!--adv-table end-->
                       <?php include("get_view_modal_modify_priority_type.php");?>
                 </div>
               </div>
             </div>
             <!--END TABLE-->
          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->
   </body>
</html>




       
              
              

              
              
            