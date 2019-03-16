<?php
           
   
      ////// TRACING DOCUMENTS
          
           $receiver_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
                                                              INNER JOIN `t_accounts` AS ACC
                                                              INNER JOIN `t_employees` AS EMP
                                                              ON ACC.acc_empID = EMP.emp_ID
                                                              WHERE ACC.acc_ID = '$userID'
                                                              and DOCU.docu_tr_status = 'CLOSED'
                                                              ");
           if(mysqli_num_rows($receiver_query) )
           {
             while($rq = mysqli_fetch_array($receiver_query))
             {
                $receiving_office = $rq["docu_tr_to_office"];
                //echo $receiving_office;
             }
           }
           else 
           {
                $receiving_office = 0;
           }

           if($receiving_office > 0)
           { 
               $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
                                                         INNER JOIN `r_office` AS OFF
                                                         INNER JOIN `r_document_type` AS TYPE
                                                         INNER JOIN `r_source_type` AS SRC
                                                         INNER JOIN `r_priority_type` AS PRIO
                                                         ON DOCU.docu_tr_to_office = OFF.office_ID
                                                         and TYPE.docutype_ID = DOCU.docu_tr_doctype
                                                         and SRC.source_ID = DOCU.docu_tr_sourcetype
                                                         and PRIO.priority_ID = DOCU.docu_tr_prioritytype
                                                         WHERE DOCU.docu_tr_status = 'CLOSED' 
                                                         and DOCU.docu_tr_action = 'Closed'
                                                         and DOCU.docu_tr_createdby = '$userID'
                                                         OR DOCU.docu_tr_sender = '$userID'
                                                         OR DOCU.docu_tr_to_office = '$receiving_office'
                                                         ORDER BY DOCU.docu_tr_ticket_no DESC ");
                if(mysqli_num_rows($view_query) > 0)
                {
                   while($row = mysqli_fetch_array($view_query))
                   {
                       //Document Tracking 
                       $docu_tr_ID = $row["docu_tr_ID"];
                       $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
                       $docu_tr_subject = $row["docu_tr_subject"];
                       
                       $docu_tr_desc = $row["docu_tr_desc"];
                       $docu_tr_remarks = $row["docu_tr_remarks"];
                       $docu_tr_status = $row["docu_tr_status"];
                       $docu_tr_receiving_stat = $row["docu_tr_receiving_stat"];

                       //Employee IDs
                       $docu_tr_createdby = $row["docu_tr_createdby"];
                       $docu_tr_sender = $row["docu_tr_sender"];
                       $docu_tr_receiver = $row["docu_tr_receiver"];
                       $docu_tr_closedby = $row["docu_tr_closedby"];
                       //Docu Type
                       $docu_tr_type = $row['docu_tr_doctype'];
                       $docutype_desc = $row['docutype_desc'];
                       $source_desc = $row["source_desc"];
                       $priority_desc = $row["priority_desc"];
                   
                       //Date Entities
                       $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
                       $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
                       $date_create = $docu_tr_date_create->format('F d, Y');
                       $date_sent = $docu_tr_date_sent->format('F d, Y');

                       $docu_tr_date_done = new datetime($row["docu_tr_date_done"]);
                       $date_closed = $docu_tr_date_done->format('F d, Y');




                       //For CREATOR (variables not renamed)
                       $getclosedby = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                       INNER JOIN `r_office` AS OFF
                                                                       ON EMP.emp_office = OFF.office_ID
                                                               WHERE EMP.emp_ID = '$docu_tr_closedby'");
                       while($closedby_row = mysqli_fetch_array($getclosedby))
                       {

                         //Office Naming
                         $closedby_office_name = $closedby_row["office_name"];

                         //Employee Naming
                         $closedby_fname = $closedby_row["emp_firstname"];
                         $closedby_lname = $closedby_row["emp_lastname"];
                         $closedby_position = $closedby_row["emp_position"];
                         $closedby_compname = $closedby_fname.' '.$closedby_lname;
                         $closedby_disp = $closedby_compname.', '.$closedby_position;
                       }

                       
                         echo
                         '<tr class="gradeX">
                            <td style="display: none"> '.$docu_tr_ID.' </td>
                            <td style=""> '.$docu_tr_ticket_no.' </td>
                            <td style=""> '.$source_desc.' </td>
                            <td style=""> '.$docutype_desc.' </td>  
                            <td style=""> '.$docu_tr_subject.' </td>
                            <td style=""> '.$priority_desc.' </td>
                            <td style=""> '.$closedby_compname.' </td>
                            <td style=""> '.$date_create.' </td>
                            <td style=""> '.$date_closed.' </td>
                            <td style="">
                              <center>
                                <a href="ticket_review.php?getID='.$docu_tr_ticket_no.'" class="btn btn-primary btn-round" title="View Traces">
                                 <i class="fa fa-external-link"></i> Review</a>
                              </center>
                            </td>
                         </tr>  ';
                      
                   }

                  
                }

                else
                {
                  //No Display
                }
            }
        

      
   ?>      
       