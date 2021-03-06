<?php
/**
 * General settings administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
//require_once( dirname( __FILE__ ) . '/admin.php' );

/** WordPress Translation Install API */
require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );

/** WordPress Options implementation for General Settings */
require_once( SAE_ABSPATH . 'wp-admin/includes/options-general.php' );

add_settings_fields_options_general();

if ( ! current_user_can( 'manage_options' ) )
	wp_die( __( 'Sorry, you are not allowed to manage options for this site.' ) );

$title = __('General Settings');
$parent_file = 'options-general.php';
/* translators: date and time format for exact current time, mainly about timezones, see https://secure.php.net/date */
$timezone_format = _x('Y-m-d H:i:s', 'timezone date format');

add_action('admin_head', 'sae_options_general_add_js');

$options_help = '<p>' . __('The fields on this screen determine some of the basics of your site setup.') . '</p>' .
	'<p>' . __('Most themes display the site title at the top of every page, in the title bar of the browser, and as the identifying name for syndicated feeds. The tagline is also displayed by many themes.') . '</p>';

if ( ! is_multisite() ) {
	$options_help .= '<p>' . __('The WordPress URL and the Site URL can be the same (example.com) or different; for example, having the WordPress core files (example.com/wordpress) in a subdirectory instead of the root directory.') . '</p>' .
		'<p>' . __('If you want site visitors to be able to register themselves, as opposed to by the site administrator, check the membership box. A default user role can be set for all new users, whether self-registered or registered by the site admin.') . '</p>';
}

$options_help .= '<p>' . __( 'You can set the language, and the translation files will be automatically downloaded and installed (available if your filesystem is writable).' ) . '</p>' .
	'<p>' . __( 'UTC means Coordinated Universal Time.' ) . '</p>' .
	'<p>' . __( 'You must click the Save Changes button at the bottom of the screen for new settings to take effect.' ) . '</p>';

get_current_screen()->add_help_tab( array(
	'id'      => 'overview',
	'title'   => __('Overview'),
	'content' => $options_help,
) );

get_current_screen()->set_help_sidebar(
	'<p><strong>' . __('For more information:') . '</strong></p>' .
	'<p>' . __('<a href="https://codex.wordpress.org/Settings_General_Screen">Documentation on General Settings</a>') . '</p>' .
	'<p>' . __('<a href="https://wordpress.org/support/">Support Forums</a>') . '</p>'
);

include( ABSPATH . 'wp-admin/admin-header.php' );
?>

<div class="wrap">
<h1><?php echo esc_html( $title ); ?></h1>

<form method="post" action="options.php" novalidate="novalidate">
<?php settings_fields('general'); ?>

<div class="settings-fields">
<?php sae_do_settings_fields( 'general', 'default' ); ?>
</div>

<?php sae_do_settings_sections( 'general' ); ?>

<?php submit_button(); ?>
</form>

</div>

<?php include( ABSPATH . 'wp-admin/admin-footer.php' ); ?>
