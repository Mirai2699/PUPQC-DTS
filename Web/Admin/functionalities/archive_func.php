<?php
    include('../../../db_con.php');


      if(isset($_POST['archive_account']))
      { 
          
          $ID = $_POST["ID"];
          $stat = $_POST["acc_status"];

          $archive = "UPDATE t_accounts SET 

                      acc_mod_date = CURRENT_TIMESTAMP,
                      acc_active_flag = '$stat'

                    WHERE acc_ID = '$ID'";
                
          mysqli_query($connection,$archive);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully disabled the account!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_users.php';\",0);</script>";

      }

      else if(isset($_POST['archive_office']))
      { 
          

          $ID = $_POST["ID"];
          $archive = "UPDATE r_office SET 

                      office_timestamp = CURRENT_TIMESTAMP,
                      office_stat = 0

                    WHERE office_ID = '$ID'";
                
          mysqli_query($connection,$archive);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully archived the record!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_department.php';\",0);</script>";

      }

      else if(isset($_POST['archive_docutype']))
      { 
          

          $ID = $_POST["ID"];
          $archive = "UPDATE r_document_type SET 

                      docutype_timestamp = CURRENT_TIMESTAMP,
                      docutype_stat = 0

                    WHERE docutype_ID = '$ID'";
                
          mysqli_query($connection,$archive);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully archived the record!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_docu_type.php';\",0);</script>";

      }

      else if(isset($_POST['archive_src']))
      { 
          

          $ID = $_POST["ID"];
          $archive = "UPDATE r_source_type SET 

                      source_timestamp = CURRENT_TIMESTAMP,
                      source_stat = 0

                    WHERE source_ID = '$ID'";
                
          mysqli_query($connection,$archive);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully archived the record!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_source_type.php';\",0);</script>";

      }

      else if(isset($_POST['archive_prio']))
      { 
          

          $ID = $_POST["ID"];
          $archive = "UPDATE r_priority_type SET 

                      priority_timestamp = CURRENT_TIMESTAMP,
                      priority_stat = 0

                    WHERE priority_ID = '$ID'";
                
          mysqli_query($connection,$archive);

           echo "<script type=\"text/javascript\">".
                    "alert
                    ('You have successfully archived the record!');".
                   "</script>";
           echo "<script>setTimeout(\"location.href = '../views/manage_priority_type.php';\",0);</script>";

      }
?>