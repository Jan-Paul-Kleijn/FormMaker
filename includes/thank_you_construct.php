<?php

  //If the email was sent, show a thank you message, otherwise show form
  if($form->form_sent_ok()) {

?>
           <div class="thanks">
<?php

    require_once QUOTES_DIR . "includes/thank_you.php";

?>
           </div>
<?php

  }
?>
