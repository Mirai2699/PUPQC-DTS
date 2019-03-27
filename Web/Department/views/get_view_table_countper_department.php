<table class="table table-condensed mbn" style="font-size: 15px">
    <thead>
        <th>Department</th>
        <th>Created</th>
        <th>Transferred</th>
        <th>Received</th>
        <th>Closed</th>
        <th>Re-Opened</th>
        <th>Ave. Service Time</th>
        <th>Ave. Response Time</th>
    </thead>
    <tbody>
        <?php
            $receiver_query = mysqli_query($connection,"SELECT * FROM `t_accounts` AS ACC
                                                               INNER JOIN `t_employees` AS EMP
                                                               INNER JOIN `r_office` AS OFF 
                                                               ON ACC.acc_empID = EMP.emp_ID
                                                               and EMP.emp_office = OFF.office_ID
                                                               WHERE ACC.acc_ID = '$userID'");
            while($rq = mysqli_fetch_array($receiver_query))
            {
               $receiving_office = $rq["office_ID"];
               $receiving_off_name = $rq["office_name"];
            }
            //For creation
            $view_create = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                            WHERE docu_tr_his_from_office = '$receiving_office'
                                                            GROUP BY docu_tr_his_ticket_no");
            $get_create = mysqli_num_rows($view_create);
            //For transfer
            $view_transferred = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                INNER JOIN  `t_accounts` AS ACC 
                                                                ON ACC.acc_ID = HISDOCU.docu_tr_his_sender
                                                                INNER JOIN `t_employees` AS EMP
                                                                ON ACC.acc_empID = EMP.emp_ID
                                                                INNER JOIN `r_office` AS OFF 
                                                                ON EMP.emp_office = OFF.office_ID
                                                                WHERE EMP.emp_office = '$receiving_office'
                                                                GROUP BY docu_tr_his_ticket_no");
            $get_transferred = mysqli_num_rows($view_transferred);


            $view_received = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                INNER JOIN  `t_accounts` AS ACC 
                                                                ON ACC.acc_ID = HISDOCU.docu_tr_his_receiver
                                                                INNER JOIN `t_employees` AS EMP
                                                                ON ACC.acc_empID = EMP.emp_ID
                                                                INNER JOIN `r_office` AS OFF 
                                                                ON EMP.emp_office = OFF.office_ID
                                                                WHERE EMP.emp_office = '$receiving_office'
                                                                GROUP BY docu_tr_his_ticket_no");
            $get_received = mysqli_num_rows($view_received);


             $view_closed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                INNER JOIN  `t_accounts` AS ACC 
                                                                ON ACC.acc_ID = HISDOCU.docu_tr_his_closedby
                                                                INNER JOIN `t_employees` AS EMP
                                                                ON ACC.acc_empID = EMP.emp_ID
                                                                INNER JOIN `r_office` AS OFF 
                                                                ON EMP.emp_office = OFF.office_ID
                                                                WHERE EMP.emp_office = '$receiving_office'
                                                                GROUP BY docu_tr_his_ticket_no");
            $get_closed = mysqli_num_rows($view_closed);



            $view_reopen = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                INNER JOIN  `t_accounts` AS ACC 
                                                                ON ACC.acc_ID = HISDOCU.docu_tr_his_reopenedby
                                                                INNER JOIN `t_employees` AS EMP
                                                                ON ACC.acc_empID = EMP.emp_ID
                                                                INNER JOIN `r_office` AS OFF 
                                                                ON EMP.emp_office = OFF.office_ID
                                                                WHERE EMP.emp_office = '$receiving_office'
                                                                GROUP BY docu_tr_his_ticket_no");
            $get_reopen = mysqli_num_rows($view_reopen);



            $get_total_ave = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
                                                            INNER JOIN  `t_accounts` AS ACC 
                                                            ON ACC.acc_ID = DOCUHIS.docu_tr_his_sender
                                                            INNER JOIN `t_employees` AS EMP
                                                            ON ACC.acc_empID = EMP.emp_ID
                                                            INNER JOIN `r_office` AS OFF 
                                                            ON EMP.emp_office = OFF.office_ID
                                                           
                                                            LEFT JOIN r_priority_type AS PRIO 
                                                            ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
                                                             WHERE EMP.emp_office = '$receiving_office'
                                                            GROUP BY docu_tr_his_ticket_no");
            if(mysqli_num_rows($get_total_ave) > 0)
            {
               while($row_ave = mysqli_fetch_assoc($get_total_ave))
               {
                $docu_tr_his_prioritytype = $row_ave["docu_tr_his_prioritytype"];
                $priority_date_count = $row_ave["priority_date_count"];
                $docu_tr_his_count_date_process = $row_ave["docu_tr_his_count_date_process"];
                //echo $docu_tr_his_count_date_process;
                $res_count=mysqli_num_rows($get_total_ave);
                $res_cdp = ($docu_tr_his_count_date_process + $docu_tr_his_count_date_process)/2;
                $dept_res_ave = ($res_cdp/$res_count)*10;

                
                
               }
               $eval_stmnt = '';
               if($dept_res_ave > $priority_date_count)
               {
                $eval_stmnt =  'Overall Performance is Not Good.';
               }
               else if($dept_res_ave <= $priority_date_count)
               {
                $eval_stmnt =  'Overall Performance is Good.';
               }
            }
            else
            {
                $docu_tr_his_prioritytype = 0;
                $priority_date_count = 0;
                $docu_tr_his_count_date_process = 0;
                //echo $docu_tr_his_count_date_process;
                $res_count= 0;
                $res_cdp = 0;
                $dept_res_ave = 0;

            
              $eval_stmnt = 'You still have not processed and transferred a document ticket.';
             
            }



            $get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
                                                            INNER JOIN  `t_accounts` AS ACC 
                                                            ON ACC.acc_ID = DOCUHIS.docu_tr_his_sender
                                                            INNER JOIN  `t_accounts` AS ACC1 
                                                            ON ACC1.acc_ID = DOCUHIS.docu_tr_his_receiver
                                                            INNER JOIN `t_employees` AS EMP
                                                            ON ACC.acc_empID = EMP.emp_ID
                                                            INNER JOIN `r_office` AS OFF 
                                                            ON EMP.emp_office = OFF.office_ID
                                                            LEFT JOIN r_priority_type AS PRIO 
                                                            ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
                                                         WHERE EMP.emp_office = '$receiving_office'
                                                            GROUP BY docu_tr_his_ticket_no");
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

                    $Dept_DA_RT_average = number_format($RT_average,3);

                }
                    


                    //Overall Response Time Generation
                    //echo $DA_RT_average;

                    //COmparison Values for evaluation
                    $fast = 2.00;
                    $fair = 5.00;

                    if($Dept_DA_RT_average <= $fast)
                    {
                        $RT_desc = 'Your Response Time is Faster than Normal.';
                    }
                    else if($Dept_DA_RT_average > $fast &&  $DA_RT_average <= $fair)
                    {
                        $RT_desc = 'Your Response Time is Normal';
                    }
                    else if($Dept_DA_RT_average > $fair)
                    {
                        $RT_desc = 'Your Response Time is Slower than Normal.';
                    }
                    else
                    {
                        $RT_desc = 'Response Time is Undefined';
                    }
            }
            else if(mysqli_num_rows($get_total_speed) == 0) 
            {
                    $Dept_DA_RT_average = 0;
                    $RT_desc = 'You still have not processed and transferred a document.'; 

            }

            echo
            '
                <tr>
                    <td>'.$receiving_off_name.'</td>
                    <td>'.$get_create.'</td>
                    <td>'.$get_transferred.'</td>
                    <td>'.$get_received.'</td>
                    <td>'.$get_closed.'</td>
                    <td>'.$get_reopen.'</td>
                    <td>'.$dept_res_ave.'</td>
                    <td>'.$Dept_DA_RT_average.'</td>
                </tr>
            ';
             
        ?>
        
    </tbody>
</table>