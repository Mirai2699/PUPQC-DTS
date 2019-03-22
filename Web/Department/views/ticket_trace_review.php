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
                  <!--INCLUDE FILE VIEW DETAILS-->
                  <?php include("get_view_details_docu_ticket.php");?>
                  <!--INCLUDE FILE VIEW DETAILS-->
                  <div class="col-md-12">
                    <div class="panel-heading" style="background-color: #212121; ">
                        <h4 style="color: white; font-size: 25px"><i class="fa fa-ticket"></i>   Details of Ticket No:<?php echo $docu_tr_ticket_no; ?></h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                    </div>

                    

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
                          
                          <div class="col-md-12" style="margin-bottom: 10px; margin-right: 2%; ">
                               <div class="row" id="SPACER" style="margin-top: 10px; "></div>


                               <div class="col-md-4" style="color: black; font-size:17px">
                                  <table>
                                    <tbody>
                                       <tr style="margin: 70px">
                                         <td style="width: 220px"><b>Ticket Status:</b></td>
                                         <td style="width: 370px"><?php echo $docu_tr_status; ?></td>
                                       </tr>
                                       <tr style="margin: 70px">
                                         <td style="width: 220px"><b>Category:</b></td>
                                         <td style="width: 370px"><?php echo $docutype_desc ?></td>
                                       </tr>
                                       <tr style="margin: 70px">
                                         <td style="width: 220px"><b>Beginning <br> Department:</b></td>
                                         <td style="width: 370px"><?php echo $created_office_name;?></td>
                                       </tr>
                                       <tr style="margin: 70px">
                                         <td style="width: 220px"><b>Create Date:</b></td>
                                         <td style="width: 370px"><?php echo $DTcreate; ?></td>
                                       </tr>
                                       <tr style="margin: 70px">
                                         <td style="width: 220px"><b>Curently at:</b></td>
                                         <td style="width: 370px"><?php echo $receive_office_name; ?></td>
                                       </tr>
                                       <tr style="margin: 70px">
                                         <td style="width: 220px"><b>Last Activity:</b></td>
                                         <td style="width: 370px"><?php echo $new_LT_format; ?></td>
                                       </tr>
                                       <tr style="margin: 70px">
                                         <td style="width: 220px"><b>Signatory:</b></td>
                                         <td style="width: 370px"><?php echo $docu_tr_asignatory;?></td>
                                       </tr>
                                       <tr style="margin: 70px">
                                         <td style="width: 220px"><b>Ticket Status:</b></td>
                                         <td style="width: 370px"><?php echo $priority_desc.' ('.$priority_days_count.') Days.';?></td>
                                       </tr>
                                    </tbody>
                                  </table>
                               </div>

                               <div class="col-md-5" style="color: black; font-size:17px">
                                  <table>
                                    <tbody>
                                       <tr>
                                         <td style="width: 100px"><b>Name:</b></td>
                                         <td style="width: 370px"><?php echo $creator_compname; ?></td>
                                       </tr>
                                       <tr>
                                         <td style="width: 100px"><b>Email:</b></td>
                                         <td style="width: 370px"><?php echo $acc_email; ?></td>
                                       </tr>
                                    </tbody>
                                  </table>
                               </div>

                               

                                <div class="col-md-3" style="margin-bottom: 10px; ">
                                     <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                                     <div class="col-md-12" style="margin-bottom: 10px; text-align:left">
                                     <label><b>Other Actions:</b></label>
                                      <div class="row" id="SPACER" style="margin-top: 1px; "></div>
                                      <a href="ticket_review.php?getID=<?php echo $docu_ticketno ?>" class="btn btn-success" style="margin-top: 5px">
                                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;    Transfer Ticket</a>
                                      &nbsp;&nbsp;
                                      <a href="view_trace.php" class="btn btn-default" style="background-color: gray; color: white; margin-top: 5px">
                                        <i class="fa fa-reply"></i>  Go Back</a>
                               </div>
                               
                          </div>
                          <div class="col-md-12">
                            <p style="font-size: 30px; color: black; margin-top: 20px; font-weight: bold">Subject: <?php echo $docu_tr_subject?></p>
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

                    <div class="panel-heading" style="background-color: #002846; ">
                        <h4 style="color: white; font-size: 25px"><i class="fa fa-exchange"></i> Traces of Document Ticket No: <?php echo $docu_ticketno?> </h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                    </div>
                    <table class="table table-striped mbn" style="font-size: 18px">
                       <thead>
                       <tr>
                           <th style="border:1px solid; text-align: center">Description</th>
                           <th style="border:1px solid; text-align: center">Staff / Designee</th>
                           <th style="border:1px solid; text-align: center">Date and Timestamp</th>
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
