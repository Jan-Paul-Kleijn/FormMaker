<?php
class form_maker {
  var $post_val;
  var $session_val;
  var $errors = array();
  var $name_type = array();
  var $is_required = array();
  var $form_key;
  var $form_id;
  var $error_contents = array(
    "global_error_msg" => "Een of meer velden bevatten een fout. Controleer dit a.u.b. en probeer het opnieuw.",
    "global_ok_msg" => "Alle velden zijn goed ingevuld.", 
    "empty" => "Dit veld is verplicht.",
    "empty_with_label_possessive" => "U bent vergeten om uw %s in te vullen.",
    "empty_with_label_defined_article_1" => "U bent vergeten om de %s in te vullen.",
    "empty_with_label_defined_article_2" => "U bent vergeten om het %s in te vullen.",
    "empty_with_label_undefined_article" => "U bent vergeten om een %s in te vullen.",
    "empty_single_check" => "U dient het bovenstaande te accorderen door dit aan te vinken.",
    "empty_check" => "Vink minimaal &#233;&#233;n van de bovenstaande %s opties aan.",
    "empty_radio" => "Maak een keuze uit &#233;&#233;n van de bovenstaande %s opties.",
    "empty_textarea" => "Dit vak voor invoer is verplicht.",
    "empty_select" => "Kies &#233;&#233;n van de %s opties uit de selectielijst.", 
    "email_invalid" => "Het ingevoerde e-mailadres is ongeldig.",
    "wrong_decimal_separator" => "De notatie voor decimalen is verkeerd ingevoerd.",
    "only_numbers" => "De invoer mag alleen een getal zijn zonder decimalen.",
    "only_x_decimals" => "De invoer mag alleen een getal zijn met maximaal %s decimalen.",
    "number_is_zero" => "De invoer is te laag",
    "only_number_between" => "De invoer mag alleen een getal zijn tussen 1 en 19, zonder decimalen.",
    "bad_math" => "Het ingevoerde controlegetal is verkeerd.",
    "honeypot_activated" => "De internet-bot val is geactiveerd."
  );
  var $localizedlang = array(
    "inquire_for_price" => "op aanvraag"
  );

  function set_form_key($key) {
    $this->form_key = $key;
  }

  function get_form_key() {
    return $this->form_key;
  }

  function set_form_id($id) {
    $this->form_id = $id;
  }

  function get_form_id() {
    return $this->form_id;
  }

  function get_post_val($key) {
    if(key_exists($key, $_POST)) {
      $this->post_val = $_POST[$key];
    }
    return $this->post_val;
  }

  function get_post_val_as_array($key) {
    if(key_exists($key, $_POST)) {
      if(is_array($_POST[$key])) {
        $this->post_val = $this->sanitize_post_val_array($_POST[$key]);
      } else {
        $arr[] = sanitize_text_field($_POST[$key]);
        $this->post_val = $arr;
      }
      return $this->post_val;
    }
    return [];
  }

  function clean_posted() {
    $input_types_raw = explode("|", $this->get_post_val('name_type'));
    foreach($input_types_raw as $value) {
      $key_val = explode(":",$value);
      $input_types[$key_val[0]] = $key_val[1];
    }
    $inputs_required_raw = explode("|", $this->get_post_val('is_required'));
    foreach($inputs_required_raw as $value) {
      $key_val = explode(":",$value);
      $inputs_required[$key_val[0]] = ($key_val[1] == 1 ? true : false);
    }
    foreach($_POST as $key => $value) {
      if(array_key_exists($key, $input_types)) {
        $this->clean_input($key,$input_types[$key],$inputs_required[$key]);
      }
    }
  }

  function get_session_val($key) {
    if(key_exists($key, $_SESSION)) {
      $this->session_val = sanitize_text_field($_SESSION[$key]);
    } else {
      return false;
    }
    return $this->session_val;
  }
  
  function set_session_val($key,$val) {
    $_SESSION[$key] = $val;
  }

  function is_submitted() {
    if(key_exists($this->form_key, $_POST)) {
      return true;
    }
		  return false;
  }

  function is_checkbox_checked($key,$val) {
    $checkarray = $this->get_post_val_as_array($key);
    foreach($checkarray as $checkbox) {
      if($checkbox == $val) return true;
    }
    return false;
  }

  function has_errors() {
    if(count($this->errors) > 0) {
      return true;
    }
    return false;
  }

  public function form_maker_errors_javascript( $e = '', $a = '') {
    $output = sprintf("<script type=\"text/javascript\">var form_errors = %s, error_contents = %s;</script>\n",$e,$a);
    $func = function() use($output) { print $output; };
    return $func;
  }

  function site() {
    $directory = dirname($_SERVER['SCRIPT_NAME']);
    $host = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
    $website = $directory == '/' ? $host.'/' : $host.$directory.'/';
    return $website;
  }

  /**
   * Single: 	If true, returns only the first value for the specified meta key. This parameter has no effect if $key is not specified.
   * Default value: false
   */
  function get_meta_from_page($id, $meta_field, $single=false) {
    $meta = get_post_meta($id, $meta_field, $single);
    if (!empty( $meta )) {
      if(is_array($meta)) {
        return $this->sanitize_post_val_array($meta);
      } else {
        return sanitize_text_field($meta);
      }
    }
  }

