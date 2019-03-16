
<?php
	//In General, For Front Dashbaord
	//include("../../../db_con.php");

	//$userID = $_SESSION['UserID'];
	$userID = $_SESSION['UserID'];

	
	$get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
													LEFT JOIN r_priority_type AS PRIO 
													ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
	                              				WHERE docu_tr_his_sender = '$userID'
	                              				or docu_tr_his_receiver = '$userID'");
	if(mysqli_num_rows($get_total_speed) > 0)
	{
		while($row_speed = mysqli_fetch_assoc($get_total_speed))
		{
			$docu_tr_his_prioritytype = $row_speed["docu_tr_his_prioritytype"];
			$priority_date_count = $row_speed["priority_date_count"];
			$docu_tr_his_count_date_process = $row_speed["docu_tr_his_count_date_process"];
			//echo $docu_tr_his_count_date_process;
			$res_count=mysqli_num_rows($get_total_speed);
			$res_cdp = ($docu_tr_his_count_date_process + $docu_tr_his_count_date_process);
			

			$total_priority = $priority_date_count + $priority_date_count;
			$ave_priority = $total_priority/$res_count;
			$ave_res_cdp = $res_cdp/$res_count;


			$response_time = $ave_priority - $ave_res_cdp;
			$RT_convert = (($response_time/24)/60)*100;
			$display_actual_RT_PD = number_format($RT_convert,2);

			$RT_total_sum = $display_actual_RT_PD + $display_actual_RT_PD;
			$RT_average = $RT_total_sum/$res_count;

			$DA_RT_average = number_format($RT_average,3);

		}
			


			//Overall Response Time Generation
			//echo $DA_RT_average;

			//COmparison Values for evaluation
			$fast = 2.00;
			$fair = 5.00;

			if($DA_RT_average <= $fast)
			{
				$RT_desc = 'Your Response Time is Faster than Normal.';
			}
			else if($DA_RT_average > $fast &&  $DA_RT_average <= $fair)
			{
				$RT_desc = 'Your Response Time is Normal';
			}
			else if($DA_RT_average > $fair)
			{
				$RT_desc = 'Your Response Time is Slower than Normal.';
			}
			else
			{
				$RT_desc = 'Response Time is Undefined';
			}
	}
	else if(mysqli_num_rows($get_total_speed) == 0) 
	{
			$DA_RT_average = 0;
			$RT_desc = 'You still have not processed and transferred a document.'; 

	}
?>



