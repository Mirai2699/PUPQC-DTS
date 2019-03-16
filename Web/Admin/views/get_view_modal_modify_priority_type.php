  <?php
      $view_query = mysqli_query($connection,"SELECT * FROM `r_priority_type` WHERE priority_stat = 1");
      while($row = mysqli_fetch_assoc($view_query))
      {
          $ID = $row["priority_ID"];
          $priotype_name = $row["priority_desc"];
          $priotype_dc = $row["priority_date_count"];
          $priotype_stat = $row["priority_stat"];
          $priotype_datestamp = $row["priority_timestamp"];
                      
  ?>   
<div id="edit<?php echo $ID?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: goldenrod; color: white">
                <h4 class="modal-title" style="font-size: 25px; text-align: center"><i  class="fa fa-edit"></i>  Modify Details</h4>
            </div>
            <div class="modal-body" style="">
                <form role="form" method="POST" action="../functionalities/update_func.php">
                    <div class="col-md-12">
                            <input type="hidden" name="ID" value="<?php echo $ID?>" />
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label style="font-size: 14px"><b>Priority Type Description:</b></label>
                                    <input type="text" class="form-control" name="prio_name" value="<?php echo $priotype_name ?>" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="font-size: 14px"><b>Date Count Set:</b></label>
                                    <input type="number" class="form-control" name="prio_date_count" value="<?php echo $priotype_dc ?>" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="padding: 1px; margin-bottom: 10px; background-color: gray;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align: center">
                                <button type="submit" class="btn btn-success" name="edit_prio">
                                   <i  class="fa fa-check"></i>   Update
                                </button>&nbsp;&nbsp;&nbsp;
                                <button data-dismiss="modal" class="btn btn-default" style="background-color: maroon; color: white" name="cancel" >
                                    <i  class="fa fa-times"></i>  Cancel
                                </button>
                            </div>
                    </div>
                    <div class="row" style="padding: 1px"></div>
                </form>
            </div>
        </div> 
    </div>
</div>

<div id="archive<?php echo $ID?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: maroon; color: white">
                <h4 class="modal-title" style="font-size: 25px; text-align: center"><i  class="fa fa-archive"></i>  Archive this Record</h4>
            </div>
            <div class="modal-body" style="">
                <form role="form" method="POST" action="../functionalities/archive_func.php">
                    <div class="col-md-12">
                            <input type="hidden" name="ID" value="<?php echo $ID?>" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p style="text-align: center; font-size: 16px">
                                        Archiving this record will make it unavailable to the<br> system's user-interface.<br>
                                        You can request its re-activation by contacting the system administrator.<br>
                                        Are you sure you want to proceed?
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="padding: 1px; margin-bottom: 10px; background-color: gray;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align: center">
                                <button type="submit" class="btn btn-success" name="archive_prio">
                                   <i  class="fa fa-check"></i>   Yes
                                </button>&nbsp;&nbsp;&nbsp;
                                <button data-dismiss="modal" class="btn btn-default" style="background-color: maroon; color: white" name="cancel" >
                                    <i  class="fa fa-times"></i>  No
                                </button>
                            </div>
                    </div>
                    <div class="row" style="padding: 1px"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

