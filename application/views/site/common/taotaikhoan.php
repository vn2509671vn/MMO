				<form class="form-horizontal" action="" method="post">
				  <div class="form-group">  
				    <label for="hoten" class="col-sm-3 control-label">Name</label>
				    <div class="col-sm-5">
		    			<?php echo form_error('hoten'); ?>	
				      <input type="text" class="form-control" id="hoten" name="hoten" placeholder="Name" value="<?php echo set_value('hoten'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="username" class="col-sm-3 control-label">User name</label>
				    <div class="col-sm-5">
		 			  <?php echo form_error('username'); ?>
				      <input type="text" class="form-control" id="username" placeholder="User name" name="username" value="<?php echo set_value('username'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="sodienthoai" class="col-sm-3 control-label">Phone number</label>
				    <div class="col-sm-5">
		 			  <?php echo form_error('sodienthoai'); ?>
				      <input type="text" class="form-control" id="sodienthoai" placeholder="Phone number" name="sodienthoai" value="<?php echo set_value('sodienthoai'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="email" class="col-sm-3 control-label">Email</label>
				    <div class="col-sm-5">
		 			  <?php echo form_error('email'); ?>
				      <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="diachibitcoin" class="col-sm-3 control-label">Bitcoin address</label>
				    <div class="col-sm-5">
		 			  <?php echo form_error('diachibitcoin'); ?>
				      <input type="text" class="form-control" id="diachibitcoin" name="diachibitcoin" placeholder="Bitcoin address" value="<?php echo set_value('diachibitcoin'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="password" class="col-sm-3 control-label">Password</label>
				    <div class="col-sm-5">
		 			  <?php echo form_error('password'); ?>
				      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
				    </div>
				  </div>	
				  <div class="form-group">
				    <label for="passconf" class="col-sm-3 control-label">Confirm password</label>
				    <div class="col-sm-5">
		 			  <?php echo form_error('passconf'); ?>
				      <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Confirm password" value="<?php echo set_value('passconf'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="countries" class="col-sm-3 control-label">Countries</label>
				    <div class="col-sm-5">
		 			  <?php echo form_error('quocgia'); ?>
		 			  <select name="quocgia" class="form-control">
		 			  <?php foreach($countries as $c) { ?>
		 			  	<option value="<?php echo $c['name']; ?>" <?php echo ($this->input->post('quocgia') == $c['name'] ? 'selected' : ''); ?>><?php echo $c['name']; ?></option>
		 			  	<?php } ?>
		 			  </select>
				    </div>
				  </div>
				
				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-5">
				      <button type="submit" class="btn btn-primary btn-lg btn-block">Create</button>
				    </div>
				  </div>
				  <hr>
				
				</form>