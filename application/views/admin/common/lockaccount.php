<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<b>Lock user</b><hr>  
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>ID</td>
        <td>Name</td>
        <td>Phone number</td>
        <td>Email</td>
        <td>Bitcoin address</td>
        <td>Time remain</td>
        <td>Lock Transaction hash</td>
        <td>Tools</td>
    </thead>
    <tbody>
    <?php 
    $i = 1;
    foreach($list_lock as $user) { ?>
        <tr>
         <td><?php echo $i; ?></td>
        <td><?php echo $user['hoten']; ?></td>
        <td><?php echo $user['sodienthoai']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['diachibitcoin']; ?></td>
        <td><?php echo $user['timeremain']; ?></td>
        <td><?php echo $user['hashlock']; ?></td>
        <?php if ($user['trangthaikhoa'] == 0)
        { ?>
        <td><a href="<?php echo admin_url('lock-account/' .$user['iduser']);?>" 
        onclick="return xacnhanlock('<?php echo $user['hoten']; ?>');" 
        class="btn btn-info btn-tool">Lock</a> </td>
        <?php 
        } else { ?>
        <td><a href="<?php echo admin_url('lock-account/' .$user['iduser']);?>" 
        onclick="return xacnhanunlock('<?php echo $user['hoten']; ?>');" 
        class="btn btn-info btn-tool">Unlock</a> </td>
        <?php } ?>
        </tr>
        <?php $i++; } ?>
    </tbody>
  </table>
  <?php echo $pagination ?>
</div>