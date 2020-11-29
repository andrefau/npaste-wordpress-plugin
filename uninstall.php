<?php
/**
 * Trigger this file on uninstall
 *
 * @package npaste
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

delete_option( 'npaste_settings' );