  function set_error($key, $error) {
    if(! $this->is_hidden_client_side($key)) {
      if(! key_exists($key, $this->errors)) {
        $this->errors[$key] = $error;
      }
    }
  }

  function set_name_type($key, $type) {
    if(! key_exists($key, $this->name_type)) {
      $this->name_type[$key] = $type;
    }
  }

  function get_name_type() {
    return str_replace('=', ':', http_build_query($this->name_type, null, '|'));
  }

  function set_is_required($key, $required) {
    if(! key_exists($key, $this->is_required)) {
      $this->is_required[$key] = $required;
    }
  }

  function get_is_required() {
    return str_replace('=', ':', http_build_query($this->is_required, null, '|'));
  }

  function is_hidden_client_side($key) {
    if($this->get_post_val('hidden_inputs')) {
      $hidden_inputs = explode('|', $this->get_post_val('hidden_inputs'));
      return in_array($key, $hidden_inputs);
    }
    return false;
  }
  
  function is_empty($key) {
    $val = $this->get_post_val($key);
    if(!is_array($val)) {
      if(trim($val) == '') {
        return true;
      }
    } else {
      if(empty($this->get_post_val_as_array($key))) {
        return true;
      }
    }
    return false;
  }

  function mathCaptcha() {
    $x = rand(1, 9);
    $y = rand(1, 9);
    $site = $this->site();
    $this->get_session_val($site.'mathCaptcha-digit');
    if (! $this->get_session_val($site.'mathCaptcha-digit')) {
      $_SESSION[$site.'mathCaptcha-digit'] = $x + $y;
      $_SESSION[$site.'mathCaptcha-digit-x'] = $x;
      $_SESSION[$site.'mathCaptcha-digit-y'] = $y;
    }
  }

  function checkMathCaptcha($key) {
    $digit = intval($this->get_session_val($this->site().'mathCaptcha-digit'));
    $input = intval($this->get_post_val($key));
    if($digit === $input) {
      unset($_SESSION[$this->site().'mathCaptcha-digit']);
      return true;
    }
    return false;
  }

  function check_honeypot($key) {
    if($this->is_submitted() && $this->post_val == '') {
      return true;
    }
    return false;
  }

  function has_error($key) {
    return key_exists($key, $this->errors);
  }

  function get_error($key) {
    return $this->errors[$key];
  }
  
  function required_is_hidden($key) {
    $hidden_required_inputs_val = $this->get_post_val("hidden_required_inputs");
    $required_inputs_val = $this->get_post_val("required_inputs");
    if($hidden_required_inputs_val != '') {
      $hidden_required_inputs_val = str_replace("[]","",$hidden_required_inputs_val);
      $hidden_required_inputs = explode("|", $hidden_required_inputs_val);
      if(in_array($key,$hidden_required_inputs)) {
        return true;
      }
    }
    return false;
  }

  function clean_input($key, $type, $required=true) {
    if($this->is_submitted()) {
      if(!is_array($this->get_post_val($key))) {
        $value = $this->get_post_val($key);
        if($type == "text" || $type == "hidden" || $type == "select" || $type == "checkradio" || $type == "date" || $type == "month" || $type == "week" || $type == "tel" || $type == "color" || $type == "email") {
          $value = sanitize_text_field($value);
        } elseif($type == "textarea") {
          $value = sanitize_textarea_field($value);
        } elseif($type == "number" || $type == "range") {
          $value = $this->tofloat($value);
        } elseif($type == "mathcaptcha") {
          $value = filter_var($value, FILTER_VALIDATE_INT, array("options" => array("min_range"=>2, "max_range"=>18)));
          if(!$value) $value = "";
        } elseif($type == "honeypot") {
          $value = sanitize_text_field($value);
        } else {
          $value = '';
        }
      } else {
        $arr = $this->get_post_val($key);
        $value = $this->sanitize_post_val_array($arr);
      }
      if($required && !$this->required_is_hidden($key)) {
        if($this->is_empty($key)) {
          $this->set_error($key, $this->error_contents['empty']);
        }      
        if($type == "email" && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->set_error($key, $this->error_contents['email_invalid']);
        }
        if($type == "mathcaptcha") {
          if($value != "" && !filter_var($value, FILTER_VALIDATE_INT, array("options" => array("min_range"=>2, "max_range"=>18)))) {
            $this->set_error($key, $this->error_contents['only_number_between']);
          } elseif(! $this->checkMathCaptcha($key)) {
            $this->set_error($key, $this->error_contents['bad_math']);
          }
        }
      } elseif($type == "honeypot") {
        if(!$this->check_honeypot($key)) {
          $this->set_error($key, $this->error_contents['honeypot_activated']);
        }
      }
      return $value;
    }
  }

  function sanitize_post_val_array($arr) {
    if(!empty($arr)) {
      foreach($arr as $key => $value) {
        $clean_arr[$key] = sanitize_text_field($value);
      }
      return $clean_arr;
    }
    return false;
  }

