
<?php
    $view_query = mysqli_query($connection,"SELECT * FROM `t_accounts` AS ACC 
                                            INNER JOIN `r_user_role` AS USR 
                                            INNER JOIN `t_employees` AS EMP 
                                            INNER JOIN `r_office` AS OFF
                                            ON  ACC.acc_user_role = USR.usr_ID
                                            and EMP.emp_office = OFF.office_ID
                                            and ACC.acc_empID = EMP.emp_ID");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $EMP_ID = $row["emp_ID"];
        $ID = $row["acc_ID"];
        $emp_lname = $row["emp_lastname"];
        $emp_mname = $row["emp_middlename"];
        $emp_fname = $row["emp_firstname"];
        $emp_office = $row["emp_office"];
        $emp_pos = $row["emp_position"];
        $emp_pic = $row["emp_picture"];
        $acc_username = $row["acc_username"];
        $acc_password = $row["acc_password"];
        $acc_user_role = $row["acc_user_role"];
        $acc_role = $row["usr_desc"];
        $acc_mod_date = $row["acc_mod_date"];
        $acc_active_flag = $row["acc_active_flag"];

        $compname = $emp_lname.', '.$emp_fname;
        $off_name = $row["office_name"];
                    
?>

<!--EDIT ACCOUNT DETAILS-->
<div class="modal fade" id="edit<?php echo $ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:goldenrod; color: white">
                <h2 id="myModalLabel" class="modal-title" style="text-align: center">
                  <i class="fa fa-edit"></i>&nbsp;Change User Account Details
                </h2>
            </div>
            <div class="modal-body">
                <!-- START --> 
                <form role="form" action="../functionalities/update_func.php" method="POST">
                     <input type="hidden" name="acc_ID"  value="<?php echo $ID?>">
                     <input type="hidden" name="emp_ID"  value="<?php echo $EMP_ID?>">
                             <!--1st level-->
                             <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                             <div class="col-md-12" style="margin-bottom: 10px">
                               <h3>Change Employee Details</h3>
                               <hr>
                               <div class="col-md-4">
                                 <label><b>Last Name:</b></label>
                                 <input type="text" name="emp_lname" class="form-control" required value="<?php echo $emp_lname?>">
                               </div>
                               <div class="col-md-4">
                                 <label><b>Middle Name:</b></label>
                                 <input type="text" name="emp_mname" class="form-control" required value="<?php echo $emp_mname?>">
                               </div>
                               <div class="col-md-4">
                                 <label><b>First Name:</b></label>
                                 <input type="text" name="emp_fname" class="form-control" required value="<?php echo $emp_fname?>">
                               </div>
                             </div>
                             <!--2nd level-->
                             <div class="col-md-12" style="margin-bottom: 30px">
                               <div class="col-md-4">
                                 <label><b>Office Assigned:</b></label>
                                 <select name="emp_off" class="form-control" style="color: black;">
                                    <option value="<?php echo $emp_office?>" selected readonly><?php echo $off_name?></option>
                                    <?php  
                                        $sqlemp = "SELECT * FROM `r_office`";
                                        $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                          while($row = mysqli_fetch_assoc($results))
                                          {
                                            $office_ID = $row['office_ID'];
                                            $office_name = $row['office_name'];
                                    ?>
                                    <option value="<?php echo $office_ID ?>"><?php echo $office_name; ?></option>
                                    <?php } ?>
                                 </select>
                               </div>
                               <div class="col-md-4">
                                 <label><b>Position:</b></label>
                                 <input type="text" name="emp_pos" class="form-control" required value="<?php echo $emp_pos?>">
                               </div>
                               <div class="col-md-4">
                                 <label><b>Profile Picture:</b></label>
                                 <input type="file" name="emp_pic" class="form">
                               </div>
                             </div>
                             <!--3rd level-->
                             <div class="col-md-12" style="margin-bottom: 30px">
                               <h3>Change User Account Credentials</h3>
                               <hr>
                               <div class="col-md-3">
                                 <label><b>Username:</b></label>
                                 <input type="text" name="acc_username" class="form-control" required value="<?php echo $acc_username?>">
                               </div>
                               <div class="col-md-3">
                                 <label><b>User Role:</b></label>
                                 <select name="acc_usr" class="form-control" style="color: black;">
                                    <option value="<?php echo $acc_user_role?>" selected readonly><?php echo $acc_role?></option>
                                    <?php  
                                        $sqlemp = "SELECT * FROM `r_user_role`";
                                        $results = mysqli_query($connection, $sqlemp) or die("Bad Query: $sql");
                                          while($row = mysqli_fetch_assoc($results))
                                          {
                                            $usr_ID = $row['usr_ID'];
                                            $usr_desc = $row['usr_desc'];
                                    ?>
                                    <option value="<?php echo $usr_ID ?>"><?php echo $usr_desc; ?></option>
                                    <?php } ?>
                                 </select>
                               </div>
                               <div class="col-md-3">
                                 <label><b>Password:</b></label>
                                 <input id="password" type="password" name="acc_password" class="form-control" required value="<?php echo $acc_password?>">
                               </div>
                               <div class="col-md-3">
                                 <label><b>Confirm Password:</b></label>
                                 <input id="confirmPassword" type="password" name="acc_conpassword" class="form-control" required value="<?php echo $acc_password?>">
                               </div>
                                
                             </div>

                             <div class="col-md-12" style="text-align: center">
                                 <div class="row" style="padding: 1px; margin-bottom: 10px; background-color: #6e6e6e"></div>
                                 <button type="submit" class="btn btn-info" name="edit_account" style="margin-top: 4px">
                                     <i class="fa fa-save"></i>
                                     Save
                                 </button>
                                 &nbsp;&nbsp;
                                 <button class="btn btn-danger" data-dismiss="modal" style="margin-top: 4px">
                                     <i class="fa fa-times"></i>
                                     Cancel
                                 </button>
                             </div>
                 </form>
                <!--END-->

            </div>
            <div class="modal-footer">
              
            </div>
        </div>
    </div>
</div>

<!--CHANGE ACCOUNT STATUS-->
<div class="modal fade" id="archive<?php echo $ID?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #800000; color: white">
                <h2 id="myModalLabel" class="modal-title" style="text-align: center">
                  Change Account Status
                </h2>
            </div>
            <div class="modal-body">
                <!-- START --> 
                <center>
                  <p style="font-size: 15px">Changing the status of this account will affect its right of access.</p>
                  <p style="font-size: 15px">Active status will allow the user of this account to use and access the system; while disabling it will not allow the user to use and access the system</p>
                  <p style="font-size: 15px">Are you sure you want to proceed?</p>
                  <form action="../functionalities/archive_func.php" method="POST">
                     
                        <input type="hidden" name="ID" value="<?php echo $ID?>" />
                        <div class="col-md-12">
                               <select name="acc_status" class="form-control" style="color: black; width: 50%">
                                   <option value="Active" selected>Active</option>
                                   <option value="Disabled">Disable</option>
                               </select>
                               <br>
                              <button type="submit" name="archive_account" class="btn btn-success" style="font-size: 18px">
                                <i class="fa fa-check" data-s="14" data-c="white"></i>
                                Confirm
                              </button>
                              &nbsp;&nbsp;&nbsp;
                              <a data-dismiss="modal" class="btn btn-danger" style="font-size: 18px">
                                <i class="fa fa-times" data-s="14" data-c="white"></i>
                                Cancel
                              </a>     
                        </div>
                  </form>
                </center>
              <!--END-->

            </div>
            <div class="modal-footer">
              
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--START ON PAGE SCRIPT-->

    <!--Show Password-->
        <script type="text/javascript">
        function showAccPassword()
        {
          var pass = document.getElementById('acc_password');
          var confpass = document.getElementById('acc_conpassword');
          if(document.getElementById('checked').checked)
          {
            pass.setAttribute('type','text');
            confpass.setAttribute('type','text');
          }
          else
          {
            pass.setAttribute('type','password');
            confpass.setAttribute('type','password');
          }  
        }    
        </script>

    <!--Password Validation-->

        <script type="text/javascript">
            var password = document.getElementById("acc_password")
           ,confirmPassword = document.getElementById("acc_conpassword");

            function validatePassword()
            {
              if(password.value != confirmPassword.value) 
              {
                confirmPassword.setCustomValidity("Passwords Don't Match");
                $('#myform').on('submit', function(ev) 
                {
                    $('#myModal').modal('show');
                });

              } else 
              {
                confirmPassword.setCustomValidity(''); 
              }
            }

            password.onchange = validatePassword;
            confirmPassword.onkeyup = validatePassword;
        </script>
        
<!--END OF ON PAGE SCRIPT-->