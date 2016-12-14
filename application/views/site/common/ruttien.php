<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if($thongtin_user['kichhoat'] == 0) { ?>
<br>
<?php } else {?>
<b>Withdraw Cash</b> <br>	<b>Available Cash: <span style="color: red"><?php echo $Available_Cash ."$"; ?></span> </b><hr> 

<!-- NEW -->
<div class="div div-danger"><strong>Notice: </strong>You will receive 90% of the amount of your money in total because of the 10% fee.</h2> </div>

<?php $this->load->view('site/common/flashdata'); ?>
<form class="form-inline" method="post" action="<?php echo home_url('with-draw-cash')?>">
<?php echo form_error('sotien'); ?>
<?php echo form_error('kiemtratien'); ?>
  <div class="form-group">
    <label class="sr-only" for="sotien">Amount (in dollars)</label>
    <div class="input-group">
      <div class="input-group-addon"></div>     
      <input type="text" class="form-control" name="sotien"  id="sotien" placeholder="">
      <div class="input-group-addon">.00</div>
    </div>
  </div>
  <button type="submit" onclick="return xacnhan_ruttien()" class="btn btn-primary">Withdraw</button>
</form>
<?php } ?>