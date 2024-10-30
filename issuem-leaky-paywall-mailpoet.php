<?php
/**
 * Main PHP file used to for initial calls to zeen101's Leak Paywall classes and functions.
 *
 * @package zeen101's Leak Paywall - MailPoet
 * @since 1.0.0
 */
 
/*
Plugin Name: Leaky Paywall - MailPoet
Plugin URI: http://zeen101.com/
Description: A premium addon for the Leaky Paywall for WordPress plugin.
Author: zeen101 Development Team
Version: 1.2.0
Author URI: http://zeen101.com/
Tags:
*/

//Define global variables...
if ( !defined( 'ZEEN101_STORE_URL' ) )
	define( 'ZEEN101_STORE_URL',	'http://zeen101.com' );
	
define( 'LP_MP_NAME', 		'Leaky Paywall - Subscriber MailPoet' );
define( 'LP_MP_SLUG', 		'leaky-paywall-mailpoet' );
define( 'LP_MP_VERSION', 	'1.2.0' );
define( 'LP_MP_DB_VERSION', 	'1.0.0' );
define( 'LP_MP_URL', 		plugin_dir_url( __FILE__ ) );
define( 'LP_MP_PATH', 		plugin_dir_path( __FILE__ ) );
define( 'LP_MP_BASENAME', 	plugin_basename( __FILE__ ) );
define( 'LP_MP_REL_DIR', 	dirname( LP_MP_BASENAME ) );

/**
 * Instantiate Pigeon Pack class, require helper files
 *
 * @since 1.0.0
 */
function leaky_paywall_mailpoet_plugins_loaded() {
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		
	if ( is_plugin_active( 'wysija-newsletters/index.php' )
		&& ( is_plugin_active( 'issuem-leaky-paywall/issuem-leaky-paywall.php' ) 
			|| is_plugin_active( 'leaky-paywall/leaky-paywall.php' ) ) ) {
	
		require_once( 'class.php' );
	
		// Instantiate the Pigeon Pack class
		if ( class_exists( 'Leaky_Paywall_MailPoet' ) ) {
			
			global $leaky_paywall_mailpoet;
			
			$leaky_paywall_mailpoet = new Leaky_Paywall_MailPoet();
			
			require_once( 'functions.php' );
				
			//Internationalization
			load_plugin_textdomain( 'issuem-lp-mp', false, LP_MP_REL_DIR . '/i18n/' );
				
		}
	
	} else {
	
		add_action( 'admin_notices', 'leaky_paywall_mailpoet_requirement_nag' );
		
	}


}
add_action( 'plugins_loaded', 'leaky_paywall_mailpoet_plugins_loaded', 4815162342 ); //wait for the plugins to be loaded before init

function leaky_paywall_mailpoet_requirement_nag() {
	?>
	<div id="leaky-paywall-requirement-nag" class="update-nag">
		<?php _e( 'You must have the Leaky Paywall plugin and the MailPoet plugin activated to use the Leaky Paywall MailPoet plugin.' ); ?>
	</div>
	<?php
}
