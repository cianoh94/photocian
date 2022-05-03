
</div>
    <div class="tw-border-t tw-border-zinc-200 tw-py-5 tw-text-center">
        <div class="tw-container tw-mx-auto">
            <p class="tw-text-zinc-500">&copy; Copyright 2022 - All rights & wrongs reserved.</p>
        </div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3 remove-toast" style="z-index: 11">
        <?php foreach(error() as $error){ ?>
        <div class="toast p-0 fade show tw-mb-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="alert alert-danger m-0">
                <div class="tw-flex tw-px-[11px]">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"><i class="ri-close-line tw-relative tw--top-1 tw-text-lg"></i></button>
                </div>
                <div class="toast-body">
                    <?php echo $error; ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php foreach(msg() as $msg){ ?>
        <div class="toast p-0 fade show tw-mb-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="alert alert-success m-0">
                <div class="tw-flex tw-px-[11px]">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"><i class="ri-close-line tw-relative tw--top-1 tw-text-lg"></i></button>
                </div>
                <div class="toast-body">
                    <?php echo $msg; ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    
    <script>
        $(document).ready(function(){
            function removeToast(seconds){
                setTimeout(function(){
                    $(".remove-toast").fadeOut();
                }, seconds)
            }
            removeToast(5000);
        });
    </script>
</body>
</html>