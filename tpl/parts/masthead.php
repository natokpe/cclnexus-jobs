<?php

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;

?>
<section class="masthead">
    <div class="container-fluid g-0">
        <div class="row g-0 align-items-stretch">
            <div class="col-lg-7 col-xl-8">
                <div class="masthead-image d-flex align-items-stretch" style="background-image: url('<?php echo get_theme_mod('hero_img', ''); ?>');">
                    <div class="masthead-image-overlay d-flex align-items-stretch">
                        <div class="masthead-image-content d-flex flex-column align-items-stretch justify-content-end">
                            <h1><?php echo get_theme_mod('hero_call', ''); ?></h1>
                            <a href="<?php echo get_theme_mod('hero_cta_url', ''); ?>" class="btn btn-primary mt-3 px-5"><?php echo get_theme_mod('hero_cta_text', ''); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4 align-items-stretch">
                <div class="row g-0 align-items-stretch">
                    <div class="col-md-6 col-lg-12">
                        <div class="masthead-brand d-flex flex-column align-items-center justify-content-center">
                            <img class="masthead-brand-image" src="<?php echo Theme::url('assets/img/mb.jpg') ?>" />
                            <h3 class="masthead-brand-name mt-2">Maramma Bitters</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12">
                        <div class="masthead-desc d-flex align-items-center justify-content-center">
                            <p><?php echo get_theme_mod('intro_sum', ''); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
