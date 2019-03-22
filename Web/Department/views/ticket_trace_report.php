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
                  <h2 style="margin-top: 15px">Document Details and Trace Report</h2>
                  <div class="row" style="padding:1px; background-color: #666666; "></div> 
                </div>
             </div>
            <!--END BREADCRUMBS-->


            <!--START INNER CONTENT-->
            <?php include("../functionalities/ticket_num_generator.php");?>
            <!--START BODY CONTENT-->
            <section class="main-content">
                <div class="col-md-12" style="background-color: #262626; margin-bottom:10px; border: 2px solid #ffffff">
                  <div class="Panel" style="margin: 10px">
                    <label style="color: white; font-size: 18px">Action Available:</label>
                    <br>
                    <button class="btn btn-success" onclick="printDiv('printablearea')" name="Print" style="background-color: green">
                        <i class="fa fa-print"></i>   
                        Print Report
                    </button>
                  </div>
                </div>
                <div class="col-md-12" style="background-color: white">
                  <div class="col-md-12" style="margin-top: 10px; margin-bottom: 20px">
                    <!--FIRST CONTAINER-->
                    <div class="col-md-12">
                      <div class="box-info">
                        <div class="col-md-12">
                          <div class="panel-heading" style="background-color: #212121; ">
                              <h4 style="color: white; font-size: 25px"><i class="fa fa-ticket"></i>&nbsp;Details of Document Ticket No: <?php echo $docu_ticketno?> </h4>
                              <div class="row" style="padding:1px; background-color:white;"></div>
                          </div>

                          <!--INCLUDE FILE VIEW DETAILS-->
                          <?php include("get_view_details_docu_ticket.php");?>
                          <!--INCLUDE FILE VIEW DETAILS-->

                         

                            <!--FIRST CONTAINER-->
                            <div class="col-md-12" style="background-color: #ffffff; border: 1px solid">
                                
                                <div class="col-md-4" style="margin-bottom: 10px; ">
                                  <table class="table table-condensed mbn">
                                      <tbody>
                                          <tr>
                                              <td>
                                                  <h5 style="font-weight: bold">Status:</h5>
                                              </td>
                                              <td>
                                                  <h5><?php echo $docu_tr_status;?></h5>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <h5 style="font-weight: bold">Source:</h5>
                                              </td>
                                              <td>
                                                  <h5><?php echo $source_desc;?></h5>
                                              </td>
                                          </tr>
                                          <!--If there is an  external source -->
                                          <?php 
                                                $external_source = mysqli_query($connection,"SELECT docu_tr_ext_source_desc FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                                   while($row_ext = mysqli_fetch_array($external_source))
                                                   {
                                                      if(!empty($row_ext['docu_tr_ext_source_desc']))
                                                      {
                                                         echo '
                                                              
                                                               <tr>
                                                                   <td>
                                                                       <h5 style="font-weight: bold">External Office:</h5>
                                                                   </td>
                                                                   <td>
                                                                       <h5>'.$docu_ext_source.'</h5>
                                                                   </td>
                                                               </tr>
                                                        ';
                                                      }
                                                      else
                                                      {
                                                        //No display;
                                                      }
                                                   }
                                          ?>
                                          <!--If there is an  external source -->
                                          <tr>
                                              <td>
                                                  <h5 style="font-weight: bold">Priority:</h5>
                                              </td>
                                              <td>
                                                  <h5><?php echo $priority_desc;?></h5>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <h5 style="font-weight: bold">Office From:</h5>
                                              </td>
                                              <td>
                                                  <h5><?php echo $created_office_name;?></h5>
                                              </td>
                                          </tr> 
                                          <tr>
                                              <td>
                                                  <h5 style="font-weight: bold">Created By:</h5>
                                              </td>
                                              <td>
                                                  <h5><?php echo $creator_disp;?></h5>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <h5 style="font-weight: bold">Date and Time Created:</h5>
                                              </td>
                                              <td>
                                                  <h5><?php echo $DTcreate;?></h5>
                                              </td>
                                          </tr>
                                          <?php 
                                                $document_reopen = mysqli_query($connection,"SELECT docu_tr_date_done FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                                   while($rowan = mysqli_fetch_array($document_reopen))
                                                   {
                                                      if(!empty($rowan['docu_tr_date_done']))
                                                      {
                                                         echo '
                                                         <tr>
                                                             <td>
                                                                 <h5 style="font-weight: bold">Last Closed By:</h5>
                                                             </td>
                                                             <td>
                                                                 <h5>'.$closer_disp.'</h5>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td>
                                                                 <h5 style="font-weight: bold">Date Last Closed:</h5>
                                                             </td>
                                                             <td>
                                                                 <h5>'.$DTclosed.'</h5>
                                                             </td>
                                                         </tr>

                                                         ';
                                                      }
                                                      else
                                                      {
                                                        //No display;
                                                      }
                                                   }
                                          ?>
                                      </tbody>
                                  </table>
                                </div>

                                <div class="col-md-4" style="margin-bottom: 10px; ">
                                   <table class="table table-condensed mbn">
                                       <tbody>
                                           <tr>
                                               <td>
                                                   <h5 style="font-weight: bold">Document Type:</h5>
                                               </td>
                                               <td>
                                                   <h5><?php echo $docutype_desc;?></h5>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>
                                                   <h5 style="font-weight: bold">Subject:</h5>
                                               </td>
                                               <td>
                                                   <h5><?php echo $docu_tr_subject; ?></h5>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>
                                                   <h5 style="font-weight: bold">Description:</h5>
                                               </td>
                                               <td>
                                                   <h5><?php echo $docu_tr_desc;?></h5>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>
                                                   <h5 style="font-weight: bold">Transferred / Assigned to:</h5>
                                               </td>
                                               <td>
                                                   <h5><?php echo $receive_office_name; ?></h5>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>
                                                   <h5 style="font-weight: bold">Signatory:</h5>
                                               </td>
                                               <td>
                                                   <h5><?php echo $docu_tr_asignatory;?></h5>
                                               </td>
                                           </tr>
                                           <?php 
                                                 $document_reopen = mysqli_query($connection,"SELECT docu_tr_date_reopened FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                                    while($rowan = mysqli_fetch_array($document_reopen))
                                                    {
                                                       if(!empty($rowan['docu_tr_date_reopened']))
                                                       {
                                                          echo '

                                                          <tr>
                                                              <td>
                                                                  <h5 style="font-weight: bold">Last Re-Opened By:</h5>
                                                              </td>
                                                              <td>
                                                                  <h5>'.$reopen_disp.'</h5>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <h5 style="font-weight: bold">Date Last Re-Opened:</h5>
                                                              </td>
                                                              <td>
                                                                  <h5>'.$DTreopen.'</h5>
                                                              </td>
                                                          </tr>
                                                          ';
                                                       }
                                                       else
                                                       {
                                                         //No display;
                                                       }
                                                    }
                                           ?>
                                       </tbody>
                                   </table>
                                </div>

                                <div class="col-md-4" style="margin-bottom: 10px; ">
                                   <table class="table table-condensed mbn">
                                       <tbody>
                                         
                                           <!--sender-->
                                           <?php 
                                                 $document_sent = mysqli_query($connection,"SELECT docu_tr_date_sent FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                                    while($rowsent = mysqli_fetch_array($document_sent))
                                                    {
                                                       if(!empty($rowsent['docu_tr_date_sent']))
                                                       {
                                                          echo '

                                                          <tr>
                                                              <td>
                                                                  <h5 style="font-weight: bold">Last Sent By:</h5>
                                                              </td>
                                                              <td>
                                                                  <h5>'.$sender_disp.'</h5>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <h5 style="font-weight: bold">Date Last Sent:</h5>
                                                              </td>
                                                              <td>
                                                                  <h5>'.$DTsent.'</h5>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <h5 style="font-weight: bold">Last Remarks of Sender:</h5>
                                                              </td>
                                                              <td>
                                                                  <h5>'.$docu_tr_remarks.'</h5>
                                                              </td>
                                                          </tr>

                                                         
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

                                                          <tr>
                                                              <td>
                                                                  <h5 style="font-weight: bold">Last Received By:</h5>
                                                              </td>
                                                              <td>
                                                                  <h5>'.$receive_disp.'</h5>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <h5 style="font-weight: bold">Date Last Received:</h5>
                                                              </td>
                                                              <td>
                                                                  <h5>'.$DTreceived.'</h5>
                                                              </td>
                                                          </tr>

                                                          
                                                          ';
                                                       }
                                                       else
                                                       {
                                                         //No display;
                                                       }
                                                    }
                                           ?>
                                           <!--receiver-->
                                           <tr>
                                               <td>
                                                   <h5 style="font-weight: bold">Overdue Status:</h5>
                                               </td>
                                               <td>
                                                   <h5><?php echo $docu_tr_overdue_stat;?></h5>
                                               </td>
                                           </tr>
                                       </tbody>
                                   </table>
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
                              <h4 style="color: white; font-size: 25px"><i class="fa fa-exchange"></i>&nbsp; Traces of Document Ticket No: <?php echo $docu_ticketno?> </h4>
                              <div class="row" style="padding:1px; background-color:white;"></div>
                          </div>
                          <table class="table table-striped mbn" style="font-size: 12px">
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
                    </div>
                    <!--SECOND CONTAINER-->
                  </div>
                </div>
                <!--END BODY CONTENT-->
                <!--END INNER CONTENT-->
                <div style="display:none" id="printablearea">
                  <div class="">
                             <img  src="../../../resources-web/images/QCheader.png" style="height:40%; width:60%; "> 
                        </div>
                        <div style="margin-top: 5px; margin-left: 15px">
                            <div style="text-align: left; ">
                                <h5 style="font-size: 14px; text-align: right">Report No. DDT-<?php echo date('Ymd'); ?> </h5>
                                <h5 style="font-size: 14px">Date Generated: <br>
                                    <?php echo date('F d, Y'); ?>
                                </h5>
                                <center>
                                    <b style="font-size: 20px">Document Ticket Details and Trace Report</b><br>
                                </center>
                                <h5>Report Description:</h5> 
                                <p style="text-align: justify; font-size: 14px">   &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                                                    This report shows the details of the document ticket, and the traced tracks of the document processing.
                                </p>
                               
                            </div>
                            <h5>Table(s) Description:</h5> 
                                <p style="text-align: justify; font-size: 14px">   &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                                                    The first table below shows the details of the document ticket, and the second table shows the traced tracks of the document processing.
                                </p>
                                <hr>
                              <!--FIRST CONTAINER-->
                                  <div class="col-md-12">
                                        <h4 style="color: white; font-size: 20px; text-decoration: underline;">Details of Document Ticket No: <?php echo $docu_ticketno?> </h4>
                                        <div class="row" style="padding:1px; background-color:white;"></div>
                                    <!--INCLUDE FILE VIEW DETAILS-->
                                    <?php include("get_view_details_docu_ticket.php");?>
                                    <!--INCLUDE FILE VIEW DETAILS-->

                                   

                                      <!--FIRST CONTAINER-->
                                      <div class="col-md-12" style="background-color: #ffffff;">
                                          <div class="col-md-4" style="margin-bottom: 10px; ">
                                            <table class="table table-condensed mbn">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h5 style="font-weight: bold">Status:</h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $docu_tr_status;?></h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 style="font-weight: bold">Source:</h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $source_desc;?></h5>
                                                        </td>
                                                    </tr>
                                                    <!--If there is an  external source -->
                                                    <?php 
                                                          $external_source = mysqli_query($connection,"SELECT docu_tr_ext_source_desc FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                                             while($row_ext = mysqli_fetch_array($external_source))
                                                             {
                                                                if(!empty($row_ext['docu_tr_ext_source_desc']))
                                                                {
                                                                   echo '
                                                                        
                                                                         <tr>
                                                                             <td>
                                                                                 <h5 style="font-weight: bold">External Office:</h5>
                                                                             </td>
                                                                             <td>
                                                                                 <h5>'.$docu_ext_source.'</h5>
                                                                             </td>
                                                                         </tr>
                                                                  ';
                                                                }
                                                                else
                                                                {
                                                                  //No display;
                                                                }
                                                             }
                                                    ?>
                                                    <!--If there is an  external source -->
                                                    <tr>
                                                        <td>
                                                            <h5 style="font-weight: bold">Priority:</h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $priority_desc;?></h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 style="font-weight: bold">Office From:</h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $created_office_name;?></h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 style="font-weight: bold">Created By:</h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $creator_disp;?></h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 style="font-weight: bold">Date and Time Created:</h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $DTcreate;?></h5>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                          $document_reopen = mysqli_query($connection,"SELECT docu_tr_date_done FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                                             while($rowan = mysqli_fetch_array($document_reopen))
                                                             {
                                                                if(!empty($rowan['docu_tr_date_done']))
                                                                {
                                                                   echo '
                                                                   <tr>
                                                                       <td>
                                                                           <h5 style="font-weight: bold">Last Closed By:</h5>
                                                                       </td>
                                                                       <td>
                                                                           <h5>'.$closer_disp.'</h5>
                                                                       </td>
                                                                   </tr>
                                                                   <tr>
                                                                       <td>
                                                                           <h5 style="font-weight: bold">Date Last Closed:</h5>
                                                                       </td>
                                                                       <td>
                                                                           <h5>'.$DTclosed.'</h5>
                                                                       </td>
                                                                   </tr>

                                                                   ';
                                                                }
                                                                else
                                                                {
                                                                  //No display;
                                                                }
                                                             }
                                                    ?>
                                                     <tr>
                                                         <td>
                                                             <h5 style="font-weight: bold">Document Type:</h5>
                                                         </td>
                                                         <td>
                                                             <h5><?php echo $docutype_desc;?></h5>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>
                                                             <h5 style="font-weight: bold">Subject:</h5>
                                                         </td>
                                                         <td>
                                                             <h5><?php echo $docu_tr_subject; ?></h5>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>
                                                             <h5 style="font-weight: bold">Description:</h5>
                                                         </td>
                                                         <td>
                                                             <h5><?php echo $docu_tr_desc;?></h5>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>
                                                             <h5 style="font-weight: bold">Transferred / Assigned to:</h5>
                                                         </td>
                                                         <td>
                                                             <h5><?php echo $receive_office_name; ?></h5>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>
                                                             <h5 style="font-weight: bold">Signatory:</h5>
                                                         </td>
                                                         <td>
                                                             <h5><?php echo $docu_tr_asignatory;?></h5>
                                                         </td>
                                                     </tr>
                                                     <?php 
                                                           $document_reopen = mysqli_query($connection,"SELECT docu_tr_date_reopened FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                                              while($rowan = mysqli_fetch_array($document_reopen))
                                                              {
                                                                 if(!empty($rowan['docu_tr_date_reopened']))
                                                                 {
                                                                    echo '

                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="font-weight: bold">Last Re-Opened By:</h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5>'.$reopen_disp.'</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="font-weight: bold">Date Last Re-Opened:</h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5>'.$DTreopen.'</h5>
                                                                        </td>
                                                                    </tr>
                                                                    ';
                                                                 }
                                                                 else
                                                                 {
                                                                   //No display;
                                                                 }
                                                              }
                                                     ?>
                                                     <!--sender-->
                                                     <?php 
                                                           $document_sent = mysqli_query($connection,"SELECT docu_tr_date_sent FROM `t_document_track` WHERE docu_tr_ID = '$docu_tr_ID' ");
                                                              while($rowsent = mysqli_fetch_array($document_sent))
                                                              {
                                                                 if(!empty($rowsent['docu_tr_date_sent']))
                                                                 {
                                                                    echo '

                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="font-weight: bold">Last Sent By:</h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5>'.$sender_disp.'</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="font-weight: bold">Date Last Sent:</h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5>'.$DTsent.'</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="font-weight: bold">Last Remarks of Sender:</h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5>'.$docu_tr_remarks.'</h5>
                                                                        </td>
                                                                    </tr>

                                                                   
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

                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="font-weight: bold">Last Received By:</h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5>'.$receive_disp.'</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="font-weight: bold">Date Last Received:</h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5>'.$DTreceived.'</h5>
                                                                        </td>
                                                                    </tr>

                                                                    
                                                                    ';
                                                                 }
                                                                 else
                                                                 {
                                                                   //No display;
                                                                 }
                                                              }
                                                     ?>
                                                     <!--receiver-->
                                                     <tr>
                                                         <td>
                                                             <h5 style="font-weight: bold">Overdue Status:</h5>
                                                         </td>
                                                         <td>
                                                             <h5><?php echo $docu_tr_overdue_stat;?></h5>
                                                         </td>
                                                     </tr>
                                                 </tbody>
                                            </table>
                                          </div>          
                                      </div>
                                      <!--FIRST CONTAINER-->

                                      <!--DIVIDER-->
                                      <div class="col-md-12">
                                        <div class="row" style="padding:1px; background-color:#262626; margin-bottom: 20px"></div>
                                      </div>
                                      <!--DIVIDER-->
                                  </div>
                              <!--FIRST CONTAINER-->

                              <!--SECOND CONTAINER-->
                              
                                  <div class="col-md-12">
                                        <h4 style="color: white; font-size: 20px; text-decoration: underline;">Traces of Document Ticket No: <?php echo $docu_ticketno?> </h4>
                                        <div class="row" style="padding:1px; background-color:white;"></div>
                                    <table class="table table-striped mbn" style="font-size: 12px">
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
                              <!--SECOND CONTAINER-->
                              <hr>
                              <p style="font-style: italic">*This is a system generated report. There are no user inputs are entered to influence the results of the report.</p>
                              <p style="text-align: center">Generated By: PUPQC Document Tracking System</p>
                              </div>
                </div>
            </section>
          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->


<!--ON PAGE SCRIPT-->
 <!--Printing-->
 <script> 
 function printDiv(printablearea)
 {
     var printContents = document.getElementById(printablearea).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
     
     window.print();
     
     document.body.innerHTML = originalContents;
 }
 </script>

</body>
</html>
