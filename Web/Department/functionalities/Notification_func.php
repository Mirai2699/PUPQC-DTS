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
		echo 'Meron'; 
	}
	else
	{
	 	echo 'None';
	}
	
?>