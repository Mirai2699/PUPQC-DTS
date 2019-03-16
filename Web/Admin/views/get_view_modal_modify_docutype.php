 <?php
     $view_query = mysqli_query($connection,"SELECT * FROM `r_document_type` where docutype_stat = 1");
     while($row = mysqli_fetch_assoc($view_query))
     {
         $ID = $row["docutype_ID"];
         $docutype_name = $row["docutype_desc"];
         $docutype_stat = $row["docutype_stat"];
         $docutype_datestamp = $row["docutype_timestamp"];
                     
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-size: 17px"><b>Document Type Name:</b></label>
                                    <input type="text" class="form-control" name="docutype_name" value="<?php echo $docutype_name ?>" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="padding: 1px; margin-bottom: 10px; background-color: gray;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align: center">
                                <button type="submit" class="btn btn-success" name="edit_docutype">
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
                                <button type="submit" class="btn btn-success" name="archive_docutype">
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

