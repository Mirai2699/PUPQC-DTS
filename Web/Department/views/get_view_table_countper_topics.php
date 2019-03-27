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
            
             //For creation
               
              
       



             //display                             
                
            
            
        ?>
        
    </tbody>
</table>