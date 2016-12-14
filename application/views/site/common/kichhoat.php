<b>Active Account</b><hr>

<?php echo form_error('makichhoat'); ?> 
<?php $this->load->view('site/common/flashdata'); ?>
<?php if(empty($check_kichhoat['transactionhash']) || 
($userinfo['trangthaikhoa'] == 1 && empty($userinfo['hashlock']))) { ?>
<label class="sr-only" for="makichhoat">Transaction Hash</label><br>

<form class="form-inline" action="" method="post">
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-addon">URL BTC (Transaction Hash)</div>
      <input type="text" class="form-control" id="makichhoat" placeholder="Code Transaction Hash" name="makichhoat">
      <div class="input-group-addon">.</div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Active</button>
</form>
<br>
<br>
  <p class="color-orange">Please tranfer <strong class="color-black">300$</strong> to this Bitcoin address : </p>
  <p><strong>1LqovLSegQTySAVLm5zhzdCQxE3ZEt1gtC</strong></p>
  <p><strong>OR</strong></p>
  <img src="https://chart.googleapis.com/chart?chs=200x200&amp;cht=qr&amp;chl=1LqovLSegQTySAVLm5zhzdCQxE3ZEt1gtC&amp;choe=UTF-8" alt="Smiley face" height="200" width="200">
  <div>
    And Enter a URL Transaction Hash into URL BTC (Transaction Hash).
  </div>
<?php } else if($check_kichhoat['kichhoat'] == 1){ ?>
	<div class="div div-danger"><b>Your account was actived</b></div>
<?php } else { ?>
	<div class="div div-danger"><b>Your transactionhash has been sent to and watting for approved. Please wait for a moment</b></div>
<?php } ?>