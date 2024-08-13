<?php
/**
 * Template Name: Homepage
 */

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;

Theme::add_body_classes('navbar-float');

get_header();
?>
<div class="content-frame">
    <header class="content-frame-header">
        <?php get_template_part('tpl/parts/navbar'); ?>
    </header>

    <main class="content-frame-body">
<?php
get_template_part('tpl/parts/masthead');
get_template_part('tpl/parts/positions');
get_template_part('tpl/parts/faq');
get_template_part('tpl/parts/contact');
?>
    </main>

    <footer class="content-frame-footer">
        <?php get_template_part('tpl/parts/footer'); ?>
    </footer>
</div>
<?php

get_footer();
