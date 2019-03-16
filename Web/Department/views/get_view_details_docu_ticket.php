            <!--BACKEND-->
            <?php 

                include("../../../db_con.php");
                //Override ticket no. (For testing)
                //$docu_ticketno = '';

                $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
                                                               INNER JOIN `t_accounts` AS ACC
                                                               INNER JOIN `t_employees` AS EMP
                                                               INNER JOIN `r_document_type` AS TYPE
                                                               INNER JOIN `r_source_type` AS SRC
                                                               INNER JOIN `r_priority_type` AS PRIO
                                                               ON DOCU.docu_tr_createdby = ACC.acc_empID
                                                               and ACC.acc_empID = EMP.emp_ID
                                                               and TYPE.docutype_ID = DOCU.docu_tr_doctype
                                                               and SRC.source_ID = DOCU.docu_tr_sourcetype
                                                               and PRIO.priority_ID = DOCU.docu_tr_prioritytype
                                                               WHERE DOCU.docu_tr_ticket_no = '$docu_ticketno'");

            
                while($row = mysqli_fetch_array($view_query))
                {
                    //Document Tracking 
                    $docu_tr_ID = $row["docu_tr_ID"];
                    $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
                    $docu_tr_subject = $row["docu_tr_subject"];
                    $docu_tr_desc = $row["docu_tr_desc"];
                    $docu_tr_from_office = $row["docu_tr_from_office"];
                    $docu_tr_remarks = $row["docu_tr_remarks"];
                    $docu_tr_status = $row["docu_tr_status"];
                    $docu_tr_asignatory = $row["docu_tr_asignatory"];
                    $docu_tr_overdue_stat = $row["docu_tr_overdue_stat"];



                    //Employee IDs
                    $docu_tr_createdby = $row["docu_tr_createdby"];
                    $docu_tr_sender = $row["docu_tr_sender"];
                    $docu_tr_receiver = $row["docu_tr_receiver"];
                    $docu_tr_reopenedby = $row["docu_tr_reopenedby"];
                    $docu_tr_closedby = $row["docu_tr_closedby"];

                    //Docu Type
                    $docutype_desc = $row['docutype_desc'];
                    $source_desc = $row["source_desc"];
                    $priority_desc = $row["priority_desc"];
                    $priority_days_count = $row["priority_date_count"];

                    $docu_ext_source = $row["docu_tr_ext_source_desc"];

                    //Docu Type (IDs)
                    $docu_tr_typeID = $row['docu_tr_doctype'];
                    $source_ID = $row["docu_tr_prioritytype"];
                    $priority_ID = $row["docu_tr_sourcetype"];
           
                    //Date Entities
                    $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
                    $docu_tr_time_create = new datetime($row["docu_tr_time_create"]);
                    $date_create = $docu_tr_date_create->format('F d, Y');
                    $time_create = $docu_tr_time_create->format('h:i a');
                    $date_notnew = $docu_tr_date_create->format('Y-m-d');
                    $time_notnew = $docu_tr_time_create->format('H:i:s');

                    $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
                    $docu_tr_time_sent = new datetime($row["docu_tr_time_sent"]);
                    $date_sent = $docu_tr_date_sent->format('F d, Y');
                    $time_sent = $docu_tr_time_sent->format('h:i a');

                    $docu_date_reopen = new datetime($row["docu_tr_date_reopened"]);
                    $docu_time_reopen = new datetime($row["docu_tr_time_reopened"]);
                    $date_reopen = $docu_date_reopen->format('F d, Y');
                    $time_reopen = $docu_time_reopen->format('h:i a');


                    $docu_date_receive = new datetime($row["docu_tr_date_received"]);
                    $docu_time_receive = new datetime($row["docu_tr_time_received"]);
                    $date_receive = $docu_date_receive->format('F d, Y');
                    $time_receive = $docu_time_receive->format('h:i a');

                    $docu_date_done = new datetime($row["docu_tr_date_done"]);
                    $docu_time_done = new datetime($row["docu_tr_time_done"]);
                    $date_done = $docu_date_done->format('F d, Y');
                    $time_done = $docu_time_done->format('h:i a');

                    
                    
                    if($DTsent = NULL)
                    {
                      $DTsent = 'Not Yet Forwarded';
                    }
                    else
                    {
                      $DTsent = $date_sent.', '.$time_sent;
                    }
                    $DTcreate = $date_create.', '.$time_create;
                    $DTreopen = $date_reopen.', '.$time_reopen;
                    $DTreceived = $date_receive.', '.$time_receive;
                    $DTclosed = $date_done.', '.$time_done;





                }

                //Office Created At
                $getoffice_creator = mysqli_query($connection, "SELECT * FROM `r_office` 
                                                                WHERE office_ID = '$docu_tr_from_office'");
                while($create_off_row = mysqli_fetch_array($getoffice_creator))
                {

                  //Office Naming
                  $created_office_ID = $create_off_row["office_ID"];
                  $created_office_name = $create_off_row["office_name"];
                  
                }



                //For Creator
                  $getcreator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                  INNER JOIN `r_office` AS OFF
                                                                  ON EMP.emp_office = OFF.office_ID
                                                                  INNER JOIN `t_accounts` AS ACC
                                                                  ON ACC.acc_empID = EMP.emp_ID
                                                          WHERE EMP.emp_ID = '$docu_tr_createdby'");
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

                     //Account Details
                     $acc_email = $creator_row["acc_email"];
                     
                   }
            

                //For Sender
                  $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                  INNER JOIN `r_office` AS OFF
                                                                  ON EMP.emp_office = OFF.office_ID
                                                          WHERE EMP.emp_ID = '$docu_tr_sender'");
                  if(mysqli_num_rows($getsender) > 0)
                  {
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
                  }
                  else
                  {
                     $send_office_name = 'N/A';
                     //Employee Naming
                     $send_fname = 'N/A';
                     $send_lname = 'N/A';  
                     $send_compname = 'N/A';
                     $sender_disp = 'N/A';
                  }
                


                //For Reciever
                  $getreceive = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
                                                                  INNER JOIN `r_office` AS OFF
                                                                  ON EMP.emp_office = OFF.office_ID
                                                          WHERE EMP.emp_ID = '$docu_tr_receiver'");
                  if(mysqli_num_rows($getreceive) > 0)
                  {
                    while($receive_row = mysqli_fetch_array($getreceive))
                    {

                      //Office Naming
                      $receive_office_name = $receive_row["office_name"];

                      //Employee Naming
                      $receive_fname = $receive_row["emp_firstname"];
                      $receive_lname = $receive_row["emp_lastname"];
                      $receive_position = $receive_row["emp_position"];
                      $receive_compname = $receive_fname.' '.$receive_lname;
                      $receive_disp = $receive_compname.', '.$receive_position;
                    
                    }
                  }
                  else
                  {
                     $receive_office_name = 'N/A';
                     //Employee Naming
                     $receive_fname = 'N/A';
                     $receive_lname = 'N/A';  
                     $receive_compname = 'N/A';
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
                        $closer_position = $closer_row["emp_position"];
                        $closer_compname = $closer_fname.' '.$closer_lname;
                        $closer_disp = $closer_compname.', '.$closer_position;
                      
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
                         $reopen_position = $reopen_row["emp_position"];
                         $reopen_compname = $reopen_fname.' '.$reopen_lname;
                         $reopen_disp = $reopen_compname.', '.$reopen_position;
                       }


                      $get_latest_ID = mysqli_query($connection, "SELECT MAX(docu_tr_his_ID) AS MAXID FROM `t_document_track_history` 
                                                                    WHERE docu_tr_his_ticket_no = '$docu_tr_ticket_no' ");
                        while($LID_row = mysqli_fetch_array($get_latest_ID))
                        {

                          //Office Naming
                          $latest_ID = $LID_row["MAXID"];

                        }
                      $get_latest_timestamp = mysqli_query($connection, "SELECT docu_tr_his_ID, docu_tr_his_ticket_no, docu_tr_his_timestamp
                                                                           FROM `t_document_track_history` 
                                                                           WHERE docu_tr_his_ticket_no = '$docu_tr_ticket_no'
                                                                           and docu_tr_his_ID = '$latest_ID'");
                       while($LT_row = mysqli_fetch_array($get_latest_timestamp))
                       {

                         //Office Naming
                         $latest_timestamp = new datetime($LT_row["docu_tr_his_timestamp"]);
                         $new_LT_format = $latest_timestamp->format('F d, Y, h:i a');

                       }

            ?>
            <!--BACKEND-->