<?php
    
    include("../utilities/Header.php");
    include("../utilities/Notification.php");
    include("../utilities/navibar.php");
    include("../utilities/BaseJs.php");
    include("../utilities/Tables.php");


?>
      <!--BEGIN WRAPPER-->
      <div class="wrapper row-offcanvas row-offcanvas-left">
      <!--BEGIN CONTENT-->
       <div class="content">
          <section class="main-content">
             <!--START BREADCRUMBS-->
             <div class="col-md-12">
                <div class="col-md-12">
                    <h2 style="margin-top: 15px">Open Document Tickets</h2>
                    <div class="row" style="padding:1px; background-color: #666666; margin-bottom: 20px;"></div> 
                </div>
             </div>
            <!--END BREADCRUMBS-->


            <!--START INNER CONTENT-->

            <!--START BODY CONTENT-->
            <div class="row" style="background-color: white">
       
              <div class="col-md-12">
                <div class="box-info">
                  <div class="col-md-12">
                  <!--box-info start-->
                    <div class="box-info">
                      <div class="panel-heading" style="background-color: #666666; ">
                        <h4 style="color: white; font-size: 25px">Review Open Tickets <b><?php //include("get_view_details_pending_count.php");?></b></h4><h5 style="color: white">(Select an action to refresh)</h5>
                        <div class="row" style="padding:1px; background-color:white;"></div>
                      </div>
                      <div class="col-md-12" style="background-color: #8c8c8c; margin-bottom:10px; border: 2px solid #ffffff">
                        <div class="Panel" style="margin: 10px">
                          <label style="color: white; font-size: 18px">Action Available:</label>
                          <br>
                          <!-- <form method="POST"> -->
                            <button id="receive" type="submit" class="btn btn-info" name="receive_docu"><i class="fa fa-download"></i> View Received Document Tickets</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button id="sent" type="submit" class="btn btn-success" name="sent_docu"><i class="fa fa-upload"></i> View Sent Document Tickets</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button id="create" type="submit" class="btn btn-warning" name="create_docu"><i class="fa fa-plus"></i> View Created Document Tickets</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <!-- </form> -->
                        </div>
                      </div>
                      <!--adv-table start-->
                      
                      <div class="adv-table">
                      <!--START TABLE-->
                      <!-- <table id="datatables" class="table table-striped table-no-border"> -->
                      <table class="table table-striped mbn">
                         <thead>
                         <tr>
                             <th style="display: none">DocTr No.</th>
                             <th>Ticket No.</th>
                             <th>Source</th>
                             <th>Document Type</th>
                             <th>Subject</th>
                             <th>Priority Category</th>
                             <th>Date Created</th>
                             <th>Sender</th>
                             <th>Date Sent</th>
                             <th style="text-align: center">Action</th>
                         </tr>
                         </thead>
                         <tbody id="TBody">
                          <!--TABLE FILTERING-->
                         <!-- <?php include("get_view_table_pending_documents.php");?> -->
                         <!--TABLE FILTERING-->
                        </tbody>
                      </table>
                      <div class="row" style="margin-top: 20px"></div>
                      <!--END TABLE-->
                      </div>
                      <!--adv-table end-->
                    </div>
                    <!--box-info end-->
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
   </body>
</html>
<script type="text/javascript">
  function receive(){
    $.ajax({
      url:'get_view_table_pending_documents.php',
      type:'POST',
      cache:false,
      data:{receive_docu:'true'},
      success:function(data){
        $('#TBody').empty();
        $('#TBody').html(data);
      },
      error:function(){
        alert('Error. Please try again later.');
      }
    });
  }
  function sent(){
    $.ajax({
      url:'get_view_table_pending_documents.php',
      type:'POST',
      cache:false,
      data:{sent_docu:'true'},
      success:function(data){
        $('#TBody').empty();
        $('#TBody').html(data);
      },
      error:function(){
        alert('Error. Please try again later.');
      }
    });
  }
  function create(){
    $.ajax({
      url:'get_view_table_pending_documents.php',
      type:'POST',
      cache:false,
      data:{create_docu:'true'},
      success:function(data){
        $('#TBody').empty();
        $('#TBody').html(data);
      },
      error:function(){
        alert('Error. Please try again later.');
      }
    });
  }
  $(document).ready(function(){
    receive();
    $('#receive').on('click',function(){
      receive();
    });
    $('#sent').on('click',function(){
      sent();
    });
    $('#create').on('click',function(){
      create();
    });
  });
</script>

                                                
