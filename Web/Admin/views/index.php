<?php
    
    include("../utilities/Header.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    
?>
      <title>PUPQC-DTS | Dashboard</title>
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                 <h2 style="margin-top: 15px">Dashboard</h2>
                 <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 10px; width: 100%"></div> 
             </div>
            <!--END BREADCRUMBS-->

            <script src="../../../resources-web/assets/plugins/highcharts/highcharts.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/data.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/exporting.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/drilldown.js"></script>

            <!--START DASHBOARD-->
            <section class="main-content">
                <div class="row">

                    <div class="col-md-3 col-sm-6">
                        <div class="panel panel-stat stat-primary">
                            <div class="panel-body">
                                <div class="row mbxl">
                                    <div class="col-xs-8"><span class="stat-title">Total # of Registered Employees</span>
                                        <h2 class="man">
                                        <?php
                                            $sql="SELECT * FROM `t_employees` WHERE emp_active_flag =1 ";
                                            if ($result=mysqli_query($connection,$sql))
                                              {
                                              // Return the number of rows in result set
                                              $rowcount=mysqli_num_rows($result);
                                              echo $rowcount;
                                              }
                                        ?>
                                        </h2>
                                    </div>
                                    <div class="col-xs-4"><i class="fa fa-users" style="margin-top: 30px"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="panel panel-stat stat-warning">
                            <div class="panel-body">
                                <div class="row mbxl">
                                    <div class="col-xs-8"><span class="stat-title">Total # of Active Registered Accounts</span>
                                        <h2 class="man">
                                        <?php
                                            $sql="SELECT * FROM `t_accounts` WHERE acc_active_flag = 'Active' ";
                                            if ($result=mysqli_query($connection,$sql))
                                              {
                                              // Return the number of rows in result set
                                              $rowcount=mysqli_num_rows($result);
                                              echo $rowcount;
                                              }
                                        ?>
                                        </h2>
                                    </div>
                                    <div class="col-xs-4"><i class="fa fa-key" style="margin-top: 30px"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-3 col-sm-6">
                        <div class="panel panel-stat stat-success">
                            <div class="panel-body">
                                <div class="row mbxl">
                                    <div class="col-xs-8"><span class="stat-title">Total # of Document Types</span>
                                        <h2 class="man">
                                        <?php
                                            $sql="SELECT * FROM `r_document_type` ";
                                            if ($result=mysqli_query($connection,$sql))
                                              {
                                              // Return the number of rows in result set
                                              $rowcount=mysqli_num_rows($result);
                                              echo $rowcount;
                                              }
                                        ?>
                                        </h2>
                                    </div>
                                    <div class="col-xs-4"><i class="fa fa-files-o" style="margin-top: 30px"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-3 col-sm-6">
                        <div class="panel panel-stat stat-danger">
                            <div class="panel-body">
                                <div class="row mbxl">
                                    <div class="col-xs-8"><span class="stat-title">Users' Logs of All User Types</span>
                                        <h2 class="man">
                                        <?php
                                            $sql="SELECT * FROM `t_users_log` ";
                                            if ($result=mysqli_query($connection,$sql))
                                              {
                                              // Return the number of rows in result set
                                              $rowcount=mysqli_num_rows($result);
                                              echo $rowcount;
                                              }
                                        ?>
                                        </h2>
                                    </div>
                                    <div class="col-xs-4"><i class="fa fa-laptop" style="margin-top: 30px"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>  


                    

                </div>






                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading" style="background-color: #262626; color: white" >
                                <h3 class="panel-title" style="margin:1px">
                                    <i class="fa fa-bar-chart-o"></i>&nbsp;
                                    Document Types and Their Corresponding Transactions
                                </h3>
                            </div>

                            <div class="row">
                                <div class="panel-body">
                                    <div class="demo-container">
                                        <div class="col-md-12">
                                            <div id="inventory" class="flotChart"></div>
                                            <script type="text/javascript">
                                                Highcharts.chart('inventory', {
                                                chart: {
                                                type: 'column'
                                                },
                                                title: {
                                                    text: 'Document Types Processed and Tracked by this Account'

                                                },
                                                subtitle: {
                                                    text: 'Click to View the Number of Specific Transactions'
                                                },
                                                xAxis: {
                                                    type: 'category',
                                                    title: {
                                                        text: null
                                                    },
                                                    min: 0,
                                                    scrollbar: {
                                                        enabled: true
                                                    },
                                                    tickLength: 0
                                                },
                                                yAxis: {
                                                    title: {
                                                        text: null
                                                    }
                                                },
                                                legend: {
                                                    enabled: false
                                                },
                                                plotOptions: {
                                                    series: {
                                                        borderWidth: 0,
                                                        dataLabels: {
                                                            enabled: true,
                                                            format: '{point.y:.0f}'
                                                        }
                                                    }
                                                },

                                                tooltip: {
                                                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>Total of {point.y:.0f}</b><br/>'
                                                },

                                                series: [
                                                    {
                                                        name: "Document Type",
                                                        colorByPoint: true,
                                                        data: [
                                                            <?php
                                                               $level1 =  mysqli_query($connection,"SELECT DISTINCT office_ID, office_name FROM `r_office` ");
                                                               while($row1 = mysqli_fetch_assoc($level1))
                                                               {
                                                                $off_ID = $row1["office_ID"];
                                                                
                                                                $off_name = $row1["office_name"];
                                                                           //echo $display;
                                                                            //$InvQty = $row["Quantity"];
                                                            ?> 
                                                            {
                                                                name: '<?php echo $off_name?>',
                                                                y: <?php
                                                                        $level2 = mysqli_query($connection,"SELECT * FROM `t_document_track_history` AS DOCUHIS 
                                                                                                INNER JOIN `r_office` AS OFF 
                                                                                                ON DOCUHIS.docu_tr_his_from_office = OFF.office_ID
                                                                                                or DOCUHIS.docu_tr_his_to_office = OFF.office_ID
                                                                                                WHERE DOCUHIS.docu_tr_his_from_office = '$off_ID'
                                                                                                or DOCUHIS.docu_tr_his_to_office = '$off_ID'
                                                                                                GROUP BY DOCUHIS.docu_tr_his_ticket_no");
                                                                         
                                                                        
                                                                            $total_count2 = mysqli_num_rows($level2);
                                                                            echo $total_count2;
                                                                   ?>,
                                                                drilldown: 'FOR<?php echo $off_ID?>',
                                                            },
                                                            <?php
                                                            }
                                                            ?>
                                                        ]
                                                    }
                                                ],
                                                    drilldown: {
                                                       series: [
                                                        //requisition types
                                                       <?php
                                                          $level1 =  mysqli_query($connection,"SELECT DISTINCT office_ID, office_name FROM `r_office` ");
                                                          while($row1 = mysqli_fetch_assoc($level1))
                                                          {
                                                           $off_ID = $row1["office_ID"];
                                                           
                                                           $off_name = $row1["office_name"];
                                                                      //echo $display;
                                                                       //$InvQty = $row["Quantity"];
                                                       ?>
                                                       {
                                                       
                                                          name: 'Document Type:',
                                                          id: 'FOR<?php echo $off_ID?>',
                                                          type:'column',
                                                          data: [
                                                                <?php

                                                                  $view_query = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_doctype, docutype_desc FROM `t_document_track_history` AS DOCUHIS
                                                                                                              INNER JOIN `r_document_type` AS DOCTYPE
                                                                                                              ON DOCUHIS.docu_tr_his_doctype = DOCTYPE.docutype_ID");
                                                                      while($row = mysqli_fetch_assoc($view_query))
                                                                          {   
                                                                              $InvCategory = $row["docu_tr_his_doctype"];
                                                                              $display = $row["docutype_desc"];
                                                                              //echo $display;
                                                                               //$InvQty = $row["Quantity"];

                                                                ?>

                                                                { 
                                                                    name: '<?php echo $display ?>',
                                                                    y: <?php
                                                                         $view_query1 = mysqli_query($connection,"SELECT 
                                                                                                                  History.docu_tr_his_ticket_no,
                                                                                                                  History.docu_tr_his_doctype,
                                                                                                                  DocType.docutype_desc,
                                                                                                                  Office.office_name
                                                                                                                  FROM t_document_track_history History
                                                                                                                  INNER JOIN r_document_type DocType
                                                                                                                    ON DocType.docutype_ID = History.docu_tr_his_doctype
                                                                                                                  INNER JOIN r_office Office
                                                                                                                    ON Office.office_ID = History.docu_tr_his_from_office
                                                                                                                      OR Office.office_ID = History.docu_tr_his_to_office
                                                                                                                  WHERE History.docu_tr_his_doctype = $InvCategory
                                                                                                                    AND History.docu_tr_his_from_office = $off_ID
                                                                                                                    OR History.docu_tr_his_to_office = $off_ID
                                                                                                                  GROUP BY History.docu_tr_his_ticket_no");
                                                                           
                                                                                    $total_count = mysqli_num_rows($view_query1);
                                                                                    echo $total_count;
                                                                          
                                                                       ?>,
                                                                    //drilldown: 'NXT<?php echo $InvCategory?>',
                                                                },
                                                                <?php
                                                                }?>
                                                          ]
                                                   
                                                        }, 
                                                    <?php
                                                      }
                                                    ?>
                                                        <?php
                                                              //$temp = "null";
                                                             $view_query = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_doctype, docutype_desc FROM `t_document_track_history` AS DOCUHIS
                                                                                                     INNER JOIN `r_document_type` AS DOCTYPE
                                                                                                     ON DOCUHIS.docu_tr_his_doctype = DOCTYPE.docutype_ID
                                                                                                    ");
                                                             while($row = mysqli_fetch_assoc($view_query))
                                                                 {   
                                                                     $InvCategory = $row["docu_tr_his_doctype"];
                                                        ?>
                                                        {
                                                       
                                                          name: 'Action Taken:',
                                                          id: 'NXT<?php echo $InvCategory?>',
                                                          type:'line',
                                                          data: [

                                                                {
                                                                    name: 'Created',
                                                                    y: <?php
                                                                        $view_create = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no, COUNT(docu_tr_his_createdby) AS Month_Quantity FROM  `t_document_track_history` WHERE docu_tr_his_from_office = '1' and
                                                                          docu_tr_his_doctype = '$InvCategory'");
                                                                        
                                                                        while($row3 = mysqli_fetch_assoc($view_create))
                                                                            {
                                                                              $ReqMonthQty = $row3["Month_Quantity"];
                                                                              echo($ReqMonthQty);
                                                                            }
                                                                       ?>
                                                                },
                                                                {
                                                                    name: 'Forwarded',
                                                                    y: <?php
                                                                        $view_create = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
                                                                                                                    WHERE docu_tr_his_sender = '$userID'
                                                                                                                    and docu_tr_his_doctype = '$InvCategory'");
                                                                        
                                                                        $total_count2 = mysqli_num_rows($view_create);
                                                                        echo $total_count2;

                                                                       ?>
                                                                },
                                                                {
                                                                    name: 'Received',
                                                                    y: <?php
                                                                        $view_create = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
                                                                                                                    WHERE docu_tr_his_receiver = '$userID'
                                                                                                                    and docu_tr_his_doctype = '$InvCategory'");
                                                                        
                                                                        $total_count3 = mysqli_num_rows($view_create);
                                                                        echo $total_count3;

                                                                       ?>
                                                                },
                                                                {
                                                                    name: 'Closed',
                                                                    y: <?php
                                                                        $view_create = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
                                                                                                                    WHERE docu_tr_his_closedby = '$userID'
                                                                                                                    and docu_tr_his_doctype = '$InvCategory'");
                                                                        
                                                                        $total_count4 = mysqli_num_rows($view_create);
                                                                        echo $total_count4;

                                                                       ?>
                                                                },
                                                                {
                                                                    name: 'Re-Opened',
                                                                    y: <?php
                                                                        $view_create = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
                                                                                                                    WHERE docu_tr_his_reopenedby = '$userID'
                                                                                                                    and docu_tr_his_doctype = '$InvCategory'");
                                                                        
                                                                        $total_count5 = mysqli_num_rows($view_create);
                                                                        echo $total_count5;

                                                                       ?>
                                                                },
                                                          ]
                                                    
                                                    }, <?php
                                                    }
                                                    ?>

                                                  ]
                                                },

                                               

                                                    
                                                    
                                        });

                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
   </body>
</html>




       
              
              

              
              
            