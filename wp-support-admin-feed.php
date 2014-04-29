<?php
/**
 * Dashboard WP.org support forum feed
 *
 * Displays a widget in the Dashboard of the .org support forums for AE plugins
 * 
 * @package   WP Support Forum Feed
 * @author    davebonds
 * @license   GPL-2.0+
 * @link      http://agentevolution.com
 * @copyright 2014 Agent Evolution
 *
 * @wordpress-plugin
 * Plugin Name:       Dashboard WP.org support forum feed
 * Plugin URI:        @TODO
 * Description:       Displays a widget in the Dashboard of the .org support forums for AE plugins
 * Version:           1.0.0
 * Author:            davebonds
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-name-admin.php` with the name of the plugin's admin file
 * - replace Plugin_Name_Admin with the name of the class defined in
 *   `class-plugin-name-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	/**
	 * Add Dashboard RSS feed widget for wp.org support forum
	 */
	add_action('wp_dashboard_setup', 'ae_dashboard_widgets');
	function ae_dashboard_widgets() {
	     global $wp_meta_boxes;
	     unset(
	          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
	          $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
	          $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
	     );
	     wp_add_dashboard_widget( 'dashboard_wplistings_feed', 'Support &raquo; WP Listings' , 'dashboard_org_wplistings_support_feed_output' );
	     wp_add_dashboard_widget( 'dashboard_gap_feed', 'Support &raquo; Genesis Agent Profiles' , 'dashboard_org_gap_support_feed_output' );
	}
	function dashboard_org_wplistings_support_feed_output() {
	     echo '<div class="rss-widget">';
	     wp_widget_rss_output(array(
	          'url' => 'http://wordpress.org/support/rss/plugin/wp-listings',
	          'title' => 'Support &raquo; WP Listings',
	          'items' => 6,
	          'show_summary' => 1,
	          'show_author' => 1,
	          'show_date' => 1
	     ));
	     echo '</div>';
	}

	function dashboard_org_gap_support_feed_output() {
	     echo '<div class="rss-widget">';
	     wp_widget_rss_output(array(
	          'url' => 'http://wordpress.org/support/rss/plugin/genesis-agent-profiles',
	          'title' => 'Support &raquo; Genesis Agent Profiles',
	          'items' => 6,
	          'show_summary' => 1,
	          'show_author' => 1,
	          'show_date' => 1
	     ));
	     echo '</div>';
	}

}
