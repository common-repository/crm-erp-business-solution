<?php
/*
 * Plugin Name: CRM ERP Business Solution | freelancers & SME
 * Description: CRM ERP Business Solution for Freelancers & SME to manage the business better.
 * Version: 1.12
 * Author: extendWP
 * Text Domain: crmerpbs
 * Domain Path: /lang 
 * Author URI: https://extend-wp.com
 *
 * WC requires at least: 2.2
 * WC tested up to: 8.6
 *   
 * License: GPL2
 * Created On: 05-03-2021
 * Updated On: 07-03-2024
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include_once( plugin_dir_path(__FILE__) ."/class-main.php" );


class CrmErpSolution extends CrmErpSolutionInit{


		public $plugin = 'crmerpbs';		
		public $name = 'CRM ERP Business Solution for Wordpress & WooCommerce';
		public $shortName = 'CRM ERP';
		public $slug = 'crm-erp-business-solution';
		public $dashicon = 'dashicons-editor-table';
		public $wooAddon = 'https://extend-wp.com/product/crm-erp-business-solution-wordpress-woocommerce-integration';
		public $proAddon = 'https://extend-wp.com/product/crm-erp-business-solution-wordpress-woocommerce-pro-addon';
		public $menuPosition ='50';
		public $localizeBackend;
		public $localizeFrontend;
		public $description = 'CRM ERP Business Solution for Freelancers & SME to manage the business better.';


		protected static $instance = NULL;

		public static function get_instance()
		{
			if ( NULL === self::$instance )
				self::$instance = new self;

			return self::$instance;
		}
	
		public function __construct() {	
			
			
			register_activation_hook( __FILE__,  array( $this, 'onActivation') );
						
			add_action( 'plugins_loaded', array( $this, 'translate' ) );
						
			add_action( 'admin_enqueue_scripts', array( $this, 'BackEndScripts' ) );
			add_action( 'admin_menu', array( $this, 'SettingsPage' ) );
			
			add_action( "crmerpbs_generalView", array( $this, 'generalView' ) );
			add_action( "crmerpbs_general_options", array( $this, 'general_options' ) );
			
			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, 'Links' ) );

			// HPOS compatibility declaration

			add_action( 'before_woocommerce_init', function() {
				if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
					\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
				}
			} );
			

			$role = get_role( 'administrator' );
			$role->add_cap( 'crm-erp-business-solution' );
				
			if( !empty( get_option( 'crmerpbs_accessRole' ) ) ) {
					
				$role = get_role( get_option( 'crmerpbs_accessRole' ) );
				$role->add_cap( 'crm-erp-business-solution' );
			}
			
				
			include_once( plugin_dir_path(__FILE__) ."includes/generatepdf.php" );			
			include_once( plugin_dir_path(__FILE__) ."/includes/crm-erp-documents.php" );
			include_once( plugin_dir_path(__FILE__) ."/includes/crm-erp-users.php" );			
			include_once( plugin_dir_path(__FILE__) ."/includes/crm-erp-products.php" );
			
			include_once( plugin_dir_path(__FILE__) ."/includes/crm-erp-transactions.php" );
			include_once( plugin_dir_path(__FILE__) ."/includes/crm-erp-reports.php" );
			
			if( get_option( 'crmerpbs_enableAppointments' ) ) include_once( plugin_dir_path(__FILE__) ."/includes/crm-erp-appointments.php" );
																						
			global $pagenow;
			if ( !empty( $pagenow ) &&  'post.php' == $pagenow  && isset( $_REQUEST['post'] ) && ( get_post_type( $_REQUEST['post'] ) == 'crmerpbs_products' || get_post_type( $_REQUEST['post'] ) == 'crmerpbs_app' ) ){
						
						add_action( 'all_admin_notices', function(){
									
								$this->adminHeader();
								do_action( "crmerpbs_admintabs" );

						});	
						?>
						<style>body{background:#fff !important;}</style>
						<?php				
			}
			
			add_action( 'load-edit.php', function() {
				
				
					$screen = get_current_screen();
					
					if( isset( $_REQUEST['post_type'] ) &&  $_REQUEST['post_type'] == 'crmerpbs_products'  ){
						add_action( 'all_admin_notices', function(){

							$this->adminHeader();
							do_action( "crmerpbs_admintabs" );
							
						});	
						?>
						<style>body{background:#fff !important;}</style>
						<?php
					}
					
						
					if( isset( $_REQUEST['post_type'] ) && $_REQUEST['post_type'] == 'crmerpbs_app' && get_option( "crmerpbs_enableAppointments" ) ){
						add_action( 'all_admin_notices', function(){
							$this->adminHeader();
							do_action(  "crmerpbs_admintabs" );
							$apppointments = new CrmErpSolutionAppointments();
							$apppointments->displayCalendar();
						});							
						?>
						<style>body{background:#fff !important;}</style>
						<?php
					}
					
			});
				
				
			add_action( 'load-post-new.php', function() {
					
					$screen = get_current_screen();
					if( isset( $_REQUEST['post_type'] ) && ( $_REQUEST['post_type'] == 'crmerpbs_app' || $_REQUEST['post_type'] == 'crmerpbs_products' ) ){
						
						add_action( 'all_admin_notices', function(){
							$this->adminHeader();
							do_action( "crmerpbs_admintabs" );
						});	
						?>
						<style>body{background:#fff !important;}</style>
						<?php
							
						if( isset( $_REQUEST['user'] ) ) {						
							update_option( "userToAdd" , sanitize_text_field( $_REQUEST['user'] ) );
						}					
					}				
					add_filter( 'views_edit-crmerpbs_app', array( $this, 'adminTabs' ) ); // appointment is my custom post type				
			});	
				
			
												
			register_deactivation_hook( __FILE__,  array( $this, 'onDeActivation' ) );		
			
			add_action( "admin_init", array( $this, 'adminPanels' ) );		
			add_action( "admin_init", array( $this, 'checkPrice' ) );	

			add_action( 'wp_ajax_nopriv_extensions', array( $this,'extensions' ) );
			add_action( 'wp_ajax_extensions', array( $this,'extensions' ) );
			add_action( 'activated_plugin',  array( $this,'redirectOnActivation' ),10, 1 );
			
			add_action( 'admin_notices',  array( $this, 'notice' ), 10, 1 );
			add_action( 'plugins_loaded',  array( $this, 'initializeTabs' ) );	

			// deactivation survey 

			include( plugin_dir_path(__FILE__) .'/lib/codecabin/plugin-deactivation-survey/deactivate-feedback-form.php');	
			add_filter('codecabin_deactivate_feedback_form_plugins', function($plugins) {

				$plugins[] = (object)array(
					'slug'		=> 'crm-erp-business-solution',
					'version'	=> '1.11'
				);

				return $plugins;

			});	
			
			register_activation_hook( __FILE__, array( $this, 'notification_hook' ) );

			add_action( 'admin_notices', array( $this,'notification' ) );
			add_action( 'wp_ajax_nopriv_push_not',array( $this, 'push_not'  ) );
			add_action( 'wp_ajax_push_not', array( $this, 'push_not' ) );	
			
		}
		
		public function notification(){
			
			$screen = get_current_screen();
			if ( 'toplevel_page_crm-erp-business-solution'  !== $screen->base )
			return;
		
			/* Check transient, if available display notice */
			if( get_transient( "crmerpbs_notification" ) ){
				?>
				<div class="updated notice  crmerpbs_notification">
					<a href="#" class='dismiss' style='float:right;padding:4px' >close</a>
					<h3><?php esc_html_e( "Add your Email below & get ", 'crm-erp-business-solution' ); ?><strong>10%</strong><?php esc_html_e( " off in  ", 'crm-erp-business-solution' ); ?><a href='https://extend-wp.com' target='_blank' ><?php esc_html_e( " premium plugins! ", 'crm-erp-business-solution' ); ?></a></h3>
					
					<form method='post' id='crmerpbs_signup'>
						<p>
						<input required type='email' name='woopei_email' />
						<input required type='hidden' name='product' value='3902' />
						<input type='submit' class='button button-primary' name='submit' value='<?php esc_html_e("Sign up", "crm-erp-business-solution" ); ?>' />
						<i><?php esc_html_e( "By adding your email you will be able to use your email as coupon to a future purchase at ", 'crm-erp-business-solution' ); ?><a href='https://extend-wp.com' target='_blank' >extend-wp.com</a></i>
						</p>
					</form>
				</div>
				<?php
			}
		}


		public function push_not(){
			
			delete_transient( $this->plugin."_notification" );
					
		}		
		public function notification_hook() {
			set_transient( $this->plugin."_notification", true );
		}
		
		
		public function initializeTabs(){
			add_action( "crmerpbs_admintabs", array( $this, 'adminTabs' ) );
		}
		
		public function onActivation(){
			
		
			set_transient( 'crm-erp-business-solution' , true, 5 );
			
			update_option( "crmerpbs_enableAppointments" ,'true' );			
			update_option( "crmerpbs_enableOffers" ,'true' );
			update_option( "crmerpbs_enableProducts" ,'true' );
			update_option( "crmerpbs_enableTickets" ,'true' );
			update_option( "crmerpbs_enableEmails" ,'true' );
			update_option( "crmerpbs_enableActions" ,'true' );			
			update_option( "crmerpbs_headingsBackground" ,'#000' );
			update_option( "crmerpbs_headingsColor" , '#3FE5AA' );
			update_option( "crmerpbs_generalColor" , '#000' );
			update_option( "crmerpbs_thankyouColor",'#3FE5AA' );
			
			//if files from unifont created delete them - used in cases where user takes plugin zip from one site to other manually
			$location1 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans.cw.dat";	
			$location2 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans.mtx.php";	
			$location3 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans-bold.cw.dat";	
			$location4 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans-bold.mtx.php";	
			$location5 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans-oblique.cw.dat";	
			$location6 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans-oblique.mtx.php";	
			$location7 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans.cw127.php";
			if( file_exists( $location1 ) ){				
				unlink( $location1 );				
			}
			if( file_exists( $location2 ) ){				
				unlink( $location2 );				
			}
			if( file_exists( $location3 ) ){				
				unlink( $location3 );				
			}
			if( file_exists( $location4 ) ){				
				unlink( $location4 );				
			}
			if( file_exists( $location5 ) ){				
				unlink( $location5 );				
			}
			if( file_exists( $location6 ) ){				
				unlink( $location6 );				
			}
			if( file_exists( $location7 ) ){				
				unlink( $location7 );				
			}				

		}
		
		public function redirectOnActivation( $plugin ){
			
			if( $plugin == plugin_basename( __FILE__ ) ) {
				wp_redirect( esc_url( admin_url( "admin.php?page=crm-erp-business-solution" ) ) );
				exit;	
			}
		}
		

		public function onDeActivation(){

			?>
			<script>
				(function( $ ) {
					localStorage.removeItem('hideIntro');
				})( jQuery )
			</script>					
			<?php
			//if files from unifont created delete them
			$location1 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans.cw.dat";	
			$location2 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans.mtx.php";	
			$location3 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans-bold.cw.dat";	
			$location4 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans-bold.mtx.php";	
			$location5 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans-oblique.cw.dat";	
			$location6 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans-oblique.mtx.php";	
			$location7 = plugin_dir_path( __FILE__ )."/topdf/font/unifont/dejavusans.cw127.php";
			if( file_exists( $location1 ) ){				
				unlink( $location1 );				
			}
			if( file_exists( $location2 ) ){				
				unlink( $location2 );				
			}
			if( file_exists( $location3 ) ){				
				unlink( $location3 );				
			}
			if( file_exists( $location4 ) ){				
				unlink( $location4 );				
			}
			if( file_exists( $location5 ) ){				
				unlink( $location5 );				
			}
			if( file_exists( $location6 ) ){				
				unlink( $location6 );				
			}
			if( file_exists( $location7 ) ){				
				unlink( $location7 );				
			}			
		}
		
		static function onUninstall(){

		
			if( get_option( 'crmerpbs_deleteTables' ) ){
				
				global $wpdb;
				
				$transactions = $wpdb->prefix . 'crmerpbs_transactions';
				$wpdb->query( "DROP TABLE IF EXISTS ". sanitize_text_field( $transactions )." " );

				$transactions_items = $wpdb->prefix . 'crmerpbs_transaction_items';
				$wpdb->query( "DROP TABLE IF EXISTS " . sanitize_text_field( $transactions_items )." " );

				
				$documents = $wpdb->prefix . 'crmerpbs_documents';
				$wpdb->query( "DROP TABLE IF EXISTS " . sanitize_text_field( $documents )." " );	

				$offproducts = get_posts( array( 'post_type' => 'crmerpbs_products', 'numberposts' => -1 ) );
				foreach ( $offproducts as $eachproduct ) {
					wp_delete_post( (int)$eachproduct->ID, true );
				}
				
				$crmpro_appointments = get_posts( array( 'post_type' => 'crmerpbs_app', 'numberposts' => -1 ) );
				foreach ( $crmpro_appointments as $crmpro_appointment ) {
					wp_delete_post( (int)$crmpro_appointment->ID, true );
				}
				
				
			}			
			
			if( get_option( 'crmerpbsdeleteSettings' ) ){

				$role = get_role( 'administrator' );
				$role->remove_cap( 'crm-erp-business-solution' );
				
				if( get_option( 'crmerpbsaccessRole' ) ) {
					
					$role = get_role( get_option( 'crmerpbsaccessRole' ) );
					$role->remove_cap( 'crm-erp-business-solution' );
				}
				
				foreach ( wp_load_alloptions() as $option => $value ) {
					
					if ( strpos( $option, 'crm-erp-business-solution' ) !== false && $option !== 'crmerpbs_deleteSettings' && $option !== 'crmerpbs_deleteTables' ) {				
						delete_option( $option );												
					}
					
					if (strpos( $option, "crmerpbs_transactions" ) !== false ) {						
						delete_option( $option );						
					}
					if (strpos( $option, "crmerpbs_documents" ) !== false ) {						
						delete_option( $option );						
					}	
				
				}
				
			}			
		}
		
		
		public function translate() {
			
	         load_plugin_textdomain( 'crm-erp-business-solution', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
			 
	    }
		
		public function BackEndScripts(){
			
			/*
			$screen = get_current_screen();
			if ( 'toplevel_page_crm-erp-business-solution'  !== $screen->base )
			return;
			*/
			wp_enqueue_style( "crmerpbs_adminCss", plugins_url( "/css/backend.css?v=12swfsds", __FILE__ ) );	
			wp_enqueue_style( "crmerpbs_adminCss" );	
				
			wp_enqueue_script( "crmerpbs_charts", plugins_url( "/js/chart.min.js", __FILE__ ), null, true );
			
			wp_enqueue_style( "crmerpbs_selectSearch", plugins_url( "/css/select2.min.css", __FILE__ ) );	
			wp_enqueue_style( "crmerpbs_selectSearch");

			wp_enqueue_style(  "crmerpbs_fullcalendar", plugins_url( "/css/fullcalendar.min.css", __FILE__ ) );	
			wp_enqueue_style(  "crmerpbs_fullcalendar");

			if( ! wp_script_is(  "crmerpbs__fa", 'enqueued' ) ) {
				wp_enqueue_style(  "crmerpbs__fa", plugins_url( '/css/font-awesome.min.css', __FILE__ ) );
			}
			wp_enqueue_script('jquery');
            wp_enqueue_script( 'jquery-ui-datepicker' ); // enqueue datepicker from WP
		    wp_enqueue_style( 'jquery-ui-style', plugins_url( "/css/jquery-ui.css", __FILE__ ), true );
			wp_enqueue_script( 'jquery-ui-core');
			wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_style( 'wp-color-picker' ); 
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-droppable' );			
			wp_enqueue_script( "crmerpbs_moment", plugins_url( "/js/moment.min.js", __FILE__ ),  null, true );
			wp_enqueue_script( "crmerpbs_fullcalendarjs", plugins_url( "/js/fullcalendar.min.js", __FILE__ ),  null, true );
					
			wp_enqueue_script( "crmerpbs_selectjs", plugins_url( "/js/select2.full.js", __FILE__ ), array('jquery') , null, true );	
			wp_enqueue_script( "crmerpbs_selectjs" );			
			
			wp_enqueue_script(  "crmerpbs_Js", plugins_url( "/js/backend.js?v=".uniqid() , __FILE__ ) , array( 'jquery','jquery-ui-tabs','jquery-ui-accordion','wp-color-picker','jquery-ui-datepicker','jquery-ui-draggable','jquery-ui-droppable' ) , null, true );	
			
								
			if( get_option(  "crmerpbs_enableAppointments" ) ) { 
				$apppointments = new CrmErpSolutionAppointments();
				$jsonevents = $apppointments->getEvents();
			}else $jsonevents = '';
				
			if( get_option( 'crmerpbs_defaultVat' ) ) {
				$vat = get_option( 'crmerpbs_defaultVat' );
			}else $vat = '';
				
			$this->localizeBackend = array( 
				'plugin_url' => plugins_url( '', __FILE__ ),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'siteUrl'	=>	site_url(),
				'plugin_wrapper'=> 'crm-erp-business-solution',
				'events'	=>	$jsonevents,
				'wooAddon'	=>	$this->wooAddon,
				'proAddon'	=>	$this->proAddon,
				'vat'	=>	sanitize_text_field( $vat ),
				'select'	=>	esc_html__( 'Select...', 'crm-erp-business-solution' ),
			);	
			
			wp_localize_script( "crmerpbs_Js", 'crmerpbs' , $this->localizeBackend );
			wp_enqueue_script( "crmerpbs_Js" );
			
			wp_enqueue_script( "crmerpbs_ajaxify", plugins_url( "/js/ajaxify.js?v=".uniqid() , __FILE__ ) , array( 'jquery' ) , null, true );	
			wp_enqueue_script( "crmerpbs_ajaxify" );			

		}
		


		public function SettingsPage(){
			
			add_menu_page( "CRM ERP", "CRM ERP" , 'crm-erp-business-solution' , 'crm-erp-business-solution', array( $this, 'init' ) , esc_url( plugins_url( 'images/menu.png' , __FILE__ ) ) , (int)$this->menuPosition );
			
			add_submenu_page( 'crm-erp-business-solution', esc_html__( "Settings", 'crm-erp-business-solution' ), esc_html__( "Settings", 'crm-erp-business-solution' ), 'crm-erp-business-solution', 'crm-erp-business-solution&tab=settings', esc_url( admin_url('page=crm-erp-business-solution&tab=settings') ) );	
		}		
		
		public function Links( $links ){
			
			$linkss = [];
			$linkss[] .=  '<a href="' . esc_url( admin_url( "admin.php?page=crm-erp-business-solution&tab=settings" ) ) . '"><i class="fa fa-cog"></i> '.esc_html__( "Settings", 'crm-erp-business-solution' ).'</a>';
			$linkss[] .=  '<a class="openIntro" href="' . esc_url( admin_url( "admin.php?page=crm-erp-business-solution&tab=settings" ) ) . '"><i class="fa fa-play"></i> '.esc_html__("Intro", 'crm-erp-business-solution' ).'</a>';
			return array_merge( $links, $linkss );
			
		}
			 
		public function init(){
				
			print "<div id='crmerpbs' class='crmerpbs' >";
				
					$this->adminHeader();
					$this->adminSettings();
					$this->adminFooter();
					
			print "</div>";
				
		}		

}

$CrmErpSolution = new CrmErpSolution();

if ( class_exists( 'CrmErpSolution' ) ) {
    register_uninstall_hook( __FILE__, 'CrmErpSolution::onUninstall' );
}