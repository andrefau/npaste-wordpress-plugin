<?php
/**
 * Trigger this file on uninstall
 *
 * @package npaste
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

$settings = get_posts(
	array(
		'post_type'   => 'npaste_settings',
		'numberposts' => -1,
	)
);

foreach ( $settings as $setting ) {
	wp_delete_post( $setting->ID, true );
}
