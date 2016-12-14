<b>List of children</b><hr>  
<div class="table-responsive">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
        <td>Name</td>
        <td>Phone Number</td>
        <td>Email</td>
        <td>Join date</td>
    </thead>
    <tbody>
        <?php foreach ($list as $value) { ?>
        <tr>
            <td><?php echo $value['hoten'] ?></td>
            <td><?php echo $value['sodienthoai'] ?></td>
            <td><?php echo $value['email'] ?></td>
             <?php $ngaythamgia = new DateTime($value['ngaythamgia']); ?>
            <td><?php echo $ngaythamgia->format('d-m-Y H:i:s') ?></td>
        </tr>
          <?php } ?>
    </tbody>
  </table>
</div>