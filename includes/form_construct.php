<?php

  /**
   * Check if the formMaker form is submitted
   */
  if((!$form->is_submitted() || $form->has_errors()) && !$form->already_submitted_without_errors()) {

    /**
     * Create the formMaker form
     */
    $form->openForm("quote");
    
    require_once QUOTES_DIR . "includes/the_form.php";

    /**
     * End formMaker form
     */
    $form->makeHoneyPot();
    $form->globalError();
    $form->makeSubmitButton("Bestellen");
    $form->set_helper_inputs();
    $form->cs_helper_inputs();
    $form->makeNameType();
    $form->makeIsRequired();
    $form->closeForm();
  }

?>
