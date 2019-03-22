<table class="table table-condensed mbn" style="font-size: 15px">
    <thead>
        <th>Department</th>
        <th>Created</th>
        <th>Transferred</th>
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



                                              
            echo
            '
                <tr>
                    <td>'.$receiving_off_name.'</td>
                    <td>'.$get_create.'</td>
                    <td>'.$get_transferred.'</td>
                    <td>'.$get_closed.'</td>
                    <td>'.$get_reopen.'</td>
                </tr>
            ';
             if(mysqli_num_rows($view_create) > 0)
             {
                while($row = mysqli_fetch_array($view_create))
                {

                }
             }
             else
             {

             }
        ?>
        
    </tbody>
</table>