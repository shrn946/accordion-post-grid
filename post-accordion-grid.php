<?php
/*
Plugin Name: Grid Symphony | Accordion Post Grid
Description: A plugin designed to feature an expandable Post Accordion Grid.

Version: 1.0
Author: Hassan Naqvi
*/

// Plugin code will go here

include_once(plugin_dir_path(__FILE__) . '/includes/post-shortcode.php');


// Enqueue styles and scripts
function custom_portfolio_enqueue_scripts() {
// Enqueue Isotope

	
	 // Enqueue styles
    wp_enqueue_style('latest-posts-with-filter-styles', plugin_dir_url(__FILE__) . 'css/latest-posts-with-filter.css');


    // Enqueue fonts.css
    wp_enqueue_style('custom-portfolio-fonts', plugins_url('css/fonts.css', __FILE__));

    // Enqueue card-grid.css
    wp_enqueue_style('custom-portfolio-card-grid', plugins_url('css/card-grid.css', __FILE__));

    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue card-grid.js and depend on jQuery
    wp_enqueue_script('custom-portfolio-card-grid', plugins_url('js/card-grid.js', __FILE__), array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'custom_portfolio_enqueue_scripts');


// Function to display the Expandable Project Accordion Grid settings page
function grid_symphony_settings_page() {
    ?>
<div class="container">   
 <div class="wrap">
        <h1>Grid Symphony Settings</h1>
        
        <p>Welcome to the Grid Symphony plugin settings page.</p>
        
        <h2>How to Use Shortcode</h2>
                <p> You can use [post-grid] for all posts and 
             
               
               <hr />
               for specific categories.
                 <pre> [post-grid category="your-category"]</pre>
               
        <pre> [post-grid exclude_category="your-excluded-category"]</pre>
        
       
      
        <h3>Video Link</h3>

        <iframe width="560" height="315" src="https://www.youtube.com/embed/L_UFOW0kxcI?si=ynD3DXibhivZ1WcZ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div></div>
    <?php
}

// Function to add Grid Symphony settings page to the admin menu
function grid_symphony_menu() {
    add_options_page(
        'Grid Symphony Settings',
        'Grid Symphony',
        'manage_options',
        'grid-symphony-settings',
        'grid_symphony_settings_page'
    );
}

// Hook to add the Grid Symphony menu item
add_action('admin_menu', 'grid_symphony_menu');

// Function for the shortcode generator (add your code here)
function grid_symphony_shortcode_generator() {
    // Add your shortcode generator code here
}

// Hook to add the shortcode generator to the admin menu
add_action('admin_menu', 'grid_symphony_shortcode_generator');

// Function for handling the Grid Symphony shortcode
function grid_symphony_shortcode($atts) {
    // Add your shortcode handling code here
}

// Hook to add the Grid Symphony shortcode
add_shortcode('grid_symphony', 'grid_symphony_shortcode');

// Function to add a settings link on the Plugins page
function grid_symphony_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=grid-symphony-settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

// Variable to get the plugin basename
$plugin = plugin_basename(__FILE__);

// Hook to add the settings link to the Plugins page
add_filter("plugin_action_links_$plugin", 'grid_symphony_settings_link');
?>
