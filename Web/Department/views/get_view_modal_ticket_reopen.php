
<!--REOPENING-->
<div class="modal fade" id="reopen<?php echo $docu_tr_ID?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: green; color: white">
                <h2 id="myModalLabel" class="modal-title" style="text-align: center">
                  Re-Opening the ticket
                </h2>
            </div>
            <div class="modal-body">
                <!-- START --> 
                  <!--END HIDDEN ATTRIBUTES-->

                  <center>
                    <p style="font-size: 15px">This ticket will be re-opened again for processing.</p>
                    <p style="font-size: 15px">Some of the ticket's details can be altered. <br>Are you sure you want to proceed?</p>
                         
                          <div class="col-md-12">
                                <a href="open_ticket_review.php?getID=<?php echo $docu_ticketno;?>" class="btn btn-success" style="font-size: 18px">
                                  <i class="fa fa-check" data-s="12" data-c="white"></i>
                                  Confirm
                                </a>
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