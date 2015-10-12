global_var = true;
function clickon(val){
	document.getElementById(val).classList.add("cgs_active");
	document.getElementById(val).style.background = document.getElementById('activeslidebgcolor').value;
	global_var = false;
}
jQuery(document).ready(function(){
	
	/****** code for assigning custom colors by admin interface *********/
	var mainheadingcolor = jQuery('#mainheadingcolor').val();
	var fontcolor = jQuery('#fontcolor').val();
	var activeslidetitlecolor = jQuery('#slidetitlecolor').val();
	var selectedslidebgcolor = jQuery('#selectedslidebgcolor').val();
	var selectedslidebordercolor = jQuery('#selectedslidebordercolor').val();
	//alert(selectedslidebordercolor)
	var activeslidebgcolor = jQuery('#activeslidebgcolor').val();
	jQuery('#cgs_tabs h4.slider-heading').css('color',mainheadingcolor);
	jQuery('#cgs_tabs .cgs-title, #cgs_tabs .cgs-content p').css('color',fontcolor);
	jQuery('#cgs_tabs h3.description-heading,#cgs_tabs .text-right a').css('color',activeslidetitlecolor);
	
	jQuery( '#cgs_tabs' ).on( 'mouseup', '.cgs-icons', function () {
		jQuery('#cgs_tabs').find('.cgs_active').removeClass('cgs_active');
		jQuery('.cgs-description').css('background','');
		jQuery('#cgs_tabs').find('.cgs_selected').removeClass('cgs_selected');
		jQuery('#cgs_tabs .cgs-icons').css({'background':'','border-color':''});
		jQuery(this).addClass('cgs_selected');
		jQuery('#cgs_tabs .cgs-icons.cgs_selected').css({'background':selectedslidebgcolor,'border-color':selectedslidebordercolor});
	});
	var arr1 = jQuery('.cgs-icons').get();
	var arr2 = jQuery('.cgs-description').get();
	function random1(arr1) {
		if(!global_var){
			return false;
		}
		else{
			setTimeout(function () {
				random1(arr1);
			}, Math.floor(4000));
		}
		if(arr1.length == 0){
			arr1 = jQuery('.cgs-icons').get();
		}
		var el1 = arr1.splice(Math.floor(Math * arr1.length), 1);
		jQuery('#cgs_tabs').find('.cgs_selected').removeClass('cgs_selected');
		jQuery('#cgs_tabs .cgs-icons').css({'background':'','border-color':''});
		jQuery(el1).addClass('cgs_selected');
		jQuery('#cgs_tabs .cgs-icons.cgs_selected').css({'background':selectedslidebgcolor,'border-color':selectedslidebordercolor});
	}
	function random2(arr2) {
	if(!global_var){
			return false;
		}
		else{
			setTimeout(function () {
				random2(arr2);
			}, Math.floor(4000));
		}
		if(arr2.length == 0){
			arr2 = jQuery('.cgs-description').get();
		}
		var el2 = arr2.splice(Math.floor(Math * arr2.length), 1);
		jQuery('#cgs_tabs').find('.cgs_active').removeClass('cgs_active');
		jQuery('.cgs-description').css('background','');
		jQuery(el2).addClass('cgs_active');
		jQuery('.cgs-description.cgs_active').css('background',activeslidebgcolor);
	}
	random1(arr1);
	random2(arr2);

	var id_suf_l= jQuery( "#id_suf_l" ).val();
	if(jQuery( "#cgs_tabs" ).outerWidth() >=500 && id_suf_l <= 5 ){
		jQuery(".cgs-icon").hide();
		jQuery(".cgs-content p").css({"max-height": "55px","overflow": "hidden"});
		jQuery(".cgs-content ul").css({"max-height": "55px","overflow": "hidden","margin": "0"});
	}
	else if(jQuery( "#cgs_tabs" ).outerWidth() <500 && id_suf_l <= 5 ){
		jQuery(".cgs-icon").hide();
		jQuery(".cgs-content p").css({"max-height": "55px","overflow": "hidden"});
		jQuery(".cgs-content ul").css({"max-height": "55px","overflow": "hidden","margin": "0"});
	}
	else if(jQuery( "#cgs_tabs" ).outerWidth() >=500 && id_suf_l <= 10 ){
		jQuery(".cgs-content p").css({"max-height": "195px","overflow": "hidden"});
		jQuery(".cgs-content ul").css({"max-height": "195px","overflow": "hidden","margin": "0"});
	}
	else if(jQuery( "#cgs_tabs" ).outerWidth() <500 && id_suf_l <= 10 ){
		jQuery(".cgs-content p").css({"max-height": "195px","overflow": "hidden"});
		jQuery(".cgs-content ul").css({"max-height": "195px","overflow": "hidden","margin": "0"});
	}
	//if(id_suf_l <= 9)
		//jQuery(".cgs-icon").hide();
	
	//Code for Select Target Page Section
	var value1=jQuery('#content_slider_url_page').val();
	var value12=jQuery('#content_slider_url_post').val();
	if(value1 != "" || value12 != ""){
			jQuery('#content_slider_url_custom_wrap').hide();
		}
	var value111=jQuery('#content_slider_url_post').val();
	var value112=jQuery('#content_slider_url_custom').val();
	if(value111 != "" || value112 != ""){
		jQuery('#content_slider_url_custom').val("");
	}
	jQuery('#content_slider_url_page').change(function(){
		var value2=jQuery('#content_slider_url_page').val();
		var value3=jQuery('#content_slider_url_post').val();
		if(value2 != "" || value3 != ""){
			jQuery('#content_slider_url_custom_wrap').hide();
		}else{
			jQuery('#content_slider_url_custom_wrap').show();
		};
	});
	jQuery('#content_slider_url_post').change(function(){
		var value4=jQuery('#content_slider_url_page').val();
		var value5=jQuery('#content_slider_url_post').val();
		if(value4 != "" || value5 != ""){
			jQuery('#content_slider_url_custom_wrap').hide();
		}else{
			jQuery('#content_slider_url_custom_wrap').show();
		};
	});
	
	//Function for changing right-border-width for slides
	var wd_width = function(){
		if(jQuery(window).width()>480){
			for(wd=1;wd<=id_suf_l;wd++){
				if(wd%4==0)
					jQuery(".tab_" + wd).css({"border-right-width":"0"});
				else
					jQuery(".tab_" + wd).css({"border-right-width":"1px"});
			}
		}
		else{
			for(wd=1;wd<=id_suf_l;wd++){
				if(wd%2==0)
					jQuery(".tab_" + wd).css({"border-right-width":"0"});
				else
					jQuery(".tab_" + wd).css({"border-right-width":"1px"});
			}
		}
	}
	
	//Setting height of right container to left container
	var wd_height = function(){
		jQuery('#left_container').css('height',jQuery('#right_container').height());
	}
	
	//Responsive On Window Resize
	jQuery( window ).resize(function() {
		wd_height();
		wd_width();
	});
	
	//Calling function for Changing right-border-width for slides
	wd_width();
	//Calling Height function
	wd_height();
		
});