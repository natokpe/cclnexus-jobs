<?php

declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;

$customizer = [
    'content_layout' => [
        'title'    => 'Content and Layout',
        'priority' => 300,
        'sections' => [
            'hero' => [
                'title'    => __('Hero Banner', 'natokpe'),
                'priority' => 10,
                'controls'   => [
                    'hero_img' => [
                        'label'    => __('Banner Image', 'natokpe'),
                        'settings' => 'hero_img',
                        'type'  => function ($wp_customize, $control_id, $params) {
                            return new WP_Customize_Image_Control(
                                $wp_customize,
                                $control_id,
                                $params
                            );
                        },
                    ],

                    'hero_call' => [ 
                        'type'     => 'text',
                        'default'  => 'Evolve With Us',
                        'label'    => __('Call-In Text', 'natokpe'),
                        'settings' => [
                            'setting'    => 'hero_call',
                            'capability' => 'edit_theme_options',
                            'type'       => 'theme_mod',
                        ],
                    ],

                    'hero_cta_text' => [
                        'type'     => 'text',
                        'default'  => 'See Positions',
                        'label'    => __('CTA Button Text', 'natokpe'),
                        'settings' => 'hero_cta_text',
                    ],

                    'hero_cta_url' => [
                        'type'     => 'url',
                        'label'    => __('CTA Button URL', 'natokpe'),
                        'settings' => 'hero_cta_url',
                    ],
                ],
            ],

            'intro' => [
                'title'    => __('Brand Intro', 'natokpe'),
                'controls'   => [
                    'intro_img' => [
                        'label'    => __('Intro Image', 'natokpe'),
                        'settings' => 'intro_img',
                        'type'  => function ($wp_customize, $control_id, $params) {
                            return new WP_Customize_Image_Control(
                                $wp_customize,
                                $control_id,
                                $params
                            );
                        },
                    ],

                    'intro_h' => [
                        'type'     => 'textarea',
                        'label'    => __('Brand Name', 'natokpe'),
                        'settings' => 'intro_heading',
                    ],

                    'intro_sum' => [
                        'type'     => 'textarea',
                        'label'    => __('Summary', 'natokpe'),
                        'settings' => 'intro_sum',
                    ],

                ],
            ],

            'com' => [
                'title'    => __('Company', 'natokpe'),
                'controls'   => [
                    'com_rc' => [
                        'type'     => 'textarea',
                        'label'    => __('RC', 'natokpe'),
                        'settings' => 'com_rc',
                    ],
                ],
            ],
        ],
    ],


    'page_locations' => [
        'title'    => __('Page Locations', 'natokpe'),
        'priority' => 301,
        'controls'   => [
            'no_pg_app' => [
                'type'     => 'dropdown-pages',
                'label'    => __('Application Form', 'natokpe'),
                'settings' => [
                    'setting'    => 'page_loc[apply]',
                    'capability' => 'edit_theme_options',
                    'type'       => 'option',
                ],
            ],

            'no_pg_contact' => [
                'type'     => 'dropdown-pages',
                'label'    => __('Contact', 'natokpe'),
                'settings' => [
                    'setting'    => 'page_loc[contact]',
                    'capability' => 'edit_theme_options',
                    'type'       => 'option',
                ],
            ],

            'no_pg_about' => [
                'type'     => 'dropdown-pages',
                'label'    => __('About', 'natokpe'),
                'settings' => [
                    'setting'    => 'page_loc[about]',
                    'capability' => 'edit_theme_options',
                    'type'       => 'option',
                ],
            ],

            'no_pg_terms' => [
                'type'     => 'dropdown-pages',
                'label'    => __('Terms and Conditions', 'natokpe'),
                'settings' => [
                    'setting'    => 'page_loc[terms]',
                    'capability' => 'edit_theme_options',
                    'type'       => 'option',
                ],
            ],

            'no_pg_help' => [
                'type'     => 'dropdown-pages',
                'label'    => __('Help', 'natokpe'),
                'settings' => [
                    'setting'    => 'page_loc[help]',
                    'capability' => 'edit_theme_options',
                    'type'       => 'option',
                ],
            ],

            'no_pg_faq' => [
                'type'     => 'dropdown-pages',
                'label'    => __('Frequently Asked Questions (FAQ)', 'natokpe'),
                'settings' => [
                    'setting'    => 'page_loc[faq]',
                    'capability' => 'edit_theme_options',
                    'type'       => 'option',
                ],
            ],

        ],
    ],
];

return $customizer;
