<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<b>Approve withdraw</b><hr>  
<?php if(!empty($thongtin_tien)) { ?>
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>Name</td>
        <td>Phone number</td>
        <td>Email</td>
        <td>Bitcoin address</td>
        <td>Withdraw Date</td>
        <td>Amount</td>
        <td>Tools</td>
    </thead>
    <tbody>
    <?php $total = 0;
    foreach($thongtin_tien as $thongtin) { ?>
        <tr>
        <td><?php echo $thongtin['hoten']; ?></td>
        <td><?php echo $thongtin['sodienthoai']; ?></td>
        <td><?php echo $thongtin['email']; ?></td>
        <td><img src="https://chart.googleapis.com/chart?chs=100x100&amp;cht=qr&amp;chl=<?php echo $thongtin['diachibitcoin']; ?>&amp;choe=UTF-8'" alt="Placeholder Image" /></td>
        <td><?php echo $thongtin['ngayruttien']; ?></td>
        <td><?php echo $thongtin['sotienrut']*(90/100); ?></td>
        <td><button class="btn btn-info" type="button" onclick="return ruttien('<?php echo admin_url('approve-withdraw-user'); ?>', <?php echo $thongtin['id']; ?>, '<?php echo admin_url('approve-withdraw'); ?>');">Approve</td>
        </tr>
        <?php
        $total+= $thongtin['sotienrut']*(90/100);
        } ?>
            </tbody>
            <tbody>
         <tr>
            <td colspan="5">Total: </td>
            <td ><b style="color: red;"><?php echo $total ?></b></td>
            
        </tr>
    </tbody>
      </table>
      <?php echo $pagination ?>
        <?php }  else {?>
        <div class="div div-danger"><strong>Info! </strong>No withdraw.</h2> </div>
        <?php } ?>
</div> 
<script type="text/javascript">
  $( function() {
    $( "#dialog-confirm" ).dialog({
      autoOpen: false,
    });
  });
</script>
<div id="dialog-confirm" title="Please enter Transaction hash">
      <label for="transaction_hash">Transaction hash</label>
      <input type="text" name="transaction_hash" id="transaction_hash">
</div>
