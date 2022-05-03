<?php
require_once "init.php";
require_once "includes/head.inc.php";
?>
<div class="tw-flex tw-flex-wrap tw-my-10">
    <div class="tw-w-full md:tw-w-6/12 tw-mx-auto">
        <h4 class="tw-uppercase tw-text-xl tw-tracking-wide tw-text-center">Booking</h4>
        <form action="" method="post">
            <label for="">Name</label>
            <input type="text" class="form-control tw-py-2 tw-mb-4" name="name" required>
            <label for="">Email</label>
            <input type="email" class="form-control tw-py-2 tw-mb-4" name="email" required>
            <label for="">Subject</label>
            <input type="text" class="form-control tw-py-2 tw-mb-4" name="subject" required>
            <label for="">Message</label>
            <textarea name="message" id="" cols="" rows="10" class="form-control tw-py-2 tw-mb-4"></textarea>
            <button class="cs-btn tw-w-full !tw-py-3 tw-rounded" name="add_booking">Submit</button>
        </form>
    </div>
</div>
<?php require_once "includes/foot.inc.php"; ?>