<?php

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;

$query = new WP_Query([
    'post_type'           => 'faq',
    'post_status'         => 'publish',
    'has_password'        => false,
    'ignore_sticky_posts' => false,
    'order'               => 'DESC',
    'orderby'             => 'date',
    'nopaging'            => true,
    'paged'               => false,
]);

?>
<section id="faq" name="faq" class="page-section py-5">
    <div  class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="page-section-heading text-center">Frequently Asked Questions</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">

                <div class="accordion border-0" id="accordionFaq">
<?php
while ($query->have_posts()) {
    $query->the_post();
?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-<?php echo get_the_ID(); ?>" aria-expanded="false" aria-controls="faq-collapse-<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></button>
                        </h2>
                        <div id="faq-collapse-<?php echo get_the_ID(); ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                            <div class="accordion-body"><?php echo get_the_content() ?></div>
                        </div>
                    </div>
<?php
}
wp_reset_postdata();

?>
                </div>

            </div>
        </div>
    </div>
</section>
<?php
