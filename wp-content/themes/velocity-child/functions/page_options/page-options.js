
//! Mega Menu

	jQuery(document).ready(function(){
		jQuery('.widgetareashowactivate .edit-menu-item-custom').live("click", function() {
			checka = jQuery(this);
			if ( checka.prop( "checked" ) ){
				checka.closest('.menu-item-settings').find('.field-widgetarea.widgetareashowp').fadeIn();
				checka.closest('.menu-item-settings').find('.field-custom.columnmegamenu,.field-custom.columntitlemegamenu').fadeOut();	
			} 
			else{
				checka.closest('.menu-item-settings').find('.field-widgetarea.widgetareashowp').fadeOut();	
				checka.closest('.menu-item-settings').find('.field-custom.columnmegamenu , .field-custom.columntitlemegamenu').fadeIn();	
			} 
	  	});
	  	
	  	jQuery('.columnmegamenu .edit-menu-item-custom , .widgetareashowactivate .edit-menu-item-custom').live("click", function() {
			checka = jQuery(this);
			if ( checka.prop( "checked" ) ) checka.closest('.menu-item-settings').find('.columnmegamenuwidth').fadeIn();
			else checka.closest('.menu-item-settings').find('.columnmegamenuwidth').fadeOut();
	  	});
	  	
		function handleMegaMenuSettings() {

			var levs = jQuery('#menu-to-edit').find('.menu-item-depth-0'); 
						levs.each(function(i) {
							var lev = jQuery(this),
								ind = lev.index();								
							var val = lev.find('.field-custom.megamenu input').attr("checked");
								
							if (i<levs.length)
								var nextind = jQuery(levs[i+1]).index();
							else 
								var nextind = 	jQuery('#menu-to-edit').find('li').length-1;																				
							
							for (var j = ind+1; j<=nextind;j++) {									
									var nextli =  jQuery('#menu-to-edit li:nth-child('+j+')');
									if (!nextli.hasClass("menu-item-depth-0")) {

										if (val!=undefined) {
											nextli.find('.columnmegamenu').show();
											nextli.find('.columntitlemegamenu').show();		
											nextli.find('.widgetareashowactivate').show();	
											nextli.find('.columnmegamenuwidth').show();	
										} else {
											nextli.find('.columnmegamenu').hide();
											nextli.find('.columntitlemegamenu').hide();		
											nextli.find('.widgetareashowactivate').hide();	
											nextli.find('.columnmegamenuwidth').hide();																		
										}
									}
								}							
						});
		}


		jQuery('#menu-to-edit').bind("sortstop",handleMegaMenuSettings);


		
		
		
		jQuery('.field-custom.megamenu input').each(function() {
			jQuery(this).on("change",handleMegaMenuSettings);
		})
		
		
					  		
	});


  
//! Page Options

	jQuery(function(jQuery) {
		
			jQuery('#media-items').bind('DOMNodeInserted',function(){
			jQuery('input[value="Insert into Post"]').each(function(){
					jQuery(this).attr('value','Use This Image');
			});
		});
			
		jQuery('.custom_clear_image_button').click(function() {
			var defaultImage = jQuery(this).closest("td").find('.custom_default_image').text();
			jQuery(this).closest("td").find('.custom_media_id').val('');
			jQuery(this).closest("td").find('.custom_media_image').attr('src', defaultImage).hide().css("margin-top","0");
			return false;
		});
		
		jQuery('.custom_media_upload').click(function() {
			var send_attachment_bkp = wp.media.editor.send.attachment;
			wp.media.editor.send.attachment = function(props, attachment) {
		        jQuery('.custom_media_image').attr('src', attachment.url).show().css("margin-top","10px");
		        jQuery('.custom_media_url').val(attachment.url);
		        jQuery('.custom_media_id').val(attachment.id);
		        wp.media.editor.send.attachment = send_attachment_bkp;
		    }
		    wp.media.editor.open();	
		    return false;       
	    });
	
		
		jQuery('.repeatable-add').click(function() {
			field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
			fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
			jQuery('input,textarea', field).each(function(){
				jQuery(this).val('').attr('name', function(index, name) {
					return name.replace(/(\d+)/, function(fullMatch, n) {
						return Number(n) + 1;
					});
				});
			});
			field.insertAfter(fieldLocation, jQuery(this).closest('td'))
			return false;
		});
		
		jQuery('.repeatable-remove').click(function(){
			jQuery(this).parent().parent().remove();
			return false;
		});
			
		jQuery('.custom_repeatable').sortable({
			opacity: 0.6,
			revert: true,
			cursor: 'move',
			handle: '.sort',
			stop: function(event, ui) { 
				jQuery('.custom_repeatable').each(function(){
					field_count=0;
					jQuery(this).find("li").each(function(){
						jQuery(this).find("input,textarea").each(function(){
							$this = jQuery(this);
							name_array=($this.attr("name")).split("[");
							$this.attr("name",name_array[0]+"["+field_count+"]");
						});
						field_count++;
					});
				});
			}
		});
	});


