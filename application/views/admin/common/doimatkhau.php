<b>Change password</b><hr> 
<?php $this->load->view('site/common/flashdata'); ?>
<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="matkhaucu" class="col-sm-2 control-label">Password Old</label>
    <div class="col-sm-10">
    <?php echo form_error('matkhaucu'); ?>
      <input type="password" class="form-control" id="matkhaucu" placeholder="Password Old" name="matkhaucu">
    </div>
  </div>
  <div class="form-group">
    <label for="matkhaumoi" class="col-sm-2 control-label">New Password</label>
    <div class="col-sm-10">
      <?php echo form_error('matkhaumoi'); ?>
      <input type="password" class="form-control" id="matkhaumoi" placeholder="Password New" name="matkhaumoi">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"> Confirm Password </label>
    <div class="col-sm-10">
      <?php echo form_error('nhaplaimatkhau'); ?>
      <input type="password" class="form-control" id="nhaplaimatkhau" name="nhaplaimatkhau" placeholder="Comfirm Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Change</button>
      <button type="submit" class="btn btn-danger">Cancel</button>
    </div>
  </div>
</form>