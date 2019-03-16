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
                  <h2 style="margin-top: 15px">Document Tracking Report</h2>
                  <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 10px; "></div> 
                </div>
             </div>
            <!--END BREADCRUMBS-->

            <!--START BODY CONTENT-->
            <div class="row" style="background-color: white">
            
              <div class="col-md-12">
                <div class="box-info">
                  <div class="col-md-12">
                  <!--box-info start-->
                    <div class="box-info">
                      <div class="panel-heading" style="background-color: #666666; ">
                        <h4 style="color: white; font-size: 25px">View Document Tickets</h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                      </div>
                      <br>
                      <!--adv-table start-->
                      
                      <div class="adv-table">
                      <!--START TABLE-->
                      <table id="datatables" class="table table-striped table-no-border">
                         <thead>
                         <tr>
                             <th style="display: none">DocTr No.</th>
                             <th>Ticket No.</th>
                             <th>Source</th>
                             <th>Document Type</th>
                             <th>Subject</th>
                             <th>Description</th>
                             <th>Ticket Creator</th>
                             <th>Priority Category</th>
                             <th>Date Created</th>
                             <th style="text-align: center">Action</th>
                         </tr>
                         </thead>
                         <tbody>
                         <!--TABLE FILTERING-->
                         <?php include("get_view_table_report_trace.php");?>
                         <!--TABLE FILTERING-->
                        </tbody>
                      </table>
                      <!--END TABLE-->
                      </div>
                      <!--adv-table end-->
                    </div>
                    <!--box-info end-->
                  </div>
                </div>
              </div>


            </div>
            <!--END BODY CONTENT-->


          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->
   </body>
</html>




       
              
              

              
              
            