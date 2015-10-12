//Color Settings
function selectedBgColorPreview(colorId,colorClass){
	var x=document.getElementById(colorId);
	var elems = document.getElementsByClassName(colorClass);
	for(var i = 0; i < elems.length; i++) {
		elems[i].style.backgroundColor = x.value;
	}
}
function colorPreview(colorId,colorClass){
	var x=document.getElementById(colorId);
	var elems = document.getElementsByClassName(colorClass);
	for(var i = 0; i < elems.length; i++) {
		elems[i].style.color = x.value;
	}
}
function selectedBorderColorPreview(colorId,colorClass){
	var x=document.getElementById(colorId);
	var elems = document.getElementsByClassName(colorClass);
	for(var i = 0; i < elems.length; i++) {
		elems[i].style.borderColor = x.value;
	}
}

	
jQuery(document).ready(function() {
	
	jQuery('.shortcode-type').change(function() {
		jQuery('#cgs_form_bulider').css('display','block');
		jQuery('#cgs_code_middle').css('display','inline');
		jQuery('#cgs_code').css('display','block');
		if (jQuery(this).val() == 'sc_html') {
			jQuery('#cgs_code_begin, #cgs_code_middle, #cgs_code_end').removeClass('sc_php').addClass('sc_html');
			jQuery('#cgs_code_begin').text("[content-slider ");
			jQuery('#cgs_code_end').text("]");
		} else if (jQuery(this).val() == 'sc_php') {
			jQuery('#cgs_code_begin, #cgs_code_middle, #cgs_code_end').removeClass('sc_html').addClass('sc_php');
			jQuery('#cgs_code_begin').html("&lt;?php <span class='cgs_echo'>echo</span> do_shortcode<span class='cgs_paren'>('[content-slider</span> <span class='cgs_quote'></span>");
			jQuery('#cgs_code_end').html("<span class='cgs_quote'></span> <span class='cgs_paren'>]');</span> ?&gt;");
		}
	});

	jQuery('#cgs_orderby').change(function() {
		if (jQuery('#cgs_orderby').find(":selected").val() != 'random' && jQuery('#cgs_orderby').find(":selected").val() != '') {
			jQuery('#cgs_order_field').css('display','block');
		} else {
			jQuery('#cgs_order_field').css('display','none');
		}	
	});
	
	function SelectText(element) {
		var doc = document
			, text = doc.getElementById(element)
			, range, selection
		;    
		if (doc.body.createTextRange) {
			range = document.body.createTextRange();
			range.moveToElementText(text);
			range.select();
		} else if (window.getSelection) {
			selection = window.getSelection();        
			range = document.createRange();
			range.selectNodeContents(text);
			selection.removeAllRanges();
			selection.addRange(range);
		}
	}
	
    jQuery('#cgs_code').click(function() {
        SelectText('cgs_code');
    });
	jQuery('#cgs_code1').click(function() {
        SelectText('cgs_code1');
    });
	jQuery('#cgs-shortcode').click(function() {
        SelectText('cgs-shortcode');
    });
	
	// http://css-tricks.com/snippets/javascript/htmlentities-for-javascript/
	function htmlEntities(str) {
		return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	}
	
	// http://api.jquery.com/serializeArray/
	function showValues() {
	
		var fields = jQuery("#cgs_form_bulider :input").serializeArray();
	
		jQuery("#cgs_code_middle").empty();
		params = new Array;
		groupIds = new Array;
		group_qs = '';

		// For groups
		jQuery.each(fields, function(i, field){
			if (field.name == 'groups') {
				groupIds.push(field.value);
			}
		});

		// Not for groups
		jQuery.each(fields, function(i, field){
			if (field.name != 'groups') {
				if (field.value.length > 0 && field.name != 'cgs-hidden') {
					params.push(field.name+'='+htmlEntities(field.value));
				}
			}
		});

		qs = params.join(' ');
	
		if (groupIds.length > 0) {
			amp = '';
			if (qs.length > 0) {
				amp = ' ';
			}
			group_qs = 'groups='+groupIds.join(',')+amp;
		}

		jQuery("#cgs_code_middle").append(group_qs+qs);
		//jQuery("#cgs_code").hide().fadeIn(500);
		jQuery("#cgs_code1").hide().fadeIn(500);
	}

	jQuery("#cgs_form_bulider :checkbox, #cgs_form_bulider :radio, .shortcode_type").click(showValues);
	jQuery("#cgs_form_bulider select").change(showValues);
	jQuery("#cgs_form_bulider input").keyup(showValues);
	//showValues();
	
	//Detecting shortcode type
	jQuery("input[name=shortcode-type]").change( function () {
		var sc_type = jQuery(this).val();
		jQuery("input[name=cgs-hidden]").val(sc_type);
	});
	
	//Adding class to 1st tab on document load
	if(!jQuery('h2.cgs-settings-tabs a').hasClass('nav-tab-active'))
		jQuery('h2.cgs-settings-tabs a:first-child').addClass('nav-tab-active');
		
	//Short-code handling
	jQuery('.shortcode-type,#groups,#cgs_orderby,#cgs_order').change(function() {
		jQuery("#cgs_code1").text(jQuery("#cgs_code").text());
		jQuery("#cgs_code1").show();
	});
});