  function preset_select($key,$options) {
    $key = sanitize_text_field($key);
    foreach($options as $option) {
      $option = sanitize_text_field($option);
      $option_elements = explode('|',$option);
      if(array_key_exists($key, $_GET)) {
        $option_element = sanitize_text_field($_GET[$key]);
        if($option_elements[0] == $option_element) {
          $_POST[$key] = $option_element;
        }
      }
    }
  }

  function tofloat($num) {
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    if(($dotPos > $commaPos) && $dotPos) {
      $sep = $dotPos;
    } else {
      if(($commaPos > $dotPos) && $commaPos) {
        $sep = $commaPos;
      } else {
        return floatval(preg_replace("/[^\\-0-9]/", "", $num));
      }
    }
    return floatval(preg_replace("/[^\\-0-9]/", "", substr($num, 0, $sep)) . '.' . preg_replace("/[^\\-0-9]/", "", substr($num, $sep+1, strlen($num))));
  }

  function set_default_attribute_values(&$attr_array) {
    $attr_defaults = array(
      'label' => false,
      'type' => 'text',
      'value' => "",
      'number_decimals' => 0,
      'number_decimal_steps' => 0.5,
      'thumb' => false,
      'price_per' => 'st',
      'price_type' => 'volume',
      'check_or_radio' => 'checkbox',
      'placeholder' => false,
      'label_extension' => false,
      'required' => false,
      'rows' => 4,
      'multiplier' => false,
      'price' => false,
      'range' => false,
      'range_default_value' => 0,
      'color_default_value' => '#cc3399',
      'use_opener' => false,
      'mod' => false,
      'error_response_type' => 'plain'
    );
    foreach($attr_defaults as $attr => $default_value) {  
      if(!array_key_exists($attr,$attr_array)) {
        $attr_array[$attr] = $default_value;
      }
    }
    $attr_array['options'] = array($attr_array['value']."|".$attr_array['label']."|".$attr_array['price']);
  }

  function add_required_to_session($key,$required) {
    $current_session_vals = explode("|", trim($this->get_session_val("required_values"), "|"));
    if($required) {
      if(!in_array($key, $current_session_vals)) {
        array_push($current_session_vals,$key);
        $this->set_session_val("required_values", implode("|",$current_session_vals));
      }
    }
  }

  function array_slice_assoc($array,$keys) {
    return array_intersect_key(array_flip($keys),$array);
  }

  function create_form_input($type,$args) {
    if($type == "input") {
      $this->makeInputElement($args);
    } elseif($type == "textarea") {
      $this->makeTextareaElement($args);
    } elseif($type == "select") {
      $this->makeSelectElement($args);
    } elseif($type == "checkbox" || $type == "radio") {
      $args["check_or_radio"] = $type;
      $this->makeCheckElement($args);
    } elseif($type == "mathcaptcha") {
      $this->makeMathCaptcha($args);
    }
  }

  function openForm($id) {

?>
        <form action="<?php htmlspecialchars(the_permalink()); ?>" id="<?php echo $id; ?>" method="post" novalidate="novalidate">
<?php

    $this->set_form_id($id);
  }


  function closeForm() {

?>
        </form>
<?php
 
  }

/**
 * Create input element in HTML.
 * Usage:
 * - key: Used for 'name' and 'id' attribute of the input element. 
 *        Also used for the 'for' attribute in the label element.
 *        This is a required input. (string)
 * - type: Used for the input 'type' attribute.
 *         Defaults to ['text']. (string)
 * - number_decimals: Indicates how many decimals this input can receive.
 *                    Defaults to [0]. (int)
 * - number_decimal_steps: Indicates the size of the incremental steps that is used by the browser number input 
 *                         interface, the spinner.
 *                         Defaults to [0.5]. (float)
 * - label: Human readable description of the input.
 *          Defaults to [false]. (bool)(string)
 * - label_extension: A bit of extra information that is added to the label as a new block of text,
 *                    positioned under the main label description in normal font-weight.
 *                    Defaults to [false]. (bool)(string)
 * - thumb: Thumbnail of product sold. Only a full url is an accepted value here. If a thumbnail is used by passing
 *          a valid url, the layout for the form changes to the wide screen column style layout.
 *          Defaults to [false]. (bool)(string)
 * - placeholder: Hint for input, shown in the input in light type.
 *                Defaults to [false]. (bool)(string)
 * - required: Indicates if this element should be a required input.
 *             Defaults to [false]. (boolean)
 * - multiplier: Indicates if this input should function as a multiplier for the price.
 *               This can only be used for inputs of the 'number' type, in which the user can only input an int.
 *               The price refers to the 'data-mod-price' attribute from this input or it can refer to the
 *               'data-mod-price' attribute from the input of the opener.
 *               Defaults to [false]. (boolean)
 * - price: The price that belongs to this input, noted as a number with a decimal point (if neccesary) and
 *          without thousand separator, ie. 1450.50.
 *          Defaults to [false]. (bool)(float)
 * - price_per: The unit description of how the product is sold.
                Defaults to [''].
 * - price_type: Defines how this product is sold. Types available: volume, unit.
 *               Defaults to ['unit']. 
 * - range: The number range that is used for the 'range' type input., noted as '0-10'.
 *          If this input is not or incorrectly given, the HTML standard of 0-100 will be used.
 *          Defaults to [false]. (bool)(string)
 * - range_default_value: The value that is set as default.
 *                        Defaults to [0]. (int)
 * - color_default_value: The value that is set for the default color, defined as a 7-character string specifying
 *                        an RGB color in hexadecimal format. Example: '#cc3399'.
 *                        Defaults to ['#cc3399']. (string)
 * - use_opener: The types of information that need to be retrieved from opener by JavaScript.
 *               Multiple types are separated by '|'. Types available: info, price.
 *               Defaults to [false]. (bool)(string)
 * - error_response_type: Indicates how the error response is displayed on screen. Types available:
 *                        - 'use_label_possessive': Use the name of the label in the error response, with 
 *                                                  possessive pronoun (as in 'your' name).
 *                        - 'use_label_undefined': The same but with undefined article (as in 'a' flower).
 *                        - 'use_label_defined_1': The same but with defined article (as in 'the' bus).
 *                        - 'use_label_defined_2': The same but with another variation of a defined
 *                                                 article (used in other languages).
 *                        - 'plain': Use the standard error response.
 *                        Defaults to ['plain']. (string)
 */

