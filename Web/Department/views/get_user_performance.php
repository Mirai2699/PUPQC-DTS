<?php
	include("../../../db_con.php");

	//$userID = $_SESSION['UserID'];
	$userID = $_SESSION['UserID'];

	$view_logs = "SELECT * FROM `t_users_log` WHERE log_userID = '$userID'";
	if ($result_logs = mysqli_query($connection,$view_logs))
	    {
	    // Return the number of rows in result set
	    $user_result = mysqli_num_rows($result_logs);
	    //echo $total_count;
	    }
	else 
	    echo 0;
	
		$get_total_ave = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
														LEFT JOIN r_priority_type AS PRIO 
														ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
		                              				WHERE docu_tr_his_sender = '$userID'");
		if(mysqli_num_rows($get_total_ave) > 0)
		{
		   while($row_ave = mysqli_fetch_assoc($get_total_ave))
		   {
		   	$docu_tr_his_prioritytype = $row_ave["docu_tr_his_prioritytype"];
		   	$priority_date_count = $row_ave["priority_date_count"];
		   	$docu_tr_his_count_date_process = $row_ave["docu_tr_his_count_date_process"];
		   	//echo $docu_tr_his_count_date_process;
		   	$res_count=mysqli_num_rows($get_total_ave);
		   	$res_cdp = ($docu_tr_his_count_date_process + $docu_tr_his_count_date_process)/2;
		   	$res_ave = ($res_cdp/$res_count)*10;

		   	
		   	
		   }
		   $eval_stmnt = '';
		   if($res_ave > $priority_date_count)
		   {
		   	$eval_stmnt =  'Overall Performance is Not Good.';
		   }
		   else if($res_ave <= $priority_date_count)
		   {
		   	$eval_stmnt =  'Overall Performance is Good.';
		   }
		}
		else
		{
		  	$docu_tr_his_prioritytype = 0;
		  	$priority_date_count = 0;
		  	$docu_tr_his_count_date_process = 0;
		  	//echo $docu_tr_his_count_date_process;
		  	$res_count= 0;
		  	$res_cdp = 0;
		  	$res_ave = 0;

		
		  $eval_stmnt = 'You still have not processed and transferred a document ticket.';
		 
		}


		$get_overdue = mysqli_query($connection, "SELECT * FROM `t_document_track_history` 
		                              				WHERE docu_tr_his_overdue_stat = 'YES'
		                              				and docu_tr_his_receiver = '$userID'
		                              				GROUP BY docu_tr_his_ticket_no");
		if(mysqli_num_rows($get_overdue) > 0)
		{
				$overdue_count = mysqli_num_rows($get_overdue);
				//echo $overdue_count;
		}
		else
		{
			$overdue_count = 0;
		}
?>