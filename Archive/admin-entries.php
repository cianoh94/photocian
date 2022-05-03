<?php
$login_required = ["admin"];
require_once "init.php";
require_once "includes/head.inc.php";
?>
<div class="tw-flex tw-flex-wrap tw-my-10">
    <div class="tw-w-full">
        <h4 class="tw-uppercase tw-text-xl tw-tracking-wide">Bookings</h4>
        
        <table class="table table-responsive table-stripe">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM bookings ORDER BY id DESC");
                    if(mysqli_num_rows($sql) > 0){
                        while($row = mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td scope="row">#<?php echo $row["id"]; ?></td>
                    <td scope="row"><?php echo $row["name"]; ?></td>
                    <td scope="row"><?php echo $row["email"]; ?></td>
                    <td scope="row"><?php echo $row["subject"]; ?></td>
                    <td scope="row"><?php echo $row["message"]; ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <td>
                        <a href="?delete_entry=<?php echo $row["id"]; ?>" class="btn btn-danger rounded-0 tw-py-[7px] tw-text-sm tw-uppercase">Delete</a>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php require_once "includes/foot.inc.php"; ?>