  function makeInputElement($args) {
    $this->set_default_attribute_values($args);
    $this->set_name_type($args['key'], $args['type']);
    $this->set_is_required($args['key'],$args['required']);
    $label = $args['label'] ? $args['label'] : '';
    if($args['required']) $main_item_class[] = 'required';
    if($args['thumb']!==false) $main_item_class[] = 'order-item';
?>
          <p class="<?php echo implode(' ', $main_item_class); ?>">
            <label for="<?php echo $args['key']; ?>">
<?php 

    if($args['thumb']!==false) {

?>
              <span class="item-wrap">
                <span class="thumb-wrap">
<?php

      if(is_numeric($args['thumb'])) {
        echo wp_get_attachment_image( $args['thumb'], 'medium', false, ["class" => "form-item-thumb lightboxed"] );
      }

?>
                </span>
                <span class="form-item-price <?php echo ($args['price']===false?'inquire':'price'); ?>" style="transform: rotate(<?php echo rand(-5,5); ?>deg)"><?php echo ($args['price']===false?$this->localizedlang["inquire_for_price"]:number_format($this->tofloat($args['price']), 2, ',', '.') . ' p/' . $args['price_per']); ?></span>
                <span class="form-item-name"><?php echo $label; ?></span>
<?php

      if($args['label_extension']) {

?>
                <span class="label_extension"><?php echo $args['label_extension']; ?></span>
<?php

      }

?>
              </span>
<?php 

    } else {
      echo $label;
      echo ($args['label_extension'] ? '<span class="label_extension">' . $args['label_extension'] . '</span>' : '');
    }

?>
              <span class="input-wrap">
<?php

    $type_attributes = 'type="'.$args['type'].'"';
    $value = $this->clean_input($args['key'],$args['type'],$args['required']);
    if($args['type'] == "email") {
      $type_attributes .= ' pattern="^[A-Za-z0-9._+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,63}$"';
    } elseif($args['type'] == "number") {
      $type_attributes .= ' min="0"';
      if($args['number_decimals'] > 0) {
        $type_attributes .= ' data-decimals="'.$args['number_decimals'].'" pattern="[0-9]*[.,]?[0-9]+" step="'.$args['number_decimal_steps'].'"';
      }
    } elseif($args['type'] == "range") {
      if($args['range']) {
        $minmax = explode('-',$args['range']);
        if(is_array($minmax) && count($minmax) == 2) {
          $type_attributes .= ' min="'.$minmax[0].'" max="'.$minmax[1].'"';
        }
      }
      $value = $value != $args['range_default_value'] ? $value : $args['range_default_value'];
    } elseif($args['type'] == "color") {
      $value = $args['color_default_value'];
    }

    if($args['multiplier'] && !$args['price'] && !$args['use_opener']) {
      $this->set_error($args['key'], 'No price or opener available for use with multiplier. Please contact the admin.');
    } else {
      if($args['price']) {
        $type_attributes .= ' data-mod-price="'.$this->tofloat($args['price']).'"';
      } 
      if($args['price_per']) {
        $type_attributes .= ' data-price-per="'.$args['price_per'].'"';
      } 
      if($args['price_type']) {
        $type_attributes .= ' data-price-type="'.$args['price_type'].'"';
      } 
      if($args['use_opener']) {
        $type_attributes .= ' data-mod-use-opener="'.$args['use_opener'].'"';
      }
      if($args['multiplier'] && ($args['type'] == "number" || $args['type'] == "range")) {
        $type_attributes .= ' data-mod-multiplier="yes"';
      }
    }

?>
                 <?php if($args['thumb']) echo '<span class="input-with-unit">'; ?><input <?php echo $type_attributes; if($args['thumb']) echo ' dir="rtl"'; ?> name="<?php echo $args['key']; ?>" id="<?php echo $args['key']; ?>"<?php echo ($args['placeholder'] ? ' placeholder="' . $args['placeholder'] . '"' : ''); ?> value="<?php echo $value; ?>"<?php if($args['required']) echo ' required="required" aria-required="true" aria-invalid="'.($this->has_error($args['key']) ? 'true' : 'false').'" data-error-response-type="'.$args['error_response_type'].'"'; ?> /> <?php if($args['thumb']) echo '<span class="unit">' . $args['price_per'] . '</span></span>'; ?>
<?php

    if($args['required']==true) {

?>
                <span class="required-input-field"></span>
<?php

    }

?>
                <span role="alert" class="form-not-valid-tip"<?php echo ($this->has_error($args['key']) ? '' : ' style="display: none"'); ?>><? if($this->has_error($args['key'])) echo $this->get_error($args['key']); ?></span>
              </span>
            </label>
          </p>
<?php

    $this->add_required_to_session($args['key'],$args['required']);
  }


/**
 * Create textarea element in HTML.
 * Usage:
 * - key: Used for 'name' and 'id' attribute of the input element. 
 *        Also used for the 'for' attribute in the label element.
 *        This is a required input. (string)
 * - label: Human readable description of the input, in normal (500) font-weight.
 *          Defaults to [false]. (bool)(string)
 * - label_extension: A bit of extra information that is added to the label as a new block of text,
 *                    positioned under the main label description in light (300) font-weight.
 *                    Defaults to [false]. (bool)(string)
 * - rows: The number of rows that sets the height of the textarea.
 *         Defaults to [4]. (int)
 * - required: Indicates if this element should be a required input.
 *             Defaults to [false]. (boolean)
 * - error_response_type: Indicates how the error response is displayed on screen. Types available:
 *                        - 'use_label_possessive': Use the name of the label in the error response, with 
 *                                                  possessive pronoun (as in 'your' name).
 *                        - 'use_label_undefined': The same but with undefined article (as in 'a' flower).
 *                        - 'use_label_defined_1': The same but with defined article (as in 'the' bus).
 *                        - 'use_label_defined_2': The same but with another variation of a defined
 *                                                 article (used in other languages).
 *                        - 'plain': Use the standard error response.
 *                        Defaults to ['plain']. (string)
 */

