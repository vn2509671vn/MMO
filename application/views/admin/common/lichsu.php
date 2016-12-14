<b>Transfer history</b><hr> 
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>ID</td>
        <td>Amount</td>
        <td>Status</td>
        <td>Transaction Hash</td>
        <td>Withdraw Date</td>
        <td>Approve Date</td>
    </thead>
    <tbody>
    <?php $i = 1; foreach ($lichsu as $thongtin) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $thongtin['sotienrut']; ?></td>
            <td><?php echo ($thongtin['trangthai'] == 0 ? 'watting' : 'done'); ?></td>
            <td><?php echo $thongtin['mahash']; ?></td>
            <?php $ngayruttien = new DateTime($thongtin['ngayruttien']); ?>
            <td><?php echo $ngayruttien->format('d-m-Y H:i:s'); ?></td>
             <?php $ngayduoctra = new DateTime($thongtin['ngayduoctra']); ?>
            <td><?php echo $ngayduoctra->format('d-m-Y H:i:s'); ?></td>
        </tr>
    <?php $i++; } ?>
    </tbody>
  </table>
  <?php echo $pagination ?>
</div>