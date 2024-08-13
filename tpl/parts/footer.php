<?php

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Utils\Clock;

?>
<div class="page-footer mt-5 pt-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 border-top">
                <p class="copyright text-center pt-3 pb-3">Copyright &copy; <?= Clock::nowYear() ?> <a href="https://cclnexus.com.ng">CCL Nexus Global Ltd</a> (<?php echo get_theme_mod('com_rc', ''); ?>) | All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
