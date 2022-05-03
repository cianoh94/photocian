<?php
$login_required = ["admin"];
require_once "init.php";
require_once "includes/head.inc.php";
?>
<div class="tw-flex tw-flex-wrap tw-my-10">
    <div class="tw-w-full">
        <form action="" method="post" enctype="multipart/form-data">
            <h4 class="tw-uppercase tw-text-xl tw-tracking-wide">Add New Images</h4>
            <div class="tw-flex tw-flex-wrap tw-mb-5 tw-mt-2">
                <div class="tw-w-1/2 md:tw-w-3/12 tw-px-2 md:tw-pl-0">
                    <label>Customer</label>
                    <select name="customer" class="form-select" <?php if(isset($_GET["submit_images"])){echo "disabled";} ?>>
                        <option value="">For All (Gallery)</option>
                        <?php
                            $cs_sql = mysqli_query($conn, "SELECT * FROM users WHERE role = 'customer'");
                            if(mysqli_num_rows($cs_sql) > 0){
                                while($cs_row = mysqli_fetch_array($cs_sql)){
                        ?>
                        <option value="<?php echo $cs_row["id"]; ?>" <?php if(isset($_GET["submit_images"])){if($_GET["submit_images"] == $cs_row["id"]){echo "selected";}} ?>><?php echo $cs_row["name"]; ?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="tw-w-1/2 md:tw-w-4/12 tw-px-2">
                    <label>Caption</label>
                    <input type="text" name="caption" class="form-control" >
                </div>
                <div class="tw-w-1/2 md:tw-w-3/12 tw-px-2">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2 md:tw-pr-0">
                    <br>
                    <button class="cs-btn tw-w-full" name="add_image">Add</button>
                </div>
            </div>
        </form>
    
        <table class="table table-responsive table-stripe">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Customer</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
                    if(mysqli_num_rows($sql) > 0){
                        while($row = mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td scope="row">#<?php echo $row["id"]; ?></td>
                    <td><img src="uploads/<?php echo $row["image"]; ?>" class="tw-w-[100px] tw-h-[100px] tw-object-cover" alt=""> <span><?php echo $row["caption"]; ?></span></td>
                    <td><?php if($row["customer"] == NULL){echo "For all (Gallery)";}else{echo user_info("name", $row["customer"]);} ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <td>
                        <a href="?delete_image=<?php echo $row["id"]; ?>" class="btn btn-danger rounded-0 tw-py-[7px] tw-text-sm tw-uppercase">Delete</a>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php require_once "includes/foot.inc.php"; ?>