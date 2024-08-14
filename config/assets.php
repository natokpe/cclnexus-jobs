<?php
declare(strict_types = 1);

use NatOkpe\Wp\Theme\Nexusdream\Theme;

$styles = [];
$scripts = [
    'jquery' => null,
];

$styles['no-nexusdream'] = [
    'src'   => Theme::url('style.css'),
    'deps'   => [],
    'ver'   => false,
    'media' => 'all'
];

$scripts['no-nexusdream'] = [
    'src'    => Theme::url('script.js'),
    'deps'    => [],
    'ver'    => false,
    'footer' => true
];

return [
    'styles'  => $styles,
    'scripts' => $scripts,
];
