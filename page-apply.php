<?php
/**
 * Template Name: Apply
 */

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;
use NatOkpe\Wp\Theme\Nexusdream\Utils\Request;

if (! function_exists('wp_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
}

Theme::add_body_classes('navbar-float');

$ctaa = get_page_link(Theme::page('apply'));


$cnt = [
    'jobs' => [],

    'edu'  => [
        'masters'  => 'Masters',
        'bachelor' => 'Bachelor degree',
        'ssce'     => 'Senior Secondary School certificate',
        'jsce'     => 'Junior Secondary School certificate',
        'primary'  => 'First School Leaving certificate',
    ],

    'know' => [
        'word_of_mouth' => 'Word of mouth',
        'google'        => 'Google',
        'facebook'      => 'Facebook',
        'instagram'     => 'Instagram',
        'x'             => 'X',
        'tiktok'        => 'Tiktok',
        'other'         => 'Other',
    ],

    'feedback' => [
        'title'     => 'Failed',
        'msg'       => 'An error occurred.',
        'link_text' => 'Go Back',
        'link_url'  => get_page_link(Theme::page('apply')),
    ],
];

foreach (((new WP_Query([
    'post_type'           => 'job_position',
    'post_status'         => 'publish',
    'has_password'        => false,
    'ignore_sticky_posts' => false,
    'order'               => 'ASC',
    'orderby'             => 'date',
    'nopaging'            => true,
    'paged'               => false,
]))->posts) as $_) {
    $cnt['jobs'][$_->ID] = $_->post_title;
}

$pass        = 0;
$screen      = null;
$form_errors = [];
$form        = [
    'size_cv'     => 5000000,
    'size_letter' => 1000000,
    'nonce_id'    => 'form_apply',
    'nonce'       => Request::post('nd_vtkn') ?? '',
    'job'         =>
    ctype_digit((string) Request::get('jpos') ?? '') ? (int) Request::get('jpos') : null,
    'name'        => trim(Request::post('nd_name') ?? ''),
    'email'       => trim(Request::post('nd_email') ?? ''),
    'phone'       => trim(Request::post('nd_phone') ?? ''),
    'edu'         => trim(Request::post('nd_edu') ?? ''),
    'skills'      => trim(Request::post('nd_skills') ?? ''),
    'about'       => trim(Request::post('nd_about') ?? ''),
    'cv'          =>
    empty(Request::file('nd_cv')['tmp_name'] ?? '') ? null : Request::file('nd_cv'),
    'letter'      =>
    empty(Request::file('nd_letter')['tmp_name'] ?? '') ? null : Request::file('nd_letter'),
    'know'        => trim(Request::post('nd_know') ?? ''),
    'terms'       => (Request::post('nd_terms') === true) || (strtolower(Request::post('nd_terms') ?? '') === 'on') || (strtolower(Request::post('nd_terms') ?? '') === 'yes'),
];

if (Request::get('pvw') === 'fdb' && (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') === 'GET')) {
    switch (Request::get('sta')) {
        case 'f':
            $cnt['feedback'] = [
                'title'     => 'Application failed to submit',
                'msg'       => 'Your application was not submitted due to some errors that occurred. Try resubmitting your application later. Contact support if you keep seeing this message.',
                'link_text' => 'Go Back',
                'link_url'  => get_page_link(Theme::page('apply')),
            ];

            if (wp_verify_nonce(Request::get('nnc'), 'app_failed')) {
                $screen = 'feedback';
            }
            break;

        case 'e':
            $cnt['feedback'] = [
                'title'     => 'Cannot submit multiple applications',
                'msg'       => 'Sorry, it looks like you have previously submitted an application. Contact support if you have forgotten your Application Reference. If you feel this must be an error, kindly send us a message and we will have it resolved. Thank you.',
                'link_text' => 'Go Back',
                'link_url'  => get_page_link(Theme::page('apply')),
            ];

            if (wp_verify_nonce(Request::get('nnc'), 'app_exists')) {
                $screen = 'feedback';
            }
            break;

        case 's':
            $cnt['feedback'] = [
                'title'     => 'Application Submitted',
                'msg'       => 'Your application has been submitted successfully. Your Application Reference is ' . (Request::get('apr') ?? 'N/A') . '. Copy your Application Reference and quote it in all correspondence.',
                'link_text' => 'Go to home',
                'link_url'  => home_url(),
            ];

            if (wp_verify_nonce(Request::get('nnc'), 'app_success')) {
                $screen = 'feedback';
            }
            break;

        default:
            $screen = null;
            break;
    }
}

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $form['job'] = ctype_digit((string) Request::post('jpos') ?? '') ? (int) Request::post('jpos') : null;

    if (! wp_verify_nonce($form['nonce'], $form['nonce_id'])) {
        $pass++;
    }

    if (! array_key_exists($form['job'], $cnt['jobs'])) {
        $pass++;
    }

    if (empty($form['name']) || (strlen($form['name']) > 100)) {
        $pass++;
    }

    if (empty($form['email']) || (strlen($form['email']) > 80)) {
        $pass++;
    }

    if (! ctype_digit($form['phone']) || (strlen($form['phone']) !== 11)) {
        $pass++;
    }

    if (! array_key_exists($form['edu'], $cnt['edu'])) {
        $pass++;
    }

    if (empty($form['skills']) || (strlen($form['skills']) > 500)) {
        $pass++;
    }

    if (empty($form['about']) || (strlen($form['about']) > 500)) {
        $pass++;
    }

    if ((($form['cv']['error'] ?? null) !== UPLOAD_ERR_OK) || (($form['cv']['type'] ?? null) !== 'application/pdf') || (($form['cv']['size'] ?? 0) < 5000) || (($form['cv']['size'] ?? 0) > $form['size_cv'])) {
        $pass++;
    }

    if (isset($form['letter'])) {
        if ((($form['letter']['error'] ?? null) !== UPLOAD_ERR_OK) || (($form['letter']['type'] ?? null) !== 'application/pdf') || (($form['letter']['size'] ?? 0) < 3000) || (($form['letter']['size'] ?? 0) > $form['size_letter'])) {
            $pass++;
        }
    }

    if (! array_key_exists($form['know'], $cnt['know'])) {
        $pass++;
    }

    if ($form['terms'] !== true) {
        $pass++;

        $form_errors['terms'] = 'You must accept the terms.';
    }

    // check if application already exist
    if (! empty((new WP_Query([
        'post_type'    => 'job_application',
        'nopaging'     => true,
        'meta_query'   => [
            [
                'key'     => 'email',
                'value'   => $form['email'],
                'compare' => '=',
            ],
        ]
    ]))->posts)) {
        wp_redirect(
            add_query_arg(
                [
                    'pvw' => 'fdb', // page = feedback
                    'sta' => 'e', // status = exists
                    'nnc' => wp_create_nonce('app_exists'),
                ],
                get_page_link(Theme::urlNow())
            )
        );
        exit;
    }

    if ($pass < 1) {
        $pass = false;

        $form['cv'] = wp_handle_upload(
            $form['cv'],
            [
                'test_form' => false,
                'test_size' => true,
                'test_type' => true,
                'mimes'     => [
                    'pdf'  => 'application/pdf',
                ],
            ]
        );

        $pass = ! array_key_exists('error', $form['cv']);

        if (isset($form['letter'])) {
            $form['letter'] = wp_handle_upload(
                $form['letter'],
                [
                    'test_form' => false,
                    'test_size' => true,
                    'test_type' => true,
                    'mimes'     => [
                        '[pdf]'  => 'application/pdf',
                    ],
                ]
            );

            $pass = $pass && (! array_key_exists('error', $form['letter']));
        }

        if ($pass) {
            do_action('submit_application', [
                'job'         => $form['job'],
                'name'        => $form['name'],
                'email'       => $form['email'],
                'phone'       => $form['phone'],
                'edu'         => $form['edu'],
                'skills'      => $form['skills'],
                'about'       => $form['about'],
                'cv'          => $form['cv']['url'] ?? '',
                'letter'      => $form['letter']['url'] ?? null,
                'know'        => $form['know'],
            ]);

            $pass = (new WP_Query([
                'post_type'    => 'job_application',
                'nopaging'     => true,
                'meta_query'   => [
                    [
                        'key'     => 'email',
                        'value'   => $form['email'],
                        'compare' => '=',
                    ],
                ],
            ]))->posts;

            if (! empty($pass)) {
                wp_redirect(
                    add_query_arg(
                        [
                            'pvw' => 'fdb',
                            'sta' => 's',
                            'apr' => get_post_meta($pass[0]->ID, 'ref', true),
                            'nnc' => wp_create_nonce('app_success'),
                        ],
                        get_page_link(Theme::urlNow())
                    )
                );
            } else {
                wp_delete_file($form['cv']['file']);

                if (isset($form['letter'])) {
                    wp_delete_file($form['letter']['file']);
                }

                wp_redirect(
                    add_query_arg(
                        [
                            'pvw' => 'fdb',
                            'sta' => 'f',
                            'nnc' => wp_create_nonce('app_failed'),
                        ],
                        get_page_link(Theme::urlNow())
                    )
                );
            }
        }
    }
}

get_header();
?>
<div class="content-frame">
    <header class="content-frame-header">
        <?php get_template_part('tpl/parts/navbar'); ?>
    </header>

    <main class="content-frame-body mt-2 pt-5">
<?php
switch ($screen) {
    case 'feedback':
?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="page-section-heading text-center"><?php echo $cnt['feedback']['title'] ?? 'Failed'; ?></h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-7 col-xl-7">
                    <p class="text-center"><?php echo $cnt['feedback']['msg'] ?? 'An error occurred.'; ?></p>
                    <p class="text-center"><a href="<?php echo $cnt['feedback']['link_url'] ?? get_page_link(Theme::page('apply')); ?>"><?php echo $cnt['feedback']['link_text'] ?? 'Go Back'; ?></a></p>
                </div>
            </div>
        </div>
<?php
        break;

    default:
?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="page-section-heading text-center">Apply</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-7 col-xl-7">
                    <form class="needs-validation"
                        method="POST"
                        action="<?php echo Theme::urlNow(); ?>"
                        enctype="multipart/form-data"
                    >
                        <input type="hidden"
                            hidden
                            name="MAX_FILE_SIZE"
                            value="<?php echo $form['size_cv']; ?>"
                        ><!-- measured in bytes -->

                        <input type="hidden"
                            hidden
                            name="nd_vtkn"
                            value="<?php echo wp_create_nonce($form['nonce_id']); ?>" 
                        >

                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="form-apply-job" aria-label="Which position are you applying for?" required name="jpos">
                                    <option>--Select--</option>
<?php
foreach ($cnt['jobs'] as $_ => $__) {
?>
                                    <option value="<?php echo $_; ?>"<?php echo ($form['job'] === $_ ? ' selected' : ''); ?>><?php echo $__; ?></option>
<?php
}
?>
                                </select>
                                <label for="form-apply-job">Which position are you applying for?</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control"
                                    id="form-apply-name"
                                    required
                                    maxlength="100"
                                    placeholder="e.g. Nat Okpe"
                                    aria-describedby="form-apply-name-help"
                                    name="nd_name"
                                    value="<?php echo $form['name']; ?>" 
                                >
                                <label for="form-apply-name" class="form-label">Full Name</label>
                                <div id="form-apply-name-help" class="form-text">Include your first name, surname and other names. E.g. Nathaniel Okpe</div>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Full name is required.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="email"
                                    class="form-control"
                                    id="form-apply-email"
                                    required
                                    maxlength="80"
                                    placeholder="mail@example.com"
                                    aria-describedby="form-apply-email-help"
                                    name="nd_email"
                                    value="<?php echo $form['email']; ?>"
                                >
                                <label for="form-apply-email" class="form-label">Email Address</label>
                                <div id="form-apply-email-help" class="form-text">Your contact email. E.g. natokpe@gmail.com</div>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Email is required.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="phone"
                                    class="form-control"
                                    id="form-apply-phone"
                                    required
                                    maxlength="11"
                                    placeholder="e.g. 07012345678"
                                    aria-describedby="form-apply-phone-help"
                                    name="nd_phone"
                                    value="<?php echo $form['phone']; ?>"
                                >
                                <label for="form-apply-phone" class="form-label">Phone Number</label>
                                <div id="form-apply-phone-help" class="form-text">Your contact phone number. Preferably a WhatsApp number. E.g. 07012345678</div>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Phone number is required.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select"
                                    id="form-apply-edu"
                                    aria-label="Highest Educational Qualification"
                                    required
                                    name="nd_edu" 
                                >
                                    <option>--Select--</option>
<?php
foreach ($cnt['edu'] as $_ => $__) {
?>
                                    <option value="<?php echo $_; ?>"<?php echo ($form['edu'] === $_ ? ' selected' : ''); ?>><?php echo $__; ?></option>
<?php
}
?>
                                </select>
                                <label for="form-apply-edu">Highest Educational Qualification</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="form-apply-skills">Describe a skill or quality that you believe is essential for this role, and how you have developed or utilized this skill in your previous experiences.</label>
                            <textarea class="form-control"
                                placeholder="Type here..."
                                id="form-apply-skills"
                                rows="5"
                                style="height: 150px"
                                aria-describedby="form-apply-skills-help"
                                name="nd_skills" 
                                required
                                minlength="1"
                                maxlength="500" 
                            ><?php echo $form['skills']; ?></textarea>
                            <div id="form-apply-skills-help" class="form-text">Max length: 500 characters.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="form-apply-about">Tell us more about yourself. Focus on your past experiences that have shaped your professional journey. Also highlight any key roles that have been instrumental in your career development.</label>
                            <textarea class="form-control"
                                placeholder="Type here..."
                                id="form-apply-about"
                                rows="5"
                                style="height: 150px"
                                aria-describedby="form-apply-about-help"
                                name="nd_about"
                                required
                                minlength="1"
                                maxlength="500" 
                            ><?php echo $form['about']; ?></textarea>
                            <div id="form-apply-about-help" class="form-text">Max length: 500 characters.</div>
                        </div>

                        <div class="mb-3">
                            <label for="apply-cv" class="form-label">Upload your CV</label>
                            <input type="file"
                                class="form-control"
                                id="apply-cv"
                                aria-describedby="apply-cv-help"
                                required
                                name="nd_cv"
                                accept=".pdf"
                            >
                            <div id="apply-cv-help" class="form-text">Max file size: 5MB. Format: PDF.</div>
                        </div>

                        <div class="mb-3">
                            <label for="form-apply-cover-letter" class="form-label">Upload your Cover Letter <small>(Optional)</small></label>
                            <input type="file"
                                class="form-control" 
                                id="apply-cover-letter"
                                aria-describedby="form-apply-letter-help"
                                name="nd_letter"
                                accept=".pdf"
                            >
                            <div id="form-apply-letter-help" class="form-text">Max file size: 1MB. Format: PDF.</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="form-apply-about" aria-label="How did you hear about us?" name="nd_know" required>
                                    <option>--Select--</option>
<?php
foreach ($cnt['know'] as $_ => $__) {
?>
                                    <option value="<?php echo $_; ?>"<?php echo ($form['know'] === $_ ? ' selected' : ''); ?>><?php echo $__; ?></option>
<?php
}
?>
                                </select>
                                <label for="form-apply-about">How did you hear about us?</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox"
                                    class="form-check-input"
                                    id="form-apply-terms"
                                    required
                                    name="nd_terms"
                                    <?php echo ($form['terms'] ? 'checked' : ''); ?>
                                >
                                <label class="form-check-label" for="form-apply-terms">I agree to the <a href="<?= get_page_link(Theme::page('terms')) ?>">Terms and Conditions</a> and <a href="<?= get_page_link(Theme::page('policy')) ?>">Privacy Policy</a>.</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
        break;
}
?>
    </main>

    <footer class="content-frame-footer">
        <?php get_template_part('tpl/parts/footer'); ?>
    </footer>
</div>
<?php

get_footer();
