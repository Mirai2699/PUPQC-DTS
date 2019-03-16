<?php
    
    include("../utilities/Header.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    

?>    
      <title>PUPQC-DTS | Add User</title>
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                      <h2 style="margin-top: 15px">Add User Account</h2>
                      <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 50px; width: 100%"></div> 
             </div>
            <!--END BREADCRUMBS-->


            <!--START INNER CONTENT-->
            <!--START BODY CONTENT-->
            <div class="row" style="background-color: white">
              <div class="col-md-12">
                <div class="box-info">
                  
                  <div class="col-md-12">
                    <div class="panel-heading" style="background-color: #002846; ">
                        <h4 style="color: white; font-size: 25px">Add User Account</h4>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                    </div>
                    <form action="../functionalities/insert_func.php" method="POST">
                      <!--1st level-->
                      <div class="row" id="SPACER" style="margin-top: 10px; "></div>
                      <div class="col-md-12" style="margin-bottom: 10px">
                        <h3>Add Employee Details</h3>
                        <hr>
                        <div class="col-md-4">
                          <label><b>Last Name:</b></label>
                          <input type="text" name="emp_lname" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                          <label><b>Middle Name:</b></label>
                          <input type="text" name="emp_mname" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                          <label><b>First Name:</b></label>
                          <input type="text" name="emp_fname" class="form-control" required>
                        </div>
                      </div>
                      <!--2nd level-->
                      <div class="col-md-12" style="margin-bottom: 30px">
                        <div class="col-md-4">
                          <label><b>Office Assigned:</b></label>
                          <select name="emp_off" class="form-control" style="color: black;">
                             <option value="" selected disabled>-- Select Office --</option>
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
                          <input type="text" name="emp_pos" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                          <label><b>Profile Picture:</b></label>
                          <input type="file" name="emp_pic" class="form">
                        </div>
                      </div>
                      <!--3rd level-->
                      <div class="col-md-12" style="margin-bottom: 30px">
                        <h3>Add User Account Credentials</h3>
                        <hr>
                        <div class="col-md-3">
                          <label><b>Username:</b></label>
                          <input type="text" name="acc_username" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                          <label><b>User Role:</b></label>
                          <select name="acc_usr" class="form-control" style="color: black;">
                             <option value="" selected disabled>-- Select User Role --</option>
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
                          <input id="acc_password" type="password" name="acc_password" class="form-control input-frield" required="" data-toggle="password" maxlength="50" />
                        </div>
                        <div class="col-md-3">
                          <label><b>Confirm Password:</b></label>
                          <input style="color: black;" id="acc_confirmPassword" type="password" name="acc_conpassword" class="form-control" required="" maxlength="50" />
                        </div>
                         
                      </div>
                      <!--3rd level-->
                      <div class="col-md-12" style="margin-bottom: 10px">
                        <div class="row" style="padding:1px; background-color: #262626; margin: 15px"></div>
                        <div class="col-md-10" style="text-align: right">
                            <button type="button" class="btn btn-primary" id="showPassword" onclick="show()">
                              <i class="fa fa-eye"></i>&nbsp;
                              Show password
                            </button>
                        </div>
                        <div class="col-md-2" style="text-align: right">
                          <button class="btn btn-info" type="submit" name="acc_reg"><i class="fa  fa-pencil-square-o"></i>Register Account</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--END BODY CONTENT-->
            <!--END INNER CONTENT-->


          </section>
       </div>
       <!--END CONTENT-->       
      </div>
      <!--END WRAPPER-->
<!--ON PAGE SCRIPT-->

<!--Show Password-->
<script type="text/javascript">
function showPass()
{
  var password = document.getElementById('acc_password');
  var confpassword = document.getElementById('acc_confirmPassword');
  if(document.getElementById('checking').checked)
  {
    password.setAttribute('type','text');
    confpassword.setAttribute('type','text');
  }
  else
  {
    password.setAttribute('type','password');
    confpassword.setAttribute('type','password');
  }  
}     
function show(checkbox) {
   if ($("input[type='password']").attr('type') == 'password') {
      $("input[type='password']").attr('type','text');
   }
   else
   {
    $("input[type='password']").attr('type','password');
    $("input[id='acc_password']").attr('type','password');
    $("input[id='acc_confirmPassword']").attr('type','password');
   }
}
</script>
<!--Password Validation-->
<script type="text/javascript">
    var password = document.getElementById("acc_password")
   ,confirmPassword = document.getElementById("acc_confirmPassword");

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

</body>
</html>
