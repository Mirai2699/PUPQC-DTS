<?php 

	$view_logs = mysqli_query($connection,"SELECT * FROM `t_users_log` WHERE log_userID = '$userID'");
	if ($result_logs=mysqli_query($connection,$view_logs))
	    {
	    // Return the number of rows in result set
	    $user_result=mysqli_num_rows($result_logs);
	    //echo $total_count;
	    }
	else 
	    echo 0;

?>