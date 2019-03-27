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
                <!--LINE CHART and TABLE-->
                <div class="col-md-12">   
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading" style="background-color: #262626; color: white" >
                                <h3 class="panel-title" style="margin:1px">
                                    <i class="fa fa-bar-chart-o"></i>&nbsp;
                                   Document Ticketing Transactions Chart
                                </h3>
                            </div>

                            <div class="row">
                                <div class="panel-body">
                                    <div class="demo-container">
                                        <div class="col-md-12">
                                            <div id="daterep" style="width: 99%; height: 400px;"></div>
                                               <script type="text/javascript">
                                                  var begin_date = '',
                                                      end_date = '';
                                                  $.post('functionalities/FilterLineChart.php',{'begin_date' : begin_date, 'end_date' : end_date}, function(response) {
                                                    var result = JSON.parse(response);
                                                    result["category"];
                                                    result["data"]["created"];
                                                    result["data"]["Transferred"];
                                                    result["data"]["Closed"];
                                                    /*Highcharts*/
                                                  })
                                                   Highcharts.chart('daterep', {
                                                       chart: {
                                                           type: 'line'
                                                       },
                                                       title: {
                                                          text: 'Document Transactions Chart as of <?php echo $date = date('F Y');?>'
                                                      },

                                                      subtitle: {
                                                          text: 'Covers the ticket Transactions from Created, Transffered, Received, Closed and Reopened.'
                                                      },

                                                      xAxis: {
                                                          categories: [ <?php
                                                                $view_creates = mysqli_query($connection,"SELECT DISTINCT day(docu_tr_his_timestamp) as day, date(docu_tr_his_timestamp) AS DATET FROM `t_document_track_history` 
                                                                                             WHERE docu_tr_his_createdby = '$userID' 
                                                                                             or docu_tr_his_sender = '$userID' 
                                                                                             or docu_tr_his_receiver = '$userID' 
                                                                                             or docu_tr_his_closedby = '$userID' 
                                                                                             or docu_tr_his_reopenedby = '$userID' 
                                                                                             and (MONTH(docu_tr_his_timestamp) = MONTH(CURRENT_TIMESTAMP)
                                                                                             AND YEAR(docu_tr_his_timestamp) = YEAR(CURRENT_TIMESTAMP))
                                                                                             ORDER BY docu_tr_his_timestamp ");
                                                                while($row_speeds = mysqli_fetch_assoc($view_creates))
                                                                  {
                                                                    $days = $row_speeds['day'];
                                                                    $specify_days = new datetime($row_speeds['DATET']);
                                                                    $new_format_day = $specify_days->format('Y-m-d');
                                                                    echo '"'.$new_format_day.'",';
                                                                  }
                                                                  ?>]
                                                      },
                                                      legend: {
                                                          layout: 'vertical',
                                                          align: 'right',
                                                          verticalAlign: 'middle'
                                                      },

                                                      plotOptions: {
                                                          series: {
                                                              label: {
                                                                  connectorAllowed: false
                                                              },
                                                          }
                                                      },
                                                       series: [

                                                          {
                                                              name: 'Created',
                                                              data: 
                                                              
                                                              [
                                                                <?php

                                                                $view_creates = mysqli_query($connection,"SELECT DISTINCT day(docu_tr_his_timestamp) as day FROM `t_document_track_history` WHERE docu_tr_his_createdby = '$userID' 
                                                                                            and (MONTH(docu_tr_his_timestamp) = MONTH(CURRENT_TIMESTAMP)
                                                                                             AND YEAR(docu_tr_his_timestamp) = YEAR(CURRENT_TIMESTAMP))
                                                                                             ORDER BY docu_tr_his_timestamp");
                                                                while($row_speeds = mysqli_fetch_assoc($view_creates))
                                                                  {
                                                                    $days = $row_speeds['day'];
                                                                    $view_create1 = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history`                                        WHERE docu_tr_his_createdby = '$userID' 
                                                                                                              and day(docu_tr_his_timestamp) = '$days'");
                                                                                $total_count1 = mysqli_num_rows($view_create1);
                                                                                echo $total_count1.',';

                                                                  } 
                                                              ?>
                                                              ]

                                                          },
                                                          {
                                                              name: 'Transferred',
                                                              data: 
                                                              
                                                              [
                                                                <?php

                                                                $view_trans = mysqli_query($connection,"SELECT DISTINCT day(docu_tr_his_timestamp) as day FROM `t_document_track_history` WHERE docu_tr_his_sender = '$userID' 
                                                                                             and (MONTH(docu_tr_his_timestamp) = MONTH(CURRENT_TIMESTAMP)
                                                                                             AND YEAR(docu_tr_his_timestamp) = YEAR(CURRENT_TIMESTAMP))
                                                                                             ORDER BY docu_tr_his_timestamp");
                                                                while($row_trans = mysqli_fetch_assoc($view_trans))
                                                                  {
                                                                    $days = $row_trans['day'];
                                                                    $view_create2 = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history`                                        WHERE docu_tr_his_sender = '$userID' 
                                                                                                              and day(docu_tr_his_timestamp) = '$days'");
                                                                                $total_count2 = mysqli_num_rows($view_create2);
                                                                                echo $total_count2.',';

                                                                  } 
                                                              ?>
                                                              ]

                                                          },
                                                           {
                                                              name: 'Received',
                                                              data: 
                                                              
                                                              [
                                                                <?php

                                                                $view_creates = mysqli_query($connection,"SELECT DISTINCT day(docu_tr_his_timestamp) as day FROM `t_document_track_history` WHERE docu_tr_his_receiver = '$userID' 
                                                                                             and (MONTH(docu_tr_his_timestamp) = MONTH(CURRENT_TIMESTAMP)
                                                                                             AND YEAR(docu_tr_his_timestamp) = YEAR(CURRENT_TIMESTAMP))
                                                                                             ORDER BY docu_tr_his_timestamp");
                                                                while($row_speeds = mysqli_fetch_assoc($view_creates))
                                                                  {
                                                                    $days = $row_speeds['day'];
                                                                    $view_create2 = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM 
                                                                                                            `t_document_track_history`
                                                                                                             WHERE docu_tr_his_receiver = '$userID' 
                                                                                                              and day(docu_tr_his_timestamp) = '$days'");
                                                                                $total_count2 = mysqli_num_rows($view_create2);
                                                                                echo $total_count2.',';

                                                                  } 
                                                              ?>
                                                              ]

                                                          },
                                                          {
                                                              name: 'Closed',
                                                              data: 
                                                              
                                                              [
                                                                <?php

                                                                $view_creates = mysqli_query($connection,"SELECT DISTINCT day(docu_tr_his_timestamp) as day FROM `t_document_track_history` WHERE docu_tr_his_closedby = '$userID' 
                                                                                            and (MONTH(docu_tr_his_timestamp) = MONTH(CURRENT_TIMESTAMP)
                                                                                             AND YEAR(docu_tr_his_timestamp) = YEAR(CURRENT_TIMESTAMP))
                                                                                             ORDER BY docu_tr_his_timestamp");
                                                                while($row_speeds = mysqli_fetch_assoc($view_creates))
                                                                  {
                                                                    $days = $row_speeds['day'];
                                                                    $view_create2 = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history`                                        WHERE docu_tr_his_closedby = '$userID' 
                                                                                                              and day(docu_tr_his_timestamp) = '$days'");
                                                                                $total_count2 = mysqli_num_rows($view_create2);
                                                                                echo $total_count2.',';

                                                                  } 
                                                              ?>
                                                              ]

                                                          },
                                                         
                                                          {
                                                              name: 'Reopened',
                                                              data: 
                                                              
                                                              [
                                                                <?php

                                                                $view_creates = mysqli_query($connection,"SELECT DISTINCT day(docu_tr_his_timestamp) as day FROM `t_document_track_history` WHERE docu_tr_his_reopenedby = '$userID' 
                                                                                             and (MONTH(docu_tr_his_timestamp) = MONTH(CURRENT_TIMESTAMP)
                                                                                             AND YEAR(docu_tr_his_timestamp) = YEAR(CURRENT_TIMESTAMP))
                                                                                             ORDER BY docu_tr_his_timestamp ");
                                                                while($row_speeds = mysqli_fetch_assoc($view_creates))
                                                                  {
                                                                    $days = $row_speeds['day'];
                                                                    $view_create2 = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history`                                        WHERE docu_tr_his_reopenedby = '$userID' 
                                                                                                              and day(docu_tr_his_timestamp) = '$days'");
                                                                                $total_count2 = mysqli_num_rows($view_create2);
                                                                                echo $total_count2.',';

                                                                  } 
                                                              ?>
                                                              ]

                                                          },

                                                           ],

                                                   });
                                               </script>             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--TABLE-->
                            <?php include("get_view_table_office_performance.php"); ?>
                            <!--TABLE-->
                        </div>
                    </div>
                </div> 
                <!--LINE CHART AND TABLE-->

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




       
              
              

              
              
            