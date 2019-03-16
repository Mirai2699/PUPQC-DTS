
<?php
	
	include("../../../db_con.php");

		//session_start();
		$userID = $_SESSION['UserID'];
	

	    $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
	                                              INNER JOIN `t_accounts` AS ACC
	                                              ON DOCU.docu_tr_createdby = ACC.acc_ID
	                                              OR DOCU.docu_tr_sender = ACC.acc_ID
	                                              OR DOCU.docu_tr_receiver = ACC.acc_ID
	                                              WHERE DOCU.docu_tr_createdby = '$userID' 
	                                              	or DOCU.docu_tr_sender = '$userID'
	                                              	or DOCU.docu_tr_receiver= '$userID'
	                                                and DOCU.docu_tr_status = 'OPEN'");
	    $total_count = mysqli_num_rows($view_query);
	    echo $total_count;
?>


