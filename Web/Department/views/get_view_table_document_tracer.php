<?php
           
   
      ////// TRACING DOCUMENTS
          
           $receiver_query = mysqli_query($connection,"SELECT * FROM `t_accounts` AS ACC
                                                              INNER JOIN `t_employees` AS EMP
                                                              INNER JOIN `r_office` AS OFF 
                                                              ON ACC.acc_empID = EMP.emp_ID
                                                              and EMP.emp_office = OFF.office_ID
                                                              WHERE ACC.acc_ID = '$userID'");
           while($rq = mysqli_fetch_array($receiver_query))
           {
              $receiving_office = $rq["office_ID"];
           }

           $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track_history` AS DOCU
                                                     INNER JOIN `r_document_type` AS TYPE
                                                     ON TYPE.docutype_ID = DOCU.docu_tr_his_doctype
                                                     INNER JOIN `r_source_type` AS SRC
                                                     ON SRC.source_ID = DOCU.docu_tr_his_sourcetype
                                                     INNER JOIN `r_priority_type` AS PRIO
                                                     ON PRIO.priority_ID = DOCU.docu_tr_his_prioritytype                                                     
                                                     WHERE DOCU.docu_tr_his_from_office = '$receiving_office'
                                                     or DOCU.docu_tr_his_sender = '$userID'
                                                     or DOCU.docu_tr_his_to_office = '$receiving_office'
                                                     GROUP BY DOCU.docu_tr_his_ticket_no
                                                     ORDER BY DOCU.docu_tr_his_ticket_no DESC");
            if(mysqli_num_rows($view_query) > 0)
            {
               while($row = mysqli_fetch_array($view_query))
               {
                   //Document Tracking 
                   $docu_tr_ID = $row["docu_tr_his_ID"];
                   $docu_tr_ticket_no = $row["docu_tr_his_ticket_no"];
                   $docu_tr_subject = $row["docu_tr_his_subject"];
                   $docu_tr_date_create = new datetime($row["docu_tr_his_date_create"]);
                   $docu_tr_date_sent = new datetime($row["docu_tr_his_date_sent"]);
                   $docu_tr_desc = $row["docu_tr_his_desc"];
                   $docu_tr_remarks = $row["docu_tr_his_remarks"];
                   $docu_tr_status = $row["docu_tr_his_status"];
                   $docu_tr_receiving_stat = $row["docu_tr_his_receiving_stat"];

                   //Employee IDs
                   $docu_tr_createdby = $row["docu_tr_his_createdby"];
                   $docu_tr_sender = $row["docu_tr_his_sender"];
                   $docu_tr_receiver = $row["docu_tr_his_receiver"];

                   //Docu Type
                   $docu_tr_type = $row['docu_tr_his_doctype'];
                   $docutype_desc = $row['docutype_desc'];
                   $source_desc = $row["source_desc"];
                   $priority_desc = $row["priority_desc"];
               
                   //Date Entities
                   $date_create = $docu_tr_date_create->format('F d, Y');
                   $date_sent = $docu_tr_date_sent->format('F d, Y');




                   //For CREATOR (variables not renamed)
                   $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                   INNER JOIN `r_office` AS OFF
                                                                   ON EMP.emp_office = OFF.office_ID
                                                           WHERE EMP.emp_ID = '$docu_tr_createdby'");
                   while($sender_row = mysqli_fetch_array($getsender))
                   {

                     //Office Naming
                     $sender_office_name = $sender_row["office_name"];

                     //Employee Naming
                     $sender_fname = $sender_row["emp_firstname"];
                     $sender_lname = $sender_row["emp_lastname"];
                     $sender_position = $sender_row["emp_position"];
                     $sender_compname = $sender_fname.' '.$sender_lname;
                     $sender_disp = $sender_compname.', '.$sender_position;
                   }

                   
                     echo
                     '<tr class="gradeX">
                        <td style="display: none"> '.$docu_tr_ID.' </td>
                        <td style=""> '.$docu_tr_ticket_no.' </td>
                        <td style=""> '.$source_desc.' </td>
                        <td style=""> '.$docutype_desc.' </td>  
                        <td style=""> '.$docu_tr_subject.' </td>
                        <td style=""> '.$docu_tr_desc.' </td>
                        <td style=""> '.$sender_compname.' </td>
                        <td style=""> '.$priority_desc.' </td>
                        <td style=""> '.$date_create.' </td>
                        <td style="">
                          <center>
                            <a href="ticket_trace_review.php?getID='.$docu_tr_ticket_no.'" class="btn btn-primary btn-round" title="View Traces">
                             <i class="fa fa-exchange"></i> View Traces</a>
                          </center>
                        </td>
                     </tr>  ';
                  
               }

              
            }

            else
            {
              //No Display
            }
            

      
   ?>      
       