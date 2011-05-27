<?php 

// create custom plugin settings menu
add_action('admin_menu', 'travel_tales_create_menu');

function travel_tales_create_menu() {
	$home_url = home_url();
	$theme_name = next(explode('/themes/', get_template_directory()));

	// create menu
	$theme_name = get_current_theme();
	add_object_page($theme_name . ' Settings', $theme_name, 'administrator', 'travel_tales', 'travel_tales_settings_page', $icon);
	
	// call register settings function
	add_action('admin_init', 'travel_tales_register_settings');

	// add css
//	add_action('admin_print_styles-toplevel_page_roots', 'roots_admin_styles');
}

/*
function roots_admin_styles() {
	$home_url = home_url();
	$theme_name = next(explode('/themes/', get_template_directory()));

	wp_register_style('roots_options_css', "$home_url/wp-content/themes/$theme_name/includes/css/options.css");
	wp_enqueue_style('roots_options_css');
	
	wp_register_script('roots_options_js', "$home_url/wp-content/themes/$theme_name/includes/js/options.js");
	wp_enqueue_script('roots_options_js');	

	wp_register_style('jquery-ui-css', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/smoothness/jquery-ui.css");
	wp_enqueue_style('jquery-ui-css');
}

 */

function travel_tales_register_settings() {
	// register our settings
	register_setting('travel-tales-settings-group', 'travel_tales_language_lessons');	
	register_setting('travel-tales-settings-group', 'travel_tales_recipes');	
	register_setting('travel-tales-settings-group', 'travel_tales_articles');	
	// TODO: This still requires some knowledge to get it working right.
	register_setting('travel-tales-settings-group', 'travel_tales_lock_post_types');	
	register_setting('travel-tales-settings-group', 'travel_tales_use_custom_headers');	

}

function travel_tales_settings_page() { ?>

<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
  <h2><?php echo get_current_theme(); ?> Settings</h2>
	
<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'true') { ?>
	<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>
<?php } ?>
	
	<form method="post" action="options.php">
			
		<?php settings_fields('travel-tales-settings-group'); ?>
			
		<div id="tabs">
			<ul>
				<li><a href="#general">General</a></li>
			</ul>
			<div id="general">
				<ul class="options clearfix">	
					<li>
						<label class="settings-label">Language Lesson Post Type</label>
						<input id="travel_tales_language_lessons" <?php if (get_option('travel_tales_lock_post_types')) : ?> disabled="disabled" <?php endif; ?> name="travel_tales_language_lessons" type="checkbox" <?php echo get_option('travel_tales_language_lessons') === 'checked' ?  'checked' : ''; ?> value="checked" /> 
						<label for="travel_tales_language_lessons">Enable language lessons.</label>
					</li>					
					<li>
						<label class="settings-label">Article Post Type</label>
						<input id="travel_tales_articles" <?php if (get_option('travel_tales_lock_post_types')) : ?> disabled="disabled" <?php endif; ?>  name="travel_tales_articles" type="checkbox" <?php echo get_option('travel_tales_articles') === 'checked' ?  'checked' : ''; ?> value="checked" /> 
						<label for="travel_tales_articles">Enable articles.</label>
					</li>					
					<li>
						<label class="settings-label">Recipe Post Type</label>
						<input id="travel_tales_recipes" <?php if (get_option('travel_tales_lock_post_types')) : ?> disabled="disabled" <?php endif; ?>  name="travel_tales_recipes" type="checkbox" <?php echo get_option('travel_tales_recipes') === 'checked' ?  'checked' : ''; ?> value="checked" /> 
						<label for="travel_tales_recipes">Enable recipes.</label>
					</li>					
					<li>
						<label class="settings-label">Lock Post Type Configuration</label>
						<input id="travel_tales_lock_post_types" name="travel_tales_lock_post_types" type="checkbox" <?php echo get_option('travel_tales_lock_post_types') === 'checked' ?  'checked' : ''; ?> value="checked" /> 
						<label for="travel_tales_lock_post_types">
							<?php if (!get_option('travel_tales_lock_post_types')) { ?>
								Post types <strong>MUST</strong> be locked after you've decided which you'll use.
							<?php } else { ?>
								Uncheck to change which post types are active.  Remember to lock them again once you're done.	
							<?php } ?>
						</label>
					</li>					
					<li>
						<label class="settings-label">Use Content Type Headers?</label>
						<input id="travel_tales_use_custom_headers" name="travel_tales_use_custom_headers" type="checkbox" <?php echo get_option('travel_tales_use_custom_headers') === 'checked' ?  'checked' : ''; ?> value="checked" /> 
						<label for="travel_tales_use_custom_headers">Checks for headers in the images/headers folder.</label>
					</li>									</ul>
			</div>		
		</div>		
		
		<p class="submit">
			<input type="submit" class="button-primary" value="Save Changes" />
		</p>

	</form>
</div>
<?php } ?>
