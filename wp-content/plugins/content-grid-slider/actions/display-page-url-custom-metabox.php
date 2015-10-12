<?php
	$meta_values = get_post_meta( $post->ID, 'content_slider_url', true );
	$meta_values_target = get_post_meta( $post->ID, 'content_slider_url_target', true );
	?>
	
	<!-- Code to display Metaboxes -->
		<div id="services_custom_metaboxes">
		
		<!-- Select Any Page URL -->
		<h4><strong>Select Existing Page</strong></h4>
		<select name="content_slider_url_page" id="content_slider_url_page">
		<?php
			$args = array('sort_order' => 'ASC','sort_column' => 'post_title', 'numberposts' => -1);
			$pages = get_pages($args);
			echo '<option value="">Select Target Page</option>';
			foreach( $pages as $page ){ ?>
				<option value="<?php echo get_page_link( $page->ID ) ; ?>" <?php if($meta_values == get_page_link( $page->ID ) ){ echo 'selected';} ?>><?php echo $page->post_title; ?></option>
		<?php } ?>
		</select>
		<!-- Select Any Page URL ends-->

		<!-- Select Any POST URL -->
		<h4><strong>Select Existing Post</strong></h4>
		<select name="content_slider_url_post" id="content_slider_url_post">
		<?php
			$args = array('sort_order' => 'ASC','sort_column' => 'post_title', 'numberposts' => -1);
			$posts = get_posts($args);
			echo '<option value="">Select Target Post</option>';
			foreach( $posts as $post ) { ?>
				<option value="<?php echo get_page_link( $post->ID ) ; ?>" <?php if($meta_values == get_page_link( $post->ID ) ){ echo 'selected';} ?>><?php echo $post->post_title; ?></option>
		<?php } ?>
		</select>
		<!-- Select Any POST URL ends-->
		
		<!-- Code to display cumstom link -->
		<div id="content_slider_url_custom_wrap">
			<h4><strong>Add Custom Link</strong></h4>
			<?php
			if(!empty($meta_values)){
				echo '<input type="url" id="content_slider_url_custom" name="content_slider_url_custom" placeholder="Custom Page URL" value='.$meta_values.' />';
				}
				else{
				echo '<input type="url" id="content_slider_url_custom" name="content_slider_url_custom" placeholder="Custom Page URL" />';
			}?>
		</div>
		<!-- Code to display cumstom link ends-->
		
		<!-- Target Atrribute code-->
			<h4><strong>Select Target Attribute</strong></h4>
			<input type="radio" id="content_slider_url_target1" name="content_slider_url_target" value="_self" <?php if($meta_values_target == "_self" ){ echo 'checked';} ?> >Same Tab
			<input type="radio" id="content_slider_url_target2" name="content_slider_url_target" value="_blank" <?php if($meta_values_target == "_blank" ){ echo 'checked';} ?> >New Tab
		<!-- Target Atrribute code ends-->
		
	</div>
	<!-- Code to display Metaboxes ends-->
	
	