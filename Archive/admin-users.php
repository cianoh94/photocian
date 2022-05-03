<?php
$login_required = ["admin"];
require_once "init.php";
require_once "includes/head.inc.php";
?>
<div class="tw-flex tw-flex-wrap tw-my-10">
    <div class="tw-w-full">
        <form action="" method="post">
            <?php
                if(isset($_GET["edit"])){
                    $edit_id = mysqli_real_escape_string($conn, $_GET["edit"]);
                    $edit_sql = mysqli_query($conn, "SELECT * FROM users WHERE id = $edit_id");
                    if(mysqli_num_rows($edit_sql) > 0){
                        $edit_row = mysqli_fetch_array($edit_sql);
            ?>
            <h4 class="tw-uppercase tw-text-xl tw-tracking-wide">Edit User</h4>
            <div class="tw-flex tw-flex-wrap tw-mb-5 tw-mt-2">
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2 md:tw-pl-0">
                    <label>Role</label>
                    <select name="role" class="form-select" required>
                        <option value="customer" <?php if($edit_row["role"] == "customer"){echo "selected";} ?>>Customer</option>
                        <option value="admin" <?php if($edit_row["role"] == "admin"){echo "selected";} ?>>Admin</option>
                    </select>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $edit_row["name"]; ?>" required>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $edit_row["email"]; ?>" required>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2">
                    <label>Change Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave Empty to keep current password" title="Leave Empty to keep current password">
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2">
                    <label>Confirm Password</label>
                    <input type="password" name="c_password" class="form-control">
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2 md:tw-pr-0">
                    <br>
                    <button class="cs-btn tw-w-full" name="update_user">Update</button>
                </div>
            </div>
            <?php
                    }else{
                        echo "No user found to edit!";   
                    }
                }else{
            ?>
            <h4 class="tw-uppercase tw-text-xl tw-tracking-wide">Add New User</h4>
            <div class="tw-flex tw-flex-wrap tw-mb-5 tw-mt-2">
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2 md:tw-pl-0">
                    <label>Role</label>
                    <select name="role" class="form-select" required>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2">
                    <label>Confirm Password</label>
                    <input type="password" name="c_password" class="form-control" required>
                </div>
                <div class="tw-w-1/2 md:tw-w-2/12 tw-px-2 md:tw-pr-0">
                    <br>
                    <button class="cs-btn tw-w-full" name="add_user">Add</button>
                </div>
            </div>
            <?php } ?>
        </form>
    
        <table class="table table-responsive table-stripe">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM users ORDER BY name");
                    if(mysqli_num_rows($sql) > 0){
                        while($row = mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td scope="row">#<?php echo $row["id"]; ?></td>
                    <td><?php echo $row["role"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row["id"]; ?>" class="cs-btn">Edit</a>
                        <a href="admin-images.php?submit_images=<?php echo $row["id"]; ?>" class="cs-btn">Submit Images</a>
                        <a href="?delete_user=<?php echo $row["id"]; ?>" class="btn btn-danger rounded-0 tw-py-[7px] tw-text-sm tw-uppercase">Delete</a>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php require_once "includes/foot.inc.php"; ?>