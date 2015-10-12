<?php
global $wpdb;
$cgs_slides_info = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type='content-slider' AND post_status='publish' order by menu_order");
if(empty($cgs_slides_info)){
	die("No Slide found");
}
?>
<div id="cgs_container">
	<h2>Re-Order Your Slides</h2>
	<div id="cgs_settings_left">
		<div class="left_rows" id="reorder_settings">
			<div id="ajax-response"></div>
			<noscript>
				<div class="error message">
					<p>This plugin can\'t work without javascript, because it\'s use drag and drop and AJAX.</p>
				</div>
			</noscript>
			<div id="order-post-type">
				<ul id="sortable">
					<?php
						foreach($cgs_slides_info as $cgs_slides){ ?>
							<?php if(!empty($cgs_slides->post_content)): ?>
							<li id="item_<?php echo $cgs_slides->ID ?>"><?php echo $cgs_slides->post_title; ?></li>
							<?php endif; ?>
						<?php }
					?>
				</ul>
				<div class="clear"></div>
			</div>
			<p class="submit">
				<a href="#" id="save-order" class="button-primary"><?php _e('Update Order' ) ?></a>
			</p>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#sortable").sortable({
						'tolerance':'intersect',
						'cursor':'pointer',
						'items':'li',
						'placeholder':'placeholder',
						'nested': 'ul'
					});
					jQuery("#sortable").disableSelection();
					jQuery("#save-order").bind( "click", function() {
						jQuery.post( ajaxurl, { action:'update-cgs-slide-order', order:jQuery("#sortable").sortable("serialize") }, function() {
							jQuery("#ajax-response").html('<div class="message updated fade"><p><?php _e('Order Updated') ?></p></div>');
							jQuery("#ajax-response div").delay(3000).hide("slow");
						});
					});
				});
			</script>
		</div>
	</div>
	<div id="cgs_settings_right">
		<?php include('content-slider-settings-right.html'); ?>
	</div>
</div>