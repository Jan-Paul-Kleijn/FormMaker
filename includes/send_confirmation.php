<?php

// Send confirmation

// Check if the form is submitted
if($form->is_submitted()) {

  // Clean all posted values.
  $form->clean_posted();

  // Make sure there have been no errors
  if(! $form->has_errors()) {

    // Set the session variable based on the form key to true. 
    $form->set_session_val($form->get_form_key(), 'true');

    // Change the page title after the form has been sent.
    add_filter('the_title', 'content_title_after_sending', 10, 2);

/**
 * Create the e-mails sent to the user and the administration.
 * Input values can be retrieved with the clean_input([$key], [$type](, [$required=true])), where $key stands for the input name, $type stands for the input type and $required indicating a required field or not (defaults to true).
 */

    echo "Form is sent.";

/*
    $emailTo = get_bloginfo( 'name' )." <".get_bloginfo( 'admin_email').">";
    $subject = 'Offerteaanvraag van: '.$form->clean_input('contactName','text');
    $body = "Name: ".$form->clean_input('contactName','text')."\r\nEmail: ".$form->clean_input('email','email')."\r\nComments: ".$form->clean_input('comments','textarea');
    $headers = "From: ".$form->clean_input('contactName','text')." <".$emailTo.">\r\nReply-To: " . $form->clean_input('email','email');
    mail($emailTo, $subject, $body, $headers);
    if($form->is_checkbox_checked('sendCopy','yes')) {
      $subject = 'You emailed <strong>Your Name</strong>';
      $headers = 'From: <strong>Your Name</strong> <<strong>noreply@somedomain.com</strong>>';
      mail($email, $subject, $body, $headers);
    }
*/

  }

} else {

  // Set the session variable based on the form key to false. 
  $form->set_session_val($form->get_form_key(), 'false');

}

?>
