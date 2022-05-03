<?php
require_once "init.php";
require_once "includes/head.inc.php";

$total_img_sql = mysqli_query($conn, "SELECT * FROM gallery WHERE customer is null");
$total_img = mysqli_num_rows($total_img_sql);
$imgs_per_col = ceil($total_img / 3);
$third_col = $imgs_per_col * 2;
?>
<div class="tw-flex tw-flex-wrap tw-my-10">
    <div class="tw-w-full md:tw-w-4/12">
        <?php
            $sql = mysqli_query($conn, "SELECT * FROM gallery WHERE customer is null ORDER BY id DESC LIMIT 0,$imgs_per_col");
            if(mysqli_num_rows($sql) > 0){
                while($row = mysqli_fetch_array($sql)){
        ?>
        <div class="tw-overflow-hidden tw-my-2 tw-mx-1">
            <a href="uploads/<?php echo $row["image"]; ?>" data-lightbox="gallery" data-title="<?php echo $row["caption"]; ?>"><img src="uploads/<?php echo $row["image"]; ?>" alt="<?php echo $row["caption"]; ?>" class="tw-rounded tw-shadow hover:tw-scale-[1.2] tw-duration-200"></a>
        </div>php
        <?php } } ?>
    </div>
    <div class="tw-w-full md:tw-w-4/12">
        <?php
            $sql = mysqli_query($conn, "SELECT * FROM gallery WHERE customer is null ORDER BY id DESC LIMIT $imgs_per_col,$imgs_per_col");
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
            $sql = mysqli_query($conn, "SELECT * FROM gallery WHERE customer is null ORDER BY id DESC LIMIT $third_col,$imgs_per_col");
            if(mysqli_num_rows($sql) > 0){
                while($row = mysqli_fetch_array($sql)){
        ?>
        <div class="tw-overflow-hidden tw-my-2 tw-mx-1">
            <a href="uploads/<?php echo $row["image"]; ?>" data-lightbox="gallery" data-title="<?php echo $row["caption"]; ?>"><img src="uploads/<?php echo $row["image"]; ?>" alt="<?php echo $row["caption"]; ?>" class="tw-rounded tw-shadow hover:tw-scale-[1.2] tw-duration-200"></a>
        </div>
        <?php } } ?>
    </div>
</div>
<?php require_once "includes/foot.inc.php"; ?>