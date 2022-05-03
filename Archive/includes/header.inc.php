<header>
    <div class="tw-text-center tw-py-10">
        <a href="./"><h3 class="tw-text-5xl tw-uppercase tw-tracking-wide"><span class="tw-text-primary">Photo</span>grapher</h3></a>
    </div>
    <ul class="tw-flex tw-flex-wrap tw-justify-center cs-nav">
        <li class="tw-mx-3">
            <a href="./" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">Gallery</a>
        </li>
        <li class="tw-mx-3 dot">
            <a href="javascript:void(0)" class="tw-text-zinc-400 tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider tw-cursor-default"><i class="fas fa-circle tw-text-[5px] tw-relative !tw--top-[3px]"></i></a>
        </li>
        <li class="tw-mx-3">
            <a href="./bookings.php" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">Bookings</a>
        </li>
        <li class="tw-mx-3 dot">
            <a href="javascript:void(0)" class="tw-text-zinc-400 tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider tw-cursor-default"><i class="fas fa-circle tw-text-[5px] tw-relative !tw--top-[3px]"></i></a>
        </li>
        <li class="tw-mx-3">
            <a href="./about.php" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">About</a>
        </li>
        <?php
            if(loggedin("customer")){
        ?>
        <li class="tw-mx-3 dot">
            <a href="javascript:void(0)" class="tw-text-zinc-400 tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider tw-cursor-default"><i class="fas fa-circle tw-text-[5px] tw-relative !tw--top-[3px]"></i></a>
        </li>
        <li class="tw-mx-3">
            <a href="./account.php" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">Account</a>
        </li>
        <?php
            }
        ?>
        <?php
            if(loggedin("admin")){
        ?>
        <li class="tw-mx-3 dot">
            <a href="javascript:void(0)" class="tw-text-zinc-400 tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider tw-cursor-default"><i class="fas fa-circle tw-text-[5px] tw-relative !tw--top-[3px]"></i></a>
        </li>
        <li class="tw-mx-3">
            <a href="./admin-users.php" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">Users</a>
        </li>
        <li class="tw-mx-3 dot">
            <a href="javascript:void(0)" class="tw-text-zinc-400 tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider tw-cursor-default"><i class="fas fa-circle tw-text-[5px] tw-relative !tw--top-[3px]"></i></a>
        </li>
        <li class="tw-mx-3">
            <a href="./admin-images.php" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">Images</a>
        </li>
        <li class="tw-mx-3 dot">
            <a href="javascript:void(0)" class="tw-text-zinc-400 tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider tw-cursor-default"><i class="fas fa-circle tw-text-[5px] tw-relative !tw--top-[3px]"></i></a>
        </li>
        <li class="tw-mx-3">
            <a href="./admin-entries.php" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">Booking Entries</a>
        </li>
        <?php
            }
            if(loggedin()){
        ?>
        <li class="tw-mx-3 dot">
            <a href="javascript:void(0)" class="tw-text-zinc-400 tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider tw-cursor-default"><i class="fas fa-circle tw-text-[5px] tw-relative !tw--top-[3px]"></i></a>
        </li>
        <li class="tw-mx-3">
            <a href="./logout.php" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">Logout</a>
        </li>
        <?php
            }else{
        ?>
        <li class="tw-mx-3 dot">
            <a href="javascript:void(0)" class="tw-text-zinc-400 tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider tw-cursor-default"><i class="fas fa-circle tw-text-[5px] tw-relative !tw--top-[3px]"></i></a>
        </li>
        <li class="tw-mx-3">
            <a href="./login.php" class="hover:tw-text-primary tw-duration-300 tw-uppercase tw-font-light tw-tracking-wider">Login</a>
        </li>
        <?php } ?>
    </ul>
</header>