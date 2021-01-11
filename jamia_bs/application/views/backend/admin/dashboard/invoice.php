<?php
$date_from = strtotime(date('Y-m-01')." 00:00:00"); // hard-coded '01' for first day
$date_to   = strtotime(date('Y-m-t')." 23:59:59");
?>
<table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
    <thead>
        <tr>
            <th><?php echo  get_phrase('student') ; ?></th>
            <th><?php echo  get_phrase('class') ; ?></th>
            <th><?php echo  get_phrase('invoice_title') ; ?></th>
            <th><?php echo  get_phrase('total_amount') ; ?></th>
            <th><?php echo  get_phrase('paid_amount') ; ?></th>
            <th><?php echo  get_phrase('status') ; ?></th>
        </tr>
    </thead>
    <tbody>
       
</tbody>
</table>
