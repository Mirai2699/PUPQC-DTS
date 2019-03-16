<?php
    include('../../../db_con.php');

      if(isset($_POST['edit_account']))
      { 
            
            $emp_lname = $_POST['emp_lname'];
            $emp_mname = $_POST['emp_mname'];
            $emp_fname = $_POST['emp_fname'];
            $emp_off = $_POST['emp_off'];
            $emp_pos = $_POST['emp_pos'];
            $emp_pic = $_POST['emp_pic'];

            $acc_username = $_POST['acc_username'];
            $acc_password = $_POST['acc_password'];
            $acc_usr = $_POST['acc_usr'];


            $EMP_ID = $_POST["emp_ID"];
            $ID = $_POST["acc_ID"];

            $update1 = "UPDATE t_employees SET 

                        emp_lastname = '$emp_lname',
                        emp_middlename = '$emp_mname',
                        emp_firstname = '$emp_fname',
                        emp_office = '$emp_off',
                        emp_position = '$emp_pos',
                        emp_picture = '$emp_pic',
                        emp_mod_date = CURRENT_TIMESTAMP

                      WHERE emp_ID = '$EMP_ID'";

            $update2 = "UPDATE t_accounts SET 

                        acc_username = '$acc_username',
                        acc_password = '$acc_password',
                        acc_user_role = '$acc_usr',
                        acc_mod_date = CURRENT_TIMESTAMP

                      WHERE acc_ID = '$ID'";
                  
             mysqli_query($connection,$update1);
             mysqli_query($connection,$update2);

             echo "<script type=\"text/javascript\">".
                      "alert
                      ('You have successfully updated the details!');".
                     "</script>";
             echo "<script>setTimeout(\"location.href = '../views/manage_users.php';\",0);</script>";

      }


      else if(isset($_POST['edit_office']))
      { 
          
          
          $office_name = $_POST['office_name'];

          $ID = $_POST["ID"];
          $update = "UPDATE r_office SET 

                      office_name = '$office_name',
                      office_timestamp = CURRENT_TIMESTAMP

                    WHERE office_ID = '$ID'";
                
          mysqli_query($connection,$update);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully updated the details!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_department.php';\",0);</script>";

      }

      else if(isset($_POST['edit_docutype']))
      { 
          
          
          $docutype_name = $_POST['docutype_name'];

          $ID = $_POST["ID"];
          $update = "UPDATE r_document_type SET 

                      docutype_desc = '$docutype_name',
                      docutype_timestamp = CURRENT_TIMESTAMP

                    WHERE docutype_ID = '$ID'";
                
          mysqli_query($connection,$update);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully updated the details!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_docu_type.php';\",0);</script>";

      }

      else if(isset($_POST['edit_src']))
      { 
           
          $src_name = $_POST['src_name'];

          $ID = $_POST["ID"];
          $update = "UPDATE r_source_type SET 

                      source_desc = '$src_name',
                      source_timestamp = CURRENT_TIMESTAMP

                    WHERE source_ID = '$ID'";
                
          mysqli_query($connection,$update);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully updated the details!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_source_type.php';\",0);</script>";

      }

      else if(isset($_POST['edit_prio']))
      { 
           
          $prio_name = $_POST['prio_name'];
          $prio_date_count = $_POST['prio_date_count'];

          $ID = $_POST["ID"];
          $update = "UPDATE r_priority_type SET 

                      priority_desc = '$prio_name',
                      priority_date_count = '$prio_date_count',
                      priority_timestamp = CURRENT_TIMESTAMP

                    WHERE priority_ID = '$ID'";
                
          mysqli_query($connection,$update);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully updated the details!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_priority_type.php';\",0);</script>";

      }

      
?>


