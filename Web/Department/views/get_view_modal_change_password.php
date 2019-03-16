
<!--CHANGE PASSWORD-->
<div id="Change" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #6e6e6e; color: white">
                <h4 class="modal-title" style="font-size: 25px; "><i  class="fa fa-key"></i>   Change Password</h4>
            </div>
            <div class="modal-body" style="height:270px;">
                <form role="form" method="POST" action="../functionalities/Pass_func.php">
                    <div class="col-md-12">
                            <?php  
                             include('../../../db_con.php');

                              $sql = "SELECT * FROM t_accounts  WHERE acc_username = '".$_SESSION['Logged_In']."'";
                              $result = mysqli_query($connection, $sql);
                              while ($row = mysqli_fetch_array($result)) 
                               { 
                                 $uid = $row['acc_ID'];
                                 $uuser = $row['acc_username'];
                                 $upass = $row['acc_password'];
                                                       
                            ?>

                            <input style="color: black;" type="text" name="ID" class="hidden" required="" maxlength="25" value="<?php echo $uid; ?>" />
                              <?php  } ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-size: 15px">New Password:</label>
                                    <input style="color: black;" id="password" type="password" name="Pass" class="form-control input-frield" required="" data-toggle="password" maxlength="50" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-size: 15px">Confirm Password:</label> 
                                    <input style="color: black;" id="confirmPassword" type="password" name="ConPass" class="form-control" required="" maxlength="50" />
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-size: 15px">Current Password:</label> <small>(For Verification Purposes)</small>
                                    <input style="color: black;" id="myInput" type="password" name="OldPass" class="form-control input-frield" required="" />
                                </div>
                            </div> -->


                           <div class="col-md-12" style="margin-bottom: 10px">
                                  <button type="button" class="btn btn-primary" id="showPassword" onclick="show()">
                                    <i class="fa fa-eye"></i>&nbsp;
                                    Show password
                                  </button>
                                  <!-- <label style="font-size: 15px">Show Password</label>  -->
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="padding: 1px; margin-bottom: 10px; background-color: gray;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" name="Save"">
                                   <i  class="fa fa-check"></i>   Save
                                </button>&nbsp;&nbsp;&nbsp;
                              
                                <button data-dismiss="modal" class="btn btn-default" style="background-color: maroon; color: white" name="cancel" ><i  class="fa fa-times"></i>  Cancel</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Show Password-->
<script type="text/javascript">

  function show(checkbox) {
     if ($("input[id='myInput']").attr('type') == 'password' || $("input[id='password']").attr('type') == 'password' || $("input[id='confirmPassword']").attr('type') == 'password') {
        $("input[type='password']").attr('type','text');
     }
     else
     {
      $("input[id='myInput']").attr('type','password');
      $("input[id='password']").attr('type','password');
      $("input[id='confirmPassword']").attr('type','password');
     }
  }
  

  function showPassword()
  {
    var pass = document.getElementById('password');
    var oldpass = document.getElementById('oldpassword');
    var confpass = document.getElementById('confirmPassword');
   

    if(document.getElementById('check1').checked)
    {
      pass.setAttribute('type','text');
      oldpass.setAttribute('type','text');
      confpass.setAttribute('type','text');
     
    }
    else
    {
      pass.setAttribute('type','password');
      oldpass.setAttribute('type','password');
      confpass.setAttribute('type','password');
    }  


    
}    
</script>

<!--Password Validation-->
<script type="text/javascript">
    var password = document.getElementById("password")
   ,confirmPassword = document.getElementById("confirmPassword");

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