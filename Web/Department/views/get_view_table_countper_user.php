<table class="table table-condensed mbn" style="font-size: 15px">
    <thead>
        <th>Employee</th>
        <th>Created</th>
        <th>Transferred</th>
        <th>Received</th>
        <th>Closed</th>
        <th>Re-Opened</th>
        <th>Service Time</th>
        <th>Response Time</th>
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
                                                                INNER JOIN  `t_accounts` AS ACC 
                                                                ON ACC.acc_ID = HISDOCU.docu_tr_his_createdby
                                                                WHERE docu_tr_his_from_office = '$receiving_office'
                                                                and ACC.acc_ID = '$userID'
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
                                                                    and ACC.acc_ID = '$userID'
                                                                    GROUP BY docu_tr_his_ticket_no");
                $get_transferred = mysqli_num_rows($view_transferred);


                //For received
                   $view_received = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                       INNER JOIN  `t_accounts` AS ACC 
                                                                       ON ACC.acc_ID = HISDOCU.docu_tr_his_receiver
                                                                       INNER JOIN `t_employees` AS EMP
                                                                       ON ACC.acc_empID = EMP.emp_ID
                                                                       INNER JOIN `r_office` AS OFF 
                                                                       ON EMP.emp_office = OFF.office_ID
                                                                       WHERE EMP.emp_office = '$receiving_office'
                                                                       and ACC.acc_ID = '$userID'
                                                                       GROUP BY docu_tr_his_ticket_no");
                   $get_received = mysqli_num_rows($view_received);

             //closed
                 $view_closed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                    INNER JOIN  `t_accounts` AS ACC 
                                                                    ON ACC.acc_ID = HISDOCU.docu_tr_his_closedby
                                                                    INNER JOIN `t_employees` AS EMP
                                                                    ON ACC.acc_empID = EMP.emp_ID
                                                                    INNER JOIN `r_office` AS OFF 
                                                                    ON EMP.emp_office = OFF.office_ID
                                                                    WHERE EMP.emp_office = '$receiving_office'
                                                                    and ACC.acc_ID = '$userID'
                                                                    GROUP BY docu_tr_his_ticket_no");
                $get_closed = mysqli_num_rows($view_closed);


             //reopen
                $view_reopen = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                    INNER JOIN  `t_accounts` AS ACC 
                                                                    ON ACC.acc_ID = HISDOCU.docu_tr_his_reopenedby
                                                                    INNER JOIN `t_employees` AS EMP
                                                                    ON ACC.acc_empID = EMP.emp_ID
                                                                    INNER JOIN `r_office` AS OFF 
                                                                    ON EMP.emp_office = OFF.office_ID
                                                                    WHERE EMP.emp_office = '$receiving_office'
                                                                    and ACC.acc_ID = '$userID'
                                                                    GROUP BY docu_tr_his_ticket_no");
                $get_reopen = mysqli_num_rows($view_reopen);

                include("get_user_performance.php");
                include("get_response_time.php");

             //display                             
                echo
                '
                    <tr>
                        <td>'.$compname.'</td>
                        <td>'.$get_create.'</td>
                        <td>'.$get_transferred.'</td>
                        <td>'.$get_received.'</td> 
                        <td>'.$get_closed.'</td> 
                        <td>'.$get_reopen.'</td>
                        <td>'.$res_ave.'</td>
                        <td>'.$DA_RT_average.'</td> 
                        
                    </tr>
                ';
            
            
        ?>
        
    </tbody>
</table>