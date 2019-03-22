<?php
      session_start();
      $userID = $_SESSION['UserID'];
      include ("../../../db_con.php");

      //////  SENT DOCU
      if(isset($_POST['sent_docu']))
      {    
           $table_description = 'Forwarded Tickets';
           $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
                                                     INNER JOIN `t_accounts` AS ACC
                                                     INNER JOIN `t_employees` AS EMP_SENT
                                                     INNER JOIN `t_employees` AS EMP_REC
                                                     INNER JOIN `r_document_type` AS TYPE
                                                     INNER JOIN `r_source_type` AS SRC
                                                     INNER JOIN `r_priority_type` AS PRIO
                                                     ON DOCU.docu_tr_sender = ACC.acc_empID
                                                     and ACC.acc_empID = EMP_SENT.emp_ID
                                                     and ACC.acc_empID = EMP_REC.emp_ID
                                                     and TYPE.docutype_ID = DOCU.docu_tr_doctype
                                                     and SRC.source_ID = DOCU.docu_tr_sourcetype
                                                     and PRIO.priority_ID = DOCU.docu_tr_prioritytype
                                                     WHERE DOCU.docu_tr_sender = '$userID' 
                                                       and DOCU.docu_tr_status = 'OPEN' ");
            if(mysqli_num_rows($view_query) > 0)
            {
               while($row = mysqli_fetch_array($view_query))
               {
                   //Document Tracking 
                   $docu_tr_ID = $row["docu_tr_ID"];
                   $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
                   $docu_tr_subject = $row["docu_tr_subject"];
                   $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
                   $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
                   $docu_tr_desc = $row["docu_tr_desc"];
                   $docu_tr_remarks = $row["docu_tr_remarks"];
                   $docu_tr_status = $row["docu_tr_status"];

                   //Employee IDs
                   $docu_tr_sender = $row["docu_tr_sender"];
                   $docu_tr_receiver = $row["docu_tr_receiver"];


                   //Docu Type (IDs)
                   $docu_tr_typeID = $row['docu_tr_doctype'];
                   $source_ID = $row["docu_tr_prioritytype"];
                   $priority_ID = $row["docu_tr_sourcetype"];

                   //Docu Type (DESCRIPTIVE)
                   $docutype_desc = $row['docutype_desc'];
                   $source_desc = $row["source_desc"];
                   $priority_desc = $row["priority_desc"];
               
                   //Date Entities
                   $date_create = $docu_tr_date_create->format('F d, Y');
                   $date_sent = $docu_tr_date_sent->format('F d, Y');



                   //For Sender
                   $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                   INNER JOIN `r_office` AS OFF
                                                                   ON EMP.emp_office = OFF.office_ID
                                                           WHERE EMP.emp_ID = '$docu_tr_sender'");
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
                  <td width=""> '.$docu_tr_ticket_no.' </td>
                  <td width=""> '.$source_desc.' </td>
                  <td width=""> '.$docutype_desc.' </td>
                  <td width=""> '.$docu_tr_subject.' </td>
                  <td width=""> '.$priority_desc.' </td>
                  <td width=""> '.$date_create.' </td>
                  <td width=""> '.$sender_compname.' </td>
                  <td width=""> '.$date_sent.' </td>
                  <td width="">
                    <center>
                      <a href="ticket_review.php?getID='.$docu_tr_ticket_no.'" class="btn btn-info btn-round" title="View Details">
                       <i class="fa fa-external-link"></i>  Review</a>
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

      //////  CREATED DOCU
      else if(isset($_POST['create_docu']))
      {    
           $table_description = 'Created Tickets';
           $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
                                                     INNER JOIN `t_accounts` AS ACC
                                                     INNER JOIN `t_employees` AS EMP_SENT
                                                     INNER JOIN `r_document_type` AS TYPE
                                                     INNER JOIN `r_source_type` AS SRC
                                                     INNER JOIN `r_priority_type` AS PRIO
                                                     ON DOCU.docu_tr_createdby = ACC.acc_empID
                                                     and ACC.acc_empID = EMP_SENT.emp_ID
                                                     and TYPE.docutype_ID = DOCU.docu_tr_doctype
                                                     and SRC.source_ID = DOCU.docu_tr_sourcetype
                                                     and PRIO.priority_ID = DOCU.docu_tr_prioritytype
                                                     WHERE DOCU.docu_tr_createdby = '$userID' 
                                                       and DOCU.docu_tr_status = 'OPEN' ");
            if(mysqli_num_rows($view_query) > 0)
            {
               while($row = mysqli_fetch_array($view_query))
               {
                   //Document Tracking 
                   $docu_tr_ID = $row["docu_tr_ID"];
                   $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
                   $docu_tr_subject = $row["docu_tr_subject"];
                   $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
                   $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
                   $docu_tr_desc = $row["docu_tr_desc"];
                   $docu_tr_remarks = $row["docu_tr_remarks"];
                   $docu_tr_status = $row["docu_tr_status"];

                   //Employee IDs
                   $docu_tr_createdby = $row["docu_tr_createdby"];
                   $docu_tr_sender = $row["docu_tr_sender"];
                   $docu_tr_receiver = $row["docu_tr_receiver"];


                   //Docu Type (IDs)
                   $docu_tr_typeID = $row['docu_tr_doctype'];
                   $source_ID = $row["docu_tr_prioritytype"];
                   $priority_ID = $row["docu_tr_sourcetype"];

                   //Docu Type (DESCRIPTIVE)
                   $docutype_desc = $row['docutype_desc'];
                   $source_desc = $row["source_desc"];
                   $priority_desc = $row["priority_desc"];
               
                   //Date Entities
                   $date_create = $docu_tr_date_create->format('F d, Y');
                   $date_sent = $docu_tr_date_sent->format('F d, Y');



                   //For Sender
                   $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                   INNER JOIN `r_office` AS OFF
                                                                   ON EMP.emp_office = OFF.office_ID
                                                           WHERE EMP.emp_ID = '$docu_tr_sender'");
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
                        <td width=""> '.$docu_tr_ticket_no.' </td>
                        <td width=""> '.$source_desc.' </td>
                        <td width=""> '.$docutype_desc.' </td>
                        <td width=""> '.$docu_tr_subject.' </td>
                        <td width=""> '.$priority_desc.' </td>
                        <td width=""> '.$date_create.' </td>
                        <td width=""> '.$sender_compname.' </td>
                        <td width=""> '.$date_sent.' </td>
                        <td width="">
                          <center>
                            <a href="ticket_review.php?getID='.$docu_tr_ticket_no.'" class="btn btn-info btn-round" title="View Details">
                             <i class="fa fa-external-link"></i>  Review</a>
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

      ////// RECEIVED DOCU
      else if(isset($_POST['receive_docu']))
      {     
           $table_description = 'Received Tickets';
           $currdate = date('Y-m-d');

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

           $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
                                                     INNER JOIN `r_office` AS OFF
                                                     INNER JOIN `r_document_type` AS TYPE
                                                     INNER JOIN `r_source_type` AS SRC
                                                     INNER JOIN `r_priority_type` AS PRIO
                                                     ON DOCU.docu_tr_to_office = OFF.office_ID
                                                     and TYPE.docutype_ID = DOCU.docu_tr_doctype
                                                     and SRC.source_ID = DOCU.docu_tr_sourcetype
                                                     and PRIO.priority_ID = DOCU.docu_tr_prioritytype
                                                     WHERE DOCU.docu_tr_status = 'OPEN' 
                                                     and DOCU.docu_tr_to_office = '$receiving_office'
                                                     ORDER BY DOCU.docu_tr_ticket_no DESC ");
            if(mysqli_num_rows($view_query) > 0)
            {
               while($row = mysqli_fetch_array($view_query))
               {
                   //Document Tracking 
                   $docu_tr_ID = $row["docu_tr_ID"];
                   $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
                   $docu_tr_subject = $row["docu_tr_subject"];
                   $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
                   $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
                   $docu_tr_desc = $row["docu_tr_desc"];
                   $docu_tr_remarks = $row["docu_tr_remarks"];
                   $docu_tr_status = $row["docu_tr_status"];
                   $docu_tr_receiving_stat = $row["docu_tr_receiving_stat"];


                   //Employee IDs
                   $docu_tr_sender = $row["docu_tr_sender"];
                   $docu_tr_receiver = $row["docu_tr_receiver"];

                   //Docu Type
                   $docu_tr_type = $row['docu_tr_doctype'];
                   $docutype_desc = $row['docutype_desc'];
                   $source_desc = $row["source_desc"];
                   $priority_desc = $row["priority_desc"];
                   $priority_date_count = $row["priority_date_count"];
               
                   //Date Entities
                   $date_create = $docu_tr_date_create->format('F d, Y');
                   $date_sent = $docu_tr_date_sent->format('F d, Y');
                   $date_sended = $docu_tr_date_sent->format('Y-m-d');

                    $daysleft = abs(strtotime($currdate) - strtotime($date_sended));
                    $days_limit = $daysleft/(60*60*24);
                    echo $days_limit;


                   //For Sender
                   $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                   INNER JOIN `r_office` AS OFF
                                                                   ON EMP.emp_office = OFF.office_ID
                                                           WHERE EMP.emp_ID = '$docu_tr_sender'");
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

                   if($docu_tr_receiving_stat == 1)
                   {
                     echo
                     '<tr class="gradeX">
                        <td style="display: none"> '.$docu_tr_ID.' </td>
                        <td style="font-weight:bold; background-color: #99ffcc; color: #6e6e6e"> '.$docu_tr_ticket_no.' </td>
                        <td style="font-weight:bold; background-color: #99ffcc; color: #6e6e6e"> '.$source_desc.' </td>
                        <td style="font-weight:bold; background-color: #99ffcc; color: #6e6e6e"> '.$docutype_desc.' </td>
                        <td style="font-weight:bold; background-color: #99ffcc; color: #6e6e6e"> '.$docu_tr_subject.' </td>
                        <td style="font-weight:bold; background-color: #99ffcc; color: #6e6e6e"> '.$priority_desc.' </td>
                        <td style="font-weight:bold; background-color: #99ffcc; color: #6e6e6e"> '.$date_create.' </td>
                        <td style="font-weight:bold; background-color: #99ffcc; color: #6e6e6e"> '.$sender_compname.' </td>
                        <td style="font-weight:bold; background-color: #99ffcc; color: #6e6e6e"> '.$date_sent.' </td>
                        <td style="background-color: #99ffcc; color: #6e6e6e">
                          <center>
                            <a href="../functionalities/document_tracking.php?getID='.$docu_tr_ticket_no.'" class="btn btn-success btn-round" title="Open Ticket">
                             <i class="fa fa-sign-in"></i>  Open</a>
                          </center>
                        </td>
                     </tr>  ';
                  }
                  else if($docu_tr_receiving_stat == 0 && $priority_date_count > $days_limit)
                   {
                     echo
                     '<tr class="gradeX">
                        <td style="display: none"> '.$docu_tr_ID.' </td>
                        <td width=""> '.$docu_tr_ticket_no.' </td>
                        <td width=""> '.$source_desc.' </td>
                        <td width=""> '.$docutype_desc.' </td>
                        <td width=""> '.$docu_tr_subject.' </td>
                        <td width=""> '.$priority_desc.' </td>
                        <td width=""> '.$date_create.' </td>
                        <td width=""> '.$sender_compname.' </td>
                        <td width=""> '.$date_sent.' </td>
                        <td width="">
                          <center>
                            <a href="ticket_review.php?getID='.$docu_tr_ticket_no.'" class="btn btn-info btn-round" title="Review Details">
                             <i class="fa fa-external-link"></i>  Review</a>
                          </center>
                        </td>
                     </tr>  ';
                  }
                  else if($docu_tr_receiving_stat == 0 && $priority_date_count <= $days_limit)
                   {

                     $update_stat1 = "UPDATE `t_document_track` SET docu_tr_overdue_stat = 'YES' WHERE docu_tr_ID = '$docu_tr_ID'";
                     $update_stat2 = "UPDATE `t_document_track_history` SET docu_tr_his_overdue_stat = 'YES' WHERE docu_tr_his_ticket_no = '$docu_tr_ticket_no'";
                     mysqli_query($connection,$update_stat1);
                     mysqli_query($connection,$update_stat2);

                     echo
                     '<tr class="gradeX">
                        <td style="display: none"> '.$docu_tr_ID.' </td>
                        <td style="font-weight:bold; background-color: #ef9a9a ; color: black"> '.$docu_tr_ticket_no.' </td>
                        <td style="font-weight:bold; background-color: #ef9a9a ; color: black"> '.$source_desc.' </td>
                        <td style="font-weight:bold; background-color: #ef9a9a ; color: black"> '.$docutype_desc.' </td>
                        <td style="font-weight:bold; background-color: #ef9a9a ; color: black"> '.$docu_tr_subject.' </td>
                        <td style="font-weight:bold; background-color: #ef9a9a ; color: black"> '.$priority_desc.' </td>
                        <td style="font-weight:bold; background-color: #ef9a9a ; color: black"> '.$date_create.' </td>
                        <td style="font-weight:bold; background-color: #ef9a9a ; color: black"> '.$sender_compname.' </td>
                        <td style="font-weight:bold; background-color: #ef9a9a ; color: black"> '.$date_sent.' </td>
                        <td style="background-color: #ef9a9a ; color: black">
                          <center>
                           <a href="ticket_review.php?getID='.$docu_tr_ticket_no.'" class="btn btn-danger btn-round" title="Review Details">
                             <i class="fa fa-external-link"></i>  Review (Overdue)</a>
                          </center>
                        </td>
                     </tr>  ';
                  }
               }

              
            }

            else
            {
              //No Display
            }
            

      }
  
   ?>      
       