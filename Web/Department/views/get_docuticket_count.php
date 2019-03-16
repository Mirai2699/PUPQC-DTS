<?php
	include("../../../db_con.php");

	$userID = $_SESSION['UserID'];
	//$userID = 3;


	
	$gettotal =  "SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
	                                        WHERE docu_tr_his_createdby = '$userID'
	                                        or docu_tr_his_sender = '$userID'
	                                        or docu_tr_his_receiver = '$userID'
	                                        or docu_tr_his_closedby = '$userID'
	                                        or docu_tr_his_reopenedby = '$userID'";

	  if ($result=mysqli_query($connection,$gettotal))
	      {
	      // Return the number of rows in result set
	      $total_count=mysqli_num_rows($result);
	      //echo $total_count;
	      }
	  else 
	      $total_count = 0;
	  	  //echo $total_count;


	  $getcreated =  "SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
	                                          WHERE docu_tr_his_createdby = '$userID'";

	    if ($result1=mysqli_query($connection,$getcreated))
	        {
	        // Return the number of rows in result set
	        $create_count=mysqli_num_rows($result1);
	        //echo $create_count;
	        }
	    else 
	        echo 0;

	  $getsent =  "SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
	                                          WHERE docu_tr_his_sender = '$userID'";

	    if ($result2=mysqli_query($connection,$getsent))
	        {
	        // Return the number of rows in result set
	        $sent_count=mysqli_num_rows($result2);
	        //echo $sent_count;
	        }
	    else 
	        echo 0;

	    $getreceive =  "SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
	                                            WHERE docu_tr_his_receiver = '$userID'";

	      if ($result3=mysqli_query($connection,$getreceive))
	          {
	          // Return the number of rows in result set
	          $receive_count=mysqli_num_rows($result3);
	          //echo $receive_count;
	          }
	      else 
	          echo 0;

	    $getclosed =  "SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
	                                            WHERE docu_tr_his_closedby = '$userID'";

	      if ($result4=mysqli_query($connection,$getclosed))
	          {
	          // Return the number of rows in result set
	          $closed_count=mysqli_num_rows($result4);
	          //echo $closed_count;
	          }
	      else 
	          echo 0;


	      $getreopen =  "SELECT DISTINCT docu_tr_his_ticket_no FROM `t_document_track_history` 
	                                              WHERE docu_tr_his_reopenedby = '$userID'";

	        if ($result5=mysqli_query($connection,$getreopen))
	            {
	            // Return the number of rows in result set
	            $reopen_count=mysqli_num_rows($result5);
	            //echo $reopen_count;
	            }
	        else 
	            echo 0;
?>