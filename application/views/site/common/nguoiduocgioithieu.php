<b>List of children</b><hr>  
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>ID</td>
        <td>Name</td>
        <td>Phone Number</td>
        <td>Email</td>
        <td>Join date</td>
        <td>Active state</td>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($list as $value) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $value['hoten'] ?></td>
            <td><?php echo $value['sodienthoai'] ?></td>
            <td><?php echo $value['email'] ?></td>
             <?php $ngaythamgia = new DateTime($value['ngaythamgia']); ?>
            <td><?php echo $ngaythamgia->format('d-m-Y H:i:s') ?></td>
            <td><?php $kichhoat = "Actived";
            if ($value['kichhoat'] == 0)
            {
                $kichhoat = "Not Actived";
            }
            echo $kichhoat;
            ?></td>
        </tr>
          <?php $i++; } ?>
    </tbody>
  </table>
</div>