  function makeTextareaElement($args) {
    $this->set_default_attribute_values($args);
    $this->set_name_type($args['key'], 'textarea');
    $this->set_is_required($args['key'],$args['required']);

?>
          <p<?php if($args['required']) echo ' class="required"'; ?>>
            <label for="<?php echo $args['key']; ?>">
              <?php echo ($args['label'] ? $args['label'] : '') . ($args['label_extension'] ? '<span class="label_extension">' . $args['label_extension'] . '</span>' : ''); ?>
              <span class="input-wrap">
                <textarea name="<?php echo $args['key']; ?>" id="<?php echo $args['key']; ?>"<?php echo ($args['placeholder'] ? ' placeholder="' . $args['placeholder'] . '"' : ''); ?> rows="<?php echo $args['rows']; ?>"<?php if($args['required']) echo ' required="required" aria-required="true" aria-invalid="'.($this->has_error($args['key']) ? 'true' : 'false').'" data-error-response-type="'.$args['error_response_type'].'"'; ?>><?php echo $this->clean_input($args['key'],'textarea',$args['required']); ?></textarea>
<?php

    if($args['required']==true) {

?>
                <span class="required-input-field"></span>
<?php

    }

?>
                <span role="alert" class="form-not-valid-tip"<?php echo ($this->has_error($args['key']) ? '' : ' style="display: none"'); ?>><? if($this->has_error($args['key'])) echo $this->get_error($args['key']); ?></span>
              </span>
            </label>
          </p>
<?php

    $this->add_required_to_session($args['key'],$args['required']);
  }


/**
 * Create select element in HTML, based on an array of options.
 * Usage:
 * - key: Used for 'name' and 'id' attribute of the input element. 
 *        Also used for the 'for' attribute in the label element.
 *        This is a required input. (string)
 * - label: Human readable description of the input, in normal (500) font-weight.
 *          Defaults to [false]. (bool)(string)
 * - label_extension: A bit of extra information that is added to the label as a new block of text,
 *                    positioned under the main label description in light (300) font-weight.
 *                    Defaults to [false]. (bool)(string)
 * - mod: Indicates if this element opens another element when an option is selected.
 *        Defaults to false. (bool)
 * - placeholder: Hint for input, shown in the input in light type.
 *                Defaults to [false]. (bool)(string)
 * - required: Indicates if this element should be a required input.
 *             Defaults to [false]. (boolean)
 * - meta_field_name: The name of the WordPress page meta field that holds the values, used for the options.
 *                    The values of the meta field are in the form of 'name|description|price'.
 *                    The input values for 'name' and 'description' are mandatory and the value for 'cost' is optional.
 *                    This is a required input which is done in the WP page backend by adding a meta field.
 */

