<?php
declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;

$cnt = [
    'jobs' => new WP_Query([
        'has_password' => false,
        'post_type'    => 'job_position',
        'post_status'  => 'publish',
        'nopaging'     => true,
        // 'meta_key'     => 'user_id',
        // 'meta_value'   => $cnt['user']->ID,
        'order'        => 'ASC',
        'order_by'     => 'title',
    ]),
];

?>
<section id="jobs" name="jobs" class="page-section py-4">
    <div  class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="page-section-heading text-center">Available Positions</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">

                <div class="accordion accordion-flush border-top border-bottom" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Production Manager</button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h3>Job Description</h3>
                                <p>Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</p>

                                <h3>Responsibilities</h3>
                                <p>Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</p>

                                <h3>Requirements</h3>
                                <p>Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</p>

                                <h3>Benefits</h3>
                                <p>Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</p>

                                <div>
                                    <a href="#" type="button" class="btn btn-primary">Apply for this</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">Secretary</button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h3>Job Description</h3>
                                <p>Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</p>
                                <div>
                                    <a href="#" type="button" class="btn btn-primary">Apply for this</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Production Manager</button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h3>Job Description</h3>
                                <p>Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</p>
                                <div>
                                    <a href="#" type="button" class="btn btn-primary">Apply for this</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<?php
