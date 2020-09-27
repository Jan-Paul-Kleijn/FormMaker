<?php

/**
 * Price buildup, much interaction with JQuery here.
 */

?>
           <div class="quote-price"<?php echo ($form->form_sent_ok() ? ' style="display:block"' : ''); ?>>
             <span class="quote-price-control quote-price-up"></span>
             <h2>Prijs<span class="price"><span><?php echo $form->add_thousand_separator($form->quote_subtotal()); ?></span></span></h2>
             <div class="quote-details">
               <div class="quote-lines" id="quote_lines"><?php $form->make_quote_lines(); ?></div>
               <div class="quote-line-dotted">
                 <span></span>
                 <span></span>
               </div>
               <div class="quote-subtotal">
                 <span class="description">Totaal</span>
                 <span class="price">
                   <span>
<?php

  echo $form->add_thousand_separator($form->quote_subtotal());

?>
                   </span>
                 </span>
               </div>
               <div class="quote-tax">
                 <span class="description">Btw 21%</span>
                 <span class="price">
                   <span>
<?php

  echo $form->add_thousand_separator(($form->quote_subtotal() * .21));

?>
                   </span>
                 </span>
               </div>
               <div class="quote-line-dotted">
                 <span></span>
                 <span></span>
               </div>
               <div class="quote-total">
                 <span class="description">Totaal</span>
                 <span class="price">
                   <span>
<?php

  echo $form->add_thousand_separator(($form->quote_subtotal() + ($form->quote_subtotal() * .21)));

?>
                   </span>
                 </span>
               </div>
             </div>
           </div>
