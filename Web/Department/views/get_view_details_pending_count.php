
<?php

		$userID = $_SESSION['UserID'];
	

	    $view_pending_query = mysqli_query($connection,"SELECT DISTINCT docu_tr_ticket_no FROM `t_document_track` 
			                                              WHERE docu_tr_createdby = '$userID' 
			                                              	or docu_tr_sender = '$userID'
			                                              	or docu_tr_receiver= '$userID'
			                                                and docu_tr_status = 'OPEN'");

	    $total_pencount = mysqli_num_rows($view_pending_query);
	    echo $total_pencount;
?>


