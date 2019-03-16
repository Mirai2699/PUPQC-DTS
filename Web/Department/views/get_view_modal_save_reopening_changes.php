
<!--REOPENING-->
<div class="modal fade" id="savechanges<?php echo $docu_tr_ID?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: navy; color: white">
                <h2 id="myModalLabel" class="modal-title" style="text-align: center">
                  Saving the Changes for Re-Opening
                </h2>
            </div>
            <div class="modal-body">
                <!-- START --> 
                  <!--START HIDDEN ATTRIBUTES-->
                  <!--END HIDDEN ATTRIBUTES-->

                  <center>
                    <p style="font-size: 15px">This ticket will be officially re-opened by saving its details.</p>
                    <p style="font-size: 15px">After saving, details cannot be changed until next closing. <br>Are you sure you want to proceed?</p>
                          <br>
                          <div class="col-md-12">
                                <button type="submit" name="reopen_ticket" class="btn btn-success" style="font-size: 18px">
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

            </div>
            <div class="modal-footer">
              
            </div>
        </div>
    </div>
</div>
<!--REOPENING-->
<!--START ON PAGE SCRIPT-->

        
<!--END OF ON PAGE SCRIPT-->