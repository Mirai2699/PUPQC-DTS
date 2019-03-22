<!--ACCORDION-->
<div id="accordion3" class="panel-group accordion" style="margin: 10px">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion3" href="#collapseOne3" class="accordion-toggle collapsed" aria-expanded="false" style="font-size: 16px">
               See more details <i class="fa fa-angle-double-down"></i></a>
            </h5>
        </div>
        <style type="text/css">
            a {
                color: #262626;
                text-decoration: none;
            }
        </style>
        <div id="collapseOne3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body" style="color: black">
                <div class="tabbable-custom">
                    <p style="font-size: 18px"> <i class="fa fa-table"></i>&nbsp;
                    Details for Document Ticket Processing Transactions per Office and User</p>
                    <div class="row" style="background-color: #6e6e6e; padding: 1px; margin-bottom: 10px"></div>

                    <ul class="nav nav-tabs" style="font-size: 14px;">
                        <li class="active">
                            <a href="#Department" data-toggle="tab" aria-expanded="true">Department</a>
                        </li>
                        <li class="">
                            <a href="#staff" data-toggle="tab" aria-expanded="false">Staff</a>
                        </li>
                        <li class="">
                            <a href="#topics" data-toggle="tab" aria-expanded="false">Topics</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="Department" class="tab-pane active">
                            <table class="table table-condensed mbn">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h4 style="font-weight: bold">Account Username:</h4>
                                        </td>
                                        <td>
                                            <h4><?php echo $acc_username; ?></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="staff" class="tab-pane">
                           
                        </div>
                        <div id="topics" class="tab-pane">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--ACCORDION-->