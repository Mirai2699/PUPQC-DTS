
   <?php

           include("../../../db_con.php");
           //Override ticket no. (For testing)
           //$docu_ticketno = '';

           $view_query1 = mysqli_query($connection,"SELECT * FROM `t_document_track_history` AS DOCU
                                                          INNER JOIN `t_accounts` AS ACC
                                                          INNER JOIN `t_employees` AS EMP
                                                          INNER JOIN `r_document_type` AS TYPE
                                                          INNER JOIN `r_source_type` AS SRC
                                                          INNER JOIN `r_priority_type` AS PRIO
                                                          ON  ACC.acc_empID = EMP.emp_ID
                                                          and TYPE.docutype_ID = DOCU.docu_tr_his_doctype
                                                          and SRC.source_ID = DOCU.docu_tr_his_sourcetype
                                                          and PRIO.priority_ID = DOCU.docu_tr_his_prioritytype
                                                          WHERE DOCU.docu_tr_his_ticket_no = '$docu_ticketno'
                                                          GROUP BY DOCU.docu_tr_his_ID");

       
           while($row1 = mysqli_fetch_array($view_query1))
           {
               //Document Tracking 
               $docu_tr_ID = $row1["docu_tr_his_ID"];
               $docu_tr_ticket_no = $row1["docu_tr_his_ticket_no"];
               $docu_tr_subject = $row1["docu_tr_his_subject"];
               $docu_tr_desc = $row1["docu_tr_his_desc"];
               $docu_tr_from_office = $row1["docu_tr_his_from_office"];
               $docu_tr_to_office = $row1["docu_tr_his_to_office"];
               $docu_tr_remarks = $row1["docu_tr_his_remarks"];
               $docu_tr_closing_remarks = $row1["docu_tr_his_closing_remarks"];
               $docu_tr_status = $row1["docu_tr_his_status"];
               $docu_action = $row1["docu_tr_his_action"];


               //Employee IDs
               $docu_tr_createdby = $row1["docu_tr_his_createdby"];
               $docu_tr_sender = $row1["docu_tr_his_sender"];
               $docu_tr_receiver = $row1["docu_tr_his_receiver"];
               $docu_tr_closedby = $row1["docu_tr_his_closedby"];
               $docu_tr_reopenedby = $row1["docu_tr_his_reopenedby"];


       
               //Date Entities
               $docu_tr_date_create = new datetime($row1["docu_tr_his_date_create"]);
               $docu_tr_time_create = new datetime($row1["docu_tr_his_time_create"]);
               $date_create = $docu_tr_date_create->format('F d, Y');
               $time_create = $docu_tr_time_create->format('h:i a');
               $date_notnew = $docu_tr_date_create->format('Y-m-d');
               $time_notnew = $docu_tr_time_create->format('H:i:s');

               $docu_tr_date_sent = new datetime($row1["docu_tr_his_date_sent"]);
               $docu_tr_time_sent = new datetime($row1["docu_tr_his_time_sent"]);
               $date_sent = $docu_tr_date_sent->format('F d, Y');
               $time_sent = $docu_tr_time_sent->format('h:i a');

               $docu_date_reopen = new datetime($row1["docu_tr_his_date_reopened"]);
               $docu_time_reopen = new datetime($row1["docu_tr_his_time_reopened"]);
               $date_reopen = $docu_date_reopen->format('F d, Y');
               $time_reopen = $docu_time_reopen->format('h:i a');


               $docu_date_receive = new datetime($row1["docu_tr_his_date_received"]);
               $docu_time_receive = new datetime($row1["docu_tr_his_time_received"]);
               $date_receive = $docu_date_receive->format('F d, Y');
               $time_receive = $docu_time_receive->format('h:i a');

               $docu_date_done = new datetime($row1["docu_tr_his_date_done"]);
               $docu_time_done = new datetime($row1["docu_tr_his_time_done"]);
               $date_done = $docu_date_done->format('F d, Y');
               $time_done = $docu_time_done->format('h:i a');

               $docu_date_reopened = new datetime($row1["docu_tr_his_date_reopened"]);
               $docu_time_reopened = new datetime($row1["docu_tr_his_time_reopened"]);
               $date_reopened = $docu_date_reopened->format('F d, Y');
               $time_reopened = $docu_time_reopened->format('h:i a');



               $DTsent = $date_sent.', '.$time_sent;
               $DTcreate = $date_create.', '.$time_create;
               $DTreopen = $date_reopen.', '.$time_reopen;
               $DTreceived = $date_receive.', '.$time_receive;

               //Office Created At
                 $getoffice_creator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                 INNER JOIN `r_office` AS OFF
                                                                 ON EMP.emp_office = OFF.office_ID
                                                         WHERE OFF.office_ID = '$docu_tr_from_office'");
                 while($create_off_row = mysqli_fetch_array($getoffice_creator))
                 {

                   //Office Naming
                   $created_office_ID = $create_off_row["office_ID"];
                   $created_office_name = $create_off_row["office_name"];
                   
                 }

               //Office TRANSFER
                 $getoffice_receiver = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                 INNER JOIN `r_office` AS OFF
                                                                 ON EMP.emp_office = OFF.office_ID
                                                         WHERE OFF.office_ID = '$docu_tr_to_office'");
                 while($rec_off_row = mysqli_fetch_array($getoffice_receiver))
                 {

                   //Office Naming
                   $receiver_office_ID = $rec_off_row["office_ID"];
                   $receiver_office_name = $rec_off_row["office_name"];
                   
                 }


               //For Creator
                 $getcreator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                 INNER JOIN `r_office` AS OFF
                                                                 ON EMP.emp_office = OFF.office_ID
                                                         WHERE EMP.emp_ID = ' $docu_tr_createdby'");
                  while($creator_row = mysqli_fetch_array($getcreator))
                  {

                    //Office Naming
                    $creator_office_ID = $creator_row["office_ID"];
                    $creator_office_name = $creator_row["office_name"];

                    //Employee Naming
                    $creator_ID = $creator_row["emp_ID"];
                    $creator_fname = $creator_row["emp_firstname"];
                    $creator_lname = $creator_row["emp_lastname"];
                    $creator_position = $creator_row["emp_position"];
                    $creator_compname = $creator_fname.' '.$creator_lname;
                    $creator_disp = $creator_compname.', '.$creator_position;
                    
                  }
               

               //For Sender
                 $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                 INNER JOIN `r_office` AS OFF
                                                                 ON EMP.emp_office = OFF.office_ID
                                                         WHERE EMP.emp_ID = '$docu_tr_sender'");
                  while($sender_row = mysqli_fetch_array($getsender))
                  {

                    //Office Naming
                    $sender_office_ID = $sender_row["office_ID"];
                    $sender_office_name = $sender_row["office_name"];

                    //Employee Naming
                    $sender_fname = $sender_row["emp_firstname"];
                    $sender_lname = $sender_row["emp_lastname"];
                    $sender_position = $sender_row["emp_position"];
                    $sender_compname = $sender_fname.' '.$sender_lname;
                    $sender_disp = $sender_compname.', '.$sender_position;
                    
                  }
               

               //For Reciever
                 $getreceive = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                 INNER JOIN `r_office` AS OFF
                                                                 ON EMP.emp_office = OFF.office_ID
                                                         WHERE EMP.emp_ID = '$docu_tr_receiver'");
                   while($receive_row = mysqli_fetch_array($getreceive))
                   {

                     //Office Naming
                     $receive_office_name = $receive_row["office_name"];

                     //Employee Naming
                     $receive_fname = $receive_row["emp_firstname"];
                     $receive_lname = $receive_row["emp_lastname"];
                     $receive_compname = $receive_fname.' '.$receive_lname;
                   
                   }

               //For Closer
                 $getcloser = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                 INNER JOIN `r_office` AS OFF
                                                                 ON EMP.emp_office = OFF.office_ID
                                                         WHERE EMP.emp_ID = '$docu_tr_closedby'");
                   while($closer_row = mysqli_fetch_array($getcloser))
                   {

                     //Office Naming
                     $closer_office_name = $closer_row["office_name"];

                     //Employee Naming
                     $closer_fname = $closer_row["emp_firstname"];
                     $closer_lname = $closer_row["emp_lastname"];
                     $closer_compname = $closer_fname.' '.$closer_lname;
                   
                   }


                //For Reopening
                  $getreopen = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                  INNER JOIN `r_office` AS OFF
                                                                  ON EMP.emp_office = OFF.office_ID
                                                          WHERE EMP.emp_ID = '$docu_tr_reopenedby'");
                    while($reopen_row = mysqli_fetch_array($getreopen))
                    {

                      //Office Naming
                      $reopen_office_name = $reopen_row["office_name"];

                      //Employee Naming
                      $reopen_fname = $reopen_row["emp_firstname"];
                      $reopen_lname = $reopen_row["emp_lastname"];
                      $reopen_compname = $reopen_fname.' '.$reopen_lname;
                    
                    }
               
               
                echo      '<td style="border:1px solid"> ';
                            if($docu_action == 'Created')
                            {
                               echo  '<b style="color: black">"'.$docu_tr_desc.'"</b><br> New Ticket '.$docu_action.', from the <i><b>'.$created_office_name.'</b></i>.';
                            }
                            else if($docu_action == 'Reviewed and Transferred')
                            {
                              echo  'Ticket is '.$docu_action.' from <i><b>'.$sender_office_name.'</b></i> to <i><b>'.$receiver_office_name.'.</b></i> <br><b style="color: black">"'.$docu_tr_remarks.'"</b>';
                            }
                            else if($docu_action == 'Received')
                            {
                              echo  'Ticket '.$docu_action.'.';
                            }
                            else if($docu_action == 'Closed')
                            {
                              echo  'Ticket '.$docu_action.'. <br><b style="color: black">"'.$docu_tr_closing_remarks.'"</b>';
                            }
                            else if($docu_action == 'Re-Opened')
                            {
                             echo  'Ticket '.$docu_action.'. <br>';
                            }
                         
                echo      '</td>';

                echo      '<td style="border:1px solid"> ';
                            if($docu_action == 'Created')
                            {
                              echo  $creator_compname;
                            }
                            else if($docu_action == 'Reviewed and Transferred')
                            {
                              echo  $sender_compname;
                            }
                            else if($docu_action == 'Received')
                            {
                              echo  $receive_compname;
                            }
                            else if($docu_action == 'Closed')
                            {
                              echo  $closer_compname;
                            }
                            else if($docu_action == 'Re-Opened')
                            {
                              echo  $reopen_compname;
                            }
                echo      '</td>';

                echo      '<td style="border:1px solid"> ';
                            if($docu_action == 'Created')
                            {
                              echo  $date_create.'<br>'.$time_create;
                            }
                            else if($docu_action == 'Reviewed and Transferred')
                            { 
                              echo  $date_sent.'<br>'.$time_sent;
                            }
                            else if($docu_action == 'Received')
                            {
                              echo  $date_receive.'<br>'.$time_receive;
                            }
                            else if($docu_action == 'Closed')
                            {
                              echo  $date_done.'<br>'.$time_done;
                            }
                            else if($docu_action == 'Re-Opened')
                            {
                              echo  $date_reopened.'<br>'.$time_reopened;
                            }
                         
                echo      '</td>';
                echo    '</tr> ';

          }
               
             


               

         
   ?>      
   