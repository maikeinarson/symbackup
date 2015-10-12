<?php
function cgs_color_settings() {
?>
    <div id="cgs_container">
		<h2>Content Grid Slider Custom Color Settings</h2>
		<div id="cgs_settings_left">
			<div class="left_rows " id="color_settings">
				<?php settings_errors(); ?>
				<form method="post" action="options.php">
					<!-- Page contents for Slider color Settings-->
					<?php wp_nonce_field( 'content-slider-update-font-options' ); ?> <!-- creating nonce field -->
					<?php settings_fields( 'content-slider-custom-color-settings' ); ?> <!-- creating Settings fields -->
					<?php do_settings_sections( 'content-slider-settings' ); ?> <!-- Prints out settings fields on desired page-->
					<input name="color-options-submit" type="submit" class="button-primary" value="Save Changes" />
				</form>
			</div>
			<div class="left_rows" id="slider_preview">
				<h2>Live Color Preview of your Slider</h2>
				<p><strong>Note:</strong> For proper live preview, please stop slider rotation</p>
				<div id="cgs_preview">
					<?php
						echo '<div id=cgs-slideshow>';
						echo do_shortcode("[content-slider]");
						echo '</div>';
					?>
				</div>
			</div>
		</div>
		<div id="cgs_settings_right">
			<?php include('content-slider-settings-right.html'); ?>
		</div>
    </div>
    <?php
} 

function cgs_custom_color_settings() {
	//Register Different Fields for custom properties
	register_setting( 'content-slider-custom-color-settings', 'content-slider-main-heading-color' );
	register_setting( 'content-slider-custom-color-settings', 'content-slider-normal-font-color' );
	register_setting( 'content-slider-custom-color-settings', 'content-slider-active-slide-title-color' );
	register_setting( 'content-slider-custom-color-settings', 'content-slider-selected-slide-bgcolor' );
	register_setting( 'content-slider-custom-color-settings', 'content-slider-selected-slide-bordercolor' );
	register_setting( 'content-slider-custom-color-settings', 'content-slider-active-slide-bgcolor' );
	
	//Adding a section block for Active slide fields
    add_settings_section( 'content-slider-active-font-color-section', '', 'cgs_custom_active_colors', 'content-slider-settings' );
	
	//Adding a section block for Selected slide fields
    add_settings_section( 'content-slider-selected-font-color-section', '', 'cgs_custom_selected_colors', 'content-slider-settings' );
	
	//Setting field for Main Heading color
    add_settings_field( 'content-slider-main-heading-color', 'Slider Heading Font Color', 'cgs_main_heading_color_settings', 'content-slider-settings', 'content-slider-selected-font-color-section' );
	
	//Setting field for Selected Slide background color
    add_settings_field( 'content-slider-selected-slide-bgcolor', 'Selected Slide Background Color', 'cgs_selected_slide_bgcolor_settings', 'content-slider-settings', 'content-slider-selected-font-color-section' );
	
	//Setting field for Selected Slide border color
    add_settings_field( 'content-slider-selected-slide-bordercolor', 'Selected Slide Border Color', 'cgs_selected_slide_bordercolor_settings', 'content-slider-settings', 'content-slider-selected-font-color-section' );
	
	//Setting field for Active Slide Title font color
    add_settings_field( 'content-slider-active-slide-title-color', 'Active Slide Title & Read more Color', 'cgs_active_slide_title_color_settings', 'content-slider-settings', 'content-slider-active-font-color-section' );
	
	//Setting field for normal font color
    add_settings_field( 'content-slider-normal-font-color', 'Content & Title Font Color', 'cgs_normal_font_color_settings', 'content-slider-settings', 'content-slider-active-font-color-section' );
	
	//Setting field for Active Slide background color
    add_settings_field( 'content-slider-active-slide-bgcolor', 'Active Slide Background Color', 'cgs_active_slide_bgcolor_settings', 'content-slider-settings', 'content-slider-active-font-color-section' );
}

//General Description of our color setting's active slide section
function cgs_custom_active_colors() {
    _e( '<h3>Description Area Color Settings</h3>' );
}

//General Description of our color setting's selected slide section
function cgs_custom_selected_colors() {
    _e( '<h3>Slide area Color Settings</h3>' );
}

