
<?php
	
	include("../../../db_con.php");

		//session_start();
		$userID = 11;

	    $view_create = mysqli_query($connection,"SELECT DISTINCT day(docu_tr_his_timestamp) as day FROM `t_document_track_history` 
	                                                WHERE docu_tr_his_createdby = '$userID' 
	                                                  and docu_tr_his_timestamp BETWEEN '2019-03-01' and '2019-03-30' ");
	    while($row_speed = mysqli_fetch_assoc($view_create))
		{
		    $days = $row_speed['day'];

		    $view_create1 = mysqli_query($connection,"SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
	                                                WHERE docu_tr_his_createdby = '$userID' 
	                                                  and day(docu_tr_his_timestamp) = '$days'");
		    $total_count1 = mysqli_num_rows($view_create1);
		    echo $total_count1.'<br>';

		}

?>


