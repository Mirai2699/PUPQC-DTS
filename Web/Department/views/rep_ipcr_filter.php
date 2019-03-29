<div class="col-md-12" style="margin-top: 10px">
    <?php 
        if(isset($_POST['filter_date']))
        {

            $start = new datetime($_POST['start_date']);
            $end = new datetime($_POST['end_date']);

            $nf_start = $start->format('F Y');
            $nf_end = $end->format('F Y');
            echo
            '
                <p style="font-size:18px; color: black">
                    Date Range from <b>'.$nf_start.'</b> to <b>'.$nf_end.'</b>.
                </p>
            ';
        }
        else
        {
            echo
            '
                <p style="font-size:18px; color: black">
                    Date Range from the beginning of transactions up to now.
                </p>
            ';
        }
    ?>
</div>

    
    <div class="col-md-12">
        <div class="panel-heading" style="background-color: #404040; color: white; margin-top: 1px">
            <h4 style="margin-top: 5px">User's Total of Transacted Document Tickets</h4>
            <div class="row" style="padding: 1px; background-color: white; margin-bottom: 5px"></div>
        </div>
        <br>
        <table class="table table-condensed mbn" style="font-size: 15px">
            <thead>
                <th>Employee</th>
                <th>Created</th>
                <th>Transferred</th>
                <th>Received</th>
                <th>Closed</th>
                <th>Re-Opened</th>
            </thead>
            <tbody>
                <?php

                    if(isset($_POST['filter_date']))
                    {
                        
                        $start_of = new datetime($_POST['start_date']);
                        $end_of = new datetime($_POST['end_date']);

                        $start = $start_of->format('m-Y');
                        $end = $end_of->format('m-Y');

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
                                                                            and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
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
                                                                                and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
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
                                                                                   and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
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
                                                                                and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
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
                                                                                and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
                                                                                GROUP BY docu_tr_his_ticket_no");
                            $get_reopen = mysqli_num_rows($view_reopen);

                            

                         //display                             
                            echo
                            '
                                <tr>
                                    <td style="font-size: 18px">'.$compname.'</td>
                                    <td>'.$get_create.'</td>
                                    <td>'.$get_transferred.'</td>
                                    <td>'.$get_received.'</td> 
                                    <td>'.$get_closed.'</td> 
                                    <td>'.$get_reopen.'</td>
                                    
                                </tr>
                            ';
                    }
                    else
                    {
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

                            

                         //display                             
                            echo
                            '
                                <tr>
                                    <td style="font-size: 18px">'.$compname.'</td>
                                    <td>'.$get_create.'</td>
                                    <td>'.$get_transferred.'</td>
                                    <td>'.$get_received.'</td> 
                                    <td>'.$get_closed.'</td> 
                                    <td>'.$get_reopen.'</td>
                                    
                                </tr>
                            ';
                    }
                     
                    
                    
                ?>
                
            </tbody>
        </table>


    </div>


    <div class="col-md-12" style="margin-top: 10px">
        <div class="panel-heading" style="background-color: #404040; color: white; margin-top: 1px">
            <h4 style="margin-top: 5px">Breakdown Per Document Type</h4>
            <div class="row" style="padding: 1px; background-color: white; margin-bottom: 5px"></div>
        </div>
        <br>
        <table class="table table-condensed mbn" style="font-size: 15px">
            <thead>
                <th>Document Type</th>
                <th>Created</th>
                <th>Transferred</th>
                <th>Received</th>
                <th>Closed</th>
                <th>Re-Opened</th>
            </thead>
            <tbody>
                <?php
                    
                    if(isset($_POST['filter_date']))
                    {
                        $start_of = new datetime($_POST['start_date']);
                        $end_of = new datetime($_POST['end_date']);

                        $start = $start_of->format('m-Y');
                        $end = $end_of->format('m-Y');

                        $document_type = mysqli_query($connection, "SELECT * FROM `r_document_type`");
                        while($row_type = mysqli_fetch_assoc($document_type))
                        {
                            $docutype_ID = $row_type["docutype_ID"];
                            $docutype_name = $row_type["docutype_desc"];

                            $view_topic_create = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_createdby
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $create_total_topic = mysqli_num_rows($view_topic_create);



                            $view_topic_sent = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_sender
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $sent_total_topic = mysqli_num_rows($view_topic_sent);


                            $view_topic_received = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_receiver
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $received_total_topic = mysqli_num_rows($view_topic_received);


                            $view_topic_closed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_closedby
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $closed_total_topic = mysqli_num_rows($view_topic_closed);

                            $view_topic_reopen = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_reopenedby
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            and (month(docu_tr_his_timestamp) BETWEEN '$start' and '$end')
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $reopen_total_topic = mysqli_num_rows($view_topic_reopen);


                            echo
                            '
                                <tr>
                                    <td>'.$docutype_name.'</td>
                                    <td>'.$create_total_topic.'</td>
                                    <td>'.$sent_total_topic.'</td>
                                    <td>'.$received_total_topic.'</td>
                                    <td>'.$closed_total_topic.'</td>
                                    <td>'.$reopen_total_topic.'</td>
                                </tr>
                            ';
                        }
                    }  
                    else
                    {
                        $document_type = mysqli_query($connection, "SELECT * FROM `r_document_type`");
                        while($row_type = mysqli_fetch_assoc($document_type))
                        {
                            $docutype_ID = $row_type["docutype_ID"];
                            $docutype_name = $row_type["docutype_desc"];

                            $view_topic_create = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_createdby
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $create_total_topic = mysqli_num_rows($view_topic_create);



                            $view_topic_sent = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_sender
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $sent_total_topic = mysqli_num_rows($view_topic_sent);


                            $view_topic_received = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_receiver
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $received_total_topic = mysqli_num_rows($view_topic_received);


                            $view_topic_closed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_closedby
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $closed_total_topic = mysqli_num_rows($view_topic_closed);

                            $view_topic_reopen = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS HISDOCU 
                                                                            INNER JOIN  `t_accounts` AS ACC 
                                                                            ON ACC.acc_ID = HISDOCU.docu_tr_his_reopenedby
                                                                            WHERE ACC.acc_ID = '$userID'
                                                                            and HISDOCU.docu_tr_his_doctype = '$docutype_ID'
                                                                            GROUP BY docu_tr_his_ticket_no");
                            $reopen_total_topic = mysqli_num_rows($view_topic_reopen);


                            echo
                            '
                                <tr>
                                    <td>'.$docutype_name.'</td>
                                    <td>'.$create_total_topic.'</td>
                                    <td>'.$sent_total_topic.'</td>
                                    <td>'.$received_total_topic.'</td>
                                    <td>'.$closed_total_topic.'</td>
                                    <td>'.$reopen_total_topic.'</td>
                                </tr>
                            ';
                        }
                    } 
                   
                    
                    
                ?>
                
            </tbody>
        </table>

        
    </div>