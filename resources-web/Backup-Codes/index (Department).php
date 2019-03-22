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
                  <h2 style="margin-top: 15px">Dashboard</h2>
                  <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 10px; "></div> 
                </div>
             </div>
            <!--END BREADCRUMBS-->

            <script src="../../../resources-web/assets/plugins/highcharts/highcharts.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/data.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/exporting.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/drilldown.js"></script>
            

            <!--START DASHBOARD-->
            <section class="main-content">
                <!--PERCENTAGES AND RATING PART-->
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="panel panel-stat stat-primary" style="background-color: #000099">
                            <div class="panel-body">
                                <?php
                                    include("get_docuticket_count.php");
                                ?>
                                <div class="row mbxl">
                                    <div class="col-xs-8"><span class="stat-title">Total Number of Document Tickets Tracked in your Account</span>
                                        <h2 class="man"><?php echo $total_count?></h2>
                                    </div>
                                    <div class="col-xs-4"><i class="fa fa-file-text" style="margin-top: 20px"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3"><span class="stat-title">Created</span>
                                        <h4 class="man"><?php echo $create_count?></h4>
                                    </div>
                                    <div class="col-xs-3"><span class="stat-title">Forwarded</span>
                                        <h4 class="man"><?php echo $sent_count?></h4>
                                    </div>
                                    <div class="col-xs-3"><span class="stat-title">Closed</span>
                                        <h4 class="man"><?php echo $closed_count?></h4>
                                    </div>
                                    <div class="col-xs-3"><span class="stat-title">Re-Opened</span>
                                        <h4 class="man"><?php echo $reopen_count?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-stat stat-success" style="background-color: #006600">
                            <div class="panel-body">
                                <?php
                                    include("get_user_performance.php");
                                ?>
                                <div class="row mbxl">
                                    <div class="col-xs-8"><span class="stat-title">Average Response Time Rating in Processing Documents</span>
                                        <h2 class="man"><?php echo $res_ave.'%'?></h2>
                                        <small style="color: white">Average Response Speed</small>
                                        <h4 class="man" ><?php echo $eval_stmnt?></h4>
                                        <h5><a data-toggle="modal" href="#user_perf_details">>> Click to see more details <<</a></h5>
                                    </div>
                                    <div class="col-xs-4"><i class="fa fa-dashboard" style="margin-top: 20px"></i></div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-xs-4"><span class="stat-title">Daily</span>
                                        <h4 class="man">4%</h4>
                                    </div>
                                    <div class="col-xs-4"><span class="stat-title">Weekly</span>
                                        <h4 class="man">4%</h4>
                                    </div>
                                    <div class="col-xs-4"><span class="stat-title">Monthly</span>
                                        <h4 class="man">4%</h4>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-stat stat-default" style="background-color: #004466">
                            <div class="panel-body">
                                <?php
                                    include("get_response_time.php");
                                ?>
                                <div class="row mbxl">
                                    <div class="col-xs-8"><span class="stat-title">Average Response Time and Its Evaluation</span>
                                        <h2 class="man"><?php echo $DA_RT_average ?> mins</h2>
                                        <small style="color: white">Response Time Measured in Minutes</small>
                                        <h4 class="man" ><?php echo $RT_desc?></h4>
                                        <h5><a data-toggle="modal" href="#response_time">>> Click to see more details <<</a></h5>
                                    </div>
                                    <div class="col-xs-4"><i class="fa fa-clock-o" style="margin-top: 20px"></i></div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-xs-4"><span class="stat-title">Daily</span>
                                        <h4 class="man">4%</h4>
                                    </div>
                                    <div class="col-xs-4"><span class="stat-title">Weekly</span>
                                        <h4 class="man">4%</h4>
                                    </div>
                                    <div class="col-xs-4"><span class="stat-title">Monthly</span>
                                        <h4 class="man">4%</h4>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- NUMBER OF DOCUMENT TYPE CREATED PART-->
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading" style="background-color: #262626; color: white" >
                            <h3 class="panel-title" style="margin:1px">
                                <i class="fa fa-bar-chart-o"></i>&nbsp;
                                Number of Document Types Produced by Your Account
                            </h3>
                        </div>
                        <div class="row">
                            <div class="panel-body">
                                <div class="demo-container">
                                    <div class="col-md-12">
                                        <div id="groupregion" class="flotChart"></div>
                                        <script type="text/javascript">
                                            Highcharts.chart('groupregion', {
                                            chart: {
                                                type: 'column'
                                            },
                                            title: {
                                                text: 'Document Types Created Tickets'
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
                                                pointFormat: '<span style="color:{point.color}">{point.name}</span>:Total of  <b>{point.y:.0sf}</b><br/>'
                                            },

                                            series: [
                                                {
                                                    name: "Document Type Created:",
                                                    colorByPoint: true,
                                                    data: [
                                                        <?php
                                                            $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
                                                                                                      INNER JOIN `r_document_type` AS DOCUTYPE
                                                                                                      ON DOCU.docu_tr_doctype = DOCUTYPE.docutype_ID
                                                                                                  ");
                                                                while($row = mysqli_fetch_assoc($view_query))
                                                                    {   
                                                                        $bygrp = $row["docu_tr_doctype"];
                                                                        $name = $row["docutype_desc"];
                                                                        //$InvQty = $row["Quantity"];
                                                        ?> 
                                                            {
                                                                name: '<?php echo $name?>',
                                                                y: <?php
                                                                $view_query2 = mysqli_query($connection,"SELECT COUNT(docu_tr_doctype) AS rate FROM `t_document_track` WHERE docu_tr_doctype = '$bygrp' and  docu_tr_createdby = '$userID'");
                                                                    while($row2 = mysqli_fetch_assoc($view_query2))
                                                                        {   
                                                                            $InvQty = $row2["rate"];
                                                                            echo ($InvQty);
                                                                        }
                                                                   ?>,
                                                                drilldown: '<?php echo $bygrp ?>',
                                                            },
                                                        <?php
                                                        }
                                                        ?>
                                                    ]
                                                }
                                            ]
                                        });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <!--NUMBER OF DOCUMENT TRANSACTED PART-->

                <div class="col-md-12">   
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
                                                                                $view_query1 = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` AS DOCUHIS
                                                                                                                INNER JOIN `r_document_type` AS DOCTYPE
                                                                                                                ON DOCUHIS.docu_tr_his_doctype = DOCTYPE.docutype_ID
                                                                                                                WHERE DOCUHIS.docu_tr_his_createdby = '$userID'
                                                                                                                      and DOCUHIS.docu_tr_his_doctype = '$InvCategory'");

                                                                                $total_count = mysqli_num_rows($view_query1);
                                                                                echo $total_count;
                                                                   ?>,
                                                                drilldown: 'FOR<?php echo $InvCategory?>',
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
                                                      id: 'FOR<?php echo $InvCategory?>',
                                                      type:'line',
                                                      data: [


                                                            {
                                                                name: 'Created',
                                                                y: <?php
                                                                    $view_create = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
                                                                                                                WHERE docu_tr_his_createdby = '$userID'
                                                                                                                and docu_tr_his_doctype = '$InvCategory'");
                                                                    
                                                                    $total_count1 = mysqli_num_rows($view_create);
                                                                    echo $total_count1;

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
                                            }
                                        });

                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 


                <?php 
                    include("get_view_modal_user_per_details.php");
                    include("get_view_modal_response_time.php");
                ?>
            </section>


            <!--END DASHBOARD-->


          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->
   </body>
</html>




       
              
              

              
              
            