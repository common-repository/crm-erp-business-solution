<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CrmErpSolutionAppointments extends CRMUsers{
	

	public function __construct() {	
				
		if( get_option( "crmerpbs_enableAppointments" ) ) { 
					
			add_action( "init", array( $this,"Appointments" ) );
			add_action( "admin_init", array( $this,"init" ) );
			add_action( "admin_init", array( $this,"metaBox" ) );
			add_action( "save_post", array( $this,"saveFields" ) );
			add_action( 'admin_menu', array( $this,'menu_page') );
			add_filter( 'manage_crmerpbs_app_posts_columns', array( $this,'addColumnHeader' ) );		
			add_filter( "manage_crmerpbs_app_columns", array( $this,"column_order" ) );
			add_filter( 'manage_edit-crmerpbs_app_columns', array( $this,"column_order" ) );					
			add_filter( "manage_edit-crmerpbs_app_sortable_columns", array( $this,"addColumnHeader" ) );
			add_action( 'wp_ajax_addEvent', array( $this,'addEvent' ) );
			add_action( 'wp_ajax_nopriv_addEvent', array( $this,'addEvent' ) );	
			add_filter( 'post_updated_messages', array( $this, 'crmerpbs_app_cpt_messages' ) );
			
					
		}
		
	}
	
	public function init(){
		add_action( 'manage_crmerpbs_app_posts_custom_column', array( $this,'addAdColumns' ),10,2 );	
	}
				
	public function Appointments(){
		
		  register_post_type( 'crmerpbs_app',
			array(
			  'labels' => array(
				'name' => esc_html__( 'Appointments' , 'crm-erp-business-solution' ),
				'singular_name' => esc_html__( 'Appointment', 'crm-erp-business-solution' ),
				'search_items' =>  esc_html__( 'Search Appointments' , 'crm-erp-business-solution' ),
				'all_items' => esc_html__( 'All Appointments' , 'crm-erp-business-solution' ),
				'parent_item' => esc_html__( 'Parent Appointment', 'crm-erp-business-solution' ),
				'parent_item_colon' => esc_html__( 'Parent Appointment:', 'crm-erp-business-solution' ),
				'edit_item' => esc_html__( 'Edit Appointment', 'crm-erp-business-solution' ), 
				'update_item' => esc_html__( 'Update Appointment' , 'crm-erp-business-solution' ),
				'view_item' => esc_html__( 'View Appointment' , 'crm-erp-business-solution' ),
				'add_new_item' => esc_html__( 'Add New Appointment' , 'crm-erp-business-solution' ),
				'add_new'            => esc_html__( 'New Appointment', 'crm-erp-business-solution' ),
				'new_item_name' => esc_html__( 'New Appointment Name', 'crm-erp-business-solution' ),
				'new_item'           => esc_html__( 'New Appointment', 'crm-erp-business-solution' ),
				'menu_name' => esc_html__( 'Appointments', 'crm-erp-business-solution' ),
				'not_found' => esc_html__('No Appointments found', 'crm-erp-business-solution' ),
			
			  ),
			  'description' => esc_html__( 'Adding and editing my Appointments', 'crm-erp-business-solution' ),
			  'menu_icon'   => 'dashicons-calendar',
			  'supports' => array( 'title', 'editor' ),
				'show_in_rest'       => true,
				'rest_base'          => 'crmerpbs_app',
				'rest_controller_class' => 'WP_REST_Posts_Controller',	
				'capability_type' => 'page',
				'hierarchical' => false,
				'menu_position'      => null,
				'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
				'publicly_queryable' => true,  // you should be able to query it
				'show_ui' => true,  // you should be able to edit it in wp-admin
				'show_in_menu'       => false,
				'exclude_from_search' => true,  // you should exclude it from search results
				'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
				'has_archive' => false,  // it shouldn't have archive page
				'rewrite' => false,  // it shouldn't have rewrite rules
			)
		  );
	  
	}

	/**
	 * appointments CPT updates messages.
	 */
	 
	public function crmerpbs_app_cpt_messages( $messages ) {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages['crmerpbs_app'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => esc_html__( 'Appointment updated.', 'crm-erp-business-solution' ),
			2  => esc_html__( 'Custom field updated.', 'crm-erp-business-solution' ),
			3  => esc_html__( 'Custom field deleted.', 'crm-erp-business-solution' ),
			4  => esc_html__( 'Appointment updated.', 'crm-erp-business-solution' ),
			5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Offline Product restored to revision from %s', 'crm-erp-business-solution' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => esc_html__( 'Appointment published.', 'crm-erp-business-solution' ),
			7  => esc_html__( 'Appointment saved.', 'crm-erp-business-solution' ),
			8  => esc_html__( 'Appointment submitted.', 'crm-erp-business-solution' ),
			9  => sprintf(
				esc_html__( 'Appointment scheduled for: <strong>%1$s</strong>.', 'crm-erp-business-solution' ),
				date_i18n( esc_html__( 'M j, Y @ G:i', 'crm-erp-business-solution' ), strtotime( $post->post_date ) )
			),
			10 => esc_html__( 'Appointment draft updated.', 'crm-erp-business-solution' )
		);
		return $messages;
	}
	
	public function displayAppointments(){
		$args = array(
			'post_type'      => array( 'crmerpbs_app' ),
			'posts_per_page' => -1,
			'post_status'		 => 'publish'
		);

		$loop = new WP_Query( $args );
		
		while ( $loop->have_posts() ) : $loop->the_post();
			global $Appointment;
			global $post;
		endwhile;

		wp_reset_query();
	
	}

	public function metaBox( $post ){
		add_meta_box( "appInfo", esc_html__( 'Appointment Info', 'crm-erp-business-solution' ), array( $this, "fieldsCreate" ) , "crmerpbs_app", "side", "high" ); 
	}	

	public function getUsername( $id ){

		$user = get_user_by( 'id', sanitize_text_field( $id ) );
		if( $user ) return $user->user_login;	
	}
	
	public function fieldsCreate( $post ){
		global $post;
		$date = sanitize_text_field( get_post_meta( (int)$post->ID,  "crmerpbs_dateto" , true ) ) ;	
		$time = sanitize_text_field( get_post_meta( (int)$post->ID,  "crmerpbs_time" , true ) ) ;
		
		if( isset( $_REQUEST[ 'user' ] ) ) {
						
			$userR = get_user_by( "id", sanitize_text_field( $_REQUEST[ 'user' ] ) );
			if( $userR ){
				$tab = '';
				if ( in_array( 'crm_customer', (array) $userR->roles ) ) {
							$tab = 'customers';
				}elseif ( in_array( 'crm_vendor', (array) $userR->roles ) ) {
							$tab = 'vendors';
				}
				if( has_filter( "crmerpbs_get_user_role_by_id_for_usrtab" ) ){
					$tab = apply_filters( "crmerpbs_get_user_role_by_id_for_usrtab", (int)$_REQUEST[ 'user' ] ); 
				}
			}
			
			print "<p><b>".esc_html__( "For User: ", 'crm-erp-business-solution' ). "<a href='".esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_html( $tab ) ."&action=view&id=". (int)$_REQUEST[ 'user' ] ) )."' target='_blank'>". esc_attr( $userR->first_name. " " . $userR->last_name )."</a></b></p>";
			
		}else{
			$user = get_post_meta( (int)$post->ID,  "crmerpbs_user" , true ) ;	
			$userR = get_user_by( "id", (int)$user );
			if( $userR ){
				$tab = 'customers';
				if ( in_array( 'crm_customer', (array) $userR->roles ) ) {
							$tab = 'customers';
				}elseif ( in_array( 'crm_vendor', (array) $userR->roles ) ) {
							$tab = 'vendors';
				}
						
				if( has_filter(  "crmerpbs_get_user_role_by_id_for_usrtab" ) ){
					$tab = apply_filters(  "crmerpbs_get_user_role_by_id_for_usrtab", (int)$user ); 
				}
			}
			?> 
			<p> 
				<label>
					<strong>
						<?php esc_html_e( 'User', 'crm-erp-business-solution' ); ?> 
						<?php if( !empty( $user) ) print esc_html__( ' selected: ', 'crm-erp-business-solution' ) . "<a href='".esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_html( $tab ) ."&action=view&id=". (int)$user ) )."' target='_blank'>". esc_attr( $userR->first_name. " " . $userR->last_name )."</a>"; ?>
					</strong>
				</label>
			
				<select name='<?php print  "crmerpbs_user";?>' id='user'  >
					<?php if( !empty( $user) ) { ?>
						<option selected value='<?php print esc_attr( $user ); ?>'><?php print esc_attr( $this->getUsername( $user ) ); ?></option>
					<?php } ?>
						<?php 
							CRMUsers::get_instance()->query_users();
						
						?>
				</select>
			</p>
		    <?php			
		}		
			?> 
			<p>	
				<label><?php esc_html_e( 'Date' , 'crm-erp-business-solution' )?></label>
				<input type="text" required placeholder='dd/mm/yyyy' class="datepicker" name='<?php print  "crmerpbs_dateto";?>' value='<?php print esc_attr( $date ); ?>' />
			</p>
 
			<p>
				<label><?php esc_html_e( 'Time', 'crm-erp-business-solution' )?></label>
				<input required placeholder='<?php esc_html_e('time eg. 12:00', 'crm-erp-business-solution' )?>' name='<?php print "crmerpbs_time";?>' value='<?php print esc_attr( $time ); ?>' />
			</p>
			<?php	


		

	}

	
	public function saveFields(){
		
		if( is_admin() && current_user_can(  'crm-erp-business-solution' ) ) {
			
			global $post;
			
			if( isset( $post->ID ) && get_post_type( (int)$post->ID ) == 'crmerpbs_app' ){
			
	
				if( $_POST  ){
					if( get_option("userToAdd" ) ){
						update_post_meta( (int)$post->ID,  "crmerpbs_user", sanitize_text_field( get_option( "userToAdd" ) ) );
						//delete_option("userToAdd");
					}
				}
				
				if(isset( $_POST[ "crmerpbs_user"] ) ){
					if (!empty($_POST[ "crmerpbs_user" ]) ) {
						$user = sanitize_text_field( $_POST[ "crmerpbs_user" ] );
						 update_post_meta( (int)$post->ID, "crmerpbs_user", $user );	       
					}
				}		
				
				if( isset( $_POST[ 'crmerpbs_dateto' ] ) ){
					if ( !empty( $_POST[ 'crmerpbs_dateto' ] ) ) {
						$date = sanitize_text_field( $_POST[ 'crmerpbs_dateto' ] );
						 update_post_meta( (int)$post->ID, 'crmerpbs_dateto', $date );	       
					}
				}

				if( isset( $_POST[ 'crmerpbs_time' ] ) ){
					if ( !empty( $_POST[ 'crmerpbs_time' ] ) ) {
						$time = sanitize_text_field( $_POST[ 'crmerpbs_time' ] );
						 update_post_meta( (int)$post->ID, 'crmerpbs_time', $time );	       
					}
				}

			}
		
		}
		
	}
	
		public function addColumnHeader( $columns ) {
			
			$columns['DateTo']  = esc_html__( "Appointment Date", 'crm-erp-business-solution' );
			$columns['Time']  = esc_html__( "Appointment Time", 'crm-erp-business-solution' );
			$columns['User']  = esc_html__( "User", 'crm-erp-business-solution' );
			return $columns;

		}
		

		public function addAdColumns( $column_name, $post_id ) {
			
			global $post;
			
			if( $column_name == 'DateTo' ) {

				$date = get_post_meta( (int)$post_id, 'crmerpbs_dateto', true );
				if($date !='') {
					echo esc_html( $date );
				}
			}
			if( $column_name == 'Time' ) {
				$time = get_post_meta( (int)$post_id, 'crmerpbs_time', true );
				if($time !='') {
					echo esc_html( $time );
				}
			}
			if( $column_name == 'User' ) {
				$user = get_post_meta( (int)$post_id, 'crmerpbs_user', true );
				if($user != '' ) {
					$userR = get_user_by( "id", $user );
					
					if( $userR ){
						$tab = '';
						if ( in_array( 'crm_customer', (array) $userR->roles ) ) {
							$tab = 'customers';
						}elseif ( in_array( 'crm_vendor', (array) $userR->roles ) ) {
							$tab = 'vendors';
						}
						if( has_filter( "crmerpbs_get_user_role_by_id_for_usrtab" ) ){
							$tab = apply_filters( "crmerpbs_get_user_role_by_id_for_usrtab", (int)$user ); 
						}
						print "<a href='".esc_url( admin_url( "?page=crm-erp-business-solution&tab=".$tab."&action=view&id=".$user ) )."' target='_blank'>". esc_html( $userR->first_name. " " . $userR->last_name )."</a>";
						
					}else print esc_html__( "User with ID: ", 'crm-erp-business-solution' ). esc_html( $user ) . esc_html__( " do not exist", 'crm-erp-business-solution' );
				}
			}	
			
		}		
		public function column_order( $columns ) {
			
			unset( $columns );
			
			$columns = array(
				'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
				'title' => esc_html__('Title', 'crm-erp-business-solution' ),
				'DateTo' => esc_html__('Appointment Date', 'crm-erp-business-solution' ),
				'Time' => esc_html__('Appointment Time', 'crm-erp-business-solution' ),
				'User' => esc_html__('User', 'crm-erp-business-solution' ),
				'Date' => esc_html__('Date', 'crm-erp-business-solution' ),
			);			
			return $columns;
		}
		public function displayCalendar() {
			?>
			<style>

			#calendar {
				width: 60%;
				margin: 0 auto;
				background:#fff;
				padding:10px;
				display:none;
			}

			.response {
				height: 60px;
				display:none;
			}

			.success {
				background: #cdf3cd;
				padding: 10px 60px;
				border: #c3e6c3 1px solid;
				display: inline-block;
			}
			
			.calendar_toggler,.list_toggler{
				cursor:pointer;
				color:#0073aa;
				padding-right:10px;
			}
			
			.flex{
				display:flex;
				justify-content:flex-start;
			}
			.flex h3:first-child{
				border-right:3px solid #777;
			}
			.flex h3:last-child{
				padding-left:10px;
			}			
			</style>
			<div class='flex' >
		<h3 class='calendar_toggler' ><i class='fa fa-calendar'></i> <?php esc_html_e( "Calendar View", 'crm-erp-business-solution' ) ; ?></h3> 
			<h3 class='list_toggler' ><i class='fa fa-list'></i> <?php esc_html_e( "List View", 'crm-erp-business-solution' ) ; ?></h3>
			</div>
			<div class="response"></div>
			<div id='calendar'></div>			
			<?php
		}
		
		public function addEvent() {
			global $post;
			
			if ( isset( $_POST['nonce'] )  && wp_verify_nonce( $_POST[ 'nonce' ], 'addEvent' ) ) {	
			
				$dateto = sanitize_text_field( $_POST[ 'start' ] );
				$title = sanitize_text_field( $_POST[ 'title' ] );
				$args = array(
					'post_title' => $title,
					'post_type' => 'crmerpbs_app',
				);			
				$post_id = wp_insert_post( $args );
				add_post_meta( (int)$post_id, 'crmerpbs_dateto', $dateto );
				
			}
		}
		
		public function getEvents() {
			
			$json = array();
			$eventArray = array();
			$args = array(
				'post_type' => 'crmerpbs_app',
				'posts_per_page' => -1
			);			
			$query = new WP_Query( $args );
			$posts = $query->posts;
			
			foreach( $posts as $post ) {
				$user = get_post_meta( (int)$post->ID, 'crmerpbs_user', true );
				
				if( $user !='' ) {
					$user =  esc_html( $this->getUsername( $user ) );
				}
				$time = get_post_meta( (int)$post->ID, 'crmerpbs_time', true );
				
			  $eventArray[] = array(
				'title'   => sanitize_text_field( $post->post_title . " with ". $user. " @ ".$time ) ,
				'start'   => sanitize_text_field( get_post_meta( (int)$post->ID, 'crmerpbs_dateto',true ) ),
				'end'     => sanitize_text_field( get_post_meta( (int)$post->ID, 'crmerpbs_dateto',true ) ),
				);				
			}						 
			wp_reset_query();
			
			return json_encode( $eventArray );
		}	

		
		public function menu_page() {
		  add_submenu_page( 'crm-erp-business-solution', esc_html__( "Appointments", 'crm-erp-business-solution' ), esc_html__( "Appointments", 'crm-erp-business-solution' ), 'crm-erp-business-solution', 'edit.php?post_type=crmerpbs_app', NULL );
		}	
}

$CrmErpSolutionAppointments = new CrmErpSolutionAppointments();