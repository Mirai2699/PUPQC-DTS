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
                  <div class="col-md-12">
                      <h2 style="margin-top: 15px">Document Ticketing</h2>
                      <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 20px;"></div> 
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
                     
                      <div class="col-md-7" style="margin-bottom: 10px">
                         <div class="row" id="SPACER" style="margin-top: 10px; "></div>

                         <div class="col-md-12">
                           <div class="panel" style="padding:3px; background-color:gray;"></div>
                           <h3>Setup Document Details</h3>
                           <div class="panel" style="padding:3px; background-color:gray;"></div>
                         </div>
                         <div class="col-md-12" style="display: none">
                            <?php include("../functionalities/ticket_num_generator.php");?>
                            <label><b>Document Ticket Tracking Number:</b></label>
                            <input type="hidden" name="docu_ticket_no" class="form-control" readonly="" value="<?php echo $ticketno ?>" required>
                         </div>
                         <div class="col-md-6">
                            
                            <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                            <label><b>Source Type:</b></label><small style="color:red">&nbsp;&nbsp;&nbsp;*This field is required.</small>
                            <select id="docu_source_type" name="docu_source_type"  class="form-control" style="color: black;" onClick="changetextbox();" required>
                               <option value="" selected disabled>-- Select Source Type --</option>
                               <?php  
                                   $sqlemp = "SELECT * FROM `r_source_type` where source_stat = 1";
                                   $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                     while($row = mysqli_fetch_assoc($results))
                                     {
                                       $source_ID = $row['source_ID'];
                                       $source_desc = $row['source_desc'];
                               ?>
                               <option value="<?php echo $source_ID ?>"><?php echo $source_desc; ?></option>
                               <?php } ?>
                            </select>
                         </div>
                        



                         <!--Employees' Office (Ticket Creator)-->
                         <?php  
                            $userID = $_SESSION['UserID'];
                            $view_query = mysqli_query($connection,"SELECT * FROM `t_accounts` AS ACC 
                                                                    INNER JOIN `t_employees` AS EMP 
                                                                    INNER JOIN `r_office` AS OFF
                                                                    ON EMP.emp_office = OFF.office_ID
                                                                    and ACC.acc_empID = EMP.emp_ID
                                                                    WHERE ACC.acc_ID = '$userID'
                                                                    ");
                            while($row = mysqli_fetch_assoc($view_query))
                            {
                                $emp_office = $row["emp_office"];
                            }
                         ?>
                         <input type="hidden" name="docu_from_office" value="<?php echo $emp_office; ?>">
                         
                         <!--Employees' Office (Ticket Creator)-->

                        <!--External Input-->
                        <div class="col-md-6" id="input_source" style="display: none">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                            <label><b>External Office:</b></label><small style="color:red">&nbsp;&nbsp;&nbsp;*This field is required only if external is selected.</small>
                            <input id="docu_ext_source" type="text" class="form-control" name="docu_ext_source">
                         </div>
                         <!--External Input-->

                         <div class="col-md-6">
                            <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                            <label><b>Document Type:</b></label><small style="color:red">&nbsp;&nbsp;&nbsp;*This field is required.</small>
                            <select id="docu_docutype" name="docu_doctype" class="form-control" style="color: black;" required>
                               <option value="" selected disabled>-- Select Document Type --</option>
                               <?php  
                                   $sqlemp = "SELECT * FROM `r_document_type` where docutype_stat = 1";
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
                         <div class="col-md-6">
                            <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                            <label><b>Priority Type:</b></label><small style="color:red">&nbsp;&nbsp;&nbsp;*This field is required.</small>
                            <select id="docu_prio_type" name="docu_priority_type" class="form-control" style="color: black;" required>
                               <option value="" selected disabled>-- Select Priority Type --</option>
                               <?php  
                                   $sqlemp = "SELECT * FROM `r_priority_type` where priority_stat = 1";
                                   $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                     while($row = mysqli_fetch_assoc($results))
                                     {
                                       $priority_ID = $row['priority_ID'];
                                       $priority_desc = $row['priority_desc'];
                               ?>
                               <option value="<?php echo $priority_ID ?>"><?php echo $priority_desc; ?></option>
                               <?php } ?>
                            </select>
                         </div>
                         <!--1st Level END-->

                         <div class="col-md-12">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                           <div class="panel" style="padding:3px; background-color:gray;"></div>
                           <h3>Communication Details</h3>
                           <div class="panel" style="padding:3px; background-color:gray;"></div>
                         </div>
                         <div class="col-md-12">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                           <label><b>Subject:</b></label><small style="color:red">&nbsp;&nbsp;&nbsp;*This field is required.</small>
                           <input id="subject" type="text" name="docu_subject" class="form-control" placeholder="Re: Subject..." required>
                         </div>
                         <div class="col-md-12">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                           <label><b>Description:</b></label><small style="color:red">&nbsp;&nbsp;&nbsp;*This field is required.</small>
                           <div class="compose-editor"  style="border: 1px solid #6e6e6e">
                            <textarea id="composer" rows="10" class="form-control" name="docu_desc" required style="font-size: 15px"></textarea>
                           </div>
                         </div>
                          <div class="col-md-12">
                           <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                           <label><b>Signatory:</b></label><small style="color:red">&nbsp;&nbsp;&nbsp;*This field is required.</small>
                           <input id="signatory" type="text" name="docu_signatory" class="form-control" placeholder="Add Signatory" required>
                         </div>
                         <!--BUTTON DIVISION-->

                         <div class="col-md-12" style="margin-bottom: 10px; text-align: right; ">
                              <div id="SPACER" class="row" style="padding:1px;margin: 5px"></div>
                              <div class="row" style="padding:1px; background-color: #262626; margin: 1px"></div>
                              <div id="SPACER" class="row" style="padding:1px;margin: 5px"></div>

                              <button style="font-size: 17px" class="btn btn-success" type="submit" name="acc_docu_ticket">
                              <i class="fa  fa-tag"></i>  Create Ticket
                              </button>
                              &nbsp; &nbsp;
                              <button style="font-size: 17px" class="btn btn-primary" type="button" onclick="clear_all();">
                              <i class="fa fa-refresh"></i>  Clear All
                              </button>
                              &nbsp; &nbsp;
                              <a class="btn btn-danger" href="#cancel" data-toggle="modal" style="font-size: 17px">
                              <i class="fa fa-times"></i>  Cancel
                              </a>
                              &nbsp; &nbsp;
                         </div>
                      </div>
                      
                      <!--START MODAL-->

                      <div id="cancel" class="modal fade">
                          <div class="modal-dialog">
                              <div class="modal-content" >
                                  <div class="modal-header" style="background-color: #800000; color: white">
                                      <h2 id="myModalLabel" class="modal-title" style="text-align: center">
                                        <i class="fa fa-times"></i>
                                        Cancel the ticket
                                      </h2>
                                  </div>
                                  <div class="modal-body">
                                      <!-- START --> 
                                      <center>
                                        <p style="font-size: 16px; color: black">Cancelling the creation of the ticket will reset the form entries 
                                                                  <br>and will redirect to you to the pending received tickets page.</p>
                                        <p style="font-size: 16px; color: black">Are you sure you want to proceed?</p>
                                              <div class="col-md-12">
                                                    <button type="button" onclick="cancel_entry();" class="btn btn-success" style="font-size: 18px">
                                                      <i class="fa fa-check" data-s="12" data-c="white"></i>
                                                      Yes
                                                    </button>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a data-dismiss="modal" class="btn btn-danger" style="font-size: 18px">
                                                      <i class="fa fa-times" data-s="12" data-c="white"></i>
                                                      No
                                                    </a>     
                                              </div>
                                      </center>
                                    <!--END-->
                                  </div>
                                  <div class="modal-footer">
                                    
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!--END MODAL-->


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

<script type="text/javascript">
window.onload = function (){
    document.getElementById("input_source").style.display = 'None';
}

function changetextbox()
{
   var sourcetype = document.getElementById("docu_source_type").value;
   if(sourcetype == 1)
   {
      document.getElementById("input_source").style.display = 'None';
   }
   else if(sourcetype == 2)
   {
      document.getElementById("input_source").style.display = '';
   }

}
function clear_all()
{  
   $('#docu_source_type').val('');
   $('#docu_ext_source').val('');
   $('#docu_docutype').val('');
   $('#docu_prio_type').val('');
   $('#subject').val('');
   $('#composer').val('');
   $('#signatory').val('');

}

function cancel_entry()
{
   $('#docu_source_type').val('');
   $('#docu_ext_source').val('');
   $('#docu_docutype').val('');
   $('#docu_prio_type').val('');
   $('#subject').val('');
   $('#composer').val('');
   $('#signatory').val('');
   $(location).attr('href','view_pending.php');

}
// function changetextbox()
// {
//    if (this.value=='other'){this.form['other'].style.visibility='visible'}else {this.form['other'].style.visibility='hidden'};
// }
</script>

 <link type="text/css" rel="stylesheet" href="../../../resources-web/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 <script src="../../../resources-web/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 <script src="../../../resources-web/assets/js/email-compose.js"></script>
 <script src="../../../resources-web/assets/js/ui-panels.js"></script>

</body>
</html>