  function makeSelectElement($args) {
    $this->set_default_attribute_values($args);
    $this->set_name_type($args['key'], 'select');
    $this->set_is_required($args['key'],$args['required']);
    $modified_elem = (! $args['mod'] ? '' : ' data-mod-display="' .$args['key']. '_contents"');
    $options = (array_key_exists('meta_field_name', $args) ? $this->get_meta_from_page(get_the_ID(), $args['meta_field_name']) : []);
    if(array_key_exists('meta_field_name', $args)) {
      $options = $this->get_meta_from_page(get_the_ID(), $args['meta_field_name']);
    } else {
      $options = $args['options'];
    }
    if(! empty($options)) {
      $this->preset_select($args['key'],$options);

?>
          <p<?php if($args['required']) echo ' class="required"'; ?>>
            <label for="<?php echo $args['key']; ?>">
              <?php echo ($args['label'] ? $args['label'] : '') . ($args['label_extension'] ? '<span class="label_extension">' . $args['label_extension'] . '</span>' : ''); ?>
              <span class="input-wrap select-wrap">
                <select name="<?php echo $args['key']; ?>" id="<?php echo $args['key']; ?>"<?php echo $modified_elem; ?><?php if($args['required']) echo ' required="required" aria-required="true" aria-invalid="'.($this->has_error($args['key']) ? 'true' : 'false').'"'; ?>>
                  <option value="" disabled="" selected="" hidden="hidden"><?php echo $args['placeholder']; ?></option>
<?php

      foreach($options as $option) {
        $option_array = explode('|',$option);
        $mod_price = count($option_array) > 2 ? ' data-mod-price="' .$option_array[2]. '"' : '';

?>
                  <option value="<?php echo $option_array[0]; ?>" id="<?php echo $args['key'] . '_' . $option_array[0]; ?>"<?php echo $mod_price; ?><?php if($option_array[0]==htmlspecialchars($this->get_post_val($args['key']))) echo ' selected="selected"'; ?>><?php echo $option_array[1]; ?></option>
<?php

      }

?>
                </select>
<?php

      if($args['required']==true) {

?>
                <span class="required-input-field"></span>
<?php

      }

?>
                <span role="alert" class="form-not-valid-tip"<?php echo ($this->has_error($args['key']) ? '' : ' style="display: none"'); ?>><? if($this->has_error($args['key'])) echo $this->get_error($args['key']); ?></span>
              </span>
            </label>
          </p>
<?php

      $this->add_required_to_session($args['key'],$args['required']);
    } else {
      $this->set_error($args['key'], 'No options available. Please contact the admin.');

?>
          <p>
            <span class="input-wrap">
              <span role="alert" class="form-not-valid-tip<?php echo ($this->has_error($args['key']) ? '' : ' hidden'); ?>"><? if($this->has_error($args['key'])) echo $this->get_error($args['key']); ?></span>
            </span>
          </p>
<?php

    }
  }


/**
 * Create checkbox or radio element(s) in HTML, based on an array of options.
 * Usage:
 * - key: Used for 'name' and 'id' attribute of the input element. 
 *        Also used for the 'for' attribute in the label element.
 *        This is a required input. (string)
 * - options: An array of the values, used for the options
 *            The values of the meta field are in the form of 'name|description|price'.
 *            The input values for 'name' and 'description' are mandatory and the value for 'cost' is optional.
 *            Either this or 'meta_field_name' is a required input. (array)
 * - meta_field_name: The name of the WordPress page meta field that holds the values, used for the options.
 *                    The values of the meta field are in the form of 'name|description|price'.
 *                    The input values for 'name' and 'description' are mandatory and the value for 'cost' is optional.
 *                    These input values can be created in the WP page backend by adding a meta field to the page that holds the form template.
 *                    Either this or 'options' is a required input. (string)
 * - check_or_radio: Indicates if this should be a checkbox or radio element. Types available:
 *                   - 'checkbox'
 *                   - 'radio'
 *                   Defaults to ['checkbox']. (string)
 * - label: Human readable description of the input, in normal (500) font-weight.
 *          Defaults to [false]. (bool)(string)
 * - label_extension: A bit of extra information that is added to the label as a new block of text,
 *                    positioned under the main label description in light (300) font-weight.
 *                    Defaults to [false]. (bool)(string)
 * - mod: Indicates if this element opens another element when a checkbox or radio is checked. The id attribute for the opened element is
 *        automatically designated as '[key]_contents' where [key] represents the 'key' attribute in the arguments object.
 *        Defaults to false. (bool)
 * - required: Indicates if this element should be a required input.
 *             Defaults to [false]. (boolean)
 */

