<?php
declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;

$query = new WP_Query([
    'post_type'           => 'job_position',
    'post_status'         => 'publish',
    'has_password'        => false,
    'ignore_sticky_posts' => false,
    'order'               => 'ASC',
    'orderby'             => 'date',
    'nopaging'            => true,
    'paged'               => false,
]);

?>
<section id="jobs" name="jobs" class="page-section py-5">
    <div  class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="page-section-heading text-center pt-4">Available Positions</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">

                <div class="accordion accordion-flush border-top border-bottom" id="accordionFlushExample">

<?php
while ($query->have_posts()) {
    $query->the_post();

    $jcnt = [
        'loc' => get_post_meta(get_the_ID(), 'job_loc', true),
        'type' => get_post_meta(get_the_ID(), 'job_type', true),
        'desc' => get_post_meta(get_the_ID(), 'job_desc', true),
        'resp' => get_post_meta(get_the_ID(), 'job_resp', true),
        'req' => get_post_meta(get_the_ID(), 'job_req', true),
        'ben' => get_post_meta(get_the_ID(), 'job_ben', true),
    ];

?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo get_the_ID(); ?>" aria-expanded="false" aria-controls="flush-collapse-<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></button>
                        </h2>
                        <div id="flush-collapse-<?php echo get_the_ID(); ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h3>Location</h3>
                                <div class="mb-4"><?php echo wpautop($jcnt['loc']); ?></div>

                                <h3>Type</h3>
                                <div class="mb-4"><?php echo wpautop($jcnt['type']); ?></div>
<?php
if (! empty($jcnt['desc'])) {
?>
                                <h3>Overview</h3>
                                <div class="mb-4"><?php echo wpautop($jcnt['desc']); ?></div>
<?php
}

if (! empty($jcnt['job_resp'])) {
?>
                                <h3>Responsibilities</h3>
                                <div class="mb-4"><?php echo wpautop($jcnt['job_resp']); ?></div>
<?php
}

if (! empty($jcnt['job_req'])) {
?>
                                <h3>Requirements</h3>
                                <div class="mb-4"><?php echo wpautop($jcnt['job_req']); ?></div>
<?php
}

if (! empty($jcnt['job_ben'])) {
?>
                                <h3>Benefits</h3>
                                <div class="mb-4"><?php echo wpautop($jcnt['job_ben']); ?></div>
<?php
}
?>
                                <div>
                                    <a href="<?php echo add_query_arg(['jpos' => get_the_ID()], home_url('/apply')); ?>" type="button" class="btn btn-primary px-4">Apply</a>
                                </div>
                            </div>
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
