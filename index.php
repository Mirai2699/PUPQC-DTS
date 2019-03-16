<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>PUPQC-DTS | Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="resources-login/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="resources-login/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="resources-login/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="resources-login/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="resources-login/css/default/style.min.css" rel="stylesheet" />
    <link href="resources-login/css/default/style-responsive.min.css" rel="stylesheet" />
    <link href="resources-login/css/default/theme/default.css" rel="stylesheet" id="theme" />
    <link href="resources-web/images/puplogo.png" rel="icon"/>
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="resources-login/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url(resources-login/img/login-bg/login-bg-24.jpg)"></div>
                <div class="news-caption">
                    <h4 class="caption-title"><b>PUPQC</b> Document Tracking System</h4>
                    <p>
                        Document tracking for PUPQC is now optimized by technology through PUPQC-DTS.
                    </p>
                </div>
            </div>

            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">

                
                <!-- begin login-header -->
                <div class="login-header" style="text-align: left">
                    <div class="brand">
                        <small>Polytechnic University of the Philippines<br> Quezon City Branch</small>
                        <b style="font-size: 26px">Document Tracking System
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                    <form name="loginform" id="loginform" method="POST" class="margin-bottom-0">
                        <div class="form-group m-b-15">
                            <input name="username" type="text" class="form-control form-control-lg" placeholder="Username" required />
                        </div>
                        <div class="form-group m-b-15">
                            <input id="password" name="password" type="password" class="form-control form-control-lg" placeholder="Password" required />
                        </div>
                        <div>
                            <div class="checkbox">
                                <input id="check" type="checkbox" onclick="showPass();">
                                <label style="font-size: 15px">Show Password</label>
                            </div>
                        </div>
                        <?php
                            include ("db_con.php");
                              
                              if(isset($_POST['login']))
                              {
                                $username = $_POST['username'];
                                $password = $_POST['password'];
                                
                                date_default_timezone_set("Asia/Manila"); 
                                $timein = date('H:i:s');
                                $datein = date('Y-m-d');

                                $query = "SELECT * FROM t_accounts WHERE acc_username = '".$username."' and acc_password = '".$password."'";

                                $result = mysqli_query($connection,$query) or die(mysqli_error());
                                if (mysqli_num_rows($result) > 0)
                                {
                                 while($row = mysqli_fetch_assoc($result))
                                   {
                                     $user_id = $row['acc_ID'];
                                     $UserName = $row['acc_username'];
                                     $userrole = $row['acc_user_role'];
                                     $status = $row['acc_active_flag'];
                                     //$email = $row['acc_email'];

                                   }
                                  if($status == "Active")
                                  {
                                     session_start();
                                     $_SESSION['UserID'] = $user_id;
                                     $_SESSION['Logged_In'] = $UserName;
                                     $_SESSION['UserRole'] = $userrole;
                                     //$_SESSION['email'] = $email;
                                    
                                    if($_SESSION['UserRole'] == "1")
                                    {
                                      $header ='Location:Web/Admin/views/index.php?username='.$UserName.'';
                                      header($header);
                                    }
                                    else if($_SESSION['UserRole'] == "2")
                                    {
                                      
                                      $header ='Location:Web/Department/views/view_pending.php?username='.$UserName.'';
                                      header($header);
                                    } 
                                    $ins_query = "INSERT INTO t_users_log (log_userID, log_usertype, log_datestamp, log_timestamp) 
                                                  VALUES('$user_id', '$userrole', '$datein', '$timein')";
                                    mysqli_query($connection,$ins_query);
                                  }
                                  else if($status == "Disabled") 
                                  {
                                    echo  "
                                    <center>
                                      <label style='color:darkviolet; font-weight: 10px; font-size: 15px'>
                                        Your Account has been Disabled; <br>Sorry, you cannot proceed to your account.
                                      </label>
                                    </center>";  
                                  }
                               
                              }
                              else
                              {
                                    echo  "
                                    <center>
                                    <label style='color:red; font-weight: 10px; font-size: 15px'>Incorrect Username or Password!</label>
                                    </center>";         
                              }
                             }
                        ?>
                     
                         
                        <div class="login-buttons" style="margin-bottom: 30px">
                           <!--  <button name="login" type="submit" class="btn btn-success btn-block btn-lg">Log In</button> -->
                           <button type="submit" name="login" class="btn btn-success btn-block btn-lg">Log In</button>
                          
                        </div>
                        <hr>
                        <p class="text-center text-grey-darker" style="font-size: 10px">
                            &copy; SRG 7TH Generation All Right Reserved 2019
                        </p>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
        
      
    </div>
    <!-- end page container -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="resources-login/plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="resources-login/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="resources-login/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <!--[if lt IE 9]>
        <script src="../assets/crossbrowserjs/html5shiv.js"></script>
        <script src="../assets/crossbrowserjs/respond.min.js"></script>
        <script src="../assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <script src="resources-login/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="resources-login/plugins/js-cookie/js.cookie.js"></script>
    <script src="resources-login/js/theme/default.min.js"></script>
    <script src="resources-login/js/apps.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script type="text/javascript">
      function showPass()
      {
        var pass = document.getElementById('password');
        if(document.getElementById('check').checked)
        {
          pass.setAttribute('type','text');
        }
        else
        {
          pass.setAttribute('type','password');
        }  
    }    
    </script>
</body>
</html>
