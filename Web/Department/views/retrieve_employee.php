<?php 

  include('../../../db_con.php') ;
  $va = $_GET['category'];
  $option ='';
  $sql = "SELECT * FROM `t_employees` WHERE emp_office = '".$va."'";
  $results = mysqli_query($connection, $sql) or die("Bad Query: $sql"); 
  while($row = mysqli_fetch_assoc($results))
         {  

           $emp_ID = $row["emp_ID"];
           $emp_lname = $row["emp_lastname"];
           $emp_fname = $row["emp_firstname"];
           $emp_pos = $row["emp_position"];
            $emp_compname = $emp_fname.' '.$emp_lname;
            $option = $option. "<option name='docu_new_rec' value='$emp_ID'>$emp_compname</option>";
         }                                                                 

    echo json_encode(
            array("option" => $option)
       );
?>