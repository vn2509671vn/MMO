<b>Bonus from children</b><hr> 
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>ID</td>
        <td>Descriptions</td>
        <td>Date</td>
        <td>Income</td>
        
    </thead>
    <tbody>
    <?php  $i = 1;
            $total_income = 0;
    foreach ($income_info as $income) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $income['nguoidangky'] ; ?></td>
            <?php $ngay = new DateTime($income['ngaynhan']);?>
            <td><?php echo $ngay->format('d-m-Y H:i:s'); ?> </td>
            <td><?php echo $income['sotiennhan'];  ?></td>
        </tr>
    <?php 
    $total_income += $income['sotiennhan'];
    $i++; 
    } ?>
    </tbody>
    <tbody>
         <tr>
            <td colspan="3">Total income: </td>
            <td ><b style="color: red;"><?php echo $total_income ?></b></td>
            
        </tr>
    </tbody>
  </table>
  <?php echo $pagination; ?>
</div>