<?php
    
    include("../utilities/Header.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Tables.php");

    if (isset($_GET['getID'])) 
    {
        $docu_ticketno = $_GET['getID'];
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
            <?php include("../functionalities/ticket_num_generator.php");?>
            <!--START BODY CONTENT-->
            <div class="row" style="background-color: white">
              <div class="col-md-12">
                <div class="box-info">

                  <div class="col-md-12">
                    <div class="panel-heading" style="background-color: #002846; ">
                        <h4 style="color: white; font-size: 25px">Document Ticket No: <?php echo $docu_ticketno?> </h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                    </div>

                    <!--INCLUDE FILE VIEW DETAILS-->
                    <?php include("get_view_details_docu_ticket.php");?>
                    <!--INCLUDE FILE VIEW DETAILS-->

                    <form action="../functionalities/document_tracking.php" method="POST">
                      <!--START HIDDEN ATTRIBUTES-->
                      <input type="hidden" name="accID" value="<?php echo $userID?>">
                      <input type="hidden" name="docu_ID" value="<?php echo $docu_tr_ID?>">
                      <input type="hidden" name="docu_ticketno" value="<?php echo $docu_tr_ticket_no?>">
                      <input type="hidden" name="docu_tr_date_create" value="<?php echo $date_notnew?>">
                      <input type="hidden" name="docu_tr_time_create" value="<?php echo $time_notnew?>">
                      <input type="hidden" name="docu_creator_office_ID" value="<?php echo $creator_office_ID ?>">
                      <input type="hidden" name="docu_creator_ID" value="<?php echo $creator_ID ?>">
                      <!--END HIDDEN ATTRIBUTES-->

                      <!--FIRST CONTAINER-->
                      <!--Start of 1st Division-->
                      <div class="col-md-12" style="background-color: #e6e6e6; border: 1px solid">
                          <div class="col-md-12" style="margin: 10px">
                              <h2><i class="fa fa-ticket"></i>   Ticket Details</h2>
                              <div class="panel" style="padding:3px; background-color:#6e6e6e;"></div>
                          </div>
                          <div class="col-md-4" style="margin-bottom: 10px; margin-right: 2%; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Status:</b></label>
                                  <input type="text" class="form-control" name="docu_status" value="<?php echo $docu_tr_status;?>" readonly/>
                               </div>
                               <div class="col-md-6" style="margin-bottom: 10px">
                                  <label><b>Source:</b></label>
                                  <select name="docu_sourcetypeID" class="form-control" style="color: black;" readonly>
                                     <option value="<?php echo $source_ID;?>" selected readonly><?php echo $source_desc;?> -- Selected</option>
                                     <?php  
                                         $sqlemp = "SELECT * FROM `r_source_type`";
                                         $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                           while($row = mysqli_fetch_assoc($results))
                                           {
                                             $select_source_ID = $row['source_ID'];
                                             $select_source_desc = $row['source_desc'];
                                     ?>
                                     <option value="<?php echo $select_source_ID ?>"><?php echo $select_source_desc; ?></option>
                                     <?php } ?>
                                  </select>
                               </div>
                               <div class="col-md-6" style="margin-bottom: 10px">
                                  <label><b>Priority:</b></label>
                                  <select  name="docu_priotypeID" class="form-control" style="color: black;">
                                    <option value="<?php echo $priority_ID?>" selected readonly><?php echo $priority_desc;?> -- Selected</option>
                                    <?php  
                                        $pt_sqlemp = "SELECT * FROM `r_priority_type`";
                                        $pt_results = mysqli_query($connection, $pt_sqlemp) or die("Bad Query: $sql");
                                          while($pt_row = mysqli_fetch_assoc($pt_results))
                                          {
                                            $select_priority_ID = $pt_row['priority_ID'];
                                            $select_priority_desc = $pt_row['priority_desc'];
                                    ?>
                                    <option value="<?php echo $select_priority_ID ?>"><?php echo $select_priority_desc; ?></option>
                                    <?php } ?>
                                  </select>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Office From:</b></label>
                                  <input type="text" class="form-control" name="docu_off_fr" value="<?php echo $created_office_name;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Created By:</b></label>
                                  <input type="text" class="form-control" name="docu_createdby"  value="<?php echo $creator_disp;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Date and Time Created:</b></label>
                                  <input type="text" class="form-control" name="docu_date_created" value="<?php echo $DTcreate;?>" readonly/>
                               </div>
                               <?php 
                                     $document_reopen = mysqli_query($connection,"SELECT docu_tr_date_done FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                        while($rowan = mysqli_fetch_array($document_reopen))
                                        {
                                           if(!empty($rowan['docu_tr_date_done']))
                                           {
                                              echo '
                                              <div class="col-md-12" style="margin-bottom: 10px">
                                                 <label><b>Last Closed By:</b></label>
                                                 <input type="text" class="form-control" name="docu_date_reopened" 
                                                 value="'.$closer_disp.'" readonly/>
                                              </div>
                                              <div class="col-md-12" style="margin-bottom: 10px">
                                                 <label><b>Date Last Closed:</b></label>
                                                 <input type="text" class="form-control" name="docu_date_reopened" 
                                                 value="'.$DTclosed.'" readonly/>
                                              </div>
                                              ';
                                           }
                                           else
                                           {
                                             //No display;
                                           }
                                        }
                               ?>
                          </div>
                          <!--End of 1st Division-->


                          <!--Start of 2nd Division-->
                          <div class="col-md-4" style="margin-bottom: 10px; margin-right: 2%; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                               
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Document Type:</b></label>
                                  <select  name="docu_docutypeID" class="form-control" style="color: black;">
                                     <option value="<?php echo $docu_tr_typeID;?>" selected readonly><?php echo $docutype_desc;?> -- Selected</option>
                                     <?php  
                                         $dt_sqlemp = "SELECT * FROM `r_document_type`";
                                         $dt_results = mysqli_query($connection, $dt_sqlemp) or die("Bad Query: $sql");
                                           while($dt_row = mysqli_fetch_assoc($dt_results))
                                           {
                                             $slect_docutype_ID = $dt_row['docutype_ID'];
                                             $slect_docutype_desc = $dt_row['docutype_desc'];
                                     ?>
                                     <option value="<?php echo $slect_docutype_ID ?>"><?php echo $slect_docutype_desc; ?></option>
                                     <?php } ?>
                                  </select>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Subject:</b></label>
                                  <input type="text" class="form-control" name="docu_subject" value="<?php echo $docu_tr_subject; ?>" />
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Description:</b></label>
                                  <input type="text" class="form-control" name="docu_desc" value="<?php echo $docu_tr_desc;?>" />
                               </div> 
                              <div class="col-md-12" style="margin-bottom: 10px">
                                 <label><b>Transferred / Assigned to:</b></label>
                                 <input type="text" class="form-control" name="docu_off_rec" value="<?php echo $receive_office_name; ?>" readonly/>
                              </div>
                              <div class="col-md-12" style="margin-bottom: 10px">
                                 <label><b>Signatory:</b></label>
                                 <input type="text" class="form-control" name="docu_signatory" value="<?php echo $docu_tr_asignatory;?>" />
                              </div>
                              <?php 
                                    $document_reopen = mysqli_query($connection,"SELECT docu_tr_date_reopened FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                       while($rowan = mysqli_fetch_array($document_reopen))
                                       {
                                          if(!empty($rowan['docu_tr_date_reopened']))
                                          {
                                             echo '
                                             <div class="col-md-12" style="margin-bottom: 10px">
                                                <label><b>Last Re-Opened By:</b></label>
                                                <input type="text" class="form-control" name="docu_reopenedby" 
                                                value="'.$reopen_disp.'" readonly/>
                                             </div>
                                             <div class="col-md-12" style="margin-bottom: 10px">
                                                <label><b>Date Last Re-Opened:</b></label>
                                                <input type="text" class="form-control" name="docu_date_reopened" 
                                                value="'.$DTreopen.'" readonly/>
                                             </div>
                                             ';
                                          }
                                          else
                                          {
                                            //No display;
                                          }
                                       }
                              ?>
                          </div>
                          <!--End 2nd Division-->


                          <!--Start 3rd Division-->
                          <div class="col-md-3" style="margin-bottom: 10px; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>

                               <!--sender-->
                               <?php 
                                     $document_sent = mysqli_query($connection,"SELECT docu_tr_date_sent FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                        while($rowsent = mysqli_fetch_array($document_sent))
                                        {
                                           if(!empty($rowsent['docu_tr_date_sent']))
                                           {
                                              echo '
                                              <div class="col-md-12" style="margin-bottom: 10px">
                                                 <label><b>Last Sent By:</b></label>
                                                 <input type="text" class="form-control" name="docu_sender" 
                                                 value="'.$sender_disp.'" readonly/>
                                              </div>
                                              <div class="col-md-12" style="margin-bottom: 10px">
                                                 <label><b>Date Last Sent:</b></label>
                                                 <input type="text" class="form-control" name="docu_date_sent" 
                                                 value="'.$DTsent.'" readonly/>
                                              </div>
                                              <div class="col-md-12" style="margin-bottom: 10px">
                                                 <label><b>Last Remarks of Sender:</b></label>
                                                 <input type="text" class="form-control" name="docu_last_rem" 
                                                 value="'.$docu_tr_remarks.'" readonly/>
                                              </div>
                                              ';
                                           }
                                           else
                                           {
                                             //No display;
                                           }
                                        }
                               ?>
                               <!--sender-->
                               <!--receiver-->
                               <?php 
                                     $document_received = mysqli_query($connection,"SELECT docu_tr_date_received FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                        while($rowen = mysqli_fetch_array($document_received))
                                        {
                                           if(!empty($rowen['docu_tr_date_received']))
                                           {
                                              echo '
                                              <div class="col-md-12" style="margin-bottom: 10px">
                                                 <label><b>Last Received By:</b></label>
                                                 <input type="text" class="form-control" name="docu_receiver" 
                                                 value="'.$receive_disp.'" readonly/>
                                              </div>
                                              <div class="col-md-12" style="margin-bottom: 10px">
                                                 <label><b>Date Received:</b></label>
                                                 <input type="text" class="form-control" name="docu_date_received" 
                                                 value="'.$DTreceived.'" readonly/>
                                              </div>
                                              ';
                                           }
                                           else
                                           {
                                             //No display;
                                           }
                                        }
                               ?>
                               <!--receiver-->

                               <div class="col-md-12" style="margin-bottom: 10px; text-align:left">
                                 <label><b>Other Actions:</b></label>
                                  <div class="row" id="SPACER" style="margin-top: 1px; "></div>
                                  <?php 
                                        $document_stat = mysqli_query($connection,"SELECT docu_tr_status FROM `t_document_track` 
                                                                                WHERE docu_tr_ID = '$docu_tr_ID' ");
                                              $action = mysqli_fetch_array($document_stat);
                                              $last_stat = $action[0];

                                              if($last_stat == "OPEN")
                                              {
                                               echo'
                                                      <a data-toggle="modal" href="#closing'.$docu_tr_ID.'" class="btn btn-danger" style="margin-top: 5px">
                                                      <i class="fa fa-times"></i>  Close Ticket</a>&nbsp;&nbsp;
                                                   ';
                                              }
                                              else if($last_stat == "CLOSED")
                                              {
                                                echo'
                                                      <a data-toggle="modal" href="#savechanges'.$docu_tr_ID.'" class="btn btn-info" style="margin-top: 5px">
                                                        <i class="fa fa-save"></i> 
                                                        Save Changes
                                                      </a>&nbsp;&nbsp;
                                                      ';
                                              }
                                  ?>
                                  &nbsp;&nbsp;
                                  <a href="ticket_review.php?getID=<?php echo $docu_ticketno?>" class="btn btn-default" style="background-color: gray; color: white; margin-top: 5px">
                                    <i class="fa fa-times"></i>  Cancel</a>
                               </div>
                          </div>
                          <!--End of 3rd Division-->
                      </div>

                      <!--FIRST CONTAINER-->

                      <!--SECOND CONTAINER-->
                      <?php 
                            $document_stat = mysqli_query($connection,"SELECT docu_tr_status FROM `t_document_track` 
                                                                    WHERE docu_tr_ID = '$docu_tr_ID' ");
                                  $action = mysqli_fetch_array($document_stat);
                                  $last_stat = $action[0];

                                  if($last_stat == "OPEN")
                                  {
                                   echo'
                                          <div class="col-md-12" style="border: 1px solid; margin-bottom: 10px; margin-top: 10px">
                                       ';
                                  }
                                  else if($last_stat == "CLOSED")
                                  {
                                    echo'
                                          <div class="col-md-12" style="display:none; border: 1px solid; margin-bottom: 10px; margin-top: 10px">
                                          ';
                                  }
                      ?>

                        <div class="col-md-12" style="margin: 10px">
                            <div class="panel" style="padding:4px; background-color:#262626;"></div>
                            <h2><i class="fa fa-share"></i>   Transfer Document</h2>
                            <div class="panel" style="padding:3px; background-color:#6e6e6e;"></div>
                        </div>

                        <div class="col-md-4">
                          <div class="row" id="SPACER" style="margin-top: 2px; "></div>
                          <div class="col-md-12" style="margin-bottom: 10px">
                              <label style="font-size: 17px"><b>Transfer to Office:</b></label>
                              <select id="ddCategory" name="docu_new_office_to" class="form-control" style="color: black; font-size:16px" >
                                  <option selected disabled value=""></option>
                                    <?php  
                                        $sqlemp= "SELECT * FROM `r_office`";
                                        $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                        while($row = mysqli_fetch_assoc($results))
                                         {  
                                           $sel_office_ID = $row['office_ID'];
                                           $sel_office_name = $row['office_name'];
                                  ?>
                                  <option value="<?php echo $sel_office_ID ?>"><?php echo "$sel_office_name"; ?></option>
                                   <?php
                                      }
                                  ?>
                              </select>    
                          </div>  
                        </div>

                        <div class="col-md-4">
                          <div class="row" id="SPACER" style="margin-top: 2px; "></div>
                          <div class="col-md-12" style="margin-bottom: 35px">
                             <label style="font-size: 17px"><b>Add/Change Remarks:</b></label>
                             <input type="text" class="form-control" name="docu_new_remarks" style="color: black; font-size:16px"/>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                          <div class="col-md-12" style="margin-bottom: 10px; text-align: right">
                             <div class="row" id="SPACER" style="margin-top: 23px; font-size: 20px; "></div>
                             <button type="submit" class="btn btn-success" name="transfer_docu" style="font-size: 16px; background-color: green">
                              <i class="fa fa-share"></i>  Transfer Document</button>
                          </div>
                        </div>
                      </div>

                      
                      <!--SECOND CONTAINER-->

                      <!--DIVIDER-->
                      <div class="col-md-12">
                        <div class="row" style="padding:1px; background-color:#262626; margin-bottom: 20px"></div>
                      </div>
                      <!--DIVIDER-->

                  </div>
                </div>
              </div>
              
              <?php 
                  //include("get_view_modal_ticket_closing.php");
                  include("get_view_modal_save_reopening_changes.php");
              ?>
             </form>      
              <!--MODAL INCLUDES-->
              
              <!--END MODAL INCLUDES-->
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
