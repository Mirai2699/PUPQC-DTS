<?php
	include("../../../db_con.php");


	$view_docu = mysqli_query($connection,"SELECT * FROM t_document_track AS DOCU
													INNER JOIN r_priority_type AS PRIO
													ON DOCU.docu_tr_prioritytype = PRIO.priority_ID
													WHERE docu_tr_ID = 1");
	while($get_row = mysqli_fetch_array($view_docu))
	{
		$docu_tr_prioritytype = $get_row["docu_tr_prioritytype"];
		$docu_tr_date_create = $get_row["docu_tr_date_create"];		
		$priority_date_count = $get_row["priority_date_count"];
		
		$daysLeft = 0;
		$curDate = date('Y-m-d');
		$daysLeft = abs(strtotime($curDate) - strtotime($docu_tr_date_create));
		$days = $daysLeft/(60 * 60 * 24);
		 
	}

		
?>