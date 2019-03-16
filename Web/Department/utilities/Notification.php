                                      <body class="page-header-fixed page-sidebar-fixed page-layout-full-width" style="background-color: #f2f2f2" >
                                        <div >
                                          <div class="page-wrapper" >
                                            <!--BEGIN HEADER-->
                                            <header class="header">
                                              <!--START LOGO-->
                                              <div class="logo">
                                                <a data-toggle="modal" href="#about_us" class="logo-text">
                                                  <img src="../../../resources-web/images/dtslogo.png" style="width:100%; margin: 1%;" alt="">
                                                </a>
                                              </div>
                                              <!--END LOGO-->
                                              <nav role="navigation" class="navbar navbar-static-top">
                                                <div class="navbar-right">
                                                  <ul class="nav navbar-nav">
                                                    <!--True Notification Start-->
                                                    <?php include("Inner_Notif_Function.php");?>
                                                    <!--True Notification End-->
                                                    <li class="dropdown dropdown-user menu-user">
                                                      <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                                         <?php 

                                                              $userID = $_SESSION['UserID'];
                                                              $view_query = mysqli_query($connection,"SELECT * FROM `t_accounts` AS ACC 
                                                                                                      INNER JOIN `r_user_role` AS USR 
                                                                                                      INNER JOIN `t_employees` AS EMP 
                                                                                                      INNER JOIN `r_office` AS OFF
                                                                                                      ON  ACC.acc_user_role = USR.usr_ID
                                                                                                      and EMP.emp_office = OFF.office_ID
                                                                                                      and ACC.acc_empID = EMP.emp_ID
                                                                                                      
                                                                                                      WHERE ACC.acc_ID = '$userID'
                                                                                                      ");
                                                              while($row = mysqli_fetch_assoc($view_query))
                                                              {
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
                                                                  $acc_timestamp = new datetime($row["acc_timestamp"]);
                                                                  $acc_mod_date = $row["acc_mod_date"];
                                                                  $acc_active_flag = $row["acc_active_flag"];

                                                                  $compname = $emp_fname.' '.$emp_lname;
                                                                  $add_date =  $acc_timestamp->format('F d, Y');
                                                                  $off_name = $row["office_name"];
                                                              }
                                                         ?>
                                                        <img src="../../../resources-web/images/PUPlogo.png" alt="User Image" class="img-circle"/>
                                                        <span class="hidden-xs">
                                                           <?php echo $compname; ?>
                                                        </span>&nbsp;
                                                        <b class="caret"></b>
                                                      </a>
                                                      <ul class="dropdown-menu">
                                                        </li>
                                                        <li>
                                                          <a data-toggle="modal" href="#Change">
                                                            <i class="icon-lock"></i>Change Password
                                                          </a>
                                                        </li>
                                                        <li>
                                                          <a data-toggle="modal" href="#report_bug">
                                                            <i class="icon-envelope-letter"></i>Report a Bug
                                                          </a>
                                                        </li>
                                                        <li>
                                                          <a href="../../../logout.php">
                                                            <i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log Out
                                                          </a>
                                                        </li>
                                                      </ul>
                                                    </li>
                                                    <!-- <li class="hidden-xs hidden-sm">
                                                      <a href="javascript:;" class="fullscreen-toggle">
                                                        <i class="icon-size-fullscreen" style="color: #bfbfbf"></i>
                                                      </a>
                                                    </li> -->
                                                  </ul>
                                                </div>
                                              </nav>
                                              <!--MODAL INCLUDES-->
                                              <?php
                                                include("get_view_modal_change_password.php");
                                                include("get_view_modal_report_bugs.php");
                                                include("get_view_modal_about_us.php");
                                              ?>
                                              <!--MODAL INCLUDES-->
                                            </header>
                                            
                                            <!--END HEADER-->

