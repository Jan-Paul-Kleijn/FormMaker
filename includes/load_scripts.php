<?php

/**
 * Load neccessary stylesheets & scripts
 */
if (!function_exists('load_formMaker_forms_scripts')) {
  function load_formMaker_forms_scripts() {
    wp_enqueue_style( 'formMaker-styles', QUOTES_DIR_URL . "assets/css/style.css" );
    wp_enqueue_style( 'formMaker-custom-styles', QUOTES_DIR_URL . "assets/css/custom-style.css" );
    wp_register_script( 'formMaker-script', QUOTES_DIR_URL . "assets/js/script.js", array( 'jquery' ), false, true );
    wp_enqueue_script( 'formMaker-script' );
  }
}
add_action( 'wp_enqueue_scripts', 'load_formMaker_forms_scripts' );

?>