  function makeCheckElement($args) {
    $this->set_default_attribute_values($args);
    $this->set_name_type($args['key'], 'checkradio');
    $this->set_is_required($args['key'],$args['required']);
    $modified_elem = (! $args['mod'] ? '' : ' data-mod-display="' .$args['key']. '_contents"');
    if(array_key_exists('meta_field_name', $args)) {
      $checkradios = $this->get_meta_from_page(get_the_ID(), $args['meta_field_name']);
    } else {
      $checkradios = $args['options'];
    }
    $label_extension_array = false;
    $label_extension = false;
    if(is_array($args['label_extension'])) {
      if(count($checkradios) > 1) {
        if(array_key_exists('main_label', $args['label_extension'])) {
          $label_extension = $args['label_extension']['main_label'];
          unset($args['label_extension']['main_label']);
          $label_extension_array = $args['label_extension'];
        }
      } else {
        if(count($args['label_extension']) == 2) {
          $label_extension = $args['label_extension']['main_label'];
        }
      }
    } elseif($args['label_extension'] !== false) {
      $label_extension = $args['label_extension'];
    }
    if(!empty($checkradios)) {

?>
          <p<?php if($args['required']) echo ' class="required"'; ?>>
            <span class="input-wrap checkradio">
              <span class="fieldset<?php if(count($checkradios)<2) echo ' no-fieldset-border'; ?>"<?php if($args['required']) echo ' aria-required="true" aria-invalid="'.($this->has_error($args['key']) ? 'true' : 'false').'"'; ?>>
<?php

      if($args['label']) {

?>
                <span class="checkradio-group-title">
                  <?php echo $args['label'] . ($label_extension ? '<span class="label_extension">' . $label_extension . '</span>' : ''); ?>
                </span>
<?php

      }
      foreach($checkradios as $checkradio) {
        $checkradio_array = explode('|',$checkradio);
        $mod_price = count($checkradio_array) > 2 ? ' data-mod-price="' .$checkradio_array[2]. '"' : '';
        $checked = $this->is_checkbox_checked($args['key'],$checkradio_array[0]);

?>
                <label for="<?php echo $args['key'].'_'.$checkradio_array[0]; ?>"<?php echo $label_extension_array ? ' class="strong"' : ''; ?>>
                  <input type="<?php echo $args['check_or_radio']; ?>" name="<?php echo $args['key'] . ($args['check_or_radio']=='checkbox' && count($checkradios)>1?'[]':''); ?>" id="<?php echo $args['key'].'_'.$checkradio_array[0]; ?>"<?php echo $modified_elem; ?> value="<?php echo htmlspecialchars($checkradio_array[0]); ?>" <?php if($checked) echo "checked=\"checked\" "; if($args['required']) echo ' required="required"'; echo $mod_price; ?>/><?php echo $checkradio_array[1] . ($label_extension_array ? '<span class="label_extension">' . $label_extension_array[$checkradio_array[0]] . '</span>' : ''); ?>
                </label>
<?php

      }

?>
              </span>
<?php

      if($args['required']==true) {

?>
              <span class="required-input-field"></span>
<?php

      }

?>
              <span role="alert" class="form-not-valid-tip"<?php echo ($this->has_error($args['key']) ? '' : ' style="display: none"'); ?>><? if($this->has_error($args['key'])) echo $this->get_error($args['key']); ?></span>
            </span>
          </p>
<?php

      $this->add_required_to_session($args['key'],$args['required']);
    } else {
      $this->set_error($args['key'], 'No checkbox or radio set. Please contact the admin.');

?>
          <p>
            <span class="input-wrap">
              <span role="alert" class="form-not-valid-tip<?php echo ($this->has_error($args['key']) ? '' : ' hidden'); ?>"><? if($this->has_error($args['key'])) echo $this->get_error($args['key']); ?></span>
            </span>
          </p>
<?php

    }
  }


/**
 * Create mathcaptcha
 * Usage:
 * - label: Human readable description of the input, in normal (500) font-weight.
 *          Defaults to [false]. (bool)(string)
 * - label_extension: A bit of extra information that is added to the label as a new block of text,
 *                    positioned under the main label description in light (300) font-weight.
 *                    Defaults to [false]. (bool)(string)
 * - $error_response_type: 'use_label_possessive' - Use the name of the label in the error response, with possessive pronoun (as in 'your' name)
 *                         'use_label_undefined' - The same but with undefined article (as in 'a' comment)
 *                         'use_label_defined_1' - The same but with defined article (as in 'the' control input)
 *                         'use_label_defined_2' - The same but with defined article (used in other languages)
 *                         'plain' - Use the standard error response (default)
 */

  function makeMathCaptcha($args) {
    $args['key'] = "mathcaptcha";
    $this->set_default_attribute_values($args);
    $this->set_name_type('mathcaptcha', 'mathcaptcha');
    $this->set_is_required('mathcaptcha', true);

?>
         <p class="mathcaptcha-box required">
            <label for="mathcaptcha">
              <?php echo $args['label']; ?>
              <span class="input-wrap">
                <span class="mathcaptcha">
<?php 

    $this->mathCaptcha();
    echo $_SESSION[$this->site().'mathCaptcha-digit-x'] . " + " . $_SESSION[$this->site().'mathCaptcha-digit-y'] . " = ";

?>
                </span>
                <input type="text" name="mathcaptcha" id="mathcaptcha" value="<?php echo $this->clean_input('mathcaptcha','mathcaptcha',true); ?>" required="required" aria-required="true" aria-invalid="<?php echo ($this->has_error('mathcaptcha') ? 'true' : 'false'); ?>" data-error-response-type="<?php echo $args['error_response_type']; ?>" />
                <span class="required-input-field"></span>
                <span role="alert" class="form-not-valid-tip"<?php echo ($this->has_error("mathcaptcha") ? '' : ' style="display: none"'); ?>><? if($this->has_error("mathcaptcha")) echo $this->get_error("mathcaptcha"); ?></span>
              </span>
            </label>
          </p>
<?php

  }

