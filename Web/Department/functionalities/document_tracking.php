<?php 
	
	include("../../../db_con.php");


	if(isset($_POST['acc_docu_ticket']))
	{ 
	      
	      $userID = $_POST['docu_accID'];

	      $docu_ticket_no = $_POST['docu_ticket_no'];
	      $docu_source_type = $_POST['docu_source_type'];
	      $docu_priority_type = $_POST['docu_priority_type'];

	      $docu_doctype = $_POST['docu_doctype'];
	      $docu_from_office = $_POST['docu_from_office'];
	      $docu_subject = $_POST['docu_subject'];
	      $docu_desc = $_POST['docu_desc'];
	      $docu_signatory = $_POST['docu_signatory'];

	      if(!empty($_POST['docu_ext_source']))
	      {
	         $docu_ext_source = $_POST['docu_ext_source'];
	      }
	      else
	      {
	        $docu_ext_source = '';
	      }
	      

	      date_default_timezone_set("Asia/Manila"); 
	      $timein = date('H:i:s');
	      $datein = date('Y-m-d');



	      $insert_docu_ticket = "INSERT INTO t_document_track(docu_tr_ticket_no, 
				      										 docu_tr_doctype, 
				      										 docu_tr_sourcetype, 
				      										 docu_tr_ext_source_desc,
				      										 docu_tr_prioritytype, 
				      										 docu_tr_from_office, 
				      										 docu_tr_subject, 
				      										 docu_tr_desc, 
				      										 docu_tr_asignatory,
				      										 docu_tr_createdby,
				      										 docu_tr_date_create,
				      										 docu_tr_time_create, 
				      										 docu_tr_action)  

				                                     VALUES ('$docu_ticket_no', 
				                                     		 '$docu_doctype', 
				                                     		 '$docu_source_type', 
				                                     		 '$docu_ext_source', 
				                                     		 '$docu_priority_type', 
				                                     		 '$docu_from_office',
				                                     		 '$docu_subject', 
				                                     		 '$docu_desc', 
				                                     		 '$docu_signatory',
				                                     		 '$userID', 
				                                     		 '$datein',
				                                     		 '$timein',
				                                     		 'Created')";

		      $insert_docu_history = "INSERT INTO t_document_track_history(docu_tr_his_ticket_no, 
					      										 docu_tr_his_doctype, 
					      										 docu_tr_his_sourcetype, 
					      										 docu_tr_his_ext_source_desc, 
					      										 docu_tr_his_prioritytype, 
					      										 docu_tr_his_from_office, 
					      										 docu_tr_his_subject, 
					      										 docu_tr_his_desc, 
					      										 docu_tr_his_asignatory,
					      										 docu_tr_his_createdby,
					      										 docu_tr_his_date_create,
					      										 docu_tr_his_time_create, 
					      										 docu_tr_his_action)  

					                                     VALUES ('$docu_ticket_no', 
					                                     		 '$docu_doctype', 
					                                     		 '$docu_source_type', 
					                                     		 '$docu_ext_source', 
					                                     		 '$docu_priority_type', 
					                                     		 '$docu_from_office',
					                                     		 '$docu_subject', 
					                                     		 '$docu_desc', 
					                                     		 '$docu_signatory',
					                                     		 '$userID', 
					                                     		 '$datein',
					                                     		 '$timein',
					                                     		 'Created')";

		 

	      
	       mysqli_query($connection,$insert_docu_ticket);   
	       mysqli_query($connection,$insert_docu_history);   

		       echo "<script type=\"text/javascript\">".
		                "alert
		                ('You have successfully created a document ticket');".
		               "</script>";
		       echo "<script>setTimeout(\"location.href = '../views/ticket_review.php?getID=$docu_ticket_no';\",0);</script>";
	}  

	else if(isset($_POST['transfer_docu']))
	{ 
	      
	      $userID = $_POST['accID'];
	      $docu_ID = $_POST['docu_ID'];
	      $docu_ticket_no = $_POST['docu_ticketno'];
	      $docu_docutypeID = $_POST['docu_docutypeID'];
	      $docu_sourcetypeID = $_POST['docu_sourcetypeID'];
	      $docu_priotypeID = $_POST['docu_priotypeID'];
	      $docu_tr_date_create = $_POST['docu_tr_date_create'];
	      $docu_tr_time_create = $_POST['docu_tr_time_create'];
	     
	      $docu_status = $_POST['docu_status'];
	      $docu_off_fr = $_POST['docu_creator_office_ID'];
	      $docu_signatory = $_POST['docu_signatory'];
	      $docu_creator = $_POST['docu_creator_ID'];


	      $docu_subject = $_POST['docu_subject'];
	      $docu_desc = $_POST['docu_desc'];
	      $docu_new_office_to = $_POST['docu_new_office_to'];
	      $docu_new_remarks = $_POST['docu_new_remarks'];

	      date_default_timezone_set("Asia/Manila"); 
	      $timein = date('H:i:s');
	      $datein = date('Y-m-d');

	      $daysLeft = 0;
	      $curDate = date('Y-m-d');
	      $daysLeft = abs(strtotime($curDate) - strtotime($docu_tr_date_create));
	      $date_processed = $daysLeft/(60 * 60 * 24);

	      if(!empty($_POST['docu_ext_source']))
	      {
	         $docu_ext_source = $_POST['docu_ext_source'];
	      }
	      else
	      {
	        $docu_ext_source = '';
	      }

	


	     	$updatequery = "UPDATE t_document_track SET 
	     										   docu_tr_to_office = '$docu_new_office_to',
	     										   docu_tr_count_date_process = '$date_processed',
	     										   docu_tr_remarks = '$docu_new_remarks',
	     										   docu_tr_sender = '$userID',
	     										   docu_tr_date_sent = '$datein',
	     										   docu_tr_time_sent = '$timein',
	     										   docu_tr_status = 'OPEN',
	     										   docu_tr_action = 'Reviewed and Transferred',
	     										   docu_tr_receiving_stat = 1,
	     										   docu_tr_notif_stat = 1

	     									WHERE docu_tr_ticket_no = '$docu_ticket_no'";
				     										




		     $insert_docu_history = "INSERT INTO t_document_track_history(docu_tr_his_ticket_no, 
		  		      										 docu_tr_his_doctype, 
		  		      										 docu_tr_his_sourcetype, 
		  		      										 docu_tr_his_ext_source_desc, 
		  		      										 docu_tr_his_prioritytype, 
		  		      										 docu_tr_his_count_date_process,
		  		      										 docu_tr_his_from_office, 
		  		      										 docu_tr_his_to_office,
		  		      										 docu_tr_his_subject, 
		  		      										 docu_tr_his_desc, 
		  		      										 docu_tr_his_remarks,
		  		      										 docu_tr_his_asignatory,
		  		      										 docu_tr_his_createdby,
		  		      										 docu_tr_his_sender, 
		  		      										 docu_tr_his_date_create, 
		  		      										 docu_tr_his_time_create,
		  		      										 docu_tr_his_date_sent, 
		  		      										 docu_tr_his_time_sent,
		  		      										 docu_tr_his_receiving_stat,
		  		      										 docu_tr_his_notif_stat, 
		  		      										 docu_tr_his_action)  

		  		                                     VALUES ('$docu_ticket_no', 
		  		                                    		 '$docu_docutypeID', 
		  		                                     		 '$docu_sourcetypeID', 
		  		                                     		 '$docu_ext_source', 
		  		                                     		 '$docu_priotypeID', 
		  		                                			 '$date_processed',
		  		                                     		 '$docu_off_fr',
		  		                                     		 '$docu_new_office_to',
		  		                                     		 '$docu_subject', 
		  		                                     		 '$docu_desc', 
		  		                                     		 '$docu_new_remarks', 
		  		                                     		 '$docu_signatory',
		  		                                			 '$docu_creator',
		  		                                     		 '$userID', 
		  		                                     		 '$docu_tr_date_create', 
		  		                                     		 '$docu_tr_time_create', 
		  		                                     		 '$datein',
		  		                                     		 '$timein',
		  		                                     		 '1',
		  		                                     		 '1',
		  		                                     		 'Reviewed and Transferred')";

		   mysqli_query($connection,$updatequery); 
	       mysqli_query($connection,$insert_docu_history);   

 		       echo "<script type=\"text/javascript\">".
		                "alert
		                ('You have successfully transfered the document!');".
		               "</script>";
		       echo "<script>setTimeout(\"location.href = '../views/view_pending.php';\",0);</script>";
	}

	else if(isset($_POST['close_ticket']))
	{
			
		    $docu_ticketno = $_POST['docu_ticketno'];
		    $userID = $_POST['acc_ID'];
		    $closing_remarks = $_POST['closing_remarks'];
		    
		    $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
		                                                   INNER JOIN `t_accounts` AS ACC
		                                                   INNER JOIN `t_employees` AS EMP
		                                                   INNER JOIN `r_document_type` AS TYPE
		                                                   INNER JOIN `r_source_type` AS SRC
		                                                   INNER JOIN `r_priority_type` AS PRIO
		                                                   ON DOCU.docu_tr_createdby = ACC.acc_empID
		                                                   and ACC.acc_empID = EMP.emp_ID
		                                                   and TYPE.docutype_ID = DOCU.docu_tr_doctype
		                                                   and SRC.source_ID = DOCU.docu_tr_sourcetype
		                                                   and PRIO.priority_ID = DOCU.docu_tr_prioritytype
		                                                   WHERE DOCU.docu_tr_ticket_no = '$docu_ticketno'");

		    
		    while($row = mysqli_fetch_array($view_query))
		    {
		        //Document Tracking 
		        $docu_tr_ID = $row["docu_tr_ID"];
		        $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
		        $docu_tr_subject = $row["docu_tr_subject"];
		        $docu_tr_desc = $row["docu_tr_desc"];
		        $docu_tr_from_office = $row["docu_tr_from_office"];
		        $docu_tr_status = $row["docu_tr_status"];
		        $docu_tr_asignatory = $row["docu_tr_asignatory"];
		        $docu_tr_createdby = $row["docu_tr_createdby"];

		        if(!empty($row['docu_tr_ext_source_desc']))
		        {
		           $docu_tr_ext_source_desc = $row["docu_tr_ext_source_desc"];
		        }
		        else
		        {
		           $docu_tr_ext_source_desc = '';
		        }
		        if(!empty($row['docu_tr_remarks']))
		        {
		           $docu_tr_remarks = $row["docu_tr_remarks"];
		        }
		        else
		        {
		          $docu_tr_remarks = '';
		        }
		        if(!empty($row['docu_tr_to_office']))
		        {
		           $docu_tr_to_office = $row["docu_tr_to_office"];
		        }
		        else
		        {
		          $docu_tr_to_office = '';
		        }
		        if(!empty($row['docu_tr_count_date_process']))
		        {
		           $docu_tr_count_date_process = $row["docu_tr_count_date_process"];
		        }
		        else
		        {
		          $docu_tr_count_date_process = 0;
		        }
		        if(!empty($row['docu_tr_receiving_stat']))
		        {
		           $docu_tr_receiving_stat = $row["docu_tr_receiving_stat"];
		        }
		        else
		        {
		          $docu_tr_receiving_stat = 0;
		        }
		        //Employee IDs
		       


		        if(!empty($row['docu_tr_sender']))
		        {
		           
		           $docu_tr_sender = $row["docu_tr_sender"];
		           $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
		           $docu_tr_time_sent = new datetime($row["docu_tr_time_sent"]);
		           $date_newsent = $docu_tr_date_sent->format('Y-m-d');
		           $time_newsent = $docu_tr_time_sent->format('H:i:s');
		        }
		        else
		        {
		          $docu_tr_sender = '';
		          $date_newsent = '';
		          $time_newsent = '';

		        }


		        if(!empty($row['docu_tr_receiver']))
		        {
		           
		           $docu_tr_receiver = $row["docu_tr_receiver"];
		           $docu_date_receiver = new datetime($row["docu_tr_date_received"]);
		           $docu_time_receiver = new datetime($row["docu_tr_time_received"]);
		           $date_newreceive = $docu_date_receiver->format('Y-m-d');
		           $time_newreceive = $docu_time_receiver->format('H:i:s');
		        }
		        else
		        {
		          $docu_tr_receiver = '';
		          $date_newreceive = '';
		          $time_newreceive = '';
		        }

		        //Docu Type
		        $docutype_desc = $row['docutype_desc'];
		        $source_desc = $row["source_desc"];
		        $priority_desc = $row["priority_desc"];

		        //Docu Type (IDs)
		        $docu_tr_typeID = $row['docu_tr_doctype'];
		        $source_ID = $row["docu_tr_prioritytype"];
		        $priority_ID = $row["docu_tr_sourcetype"];
		    
		        //Date Entities
		        $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
		        $docu_tr_time_create = new datetime($row["docu_tr_time_create"]);

		        $date_create = $docu_tr_date_create->format('F d, Y');
		        $time_create = $docu_tr_time_create->format('h:i a');


		        $date_notnew = $docu_tr_date_create->format('Y-m-d');
		        $time_notnew = $docu_tr_time_create->format('H:i:s');


		    }

		    //Office Created At
			    $getoffice_creator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
			                                                    INNER JOIN `r_office` AS OFF
			                                                    ON EMP.emp_office = OFF.office_ID
			                                            WHERE EMP.emp_ID = '$docu_tr_from_office'");
			    while($create_off_row = mysqli_fetch_array($getoffice_creator))
			    {

			      //Office Naming
			      $created_office_ID = $create_off_row["office_ID"];
			      $created_office_name = $create_off_row["office_name"];
			      
			    }


		    //For Creator
		      $getcreator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
		                                                      INNER JOIN `r_office` AS OFF
		                                                      ON EMP.emp_office = OFF.office_ID
		                                              WHERE EMP.emp_ID = ' $docu_tr_createdby'");
		       while($creator_row = mysqli_fetch_array($getcreator))
		       {

		         //Office Naming
		         $creator_office_ID = $creator_row["office_ID"];
		         $creator_office_name = $creator_row["office_name"];

		         //Employee Naming
		         $creator_ID = $creator_row["emp_ID"];
		         $creator_fname = $creator_row["emp_firstname"];
		         $creator_lname = $creator_row["emp_lastname"];
		         $creator_position = $creator_row["emp_position"];
		         $creator_compname = $creator_fname.' '.$creator_lname;
		         $creator_disp = $creator_compname.', '.$creator_position;
		         
		       }
		    

		    //For Sender
		    if(!empty($row['docu_tr_sender']))
		    {
			      $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
			                                                      INNER JOIN `r_office` AS OFF
			                                                      ON EMP.emp_office = OFF.office_ID
			                                              WHERE EMP.emp_ID = '$docu_tr_sender'");
			      if(mysqli_num_rows($getsender) > 0)
			      {
			       while($sender_row = mysqli_fetch_array($getsender))
			       {

			         //Office Naming
			         $sender_office_ID = $sender_row["office_ID"];
			         $sender_office_name = $sender_row["office_name"];

			         //Employee Naming
			         $sender_ID = $sender_row["emp_ID"];
			         $sender_fname = $sender_row["emp_firstname"];
			         $sender_lname = $sender_row["emp_lastname"];
			         $sender_position = $sender_row["emp_position"];
			         $sender_compname = $sender_fname.' '.$sender_lname;
			         $sender_disp = $sender_compname.', '.$sender_position;
			         
			       }
			      }
			      else
			      {
			         $send_office_name = 'N/A';
			         //Employee Naming
			         $send_fname = 'N/A';
			         $send_lname = 'N/A';  
			         $send_compname = 'N/A';
			         $sender_disp = 'N/A';
			      }	    
		    }
		    else
		    {
		    	$sender_ID = '';
		    }

		    //For Reciever
		    if(!empty($row['docu_tr_receiver']))
		    {
			      $getreceive = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
			                                                      INNER JOIN `r_office` AS OFF
			                                                      ON EMP.emp_office = OFF.office_ID
			                                              WHERE EMP.emp_ID = '$docu_tr_receiver'");
			      if(mysqli_num_rows($getreceive) > 0)
			      {
			        while($receive_row = mysqli_fetch_array($getreceive))
			        {

			          //Office Naming
			          $receive_office_name = $receive_row["office_name"];

			          //Employee Naming
			          $receive_ID = $receive_row["emp_ID"];
			          $receive_fname = $receive_row["emp_firstname"];
			          $receive_lname = $receive_row["emp_lastname"];
			          $receive_compname = $receive_fname.' '.$sender_lname;
			        
			        }
			      }
			      else
			      {
			         $receive_office_name = 'N/A';
			         //Employee Naming
			         $receive_fname = 'N/A';
			         $receive_lname = 'N/A';  
			         $receive_compname = 'N/A';	
			      }
		    }
		    else
		    {
		       $receive_ID = '';
		    }


		    date_default_timezone_set("Asia/Manila"); 
		    $timein = date('H:i:s');
		    $datein = date('Y-m-d');


		    $updatequery = "UPDATE t_document_track SET 

		    						docu_tr_closing_remarks = '$closing_remarks',
		    						docu_tr_closedby = '$userID',
		    						docu_tr_date_done = '$datein',
		    						docu_tr_time_done = '$timein',
		    						docu_tr_action = 'Closed',
		    						docu_tr_status = 'CLOSED',
		    						docu_tr_receiving_stat = 0,
		    						docu_tr_notif_stat = 0

		    				WHERE docu_tr_ticket_no = '$docu_ticketno'";


		
		   		 $insert_docu_history = "INSERT INTO t_document_track_history(docu_tr_his_ticket_no, 
		    				      										 docu_tr_his_doctype, 
		    				      										 docu_tr_his_sourcetype, 
		    				      										 docu_tr_his_ext_source_desc,
		    				      										 docu_tr_his_prioritytype, 
		    				      										 docu_tr_his_count_date_process,
		    				      										 docu_tr_his_receiving_stat,
		    				      										 docu_tr_his_from_office, 
		    				      										 docu_tr_his_to_office,
		    				      										 docu_tr_his_subject, 
		    				      										 docu_tr_his_desc, 
		    				      										 docu_tr_his_remarks,
		    				      										 docu_tr_his_closing_remarks,
		    				      										 docu_tr_his_asignatory,
		    				      										 docu_tr_his_createdby,
		    				      										 docu_tr_his_sender,
		    				      										 docu_tr_his_receiver,
		    				      										 docu_tr_his_closedby,
		    				      										 docu_tr_his_date_create,
		    				      										 docu_tr_his_time_create,
		    				      										 docu_tr_his_date_sent,
		    				      										 docu_tr_his_time_sent,
		    				      										 docu_tr_his_date_received,
		    				      										 docu_tr_his_time_received, 
		    				      										 docu_tr_his_date_done,
		    				      										 docu_tr_his_time_done, 
		    				      										 docu_tr_his_status,
		    				      										 docu_tr_his_action)  

		    				                                     VALUES ('$docu_ticketno', 
		    				                                     		 '$docu_tr_typeID', 
		    				                                     		 '$source_ID', 
		    				                                     		 '$docu_tr_ext_source_desc',
		    				                                     		 '$priority_ID', 
		    				                                     		 '$docu_tr_count_date_process',
		    				                                     		 '$docu_tr_receiving_stat',
		    				                                     		 '$docu_tr_from_office',
		    				                                     		 '$docu_tr_to_office',
		    				                                     		 '$docu_tr_subject', 
		    				                                     		 '$docu_tr_desc', 
		    				                                     		 '$docu_tr_remarks',
		    				                                     		 '$closing_remarks',
		    				                                     		 '$docu_tr_asignatory',
		    				                                     		 '$creator_ID',
		    				                                     		 '$sender_ID',
		    				                                     		 '$receive_ID', 
		    				                                     		 '$userID',
		    				                                     		 '$date_notnew',
		    				                                     		 '$time_notnew',
		    				                                     		 '$date_newsent',
		    				                                     		 '$time_newsent',
		    				                                     		 '$date_newreceive',	
		    				                                     		 '$time_newreceive',
		    				                                     		 '$datein',
		    				                                     		 '$timein',
		    				                                     		 'CLOSED',
		    				                                     		 'Closed')";



		    	 		 $inserts_docu_history = "INSERT INTO t_document_track_history(docu_tr_his_ticket_no, 
		    	  				      										 docu_tr_his_doctype, 
		    	  				      										 docu_tr_his_sourcetype, 
		    	  				      										 docu_tr_his_ext_source_desc,
		    	  				      										 docu_tr_his_prioritytype, 
		    	  				      										 docu_tr_his_receiving_stat,
		    	  				      										 docu_tr_his_from_office, 
		    	  				      										 docu_tr_his_subject, 
		    	  				      										 docu_tr_his_desc, 
		    	  				      										 docu_tr_his_closing_remarks,
		    	  				      										 docu_tr_his_asignatory,
		    	  				      										 docu_tr_his_createdby,
		    	  				      										 docu_tr_his_closedby,
		    	  				      										 docu_tr_his_date_create,
		    	  				      										 docu_tr_his_time_create,
		    	  				      										 docu_tr_his_date_done,
		    	  				      										 docu_tr_his_time_done, 
		    	  				      										 docu_tr_his_status,
		    	  				      										 docu_tr_his_action)  

		    	  				                                     VALUES ('$docu_ticketno', 
		    	  				                                     		 '$docu_tr_typeID', 
		    	  				                                     		 '$source_ID', 
		    	  				                                     		 '$docu_tr_ext_source_desc',
		    	  				                                     		 '$priority_ID', 
		    	  				                                     		 '$docu_tr_receiving_stat',
		    	  				                                     		 '$docu_tr_from_office',
		    	  				                                     		 '$docu_tr_subject', 
		    	  				                                     		 '$docu_tr_desc', 
		    	  				                                     		 '$closing_remarks',
		    	  				                                     		 '$docu_tr_asignatory',
		    	  				                                     		 '$creator_ID',
		    	  				                                     		 '$userID',
		    	  				                                     		 '$date_notnew',
		    	  				                                     		 '$time_notnew',
		    	  				                                     		 '$datein',
		    	  				                                     		 '$timein',
		    	  				                                     		 'CLOSED',
		    	  				                                     		 'Closed')";



		    
		    mysqli_query($connection,$updatequery);
		    //mysqli_query($connection,$insert_docu_history); 
		    mysqli_query($connection,$inserts_docu_history);  
		    	echo "<script type=\"text/javascript\">".
		             "alert
		             ('You have successfully closed the document ticket!');".
		            "</script>";
		        echo "<script>setTimeout(\"location.href = '../views/ticket_review.php?getID=$docu_ticketno' ;\",0);</script>";
	}

	else if(isset($_POST['reopen_ticket']))
	{ 
				//POSTED
			    $docu_ticketno = $_POST['docu_ticketno'];
			    $userID = $_POST['accID'];
			    $docu_tr_subject = $_POST["docu_subject"];
			    $docu_tr_desc = $_POST["docu_desc"];
			    $docu_tr_asignatory = $_POST["docu_signatory"];
			    $docu_tr_typeID = $_POST['docu_docutypeID'];
			    $source_ID = $_POST["docu_sourcetypeID"];
			    $priority_ID = $_POST["docu_priotypeID" ];


			    $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
			                                                   INNER JOIN `t_accounts` AS ACC
			                                                   INNER JOIN `t_employees` AS EMP
			                                                   INNER JOIN `r_document_type` AS TYPE
			                                                   INNER JOIN `r_source_type` AS SRC
			                                                   INNER JOIN `r_priority_type` AS PRIO
			                                                   ON DOCU.docu_tr_createdby = ACC.acc_empID
			                                                   and ACC.acc_empID = EMP.emp_ID
			                                                   and TYPE.docutype_ID = DOCU.docu_tr_doctype
			                                                   and SRC.source_ID = DOCU.docu_tr_sourcetype
			                                                   and PRIO.priority_ID = DOCU.docu_tr_prioritytype
			                                                   WHERE DOCU.docu_tr_ticket_no = '$docu_ticketno'");

			    
			        while($row = mysqli_fetch_array($view_query))
			        {
			            //Document Tracking 
			            $docu_tr_ID = $row["docu_tr_ID"];
			            $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
			            //$docu_tr_subject = $row["docu_tr_subject"];
			            //$docu_tr_desc = $row["docu_tr_desc"];
			            $docu_tr_from_office = $row["docu_tr_from_office"];
			            $docu_tr_status = $row["docu_tr_status"];
			            //$docu_tr_asignatory = $row["docu_tr_asignatory"];
			            $docu_tr_createdby = $row["docu_tr_createdby"];
			            $docu_tr_closedby = $row["docu_tr_closedby"];
			            $docu_tr_closing_remarks = $row['docu_tr_closing_remarks'];
			            
			           	if(!empty($row['docu_tr_ext_source_desc']))
			           	{
			           	   $docu_tr_ext_source_desc = $row["docu_tr_ext_source_desc"];
			           	}
			           	else
			           	{
			           	   $docu_tr_ext_source_desc = '';
			           	}
			            if(!empty($row['docu_tr_remarks']))
			            {
			               $docu_tr_remarks = $row["docu_tr_remarks"];
			            }
			            else
			            {
			              $docu_tr_remarks = '';
			            }
			            if(!empty($row['docu_tr_to_office']))
			            {
			               $docu_tr_to_office = $row["docu_tr_to_office"];
			            }
			            else
			            {
			              $docu_tr_to_office = '';
			            }
			            if(!empty($row['docu_tr_count_date_process']))
			            {
			               $docu_tr_count_date_process = $row["docu_tr_count_date_process"];
			            }
			            else
			            {
			              $docu_tr_count_date_process = 0;
			            }
			            if(!empty($row['docu_tr_receiving_stat']))
			            {
			               $docu_tr_receiving_stat = $row["docu_tr_receiving_stat"];
			            }
			            else
			            {
			              $docu_tr_receiving_stat = 0;
			            }
			            //Employee IDs
			           


			            if(!empty($row['docu_tr_sender']))
			            {
			               
			               $docu_tr_sender = $row["docu_tr_sender"];
			               $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
			               $docu_tr_time_sent = new datetime($row["docu_tr_time_sent"]);
			               $date_newsent = $docu_tr_date_sent->format('Y-m-d');
			               $time_newsent = $docu_tr_time_sent->format('H:i:s');
			            }
			            else
			            {
			              $docu_tr_sender = '';
			              $date_newsent = '';
			              $time_newsent = '';

			            }


			            if(!empty($row['docu_tr_receiver']))
			            {
			               
			               $docu_tr_receiver = $row["docu_tr_receiver"];
			               $docu_date_receiver = new datetime($row["docu_tr_date_received"]);
			               $docu_time_receiver = new datetime($row["docu_tr_time_received"]);
			               $date_newreceive = $docu_date_receiver->format('Y-m-d');
			               $time_newreceive = $docu_time_receiver->format('H:i:s');
			            }
			            else
			            {
			              $docu_tr_receiver = '';
			              $date_newreceive = '';
			              $time_newreceive = '';
			            }
			           	if(!empty($row['docu_tr_date_done']))
			           	{
			           	   
			           	   $docu_tr_done = $row["docu_tr_closedby"];
			           	   $docu_date_done = new datetime($row["docu_tr_date_done"]);
			           	   $docu_time_done = new datetime($row["docu_tr_time_done"]);
			           	   $date_newdone = $docu_date_done->format('Y-m-d');
			           	   $time_newdone = $docu_time_done->format('H:i:s');
			           	}
			           	else
			           	{
			           	  $docu_tr_done = '';
			           	  $date_newdone = '';
			           	  $time_newdone = '';
			           	}

			            //Docu Type
			            $docutype_desc = $row['docutype_desc'];
			            $source_desc = $row["source_desc"];
			            $priority_desc = $row["priority_desc"];

			            //Docu Type (IDs)
			            // $docu_tr_typeID = $row['docu_tr_doctype'];
			            // $source_ID = $row["docu_tr_prioritytype"];
			            // $priority_ID = $row["docu_tr_sourcetype"];
			        
			            //Date Entities
			            $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
			            $docu_tr_time_create = new datetime($row["docu_tr_time_create"]);

			            $date_create = $docu_tr_date_create->format('F d, Y');
			            $time_create = $docu_tr_time_create->format('h:i a');


			            $date_notnew = $docu_tr_date_create->format('Y-m-d');
			            $time_notnew = $docu_tr_time_create->format('H:i:s');


			        }

			        //Office Created At
			    	    $getoffice_creator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
			    	                                                    INNER JOIN `r_office` AS OFF
			    	                                                    ON EMP.emp_office = OFF.office_ID
			    	                                            WHERE EMP.emp_ID = '$docu_tr_from_office'");
			    	    while($create_off_row = mysqli_fetch_array($getoffice_creator))
			    	    {

			    	      //Office Naming
			    	      $created_office_ID = $create_off_row["office_ID"];
			    	      $created_office_name = $create_off_row["office_name"];
			    	      
			    	    }

			        //For Creator
			          $getcreator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
			                                                          INNER JOIN `r_office` AS OFF
			                                                          ON EMP.emp_office = OFF.office_ID
			                                                  WHERE EMP.emp_ID = ' $docu_tr_createdby'");
			           while($creator_row = mysqli_fetch_array($getcreator))
			           {

			             //Office Naming
			             $creator_office_ID = $creator_row["office_ID"];
			             $creator_office_name = $creator_row["office_name"];

			             //Employee Naming
			             $creator_ID = $creator_row["emp_ID"];
			             $creator_fname = $creator_row["emp_firstname"];
			             $creator_lname = $creator_row["emp_lastname"];
			             $creator_position = $creator_row["emp_position"];
			             $creator_compname = $creator_fname.' '.$creator_lname;
			             $creator_disp = $creator_compname.', '.$creator_position;
			             
			           }
			     
			        //For Sender
				        if(!empty($row['docu_tr_sender']))
				        {
				    	      $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
				    	                                                      INNER JOIN `r_office` AS OFF
				    	                                                      ON EMP.emp_office = OFF.office_ID
				    	                                              WHERE EMP.emp_ID = '$docu_tr_sender'");
				    	      if(mysqli_num_rows($getsender) > 0)
				    	      {
				    	       while($sender_row = mysqli_fetch_array($getsender))
				    	       {

				    	         //Office Naming
				    	         $sender_office_ID = $sender_row["office_ID"];
				    	         $sender_office_name = $sender_row["office_name"];

				    	         //Employee Naming
				    	         $sender_ID = $sender_row["emp_ID"];
				    	         $sender_fname = $sender_row["emp_firstname"];
				    	         $sender_lname = $sender_row["emp_lastname"];
				    	         $sender_position = $sender_row["emp_position"];
				    	         $sender_compname = $sender_fname.' '.$sender_lname;
				    	         $sender_disp = $sender_compname.', '.$sender_position;
				    	         
				    	       }
				    	      }
				    	      else
				    	      {
				    	         $send_office_name = 'N/A';
				    	         //Employee Naming
				    	         $send_fname = 'N/A';
				    	         $send_lname = 'N/A';  
				    	         $send_compname = 'N/A';
				    	         $sender_disp = 'N/A';
				    	      }	    
				        }
				        else
				        {
				        	$sender_ID = '';
				        }
			        
			        //For Reciever
				        if(!empty($row['docu_tr_receiver']))
				        {
				    	      $getreceive = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
				    	                                                      INNER JOIN `r_office` AS OFF
				    	                                                      ON EMP.emp_office = OFF.office_ID
				    	                                              WHERE EMP.emp_ID = '$docu_tr_receiver'");
				    	      if(mysqli_num_rows($getreceive) > 0)
				    	      {
				    	        while($receive_row = mysqli_fetch_array($getreceive))
				    	        {

				    	          //Office Naming
				    	          $receive_office_name = $receive_row["office_name"];

				    	          //Employee Naming
				    	          $receive_ID = $receive_row["emp_ID"];
				    	          $receive_fname = $receive_row["emp_firstname"];
				    	          $receive_lname = $receive_row["emp_lastname"];
				    	          $receive_compname = $receive_fname.' '.$sender_lname;
				    	        
				    	        }
				    	      }
				    	      else
				    	      {
				    	         $receive_office_name = 'N/A';
				    	         //Employee Naming
				    	         $receive_fname = 'N/A';
				    	         $receive_lname = 'N/A';  
				    	         $receive_compname = 'N/A';
				    	      }
				        }
				        else
				        {
				           $receive_ID = '';
				        }
					
					//For Closer
				        if(!empty($row['docu_tr_closedby']))
				        {
				       	      $getcloser = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
				       	                                                      INNER JOIN `r_office` AS OFF
				       	                                                      ON EMP.emp_office = OFF.office_ID
				       	                                              WHERE EMP.emp_ID = '$docu_tr_closedby'");
				       	      if(mysqli_num_rows($getcloser) > 0)
				       	      {
				       	        while($closer_row = mysqli_fetch_array($getcloser))
				       	        {

				       	          //Office Naming
				       	          $closer_office_name = $closer_row["office_name"];

				       	          //Employee Naming
				       	          $closer_ID = $closer_row["emp_ID"];
				       	          $closer_fname = $closer_row["emp_firstname"];
				       	          $closer_lname = $closer_row["emp_lastname"];
				       	          $closer_compname = $closer_fname.' '.$sender_lname;
				       	        
				       	        }
				       	      }
				       	      else
				       	      {
				       	         $closer_office_name = 'N/A';
				       	         //Employee Naming
				       	         $closer_fname = 'N/A';
				       	         $closer_lname = 'N/A';  
				       	         $closer_compname = 'N/A';
				       	      }
				        }
				        else
				        {
				           $closer_ID = '';
				        }


			    date_default_timezone_set("Asia/Manila"); 
			    $timein = date('H:i:s');
			    $datein = date('Y-m-d');


			    $updatequery = "UPDATE t_document_track SET 


			    						docu_tr_doctype = '$docu_tr_typeID',
			    						docu_tr_sourcetype = '$source_ID',
			    						docu_tr_prioritytype = '$priority_ID',
			    						docu_tr_subject = '$docu_tr_subject',
			    						docu_tr_desc = '$docu_tr_desc',
			    						docu_tr_asignatory = '$docu_tr_asignatory',
			    						docu_tr_reopenedby = '$userID',
			    						docu_tr_date_reopened = '$datein',
			    						docu_tr_time_reopened = '$timein',
			    						docu_tr_action = 'Re-Opened',
			    						docu_tr_status = 'OPEN',
			    						docu_tr_receiving_stat = 0,
			    						docu_tr_notif_stat = 0

			    				WHERE docu_tr_ticket_no = '$docu_ticketno'";

	

				$inserts_docu_history = "INSERT INTO t_document_track_history(docu_tr_his_ticket_no, 
								      										 docu_tr_his_doctype, 
								      										 docu_tr_his_sourcetype, 
								      										 docu_tr_his_ext_source_desc,
								      										 docu_tr_his_prioritytype, 
								      										 docu_tr_his_from_office, 
								      										 docu_tr_his_subject, 
								      										 docu_tr_his_desc, 
								      										 docu_tr_his_closing_remarks,
								      										 docu_tr_his_asignatory,
								      										 docu_tr_his_createdby,
								      										 docu_tr_his_closedby,
								      										 docu_tr_his_reopenedby,
								      										 docu_tr_his_date_create,
								      										 docu_tr_his_time_create,
								      										 docu_tr_his_date_done,
								      										 docu_tr_his_time_done, 
								      										 docu_tr_his_date_reopened,
								      										 docu_tr_his_time_reopened,
								      										 docu_tr_his_status,
								      										 docu_tr_his_action)  

								                                     VALUES ('$docu_ticketno', 
								                                     		 '$docu_tr_typeID', 
								                                     		 '$source_ID', 
								                                     		 '$docu_tr_ext_source_desc',
								                                     		 '$priority_ID', 
								                                     		 '$docu_tr_from_office',
								                                     		 '$docu_tr_subject', 
								                                     		 '$docu_tr_desc', 
								                                     		 '$docu_tr_closing_remarks',
								                                     		 '$docu_tr_asignatory',
								                                     		 '$creator_ID',
								                                     		 '$closer_ID',
								                                     		 '$userID',
								                                     		 '$date_notnew',
								                                     		 '$time_notnew',
								                                     		 '$date_newdone',
								                                     		 '$time_newdone',
								                                     		 '$datein',
								                                     		 '$timein',
								                                     		 'OPEN',
								                                     		 'Re-Opened')";



			    
			    mysqli_query($connection,$updatequery);
			    mysqli_query($connection,$inserts_docu_history);
			    echo "<script type=\"text/javascript\">".
			             "alert
			             ('You have successfully re-opened the document ticket!');".
			            "</script>";
			    echo "<script>setTimeout(\"location.href = '../views/ticket_review.php?getID=$docu_ticketno' ;\",0);</script>";
	}

	else if(isset($_GET['getID'])) 
	{   
	    	session_start();
	        $docu_ticketno = $_GET['getID'];
	        $userID = $_SESSION['UserID'];
	        
	        $view_query = mysqli_query($connection,"SELECT * FROM `t_document_track` AS DOCU
	                                                       INNER JOIN `t_accounts` AS ACC
	                                                       INNER JOIN `t_employees` AS EMP
	                                                       INNER JOIN `r_document_type` AS TYPE
	                                                       INNER JOIN `r_source_type` AS SRC
	                                                       INNER JOIN `r_priority_type` AS PRIO
	                                                       ON DOCU.docu_tr_createdby = ACC.acc_empID
	                                                       and ACC.acc_empID = EMP.emp_ID
	                                                       and TYPE.docutype_ID = DOCU.docu_tr_doctype
	                                                       and SRC.source_ID = DOCU.docu_tr_sourcetype
	                                                       and PRIO.priority_ID = DOCU.docu_tr_prioritytype
	                                                       WHERE DOCU.docu_tr_ticket_no = '$docu_ticketno'");

	        
	        while($row = mysqli_fetch_array($view_query))
	        {
	            //Document Tracking 
	            $docu_tr_ID = $row["docu_tr_ID"];
	            $docu_tr_ticket_no = $row["docu_tr_ticket_no"];
	            $docu_tr_subject = $row["docu_tr_subject"];
	            $docu_tr_desc = $row["docu_tr_desc"];
	            $docu_tr_from_office = $row["docu_tr_from_office"];
	            $docu_tr_to_office = $row["docu_tr_to_office"];
	            $docu_tr_remarks = $row["docu_tr_remarks"];
	            $docu_tr_status = $row["docu_tr_status"];
	            $docu_tr_asignatory = $row["docu_tr_asignatory"];

	            //$docu_tr_count_date_process = $row["docu_tr_count_date_process"];
	            $docu_tr_receiving_stat = $row["docu_tr_receiving_stat"];


	            //Employee IDs
	            $docu_tr_createdby = $row["docu_tr_createdby"];
	            $docu_tr_sender = $row["docu_tr_sender"];
	            $docu_tr_receiver = $row["docu_tr_receiver"];

	            //Docu Type
	            $docutype_desc = $row['docutype_desc'];
	            $source_desc = $row["source_desc"];
	            $priority_desc = $row["priority_desc"];
	            $docu_tr_ext_source_desc = $row["docu_tr_ext_source_desc"];

	            //Docu Type (IDs)
	            $docu_tr_typeID = $row['docu_tr_doctype'];
	            $source_ID = $row["docu_tr_prioritytype"];
	            $priority_ID = $row["docu_tr_sourcetype"];
	        
	            //Date Entities
	            $docu_tr_date_create = new datetime($row["docu_tr_date_create"]);
	            $docu_tr_time_create = new datetime($row["docu_tr_time_create"]);

	            $docu_tr_date_sent = new datetime($row["docu_tr_date_sent"]);
	            $docu_tr_time_sent = new datetime($row["docu_tr_time_sent"]);

	            $docu_date_reopen = new datetime($row["docu_tr_date_reopened"]);
	            $docu_time_reopen = new datetime($row["docu_tr_time_reopened"]);

	            $docu_date_receiver = new datetime($row["docu_tr_date_received"]);
	            $docu_time_receiver = new datetime($row["docu_tr_time_received"]);
	            
	            $date_reopen = $docu_date_reopen->format('F d, Y');
	            $time_reopen = $docu_time_reopen->format('h:i a');

	            $date_create = $docu_tr_date_create->format('F d, Y');
	            $time_create = $docu_tr_time_create->format('h:i a');

	            $date_sent = $docu_tr_date_sent->format('F d, Y');
	            $time_sent = $docu_tr_time_sent->format('h:i a');


	            $date_notnew = $docu_tr_date_create->format('Y-m-d');
	            $time_notnew = $docu_tr_time_create->format('H:i:s');
	            $date_newsent = $docu_tr_date_sent->format('Y-m-d');
	            $time_newsent = $docu_tr_time_sent->format('H:i:s');
	            $date_newreceive = $docu_date_receiver->format('Y-m-d');
	            $time_newreceive = $docu_time_receiver->format('H:i:s');

	            $DTsent = $date_sent.', '.$time_sent;
	            $DTcreate = $date_create.', '.$time_create;
	            $DTreopen = $date_reopen.', '.$time_reopen;





	        }

	        $daysLeft = 0;
	        $curDate = date('Y-m-d');
	        $daysLeft = abs(strtotime($curDate) - strtotime($date_newsent));
	        $date_processed = $daysLeft/(60 * 60 * 24);

	        //Office Created At
	        $getoffice_creator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
	                                                        INNER JOIN `r_office` AS OFF
	                                                        ON EMP.emp_office = OFF.office_ID
	                                                WHERE EMP.emp_ID = '$docu_tr_from_office'");
	        while($create_off_row = mysqli_fetch_array($getoffice_creator))
	        {

	          //Office Naming
	          $created_office_ID = $create_off_row["office_ID"];
	          $created_office_name = $create_off_row["office_name"];
	          
	        }



	        //For Creator
	          $getcreator = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
	                                                          INNER JOIN `r_office` AS OFF
	                                                          ON EMP.emp_office = OFF.office_ID
	                                                  WHERE EMP.emp_ID = ' $docu_tr_createdby'");
	           while($creator_row = mysqli_fetch_array($getcreator))
	           {

	             //Office Naming
	             $creator_office_ID = $creator_row["office_ID"];
	             $creator_office_name = $creator_row["office_name"];

	             //Employee Naming
	             $creator_ID = $creator_row["emp_ID"];
	             $creator_fname = $creator_row["emp_firstname"];
	             $creator_lname = $creator_row["emp_lastname"];
	             $creator_position = $creator_row["emp_position"];
	             $creator_compname = $creator_fname.' '.$creator_lname;
	             $creator_disp = $creator_compname.', '.$creator_position;
	             
	           }
	        

	        //For Sender
	          $getsender = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
	                                                          INNER JOIN `r_office` AS OFF
	                                                          ON EMP.emp_office = OFF.office_ID
	                                                  WHERE EMP.emp_ID = '$docu_tr_sender'");
	          if(mysqli_num_rows($getsender) > 0)
	          {
	           while($sender_row = mysqli_fetch_array($getsender))
	           {

	             //Office Naming
	             $sender_office_ID = $sender_row["office_ID"];
	             $sender_office_name = $sender_row["office_name"];

	             //Employee Naming
	             $sender_ID = $sender_row["emp_ID"];
	             $sender_fname = $sender_row["emp_firstname"];
	             $sender_lname = $sender_row["emp_lastname"];
	             $sender_position = $sender_row["emp_position"];
	             $sender_compname = $sender_fname.' '.$sender_lname;
	             $sender_disp = $sender_compname.', '.$sender_position;
	             
	           }
	          }
	          else
	          {
	             $send_office_name = 'N/A';
	             //Employee Naming
	             $send_fname = 'N/A';
	             $send_lname = 'N/A';  
	             $send_compname = 'N/A';
	             $sender_disp = 'N/A';
	          }
	        


	        //For Reciever
	          $getreceive = mysqli_query($connection, "SELECT * FROM `t_employees` AS EMP 
	                                                          INNER JOIN `r_office` AS OFF
	                                                          ON EMP.emp_office = OFF.office_ID
	                                                  WHERE EMP.emp_ID = '$docu_tr_receiver'");
	          if(mysqli_num_rows($getreceive) > 0)
	          {
	            while($receive_row = mysqli_fetch_array($getreceive))
	            {

	              //Office Naming
	              $receive_office_name = $receive_row["office_name"];

	              //Employee Naming
	              $receive_fname = $receive_row["emp_firstname"];
	              $receive_lname = $receive_row["emp_lastname"];
	              $receive_compname = $receive_fname.' '.$sender_lname;
	            
	            }
	          }
	          else
	          {
	             $receive_office_name = 'N/A';
	             //Employee Naming
	             $receive_fname = 'N/A';
	             $receive_lname = 'N/A';  
	             $receive_compname = 'N/A';
	          }


	        date_default_timezone_set("Asia/Manila"); 
	        $timein = date('H:i:s');
	        $datein = date('Y-m-d');


	        $updatequery = "UPDATE t_document_track SET 

	        						docu_tr_receiver = '$userID',
	        						docu_tr_date_received = '$datein',
	        						docu_tr_time_received = '$timein',
	        						docu_tr_action = 'Received',
	        						docu_tr_receiving_stat = 0,
	        						docu_tr_notif_stat = 0

	        				WHERE docu_tr_ticket_no = '$docu_ticketno'";

	        $insert_docu_history = "INSERT INTO t_document_track_history(docu_tr_his_ticket_no, 
	        				      										 docu_tr_his_doctype, 
	        				      										 docu_tr_his_sourcetype, 
	        				      										 docu_tr_his_ext_source_desc,
	        				      										 docu_tr_his_prioritytype, 
	        				      										 docu_tr_his_count_date_process,
	        				      										 docu_tr_his_receiving_stat,
	        				      										 docu_tr_his_from_office, 
	        				      										 docu_tr_his_to_office,
	        				      										 docu_tr_his_subject, 
	        				      										 docu_tr_his_desc, 
	        				      										 docu_tr_his_remarks,
	        				      										 docu_tr_his_asignatory,
	        				      										 docu_tr_his_createdby,
	        				      										 docu_tr_his_sender,
	        				      										 docu_tr_his_receiver,
	        				      										 docu_tr_his_date_create,
	        				      										 docu_tr_his_time_create,
	        				      										 docu_tr_his_date_sent,
	        				      										 docu_tr_his_time_sent,
	        				      										 docu_tr_his_date_received,
	        				      										 docu_tr_his_time_received, 
	        				      										 docu_tr_his_action)  

	        				                                     VALUES ('$docu_ticketno', 
	        				                                     		 '$docu_tr_typeID', 
	        				                                     		 '$source_ID', 
	        				                                     		 '$docu_tr_ext_source_desc',
	        				                                     		 '$priority_ID', 
	        				                                     		 '$date_processed',
	        				                                     		 '$docu_tr_receiving_stat',
	        				                                     		 '$docu_tr_from_office',
	        				                                     		 '$docu_tr_to_office',
	        				                                     		 '$docu_tr_subject', 
	        				                                     		 '$docu_tr_desc', 
	        				                                     		 '$docu_tr_remarks',
	        				                                     		 '$docu_tr_asignatory',
	        				                                     		 '$creator_ID',
	        				                                     		 '$sender_ID',
	        				                                     		 '$userID', 
	        				                                     		 '$date_notnew',
	        				                                     		 '$time_notnew',
	        				                                     		 '$date_newsent',
	        				                                     		 '$time_newsent',
	        				                                     		 '$datein',	
	        				                                     		 '$timein',
	        				                                     		 'Received')";



	        
	        mysqli_query($connection,$updatequery);
	        mysqli_query($connection,$insert_docu_history);  
	        echo "<script type=\"text/javascript\">".
	                 "alert
	                 ('You have successfully opened the document ticket!');".
	                "</script>";
	        echo "<script>setTimeout(\"location.href = '../views/ticket_review.php?getID=$docu_ticketno' ;\",0);</script>";
	}
		 				
?>