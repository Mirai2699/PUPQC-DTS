<?php
	include("../../../db_con.php");
	if(isset($_POST['report_submit']))
	{ 
			$reporter_accID = $_POST['reporter_accID'];
			$report_desc = $_POST['report_desc'];

			$insert = "INSERT INTO t_report_bug (rb_reporter, rb_desc)     
			                         VALUES ('$reporter_accID','$report_desc')";
			      
			mysqli_query($connection,$insert);

			 echo "<script type=\"text/javascript\">".
			          "alert
			          ('You have successfully reported a bug!');".
			         "</script>";
			 echo "<script>setTimeout(\"location.href = '../views/index.php';\",0);</script>";
	}
?>