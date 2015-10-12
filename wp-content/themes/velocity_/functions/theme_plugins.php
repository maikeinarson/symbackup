<?php 
	
	/* TGM Plugin Install */
	define( 'THEMENAME', 'Velocity' );

	require_once velocity_FUNCTIONS . '/class-tgm-plugin-activation.php';

	
	add_action( 'tgmpa_register', 'velocity_theme_register_required_plugins' );
	
	function velocity_theme_register_required_plugins() {
		$velocity_plugins = array(
			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'required' 	=> false,
			),
			array(
				'name' 		=> 'Really Simple Captcha',
				'slug' 		=> 'really-simple-captcha',
				'required' 	=> false,
			),
			array(
				'name'     				=> 'Slider Revolution', // The plugin name
				'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
				'source'   				=> velocity_FUNCTIONS . 'plugins/revslider.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '4.6.93', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Showbiz', // The plugin name
				'slug'     				=> 'showbiz', // The plugin slug (typically the folder name)
				'source'   				=> velocity_FUNCTIONS . 'plugins/showbiz.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.7.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Visual Composer', // The plugin name
				'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
				'source'   				=> velocity_FUNCTIONS . 'plugins/js_composer.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '4.5.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Velocity Visual Composer Add-On', // The plugin name
				'slug'     				=> 'velocityVCaddons', // The plugin slug (typically the folder name)
				'source'   				=> velocity_FUNCTIONS . 'plugins/velocityVCaddons.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Velocity Portfolio', // The plugin name
				'slug'     				=> 'velocityPortfolio', // The plugin slug (typically the folder name)
				'source'   				=> velocity_FUNCTIONS . 'plugins/velocityPortfolio.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'ThemeForest Theme Updater', // The plugin name
				'slug'     				=> 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
				'source'   				=> velocity_FUNCTIONS . 'plugins/envato-wordpress-toolkit-master.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.7.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'has_notices'		    => true,
				'is_automatic'     		=> true,
			),
		);
		

		$config = array(
			'id'           => 'velocity_plugins',      // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
				'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
				'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ), // %s = plugin name. http://velocity.themepunch.com/velodoc/install-plugins/index.html
				'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s. <br>(<a target=_blank href="http://velocity.themepunch.com/velodoc/install-plugins/index.html">How to Install?</a>)', 'This theme requires the following plugins: %1$s. <br>(<a target=_blank href="http://velocity.themepunch.com/velodoc/install-plugins/index.html">How to Install?</a>)', 'theme-slug' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s. <br>(<a target=_blank href="http://velocity.themepunch.com/velodoc/install-plugins/index.html">How to Install?</a>)', 'This theme recommends the following plugins: %1$s.<br>(<a target=_blank href="http://velocity.themepunch.com/velodoc/install-plugins/index.html">How to Install?</a>)', 'theme-slug' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'theme-slug' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'theme-slug' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s. <br>(<a target=_blank href="http://velocity.themepunch.com/velodoc/updating-the-theme/index.html#pluginupdate">How to Update?</a>)', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s. <br>(<a target=_blank href="http://velocity.themepunch.com/velodoc/updating-the-theme/index.html#pluginupdate">How to Update?</a>)', 'theme-slug' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'theme-slug' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'theme-slug' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'theme-slug' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'theme-slug' ), // %s = dashboard link.
				'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);
		tgmpa( $velocity_plugins, $config );
	}
?>