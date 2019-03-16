<?php
    
    include("../utilities/Header.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    //include("../utilities/Charts.php");
?>      
        

      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                <div class="col-md-12">
                  <h2 style="margin-top: 15px">Users' Performance Report</h2>
                  <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 1px; "></div> 
                </div>
             </div>
            <!--END BREADCRUMBS-->
            <script src="../../../resources-web/assets/plugins/highcharts/highcharts.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/data.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/exporting.js"></script>
            <script src="../../../resources-web/assets/plugins/highcharts/modules/drilldown.js"></script>
            <!--START DASHBOARD-->
            <section class="main-content">

                <div class="col-md-12" style="background-color: #262626; margin-bottom:10px; border: 2px solid #ffffff">
                  <div class="Panel" style="margin: 10px">
                    <label style="color: white; font-size: 18px">Action Available:</label>
                    <br>
                    <form action="" method="POST">
                        <div class="col-md-4" style="margin-bottom: 20px">
                            <label style="color: white">Mode of Acquisition:</label>
                            <select class="form-control" name="filter_office" style="color: black;">
                                <option value="0" selected>-- All Offices --</option>
                                <?php  
                                    $sqlemp = "SELECT * FROM `r_office` where office_stat = 1 ";
                                    $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                      while($row = mysqli_fetch_assoc($results))
                                      {
                                        $off_ID = $row['office_ID'];
                                        $off_name = $row['office_name'];
                                ?>
                                <option value="<?php echo $off_ID; ?>"><?php echo $off_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-6">
                              <label style="color: white">Start Date:</label>
                              <input id="startdate" style="color: black;" type="date" name="StartDate" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                              <label style="color: white">End Date:</label>
                             <input id="enddate" style="color: black;" type="date" name="EndDate" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 23px">
                            <button class="btn btn-primary" type="submit" name="filter_rep">
                                <i class="fa fa-refresh"></i>  
                                Filter Report
                            </button>
                        </div>
                    </form>
                    <div class="col-md-2">
                        <button class="btn btn-success" onclick="printDiv('printablearea')" name="Print" style="background-color: green; margin-top: 23px">
                            <i class="fa fa-print"></i>   
                            Print Report
                        </button>
                    </div>
                  </div>
                </div>

                <div class="col-md-12" style="background-color: white">
                    <!--1st part-->
                    <div class="col-md-12">
                        <div class="panel-heading" style="background-color: #6e6e6e; color: white; margin-top: 20px">
                            <h3 style="margin-top: 5px">All User's Average Response Time Performance Report</h3>
                        </div>
                        <div id="RTAM" class="flotChart"></div>
                        <script type="text/javascript">
                            Highcharts.chart('RTAM', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Response Time Measured in Miuntes'
                            },
                            subtitle: {
                                text: 'This chart is not filterable'
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
                                        format: '{point.y:.3f}'
                                    }
                                }
                            },

                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.3sf}</b> mins<br/>'
                            },

                            series: [
                                {
                                    name: "Average Response Time For:",
                                    colorByPoint: true,
                                    data: [
                                        <?php

                                                $getuser = mysqli_query($connection, "SELECT * FROM `t_accounts` AS ACC
                                                                                        INNER JOIN `t_employees` AS EMP 
                                                                                        INNER JOIN `r_office` AS OFF
                                                                                        ON EMP.emp_office = OFF.office_ID
                                                                                        and ACC.acc_empID = EMP.emp_ID
                                                                                        WHERE acc_ID != 1
                                                                                        ");
                                                 while($user_row = mysqli_fetch_array($getuser))
                                                    {
                                                        $userID = $user_row["acc_ID"];
                                                        $username = $user_row["acc_username"];
                                                        $emp_lname = $user_row["emp_lastname"];
                                                        $emp_mname = $user_row["emp_middlename"];
                                                        $emp_fname = $user_row["emp_firstname"];

                                                        $compname = $emp_fname.' '.$emp_lname;
                                                        $off_name = $user_row["office_name"];
                                           

                                           
                                        ?> 
                                            {
                                                name: '<?php echo $compname?>',
                                                y: <?php
                                                       $get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
                                                                                                    LEFT JOIN r_priority_type AS PRIO 
                                                                                                    ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
                                                                                                    WHERE docu_tr_his_sender = '$userID'
                                                                                                    or docu_tr_his_receiver = '$userID'
                                                                                                    GROUP BY DOCUHIS.docu_tr_his_ticket_no");
                                                       if(mysqli_num_rows($get_total_speed) > 0)
                                                       {
                                                        while($row_speed = mysqli_fetch_assoc($get_total_speed))
                                                        {
                                                            $docu_tr_his_prioritytype = $row_speed["docu_tr_his_prioritytype"];
                                                            $priority_date_count = $row_speed["priority_date_count"];
                                                            $docu_tr_his_count_date_process = $row_speed["docu_tr_his_count_date_process"];
                                                            //echo $docu_tr_his_count_date_process;
                                                            $res_count=mysqli_num_rows($get_total_speed);
                                                            $res_cdp = ($docu_tr_his_count_date_process + $docu_tr_his_count_date_process);
                                                            

                                                            $total_priority = $priority_date_count + $priority_date_count;
                                                            $ave_priority = $total_priority/$res_count;
                                                            $ave_res_cdp = $res_cdp/$res_count;


                                                            $response_time = $ave_priority - $ave_res_cdp;
                                                            $RT_convert = (($response_time/24)/60)*100;
                                                            $display_actual_RT_PD = number_format($RT_convert,2);

                                                            $RT_total_sum = $display_actual_RT_PD + $display_actual_RT_PD;
                                                            $RT_average = $RT_total_sum/$res_count;

                                                            $DA_RT_average = number_format($RT_average,3);
                                                                
                                                        }
                                                            echo $DA_RT_average;  
                                                       }
                                                       else 
                                                       {
                                                            $DA_RT_average = 0;
                                                            echo $DA_RT_average = 0;
                                                       }
                                                      
                                                   ?>
                                               
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
                    <!--1st part-->
                    <!--2nd part-->
                    <div class="col-md-12">
                        <div class="panel-heading" style="background-color:  #002846; color: white; margin-top: 20px">
                            <h3 style="margin-top: 5px">All User Accounts' Performance Report</h3>
                        </div>
                        <hr>
                        <?php include("get_view_table_all_user_performance.php"); ?>
                            
                    </div>
                    <!--2nd part-->
                    


                    <!--PRINTABLE PART-->
                    <div style="display: none" id="printablearea">
                        <div class="">
                             <img  src="../../../resources-web/images/QCheader.png" style="height:40%; width:60%; "> 
                        </div>
                        <div style="margin-top: 5px; margin-left: 15px">
                            <div style="text-align: left; ">
                                <h5 style="font-size: 14px; text-align: right">Report No. AUPR-<?php echo date('Ymd'); ?> </h5>
                                <h5 style="font-size: 14px">Date Generated: <br>
                                    <?php echo date('F d, Y'); ?>
                                </h5>
                                <center>
                                    <b style="font-size: 20px">Users' Performance Report</b><br>
                                </center>
                                <h5>Report Description:</h5> 
                                <p style="text-align: justify; font-size: 14px">   &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                                                    This report shows the name of the employee(s), their respective offices, their total logs in the system, their performance in terms of response time average percentage and their average response time in minutes.
                                </p>
                            </div>
                            <!--First Part-->
                            <h5>Chart Description:</h5> 
                                <p style="text-align: justify; font-size: 14px">   &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                                                    The chart below shows the details about the average response time in minutes in terms of tracking and processing the transactions of documents of all employees using the system. This chart is not filterable, meaning the graph shows the general collective details of all user accounts.
                                </p>
                            <hr>
                            <div class="col-md-12">
                                <h3 style="margin-top: 5px; font-size: 17px">All User's Average Response Time Performance Chart</h3>
                                <div id="RTAMPrintable" class="flotChart"></div>
                                <script type="text/javascript">
                                    Highcharts.chart('RTAMPrintable', {
                                    chart: {
                                        type: 'bar'
                                    },
                                    title: {
                                        text: 'Response Time Measured in Miuntes'
                                    },
                                    subtitle: {
                                        text: 'This chart is not filterable'
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
                                                format: '{point.y:.3f}'
                                            }
                                        }
                                    },

                                    tooltip: {
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.3sf}</b> mins<br/>'
                                    },

                                    series: [
                                        {
                                            name: "Average Response Time For:",
                                            colorByPoint: true,
                                            data: [
                                                <?php

                                                        $getuser = mysqli_query($connection, "SELECT * FROM `t_accounts` AS ACC
                                                                                                INNER JOIN `t_employees` AS EMP 
                                                                                                INNER JOIN `r_office` AS OFF
                                                                                                ON EMP.emp_office = OFF.office_ID
                                                                                                and ACC.acc_empID = EMP.emp_ID
                                                                                                WHERE acc_ID != 1
                                                                                                ");
                                                         while($user_row = mysqli_fetch_array($getuser))
                                                            {
                                                                $userID = $user_row["acc_ID"];
                                                                $username = $user_row["acc_username"];
                                                                $emp_lname = $user_row["emp_lastname"];
                                                                $emp_mname = $user_row["emp_middlename"];
                                                                $emp_fname = $user_row["emp_firstname"];

                                                                $compname = $emp_fname.' '.$emp_lname;
                                                                $off_name = $user_row["office_name"];
                                                   

                                                   
                                                ?> 
                                                    {
                                                        name: '<?php echo $compname?>',
                                                        y: <?php
                                                               $get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
                                                                                                            LEFT JOIN r_priority_type AS PRIO 
                                                                                                            ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
                                                                                                            WHERE docu_tr_his_sender = '$userID'
                                                                                                            or docu_tr_his_receiver = '$userID'
                                                                                                            GROUP BY DOCUHIS.docu_tr_his_ticket_no");

                                                                if(mysqli_num_rows($get_total_speed) > 0)
                                                                {
                                                                 while($row_speed = mysqli_fetch_assoc($get_total_speed))
                                                                 {
                                                                     $docu_tr_his_prioritytype = $row_speed["docu_tr_his_prioritytype"];
                                                                     $priority_date_count = $row_speed["priority_date_count"];
                                                                     $docu_tr_his_count_date_process = $row_speed["docu_tr_his_count_date_process"];
                                                                     //echo $docu_tr_his_count_date_process;
                                                                     $res_count=mysqli_num_rows($get_total_speed);
                                                                     $res_cdp = ($docu_tr_his_count_date_process + $docu_tr_his_count_date_process);
                                                                     

                                                                     $total_priority = $priority_date_count + $priority_date_count;
                                                                     $ave_priority = $total_priority/$res_count;
                                                                     $ave_res_cdp = $res_cdp/$res_count;


                                                                     $response_time = $ave_priority - $ave_res_cdp;
                                                                     $RT_convert = (($response_time/24)/60)*100;
                                                                     $display_actual_RT_PD = number_format($RT_convert,2);

                                                                     $RT_total_sum = $display_actual_RT_PD + $display_actual_RT_PD;
                                                                     $RT_average = $RT_total_sum/$res_count;

                                                                     $DA_RT_average = number_format($RT_average,3);
                                                                         
                                                                 }
                                                                     echo $DA_RT_average;  
                                                                }
                                                                else 
                                                                {
                                                                     $DA_RT_average = 0;
                                                                     echo $DA_RT_average = 0;
                                                                }
                                                           ?>
                                                       
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
                            <!--First Part-->
                            <hr>
                            <!--Second part-->
                            <h5>Table Description:</h5> 
                                <p style="text-align: justify; font-size: 14px">   &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                                                    The table below shows the name of the employee(s), their respective offices, their total logs in the system, their performance in terms of response time average percentage and their average response time in minutes. The details in this report may be filtered depending on the specifications of the report creator.
                                </p>
                            <hr>
                            <div class="col-md-12">
                                <h3 style="margin-top: 5px; font-size: 17px">All User Accounts' Performance Report</h3>
                                <?php include("get_view_table_all_user_performance.php"); ?>
                            </div>
                            <!--Second part-->
                           
                            
                        <hr>
                        <p style="font-style: italic">*This is a system generated report. Displayed results may vary depending on the filter applied by the report generator.</p>
                        <p style="text-align: center">Generated By: PUPQC Document Tracking System Administrator</p>
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




       
              
              

              
              
            