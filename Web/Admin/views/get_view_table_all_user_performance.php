
<?php
	
	include("../../../db_con.php");

	


	if(isset($_POST['filter_rep']))
	{
		
			$start = new datetime($_POST['StartDate']);
			$end = new datetime($_POST['EndDate']);

			$date_start = $start->format('F d, Y');
			$date_end = $end->format('F d, Y');
			$description = $date_start.' up to '.$date_end.'.';		
		
	}
	else 
	{
		$description = 'the beginning of the transactions up to now.';
	}
	echo '
			<h4>The details in this report is filtered from '.$description.'</h4>
			<hr>
			<table  class="display table table-bordered table-striped" id="dynamic-table">
			    <thead>
			        <tr>
			            <th>Employee Name</th>
			            <th>Office Assignment</th>
			            <th>Total Logs</th>
			            <th>Total Documents Tickets Tracked</th>
			            <th>Response Time Ave. Percentage</th> 
			            <th>Response Time Ave. Minutes</th>             
			        </tr>
			    </thead>
			    <tbody>
	';



	//office filter
	if(isset($_POST['filter_rep']))
	{
		$office_filter = $_POST['filter_office'];

		if ($office_filter  == 0)
		{
			//Getting all users
			$getuser = mysqli_query($connection, "SELECT * FROM `t_accounts` AS ACC
														INNER JOIN `t_employees` AS EMP 
														INNER JOIN `r_office` AS OFF
														ON EMP.emp_office = OFF.office_ID
														and ACC.acc_empID = EMP.emp_ID
														WHERE acc_ID != 1
														");
				if(mysqli_num_rows($getuser) > 0)
				{
					while($user_row = mysqli_fetch_array($getuser))
					{
						$userID = $user_row["acc_ID"];
						$username = $user_row["acc_username"];
						$emp_lname = $user_row["emp_lastname"];
						$emp_mname = $user_row["emp_middlename"];
						$emp_fname = $user_row["emp_firstname"];

						$compname = $emp_fname.' '.$emp_lname;
						$off_name = $user_row["office_name"];

						if($_POST['StartDate'] && $_POST['EndDate'] !=NULL)
						{
						   
							$start = $_POST['StartDate'];
							$end = $_POST['EndDate'];

							$description = $start.' up to '.$end.'.';

							//getting total logs
							  	$view_logs = "SELECT * FROM `t_users_log` WHERE log_userID = '$userID' and log_datestamp between '$start' and '$end'";
							  	if ($result_logs = mysqli_query($connection,$view_logs))
							  	    {
							  	    // Return the number of rows in result set
							  	    $user_result = mysqli_num_rows($result_logs);
							  	   	
							  	    }
							  	else 
							  	    echo 0;
						  	//getting total response time
						  		$get_total_ave = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
						  													LEFT JOIN r_priority_type AS PRIO 
						  													ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
						  	                              				WHERE DOCUHIS.docu_tr_his_sender = '$userID'
						  	                              				and DOCUHIS.docu_tr_his_date_create between '$start' and '$end'");
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

						  		
						  		  $eval_stmnt = 'You still have not processed and transferred a document ticket!';
						  		 
						  		}
						    //getting total tickets created
						    	$gettotal_ticket =  mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
						    	                                        WHERE docu_tr_his_createdby = '$userID'
						    	                                        or docu_tr_his_sender = '$userID'
						    	                                        or docu_tr_his_receiver = '$userID'
						    	                                        or docu_tr_his_closedby = '$userID'
						    	                                        or docu_tr_his_reopenedby = '$userID' 
						    	                                        and docu_tr_his_date_create between '$start' and '$end' ");

						    	 
						    	  if ($result = $gettotal_ticket)
						    	      {
						    	      // Return the number of rows in result set
						    	      $total_count=mysqli_num_rows($result);
						    	      //echo $total_count;
						    	      }
						    	  else 
						    	      $total_count = 0;
						    	  	  //echo $total_count;	   
						    //getting response time in average
						    	$get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
						    													LEFT JOIN r_priority_type AS PRIO 
						    													ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
						    	                              				WHERE docu_tr_his_sender = '$userID'
						    	                              				or docu_tr_his_receiver = '$userID'
						    	                              				and docu_tr_his_date_create between '$start' and '$end'
						    	                              				GROUP BY DOCUHIS.docu_tr_his_ticket_no");

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
						    	}
						    	else 
						    	{
						    			$DA_RT_average = 0;
						    	}
						    	echo 
						    	'
						    	
							    		<tr class="gradeX">
							    			<td style="">'.$compname.'</td>
							    			<td style="">'.$off_name.'</td>
							    			<td style="text-align:center">'.$user_result.' </td>
							    			<td style=""><b>'.$total_count.'</b> tickets</td>
							    			<td style=""><b>'.$res_ave.'</b>%</td>
							    			<td style=""><b>'.$DA_RT_average.'</b> m</td>
							    		</tr>
						    	';
						}
						else
						{
							//getting total logs
								$view_logs = "SELECT * FROM `t_users_log` WHERE log_userID = '$userID'";
								if ($result_logs = mysqli_query($connection,$view_logs))
								    {
								    // Return the number of rows in result set
								    $user_result = mysqli_num_rows($result_logs);
								    //echo $total_count;
								    }
								else 
								    echo 0;
							//getting total response time
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

								
								  $eval_stmnt = 'You still have not processed and transferred a document ticket!';
								 
								}
							//getting total tickets created
								$gettotal_ticket =  mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
								                                        WHERE docu_tr_his_createdby = '$userID'
								                                        or docu_tr_his_sender = '$userID'
								                                        or docu_tr_his_receiver = '$userID'
								                                        or docu_tr_his_closedby = '$userID'
								                                        or docu_tr_his_reopenedby = '$userID'");

								 
								  if ($result = $gettotal_ticket)
								      {
								      // Return the number of rows in result set
								      $total_count=mysqli_num_rows($result);
								      //echo $total_count;
								      }
								  else 
								      $total_count = 0;
								  	  //echo $total_count;	
							//getting response time in average
								$get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
																				LEFT JOIN r_priority_type AS PRIO 
																				ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
								                              				WHERE docu_tr_his_sender = '$userID'
								                              				or docu_tr_his_receiver = '$userID'
								                              				GROUP BY DOCUHIS.docu_tr_his_ticket_no");

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
								}
								else
								{
										$DA_RT_average = 0;
								}
								echo 
								'
									<tr class="gradeX">
										<td style="">'.$compname.'</td>
										<td style="">'.$off_name.'</td>
										<td style="text-align:center">'.$user_result.' </td>
										<td style=""><b>'.$total_count.'</b> tickets</td>
										<td style=""><b>'.$res_ave.'</b>%</td>
										<td style=""><b>'.$DA_RT_average.'</b> m</td>
									</tr>
								';
						}
					}
				}
				else
				{
					echo 
					'
						<tr class="gradeX">
							<td style="">No data Available</td>
							<td style="">No data Available</td>
							<td style="">No data Available</td>
							<td style="">No data Available</td>
							<td style="">No data Available</td>
							<td style="">No data Available</td>
						</tr>
					';
				}
		
		}  
		else if ($office_filter  >= 1)
		{
			//Getting all users
			$getuser = mysqli_query($connection, "SELECT * FROM `t_accounts` AS ACC
														INNER JOIN `t_employees` AS EMP 
														INNER JOIN `r_office` AS OFF
														ON EMP.emp_office = OFF.office_ID
														and ACC.acc_empID = EMP.emp_ID
														WHERE acc_ID != 1 and OFF.office_ID = '$office_filter'
														");
			if(mysqli_num_rows($getuser) > 0)
			{
				while($user_row = mysqli_fetch_array($getuser))
				{
					$userID = $user_row["acc_ID"];
					$username = $user_row["acc_username"];
					$emp_lname = $user_row["emp_lastname"];
					$emp_mname = $user_row["emp_middlename"];
					$emp_fname = $user_row["emp_firstname"];

					$compname = $emp_fname.' '.$emp_lname;
					$off_name = $user_row["office_name"];

					if($_POST['StartDate'] && $_POST['EndDate'] !=NULL)
					{
					   
						$start = $_POST['StartDate'];
						$end = $_POST['EndDate'];

						//getting total logs
						  	$view_logs = "SELECT * FROM `t_users_log` WHERE log_userID = '$userID' and log_datestamp between '$start' and '$end'";
						  	if ($result_logs = mysqli_query($connection,$view_logs))
						  	    {
						  	    // Return the number of rows in result set
						  	    $user_result = mysqli_num_rows($result_logs);
						  	   	
						  	    }
						  	else 
						  	    echo 0;
					  	//getting total response time
					  		$get_total_ave = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
					  													LEFT JOIN r_priority_type AS PRIO 
					  													ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
					  	                              				WHERE DOCUHIS.docu_tr_his_sender = '$userID'
					  	                              				and DOCUHIS.docu_tr_his_date_create between '$start' and '$end'");
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

					  		
					  		  $eval_stmnt = 'You still have not processed and transferred a document ticket!';
					  		 
					  		}
					    //getting total tickets created
					    	$gettotal_ticket =  mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
					    	                                        WHERE docu_tr_his_createdby = '$userID'
					    	                                        or docu_tr_his_sender = '$userID'
					    	                                        or docu_tr_his_receiver = '$userID'
					    	                                        or docu_tr_his_closedby = '$userID'
					    	                                        or docu_tr_his_reopenedby = '$userID' 
					    	                                        and docu_tr_his_date_create between '$start' and '$end' ");

					    	 
					    	  if ($result = $gettotal_ticket)
					    	      {
					    	      // Return the number of rows in result set
					    	      $total_count=mysqli_num_rows($result);
					    	      //echo $total_count;
					    	      }
					    	  else 
					    	      $total_count = 0;
					    	  	  //echo $total_count;	   
					    //getting response time in average
					    	$get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
					    													LEFT JOIN r_priority_type AS PRIO 
					    													ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
					    	                              				WHERE docu_tr_his_sender = '$userID'
					    	                              				or docu_tr_his_receiver = '$userID'
					    	                              				and docu_tr_his_date_create between '$start' and '$end'
					    	                              				GROUP BY DOCUHIS.docu_tr_his_ticket_no");

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
					    	}
					    	else
					    	{
					    			$DA_RT_average = 0;
					    	}
					    	echo 
					    	'
					    		<tr class="gradeX">
					    			<td style="">'.$compname.'</td>
					    			<td style="">'.$off_name.'</td>
					    			<td style="text-align:center">'.$user_result.' </td>
					    			<td style=""><b>'.$total_count.'</b> tickets</td>
					    			<td style=""><b>'.$res_ave.'</b>%</td>
					    			<td style=""><b>'.$DA_RT_average.'</b> m</td>
					    		</tr>
					    	';
					}
					else
					{
						//getting total logs
							$view_logs = "SELECT * FROM `t_users_log` WHERE log_userID = '$userID'";
							if ($result_logs = mysqli_query($connection,$view_logs))
							    {
							    // Return the number of rows in result set
							    $user_result = mysqli_num_rows($result_logs);
							    //echo $total_count;
							    }
							else 
							    echo 0;
						//getting total response time
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

							
							  $eval_stmnt = 'You still have not processed and transferred a document ticket!';
							 
							}
						//getting total tickets created
							$gettotal_ticket =  mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
							                                        WHERE docu_tr_his_createdby = '$userID'
							                                        or docu_tr_his_sender = '$userID'
							                                        or docu_tr_his_receiver = '$userID'
							                                        or docu_tr_his_closedby = '$userID'
							                                        or docu_tr_his_reopenedby = '$userID'");

							 
							  if ($result = $gettotal_ticket)
							      {
							      // Return the number of rows in result set
							      $total_count=mysqli_num_rows($result);
							      //echo $total_count;
							      }
							  else 
							      $total_count = 0;
							  	  //echo $total_count;	
						//getting response time in average
							$get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
																			LEFT JOIN r_priority_type AS PRIO 
																			ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
							                              				WHERE docu_tr_his_sender = '$userID'
							                              				or docu_tr_his_receiver = '$userID'
							                              				GROUP BY DOCUHIS.docu_tr_his_ticket_no");

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
							}
							else
							{
									$DA_RT_average = 0;
							}
							echo 
							'
								<tr class="gradeX">
									<td style="">'.$compname.'</td>
									<td style="">'.$off_name.'</td>
									<td style="text-align:center">'.$user_result.' </td>
									<td style=""><b>'.$total_count.'</b> tickets</td>
									<td style=""><b>'.$res_ave.'</b>%</td>
									<td style=""><b>'.$DA_RT_average.'</b> m</td>
								</tr>
							';
					}
				}
			}
			else
			{
				echo 
				'
					<tr class="gradeX">
						<td style="">No data Available</td>
						<td style="">No data Available</td>
						<td style="">No data Available</td>
						<td style="">No data Available</td>
						<td style="">No data Available</td>
						<td style="">No data Available</td>
					</tr>
				';
			}

		}  
	}
	else
		{	

			//Getting all users
			$getuser = mysqli_query($connection, "SELECT * FROM `t_accounts` AS ACC
														INNER JOIN `t_employees` AS EMP 
														INNER JOIN `r_office` AS OFF
														ON EMP.emp_office = OFF.office_ID
														and ACC.acc_empID = EMP.emp_ID
														WHERE acc_ID != 1
														");
				if(mysqli_num_rows($getuser) > 0)
				{
					while($user_row = mysqli_fetch_array($getuser))
					{
						$userID = $user_row["acc_ID"];
						$username = $user_row["acc_username"];
						$emp_lname = $user_row["emp_lastname"];
						$emp_mname = $user_row["emp_middlename"];
						$emp_fname = $user_row["emp_firstname"];

						$compname = $emp_fname.' '.$emp_lname;
						$off_name = $user_row["office_name"];
					//getting total logs
						$view_logs = "SELECT * FROM `t_users_log` WHERE log_userID = '$userID'";
						if ($result_logs = mysqli_query($connection,$view_logs))
						    {
						    // Return the number of rows in result set
						    $user_result = mysqli_num_rows($result_logs);
						    //echo $total_count;
						    }
						else 
						    echo 0;
					//getting total response time
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

						
						  $eval_stmnt = 'You still have not processed and transferred a document ticket!';
						 
						}
					//getting total tickets created
						$gettotal_ticket =  mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
						                                        WHERE docu_tr_his_createdby = '$userID'
						                                        or docu_tr_his_sender = '$userID'
						                                        or docu_tr_his_receiver = '$userID'
						                                        or docu_tr_his_closedby = '$userID'
						                                        or docu_tr_his_reopenedby = '$userID'");

						 
						  if ($result = $gettotal_ticket)
						      {
						      // Return the number of rows in result set
						      $total_count=mysqli_num_rows($result);
						      //echo $total_count;
						      }
						  else 
						      $total_count = 0;
						  	  //echo $total_count;	
					//getting response time in average
						$get_total_speed = mysqli_query($connection, "SELECT * FROM `t_document_track_history` AS DOCUHIS
																		LEFT JOIN r_priority_type AS PRIO 
																		ON DOCUHIS.docu_tr_his_prioritytype = PRIO.priority_ID
						                              				WHERE docu_tr_his_sender = '$userID'
						                              				or docu_tr_his_receiver = '$userID'
						                              				GROUP BY DOCUHIS.docu_tr_his_ticket_no");
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
						}
						else
						{
								$DA_RT_average = 0;
						}
						echo 
						'
							<tr class="gradeX">
								<td style="">'.$compname.'</td>
								<td style="">'.$off_name.'</td>
								<td style="text-align:center">'.$user_result.' </td>
								<td style=""><b>'.$total_count.'</b> tickets</td>
								<td style=""><b>'.$res_ave.'</b>%</td>
								<td style=""><b>'.$DA_RT_average.'</b> m</td>
							</tr>
						';
					}
				}
				else
				{
					echo 
					'
						<tr class="gradeX">
							<td style="">No data Available</td>
							<td style="">No data Available</td>
							<td style="">No data Available</td>
							<td style="">No data Available</td>
							<td style="">No data Available</td>
							<td style="">No data Available</td>
						</tr>
					';
				}
		
		} 
	echo '
			</tbody>
		</table>
	';
	
?>


