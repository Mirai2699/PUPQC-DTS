<?php
    include("get_docuticket_count.php");
    include("get_user_performance.php");
?>
<table class="table table-condensed mbn">
    <tbody>
        <tr>
            <td>
                <h4 style="font-weight: bold">Total Account Log-Ins:</h4>
            </td>
            <td>
                <h4><?php echo  $user_result; ?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4 style="font-weight: bold">Total Number of Document Tickets Tracked:</h4>
            </td>
            <td>
                <h4><?php echo $total_count; ?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4 style="font-weight: bold">Total Number of Overdue Tickets:</h4>
            </td>
            <td>
                <h4><?php echo $overdue_count; ?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4 style="font-weight: bold">Total Average Number Rating (Response Time):</h4>
            </td>
            <td>
                <h4><?php echo $ave_num_rate; ?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4 style="font-weight: bold">Overall Performance Evaluation:</h4>
            </td>
            <td>
                <h4><?php echo $numr_eval_stmnt; ?></h4>
            </td>
        </tr>
    </tbody>
</table>