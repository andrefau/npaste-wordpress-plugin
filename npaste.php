<?php
/**
 * Plugin for encrypting text using npaste.
 *
 * @package             npaste
 * @version             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:         npaste
 * Description:         Encrypts text input
 * Author:              Andreas L. Fauske
 * Version:             1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Npaste {
	/**
	 * Description: Holds the name of the plugin
	 *
	 * @var plugin_name Plugin name
	 */
	public $plugin_name;

	public function __construct() {
		add_action( 'init', array( $this, 'custom_post_type' ) );
		$this->plugin_name = plugin_basename( __FILE__ );
	}

	public function activate() {
		$this->custom_post_type();
		flush_rewrite_rules();
	}

	public function register() {
		add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
		add_filter( "plugin_action_links_$this->plugin_name", array( $this, 'settings_link' ) );
	}

	public function settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=npaste_plugin">Settings</a>';
		array_push( $links, $settings_link );

		return $links;
	}

	public function deactivate() {
		flush_rewrite_rules();
	}

	public function custom_post_type() {
		register_post_type(
			'npaste_settings',
			array(
				'public' => false,
				'label'  => 'Npaste settings',
			)
		);
	}

	public function add_menu_page() {
		add_menu_page( 'Npaste Plugin', 'npaste', 'manage_options', 'npaste_plugin', array( $this, 'settings_page' ), 'dashicons-admin-network', 110 );
	}

	public function settings_page() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/settings.php';
	}
}

if ( class_exists( 'Npaste' ) ) {
	$npaste = new Npaste();
	$npaste->register();
}

register_activation_hook( __FILE__, array( $npaste, 'activate' ) );
register_deactivation_hook( __FILE__, array( $npaste, 'deactivate' ) );
