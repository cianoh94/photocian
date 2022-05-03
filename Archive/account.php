<?php
$login_required = ["customer"];
require_once "init.php";
require_once "includes/head.inc.php";

$customer_id = user_info("id");
$total_img_sql = mysqli_query($conn, "SELECT * FROM gallery WHERE customer = $customer_id");
$total_img = mysqli_num_rows($total_img_sql);
$imgs_per_col = ceil($total_img / 3);
$third_col = $imgs_per_col * 2;
?>
<div class="tw-flex tw-flex-wrap tw-my-10">
    <div class="tw-w-full tw-mx-auto">
        <form action="" method="post">
            <h4 class="tw-uppercase tw-text-xl tw-tracking-wide">Edit User</h4>
            <div class="tw-flex tw-flex-wrap tw-mb-5 tw-mt-2">
                <div class="tw-w-2/12 tw-px-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo user_info("name"); ?>" required>
                </div>
                <div class="tw-w-2/12 tw-px-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo user_info("email"); ?>" required>
                </div>
                <div class="tw-w-2/12 tw-px-2">
                    <label>Change Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave Empty to keep current password" title="Leave Empty to keep current password">
                </div>
                <div class="tw-w-2/12 tw-px-2">
                    <label>Confirm Password</label>
                    <input type="password" name="c_password" class="form-control">
                </div>
                <div class="tw-w-2/12 tw-px-2 md:tw-pr-0">
                    <br>
                    <button class="cs-btn tw-w-full" name="update_customer">Update</button>
                </div>
            </div>
        </form>
        <h4 class="tw-uppercase tw-text-xl tw-tracking-wide tw-my-10">Images</h4>
        <div class="tw-flex tw-flex-wrap tw-my-10">
            <div class="tw-w-full md:tw-w-4/12">
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM gallery WHERE customer = $customer_id ORDER BY id DESC LIMIT 0,$imgs_per_col");
                    if(mysqli_num_rows($sql) > 0){
                        while($row = mysqli_fetch_array($sql)){
                ?>
                <div class="tw-overflow-hidden tw-my-2 tw-mx-1">
                    <a href="uploads/<?php echo $row["image"]; ?>" data-lightbox="gallery" data-title="<?php echo $row["caption"]; ?>"><img src="uploads/<?php echo $row["image"]; ?>" alt="<?php echo $row["caption"]; ?>" class="tw-rounded tw-shadow hover:tw-scale-[1.2] tw-duration-200"></a>
                </div>
                <?php } } ?>
            </div>
            <div class="tw-w-full md:tw-w-4/12">
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM gallery WHERE customer = $customer_id ORDER BY id DESC LIMIT $imgs_per_col,$imgs_per_col");
                    if(mysqli_num_rows($sql) > 0){
                        while($row = mysqli_fetch_array($sql)){
                ?>
                <div class="tw-overflow-hidden tw-my-2 tw-mx-1">
                    <a href="uploads/<?php echo $row["image"]; ?>" data-lightbox="gallery" data-title="<?php echo $row["caption"]; ?>"><img src="uploads/<?php echo $row["image"]; ?>" alt="<?php echo $row["caption"]; ?>" class="tw-rounded tw-shadow hover:tw-scale-[1.2] tw-duration-200"></a>
                </div>
                <?php } } ?>
            </div>
            <div class="tw-w-full md:tw-w-4/12">
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM gallery WHERE customer = $customer_id ORDER BY id DESC LIMIT $third_col,$imgs_per_col");
                    if(mysqli_num_rows($sql) > 0){
                        while($row = mysqli_fetch_array($sql)){
                ?>
                <div class="tw-overflow-hidden tw-my-2 tw-mx-1">
                    <a href="uploads/<?php echo $row["image"]; ?>" data-lightbox="gallery" data-title="<?php echo $row["caption"]; ?>"><img src="uploads/<?php echo $row["image"]; ?>" alt="<?php echo $row["caption"]; ?>" class="tw-rounded tw-shadow hover:tw-scale-[1.2] tw-duration-200"></a>
                </div>
                <?php } } ?>
            </div>
        </div>
    </div>
</div>
<?php require_once "includes/foot.inc.php"; ?>