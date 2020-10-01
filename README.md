# FormMaker
Creating beautiful, active forms in WordPress made easy. This form includes on-the-fly price calculation.

## How to
This package is quite easy to use if you know only a little bit of PHP, HTML and CSS. 
All good and well but how do I go about it then? Let me guide you.

* Create a directory called `'FormMaker'` in the root directory of the theme of your WordPress installation. The name of the directory can be anything you like but for the sake of this How-to I will use this specific name.
* Copy all contents of FormMaker to this directory.
* Create your form in `FormMaker/inc/the-form.php`.
* Create the thank you page in `FormMaker/inc/thank-you.php`.
* Create the epilogue page in `FormMaker/inc/epilogue.php`.
* Select this template in the WordPress page you would like to see this form on. You can do this at: `page settings -> page attributes -> select template`.

## Create formMaker form inputs
Form inputs are made based on the information that is given to the create_form_input object.
```php
class form_maker
  -> create_form_input([input element](string), [input contents](array))
```
### Input element (string)
The element that is used for the user input. This can be any of the predefined HTML element names, which are:
* input
* textarea
* select
* mathcaptcha

### Input contents (array)
An array of key->value pairs which all information about this user input element. The value is always written in lower case.
Possible keys are:
```
- key: Used for 'name' and 'id' attribute of the <INPUT> element. Also used for the 'for' attribute in the <LABEL> element.
       This is a required input. (string)
- type: Used for the input 'type' attribute. This key->value pair is only mandatory for use with <INPUT> elements.
        Possible values are (alphabetically ordered): color, email, hidden, number, password, radio, range, tel, text, url.
        Defaults to ['text']. (string)
- number_decimals: Indicates how many decimals this input can receive.
                   Defaults to [0]. (int)
- number_decimal_steps: Indicates the size of the incremental steps that is used by the browser number input interface, the spinner.
                        Defaults to [0.5]. (float)
- options: An array of the values, used for the options
           The values in this array can hold 3 types of information (name, description and price), each separated by a pipe (|) symbol. The notation is as follows: 'name|description(|price)'.
           The input values for 'name' and 'description' are mandatory and the value for 'price' is optional.
           Either this or 'meta_field_name' is a required input. (array)
- meta_field_name: The name of the WordPress page meta field that holds the values, used for the options.
                   As in [options], the values of the meta field are noted as 'name|description|price'. The input values for 'name' and 'description' are mandatory and the input value for 'price' is optional.
                   If [options] is not used, this is a required input which is done in the WP page backend by adding a meta field.
- label: Human readable description of the input.
         Defaults to [false]. (bool)(string)
- label_extension: A bit of extra information that is added to the label as a new block of text, positioned under the main label description in normal font-weight.
                   Defaults to [false]. (bool)(string)
- thumb: Thumbnail of product sold. Only a full url is an accepted value here. If a thumbnail is used by passing
         a valid url, the layout for the form changes to the wide screen column style layout.
         Defaults to [false]. (bool)(string)
- placeholder: Hint for input, shown in the input in light type.
               Defaults to [false]. (bool)(string)
- rows: The number of rows that sets the height of the textarea. This key->value pair can only be used for the <TEXTAREA> element.
        Defaults to [4]. (int)
- required: Indicates if this element should be a required input.
            Defaults to [false]. (boolean)
- multiplier: Indicates if this input should function as a multiplier for the price.
              This can only be used for inputs of the 'number' type, in which the user can only input an int.
              The price refers to the 'data-mod-price' attribute from this input or it can refer to the
              'data-mod-price' attribute from the input of the opener.
              Defaults to [false]. (boolean)
- price: The price that belongs to this input, noted as a number with a decimal point (if neccesary) and
         without thousand separator, ie. 1450.50.
         Defaults to [false]. (bool)(float)
- price_per: The unit description of how the product is sold (lb, oz, kg, gr, pc, etc)
                Defaults to [''].
- price_type: Defines how this product is sold. Products that are sold by weight are volume products, products sold per piece are unit products. Types available: volume, unit.
              Defaults to ['unit']. 
- range: The number range that is used for the 'range' type input., noted as '0-10'. If this input is not or incorrectly given, the HTML standard of 0-100 will be used.
         Defaults to [false]. (bool)(string)
- range_default_value: The value that is set as default.
                       Defaults to [0]. (int)
- color_default_value: The value that is set for the default color, defined as a 7-character string specifying an RGB color in hexadecimal format. Example: '#cc3399'.
                       Defaults to ['#cc3399']. (string)
- use_opener: The types of information that need to be retrieved from opener by JavaScript. Multiple types are separated by '|'. Types available: info, price.
              Defaults to [false]. (bool)(string)
- mod: Indicates if this element opens (toggles) another element when an option is selected. This key->value pair can only be used for <SELECT> elements, checkboxes and radio buttons.
       Defaults to false. (bool)
- error_response_type: Indicates how the error response is displayed on screen. Types available:
                       - 'use_label_possessive': Use the name of the label in the error response, with possessive pronoun (as in 'your' name).
                       - 'use_label_undefined': The same but with undefined article (as in 'a' flower).
                       - 'use_label_defined_1': The same but with defined article (as in 'the' bus).
                       - 'use_label_defined_2': The same but with another variation of a defined article (used in other languages).
                       - 'plain': Use the standard error response.
                       Defaults to ['plain']. (string)
```

### Added functionality: Toggling elements

It is possible to create a more streamlined form by hiding input elements until they become relevant to the user. Use the `[mod]` key->value pair to define the element that needs to be toggled.
It is also possible to use this toggling functionality manually by using the 'data-toggle' HTML attribute and give it the value of the element ID that you would like to see toggled. In turn, the element
that is toggled needs to be given the CSS-class `'togglee'`. This makes sure the default CSS display state of the toggled element is `'none'`, which ensures it's not visible and does not take up any space in the HTML document structure.
Example:
```html
<span class="btn btn-default" data-toggle="a_form_section">Click to open the form section</span>
<div id="a_form_section" class="togglee">
    This is the form section that is hidden by default and is opened by clicking on the link above.
</div>
```

### The mathcaptcha
A mathcaptcha input can be easily added, an example:
```php
$form->create_form_input("mathcaptcha", array(
  'label' => 'Control input',
  'label_extension' => 'Confirm that you are a human by solving this simple calculation',
  'error_response_type' => 'use_label_defined_1'
));
```

## Finito
Voila, you now have a dynamic form with on-the-fly pricing and all bells and whistles on it.

## Contributing
If you're a developer, pull requests, issues, and any feedback are all more than welcome.

## Changelog
1.0 Initial commit.
