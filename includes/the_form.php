<?php

    /**
     * Create formMaker form inputs
     */
    $form->create_form_input("input", array(
      'key' => 'contactName',
      'label' => 'Naam',
      'placeholder' => 'Uw naam',
      'required' => true,
      'error_response_type' => 'use_label_possessive'
    ));
    $form->create_form_input("input", array(
      'key' => 'email',
      'type' => 'email',
      'label' => 'E-mail adres',
      'placeholder' => 'Uw e-mail adres',
      'required' => true,
      'error_response_type' => 'use_label_possessive'
    ));

?>
<!-- Introductory text -->
  <h2>Bestellijst</h2>
  <p>Klik op onderstaande vleessoorten voor een uitgebreide lijst.</p>

<!-- HTML for fieldset open/close toggle button -->
  <h3 class="vleessoort rundvlees" data-toggle="rundvlees_aanbod">Rundvlees<span class="vleessoort-extended">Jonge runderen van het ras Blonde d'acquitaine</span></h3>

<!-- HTML for fieldset & contents -->
  <div id="rundvlees_aanbod" class="bq-wide togglee">
    <div class="bq-flex">
<?php

    $form->create_form_input("input", array(
      'key' => 'rundergehakt',
      'label' => 'Rundergehakt',
      'label_extension' => '100% puur rundvlees zonder toevoegingen', 
      'price' => 5.98,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'price_type' => 'volume',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'biefstuk',
      'label' => 'Biefstuk',
      'price' => 14.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kogelbiefstuk',
      'label' => 'Kogelbiefstuk',
      'price' => 17.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'diamanthaas',
      'label' => 'Diamanthaas',
      'price' => 17.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'rib-eye',
      'label' => 'Rib-eye',
      'price' => 15.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'entrecote-biefstuk',
      'label' => 'Entrec&#244;te',
      'price' => 15.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'cote-de-boeuf',
      'label' => 'C&#244;te de Boeuf',
      'price' => 13.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lendebiefstuk',
      'label' => 'Lendebiefstuk',
      'price' => 17.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'stoofvlees',
      'label' => 'Runderstoofvlees',
      'price' => 8.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'stooflappen',
      'label' => 'Runderstooflappen',
      'price' => 8.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'bloemstuk',
      'label' => 'Bloemstuk',
      'price' => 9.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'rosbief',
      'label' => 'Rosbief',
      'price' => 11.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'runderschenkel',
      'label' => 'Runderschenkel',
      'price' => 5.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'runderribben',
      'label' => 'Runderribben',
      'label_extension' => 'Vanaf 3kg &#8364;&nbsp;5,50&nbsp;p/kg', 
      'price' => 5.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'riblappen',
      'label' => 'Runderriblappen',
      'price' => 8.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'ossenhaas',
      'label' => 'Ossenhaas',
      'price' => 35.00,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'staartstuk',
      'label' => 'Staartstuk/Picanha',
      'price' => 13.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'soepvlees',
      'label' => 'Soepvlees',
      'price' => 7.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'bavette',
      'label' => 'Bavette',
      'price' => 12.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'tartaar',
      'label' => 'Tartaar',
      'price' => 7.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'ossenstaart',
      'label' => 'Ossenstaart',
      'price' => 7.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'runderlever',
      'label' => 'Runderlever',
      'price' => 2.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'runderhart',
      'label' => 'Runderhart',
      'price' => 2.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

?>
    </div>
  </div>
  <h3 class="vleessoort lamsvlees" data-toggle="lamsvlees_aanbod">
    Lamsvlees
    <span class="vleessoort-extended">Jonge luxe Hollandse lammeren die in de natuur hebben geleefd</span>
  </h3>
  <div id="lamsvlees_aanbod" class="bq-wide togglee">
    <div class="bq-flex">
<?php

    $form->create_form_input("input", array(
      'key' => 'lamsboutzonderschenkel',
      'label' => 'Lamsbout',
      'label_extension' => 'Zonder schenkel, &#177;&nbsp;4,00&nbsp;kg', 
      'price' => 9.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsboutmetschenkel',
      'label' => 'Lamsbout met schenkel',
      'label_extension' => '&#177;&nbsp;5,00&nbsp;kg', 
      'price' => 9.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsschoudercompleet',
      'label' => 'Lamsschouder',
      'label_extension' => 'Complete lamsschouder, &#177;&nbsp;3,00&nbsp;kg', 
      'price' => 8.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsschenkel',
      'label' => 'Lamsschenkel',
      'price' => 8.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsnek',
      'label' => 'Lamsnek',
      'price' => 8.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamskoteletten',
      'label' => 'Lamskoteletten',
      'price' => 14.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamshaasjes',
      'label' => 'Lamshaasjes',
      'label_extension' => '&#177;&nbsp;120-150 gr', 
      'price' => 19.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsboutschijven',
      'label' => 'Lamsboutschijven',
      'label_extension' => 'Naar gelief dikke of dunne schijven', 
      'price' => 10.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamskarbonadekoteletten',
      'label' => 'Lamskarbon. koteletten',
      'label_extension' => 'Lamskarbonade koteletten', 
      'price' => 12.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsgehakt',
      'label' => 'Lamsgehakt',
      'label_extension' => '100% puur lamsgehakt', 
      'price' => 7.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsspareribs',
      'label' => 'Lamsspareribs',
      'label_extension' => 'Gesneden of compleet', 
      'price' => 8.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsrollade',
      'label' => 'Lamsrollade',
      'label_extension' => 'Gekruid en gemarineerd', 
      'price' => 17.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsorganen',
      'label' => 'Lamsorganen',
      'label_extension' => 'Lever, hart, testikels en nieren', 
      'price' => 3.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamstong',
      'label' => 'Lamstong',
      'price' => 3.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsrack',
      'label' => 'Lamsrack',
      'price' => 23.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsbiefstuk',
      'label' => 'Lamsbiefstuk',
      'price' => 19.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamskop',
      'label' => 'Lamskop',
      'price' => 2.00,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'st',
      'price_type' => 'unit',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

?>
    </div>
  </div>
  <h3 class="vleessoort kalfsvlees" data-toggle="kalfsvlees_aanbod">
    Kalfsvlees
    <span class="vleessoort-extended">A-kwaliteit kalfsvlees</span>
  </h3>
  <div id="kalfsvlees_aanbod" class="bq-wide togglee">
    <div class="bq-flex">
<?php

    $form->create_form_input("input", array(
      'key' => 'kalfsoester',
      'label' => 'Kalfsoester',
      'price' => 19.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsgebraad',
      'label' => 'Kalfsgebraad',
      'price' => 14.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsstoofvlees',
      'label' => 'Kalfsstoofvlees',
      'price' => 12.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfskotelettennaturel',
      'label' => 'Kalfskoteletten',
      'price' => 13.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfskotelettengemarineerd',
      'label' => 'Kalfskoteletten gem.',
      'label_extension' => 'Heerlijk gemarineerd',
      'price' => 14.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsschouderblad',
      'label' => 'Kalfsschouderblad',
      'label_extension' => 'Schouderblad met been',
      'price' => 7.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsspareribsnaturel',
      'label' => 'Kalfsspareribs nat.',
      'price' => 7.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsspareribsgekruid',
      'label' => 'Kalfsspareribs gekr.',
      'label_extension' => 'Gekruid &amp; gemarineerd',
      'price' => 10.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsgehakt',
      'label' => 'Kalfsgehakt',
      'price' => 7.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'ossobuco',
      'label' => 'Ossobuco',
      'price' => 9.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfslever',
      'label' => 'Kalfslever',
      'price' => 9.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfshart',
      'label' => 'Kalfshart',
      'price' => 4.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfshersenen',
      'label' => 'Kalfshersenen',
      'price' => 2.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'st',
      'price_type' => 'unit',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfspoten',
      'label' => 'Kalfspoten',
      'label_extension' => 'Gebroeid/gebrand',
      'price' => 3.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfspens',
      'label' => 'Kalfspens',
      'label_extension' => 'Gebroeid',
      'price' => 4.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsstaartstuk',
      'label' => 'Kalfsstaartstuk',
      'price' => 15.95,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

?>
    </div>
  </div>
  <h3 class="vleessoort kipkalkoen" data-toggle="kipkalkoen_aanbod">
    Kip &amp; Kalkoen
    <span class="vleessoort-extended">A-kwaliteit reguliere kip</span>
  </h3>
  <div id="kipkalkoen_aanbod" class="bq-wide togglee">
    <div class="bq-flex">
<?php

    $form->create_form_input("input", array(
      'key' => 'kipfilet',
      'label' => 'Kipfil&#233;t',
      'label_extension' => '* 10kg voor &#8364;&nbsp;55,00', 
      'price' => 5.75,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipbout',
      'label' => 'Kippebout',
      'label_extension' => '* 10kg voor &#8364;&nbsp;17,95', 
      'price' => 2.00,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipdrumsticks',
      'label' => 'Drumsticks',
      'label_extension' => '* 10kg voor &#8364;&nbsp;27,50', 
      'price' => 3.00,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipvleugels',
      'label' => 'Kippevleugels',
      'label_extension' => '* 10kg voor &#8364;&nbsp;24,99', 
      'price' => 2.85,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipvleugelsplat',
      'label' => 'Kippevleugels plat',
      'label_extension' => '* 10kg voor &#8364;&nbsp;32,50', 
      'price' => 3.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipborrelhapjes',
      'label' => 'Borrelhapjes kip',
      'label_extension' => 'Diverse borrelhapjes en TV-sticks. * 10kg voor &#8364;&nbsp;32,50', 
      'price' => 3.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipdijfilet',
      'label' => 'Kippedijfil&#233;t',
      'label_extension' => '* 10kg voor &#8364;&nbsp;47,50', 
      'price' => 4.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipheelgroot',
      'label' => 'Hele kip (groot)',
      'label_extension' => 'Gewicht: 1100-1300 gram. Vanaf 10kg voor &#8364;&nbsp;2,85 p/kg', 
      'price' => 2.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipheelklein',
      'label' => 'Hele kip (klein)',
      'label_extension' => 'Gewicht: &#177;&nbsp;900 gram. Vanaf 4 stuks voor &#8364;&nbsp;2,50 p/st', 
      'price' => 2.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'st',
      'price_type' => 'unit',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipsoep',
      'label' => 'Soepkip',
      'price' => 3.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'st',
      'price_type' => 'unit',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kippoulet',
      'label' => 'Poulet naturel',
      'price' => 6.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipvinken',
      'label' => 'Kipvinken',
      'price' => 1.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'st',
      'price_type' => 'unit',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipshoarma',
      'label' => 'Kipshoarma',
      'price' => 6.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipburger',
      'label' => 'Kippenhamburgers',
      'price' => 1.25,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'st',
      'price_type' => 'unit',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalkoenstoofvlees',
      'label' => 'Kalkoenstoofvlees',
      'price' => 6.50,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kiporganen',
      'label' => 'Kip organen',
      'label_extended' => 'Lever - hart - maag - nek',
      'price' => 2.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipkarkas',
      'label' => 'Kip karkas',
      'label_extended' => 'Kippekarkassen voor soep',
      'price' => 0.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipmais',
      'label' => 'Maiskip',
      'price' => 4.99,
      'thumb' => 'https://web3.werkzien.nl/wp-content/themes/twentytwenty/formMaker/images/wireframe_image.png',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

?>
    </div>
  </div>
  <h3 class="vleessoort vlugklaar" data-toggle="vlugklaar_aanbod">
    Vlugklaar &amp; BBQ
    <span class="vleessoort-extended">Ambachtelijk bereid</span>
  </h3>
  <div id="vlugklaar_aanbod" class="bq-wide togglee">
    <div class="bq-flex">
<?php

    $form->create_form_input("input", array(
      'key' => 'kalfsspareribsgem',
      'label' => 'Kalfsspareribs gem.',
      'label_extension' => 'Ambachtelijk gemarineerd, &#177;&nbsp;700 gram per stuk', 
      'price' => 10.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'borrelhapjesgem',
      'label' => 'Borrelhapjes gem.',
      'label_extension' => 'Variatie van gemarineerde stukjes vlees, &#177;&nbsp;30 gram per stuk', 
      'price' => 4.99,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipfiletlapjegem',
      'label' => 'Kipfiletlapje gem.',
      'label_extension' => 'Ambachtelijk gemarineerd, &#177;&nbsp;130 gram per stuk', 
      'price' => 9.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipschnitzel',
      'label' => 'Kipschnitzel',
      'label_extension' => '&#177;&nbsp;150 gram per stuk', 
      'price' => 10.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipspies',
      'label' => 'Kipspies',
      'price' => 1.25,
      'thumb' => '',
      'price_per' => 'st',
      'price_type' => 'unit',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'rundergyros',
      'label' => 'Rundergyros',
      'label_extension' => 'Malse beefreepjes gekruid', 
      'price' => 12.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'pepersteak',
      'label' => 'Peper steak',
      'label_extension' => 'Malse biefstuk, pittig met peperkorrels', 
      'price' => 10.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'runderspiesjes',
      'label' => 'Runderspiesjes',
      'label_extension' => '&#177;&nbsp;80 gram per stuk', 
      'price' => 19.50,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsspiesjes',
      'label' => 'Kalfsspiesjes',
      'label_extension' => '&#177;&nbsp;80 gram per stuk', 
      'price' => 19.50,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsspiesjes',
      'label' => 'Lamsspiesjes',
      'label_extension' => '&#177;&nbsp;80 gram per stuk', 
      'price' => 19.50,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsbiefstuk',
      'label' => 'Lamsbiefstuk',
      'price' => 19.50,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipchipolata',
      'label' => 'Kipchipolata',
      'label_extension' => '&#177;&nbsp;80 gram per stuk', 
      'price' => 7.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipchipolatagek',
      'label' => 'Kipchipolata gek.',
      'label_extension' => 'Ambachtelijk gekruid, &#177;&nbsp;80 gram per stuk', 
      'price' => 7.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'runderbiefstukgemdun',
      'label' => 'Runderbiefstuk gem.',
      'label_extension' => 'Gemarineerde, dun gesneden runderbiefstuk', 
      'price' => 16.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsboutschijvengem',
      'label' => 'Lamsboutschijven gem.',
      'label_extension' => 'Ambachtelijk gemarineerd', 
      'price' => 12.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamskotelettengem',
      'label' => 'Lamskoteletten gem.',
      'label_extension' => 'Ambachtelijk gemarineerd', 
      'price' => 15.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'hamburgerrund',
      'label' => 'Hamburger rund',
      'label_extension' => 'Zeer smaakvolle hamburger, &#177;&nbsp;150 gram per stuk', 
      'price' => 9.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'lamsshoarma',
      'label' => 'Lamsshoarma',
      'label_extension' => 'Heerlijk gekruide reepjes lamsvlees', 
      'price' => 14.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kippouletgem',
      'label' => 'Kippoulet gem.',
      'label_extension' => 'Ambachtelijk gemarineerd', 
      'price' => 8.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipshoarma',
      'label' => 'Kipshoarma',
      'price' => 6.99,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalkoenshoarma',
      'label' => 'Kalkoenshoarma',
      'price' => 6.50,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipkebab',
      'label' => 'Kipkebab',
      'label_extension' => 'Voorgegaard', 
      'price' => 10.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'Kipkebabkg',
      'label' => 'Kipkebab 1kg schaal',
      'label_extension' => 'Voorgegaard, 1kg voordeelschaal', 
      'price' => 9.95,
      'thumb' => '',
      'price_per' => 'st',
      'number_decimal_steps' => 1,
      'type' => 'number',
      'number_decimals' => 0,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'dijfiletgem',
      'label' => 'Dijfilet gem.',
      'label_extension' => 'Ambachtelijk gemarineerd, &#177;&nbsp;110 gram per stuk', 
      'price' => 6.50,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'rundermerquez',
      'label' => 'Rundermerquez',
      'label_extension' => 'Heerlijk gekruide worstjes met rundvlees', 
      'price' => 7.50,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kipmerquez',
      'label' => 'Kipmerquez',
      'label_extension' => 'Heerlijk gekruide worstjes met kip', 
      'price' => 7.50,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("input", array(
      'key' => 'kalfsstaartstukgem',
      'label' => 'Kalfsstaartstuk gem.',
      'label_extension' => 'Ambachtelijk gemarineerd', 
      'price' => 16.95,
      'thumb' => '',
      'price_per' => 'kg',
      'number_decimal_steps' => 0.1,
      'type' => 'number',
      'number_decimals' => 2,
      'required' => false,
      'multiplier' => true,
      'error_response_type' => 'use_label_undefined'
    ));

?>
    </div>
  </div>
  <h3 class="vleessoort compleet" data-toggle="compleet_aanbod">
    Complete delen
    <span class="vleessoort-extended">Lam - Rund - Kalf</span>
  </h3>
  <div id="compleet_aanbod" class="togglee">
    <div class="form-block">
      <p>Wilt u complete delen bestellen? Als u contact op met onze slagerij dan helpen we u graag.</p>
      <table class="complete-delen">
        <tr>
          <th scope="col">Complete delen</th>
          <th scope="col">Lam-rund-kalf</th>
          <th scope="col">p/kg</th>
        </tr>
        <tr>
          <td>Heel/half lam</td>
          <td>gewicht: 20 - 35 kg, leeftijd: &lt; 1jaar</td>
          <td>&#8364; 6,00 - &#8364; 9,95</td>
        </tr>
        <tr>
          <td>Lamsvoorspan</td>
          <td>compleet of half, ong 10kg</td>
          <td>&#8364; 6,00 - &#8364; 7,50</td>
        </tr>
        <tr>
          <td>Lamsachterspan</td>
          <td>dubbel of enkel</td>
          <td>&#8364; 9,95</td>
        </tr>
        <tr>
          <td>Schaap</td>
          <td>gewicht: 40 - 65 kg, leeftijd: &gt; 3 jaar, enkel compleet</td>
          <td>&#8364; 5,50</td>
        </tr>
        <tr>
          <td>Jonge geiten</td>
          <td>gewicht: 8 - 25 kg, leeftijd: 6 maanden - 1,5 jaar</td>
          <td>&#8364; 6,00 - &#8364; 9,95</td>
        </tr>
        <tr>
          <td>Geitenbokken</td>
          <td>gewicht: 25 - 45 kg, leeftijd: 1,5 - 5 jaar</td>
          <td>&#8364; 4,00 - &#8364; 6,00</td>
        </tr>
        <tr>
          <td>Rundervoorvoet</td>
          <td>&#177;&nbsp;100kg</td>
          <td>&#8364; 5,50</td>
        </tr>
        <tr>
          <td>Runderachtervoet</td>
          <td>&#177;&nbsp;80kg</td>
          <td>&#8364; 7,50</td>
        </tr>
        <tr>
          <td>Rundernek</td>
          <td>&#177;&nbsp;35kg</td>
          <td>&#8364; 6,50</td>
        </tr>
        <tr>
          <td>Kalfsachtervoet</td>
          <td>&#177;&nbsp;35kg</td>
          <td>&#8364; 8,50</td>
        </tr>
        <tr>
          <td>Kalfsvoorvoet</td>
          <td>&#177;&nbsp;35kg</td>
          <td>&#8364; 6,50</td>
        </tr>
        <tr>
          <td>Kalfsschouder met nek</td>
          <td>&#177;&nbsp;25kg</td>
          <td>&#8364; 5,95</td>
        </tr>
      </table>
    </div>
  </div>
<?php

    $form->create_form_input("textarea", array(
      'key' => 'comments',
      'type' => 'textarea',
      'label' => 'Eventuele opmerkingen',
      'rows' => 4,
      'error_response_type' => 'use_label_undefined'
    ));

    $form->create_form_input("mathcaptcha", array(
      'label' => 'Controle-invoer',
      'label_extension' => false,
      'error_response_type' => 'use_label_defined_1'
    ));

?>
