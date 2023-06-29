<?php

function add_theme_scripts()
{
    wp_enqueue_style('wit-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('wit-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '', true);
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');  