//! Icons
					
	jQuery(document).ready(function(){
	
		var elementArray = ["service_block","velocity_headline","latest_projects","latest_posts","spacer","progressbar","highlightbox","checklist","clients_list","team","team_member","pricetable_columns","testimonial","bs_button","lightbox","bs_alert","background_block"];
		
		
		//jQuery(".empty_container, .wpb_add_new_element").click(function(){
			jQuery(".wpb-content-layouts li").each(function(){
				$this = jQuery(this);
				if(jQuery.inArray($this.data("element") , elementArray )) $this.addClass("ourElement");
			});
		//});
	
		jQuery(".retina-icons li").live("click",function(){
				$this = jQuery(this);
				$this.closest(".edit_form_line").find("input").val($this.find("i").attr("class"));
				$this.closest(".edit_form_line").find(".retina-icons").hide();
		});
	
		jQuery(".wpb-textinput.icon").live("click",function(){
				$this = jQuery(this);
				if($this.closest(".edit_form_line").find(".retina-icons").length){
					$this.closest(".edit_form_line").find(".retina-icons").css("display")=="none" ? $this.closest(".edit_form_line").find(".retina-icons").show() : $this.closest(".edit_form_line").find(".retina-icons").hide() ;
				}
				else{
					$this.after('<div class="thundercodes-form"><style>.retina-icons li:hover { color:#ccc !important; cursor: pointer !important } .retina-icons li {width: 5%;display: block;margin-right: 3%;float: left;line-height: 20px;}.retina-icons li span{color:#aaa;};.retina-icons li span:before {content:"\a"} .retina-icons li i { font-size:20px}</style><ul class="retina-icons">\
					<li><i class="icon-plus"></i></li>\
					<li><i class="icon-plus-1"></i></li>\
					<li><i class="icon-minus"></i></li>\
					<li><i class="icon-minus-1"></i></li>\
					<li><i class="icon-info"></i></li>\
					<li><i class="icon-left-thin"></i></li>\
					<li><i class="icon-left-1"></i></li>\
					<li><i class="icon-up-thin"></i></li>\
					<li><i class="icon-up-1"></i></li>\
					<li><i class="icon-right-thin"></i></li>\
					<li><i class="icon-right-1"></i></li>\
					<li><i class="icon-down-thin"></i></li>\
					<li><i class="icon-down-1"></i></li>\
					<li><i class="icon-level-up"></i></li>\
					<li><i class="icon-level-down"></i></li>\
					<li><i class="icon-switch"></i></li>\
					<li><i class="icon-infinity"></i></li>\
					<li><i class="icon-plus-squared"></i></li>\
					<li><i class="icon-minus-squared"></i></li>\
					<li><i class="icon-home"></i></li>\
					<li><i class="icon-home-1"></i></li>\
					<li><i class="icon-keyboard"></i></li>\
					<li><i class="icon-erase"></i></li>\
					<li><i class="icon-pause"></i></li>\
					<li><i class="icon-pause-1"></i></li>\
					<li><i class="icon-fast-forward"></i></li>\
					<li><i class="icon-fast-fw"></i></li>\
					<li><i class="icon-fast-backward"></i></li>\
					<li><i class="icon-fast-bw"></i></li>\
					<li><i class="icon-to-end"></i></li>\
					<li><i class="icon-to-end-1"></i></li>\
					<li><i class="icon-to-start"></i></li>\
					<li><i class="icon-to-start-1"></i></li>\
					<li><i class="icon-hourglass"></i></li>\
					<li><i class="icon-stop"></i></li>\
					<li><i class="icon-stop-1"></i></li>\
					<li><i class="icon-up-dir"></i></li>\
					<li><i class="icon-up-dir-1"></i></li>\
					<li><i class="icon-play"></i></li>\
					<li><i class="icon-play-1"></i></li>\
					<li><i class="icon-right-dir"></i></li>\
					<li><i class="icon-right-dir-1"></i></li>\
					<li><i class="icon-down-dir"></i></li>\
					<li><i class="icon-down-dir-1"></i></li>\
					<li><i class="icon-left-dir"></i></li>\
					<li><i class="icon-left-dir-1"></i></li>\
					<li><i class="icon-adjust"></i></li>\
					<li><i class="icon-cloud"></i></li>\
					<li><i class="icon-cloud-1"></i></li>\
					<li><i class="icon-umbrella"></i></li>\
					<li><i class="icon-star"></i></li>\
					<li><i class="icon-star-1"></i></li>\
					<li><i class="icon-star-empty"></i></li>\
					<li><i class="icon-star-empty-1"></i></li>\
					<li><i class="icon-check-1"></i></li>\
					<li><i class="icon-cup"></i></li>\
					<li><i class="icon-left-hand"></i></li>\
					<li><i class="icon-up-hand"></i></li>\
					<li><i class="icon-right-hand"></i></li>\
					<li><i class="icon-down-hand"></i></li>\
					<li><i class="icon-menu"></i></li>\
					<li><i class="icon-th-list"></i></li>\
					<li><i class="icon-moon"></i></li>\
					<li><i class="icon-heart-empty"></i></li>\
					<li><i class="icon-heart-empty-1"></i></li>\
					<li><i class="icon-heart"></i></li>\
					<li><i class="icon-heart-1"></i></li>\
					<li><i class="icon-note"></i></li>\
					<li><i class="icon-note-beamed"></i></li>\
					<li><i class="icon-music-1"></i></li>\
					<li><i class="icon-layout"></i></li>\
					<li><i class="icon-th"></i></li>\
					<li><i class="icon-flag"></i></li>\
					<li><i class="icon-flag-1"></i></li>\
					<li><i class="icon-tools"></i></li>\
					<li><i class="icon-cog"></i></li>\
					<li><i class="icon-cog-1"></i></li>\
					<li><i class="icon-attention"></i></li>\
					<li><i class="icon-attention-1"></i></li>\
					<li><i class="icon-flash"></i></li>\
					<li><i class="icon-flash-1"></i></li>\
					<li><i class="icon-record"></i></li>\
					<li><i class="icon-cloud-thunder"></i></li>\
					<li><i class="icon-cog-alt"></i></li>\
					<li><i class="icon-scissors"></i></li>\
					<li><i class="icon-tape"></i></li>\
					<li><i class="icon-flight"></i></li>\
					<li><i class="icon-flight-1"></i></li>\
					<li><i class="icon-mail"></i></li>\
					<li><i class="icon-mail-1"></i></li>\
					<li><i class="icon-edit"></i></li>\
					<li><i class="icon-pencil"></i></li>\
					<li><i class="icon-pencil-1"></i></li>\
					<li><i class="icon-feather"></i></li>\
					<li><i class="icon-check"></i></li>\
					<li><i class="icon-ok"></i></li>\
					<li><i class="icon-ok-circle"></i></li>\
					<li><i class="icon-cancel"></i></li>\
					<li><i class="icon-cancel-1"></i></li>\
					<li><i class="icon-cancel-circled"></i></li>\
					<li><i class="icon-cancel-circle"></i></li>\
					<li><i class="icon-asterisk"></i></li>\
					<li><i class="icon-cancel-squared"></i></li>\
					<li><i class="icon-help"></i></li>\
					<li><i class="icon-attention-circle"></i></li>\
					<li><i class="icon-quote"></i></li>\
					<li><i class="icon-plus-circled"></i></li>\
					<li><i class="icon-plus-circle"></i></li>\
					<li><i class="icon-minus-circled"></i></li>\
					<li><i class="icon-minus-circle"></i></li>\
					<li><i class="icon-right"></i></li>\
					<li><i class="icon-direction"></i></li>\
					<li><i class="icon-forward"></i></li>\
					<li><i class="icon-forward-1"></i></li>\
					<li><i class="icon-ccw"></i></li>\
					<li><i class="icon-cw"></i></li>\
					<li><i class="icon-cw-1"></i></li>\
					<li><i class="icon-left"></i></li>\
					<li><i class="icon-up"></i></li>\
					<li><i class="icon-down"></i></li>\
					<li><i class="icon-resize-vertical"></i></li>\
					<li><i class="icon-resize-horizontal"></i></li>\
					<li><i class="icon-eject"></i></li>\
					<li><i class="icon-list-add"></i></li>\
					<li><i class="icon-list"></i></li>\
					<li><i class="icon-left-bold"></i></li>\
					<li><i class="icon-right-bold"></i></li>\
					<li><i class="icon-up-bold"></i></li>\
					<li><i class="icon-down-bold"></i></li>\
					<li><i class="icon-user-add"></i></li>\
					<li><i class="icon-star-half"></i></li>\
					<li><i class="icon-ok-circle2"></i></li>\
					<li><i class="icon-cancel-circle2"></i></li>\
					<li><i class="icon-help-circled"></i></li>\
					<li><i class="icon-help-circle"></i></li>\
					<li><i class="icon-info-circled"></i></li>\
					<li><i class="icon-info-circle"></i></li>\
					<li><i class="icon-th-large"></i></li>\
					<li><i class="icon-eye"></i></li>\
					<li><i class="icon-eye-1"></i></li>\
					<li><i class="icon-eye-off"></i></li>\
					<li><i class="icon-tag"></i></li>\
					<li><i class="icon-tag-1"></i></li>\
					<li><i class="icon-tags"></i></li>\
					<li><i class="icon-camera-alt"></i></li>\
					<li><i class="icon-upload-cloud"></i></li>\
					<li><i class="icon-reply"></i></li>\
					<li><i class="icon-reply-all"></i></li>\
					<li><i class="icon-code"></i></li>\
					<li><i class="icon-export"></i></li>\
					<li><i class="icon-export-1"></i></li>\
					<li><i class="icon-print"></i></li>\
					<li><i class="icon-print-1"></i></li>\
					<li><i class="icon-retweet"></i></li>\
					<li><i class="icon-retweet-1"></i></li>\
					<li><i class="icon-comment"></i></li>\
					<li><i class="icon-comment-1"></i></li>\
					<li><i class="icon-chat"></i></li>\
					<li><i class="icon-chat-1"></i></li>\
					<li><i class="icon-vcard"></i></li>\
					<li><i class="icon-address"></i></li>\
					<li><i class="icon-location"></i></li>\
					<li><i class="icon-location-1"></i></li>\
					<li><i class="icon-map"></i></li>\
					<li><i class="icon-compass"></i></li>\
					<li><i class="icon-trash"></i></li>\
					<li><i class="icon-trash-1"></i></li>\
					<li><i class="icon-doc"></i></li>\
					<li><i class="icon-doc-text-inv"></i></li>\
					<li><i class="icon-docs"></i></li>\
					<li><i class="icon-doc-landscape"></i></li>\
					<li><i class="icon-archive"></i></li>\
					<li><i class="icon-rss"></i></li>\
					<li><i class="icon-share"></i></li>\
					<li><i class="icon-basket"></i></li>\
					<li><i class="icon-basket-1"></i></li>\
					<li><i class="icon-shareable"></i></li>\
					<li><i class="icon-login"></i></li>\
					<li><i class="icon-login-1"></i></li>\
					<li><i class="icon-logout"></i></li>\
					<li><i class="icon-logout-1"></i></li>\
					<li><i class="icon-volume"></i></li>\
					<li><i class="icon-resize-full"></i></li>\
					<li><i class="icon-resize-full-1"></i></li>\
					<li><i class="icon-resize-small"></i></li>\
					<li><i class="icon-resize-small-1"></i></li>\
					<li><i class="icon-popup"></i></li>\
					<li><i class="icon-publish"></i></li>\
					<li><i class="icon-window"></i></li>\
					<li><i class="icon-arrow-combo"></i></li>\
					<li><i class="icon-zoom-in"></i></li>\
					<li><i class="icon-chart-pie"></i></li>\
					<li><i class="icon-zoom-out"></i></li>\
					<li><i class="icon-language"></i></li>\
					<li><i class="icon-air"></i></li>\
					<li><i class="icon-database"></i></li>\
					<li><i class="icon-drive"></i></li>\
					<li><i class="icon-bucket"></i></li>\
					<li><i class="icon-thermometer"></i></li>\
					<li><i class="icon-down-circled"></i></li>\
					<li><i class="icon-down-circle2"></i></li>\
					<li><i class="icon-left-circled"></i></li>\
					<li><i class="icon-right-circled"></i></li>\
					<li><i class="icon-up-circled"></i></li>\
					<li><i class="icon-up-circle2"></i></li>\
					<li><i class="icon-down-open"></i></li>\
					<li><i class="icon-down-open-1"></i></li>\
					<li><i class="icon-left-open"></i></li>\
					<li><i class="icon-left-open-1"></i></li>\
					<li><i class="icon-right-open"></i></li>\
					<li><i class="icon-right-open-1"></i></li>\
					<li><i class="icon-up-open"></i></li>\
					<li><i class="icon-up-open-1"></i></li>\
					<li><i class="icon-down-open-mini"></i></li>\
					<li><i class="icon-arrows-cw"></i></li>\
					<li><i class="icon-left-open-mini"></i></li>\
					<li><i class="icon-play-circle2"></i></li>\
					<li><i class="icon-right-open-mini"></i></li>\
					<li><i class="icon-to-end-alt"></i></li>\
					<li><i class="icon-up-open-mini"></i></li>\
					<li><i class="icon-to-start-alt"></i></li>\
					<li><i class="icon-down-open-big"></i></li>\
					<li><i class="icon-left-open-big"></i></li>\
					<li><i class="icon-right-open-big"></i></li>\
					<li><i class="icon-up-open-big"></i></li>\
					<li><i class="icon-progress-0"></i></li>\
					<li><i class="icon-progress-1"></i></li>\
					<li><i class="icon-progress-2"></i></li>\
					<li><i class="icon-progress-3"></i></li>\
					<li><i class="icon-back-in-time"></i></li>\
					<li><i class="icon-network"></i></li>\
					<li><i class="icon-inbox"></i></li>\
					<li><i class="icon-inbox-1"></i></li>\
					<li><i class="icon-install"></i></li>\
					<li><i class="icon-font"></i></li>\
					<li><i class="icon-bold"></i></li>\
					<li><i class="icon-italic"></i></li>\
					<li><i class="icon-text-height"></i></li>\
					<li><i class="icon-text-width"></i></li>\
					<li><i class="icon-align-left"></i></li>\
					<li><i class="icon-align-center"></i></li>\
					<li><i class="icon-align-right"></i></li>\
					<li><i class="icon-align-justify"></i></li>\
					<li><i class="icon-list-1"></i></li>\
					<li><i class="icon-indent-left"></i></li>\
					<li><i class="icon-indent-right"></i></li>\
					<li><i class="icon-lifebuoy"></i></li>\
					<li><i class="icon-mouse"></i></li>\
					<li><i class="icon-dot"></i></li>\
					<li><i class="icon-dot-2"></i></li>\
					<li><i class="icon-dot-3"></i></li>\
					<li><i class="icon-suitcase"></i></li>\
					<li><i class="icon-off"></i></li>\
					<li><i class="icon-road"></i></li>\
					<li><i class="icon-flow-cascade"></i></li>\
					<li><i class="icon-list-alt"></i></li>\
					<li><i class="icon-flow-branch"></i></li>\
					<li><i class="icon-qrcode"></i></li>\
					<li><i class="icon-flow-tree"></i></li>\
					<li><i class="icon-barcode"></i></li>\
					<li><i class="icon-flow-line"></i></li>\
					<li><i class="icon-ajust"></i></li>\
					<li><i class="icon-flow-parallel"></i></li>\
					<li><i class="icon-tint"></i></li>\
					<li><i class="icon-brush"></i></li>\
					<li><i class="icon-paper-plane"></i></li>\
					<li><i class="icon-magnet"></i></li>\
					<li><i class="icon-magnet-1"></i></li>\
					<li><i class="icon-gauge"></i></li>\
					<li><i class="icon-traffic-cone"></i></li>\
					<li><i class="icon-cc"></i></li>\
					<li><i class="icon-cc-by"></i></li>\
					<li><i class="icon-cc-nc"></i></li>\
					<li><i class="icon-cc-nc-eu"></i></li>\
					<li><i class="icon-cc-nc-jp"></i></li>\
					<li><i class="icon-cc-sa"></i></li>\
					<li><i class="icon-cc-nd"></i></li>\
					<li><i class="icon-cc-pd"></i></li>\
					<li><i class="icon-cc-zero"></i></li>\
					<li><i class="icon-cc-share"></i></li>\
					<li><i class="icon-cc-remix"></i></li>\
					<li><i class="icon-move"></i></li>\
					<li><i class="icon-link-ext"></i></li>\
					<li><i class="icon-check-empty"></i></li>\
					<li><i class="icon-bookmark-empty"></i></li>\
					<li><i class="icon-phone-squared"></i></li>\
					<li><i class="icon-twitter"></i></li>\
					<li><i class="icon-facebook"></i></li>\
					<li><i class="icon-github"></i></li>\
					<li><i class="icon-rss-1"></i></li>\
					<li><i class="icon-hdd"></i></li>\
					<li><i class="icon-certificate"></i></li>\
					<li><i class="icon-left-circled-1"></i></li>\
					<li><i class="icon-right-circled-1"></i></li>\
					<li><i class="icon-up-circled-1"></i></li>\
					<li><i class="icon-down-circled-1"></i></li>\
					<li><i class="icon-tasks"></i></li>\
					<li><i class="icon-filter"></i></li>\
					<li><i class="icon-resize-full-alt"></i></li>\
					<li><i class="icon-beaker"></i></li>\
					<li><i class="icon-docs-1"></i></li>\
					<li><i class="icon-blank"></i></li>\
					<li><i class="icon-menu-1"></i></li>\
					<li><i class="icon-list-bullet"></i></li>\
					<li><i class="icon-list-numbered"></i></li>\
					<li><i class="icon-strike"></i></li>\
					<li><i class="icon-underline"></i></li>\
					<li><i class="icon-table"></i></li>\
					<li><i class="icon-magic"></i></li>\
					<li><i class="icon-pinterest-circled-1"></i></li>\
					<li><i class="icon-pinterest-squared"></i></li>\
					<li><i class="icon-gplus-squared"></i></li>\
					<li><i class="icon-gplus"></i></li>\
					<li><i class="icon-money"></i></li>\
					<li><i class="icon-columns"></i></li>\
					<li><i class="icon-sort"></i></li>\
					<li><i class="icon-sort-down"></i></li>\
					<li><i class="icon-sort-up"></i></li>\
					<li><i class="icon-mail-alt"></i></li>\
					<li><i class="icon-linkedin"></i></li>\
					<li><i class="icon-gauge-1"></i></li>\
					<li><i class="icon-comment-empty"></i></li>\
					<li><i class="icon-chat-empty"></i></li>\
					<li><i class="icon-sitemap"></i></li>\
					<li><i class="icon-paste"></i></li>\
					<li><i class="icon-user-md"></i></li>\
					<li><i class="icon-s-github"></i></li>\
					<li><i class="icon-github-squared"></i></li>\
					<li><i class="icon-github-circled"></i></li>\
					<li><i class="icon-s-flickr"></i></li>\
					<li><i class="icon-twitter-squared"></i></li>\
					<li><i class="icon-s-vimeo"></i></li>\
					<li><i class="icon-vimeo-circled"></i></li>\
					<li><i class="icon-facebook-squared-1"></i></li>\
					<li><i class="icon-s-twitter"></i></li>\
					<li><i class="icon-twitter-circled"></i></li>\
					<li><i class="icon-s-facebook"></i></li>\
					<li><i class="icon-linkedin-squared"></i></li>\
					<li><i class="icon-facebook-circled"></i></li>\
					<li><i class="icon-s-gplus"></i></li>\
					<li><i class="icon-gplus-circled"></i></li>\
					<li><i class="icon-s-pinterest"></i></li>\
					<li><i class="icon-pinterest-circled"></i></li>\
					<li><i class="icon-s-tumblr"></i></li>\
					<li><i class="icon-tumblr-circled"></i></li>\
					<li><i class="icon-s-linkedin"></i></li>\
					<li><i class="icon-linkedin-circled"></i></li>\
					<li><i class="icon-s-dribbble"></i></li>\
					<li><i class="icon-dribbble-circled"></i></li>\
					<li><i class="icon-s-stumbleupon"></i></li>\
					<li><i class="icon-stumbleupon-circled"></i></li>\
					<li><i class="icon-s-lastfm"></i></li>\
					<li><i class="icon-lastfm-circled"></i></li>\
					<li><i class="icon-rdio"></i></li>\
					<li><i class="icon-rdio-circled"></i></li>\
					<li><i class="icon-spotify"></i></li>\
					<li><i class="icon-s-spotify-circled"></i></li>\
					<li><i class="icon-qq"></i></li>\
					<li><i class="icon-s-instagrem"></i></li>\
					<li><i class="icon-dropbox"></i></li>\
					<li><i class="icon-s-evernote"></i></li>\
					<li><i class="icon-flattr"></i></li>\
					<li><i class="icon-s-skype"></i></li>\
					<li><i class="icon-skype-circled"></i></li>\
					<li><i class="icon-renren"></i></li>\
					<li><i class="icon-sina-weibo"></i></li>\
					<li><i class="icon-s-paypal"></i></li>\
					<li><i class="icon-s-picasa"></i></li>\
					<li><i class="icon-s-soundcloud"></i></li>\
					<li><i class="icon-s-behance"></i></li>\
					<li><i class="icon-google-circles"></i></li>\
					<li><i class="icon-vkontakte"></i></li>\
					<li><i class="icon-smashing"></i></li>\
					<li><i class="icon-db-shape"></i></li>\
					<li><i class="icon-sweden"></i></li>\
					<li><i class="icon-logo-db"></i></li>\
					<li><i class="icon-picture"></i></li>\
					<li><i class="icon-picture-1"></i></li>\
					<li><i class="icon-globe"></i></li>\
					<li><i class="icon-globe-1"></i></li>\
					<li><i class="icon-leaf-1"></i></li>\
					<li><i class="icon-lemon"></i></li>\
					<li><i class="icon-glass"></i></li>\
					<li><i class="icon-gift"></i></li>\
					<li><i class="icon-graduation-cap"></i></li>\
					<li><i class="icon-mic"></i></li>\
					<li><i class="icon-videocam"></i></li>\
					<li><i class="icon-headphones"></i></li>\
					<li><i class="icon-palette"></i></li>\
					<li><i class="icon-ticket"></i></li>\
					<li><i class="icon-video"></i></li>\
					<li><i class="icon-video-1"></i></li>\
					<li><i class="icon-target"></i></li>\
					<li><i class="icon-target-1"></i></li>\
					<li><i class="icon-music"></i></li>\
					<li><i class="icon-trophy"></i></li>\
					<li><i class="icon-award"></i></li>\
					<li><i class="icon-thumbs-up"></i></li>\
					<li><i class="icon-thumbs-up-1"></i></li>\
					<li><i class="icon-thumbs-down"></i></li>\
					<li><i class="icon-thumbs-down-1"></i></li>\
					<li><i class="icon-bag"></i></li>\
					<li><i class="icon-user"></i></li>\
					<li><i class="icon-user-1"></i></li>\
					<li><i class="icon-users"></i></li>\
					<li><i class="icon-users-1"></i></li>\
					<li><i class="icon-lamp"></i></li>\
					<li><i class="icon-alert"></i></li>\
					<li><i class="icon-water"></i></li>\
					<li><i class="icon-droplet"></i></li>\
					<li><i class="icon-credit-card"></i></li>\
					<li><i class="icon-credit-card-1"></i></li>\
					<li><i class="icon-monitor"></i></li>\
					<li><i class="icon-briefcase"></i></li>\
					<li><i class="icon-briefcase-1"></i></li>\
					<li><i class="icon-floppy"></i></li>\
					<li><i class="icon-floppy-1"></i></li>\
					<li><i class="icon-cd"></i></li>\
					<li><i class="icon-folder"></i></li>\
					<li><i class="icon-folder-1"></i></li>\
					<li><i class="icon-folder-open"></i></li>\
					<li><i class="icon-doc-text"></i></li>\
					<li><i class="icon-doc-1"></i></li>\
					<li><i class="icon-calendar"></i></li>\
					<li><i class="icon-calendar-1"></i></li>\
					<li><i class="icon-chart-line"></i></li>\
					<li><i class="icon-chart-bar"></i></li>\
					<li><i class="icon-chart-bar-1"></i></li>\
					<li><i class="icon-clipboard"></i></li>\
					<li><i class="icon-pin"></i></li>\
					<li><i class="icon-attach"></i></li>\
					<li><i class="icon-attach-1"></i></li>\
					<li><i class="icon-bookmarks"></i></li>\
					<li><i class="icon-book"></i></li>\
					<li><i class="icon-book-1"></i></li>\
					<li><i class="icon-book-open"></i></li>\
					<li><i class="icon-phone"></i></li>\
					<li><i class="icon-phone-1"></i></li>\
					<li><i class="icon-megaphone"></i></li>\
					<li><i class="icon-megaphone-1"></i></li>\
					<li><i class="icon-upload"></i></li>\
					<li><i class="icon-upload-1"></i></li>\
					<li><i class="icon-download"></i></li>\
					<li><i class="icon-download-1"></i></li>\
					<li><i class="icon-box"></i></li>\
					<li><i class="icon-newspaper"></i></li>\
					<li><i class="icon-mobile"></i></li>\
					<li><i class="icon-signal"></i></li>\
					<li><i class="icon-signal-1"></i></li>\
					<li><i class="icon-camera"></i></li>\
					<li><i class="icon-camera-1"></i></li>\
					<li><i class="icon-shuffle"></i></li>\
					<li><i class="icon-shuffle-1"></i></li>\
					<li><i class="icon-loop"></i></li>\
					<li><i class="icon-arrows-ccw"></i></li>\
					<li><i class="icon-light-down"></i></li>\
					<li><i class="icon-light-up"></i></li>\
					<li><i class="icon-mute"></i></li>\
					<li><i class="icon-volume-off"></i></li>\
					<li><i class="icon-volume-down"></i></li>\
					<li><i class="icon-sound"></i></li>\
					<li><i class="icon-volume-up"></i></li>\
					<li><i class="icon-battery"></i></li>\
					<li><i class="icon-search"></i></li>\
					<li><i class="icon-search-1"></i></li>\
					<li><i class="icon-key"></i></li>\
					<li><i class="icon-key-1"></i></li>\
					<li><i class="icon-lock"></i></li>\
					<li><i class="icon-lock-1"></i></li>\
					<li><i class="icon-lock-open"></i></li>\
					<li><i class="icon-lock-open-1"></i></li>\
					<li><i class="icon-bell"></i></li>\
					<li><i class="icon-bell-1"></i></li>\
					<li><i class="icon-bookmark"></i></li>\
					<li><i class="icon-bookmark-1"></i></li>\
					<li><i class="icon-link"></i></li>\
					<li><i class="icon-link-1"></i></li>\
					<li><i class="icon-back"></i></li>\
					<li><i class="icon-fire"></i></li>\
					<li><i class="icon-flashlight"></i></li>\
					<li><i class="icon-wrench"></i></li>\
					<li><i class="icon-hammer"></i></li>\
					<li><i class="icon-chart-area"></i></li>\
					<li><i class="icon-clock"></i></li>\
					<li><i class="icon-clock-1"></i></li>\
					<li><i class="icon-rocket"></i></li>\
					<li><i class="icon-truck"></i></li>\
					<li><i class="icon-block"></i></li>\
					<li><i class="icon-block-1"></i></li>\
					<li><i class="icon-s-rss"></i></li>\
					<li><i class="icon-s-twitter"></i></li>\
					<li><i class="icon-s-facebook"></i></li>\
					<li><i class="icon-s-dribbble"></i></li>\
					<li><i class="icon-s-pinterest"></i></li>\
					<li><i class="icon-s-flickr"></i></li>\
					<li><i class="icon-s-vimeo"></i></li>\
					<li><i class="icon-s-youtube"></i></li>\
					<li><i class="icon-s-skype"></i></li>\
					<li><i class="icon-s-tumblr"></i></li>\
					<li><i class="icon-s-linkedin"></i></li>\
					<li><i class="icon-s-behance"></i></li>\
					<li><i class="icon-s-github"></i></li>\
					<li><i class="icon-s-gplus"></i></li>\
					<li><i class="icon-s-stumbleupon"></i></li>\
					<li><i class="icon-s-lastfm"></i></li>\
					<li><i class="icon-s-evernote"></i></li>\
					<li><i class="icon-s-paypal"></i></li>\
					<li><i class="icon-s-picasa"></i></li>\
					<li><i class="icon-s-soundcloud"></i></li>\
					</ul></div>');
		}
		return false;
		});
	});