<?php
    
    include("../utilities/Header.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Charts.php");
?>      
        

      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                <div class="col-md-12">
                  <h2 style="margin-top: 15px">User's Individual Employee's Performance Commitment and Review Report</h2>
                  <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 1px; "></div> 
                </div>
             </div>
            <!--END BREADCRUMBS-->

            <!--START DASHBOARD-->
            <section class="main-content">

                <div class="col-md-12" style="background-color: #262626; margin-bottom:10px; border: 2px solid #ffffff">
                  <div class="Panel" style="margin: 10px">
                   <form method="POST">
                        <label style="color: white; font-size: 18px">Action Available:</label>
                         <br>

                         <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-5">
                                    <label style="color: white">From:</label>
                                    <input type="month" class="form-control" name="start_date">
                                </div>
                                <div class="col-md-1">
                                    <p style="font-size: 20px; margin-top: 25px; color: white">
                                        <i class="fa fa-exchange"></i>
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <label style="color: white">To:</label>
                                    <input type="month" class="form-control" name="end_date">
                                </div>
                            </div>
                         </div>

                         <div class="col-md-6" style="margin-top: 25px">
                            <button type="submit" class="btn btn-info" style="background-color: #002699" name="filter_date">
                                <i class="fa fa-refresh"></i>
                                Filter Report
                            </button>
                            &nbsp;
                            <button class="btn btn-success" onclick="printDiv('printablearea')" name="Print" style="background-color: green">
                                <i class="fa fa-print"></i>   
                                Print Report
                            </button>
                         </div>
                         <div class="row" style="margin-bottom: 10px"></div>
                    </form>
                  </div>
                </div>

                <div class="col-md-12" style="background-color: white">
                    <!--1st part-->
                    <?php include("rep_ipcr_filter.php"); ?>
                    <!--1st part-->
                   
                    
                    <div style="display: none" id="printablearea">
                        <div class="">
                             <img  src="../../../resources-web/images/QCheader.png" style="height:40%; width:60%; "> 
                        </div>
                        <div style="margin-top: 5px; margin-left: 15px">
                            <div style="text-align: left; ">
                                <h5 style="font-size: 14px; text-align: right">Report No. UPR-<?php echo date('Ymd'); ?> </h5>
                                <h5 style="font-size: 14px">Date Generated: <br>
                                    <?php echo date('F d, Y'); ?>
                                </h5>
                                <center>
                                    <b style="font-size: 20px">User's Performance Report</b><br>
                                </center>
                                <h5>Report Description:</h5> 
                                <p style="text-align: justify; font-size: 14px">   &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                                                    This report shows the personal/employee details of the user, and the general evaluation of the user's performance in using the system.
                                </p>
                               
                            </div>
                            <h5>Table(s) Description:</h5> 
                                <p style="text-align: justify; font-size: 14px">   &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                                                    The first table below shows the personal/employee details of the user, and the second table shows the general evaluation of the user's performance in using the system.Note that the higher the value of the Total Average Response Time Percentage, means the processing of documents is slow and not consistent.
                                </p>
                        <!--1st part-->
                        <div class="col-md-6">
                            <div class="panel-heading" style="background-color: #6e6e6e; color: white; margin-top: 3px">
                                <h3 style="margin-top: 5px">User's Personal Details</h3>
                            </div>
                            <table class="table table-condensed mbn">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Account Username:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $acc_username; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Account Date Created:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $add_date; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Employee's Name:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $compname; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Office/Department:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $off_name; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Position/Roles:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo  $emp_pos; ?></h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--1st part-->
                        <!--2nd part-->
                        <div class="col-md-6">
                            <div class="panel-heading" style="background-color:  #002846; color: white; margin-top: 3px">
                                <h3 style="margin-top: 5px">User Account's Performance</h3>
                            </div>
                            <?php
                                include("get_docuticket_count.php");
                                include("get_user_performance.php");
                            ?>
                            <table class="table table-condensed mbn">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Total Account Log-Ins:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo  $user_result; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Total Number of Document Tickets Tracked:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $total_count; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Total Number of Overdue Tickets:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $overdue_count; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Total Average Response Time Percentage in Processing Documents:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $res_ave.'%'; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight: bold">Overall Performance Evaluation:</h5>
                                        </td>
                                        <td>
                                            <h5><?php echo $eval_stmnt; ?></h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--2nd part-->
                        <hr>
                        <p style="font-style: italic">*This is a system generated report. There are no user inputs are entered to influence the results of the report.</p>
                        <p style="text-align: center">Generated By: PUPQC Document Tracking System</p>
                        </div>
                    </div>
                </div>


            </section>


            <!--END DASHBOARD-->


          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->
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




       
              
              

              
              
            