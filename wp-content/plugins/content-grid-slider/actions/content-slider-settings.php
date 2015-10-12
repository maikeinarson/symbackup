<div id="cgs_container">
	<h2>Content Grid Slider Settings</h2>
	<div id="cgs_settings_left">
		<div class="left_rows" id="general_settings">
			<h3>You can use the following form to create shortcode for you.</h3>
			<fieldset>
				<label for="shortcode-type">Select type of code do you need.</label><br/>
				<label><input type="radio" name="shortcode-type" class="shortcode-type" value="sc_html" /> HTML Shortcode <span>(Commonly used for embedding in posts, pages and Text Widgets.)</span></label><br/>
				<label><input type="radio" name="shortcode-type" class="shortcode-type" value="sc_php" /> PHP Shortcode<span>(Commonly used for adding in theme's template files.)</span></label>
			</fieldset>
			
			<div id="cgs_code"><span id="cgs_code_begin"></span><span id="cgs_code_middle"></span><span id="cgs_code_end"></span></div>
			<div id="cgs_code1"></div>
<?php 
//$URI=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>
			<form id="cgs_form_bulider" action="#slider_preview" method="post">
				<fieldset>
					<p class="form-help">Select the group (or groups) from which to select ads from. (Default: Ads from all groups)</p>
					<label for="cgs_groups">Groups</label>
					<?php wp_dropdown_categories( 'show_option_none=Select Group&taxonomy=cgs_groups&hide_empty=0&name=groups' ); ?> 
				</fieldset>
				
				<fieldset>
					<p class="form-help">Choose Displaying Order. (Default: Menu Order)</p>
					<label for="cgs_orderby">Order By</label>
					<select name="orderby" id="cgs_orderby">
						<option value="">Select Attribute</option>
						<option value="none">None</option>
						<option value="ID">Post ID</option>
						<option value="title">Title</option>
						<option value="name">Name</option>
						<option value="date">Date</option>
						<option value="modified">Modified</option>
						<option value="rand">Random</option>
						<option value="menu_order">Custom Order</option>
					</select>
				</fieldset>

				<fieldset id="cgs_order_field">
					<p class="form-help">Choose the sort order. (Default: ASC)</p>
					<label for="cgs_order">Order</label>
					<select name="order" id="cgs_order">
						<option value="">Select Order</option>
						<option value="ASC">Ascending</option>
						<option value="DESC">Descending</option>
					</select>
				</fieldset>
				<input type="hidden" name="cgs-hidden" id="cgs-hidden" value="" />				
				<input type="submit" name="cgs-submit" id="cgs-submit" value="Click here for Preview" />				
			</form>
		</div>
		<div class="left_rows" id="slider_preview">
			<h2>Preview of your Slider</h2>
			<div id="cgs_preview">
				<?php
					$sc = "[content-slider";
					if(isset($_POST['cgs-submit'])){
						if(isset($_POST['groups'])){
							$cgs_groups = $_POST['groups'];
							if(!empty($cgs_groups))
								$sc.=" groups=".$cgs_groups;
						}
						if(isset($_POST['cgs-submit'])){
							$cgs_orderby = $_POST['orderby'];
							if(!empty($cgs_orderby))
								$sc.=" orderby=".$cgs_orderby;
						}
						if(isset($_POST['cgs-submit'])){
							$cgs_order = $_POST['order'];
							if(!empty($cgs_order))
								$sc.=" order=".$cgs_order;
						}
						$sc.="]";
						//echo  $_POST['cgs-hidden'];
						$sc_hidden = $_POST['cgs-hidden'];
						if($sc_hidden == "sc_html")
							echo "<div id=cgs-shortcode>".$sc."</div>";
						elseif($sc_hidden == "sc_php")
							echo "<div id=cgs-shortcode> &lt;?php echo do_shortcode(\"".$sc."\"); ?&gt; </div>";
						echo '<div id=cgs-slideshow>';
						echo do_shortcode("[content-slider groups=".$cgs_groups." orderby=".$cgs_orderby." order=".$cgs_order."]");
						echo '</div>';
					}
					else{
						echo '<div id=cgs-slideshow>';
							echo do_shortcode("[content-slider]");
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
	<div id="cgs_settings_right">
		<?php include('content-slider-settings-right.html'); ?>
	</div>
</div>
