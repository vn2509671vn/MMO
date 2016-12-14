<b>Information</b><hr> 
<b style="color: red;"><a href="<?php echo home_url('signup?code=' .$info_user['code']); ?>"><?php echo home_url('signup?code=' .$info_user['code']); ?></a></b><hr>   
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>Name</td>
        <td>Phone Number</td>
        <td>Email</td>
        <td>Bitcoin Address</td>
        <td>Join date</td>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $info_user['hoten']; ?></td>
            <td><?php echo $info_user['sodienthoai']; ?></td>
            <td><?php echo $info_user['email']; ?></td>
            <td><?php echo $info_user['diachibitcoin']; ?></td>
            <?php $ngaythamgia = new DateTime($info_user['ngaythamgia']); ?>
            <td><?php echo $ngaythamgia->format('d-m-Y H:i:s'); ?></td>
        </tr>
    </tbody>
  </table>
</div>
<br>
<div class="table-responsive">
      <table class="table table-bordered">
        <thead>
            <td bgcolor="#ccc"><a href="<?php echo home_url('current-level'); ?>">Your current level</a></td>
            <td>Level 1</td>
            <td>Level 2</td>
            <td>Level 3</td>
            <td>Level 4</td>
            <td>Reset</td>
            <td bgcolor="#ccc"><a href="<?php echo home_url('list-of-present'); ?>">Children</a></td>
            <td>Hierarchical</td>
            <td>Avaliable Cash</td>
        </thead>
        <tbody>
                <td><?php echo $thongtinbac['levelhientai'] ?></td>
                <td><?php echo $thongtinbac['bac1'] ?></td>
                <td><?php echo $thongtinbac['bac2'] ?></td>
                <td><?php echo $thongtinbac['bac3'] ?></td>
                <td><?php echo $thongtinbac['lamlai'] ?></td>
                <td><?php echo $thongtinbac['lamlai'] ?></td>
                <td><?php echo $number_of_child ?></td>
                <td></td>
                <td><b style="color: red;"><?php echo $thongtinbac['sotienhienco']; ?> </b></td>
        </tbody>
        <tfoot>
            <tr>
                <td>Income</td>
                <td><?php echo $thongtinbac['bac1']*50 ?></td>
                <td><?php echo $thongtinbac['bac2']*100 ?></td>
                <td><?php echo $thongtinbac['bac3']*250 ?></td>
                <td><?php echo $thongtinbac['lamlai']*600 ?></td>
                <td><?php echo $thongtinbac['lamlai']*(-300) ?></td>
                <?php //++Duy add tong so tien hoa hong ?>
                <td><?php echo $total_hoahongtructiep ?></td>
                <td><?php echo $total_hoahongnhaycung ?></td>
                <!--
                <td><?php echo $thongtinbac['soconf1'] * 45 ?></td>
                <td>Total income: <?php echo  $thongtinbac['bac1']* 50 + $thongtinbac['bac2']*100 +  $thongtinbac['bac3']*250 + $thongtinbac['soconf1'] * 45 ?> </td>
                -->
                <td>Total : <b style="color: blue;"><?php echo  $thongtinbac['bac1']* 50 + $thongtinbac['bac2']*100 +  $thongtinbac['bac3']*250 +
                $thongtinbac['lamlai']*600 + $thongtinbac['lamlai']*(-300) + $total_hoahongtructiep + $total_hoahongnhaycung?></b> </td>
            </tr>
        </tfoot>
      </table>
</div>