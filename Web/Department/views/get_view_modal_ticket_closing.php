
<!--CHANGE ACCOUNT STATUS-->
<div class="modal fade" id="closing<?php echo $docu_tr_ID?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #800000; color: white">
                <h2 id="myModalLabel" class="modal-title" style="text-align: center">
                  Closing the ticket
                </h2>
            </div>
            <div class="modal-body">
              <form action="../functionalities/document_tracking.php" method="POST">
                <!--START HIDDEN ATTRIBUTES-->
                <input type="hidden" name="accID" value="<?php echo $userID ?>">
                <input type="hidden" name="docu_ID" value="<?php echo $docu_tr_ID ?>">
                <input type="hidden" name="docu_ticketno" value="<?php echo $docu_tr_ticket_no ?>">


                <!--END HIDDEN ATTRIBUTES-->
                <!-- START --> 
                <center>
                  <p style="font-size: 15px">This ticket can be re-opened after closing.</p>
                  <p style="font-size: 15px">Are you sure you want to proceed?</p>
                        <input type="hidden" name="acc_ID" value="<?php echo $ID?>" />
                        <div class="col-md-12">
                               <label style="font-size: 16px"><b>Reason for Closing</b></label>
                               <input type="text" class="form-control" name="closing_remarks" required>
                               <br>
                              <button type="submit" name="close_ticket" class="btn btn-success" style="font-size: 18px">
                                <i class="fa fa-check" data-s="12" data-c="white"></i>
                                Confirm
                              </button>
                              &nbsp;&nbsp;&nbsp;
                              <a data-dismiss="modal" class="btn btn-danger" style="font-size: 18px">
                                <i class="fa fa-times" data-s="12" data-c="white"></i>
                                Cancel
                              </a>     
                        </div>
                </center>
              <!--END-->
              </form>
            </div>
            <div class="modal-footer">
              
            </div>
        </div>
    </div>
</div>
<!--START ON PAGE SCRIPT-->

        
<!--END OF ON PAGE SCRIPT-->