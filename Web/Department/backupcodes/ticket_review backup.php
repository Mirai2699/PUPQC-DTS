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
                  <div class="col-md-4">
                      <h2 style="margin-top: 15px">Document Tracking Details</h2>
                      <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 50px; width: 100%"></div> 
                  </div>
                  <div class="col-md-8" style="font-size: 35px">
                      <a href="index.php" class="btn btn-default" style="margin-top: 1px">Dashboard</a> 
                      <i class="fa fa-angle-double-right"></i>
                      <a href="add_ticket.php" class="btn btn-default" style="margin-top: 1px">Add Document Ticket</a> 
                      <i class="fa fa-angle-double-right"></i>
                      <a href="ticket_review.php?getID=<?php echo $docu_ticketno; ?>" class="btn btn-primary" style="margin-top: 1px">Review Document Ticket</a> 
                      <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 30px"></div> 
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
                      <input type="hidden" name="docu_docutypeID" value="<?php echo $docu_tr_typeID  ?>">
                      <input type="hidden" name="docu_sourcetypeID" value="<?php echo $source_ID ?>">
                      <input type="hidden" name="docu_priotypeID" value="<?php echo $priority_ID ?>">
                      <input type="hidden" name="docu_tr_date_create" value="<?php echo $date_notnew?>">
                      <input type="hidden" name="docu_sender_office_ID" value="<?php echo $sender_office_ID?>">
                      <!--END HIDDEN ATTRIBUTES-->

                      <!--FIRST CONTAINER-->
                      <div class="col-md-12" style="background-color: #e6e6e6; border: 1px solid">
                          <div class="col-md-12" style="margin: 10px">
                              <h2><i class="fa fa-ticket"></i>   Ticket Details</h2>
                              <div class="panel" style="padding:3px; background-color:#6e6e6e;"></div>
                          </div>
                          <div class="col-md-3" style="margin-bottom: 10px; margin-right: 10%; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Status:</b></label>
                                  <input type="text" class="form-control" name="docu_status" value="<?php echo $docu_tr_status;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Priority:</b></label>
                                  <input type="text" class="form-control" name="docu_prio" value="<?php echo $priority_desc;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Office From:</b></label>
                                  <input type="text" class="form-control" name="docu_off_fr" value="<?php echo $sender_office_name;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Date and Time Created:</b></label>
                                  <input type="text" class="form-control" name="docu_date_created" value="<?php echo $date_create;?>" readonly/>
                               </div>
                          </div>
                          <div class="col-md-3" style="margin-bottom: 10px; margin-right: 10%; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Source:</b></label>
                                  <input type="text" class="form-control" name="docu_source" value="<?php echo $source_desc;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Document Type:</b></label>
                                  <input type="text" class="form-control" name="docu_docutype" value="<?php echo $docutype_desc;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Sender:</b></label>
                                  <input type="text" class="form-control" name="docu_sender" value="<?php echo $sender_disp;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Date and Time Sent:</b></label>
                                  <input type="text" class="form-control" name="docu_date_sent" value="<?php echo $DTsent;?>" readonly/>
                               </div>
                          </div>
                          <div class="col-md-3" style="margin-bottom: 10px; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Transferred / Assigned to:</b></label>
                                  <input type="text" class="form-control" name="docu_off_rec" value="<?php echo $receive_office_name; ?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Signatory:</b></label>
                                  <input type="text" class="form-control" name="docu_signatory" value="<?php echo $docu_tr_asignatory;?>" readonly/>
                               </div>
                               <div class="col-md-12" style="margin-bottom: 10px">
                                  <label><b>Last Remarks of Sender:</b></label>
                                  <input type="text" class="form-control" name="docu_last_rem" value="<?php echo $docu_tr_remarks;?>" readonly/>
                               </div>
                          </div>
                      </div>
                      <!--FIRST CONTAINER-->

                      <!--SECOND CONTAINER-->
                      <div class="col-md-12" style="border: 1px solid; margin-bottom: 10px; margin-top: 10px">
                        <div class="col-md-12" style="margin: 10px">
                            <div class="panel" style="padding:4px; background-color:#262626;"></div>
                            <h2><i class="fa fa-share"></i>   Transfer Document</h2>
                            <div class="panel" style="padding:3px; background-color:#6e6e6e;"></div>
                        </div>
                        <div class="col-md-4">
                          <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                          <div class="col-md-12" style="margin-bottom: 10px">
                             <label><b>Subject:</b></label>
                             <input type="text" class="form-control" name="docu_subject" value="<?php echo $docu_tr_subject; ?>" readonly/>
                          </div>
                          <div class="col-md-12" style="margin-bottom: 10px">
                             <label><b>Description:</b></label>
                             <input type="text" class="form-control" name="docu_desc" value="<?php echo $docu_tr_desc;?>" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                          <!--TESTING AREA-->

                           <?php 
                            $categoryName = '';
                           ?>
                          <script type="text/javascript">
                              function getCategory(val) {
                                  console.log ("<?php echo $categoryName='"+ val + "';?>"); 
                                  // alert(pass);
                                  console.log("<?php echo $categoryName ?>");

                                  document.getElementById('itemdiv').style.display = 'block'; 
                                          $.ajax({

                                              url: 'retrieve_employee.php'
                                              ,data:{
                                                  category: val
                                              }
                                              ,type:'GET'
                                              ,dataType: 'json'
                                              ,success:function(data){ 
                                                   document.getElementById('ddItem').innerHTML = data.option;

                                              },error: function(){

                                              }
                                          });
                                 
                              }
                          </script>   
                          <div class="col-md-12" style="margin-bottom: 10px">
                              <label><b>Transfer to Office:</b></label>
                              <select id="ddCategory" name="docu_new_office_to" class="form-control" style="color: black;" required="" onchange="getCategory(this.value)" >
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
                          <div id="itemdiv" class="col-md-12" style="margin-bottom: 10px">
                              <label id="itemLabel"><b>To be Received By:</b></label>
                              <select id="ddItem" name="docu_new_rec" class="form-control" style="color: black;" required="">
                                  <option selected disabled value=""> </option>
                              </select>   
                          </div>

                          <!--TESTING AREA-->


                        </div>
                        <div class="col-md-4">
                          <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                          <div class="col-md-12" style="margin-bottom: 35px">
                             <label><b>Add/Change Remarks:</b></label>
                             <input type="text" class="form-control" name="docu_new_remarks"/>
                          </div>
                          <div class="col-md-12" style="margin-bottom: 10px; text-align: right">
                             <button type="submit" class="btn btn-success" name="transfer_docu"><i class="fa fa-share"></i>  Transfer Document</button>
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <a data-toggle="modal" href="#closing<?php echo $docu_tr_ID?>" class="btn btn-danger"><i class="fa fa-times"></i>  Close Ticket</a>
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <a href="view_pending.php" class="btn btn-default"><i class="fa fa-reply"></i>  Go Back</a>
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
              
              <!--MODAL INCLUDES-->
              <?php include("get_view_modal_ticket_closing.php");?>
              <!--END MODAL INCLUDES-->
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
