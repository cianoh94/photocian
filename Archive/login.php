<?php
$login_page = true;
require_once "init.php";
require_once "includes/head.inc.php";
?>
<div class="tw-flex tw-flex-wrap tw-my-10">
    <div class="tw-w-full md:tw-w-4/12 tw-mx-auto">
        <h4 class="tw-uppercase tw-text-xl tw-tracking-wide text-center tw-mb-5">Login</h4>
        <form action="" method="post">
            <input type="email" class="form-control rounded-0 tw-p-3 tw-mb-3" placeholder="Email" name="email" required>
            <input type="password" class="form-control rounded-0 tw-p-3 tw-mb-3" placeholder="Password" name="password" required>
            <button class="cs-btn tw-w-full !tw-p-4" name="login">Login</button>
        </form>
    </div>
</div>
<?php require_once "includes/foot.inc.php"; ?>