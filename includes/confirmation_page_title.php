<?php

/**
 * Edit the confirmation page title 
 */
if($form->is_submitted() && $form->already_submitted_without_errors()) {
  add_filter( 'the_title', 'content_title_after_sending', 10, 2 );
}

function content_title_after_sending($title, $id) {
  if ( 'formMaker/form-offertes.php' == get_post_meta( $id, '_wp_page_template', true ) ) {
    return "Bedankt voor uw aanvraag";
  }
  return $title;
}

?>
