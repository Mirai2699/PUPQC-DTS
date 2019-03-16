<?php
	
	if(isset($_POST['filter_rep']))
	{
	 $office_filter = $_POST['filter_office'];


	
	 if ($office_filter  == 0)
	 {
	     $getuser = mysqli_query($connection, "SELECT * FROM `t_accounts` AS ACC
	                                             INNER JOIN `t_employees` AS EMP 
	                                             INNER JOIN `r_office` AS OFF
	                                             ON EMP.emp_office = OFF.office_ID
	                                             and ACC.acc_empID = EMP.emp_ID
	                                             WHERE acc_ID != 1
	                                             ");
	      while($user_row = mysqli_fetch_array($getuser))
	         {
	             $userID = $user_row["acc_ID"];
	             $username = $user_row["acc_username"];
	             $emp_lname = $user_row["emp_lastname"];
	             $emp_mname = $user_row["emp_middlename"];
	             $emp_fname = $user_row["emp_firstname"];

	             $compname = $emp_fname.' '.$emp_lname;
	             $off_name = $user_row["office_name"];


				     echo 
				     '{
				         name: '.$compname.',
				         y: ';
				                $get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
				                                                             LEFT JOIN r_priority_type AS PRIO 
				                                                             ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
				                                                             WHERE docu_tr_his_sender = '$userID'
				                                                             or docu_tr_his_receiver = '$userID'
				                                                             GROUP BY DOCUHIS.docu_tr_his_ticket_no");

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
	                  
	                echo'}';
	                 echo $DA_RT_average,  
	            
	        
	     },
	}
}
	

?>


