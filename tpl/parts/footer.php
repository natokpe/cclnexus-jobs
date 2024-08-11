<?php

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;
use NatOkpe\Wp\Theme\Nexusdream\Utils\Clock;


$menu = wp_nav_menu([
    'theme_location'       => ('footer'),
    'menu_class'           => 'page-footer-menu',
    'menu_id'              => false,
    'container'            => 'nav',
    'container_class'      => 'page-footer-nav',
    'container_id'         => false,
    'container_aria_label' => '',
    'fallback_cb'          => false,
    'before'               => '',
    'after'                => '',
    'link_before'          => '',
    'link_after'           => '',
    'echo'                 => false,
    'depth'                => 1,
    // 'items_wrap'        => '',
    'item_spacing'         => 'preserve',
]);

?>
<div class="page-footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <?php echo $menu; ?>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <p class="copyright text-center">Copyright &copy; <?= Clock::nowYear() ?> <a href="<?= home_url() ?>"><?= bloginfo('name'); ?></a> | All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
