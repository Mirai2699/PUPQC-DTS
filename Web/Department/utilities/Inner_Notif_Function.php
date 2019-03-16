<li class="dropdown dropdown-extra dropdown-notifications" title="See Notifications">
  <a href="#" data-toggle="dropdown" class="dropdown-toggle" >
    <i class="icon-bell" style="color: #bfbfbf"></i>
    <?php
      include("../../../db_con.php");

      $userID = $_SESSION['UserID'];
      $view_query = mysqli_query($connection,"SELECT * FROM `t_accounts` AS ACC 
                                              INNER JOIN `t_employees` AS EMP 
                                              INNER JOIN `r_office` AS OFF
                                              ON EMP.emp_office = OFF.office_ID
                                              and ACC.acc_empID = EMP.emp_ID
                                              WHERE ACC.acc_ID = '$userID'
                                              ");
      while($row = mysqli_fetch_assoc($view_query))
      {
          $emp_office = $row["emp_office"];
      }
      $notif_count =  mysqli_query($connection,"SELECT * FROM `t_document_track` WHERE docu_tr_to_office = '$emp_office' and docu_tr_receiving_stat = 1");

      if(mysqli_num_rows($notif_count) > 0)
      {
        $blink_count = mysqli_num_rows($notif_count);
        echo 
        '
          <span class="badge pink">'.$blink_count.'</span>
        '; 
      }
      else
      { 
        $blink_count = 0;
        //No Display
      }
    ?>
  </a>
  <ul class="dropdown-menu">
    <li>
      <p>You Have <?php echo $blink_count?> Un-opened Ticket(s)</p>
    </li>
    <li>
      <ul class="dropdown-menu-list dropdown-scroller">
        <?php
          include("../../../db_con.php");

          
          $pending_notif =  mysqli_query($connection,"SELECT * FROM `t_document_track` WHERE docu_tr_to_office = '$emp_office' and docu_tr_receiving_stat = 1 ORDER BY docu_tr_date_sent DESC");

          if(mysqli_num_rows($notif_count) > 0)
          {
            while($n_row = mysqli_fetch_assoc($pending_notif))
            {
              $docu_tr_ID = $n_row["docu_tr_ID"];
              $docu_tr_ticket_no = $n_row["docu_tr_ticket_no"];
              $docu_tr_subject = $n_row["docu_tr_subject"];
              $docu_tr_date_create = new datetime($n_row["docu_tr_date_create"]);
              $docu_tr_date_sent = new datetime($n_row["docu_tr_date_sent"]);

              //Employee IDs
              $docu_tr_sender = $n_row["docu_tr_sender"];

              
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
              '
                   <li>
                     <a href="../functionalities/document_tracking.php?getID='.$docu_tr_ticket_no.'">
                       DT No: <b>'.$docu_tr_ticket_no.'</b><br>
                       Subject: <b>'.$docu_tr_subject.'</b><br>
                       Forwarded By: <b>'.$sender_compname.'</b><br>
                       <span class="time">Sent on '.$date_sent.'</span>
                     </a>
                   </li>
                 </ul>
               </li>
               <li class="footer">
                 <div class="col-md-12" style="background-color:#f2f2f2; text-align: center; font-style: italic">
                  <div style="margin: 5px">Click to See Full Details</div>
                 </div>
               </li>

              '; 
            }
            
          }
          else
          { 
            echo '
                    </ul>
                  </li>
                  <li class="footer">
                    <div class="col-md-12" style="background-color:#f2f2f2; text-align: center; font-style: italic">
                     <div style="margin: 5px"> There are Currently <br>No Notifications</div>
                    </div>
                  </li>
                 ';
            //No Display
          }
        ?>
  </ul>
</li>