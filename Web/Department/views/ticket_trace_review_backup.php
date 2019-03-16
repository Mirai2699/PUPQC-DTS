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

              <!--FIRST CONTAINER-->
              <div class="col-md-12"> 
                <div class="box-info">

                  <div class="col-md-12">
                    <div class="panel-heading" style="background-color: #212121; ">
                        <h4 style="color: white; font-size: 25px"><i class="fa fa-ticket"></i>   Ticket Details</h4>
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
                      <div class="col-md-12" style="background-color: #e6e6e6; border: 1px solid">
                          
                          <div class="col-md-4" style="margin-bottom: 10px; margin-right: 2%; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Status:</b></label>
                                  <input type="text" class="form-control" name="docu_status" value="<?php echo $docu_tr_status;?>" readonly/>
                               </div>
                               <div class="col-md-6" style="margin-bottom: 10px">
                                  <label><b>Source:</b></label>
                                  <select name="docu_sourcetypeID" class="form-control" style="color: black;" readonly>
                                     <option value="<?php echo $source_ID;?>" selected><?php echo $source_desc;?></option>
                                     <?php  
                                         $sqlemp = "SELECT * FROM `r_source_type`";
                                         $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                           while($row = mysqli_fetch_assoc($results))
                                           {
                                             $select_source_ID = $row['source_ID'];
                                             $select_source_desc = $row['source_desc'];
                                     ?>
                                     <option value="<?php echo $select_source_ID ?>" disabled><?php echo $select_source_desc; ?></option>
                                     <?php } ?>
                                  </select>
                               </div>
                               <div class="col-md-6" style="margin-bottom: 10px">
                                  <label><b>Priority:</b></label>
                                  <select  name="docu_priotypeID" class="form-control" style="color: black;" readonly>
                                    <option value="<?php echo $priority_ID?>" selected><?php echo $priority_desc;?></option>
                                    <?php  
                                        $pt_sqlemp = "SELECT * FROM `r_priority_type`";
                                        $pt_results = mysqli_query($connection, $pt_sqlemp) or die("Bad Query: $sql");
                                          while($pt_row = mysqli_fetch_assoc($pt_results))
                                          {
                                            $select_priority_ID = $pt_row['priority_ID'];
                                            $select_priority_desc = $pt_row['priority_desc'];
                                    ?>
                                    <option value="<?php echo $select_priority_ID ?>" disabled><?php echo $select_priority_desc; ?></option>
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
                          </div>
                          <div class="col-md-4" style="margin-bottom: 10px; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                               
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Document Type:</b></label>
                                  <select  name="docu_docutypeID" class="form-control" style="color: black;" readonly>
                                     <option value="<?php echo $docu_tr_typeID;?>" selected><?php echo $docutype_desc;?></option>
                                     <?php  
                                         $dt_sqlemp = "SELECT * FROM `r_document_type`";
                                         $dt_results = mysqli_query($connection, $dt_sqlemp) or die("Bad Query: $sql");
                                           while($dt_row = mysqli_fetch_assoc($dt_results))
                                           {
                                             $slect_docutype_ID = $dt_row['docutype_ID'];
                                             $slect_docutype_desc = $dt_row['docutype_desc'];
                                     ?>
                                     <option value="<?php echo $slect_docutype_ID ?>" disabled><?php echo $slect_docutype_desc; ?></option>
                                     <?php } ?>
                                  </select>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Subject:</b></label>
                                  <input type="text" class="form-control" name="docu_subject" value="<?php echo $docu_tr_subject; ?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Description:</b></label>
                                  <input type="text" class="form-control" name="docu_desc" value="<?php echo $docu_tr_desc;?>" readonly/>
                               </div> 
                              <div class="col-md-12" style="margin-bottom: 10px">
                                 <label><b>Transferred / Assigned to:</b></label>
                                 <input type="text" class="form-control" name="docu_off_rec" value="<?php echo $receive_office_name; ?>" readonly/>
                              </div>
                              <div class="col-md-12" style="margin-bottom: 10px">
                                 <label><b>Signatory:</b></label>
                                 <input type="text" class="form-control" name="docu_signatory" value="<?php echo $docu_tr_asignatory;?>" readonly/>
                              </div>
                          </div>

                          <div class="col-md-3" style="margin-bottom: 10px; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                               <div class="col-md-12" style="margin-bottom: 10px; text-align:left">
                                 <label><b>Other Actions:</b></label>
                                  <div class="row" id="SPACER" style="margin-top: 1px; "></div>
                                  <a href="ticket_review.php?getID=<?php echo $docu_ticketno ?>" class="btn btn-primary" style="margin-top: 5px">
                                    <i class="fa fa-list-ul"></i>&nbsp;&nbsp;    View More Details</a>
                                  &nbsp;&nbsp;
                                  <a href="view_trace.php" class="btn btn-default" style="background-color: gray; color: white; margin-top: 5px">
                                    <i class="fa fa-reply"></i>  Go Back</a>
                               </div>
                               
                          </div>
                      </div>
                      <!--FIRST CONTAINER-->

                      

                      <!--DIVIDER-->
                      <div class="col-md-12">
                        <div class="row" style="padding:1px; background-color:#262626; margin-bottom: 20px"></div>
                      </div>
                      <!--DIVIDER-->

                  </div>
                </div>
              </div>

              <!--FIRST CONTAINER-->


              <!--SECOND CONTAINER-->
              
              <div class="col-md-12">
                <div class="box-info">

                  <div class="col-md-12">
                    <div class="panel-heading" style="background-color: #002846; ">
                        <h4 style="color: white; font-size: 25px">Traces of Document Ticket No: <?php echo $docu_ticketno?> </h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                    </div>
                    <table class="table table-striped mbn" style="font-size: 18px">
                       <thead>
                       <tr>
                           <th>Date stamp</th>
                           <th>Time stamp</th>
                           <th>Action Taken</th>
                           <th>Last Remarks</th>
                       </tr>
                       </thead>
                       <tbody>
                        <!--INCLUDE FILE VIEW DETAILS-->
                        <?php include("get_view_table_tracing_details.php");?>
                        <!--INCLUDE FILE VIEW DETAILS-->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--SECOND CONTAINER-->
            
              
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
