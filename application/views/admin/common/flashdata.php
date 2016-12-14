<?php if($this->session->flashdata('mess')) { ?>
<div class="alert alert-info  alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Alert! </strong><?php echo $this->session->flashdata('mess'); ?></h2> </div>
<?php } ?>