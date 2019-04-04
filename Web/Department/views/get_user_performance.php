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
		   $total_num_rate = 0;
		   while($row_ave = mysqli_fetch_assoc($get_total_ave))
		   {
		   	$docu_tr_his_prioritytype = $row_ave["docu_tr_his_prioritytype"];
		   	$priority_date_count = $row_ave["priority_date_count"];
		   	$docu_tr_his_count_date_process = $row_ave["docu_tr_his_count_date_process"];
		   	//echo $docu_tr_his_count_date_process;
		   	$res_count = mysqli_num_rows($get_total_ave);

		   	if($docu_tr_his_prioritytype == 1)
		   	{
		   		if($docu_tr_his_count_date_process <= ($priority_date_count - 4))
		   		{
		   			$num_rate = 5.00000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count - 3))
		   		{
		   			$num_rate = 5.00000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count - 2))
		   		{
		   			$num_rate = 4.33333;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count - 1))
		   		{
		   			$num_rate = 3.66667;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count))
		   		{
		   			$num_rate = 3.00000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count + 1))
		   		{
		   			$num_rate = 2.33333;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count + 2))
		   		{
		   			$num_rate = 1.66667;
		   		}
		   		else if($docu_tr_his_count_date_process >= ($priority_date_count + 3))
		   		{
		   			$num_rate = 1.00000;
		   		}
		   		
		   	}
		   	else if($docu_tr_his_prioritytype == 2)
		   	{
		   		if($docu_tr_his_count_date_process <= ($priority_date_count - 5))
		   		{
		   			$num_rate = 5.00000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count - 4))
		   		{
		   			$num_rate = 4.60000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count - 3))
		   		{
		   			$num_rate = 4.20000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count - 2))
		   		{
		   			$num_rate = 3.80000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count - 1))
		   		{
		   			$num_rate = 3.40000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count))
		   		{
		   			$num_rate = 3.00000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count + 1))
		   		{
		   			$num_rate = 2.60000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count + 2))
		   		{
		   			$num_rate = 2.20000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count + 3))
		   		{
		   			$num_rate = 1.80000;
		   		}
		   		else if($docu_tr_his_count_date_process == ($priority_date_count + 4))
		   		{
		   			$num_rate = 1.40000;
		   		}
		   		else if($docu_tr_his_count_date_process >= ($priority_date_count + 5))
		   		{
		   			$num_rate = 1.00000;
		   		}
		   		
		   	}
		   	else
		   	{
		   		if($docu_tr_his_count_date_process < $priority_date_count)
		   		{
		   			$num_rate = 5.00000;
		   		}
		   		else if($docu_tr_his_count_date_process == $priority_date_count)
		   		{
		   			$num_rate = 3.00000;
		   		}
		   		else if($docu_tr_his_count_date_process > $priority_date_count)
		   		{
		   			$num_rate = 1.00000;
		   		}
		   	}

		   	
		   	$total_num_rate = $total_num_rate + $num_rate;
		   	
		   
		   	
		   }
		   $ave_num_rate = $total_num_rate/$res_count;
		   //echo $ave_num_rate;

		   $numr_eval_stmnt = '';

		   if($ave_num_rate <= 5 && $ave_num_rate >= 4)
		   {
		   	 $numr_eval_stmnt =  'Your Overall Performance is Very Good.';
		   }
		   else if($ave_num_rate <= 3 && $ave_num_rate >= 2)
		   {
		   	 $numr_eval_stmnt =  'Your Overall Performance is Good.';
		   }
		   else if($ave_num_rate >= 1 && $ave_num_rate < 2)
		   {
		   	 $numr_eval_stmnt =  'Your Overall Performance is Not Good Enough.';
		   }

		   //echo $eval_stmnt;
		}
		else
		{
		  	$docu_tr_his_prioritytype = 0;
		  	$priority_date_count = 0;
		  	$docu_tr_his_count_date_process = 0;
		  	//echo $docu_tr_his_count_date_process;
		  	$res_count = 0;
		  	$ave_num_rate = 0;
		  	$numr_eval_stmnt = 'There are no transactions processed as of now.';
		 
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