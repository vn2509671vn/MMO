<b>List of available account in your current level</b><hr> 
<hr>   
<div class="table-responsive">
      <table class="table table-bordered">
        <thead>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Join date</td>
        </thead>
        <tbody>
            <?php $i = 1; foreach($info_user as $user) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $user['hoten']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <?php $ngaythamgia = new DateTime($user['ngaythamgia']); ?>
                <td><?php echo $ngaythamgia->format('d-m-Y H:i:s'); ?></td>
            </tr>
            <?php $i++; } ?>
        </tbody>
      </table>
</div>