  function makeHoneyPot() {
    $args['key'] = "checking";
    $this->set_name_type('checking', 'honeypot');
    $this->set_is_required('checking',false);

?>
          <p class="attend">
            <label for="checking" class="attend">
              <input type="text" name="checking" id="checking" placeholder="Dit veld leeg laten" class="attend" value="<?php echo $this->clean_input('checking','honeypot',false); ?>" />
            </label>
          </p>
<?php

  }

  function cs_helper_inputs() {
    $this->set_name_type('required_inputs', 'text');
    $this->set_is_required('required_inputs',false);
    $this->set_name_type('hidden_required_inputs', 'text');
    $this->set_is_required('hidden_required_inputs',false);

?>

              <input type="hidden" id="required_inputs" name="required_inputs" value="" />
              <input type="hidden" id="hidden_required_inputs" name="hidden_required_inputs" value="" />

<?php

  }

  function makeNameType() {

?>
              <input type="hidden" name="name_type" id="name_type" value="<?php echo htmlspecialchars($this->get_name_type()); ?>" />
<?php

  }

  function makeIsRequired() {

?>
              <input type="hidden" name="is_required" id="is_required" value="<?php echo htmlspecialchars($this->get_is_required()); ?>" />
<?php

  }

  function set_helper_inputs() {
    $this->set_name_type('is_required', 'text');
    $this->set_is_required('is_required', false);
    $this->set_name_type('name_type', 'text');
    $this->set_is_required('name_type', false);

    $this->set_name_type('name_type', 'text');
    $this->set_is_required('name_type', false);
  }

  function globalError() {

?>
        <div role="alert" class="form-response-output form-validation-errors"<?php if(!$this->is_submitted() && !$this->has_errors()) echo ' style="display: none"'; ?>>
          <p>
<?php

    echo $this->error_contents['global_error_msg'];

?>    
          </p>
        </div>
        <div role="alert" class="form-response-output form-validation-ok" style="display: none">
          <p>
<?php

    echo $this->error_contents['global_ok_msg'];

?>    
          </p>
        </div>
<?php 

  }

  function makeSubmitButton($value) {
    $this->set_name_type($this->get_form_key(), 'submit');
    $this->set_is_required($this->get_form_key(), false);

?>
          <p>
            <input type="submit" name="<?php echo $this->get_form_key(); ?>" value="<?php echo htmlspecialchars($value); ?>" />
          </p>
<?php

  }

  function get_quote_line_data() {
    $arr = array_filter($_POST, function($key) {return strpos($key, 'input_ql_') === 0;}, ARRAY_FILTER_USE_KEY);
    if(!empty($arr)) {
      return $this->sanitize_post_val_array($arr);
    } else {
      return false;
    }
  }

  function add_thousand_separator($number, $decimals=2) {
    $number = strval(number_format($number, $decimals, ',', '.'));
    return preg_replace('(\d)', '<span>$0</span>', $number);
  }

  function make_quote_lines() {
    /**
     * Make array from quote line data.
     * array([name], [price], [user_input], [price_per], [price_type])
     */
    $quote_line_data_array = $this->get_quote_line_data();
    if($quote_line_data_array) {
      foreach($quote_line_data_array as $key => $quote_line_data) {
        $ql_array = explode("|",$quote_line_data);
        $added = $ql_array[1] > 0 ? "<br /><span class=\"quoteline_price_buildup\">&#8364; " . $this->add_thousand_separator($ql_array[2]) . ($ql_array[4] != "" ? " x " : "") . ($ql_array[4] === "volume" ? $this->add_thousand_separator($ql_array[1], 3) : ($ql_array[4] === "unit" ? $ql_array[1] : "")) . ($ql_array[4] != "" ? " " : "") . $ql_array[3] . "</span>" : "";
?>
    <div class="quote-line" id="<?php echo str_replace('input_','',$key); ?>" style="opacity: 1;">
      <span class="description"><?php echo $ql_array[0] . $added; ?></span>
      <span class="price"><span><?php echo $this->add_thousand_separator($ql_array[1] * $ql_array[2]); ?></span></span>
    </div>
<?php
    
      }
    }
  }

  function quote_subtotal() {
    $quote_line_data_array = $this->get_quote_line_data();
    $subtotal = 0;
    if($quote_line_data_array!==false) {
      foreach($quote_line_data_array as $key => $quote_line_data) {
        $ql_array = explode("|",$quote_line_data);
        $subtotal = floatval($ql_array[2] * $ql_array[1]) + $subtotal;
      }
    }
    return $subtotal;
  }

  /**
   * To prevent sending the form twice after refreshing the page
   */
  function already_submitted_without_errors() {
    return filter_var($this->get_session_val($this->get_form_key()), FILTER_VALIDATE_BOOLEAN);
  }

  function form_sent_ok() {
    return ($this->is_submitted() && (! $this->has_errors() || $this->already_submitted_without_errors()));
  }
}
