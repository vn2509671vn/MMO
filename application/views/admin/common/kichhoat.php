<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('admin/common/flashdata'); ?>
<b>Approve register</b><hr>  
        <?php if(!empty($list_kichhoat)) { ?>
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>Name</td>
        <td>Username</td>
        <td>Phone number</td>
        <td>Email</td>
        <td>Bitcoin address</td>
        <td>Join date</td>
        <td>Transaction hash</td>
        <td>Tools</td>
    </thead>
    <tbody>
        <?php foreach($list_kichhoat as $nguoidung) { ?>
        <tr>
            <td><?php echo $nguoidung['hoten']; ?></td>
            <td><?php echo $nguoidung['username']; ?></td>
            <td><?php echo $nguoidung['sodienthoai']; ?></td>
            <td><?php echo $nguoidung['email']; ?></td>
            <td><?php echo $nguoidung['diachibitcoin']; ?></td>
            <td><?php echo $nguoidung['ngaythamgia']; ?></td>
            <td><?php echo $nguoidung['transactionhash']; ?></td>
            <td><a href="<?php echo admin_url('approve-register/' .$nguoidung['iduser']);?>" onclick="return xacnhan('<?php echo $nguoidung['hoten']; ?>');" class="btn btn-info btn-tool">approve</a> 
            <a href="<?php echo admin_url('approve-register-remove/' .$nguoidung['iduser']);?>" onclick="return remove('<?php echo $nguoidung['hoten']; ?>');" class="btn btn-danger btn-tool">delete</a> </td>
        </tr>
        <?php } ?> 
            </tbody>
      </table>
      <?php echo $pagination ?>
        <?php }  else {?>
        <div class="div div-danger"><strong>Info! </strong>No account is actived.</h2> </div>
        <?php } ?>
</div>