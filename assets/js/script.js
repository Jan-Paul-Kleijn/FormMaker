(function($){
  "use strict";
  $(document).on("ready", function() {  
    $("form").on("submit", function(e) {
      $("[data-mod-display]", "form").each(function() {
        show_section($(this),e);
      });
      $("[required]", "form").each(function() {
        cs_validation($(this),false,e);
      });
      if(has_errors()) {
        e.preventDefault();
        $("body").data( "errors", 1 );
        var first_wrong_form_input = has_errors().closest("label");
        if(has_errors().prop("type") == "checkbox" || has_errors().prop("type") == "radio") {
          first_wrong_form_input = has_errors().closest(".fieldset");
        }
        $('html, body').animate({
          scrollTop: (first_wrong_form_input.offset().top)
        },500);
      }
    });
    $("input[type=text][required],input[type=email][required],input[type=date][required],textarea[required]", "form").on("keyup focusout input", function(e) {
      if($(this).attr("id") != "mathcaptcha") {
        cs_validation($(this),false,e);
      }
    });
    $("input[type='number'],input[type=range]").on("keydown keyup keypress paste input focusout", function(e) {
      var comma = ['af','ar','az','be','bg','bs','ca','cs','da','de','el','eo','es','et','eu','fa','fi','fr','fur','gl','haz','hr','hu','hy','id','is','it','jv','ka','kab','kk','km','ku','lo','lt','lv','mk','nb','nl','nn','oc','pl','ps','pt','ro','ru','sah','sk','sl','sq','sr','sv','szl','tr','tt','ty','uk','uz','vi'],
          dot = ['as','bn','bo','ceb','cy','dz','en','gd','gu','he','hi','ja','kn','ko','ml','mn','mr','ms','my','ne','pa','rhg','si','skr','ta','te','th','tl','ug','ur','zh'];
      if(e.type=="keydown") {
        if(e.key == '.' || e.key == ',') {
          if(in_array(comma, $("html").attr("lang")) && e.key == '.') e.preventDefault();
          if(in_array(dot, $("html").attr("lang")) && e.key == ',') e.preventDefault();
        }
      }
      if(e.type=="keypress") {
        if(in_array(comma, $("html").attr("lang")) && e.key.match(/[^\d,]/)) e.preventDefault();
        if(in_array(dot, $("html").attr("lang")) && e.key.match(/[^\d.]/)) e.preventDefault();
      }
      if(e.type=="paste") {
        var clipboard = e.clipboardData || window.clipboardData || e.originalEvent.clipboardData;
        var pastedData = clipboard.getData('text');
        if(pastedData.indexOf(".") > -1 || pastedData.indexOf(",") > -1) {
          if(in_array(comma, $("html").attr("lang")) && pastedData.match(/[^\d,]/)) e.preventDefault();
          if(in_array(dot, $("html").attr("lang")) && pastedData.match(/[^\d.]/)) e.preventDefault();
        }
      }
      if(e.type == "keyup") {
        if((in_array(comma, $("html").attr("lang")) && e.key.match(/^(\d|,|arrowup|arrowdown|delete|backspace|shift)/i)) || (in_array(dot, $("html").attr("lang")) && e.key.match(/^(\d|.|arrowup|arrowdown|delete|backspace|shift)/i))) {
          cs_validation($(this),false,e);
          do_price_line($(this));
        }
      } else if(e.type == "input") {
        if($(this).attr("type") == "range") {
          cs_validation($(this),true,e);
        } else {
          cs_validation($(this),false,e);
        }
        do_price_line($(this));
      } else if(e.type == "change") {
        if($(this).attr("type") == "range") {
          cs_validation($(this),false,e);
        } else {
          cs_validation($(this),false,e);
        }
        do_price_line($(this));
      } else if(e.type == "focusout") {
        cs_validation($(this),true,e);
      }      
      if($(this).val() == '' && !$(this).prop("required")) {
        $(this).val('');
        set_default($(this),false);
      }
    });
    $("#mathcaptcha", "form").on("keyup focusout", function(e) {
      cs_validation($(this),false,e);
    });
    $("select[required]", "form").on("focusout change", function(e) {
      cs_validation($(this),false,e);
    });
    $("select[data-mod-display]", "form").on("change", function(e) {
      show_section($(this),e);
    });
    $("input[type=checkbox][data-mod-display],input[type=radio][data-mod-display]", "form").on("change", function(e) {
      show_section($(this),e);
    });
    $("select", "form").on("change", function() {
      do_price_line($(this));
    });
    $("input[type=checkbox][required],input[type=radio][required]", "form").on("change", function(e) {
      cs_validation($(this),false,e);
    });
//    $("input[type=checkbox][data-mod-price],input[type=radio][data-mod-price]", "form").on("change", function() {
    $("input[type=checkbox],input[type=radio]", "form").on("change", function() {
      do_price_line($(this));
    });
    $(".quote-price").on("click", function() {
      show_price_details($(this));
    });
    $("input[type='range']").on("focusout", function() {
      $(this).css({"outline" : "none"});
    });
    $("[data-toggle]").on("click", function() {
      var togglee = $("#"+$(this).data("toggle"));
      if(togglee.length) {
        if(!togglee.is(":visible")) {
          togglee.slideDown({
            duration : "500",
            easing : "linear",
            start: function() {
  //            elem.children("h2").find(".price").hide();
            }
          });
        } else {
           togglee.slideUp({
            duration : "500",
            easing : "linear",
            complete: function() {
  //            elem.children("h2").find(".price").fadeIn(300);
            }
          });
        }
      }
    });
  });

  $(window).on("load", function(e) {
    if($("#mathcaptcha").val() != '') {
      do_mathcaptcha($("#mathcaptcha"),e);
    }
    $("[data-mod-display]", "form").each(function() {
      if($("option:selected",$(this)).length) {
        show_section($(this),e);
      } else if($(this).is(":checked")) {
        show_section($(this),e);
      }
      var mod = $(this).data("mod-display").replace("_contents",""),
          section_id = mod + "_section_" + $(this).val();
      $("[id^='" + mod + "_section_']").each(function() {
        var section = $(this);
        $(this).find(":input").each(function() {
          if(($(this).attr("type") == "checkbox" || $(this).attr("type") == "radio") && $(this).prop("checked") && $(this).data("mod-display")) {
            section = $("#" + $(this).data("mod-display").replace("_contents","") + "_section_" + $(this).val());
            move_section_to_focus(section);
            show_section($(this),e);
            section.find(":input").each(function() {
              cs_validation($(this),false,e);
            });
          }
        });
      });
    });
    set_form_display_type();
  });

  function do_price_line(elem) {
    var item_id = elem.prop("type") == "radio" ? "ql_" + elem.attr("id") : "ql_" + elem.attr("id"),
        item_price,
        item_info,
        indx = $("#" + item_id).index();
    if(is_checkradio_input(elem)) { // A checkbox item
//    if(elem.prop("type") == "checkbox" && elem.data("mod-price")) { // A checkbox item, designated for quote price
      if(!elem.data("mod-price")) {

        // remove all pricelines that belong to the other radios.
        $("[name='"+elem.prop("name")+"']").not(":checked").each(function() {
          if($("#ql_" + $(this).attr("id")).length) {
            remove_price_line("ql_" + $(this).attr("id"));
          }
        });

  // ---

      } else { // A checkbox item, designated for quote price
        if(elem.prop("checked")) {

          item_info = $.trim(get_text_from_elem(elem.parent()));

          item_price = elem.data("mod-price");
          if(elem.prop("type") == "radio") {
  
            // remove all pricelines that belong to the other radios.
            $("[name='"+elem.prop("name")+"']").not(":checked").each(function() {
              if($("#ql_" + $(this).attr("id")).length) {
                remove_price_line("ql_" + $(this).attr("id"));
              }
            });
            // ---

            add_price_line(item_info,item_price,1,item_id,indx);
          } else {
            add_price_line(item_info,item_price,1,item_id);
          }
  
//        add_price_line(item_info,item_price,1,item_id);
        } else {
          remove_price_line(item_id);
        }
      }
    } else {
      if(elem.prop("tagName").toLowerCase() == "select") {
//        var selected_option = elem.prop("type") == "radio" ? elem : $(":selected",elem);
        var selected_option = $(":selected",elem);
        if(selected_option.data("mod-price")) { // An option, designated for quote price
          item_info = elem.prop("type") == "radio" ? $.trim(get_text_from_elem(elem.parent())) : $.trim(get_text_from_elem(selected_option));
          item_price = selected_option.data("mod-price");
          if(indx != -1) {
            add_price_line(item_info,item_price,1,item_id,indx);
          } else {
            add_price_line(item_info,item_price,1,item_id);
          }
        } else {
          remove_price_line("ql_" + elem.prop("name"));
/*
          elem.find("option").not(":selected,:disabled").each(function() {
            // remove all pricelines that belong to the other radios.
            // ---
          });
*/
        }
      } else if((elem.attr("type") == "number" || elem.attr("type") == "range") && (elem.data("mod-price") || elem.data("mod-use-opener"))) { // A number input, designated for quote price
        if(elem.data("mod-use-opener")) { // If this attribute exists, get info on what to receive from opener (price, info)
          var use_opener_for = elem.data("mod-use-opener").split("|"),
              opener_info = get_opener_info(elem);
          if($.inArray("info", use_opener_for) != -1) { // Get item_info from opener
            var opener = $("#" + opener_info['id']),
                item_info_elem;
            if(opener.prop("tagName").toLowerCase() == "option") {
              item_info_elem = opener;
            } else {
              item_info_elem = opener.parent();
            }
            item_info = $.trim(get_text_from_elem(item_info_elem));
          } else if($.inArray("price",use_opener_for) != -1) { // Get price from opener
            if($("#" + opener_info['id']).data("mod-price")) {
              item_price = $("#" + opener_info['id']).data("mod-price");
            } else { // Opener has no price set (properly)
              return;
            }
          }
        }
        if(typeof item_info == 'undefined') { // Info is not set by opener
          item_info = $.trim(get_text_from_elem(elem.closest("label")));
        }
        if(typeof item_price == 'undefined') { // Price is not set by opener
          item_price = elem.data("mod-price");
        }
        if($("#" + item_id).length) {
          if(elem.val() == '' || elem.val() == 0 || !contains_proper_number(elem)) {
//          if(elem.val() == '' || elem.val() == 0 || !elem.is(":checked") || !contains_proper_number(elem)) {
            remove_price_line(item_id,true);
          }
        }
        if(elem.val() != '' && elem.val() != 0 && contains_proper_number(elem)) {
          if(elem.data("mod-multiplier")) { // Multiplier is active
            add_price_line(item_info,item_price,elem.val(),item_id,indx);
          } else {
            add_price_line(item_info,item_price,elem.val(),item_id,indx);
          }
        }
      }
    }
  }
  
  function get_opener_info(input_elem) {
    if(input_elem.closest(".bq-extended").length) {
      var opener_info = {},
          section_id = input_elem.closest(".bq-extended").attr("id");
      opener_info['section_identifier'] = "_section_";
      opener_info['current_section_id'] = input_elem.closest(".bq-extended").attr("id");
      opener_info['name'] = section_id.substring(0, section_id.indexOf(opener_info['section_identifier']));
      opener_info['value'] = section_id.replace(opener_info['name'] + opener_info['section_identifier'], "");
      opener_info['id'] = opener_info['name'] + "_" + opener_info['value'];
      return opener_info;
    }
    return false;
  }

  function get_all_openers(input_elem) {
    var all_openers = input_elem.parents("[id*='_section_']");
    if(all_openers.length) {
      return all_openers;
    }
    return false;
  }

  function calculate_totals() {
    var totals = {};
    totals["subtotal"] = 0;
    $(".price > span", "#quote_lines").each(function() {
      totals["subtotal"] = (parseFloat($(this).text().replace('.','').replace(/,([^,]*)$/,'.$1')) + totals["subtotal"]);
    });
    totals["tax"] = (totals["subtotal"] * .21);
    totals["endtotal"] = (totals["subtotal"] + totals["tax"]);
    if(totals["subtotal"] > 0) {
      $(".price > span", ".quote-subtotal, .quote-tax, .quote-total, .quote-price > h2").stop(true,true).css({"opacity" : "0"});
      $(".price > span", ".quote-subtotal").html(add_thousand_separator(totals["subtotal"]));
      $(".price > span", ".quote-tax").html(add_thousand_separator(totals["tax"]));
      $(".price > span", ".quote-total").html(add_thousand_separator(totals["endtotal"]));
      if($(".price > span", ".quote-total").is(":hidden")) {
        $(".price > span", ".quote-price > h2").html(add_thousand_separator(totals["subtotal"]));
      } else {
        $(".price > span", ".quote-price > h2").html(add_thousand_separator(totals["endtotal"]));
      }
      $(".price > span", ".quote-subtotal, .quote-tax, .quote-total, .quote-price > h2").delay(500).animate({"opacity" : "1"},400);
    } else {
      $(".price > span", ".quote-subtotal").html(add_thousand_separator(0));
      $(".price > span", ".quote-tax").html(add_thousand_separator(0));
      $(".price > span", ".quote-total").html(add_thousand_separator(0));
      $(".price > span", ".quote-price > h2").html(add_thousand_separator(0));
    }
  }
  
  function add_thousand_separator(number,decimals=2) {
    var x,
        dec;
    number = parseFloat(number).toFixed(decimals);
    number += '';
    x = number.split('.');
    dec = x.length > 1 ? ',' + x[1] : ',00';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x[0])) {
      x[0] = x[0].replace(rgx, '$1' + '.' + '$2');
    }
    return (x[0] + dec).replace(/\d/g, '<span>$&</span>');
  }

  function set_totals_invisible() {
    $(".price > span", ".quote-subtotal, .quote-tax, .quote-total, .quote-price > h2").stop(true,true).css({"opacity" : 0});
  }

  function add_price_line(item_info,item_price,multiplier,item_id,indx) {
    set_totals_invisible();
    var item_info = item_info.replace(/ *\([^)]*\) */g, ""),
        item_price = parseFloat(item_price),
        multiplier = typeof multiplier == "undefined" ? 1 : parseFloat(multiplier),
        indx = typeof indx == "undefined" ? -1 : parseInt(indx),
        price_type = (typeof $("#" + item_id.replace("ql_", "")).data("priceType") !== 'undefined' ? $("#" + item_id.replace("ql_", "")).data("priceType") : ''),
        price_per = (typeof $("#" + item_id.replace("ql_", "")).data("pricePer") !== 'undefined' ? $("#" + item_id.replace("ql_", "")).data("pricePer") : ''),
        line_total_price = (multiplier * item_price),
        quote_line_info = $("<span>", {class: "description"}).html(item_info + "<br /><span class=\"quoteline_price_buildup\">\u20AC " + add_thousand_separator(item_price.toFixed(2)) + (price_type != "" ? " x " : "") + (price_type === "volume" ? add_thousand_separator(multiplier.toFixed(2),3) : (price_type === "unit" ? multiplier : "")) + (price_type != "" ? " " : "") + price_per + "</span>"),
        quote_line_price = $("<span>", {class: "price"}),
        quote_line_price_contents = $("<span>").html(add_thousand_separator(line_total_price)),
        slide = (indx == -1 ? true : false),
        quote_line = $("<div>", {class: "quote-line", id: item_id, css: {"display" : "none"}}),
        form = $("#" + item_id.replace("ql_","")).parents("form");
    quote_line_price.append(quote_line_price_contents);
    quote_line.append(quote_line_info, quote_line_price);
    var quote_line_input = $("<input>").attr({"type" : "hidden", "id" : "input_"+item_id, "name" : "input_"+item_id, "value" : item_info+"|"+multiplier+"|"+item_price+"|"+price_per+"|"+price_type});
    if($("#input_"+item_id).length) {
      if($("#input_"+item_id).val() != item_info+"|"+multiplier+"|"+item_price+"|"+price_per+"|"+price_type) {// een vervanging
        $("#input_"+item_id).remove();
        form.append(quote_line_input);
      }
    } else {
      form.append(quote_line_input);      
    }    
    if(indx!=-1) { // Replace all lines and inputs with the new info
      var input_elem = $("#" + item_id.replace("ql_","")),
          section,
          not_selected = {};
      if(input_elem.prop("tagName").toLowerCase() == "select") {
        // Sibling <option> elements that can have currently active sections
        not_selected = input_elem.find("option").not(":selected,:disabled");
      } else if(input_elem.is(":radio")) {
        // Sibling <input type="radio"> elements that can have currently active sections
        not_selected = $("[name='"+input_elem.attr('name')+"']").not(":checked");
      }
      // remove all added prices that belong to inputs from the 'not_selected' variable.
      if(not_selected.length) {
        not_selected.each(function() {
          section = $("#" + input_elem.attr("name") + "_section_" + $(this).val());
          section.find(":input").each(function() {
            var item_id_sub = "ql_" + $(this).attr("id");
            if($("#"+item_id_sub).length) {
              remove_price_line(item_id_sub,true);
            }
          });
        });
      }

      // remove_price_line(item_id,slide);
      $("#" + item_id).remove();

      if(indx === 0) {
        quote_line.prependTo($("#quote_lines")).css({"display" : "block"}).animate({opacity: "1"},500);
      } else {
        quote_line.insertAfter($("#quote_lines > .quote-line").eq(indx-1)).css({"display" : "block"}).animate({opacity: "1"},{
          "start" : function() {
            $(".price > span", quote_line).stop(true,true).css({"opacity" : 0}).html(add_thousand_separator(line_total_price)).animate({opacity: "1"},500);
          },
          "duration" : 500
        });
      }

      // readd all prices that belong to inputs from the currently chosen section
      section = $("#" + input_elem.attr("name") + "_section_" + input_elem.val());
      section.find(":selected").filter(":visible").each(function() {
        do_price_line($(this));
      });
      calculate_totals();
    } else { // een nieuwe regel
      if($(".quote-price").is(":hidden")) {
        $(".quote-price").css({"display" : "block", "opacity" : 0}).animate({opacity: "1"},500);
      }
      if(!$("#"+item_id).length) {
        quote_line.appendTo($("#quote_lines")).show({
          "duration" : 500,
          "complete" : function () {
            calculate_totals();
          }
        });
      }
    }
  }
  
  function remove_price_line(item_id,slide) {
    var quote_line = $("#" + item_id),
        quote_line_input = ($("#input_"+item_id).length ? $("#input_"+item_id) : false),
        animate = typeof slide == "undefined" ? true : slide;
    if(quote_line_input) {
      quote_line_input.remove();
    }
    if(animate) {
      $("#" + item_id).slideUp({
        "duration" : 500,
        "complete" : function() { return remove_and_recalculate(quote_line) }
      });
    } else {
      quote_line.remove();
      calculate_totals();
    }
  }

  function remove_and_recalculate(quote_line) {
    quote_line.remove();
    return calculate_totals();
  }

  function insertAtIndex(child,indx,parent) {
    if(indx === 0) {
      parent.prepend(child);        
      return;
    }
    $("#" + parent.attr("id") + " > div:nth-child(" + (indx) + ")").after(child);
  }

  function get_text_from_elem(elem) {
    if(elem.find(".form-item-name").length) {
      elem = elem.find(".form-item-name");
    }
    return elem.contents().filter(function() {
      return this.nodeType === 3;
    }).text();
  }

  function show_price_details(elem) {
//console.log(elem.parent().children("form").find("input[type='submit']").toggleClass('submit_relocated'));
    if(elem.outerWidth() == $("html").outerWidth()) {
      var quote_details_elem = $(".quote-details", elem);
      var visible = quote_details_elem.is(":visible");
      if(!visible) {
        quote_details_elem.slideDown({
          duration : "500",
          easing : "swing",
          start: function() {
            elem.children("h2").find(".price").hide();
//            elem.parent().children("form").find("input[type='submit']").animate({ height : '0', paddingTop : '0', paddingBottom : '0', lineHeight : '0'});
            elem.parent().children("form").find("input[type='submit']").hide().toggleClass('submit_relocated');
          },
          complete: function() {
            $(".quote-price-control").toggleClass('quote-price-down quote-price-up');
            elem.parent().children("form").find("input[type='submit']").fadeIn(100);
          }
        });
      } else {
         quote_details_elem.slideUp({
          duration: "500",
          easing: "swing",
          start:  function() {
            elem.parent().children("form").find("input[type='submit']").hide().toggleClass('submit_relocated');
//            elem.parent().children("form").find("input[type='submit']").animate({ height : '0', padding : '0', lineHeight : '0'});  .removeAttr('style')
          },
          complete: function() {
            elem.children("h2").find(".price").fadeIn(300);
            $(".quote-price-control").toggleClass('quote-price-up quote-price-down');
            elem.parent().children("form").find("input[type='submit']").fadeIn(100);
          }
        });
      }
    }      
  }

  function show_section(elem,e) {
    var qs = {},
        load_from_qs = true,
        container_id,
        val;
    if(typeof elem !== 'undefined') {
      if(elem.val()) { // interaction by user
        key = elem.attr("id");
        val = elem.val();
        qs[key] = val;
      } else { // initiated but nothing selected (on page load without querystring)
        create_hidden_inputs($("[id^='" + elem.data("mod-display").split("_")[0] + "_section_']"),e);
        return;
      }
    } else { // initiated with querystring
      qs = get_querystring();
      load_from_qs = true;
    }
    for(var key in qs) {
      var name_end = key.indexOf("_" + qs[key]),
          section_id_part = name_end > -1 ? key.substring(0, key.indexOf("_" + qs[key])) : key,
          section = $("#" + section_id_part + "_section_" + qs[key]),
          select_elem = $("#" + key),
          containered_sections = $("[id^='" + section_id_part + "_section_']");
      if(section.length != 0) {
        container_id = select_elem.data("mod-display");
        var container = $("#" + container_id);
        if(event.type != "load" && event.type != "submit" && containered_sections.length != 0) {
          var price_line_item_id;
          if(section.css("display") == "none") {
            if((($("#" + key).attr("type") == "checkbox" || $("#" + key).attr("type") == "radio") && $("#" + key).is(":checked") ) || $("#" + key).prop("tagName").toLowerCase() == "select") {
              if(!is_multiple_input(select_elem)) {
                if(select_elem.prop("tagName").toLowerCase() == "select") {
                  containered_sections.hide();
                } else {
                  containered_sections.slideUp(500);
                }
                containered_sections.find(":input").each(function() {
                  price_line_item_id = "ql_" + $(this).attr("id");
                  if($("#" + price_line_item_id).length) {
                    remove_price_line(price_line_item_id);
                  }
                });
              }
              section.slideDown({
                start : function(){
                  if(select_elem.data("mod-display")) {
                    move_section_to_focus(section);
                  }
                  if($("#" + key).attr("type") == "checkbox" || $("#" + key).attr("type") == "radio") {
                    select_elem.prop("disabled",true);
                  }
                },
                duration : 500,
                complete : function() {
                  if(is_multiple_input(select_elem)) {
                    create_hidden_inputs(section,e);
                  } else {
                    create_hidden_inputs(containered_sections,e);
                  }
                  section.find(":input").filter(":visible").each(function() {
                    if(has_value($(this))) {
                      cs_validation($(this),false,e);
                    } 
                    price_line_item_id = "ql_" + $(this).attr("id");
                    if(!$("#" + price_line_item_id).length) {
                      do_price_line($(this));
                    }
                    if(($(this).val() == '0' || $(this).val() == '') && !$(this).prop("required")) {
                      set_default($(this),false);
                    }
                  });
                  if($("#" + key).attr("type") == "checkbox" || $("#" + key).attr("type") == "radio") {
                    $("#" + key).prop("disabled",false);
                  }
                  activate_response(false);
                }
              });
            }
          } else {

            // The moment a checkbox is unchecked
            if(((select_elem.attr("type") == "checkbox" || select_elem.attr("type") == "radio") && select_elem.not(":checked") ) || select_elem.prop("tagName").toLowerCase() == "select") {
              section.slideUp({
                start : function(){
                  if(select_elem.attr("type") == "checkbox" || select_elem.attr("type") == "radio") {
                    select_elem.prop("disabled",true);
                  }
                },
                duration : 500,
                complete : function(){
                  section.find(":input").each(function() {
                    price_line_item_id = "ql_" + $(this).attr("id");
                    if($("#" + price_line_item_id).length) {
                      remove_price_line(price_line_item_id);
                    }
                  });
                  if(select_elem.attr("type") == "checkbox" || select_elem.attr("type") == "radio") {
                    select_elem.prop("disabled",false);
                  }
                  activate_response(false);
                  if(is_multiple_input(select_elem)) {
                    create_hidden_inputs(section,e);
                  } else {
                    create_hidden_inputs(containered_sections,e);
                  }

                }
              });
            }
          }
        }
        if(event.type == "load") {
          var section = $("#" + section_id_part + "_section_" + qs[key]);
          section.show({
            start : function() {
              create_hidden_inputs(containered_sections.filter(":visible"),e);
            },
            duration : 0,
            complete : function() {
              do_price_line(select_elem);
              var input_array = $(this).find("input:valid").filter(":visible");
              input_array.each(function() {
                if(has_value($(this))) {
                  do_price_line($(this));
                }
              });
            }
          });
        }
      }
    }
  }

  function move_section_to_focus(section) {
    var section_id = section.attr("id");
    var section_identifier = "_section_";
    var input_name = section_id.substring(0, section_id.indexOf(section_identifier));
    var input_value = section_id.substring(section_id.length - (section_id.length - (input_name.length + section_identifier.length)));
    var input_id = input_name + "_" + input_value;
    var the_input = $("#" + input_id);
    if(the_input.attr("type") == "checkbox" && the_input.val() == input_value) {
      section.detach().insertAfter($("#" + input_id + "[type='checkbox']").parent());
    } else if(the_input.attr("type") == "radio" && the_input.val() == input_value) {
      section.detach().insertAfter($("#" + input_id + "[type='radio']").parent());
    }

  }

  function is_multiple_input(elem) {
    return (elem.attr("type") && elem.prop("type")=="checkbox" && elem.prop("name").indexOf("[]") != -1);
  }

  function is_checkradio_input(elem) {
    return (elem.attr("type")=="checkbox" || elem.attr("type")=="radio");
  }

  function create_hidden_inputs(containered_sections,e) {
    var required_array = [],
        hidden_required_array = [];

    // Create 'required_array' from 'required_inputs' hidden input.
    if($("#required_inputs").val() != '') {
      required_array = $("#required_inputs").val().split("|");
    } else {

      // Get all the visible required inputs and put them in 'required_array'.
      containered_sections.find("[required]:visible").each(function() {
        var name = $(this).prop("name");
        if($.inArray(name,required_array) == -1) {
          required_array.push(name);
        }
      });
    }

    // Create the 'hidden_required_array' from 'hidden_required_inputs' hidden input.
    if($("#hidden_required_inputs").val() != '') {
      hidden_required_array = $("#hidden_required_inputs").val().split("|");
    } else {

    // Get all the hidden required inputs and put them in 'hidden_required_array'.
      containered_sections.find("[required]:hidden").each(function() {
        var name = $(this).prop("name");
        if($.inArray(name,hidden_required_array) == -1) {
          hidden_required_array.push(name);
        }
      });
    }
    
    // Combine the two arrays
    var combined_required_array = required_array.concat(hidden_required_array);

    // Find all hidden inputs
    containered_sections.find(":input").filter(":hidden").each(function() {

      var name = $(this).prop("name");

      // Is the name of the input found in the 'combined_array'?
      // In other words: Is this input a required input?
      if($.inArray(name,combined_required_array) != -1) {

        // If an input in a hidden section is required, remove the required attribute.
        set_optional($(this));

        // Add the name of this input to the 'hidden_required_array'.
        if($.inArray(name,hidden_required_array) == -1) {
          hidden_required_array.push(name);
        }

        // Remove the name of this input from the 'required_array'.
        required_array = jQuery.grep(required_array, function(value) {
          return value != name;
        });
      }
    });
    
    // Store the values of both altered arrays in their respective hidden input elements.
    if(required_array.length > 0) {
      $("#required_inputs").val(trim(required_array.join("|"),"|"));
    }
    if(hidden_required_inputs.length > 0) {
      $("#hidden_required_inputs").val(trim(hidden_required_array.join("|"),"|"));
    }
    
    // Combine the altered arrays again.
    combined_required_array = required_array.concat(hidden_required_array);

    // Find all inputs in the shown section
    if(typeof section !== 'undefined') {
      section_id = section.prop("id");
    }
    
    containered_sections.find(":input:visible").each(function() {
      var name = $(this).prop("name");

      // Is the name of the input found in the 'combined_array'?
      // In other words: Is this input a required input?
      if($.inArray(name,combined_required_array) != -1) {
        
        // Set the attribute to 'required' in the inputs found.
        set_required($(this));
        $(this).closest(".input-wrap").find(".required-input-field").removeAttr("style");
        $(this).closest(".input-wrap").find(".form-not-valid-tip").css({"display" : "none"});
        if($(this).attr("type")=="number" && $(this).val() == '0') {
          if(e.type != "load") {
            cs_validation($(this),true,e);
          }
        }

        // Add the name of this input to the 'required_array'.
        if($.inArray(name,required_array) == -1) {
          required_array.push(name);
        }

        // Remove the name of this input from the 'hidden_required_array'.
        hidden_required_array = jQuery.grep(hidden_required_array, function(value) {
          return value != name;
        });
      }
    });

    // Store the values again of both altered arrays in their respective hidden input elements.
    $("#required_inputs").val(trim(required_array.join("|"),"|"));
    $("#hidden_required_inputs").val(trim(hidden_required_array.join("|"),"|"));
  }

  function set_optional(elem) {
    var aria_elem;
    if(elem.prop("type") == "radio" || elem.prop("type") == "checkbox") {
      aria_elem = elem.closest(".fieldset");
    } else {
      aria_elem = elem;
    }
    aria_elem.removeAttr("aria-required aria-invalid style");
    elem.closest(".input-wrap").find(".required-input-field").removeAttr("style");
    elem.closest(".input-wrap").find(".form-not-valid-tip").css({"display" : "none"});
    elem.removeAttr("required");
  }

  function set_required(elem) {
    var aria_elem;
    if(elem.prop("type") == "radio" || elem.prop("type") == "checkbox") {
      aria_elem = elem.closest(".fieldset");
    } else {
      aria_elem = elem;
    }
    elem.prop("required",true);
    aria_elem.attr({
      "aria-required" : "true",
      "aria-invalid" : "false",
      "style" : ""
    });
  }
  
  function trim (s, c) {
    if (c === "]") c = "\\]";
    if (c === "\\") c = "\\\\";
    return s.replace(new RegExp(
      "^[" + c + "]+|[" + c + "]+$", "g"
    ), "");
  }

  function get_querystring() {
    location.queryString = {};
    location.search.substr(1).split("&").forEach(function (pair) {
      if(pair == "") return;
      var parts = pair.split("=");
      location.queryString[parts[0]] = parts[1] && decodeURIComponent(parts[1].replace(/\+/g, " "));
    });
    return location.queryString;
  }

  function has_error(elem) {
    var the_elem;
    if(elem.attr('type') != 'checkbox' && elem.attr('type') != 'radio') {
      the_elem = elem;
    } else if(elem.closest('.fieldset').length != 0) {
      the_elem = elem.closest('.fieldset');
    } else {
      return true;
    }
    return the_elem.attr('aria-invalid') == "true";
  }
  
  function has_errors() {
    var first_error=false;
    $("form").find("[required], .fieldset.required").filter(":visible").each(function() {
      if(has_error($(this))) {
        first_error = $(this);
        return false;
      }
    });
    return first_error;
  }

  function cs_validation(elem,focused_out,e) {
    if(! has_value(elem) ) {
      if(elem.prop('required')) {
        if(elem.attr('type') != "range") {
          switch(true) {
            case (elem.attr('data-error-response-type')=='use_label_possessive'): do_error(elem,error_contents['empty_with_label_possessive'], [get_textvalue(elem.closest("label")).toLowerCase()],e); break;
            case (elem.attr('data-error-response-type')=='use_label_defined_1'): do_error(elem,error_contents['empty_with_label_defined_article_1'], [get_textvalue(elem.closest("label")).toLowerCase()],e); break;
            case (elem.attr('data-error-response-type')=='use_label_defined_2'): do_error(elem,error_contents['empty_with_label_defined_article_2'], [get_textvalue(elem.closest("label")).toLowerCase()],e); break;
            case (elem.attr('data-error-response-type')=='use_label_undefined'): do_error(elem,error_contents['empty_with_label_undefined_article'], [get_textvalue(elem.closest("label")).toLowerCase()],e); break;
            case (elem.closest('.fieldset.no-fieldset-border').length!=0 && elem.attr('type')=='checkbox'): do_error(elem,error_contents['empty_single_check'],false,e); break;
            case (elem.closest('.fieldset').length!=0 && elem.attr('type')=='radio'): do_error(elem,error_contents['empty_radio'], [get_number_of_valid_options(elem.closest('.fieldset'))],e); break;
            case (elem.closest('.fieldset').length!=0 && elem.attr('type')=='checkbox'): do_error(elem,error_contents['empty_check'], [get_number_of_valid_options(elem.closest('.fieldset'))],e); break;
            case (elem.prop('tagName').toLowerCase()=='textarea'): do_error(elem,error_contents['empty_textarea'],false,e); break;
            case (elem.prop('tagName').toLowerCase()=='select'): do_error(elem,error_contents['empty_select'], [get_number_of_valid_options(elem)],e); break;
            default: if(elem.attr('required')) do_error(elem,error_contents['empty'],false,e);
          }
        } else {
          do_error(elem,error_contents['number_is_zero'],false,e);
        }
      } else if(has_error(elem)) {
        set_default(elem,true);
      }
    } else {
      if( elem.attr('type')=="email" && !is_email(elem.val()) ) {
        do_error(elem,error_contents['email_invalid'],false,e);
      } else if((elem.attr('type') == "number" || elem.attr('type') == "range") && ((e.type=="load" && parseFloat(elem.val()) == 0) || !contains_proper_number(elem))) {
        if(parseFloat(elem.val()) === 0) {
          if((elem.prop('required') && elem.attr("type") != "range")) {
            do_error(elem,error_contents['number_is_zero'],true,e);
          } else {
            set_default(elem,false);
          }
          if(focused_out && !elem.prop('required') && elem.attr("type") != "range") {
            elem.val("");
          }
        } else if(elem.val() == '') {
          do_error(elem,error_contents['empty_with_label_undefined_article'], [get_textvalue(elem.closest("label")).toLowerCase()],e);
        } else if(elem.attr("data-decimals") && number_of_decimals(elem.val()) > elem.attr("data-decimals")) {
          do_error(elem,error_contents['only_x_decimals'], [elem.attr("data-decimals")],e);
        } else {
          do_error(elem,error_contents['only_numbers'],false,e);
        }
      } else if( elem.attr('id')=="mathcaptcha" ) {
        do_mathcaptcha(elem,e);
      } else {
        if(e.type=="load" && parseFloat(elem.val()) == 0) {
        } else {
          elem.closest('.input-wrap').find('> .form-not-valid-tip').slideUp({
            "duration" : 500,
            "start" : function() {
              if(elem.prop("required")) color_formfield( elem, true, false );
              else color_formfield(elem,true,true);
            },
            "complete" : function() {
              return activate_response(elem);
            }
          });
        }
      }       
    }
  }

  function color_formfield( elem, input_is_valid, set_default ) {
    var opener_info = get_opener_info(elem),
        the_elem;
    if(elem.attr('type') != 'checkbox' && elem.attr('type') != 'radio') {
      the_elem = elem;
    } else {
      the_elem = elem.closest('.fieldset');
    }
    if(input_is_valid) {
      if(set_default) {
        if(!elem.closest('.fieldset').hasClass('no-fieldset-border')) {
          the_elem.removeAttr('style');
        }
        the_elem.attr("aria-invalid", "false");
        set_formfield_display_state(the_elem,'default');
      } else {
        if(!elem.closest('.fieldset').hasClass('no-fieldset-border')) {
          if(elem.attr("type") == "range") {
            the_elem.removeAttr('style').css({'border-color':'#6c3', 'outline-color' : '#9f6'});
          } else {
            if(elem.is(":focus")) {
              the_elem.css({'border-color':'#6c3', 'outline-color' : '#9f6'});
            } else {
              the_elem.removeAttr('style').css({'border-color':'#6c3'});
            }
          }
        }
        the_elem.attr("aria-invalid", "false");
        set_formfield_display_state(the_elem,'ok');
      }
/*
      if(opener_info) {
        var all_openers = get_all_openers(elem),
            current_opener_info,
            current_section,
            current_has_error = false,
            current_child_section = get_mod_elem(elem);
        all_openers.each(function() {
          current_opener_info = get_opener_info($(this));
          current_section = $("#" + current_opener_info['current_section_id']);
          current_section.find("input:visible").each(function() {
            if($(this).attr("id") != elem.attr("id")) {
              if(has_error($(this))) {  
                current_has_error = true;
//                set_formfield_display_state($(this), 'error'); // set the current input field state to error
//                set_formfield_ancestors_display_state($(this), 'ok'); // set all it's section ancestors' states to ok
                set_formfield_display_state($("#" + get_opener_info($(this))['id']), 'error'); // set it's section parent state to error
                return false;
              }
            } else {
              set_formfield_display_state($(this), 'ok');
            }
          });
          if(!current_has_error) {
            set_formfield_display_state($("#" + current_opener_info['id']), 'ok');
          }
        });
      }
*/
    } else {
      if(!elem.closest('.fieldset').hasClass('no-fieldset-border')) {
        if(!elem.closest('.fieldset').hasClass('no-fieldset-border')) {
          if(the_elem.is(":focus")) {
            the_elem.css({'border-color':'#c00', 'outline-color' : '#fcc'});
          } else {
            the_elem.removeAttr('style').css({'border-color':'#c00'});
          }
        }
      }
      the_elem.attr("aria-invalid", "true");
      set_formfield_display_state(the_elem,'error');
    }
  }

  function do_error(elem,error,values,e) {
    color_formfield(elem, false, false);
    if(typeof e != "undefined" && (e.type == "focusout" || e.type == "change" || e.type == "submit" || e.type == "load")) {
      if(values) error = sprintf(error, values);
      elem.closest('.input-wrap').find('> .form-not-valid-tip').html(error).slideDown({
        duration: 500,
        start: function(){$(this).css({"display": "block"});},
        complete: function(){return activate_response(elem);}
      });
    }
  }

  function do_mathcaptcha(elem,e) {
    if(typeof elem.val() != 'undefined' && elem.val().trim() != '') {
      if(! contains_only_int(elem.prop("value"))) {
        do_error(elem,error_contents['only_numbers'],false,e);
      } else {
        color_mc(elem,e);
      }
    } else {
      do_error(elem,error_contents['empty'],false,e);
    }
  } 

  function has_wrong_range(elem) {
    return (elem && elem.attr('type') == 'range' && elem.val() == '0');
  }

  function has_value(elem) {
    if(elem.attr('type')=='checkbox' || elem.attr('type')=='radio') {
      if(get_number_of_valid_options(elem.closest('.fieldset')) > 1) {
        return $("[name='"+elem.attr('name')+"']").is(":checked");
      } else {
        return elem.is(":checked");
      }
    } else if(elem.attr('type') == "range") {
      return (elem.val()!='0');
    } else {
      if((elem.attr('type') == "number" || elem.attr('type') == "range") && parseFloat(elem.val()) === 0) {
        return true;
      } else if(elem.val() == '' || elem.val() == null) {
        return false;
      } else {
        return true;
      }
    }
  }

  function required_empty_inputs_left() {
    var n = 0;
    $("[required]:visible").each(function() {
      if(!has_value($(this))) {
        n++;
      }
    });
    return (n);
  }

  function activate_response(elem) {
    var error = $(".form-response-output.form-validation-errors"),
        ok = $(".form-response-output.form-validation-ok");
    if(!has_errors() && !has_wrong_range(elem)) {
      if(error.css("display") == "block") error.slideUp(500);
      if(required_empty_inputs_left() == 0) {
        if(ok.css("display") == "none") ok.slideDown({
          duration: 500,
          start: function(){$(this).css({"display" : "block"})}
        });
      } else {
        if(ok.css("display") == "block") ok.slideUp(500);
      }      
    } else {
      if(error.css("display") == "none") error.slideDown({
        duration: 500,
        start: function(){$(this).css({"display" : "block"})}
      });
      if(ok.css("display") == "block") ok.slideUp(500);
    }
  }

  function contains_only_int(n) {
    if(!n.match(/\D+/)) {
      n = parseInt(n);
      return +n === n && !(n % 1);
    }
    return false;
  }
  
  function contains_proper_number(elem) {
    var nr = parseFloat(elem.val());
    if(parseFloat(elem.val()) <= 0) {
      return false;
    } else if(elem.attr("data-decimals")) {
      var regex_str = "^[0-9]+(\.[0-9]{0,"+parseInt(elem.attr("data-decimals"))+"})?$",
          regex = new RegExp(regex_str);
      return regex.test(nr);
    }
    return /^[\d\s]+$/.test(nr);
  }

  function number_of_decimals(nr) {
    if(!nr.split('.')[1]) {
      return 0;
    }
    return nr.split('.')[1].length;
  }

  function is_email(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }

  function check_mc( elem ) {
    if(elem.val() == '') {
      return 'init';
    } else if(contains_only_int( elem.val() )) {
      var val = parseInt(elem.val());
      if(val != get_solution(elem)) {
        if(val > 18 || val < 2) return 'outofbounds';
        else return 'wrong';
      }
      else return 'right';
    }
    return 'blank';
  }
  
  function get_solution(elem) {
    var mc_contents = elem.prev().html().trim().split(" ");
    if(mc_contents[1] == "+") {
      return (parseInt(mc_contents[0]) + parseInt(mc_contents[2]));
    } else if(mc_contents[1] == "-") {
      return (parseInt(mc_contents[0]) - parseInt(mc_contents[2]));
    }
  }

  function get_mod_elem(input_elem) {
    if(input_elem.data("mod-display")) {
      return $("#" + input_elem.data("mod-display").replace("_contents","") + "_section_" + input_elem.val());
    }
    return false;
  }
  
  function set_default(elem, animate) {
    var aria_elem;
    if(elem.prop("type") == "radio" || elem.prop("type") == "checkbox") {
      aria_elem = elem.closest(".fieldset");
    } else {
      aria_elem = elem;
    }
    aria_elem.removeAttr("style");
    set_formfield_display_state(elem,'default');
    if(animate) {
      elem.closest(".input-wrap").find(".form-not-valid-tip").slideUp(500);
    } else {
      elem.closest(".input-wrap").find(".form-not-valid-tip").css({"display" : "none"});
    }
    elem.removeAttr("required aria-required aria-invalid");
  }

  function color_mc( elem, e ) {
    if(check_mc(elem) == 'right') {
      color_formfield( elem, true, false );
      $(".mathcaptcha-box").find('.form-not-valid-tip').slideUp(500, function() { return activate_response(elem); });
    } else {
      if( typeof e != "undefined" && e.type == "focusout" ) {
        if(check_mc(elem) == 'outofbounds') {
          elem.siblings('.form-not-valid-tip').html(error_contents['only_number_between']).slideDown({
            duration: 500,
            start: function(){$(this).css({"display": "block"})},
            complete: function(){return activate_response(elem);}
          });
        } else {
          elem.siblings('.form-not-valid-tip').html(error_contents['bad_math']).slideDown({
            duration: 500,
            start: function(){$(this).css({"display": "block"})},
            complete: function(){return activate_response(elem);}
          });
        }
      }
      color_formfield( elem, false, false );
    }
  }

  function set_formfield_display_state(input_elem, state) {
    if(state == "error") {
      input_elem.closest(".input-wrap").find("> .required-input-field").css({'background-image':'url(\'data:image/svg+xml,%3C%3Fxml version="1.0" encoding="utf-8"%3F%3E%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"%3E%3Cpath d="M585.6,123.3c0-75.5-29.1-113.3-87-113.3c-57.8,0-86.9,37.8-86.9,113.3c0,14.1,1.8,29,5.3,44.8L459,368.4c3.4,17.6,5.3,30.6,5.3,39.4c0,10.5-4.4,15.9-13.2,15.9c-5.3,0-18.4-9.9-39.5-29.4l-152.7-144c-31.6-30.2-66.7-45.3-105.4-45.3c-58,0-86.9,25.6-86.9,76.7c0,49.4,34.5,87.3,103.5,113.9l196.5,74c30.1,10.6,45.1,21.2,45.1,31.7c0,7-15,16.8-45.1,29.2l-196.5,74c-69,26.6-103.5,65.4-103.5,116.6c0,51,28.1,76.7,84.3,76.7c38.6,0,74.6-15.9,108-47.6L411.7,608c21.1-19.3,34.2-29,39.5-29c8.8,0,13.2,5.2,13.2,15.7c0,8.8-1.9,22.1-5.3,39.6L417,834.6c-3.5,15.7-5.3,30.6-5.3,44.6c0,74,29,110.9,86.9,110.9c58,0,87-36.9,87-110.9c0-12.2-1.9-27-5.4-44.6l-39.4-200.2l-5.4-31.7v-10.4c0-8.8,4.4-13.1,13.3-13.1c5.2,0,18.4,9.7,39.4,29l152.9,142.2c33.3,31.7,68.4,47.6,105.3,47.6c58,0,87-26.3,87-79.1c0-49.1-34.6-87-103.5-113.2l-199.1-73.9c-30-12.3-45-22-45-29c0-8.8,15-19.3,45-31.6l199.1-73.8c68.9-26.3,103.5-65,103.5-115.9c0-50.9-29.1-76.4-87-76.4c-36.9,0-72,15.8-105.3,47.4L588.2,394.7c-21,19.4-34.2,29.1-39.4,29.1c-8.9,0-13.3-4.4-13.3-13.3l44.8-242.4C583.8,150.5,585.6,135.6,585.6,123.3L585.6,123.3z" fill="%23c00"/%3E%3C/svg%3E\')'});
    } else if(state == "ok") {
      input_elem.closest(".input-wrap").find("> .required-input-field").css({'background-image':'url(\'data:image/svg+xml,%3C%3Fxml version="1.0" encoding="utf-8"%3F%3E%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"%3E%3Cpath d="M585.6,123.3c0-75.5-29.1-113.3-87-113.3c-57.8,0-86.9,37.8-86.9,113.3c0,14.1,1.8,29,5.3,44.8L459,368.4c3.4,17.6,5.3,30.6,5.3,39.4c0,10.5-4.4,15.9-13.2,15.9c-5.3,0-18.4-9.9-39.5-29.4l-152.7-144c-31.6-30.2-66.7-45.3-105.4-45.3c-58,0-86.9,25.6-86.9,76.7c0,49.4,34.5,87.3,103.5,113.9l196.5,74c30.1,10.6,45.1,21.2,45.1,31.7c0,7-15,16.8-45.1,29.2l-196.5,74c-69,26.6-103.5,65.4-103.5,116.6c0,51,28.1,76.7,84.3,76.7c38.6,0,74.6-15.9,108-47.6L411.7,608c21.1-19.3,34.2-29,39.5-29c8.8,0,13.2,5.2,13.2,15.7c0,8.8-1.9,22.1-5.3,39.6L417,834.6c-3.5,15.7-5.3,30.6-5.3,44.6c0,74,29,110.9,86.9,110.9c58,0,87-36.9,87-110.9c0-12.2-1.9-27-5.4-44.6l-39.4-200.2l-5.4-31.7v-10.4c0-8.8,4.4-13.1,13.3-13.1c5.2,0,18.4,9.7,39.4,29l152.9,142.2c33.3,31.7,68.4,47.6,105.3,47.6c58,0,87-26.3,87-79.1c0-49.1-34.6-87-103.5-113.2l-199.1-73.9c-30-12.3-45-22-45-29c0-8.8,15-19.3,45-31.6l199.1-73.8c68.9-26.3,103.5-65,103.5-115.9c0-50.9-29.1-76.4-87-76.4c-36.9,0-72,15.8-105.3,47.4L588.2,394.7c-21,19.4-34.2,29.1-39.4,29.1c-8.9,0-13.3-4.4-13.3-13.3l44.8-242.4C583.8,150.5,585.6,135.6,585.6,123.3L585.6,123.3z" fill="%236c3"/%3E%3C/svg%3E\')'});
    } else if(state == "default") {
      input_elem.closest(".input-wrap").find("> .required-input-field").css({'background-image':'url(\'data:image/svg+xml,%3C%3Fxml version="1.0" encoding="utf-8"%3F%3E%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"%3E%3Cpath d="M585.6,123.3c0-75.5-29.1-113.3-87-113.3c-57.8,0-86.9,37.8-86.9,113.3c0,14.1,1.8,29,5.3,44.8L459,368.4c3.4,17.6,5.3,30.6,5.3,39.4c0,10.5-4.4,15.9-13.2,15.9c-5.3,0-18.4-9.9-39.5-29.4l-152.7-144c-31.6-30.2-66.7-45.3-105.4-45.3c-58,0-86.9,25.6-86.9,76.7c0,49.4,34.5,87.3,103.5,113.9l196.5,74c30.1,10.6,45.1,21.2,45.1,31.7c0,7-15,16.8-45.1,29.2l-196.5,74c-69,26.6-103.5,65.4-103.5,116.6c0,51,28.1,76.7,84.3,76.7c38.6,0,74.6-15.9,108-47.6L411.7,608c21.1-19.3,34.2-29,39.5-29c8.8,0,13.2,5.2,13.2,15.7c0,8.8-1.9,22.1-5.3,39.6L417,834.6c-3.5,15.7-5.3,30.6-5.3,44.6c0,74,29,110.9,86.9,110.9c58,0,87-36.9,87-110.9c0-12.2-1.9-27-5.4-44.6l-39.4-200.2l-5.4-31.7v-10.4c0-8.8,4.4-13.1,13.3-13.1c5.2,0,18.4,9.7,39.4,29l152.9,142.2c33.3,31.7,68.4,47.6,105.3,47.6c58,0,87-26.3,87-79.1c0-49.1-34.6-87-103.5-113.2l-199.1-73.9c-30-12.3-45-22-45-29c0-8.8,15-19.3,45-31.6l199.1-73.8c68.9-26.3,103.5-65,103.5-115.9c0-50.9-29.1-76.4-87-76.4c-36.9,0-72,15.8-105.3,47.4L588.2,394.7c-21,19.4-34.2,29.1-39.4,29.1c-8.9,0-13.3-4.4-13.3-13.3l44.8-242.4C583.8,150.5,585.6,135.6,585.6,123.3L585.6,123.3z" fill="%23333"/%3E%3C/svg%3E\')'});
    } else {
    }
  }

  function set_formfield_ancestors_display_state(input_elem, state) {
    var current_within = input_elem,
        current_within_opener_info;
    while(get_opener_info(current_within)) {
      current_within_opener_info = get_opener_info(current_within);
      set_formfield_display_state($("#" + current_within_opener_info['id']), state);
      current_within = $("#" + current_within_opener_info['id']);
    }
  }

  function sprintf(template, values) {
    return template.replace(/%s/g, function() {
      return values.shift();
    });
  }
  
  function get_textvalue(elem) {
    return elem.contents().filter(function(){
      return this.nodeType == 3;
    })[0].nodeValue;
  }
  
  function get_number_of_valid_options(elem) {
    var input_obj = elem; 
    if(elem.prop("tagName").toLowerCase() == 'select') {
      input_obj = elem.children().not(":disabled").length;
    } else {
      if($(">label>input[type='checkbox']",elem).length) {
        input_obj = $(">label>input[type='checkbox']:visible",elem).length;
      } else {
        input_obj = $(">label>input[type='radio']:visible",elem).length;
      }
    }
    return input_obj;
  }
  
  function in_array(array, elem, fromIndex) {
    if(array != null) {
      var o = Object(array);
      var len = o.length >>> 0;
      if (len === 0) {
        return false;
      }
      var n = fromIndex | 0;
      var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);
      while (k < len) {
        if (o[k] === elem) {
          return true;
        }
        k++;
      }
    }
    return false;
  }
  
  function set_form_display_type() {
    if($("#form-container").width() > 963) {
      $("#form-container").toggleClass("form-split-view");
    } else {
      $("#form-container").toggleClass("form-single-view");
    }
    $(".bq-wide").css("left", (-1 *(($(window).width() - $(".bq-wide").parents("#form-container").width()) * .5)) + "px");
  }

})(jQuery);
