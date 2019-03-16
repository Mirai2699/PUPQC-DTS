<?php
    
    include("../utilities/Header.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Tables.php");

?>
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                  <div class="col-md-4">
                      <h2 style="margin-top: 15px">Document Ticketing</h2>
                      <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 50px; width: 100%"></div> 
                  </div>
                  <div class="col-md-8" style="font-size: 35px">
                      <a href="index.php" class="btn btn-default" style="margin-top: 1px">Dashboard</a> 
                      <i class="fa fa-angle-double-right"></i>
                      <a href="add_ticket.php" class="btn btn-primary" style="margin-top: 1px">Add Document Ticket</a> 
                      <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 30px"></div> 
                 </div>
             </div>
            <!--END BREADCRUMBS-->


            <!--START INNER CONTENT-->
            <!--START BODY CONTENT-->
            <div class="row" style="background-color: white">
              <div class="col-md-12">
                <div class="box-info">

                  <div class="col-md-12">
                    <div class="panel-heading" style="background-color: #002846; ">
                        <h4 style="color: white; font-size: 25px">Create Document Ticket</h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                    </div>
                    <form action="../functionalities/document_tracking.php" method="POST">
                      <!--ACCOUNT ID-->
                      <input type="hidden" name="docu_accID" value="<?php echo $userID?>">

                      <!--1st level-->
                      <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                      <div class="col-md-7" style="margin-bottom: 10px">
                        
                         <div class="col-md-6">
                            <?php include("../functionalities/ticket_num_generator.php");?>
                            <label><b>Document Ticket Tracking Number:</b></label>
                            <input type="text" name="docu_ticket_no" class="form-control" readonly="" value="<?php echo $ticketno?>">
                         </div>
                         <div class="col-md-6">
                            <label><b>Document Type:</b></label>
                            <select name="docu_type" class="form-control" style="color: black;">
                               <option value="" selected disabled>-- Select Document Type --</option>
                               <?php  
                                   $sqlemp = "SELECT * FROM `r_document_type`";
                                   $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                     while($row = mysqli_fetch_assoc($results))
                                     {
                                       $docutype_ID = $row['docutype_ID'];
                                       $docutype_desc = $row['docutype_desc'];
                               ?>
                               <option value="<?php echo $docutype_ID ?>"><?php echo $docutype_desc; ?></option>
                               <?php } ?>
                            </select>
                         </div>
                         <div class="col-md-12">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                            <label><b>Recipient:</b></label>
                            <select name="docu_recipient" class="form-control" style="color: black;" required>
                               <option value="" selected disabled>-- Select Recipient --</option>
                               <?php  
                                   $sqlemp = "SELECT * FROM `t_accounts` AS ACC 
                                                 INNER JOIN `t_employees` AS EMP
                                                 INNER JOIN `r_office` AS OFF
                                                 ON ACC.acc_empID = EMP.emp_ID
                                                 and EMP.emp_office = OFF.office_ID";
                                   $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                     while($row = mysqli_fetch_assoc($results))
                                     {
                                       $recipient_ID = $row['acc_ID'];
                                       $rec_lname = $row['emp_lastname'];
                                       $rec_fname = $row['emp_firstname'];
                                       $rec_office = $row['office_name'];

                                       $rec_compname = $rec_fname.' '.$rec_lname;
                                       $display = $rec_compname.', from '.$rec_office;
                               ?>
                               <option value="<?php echo $recipient_ID ?>"><?php echo $display; ?></option>
                               <?php } ?>
                            </select>
                         </div>
                         <div class="col-md-12">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                           <label><b>Subject:</b></label>
                           <input type="text" name="docu_subject" class="form-control" required placeholder="Re: Subject...">
                         </div>
                         <div class="col-md-12">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                           <label><b>Description:</b></label>
                           <div class="compose-editor"  style="border: 1px solid #6e6e6e">
                            <textarea id="compose-editor" rows="10" class="input-dark form-control" name="docu_desc" required></textarea>
                           </div>
                         </div>
                         <div class="col-md-12">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                           <label><b>Remarks:</b></label>
                           <input type="text" name="docu_remarks" class="form-control" placeholder="Remarks...">
                         </div>
                         <!--BUTTON DIVISION-->

                         <div class="col-md-12" style="margin-bottom: 10px; text-align: right">
                              <div id="SPACER" class="row" style="padding:1px;margin: 5px"></div>
                              <div class="row" style="padding:1px; background-color: #262626; margin: 1px"></div>
                              <div id="SPACER" class="row" style="padding:1px;margin: 5px"></div>
                              <button class="btn btn-success" type="submit" name="acc_docu_ticket">
                              <i class="fa  fa-tag"></i>  Create Ticket</button>
                         </div>
                      </div>
                      <div class="col-md-5">
                        <!--box-info start-->
                          <div class="box-info">
                            <div class="panel-heading" style="background-color: #6e6e6e; ">
                              <h5 style="color: white; font-size: 18px">Recent Created Tickets</h5>
                            </div>
                            <br>
                            <!--adv-table start-->
                            <div class="adv-table">
                             <table id="datatables" class="table table-striped table-no-border">
                                <thead>
                                <tr>
                                    <th style="display: none">DocTr No.</th>
                                    <th>Ticket No.</th>
                                    <th>Subject</th>
                                    <th>Date Created</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track`
                                                                                     WHERE docu_tr_sender = '$userID'
                                                                                     ORDER BY docu_tr_ticket_no DESC");
                                    while($row = mysqli_fetch_assoc($view_query))
                                    {
                                        $docu_tr_ID = $row["docu_tr_ID"];
                                        $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
                                        $docu_tr_subject = $row["docu_tr_subject"];
                                        $docu_tr_date_create = $row["docu_tr_date_create"];
                                        
                                                    
                                ?>      
                                    <tr class="gradeX">
                                        <td style="display: none"><?php echo $docu_tr_ID; ?></td>
                                        <td width=""><?php echo $docu_tr_ticket_no ?></td>
                                        <td width=""><?php echo $docu_tr_subject; ?></td>
                                        <td width=""><?php echo $docu_tr_date_create ?></td>
                                        <td width="">
                                          <center>
                                            <a href="" class="btn btn-info" title="View Details"><i class="fa fa-eye"></i></a>
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

             </form>      
              
            </div>
            <!--END BODY CONTENT-->
            <!--END INNER CONTENT-->


          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->
<!--ON PAGE SCRIPT-->
 <link type="text/css" rel="stylesheet" href="../../../resources-web/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 <script src="../../../resources-web/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 <script src="../../../resources-web/assets/js/email-compose.js"></script>
 <script src="../../../resources-web/assets/js/ui-panels.js"></script>

</body>
</html>
