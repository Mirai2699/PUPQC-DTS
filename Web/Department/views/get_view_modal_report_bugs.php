<!--START MODAL-->

<div id="report_bug" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header" style="background-color: #6e6e6e">
                <h5 class="modal-title" style="font-size: 25px; color: white; text-align: center "><i class="fa fa-bug"></i>&nbsp;&nbsp;Report a Bug
                    <i class="livicon" data-name="edit" data-s="35" data-c="white"></i></h5>
            </div>
            <div class="modal-body" style="height:auto; ">
                <div class="col-md-12">
                    
                </div>
                <div class="col-md-12" style="text-align: center; margin-bottom: 10px">
                    <p style="text-align: justify; font-size: 15px; margin: 10px">
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      In order to serve you better, the developer of the system provides an interface for you to report any errors, or bugs encountered in using the system.<br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By giving your insights or complaints from using the system, the developer will be pleased to receive it as it helps the developer to fix and to furthur improve the system.
                       <form action="../functionalities/report_bug.php" method="POST">
                            <!--ACCOUNT ID-->
                            <input type="hidden" name="reporter_accID" value="<?php echo $userID?>">
                            <div style=" border: 1px solid">
                                <textarea rows="7" class="input-dark form-control" name="report_desc" style="font-size: 18px; color: black;" required></textarea>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px">
                                  <button class="btn btn-primary"  name="report_submit" style="font-size: 15px">
                                        <i class="fa fa-share"></i>
                                        &nbsp;
                                        Send
                                  </button>
                                  &nbsp;&nbsp;
                                  <a data-dismiss="modal" class="btn btn-danger" style="font-size: 15px">
                                    <i class="fa fa-times"></i>
                                    &nbsp;
                                    Cancel
                                  </a>     
                            </div>
                       </form>
                    </p>
                </div>
                <div class="row" style="margin-top: 5px"></div>
            </div>
        </div>
    </div>
</div>
<!--END MODAL-->
