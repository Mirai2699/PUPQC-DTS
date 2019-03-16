<?php
    include('../../../db_con.php');

    if(isset($_POST['acc_reg']))
      { 
          
          
          $code_ret = mysqli_query($connection, "SELECT MAX(emp_ID) FROM t_employees");
          $getrow = mysqli_fetch_array($code_ret);
          $lastcount = $getrow[0];
          $finalID = $lastcount + 1;


          $emp_lname = $_POST['emp_lname'];
          $emp_mname = $_POST['emp_mname'];
          $emp_fname = $_POST['emp_fname'];
          $emp_off = $_POST['emp_off'];
          $emp_pos = $_POST['emp_pos'];
          $emp_pic = $_POST['emp_pic'];

          $acc_username = $_POST['acc_username'];
          $acc_password = $_POST['acc_password'];
          $acc_usr = $_POST['acc_usr'];


          $insertemp = "INSERT INTO t_employees (emp_lastname, emp_middlename, emp_firstname, emp_office, emp_position, emp_picture)     
                     VALUES ('$emp_lname', '$emp_mname', '$emp_fname', '$emp_off', '$emp_pos', '$emp_pic')";

          $insertacc = "INSERT INTO t_accounts (acc_empID, acc_username, acc_password, acc_user_role)     
                     VALUES ('$finalID', '$acc_username', '$acc_password', '$acc_usr')";
            
           mysqli_query($connection,$insertemp);   
           mysqli_query($connection,$insertacc);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully registered an account');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_users.php';\",0);</script>";

      }


    else if(isset($_POST['add_office']))
      { 
          
          $office_name = $_POST['office_name'];

          $insert = "INSERT INTO r_office (office_name 
                                          )     
                                   VALUES ('$office_name'
                                          )";
                
          mysqli_query($connection,$insert);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully added an office!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_department.php';\",0);</script>";

      }

      else if(isset($_POST['add_docu_type']))
      { 
          
          $docu_type = $_POST['docu_type_desc'];

          $insert = "INSERT INTO r_document_type (docutype_desc 
                                                  )     
                                           VALUES ('$docu_type'
                                                  )";
                
          mysqli_query($connection,$insert);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully added a document type!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_docu_type.php';\",0);</script>";

      }

      else if(isset($_POST['add_src_type']))
      { 
          
          $src_type = $_POST['srctype_desc'];

          $insert = "INSERT INTO r_source_type (source_desc 
                                                  )     
                                           VALUES ('$src_type'
                                                  )";
                
          mysqli_query($connection,$insert);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully added a source type!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_source_type.php';\",0);</script>";

      }

      else if(isset($_POST['add_prior_type']))
      { 
          
          $prio_desc = $_POST['prio_desc'];
          $prio_date_count = $_POST['prio_date_count'];

          $insert = "INSERT INTO r_priority_type (priority_desc,
                                                  priority_date_count
                                                  )     
                                           VALUES ('$prio_desc',
                                                   '$prio_date_count'
                                                  )";
                
          mysqli_query($connection,$insert);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully added a priority type!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_priority_type.php';\",0);</script>";

      }
?>


