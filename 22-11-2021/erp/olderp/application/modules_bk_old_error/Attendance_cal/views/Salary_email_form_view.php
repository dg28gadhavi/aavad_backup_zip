<?php //echo "<pre>";print_r($data);die; ?>
<p></p>
<p><?php echo $this->input->get('sal_month_name'); ?></p>

<p><p>
  <div class="portlet-body">
    <table border="1" class="table table-striped table-bordered table-hover dt-responsive" style="border-collapse: collapse;" width="100%" id="sample_1">
        <thead>
            <tr>
                <th  width="2%">Sr.No</th>
                <th  width="2%">Name</th>
                <th  width="2%">Working Day</th>
                <th  width="2%">Total Leave</th>
                 <th  width="2%">Pay Without Leave</th>
                 <th  width="2%">Pay With Leave</th>
                 <th  width="2%">Extra Day Work</th>
                 <th  width="2%">Late (Hours)</th>
                 <th  width="2%">Basic Salary</th>
                 <th  width="2%">Pay Salary</th>
                 <th  width="2%">Prof. Tax</th>
                 <th  width="2%">Other Deduction</th>
                 <th  width="2%">Give Salary</th>
                 <th  width="2%">Remark </th>
            </tr>
        </thead>
            <tbody>
        <?php $id = 0;
         if(isset($data)) { 
         foreach($data as $row){ $id++; ?>

        <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $row['au_fname'];?></td>
            <td><?php echo $row['sal_cal_work_days'];?></td>
            <td><?php echo $row['sal_cal_total_leave'];?></td>
            <td><?php echo $row['sal_cal_py_without'];?></td>
            <td><?php echo $row['sal_cal_py_with'];?></td>
            <td><?php echo $row['sal_cal_extra_day'];?></td>
            <td><?php echo $row['sal_cal_late_hrs'];?></td>
            <td><?php echo $row['sal_cal_basic_sal'];?></td>
            <td><?php echo $row['sal_cal_pay_sal'];?></td>
            <td><?php echo $row['sal_cal_prof_tax'];?></td>
            <td><?php echo ($row['sal_cal_esic'] + $row['sal_cal_pf']);?></td>
            <td><?php echo $row['sal_cal_net_sal'];?></td>
            <td><?php echo $row['sal_cal_remark'];?></td>
        </tr>
           <?php } } ?>
        </tbody>
    </table>
</div> 