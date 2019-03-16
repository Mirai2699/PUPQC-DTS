<?php
    
    include("../utilities/Header.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Tables.php");

    if (isset($_GET['getID'])) 
    {
        $docu_ID = $_GET['getID'];
    }


?>
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                <div class="col-md-12">
                  <h2 style="margin-top: 15px">Document Tracking Details</h2>
                  <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 20px;"></div> 
                </div>
             </div>
            <!--END BREADCRUMBS-->


            <!--START INNER CONTENT-->
            <!--BACKEND-->
            <?php 

                $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
                                                               INNER JOIN `t_accounts` AS ACC
                                                               INNER JOIN  `t_employees` AS EMP
                                                               INNER JOIN `r_office` AS OFF
                                                               INNER JOIN `r_document_type` AS TYPE
                                                               ON DOCU.docu_tr_recipient = ACC.acc_empID
                                                               and ACC.acc_empID = EMP.emp_ID
                                                               and OFF.office_ID = EMP.emp_office
                                                               and TYPE.docutype_ID = DOCU.docu_tr_type
                                                               WHERE DOCU.docu_tr_ID = '$docu_ID'");
                while($row = mysqli_fetch_assoc($view_query))
                {
                    $docu_tr_ID = $row["docu_tr_ID"];
                    $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
                    $docu_tr_subject = $row["docu_tr_subject"];
                    $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
                    $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
                    $docu_tr_recipient = $row["docu_tr_recipient"];
                    $docu_tr_desc = $row["docu_tr_desc"];
                    $docu_tr_remarks = $row["docu_tr_remarks"];
                    $docu_tr_sender = $row["docu_tr_sender"];
                    $docu_tr_recipient = $row["docu_tr_recipient"];


                    $docu_tr_type = $row['docu_tr_type'];
                    $docutype_desc = $row['docutype_desc'];

                    $rec_fname = $row["emp_firstname"];
                    $rec_lname = $row["emp_lastname"];
                    $rec_compname = $rec_fname.' '.$rec_lname;
                
                    $office_name = $row["office_name"];

                    $docu_tr_sender = $row["docu_tr_sender"];
                    $docu_tr_recipient = $row["docu_tr_recipient"];

                    $date_create = $docu_tr_date_create->format('F d, Y');
                    $date_sent = $docu_tr_date_sent->format('F d, Y');

                }



            ?>
            <!--BACKEND-->

            <!--START BODY CONTENT-->

            
            <div class="row" style="background-color: white">
              <!--LEFT SIDE-->
              <div class="col-md-6">
                <div class="box-info">
                  <div class="col-md-12">
                  <!--box-info start-->
                    <div class="box-info">
                      <div class="panel-heading" style="background-color: #666666; ">
                        <h4 style="color: white; font-size: 20px">Document Tracking Details</h4>
                        <h4 style="color: white; font-size: 15px">Ticket No: <?php echo $docu_tr_ticket_no?></h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                      </div>
                      <br>
                      <!--adv-table start-->
                      <div class="adv-table">
                      <!--START TABLE-->
                      <?php include("get_view_table_tracking_pending_details.php");?>
                      <!--END TABLE-->
                      </div>
                      <!--adv-table end-->
                    </div>
                    <!--box-info end-->
                  </div>
                </div>
              </div>
              <!--LEFT SIDE-->

              <!--RIGHT SIDE-->
                <div class="col-md-6">
                  <div class="box-info">
                    <div class="col-md-12">
                    <!--box-info start-->
                      <div class="box-info">
                        <div class="panel-heading" style="background-color: #004466; ">
                          <h4 style="color: white; font-size: 20px">Review Details</h4>
                          <h4 style="color: white; font-size: 15px">Ticket No: <?php echo $docu_tr_ticket_no?></h4>
                          <div class="row" style="padding:1px; background-color:white;"></div>
                        </div>
                        <br>
                        <!--adv-table start-->
                               <form action="../functionalities/document_tracking.php" method="POST">
                                 <!--ACCOUNT ID-->
                                 <input type="hidden" name="docu_accID" value="<?php echo $userID?>">

                                 <!--1st level-->
                                 <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                                    <div class="col-md-6">
                                       <?php include("../functionalities/ticket_num_generator.php"); ?>
                                       <label><b>Document Ticket Tracking Number:</b></label>
                                       <input type="text" name="docu_ticket_no" class="form-control" readonly="" value="<?php echo $docu_tr_ticket_no?>">
                                    </div>
                                    <div class="col-md-6">
                                       <label><b>Document Type:</b></label>
                                       <select name="docu_type" class="form-control" style="color: black;" readonly>
                                          <option value="<?php echo $docu_tr_type;?>" selected><?php echo $docutype_desc;?></option>
                                       </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                                       <label><b>From: (Latest Sender)</b></label>
                                       <select name="docu_recipient" class="form-control"  required readonly >
                                          <?php 

                                              $view_query = mysqli_query($connection,"SELECT * FROM `t_employees` AS EMP
                                                                                           INNER JOIN `t_accounts` AS ACC
                                                                                           ON EMP.emp_ID = ACC.acc_empID         
                                                                                      WHERE ACC.acc_empID = '$docu_tr_sender' ");
                                              while($row = mysqli_fetch_assoc($view_query))
                                              {
                                                  
                                                  $send_fname = $row["emp_firstname"];
                                                  $send_lname = $row["emp_lastname"];
                                                  $send_compname = $send_fname.' '.$send_lname;

                                              }
                                          ?>
                                          <option value="" selected disabled><?php echo $send_compname ?></option>
                                       </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                                       <label><b>From Office:</b></label>
                                       <input type="text" name="docu_subject" class="form-control" required value="<?php echo $office_name; ?>" readonly>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                                      <label><b>Subject:</b></label>
                                      <input type="text" name="docu_subject" class="form-control" required value="<?php echo $docu_tr_subject?>" readonly>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                                      <label><b>Description:</b></label>
                                       <input type="text" name="docu_desc" class="form-control" required value="<?php echo $docu_tr_desc?>" readonly>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                                      <div class="row" style="padding:1px; background-color: #262626; margin: 1px"></div>
                                      <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                                    </div>
                                    <h3 style="margin-left:14px">Give Action:</h3>
                                    <div class="col-md-5">
                                      <label><b>Action Taken:</b></label>
                                      <select name="docu_action" class="form-control" style="color: black;" required>
                                         <option value="" selected disabled>-- Select Action --</option>
                                         <option value="Reviewed">Reviewed</option>
                                         <option value="Finished">Mark as Finished</option>
                                      </select>
                                    </div>
                                    <div class="col-md-7">
                                      <label><b>Forward it to: (Recipient)</b></label>
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
                                      <label><b>Change Remarks:</b></label>
                                      <input type="text" name="docu_subject" class="form-control" required value="<?php echo $docu_tr_remarks?>">
                                    </div>
                                    <!--BUTTON DIVISION-->

                                    <div class="col-md-12" style="margin-bottom: 10px; text-align: right">
                                         <div id="SPACER" class="row" style="padding:1px;margin: 5px"></div>
                                         <div class="row" style="padding:1px; background-color: #262626; margin: 1px"></div>
                                         <div id="SPACER" class="row" style="padding:1px;margin: 5px"></div>
                                         <button class="btn btn-success" type="submit" name="review_docu_ticket">
                                         <i class="fa  fa-check"></i>  Finish Review</button>
                                    </div>
                                 </div>
                           </div>
                         </div>

                        </form>  
                        <!--adv-table end-->
                      </div>
                      <!--box-info end-->
                    </div>
                  </div>
                </div>
              <!--RIGHT SIDE-->
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

                                                
