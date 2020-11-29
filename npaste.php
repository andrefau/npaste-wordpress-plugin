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

$plugin_name = plugin_basename( __FILE__ );

add_action( 'admin_menu', 'npaste_add_admin_menu' );
add_action( 'admin_init', 'npaste_settings_init' );
add_filter( "plugin_action_links_$plugin_name", 'npaste_settings_link' );

function npaste_add_admin_menu() {
	add_options_page( 'Npaste settings', 'Npaste settings', 'manage_options', 'npaste_settings', 'npaste_settings_template' );
}

function npaste_settings_init() {
	register_setting( 'npastePlugin', 'npaste_settings' );

	add_settings_section(
		'npastePlugin_section',
		null,
		null,
		'npastePlugin'
	);

	add_settings_field(
		'npaste_settings_age_field',
		'Age',
		'npaste_settings_age_field_render',
		'npastePlugin',
		'npastePlugin_section'
	);

	add_settings_field(
		'npaste_settings_archive_field',
		'Archive',
		'npaste_settings_archive_field_render',
		'npastePlugin',
		'npastePlugin_section'
	);

	add_settings_field(
		'npaste_settings_encrypt_field',
		'Encrypt',
		'npaste_settings_encrypt_field_render',
		'npastePlugin',
		'npastePlugin_section'
	);

	add_settings_field(
		'npaste_settings_encryption_key_length_field',
		'Encryption key length',
		'npaste_settings_encryption_key_length_field_render',
		'npastePlugin',
		'npastePlugin_section'
	);

	add_settings_field(
		'npaste_settings_password_field',
		'Encryption key length',
		'npaste_settings_password_field_render',
		'npastePlugin',
		'npastePlugin_section'
	);

	add_settings_field(
		'npaste_settings_url_field',
		'URL',
		'npaste_settings_url_field_render',
		'npastePlugin',
		'npastePlugin_section'
	);

	add_settings_field(
		'npaste_settings_username_field',
		'Username',
		'npaste_settings_username_field_render',
		'npastePlugin',
		'npastePlugin_section'
	);
}

function npaste_settings_age_field_render() {
	$options = get_option( 'npaste_settings' );
	$age     = is_array( $options ) && array_key_exists( 'npaste_settings_age_field', $options )
		? $options['npaste_settings_age_field']
		: '';

	?>
	<input type="text" name="npaste_settings[npaste_settings_age_field]" value='<?php echo $age; ?>'>
	<p class="description">Paste age (s,m,h,d,y)</p>
	<?php
}

function npaste_settings_archive_field_render() {
	$options = get_option( 'npaste_settings' );
	$archive = is_array( $options ) && array_key_exists( 'npaste_settings_archive_field', $options )
		? $options['npaste_settings_archive_field']
		: false;

	?>
	<label for="npaste_archive">
		<input id="npaste_archive" name="npaste_settings[npaste_settings_archive_field]" type="checkbox" value="<?php echo $archive; ?>">
		If a paste should be archived instead of deleted when expiring.
	</label>
	<?php
}

function npaste_settings_encrypt_field_render() {
	$options = get_option( 'npaste_settings' );
	$encrypt = is_array( $options ) && array_key_exists( 'npaste_settings_encrypt_field', $options )
		? $options['npaste_settings_encrypt_field']
		: false;

	?>
	<label for="npaste_encrypt">
		<input id="npaste_encrypt" name="npaste_settings[npaste_settings_encrypt_field]" type="checkbox" value="<?php echo $encrypt; ?>">
		If a paste should be encrypted using GPG.
	</label>
	<?php
}

function npaste_settings_encryption_key_length_field_render() {
	$options    = get_option( 'npaste_settings' );
	$key_length = is_array( $options ) && array_key_exists( 'npaste_settings_encryption_key_length_field', $options )
		? $options['npaste_settings_encryption_key_length_field']
		: '';

	?>
	<input type="text" name="npaste_settings[npaste_settings_encryption_key_length_field]" value='<?php echo $key_length; ?>'>
	<p class="description">The length of the encryption key.</p>
	<?php
}

function npaste_settings_password_field_render() {
	$options  = get_option( 'npaste_settings' );
	$password = is_array( $options ) && array_key_exists( 'npaste_settings_password_field', $options )
		? $options['npaste_settings_password_field']
		: '';

	?>
	<input type="password" name="npaste_settings[npaste_settings_password_field]" value="<?php echo $password; ?>">
	<p class="description">Your API password.</p>
	<?php
}

function npaste_settings_url_field_render() {
	$options = get_option( 'npaste_settings' );
	$url     = is_array( $options ) && array_key_exists( 'npaste_settings_url_field', $options )
		? $options['npaste_settings_url_field']
		: '';

	?>
	<input type="text" name="npaste_settings[npaste_settings_url_field]" value="<?php echo $url; ?>">
	<p class="description">The URL for the npaste server to use.</p>
	<?php
}

function npaste_settings_username_field_render() {
	$options  = get_option( 'npaste_settings' );
	$username = is_array( $options ) && array_key_exists( 'npaste_settings_username_field', $options )
		? $options['npaste_settings_username_field']
		: '';

	?>
	<input type="text" name="npaste_settings[npaste_settings_username_field]" value="<?php echo $username; ?>">
	<p class="description">Your API username.</p>
	<?php
}

function npaste_settings_template() {
	?>

	<form action="options.php" method="POST">
		<h1>Npaste settings</h1>
		<?php
		settings_fields( 'npastePlugin' );
		do_settings_sections( 'npastePlugin' );
		submit_button();
		?>
	</form>

	<?php
}

function npaste_settings_link( $links ) {
	$settings_link = '<a href="options-general.php?page=npaste_settings">Settings</a>';
	array_push( $links, $settings_link );

	return $links;
}
