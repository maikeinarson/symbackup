<?php
if($groups != '-1'){
	$args = array(
		'post_type'=> 'content-slider',
		'posts_per_page' => '-1',
		'orderby' => $orderby,
		'order' => $order,
		'tax_query' => array(
			array(
			'taxonomy' => 'cgs_groups', 
			'field' => 'term_id',
			'terms' =>$groups
			))
	);
}else{
	$args = array(
		'post_type'=> 'content-slider',
		'posts_per_page' => '-1',
		'orderby' => $orderby,
		'order' => $order,
	);
}
query_posts( $args );
$taxonomy = 'cgs_groups';
$posttype = 'content-slider';
$mainheadingcolor = get_option( 'content-slider-main-heading-color' );
$fontcolor = get_option( 'content-slider-normal-font-color' );
$activeslidetitlecolor = get_option( 'content-slider-active-slide-title-color' );
$selectedslidebgcolor = get_option( 'content-slider-selected-slide-bgcolor' );
$selectedslidebordercolor = get_option( 'content-slider-selected-slide-bordercolor' );
$activeslidebgcolor = get_option( 'content-slider-active-slide-bgcolor' );
?>
<div id="cgs_tabs">
	<?php $term = get_term($groups,$taxonomy); ?>
	<h4 class="slider-heading"><?php if(!empty($term)) echo $term->name; else echo "Content Grid Slider";?></h4>
	<div id="tabs_container">
		<?php $count_posts = wp_count_posts($posttype); ?>
		<?php 
			if($groups == -1){
				if($count_posts->publish == 0)
					$group_ct= false;
				else
					$group_ct= true;
			}
			if($term->count != 0 || $group_ct == true):
		?>
			<div id="left_container">
				<?php $id_suf_l=1; ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php $id_pre="tab_".$groups."_"; ?>
				<div class="cgs-description" id="<?php echo $id_pre.$id_suf_l ?>">
					<h3 class="description-heading read_title_color" ><?php the_title();?></h3>
					<div class="cgs-icon">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('content-slider-desc');
						}?>
					</div>
					<div class="cgs-content">
						<?php
							$content = get_the_content();
							global $post;
							$words_count = str_word_count(strip_tags($post->post_content), 0, '');
							$trimmed_content = wp_trim_words( $content, 10);
							$trimmed_content2 = wp_trim_words( $content, 20);
							if($term->count < 9 && $groups != -1 )
								echo "<p class=content_color>".$trimmed_content."</p>";
							elseif($term->count >= 9 && $groups != -1 ){
								echo "<div class=content_color>";
								echo the_content();
								echo "</div>";
							}elseif($groups == -1 && $count_posts->publish <= 4)
								echo "<p class=content_color>".$trimmed_content."</p>";
							elseif($groups == -1 && $count_posts->publish <= 8)
								echo "<p class=content_color>".$trimmed_content."</p>";
							elseif($groups == -1 && $count_posts->publish > 8){
								echo "<div class=content_color>";
								echo the_content();
								echo "</div>";
							}else
								echo "<p class=content_color>".$trimmed_content."</p>";
							?>
					</div>
					<div class="text-right">
						<?php
							$mykey_values = get_post_custom_values('content_slider_url');
							$mykey_values_target = get_post_custom_values('content_slider_url_target');
						?>
						<a class="read_title_color" href="<?php echo $mykey_values[0] ?>" target="<?php echo $mykey_values_target[0]; ?>">Read more</a>
					</div>
				</div>
				<?php $id_suf_l++; ?>
				<?php endwhile;	endif; ?>	
			</div>
			<div id="right_container">
				<?php $id_suf_r=1; ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php $id_pre="tab_".$groups."_"; ?>
				<div class="cgs-icons <?php echo "tab_".$id_suf_r ?>" onclick="clickon('<?php echo $id_pre.$id_suf_r ?>');" oncontextmenu="clickon('<?php echo $id_pre.$id_suf_r ?>');">
					<div class="cgs-icon-l">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('content-slider-thumb');
						}?>
					</div>
					<div>
						<span class="cgs-title content_color"><?php the_title();?></span>
					</div>
				</div>
				<?php $id_suf_r++; ?>
				<?php endwhile;	endif; ?>
				<?php wp_reset_query(); ?>
			</div>
		<?php else: ?>
			<h3 style="text-align:center;">No Slide Found</h3>
		<?php endif; ?>
		<input type="hidden" id="id_suf_l" value="<?php echo $id_suf_l;?> " />
		<input type="hidden" id="wd_width" value="" />
		<input type="hidden" id="mainheadingcolor" value="<?php echo $mainheadingcolor; ?>" />
		<input type="hidden" id="fontcolor" value="<?php echo $fontcolor; ?>" />
		<input type="hidden" id="slidetitlecolor" value="<?php echo $activeslidetitlecolor; ?>" />
		<input type="hidden" id="selectedslidebgcolor" value="<?php echo $selectedslidebgcolor; ?>" />
		<input type="hidden" id="selectedslidebordercolor" value="<?php echo $selectedslidebordercolor; ?>" />
		<input type="hidden" id="activeslidebgcolor" value="<?php echo $activeslidebgcolor; ?>" />
	</div>
</div>
<?php	