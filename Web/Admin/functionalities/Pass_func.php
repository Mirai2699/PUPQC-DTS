<?php
    include('../../../db_con.php');

      $No = $_POST['ID'];
      //oldpass = $_POST['OldPass'];
      $pass = $_POST['Pass'];
      $conpass = $_POST['ConPass'];
      

      $check_query =  mysqli_query($connection,"SELECT * FROM t_accounts WHERE acc_ID = '$No'");
      while($row = mysqli_fetch_array($check_query))
      {
        $curr_pass = $row["acc_password"];
        //echo $curr_pass;
      
      }
        
          
            $query = mysqli_query($connection,"UPDATE t_accounts SET acc_password = '$pass' WHERE acc_ID = '$No'");
                                                                                     
            echo "<script type=\"text/javascript\">".
                   "alert
                   ('Your Password have been changed!');".
                 "</script>";
            echo "<script>setTimeout(\"location.href = '../views/index.php';\",0);</script>";
          
      
    
?>