//Display our Main Heading color settings field
function cgs_main_heading_color_settings() {
    $headingfontcolor = get_option( 'content-slider-main-heading-color' );
	?>
	<input type="text" name="content-slider-main-heading-color" id="content-slider-main-heading-color" value="<?php if($headingfontcolor ) { echo esc_attr( $headingfontcolor ); } else { echo '#222222'; } ?>" style="background:<?php echo esc_attr( $headingfontcolor );?>" onblur="colorPreview('content-slider-main-heading-color','slider-heading');" />
	<input type='button' class='pickcolor button-secondary' value='Select Color' onblur="colorPreview('content-slider-main-heading-color','slider-heading');" />
	<div id='colorpicker' style='z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;'></div>
	<?php
}

//Display Selected slide background color
function cgs_selected_slide_bgcolor_settings(){
    $selectedslidebgcolor = get_option( 'content-slider-selected-slide-bgcolor' );
	?>
	<input type="text" name="content-slider-selected-slide-bgcolor" id="content-slider-selected-slide-bgcolor" value="<?php if($selectedslidebgcolor ) { echo esc_attr( $selectedslidebgcolor ); } else { echo '#dddddd'; } ?>" style="background:<?php echo esc_attr( $selectedslidebgcolor );?>" onblur="selectedBgColorPreview('content-slider-selected-slide-bgcolor','cgs_selected');" />
	<input type='button' class='pickcolor button-secondary' value='Select Color' onblur="selectedBgColorPreview('content-slider-selected-slide-bgcolor','cgs_selected');" />
	<div id='colorpicker' style='z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;'></div>
    <?php
}

//Display Selected slide Border color
function cgs_selected_slide_bordercolor_settings() {
    $selectedslidebordercolor = get_option( 'content-slider-selected-slide-bordercolor' );
	?>
	 <input type="text" name="content-slider-selected-slide-bordercolor" id="content-slider-selected-slide-bordercolor" value="<?php if($selectedslidebordercolor ) { echo esc_attr( $selectedslidebordercolor ); } else { echo '#000000'; } ?>" style="background:<?php echo esc_attr( $selectedslidebordercolor );?>" onblur="selectedBorderColorPreview('content-slider-selected-slide-bordercolor','cgs_selected');" />
	<input type='button' class='pickcolor button-secondary' value='Select Color' onblur="selectedBorderColorPreview('content-slider-selected-slide-bordercolor','cgs_selected');" />
	<div id='colorpicker' style='z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;'></div>
    <?php
}

//Display our normal font color settings field
function cgs_normal_font_color_settings() {
    $fontcolor = get_option( 'content-slider-normal-font-color' );
	?>
	<input type="text" name="content-slider-normal-font-color" id="content-slider-normal-font-color" value="<?php if($fontcolor ) { echo esc_attr( $fontcolor ); } else { echo '#333333'; } ?>" style="background:<?php echo esc_attr( $fontcolor );?>" onblur="colorPreview('content-slider-normal-font-color','content_color');" />
	<input type='button' class='pickcolor button-secondary' value='Select Color' onblur="colorPreview('content-slider-normal-font-color','content_color');" />
	<div id='colorpicker' style='z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;'></div>
    <?php
}

//Display Active slide title and read more font color settings field
function cgs_active_slide_title_color_settings() {
    $activeslidetitlecolor = get_option( 'content-slider-active-slide-title-color' );
	?>
	<input type="text" name="content-slider-active-slide-title-color" id="content-slider-active-slide-title-color" value="<?php if($activeslidetitlecolor ) { echo esc_attr( $activeslidetitlecolor ); } else { echo '#111111'; } ?>" style="background:<?php echo esc_attr( $activeslidetitlecolor );?>" onblur="colorPreview('content-slider-active-slide-title-color','read_title_color');" />
	<input type='button' class='pickcolor button-secondary' value='Select Color' onblur="colorPreview('content-slider-active-slide-title-color','read_title_color');" />
	<div id='colorpicker' style='z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;'></div>
    <?php
}

//Display Active slide background color
function cgs_active_slide_bgcolor_settings() {
    $activeslidebgcolor = get_option( 'content-slider-active-slide-bgcolor' );
	?>
	<input type="text" name="content-slider-active-slide-bgcolor" id="content-slider-active-slide-bgcolor" value="<?php if($activeslidebgcolor ) { echo esc_attr( $activeslidebgcolor ); } else { echo '#eeeeee'; } ?>" style="background:<?php echo esc_attr( $activeslidebgcolor );?>" onblur="selectedBgColorPreview('content-slider-active-slide-bgcolor','cgs_active');" />
	<input type='button' class='pickcolor button-secondary' value='Select Color' onblur="selectedBgColorPreview('content-slider-active-slide-bgcolor','cgs_active');" >
	<div id='colorpicker' style='z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;'></div>
    <?php
}
?>