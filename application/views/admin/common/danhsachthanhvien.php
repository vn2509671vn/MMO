<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<b>List users</b><hr>  
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>ID</td>
        <td>Name</td>
        <td>Level</td>
        <td>Phone number</td>
        <td>Email</td>
        <td>Bitcoin address</td>
        <td>Join date</td>
        <td>Transaction hash</td>
        <td> Tools</td>
    </thead>
    <tbody>
    <?php 
    $i = 1;
    foreach($list_user as $user) { ?>
        <tr>
         <td><?php echo $i; ?></td>
        <td><?php echo $user['hoten']; ?></td>
         <td><?php echo $user['levelhientai']; ?></td>
        <td><?php echo $user['sodienthoai']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['diachibitcoin']; ?></td>
        <?php $ngaythamgia = new DateTime($user['ngaythamgia']); ?>
        <td><?php echo $ngaythamgia->format('d-m-Y H:i:s'); ?></td>
        <td><?php echo (empty($user['transactionhash']) ? 'watting active...' : $user['transactionhash']); ?></td>
        <td><a href="<?php echo admin_url('tranfer-history/' .$user['iduser']);?>"class="btn btn-info btn-tool">transfer</a>
        <a href="<?php echo admin_url('income-info/' .$user['iduser']);?>"class="btn btn-info btn-tool">income</a>
         <a href="<?php echo admin_url('childs/' .$user['iduser']);?>"class="btn btn-info btn-tool">childs</a>
        </td>
        </tr>
        <?php $i++; } ?>
    </tbody>
  </table>
  <?php echo $pagination ?>
</div>