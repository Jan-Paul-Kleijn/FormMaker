<?php

/**
 * Set Constants for the template folder DIR and URL.
 */
if ( ! defined( 'QUOTES_DIR' ) ) {
  define( 'QUOTES_DIR', get_stylesheet_directory() . "/formMaker/" );
}
if ( ! defined( 'QUOTES_DIR_URL' ) ) {
  define( 'QUOTES_DIR_URL', get_stylesheet_directory_uri() . "/formMaker/" );
}

/**
 * Retrieve library for formMaker
 */
require_once QUOTES_DIR . "includes/class_lib.php";

$form = new form_maker();
$form->set_form_key('submitted');

require_once QUOTES_DIR . "includes/send_confirmation.php";
require_once QUOTES_DIR . "includes/confirmation_page_title.php";
require_once QUOTES_DIR . "includes/error_handling.php";
require_once QUOTES_DIR . "includes/load_scripts.php";

?>
