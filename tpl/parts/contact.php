<?php

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;

$cnt = [
    // 'sum'     => get_theme_mod('no_impact_home_cta_sum', ''),
];

?>
<section id="contact" name="contact" class="page-section py-5">
    <div  class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="page-section-heading text-center">Contact</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-7 col-xl-7">
                <form class="needs-validation"
                    method="POST"
                    action="<?php echo home_url(); ?>"
                >

                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text"
                                class="form-control"
                                id="form-contact-name"
                                required="required"
                                maxlength="100"
                                placeholder="e.g. Nat Okpe"
                            >
                            <label for="form-contact-name" class="form-label">Name</label>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Name is required.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="email"
                                class="form-control"
                                id="form-contact-email"
                                required="required"
                                maxlength="120"
                                placeholder="mail@example.com"
                            >
                            <label for="form-contact-email" class="form-label">Email address</label>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Email is required.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control"
                                placeholder="Type your message here..."
                                id="form-contact-message"
                                rows="5"
                                style="height: 150px"
                            ></textarea>
                            <label for="form-contact-message">Message</label>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
