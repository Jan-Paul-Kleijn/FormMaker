<?php

/**
 * Error handling
 */
$errors = json_encode($form->errors);
$error_contents = json_encode($form->error_contents);
if(! is_admin() ) {
  $func = $form->form_maker_errors_javascript($errors,$error_contents);
  add_action('wp_head', $func);
}

?>
