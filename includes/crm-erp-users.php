<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class CrmErpSolutionUsers extends WP_List_Table {

    protected static $instance = NULL;

    public static function get_instance(){
		
        if ( NULL == self::$instance )
            self::$instance = new self;

        return self::$instance;
    }
	
    public function __construct(){

        parent::__construct(array(
            'singular' => 'user',
            'plural' => 'users',
			'ajax'     => true //does this table support ajax?
        ));
		
    }


    public function column_default( $item, $column_name ){
		 return $item->$column_name;
    }


    public function column_name( $item ){
		
		$nonce = wp_create_nonce( 'crmerpbs_users_nonce' );
		$tab = sanitize_text_field( $_REQUEST['tab'] );
			
        $actions = array(
			'view' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=view&id=%s&_wpnonce=%s" ) ) .'">%s</a>', esc_html( $tab ), (int)$item->ID,$nonce, esc_html__( 'View', 'crm-erp-business-solution' ) ),
            'edit' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=edit&id=%s&_wpnonce=%s" ) ) .'">%s</a>', esc_html( $tab ), (int)$item->ID,$nonce, esc_html__( 'Edit', 'crm-erp-business-solution' ) ),
            'delete' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=delete&id=%s&_wpnonce=%s" ) ) .'">%s</a>', esc_html( $tab ), (int)$item->ID, $nonce, esc_html__( 'Delete', 'crm-erp-business-solution' ) ),
        );

        return sprintf('%s %s',
            (int)$item->ID,
            $this->row_actions( $actions )
        );
		
    }


    public function column_cb( $item ){

		return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item->ID
        );	   

    }


    public function get_columns(){
		
		$columns1 = array(
			'cb' => '<input type="checkbox" />',
			'user_login' => esc_html__( 'User', 'crm-erp-business-solution' ),
			'user_email' => esc_html__( 'Email', 'crm-erp-business-solution' ),
			'vat' => esc_html__( 'VAT', 'crm-erp-business-solution' ),				
			'user_firstname' => esc_html__( 'First Name', 'crm-erp-business-solution' ),
			'user_lastname' => esc_html__( 'Last Name', 'crm-erp-business-solution' ),	
			'billing_country' => esc_html__( 'Country', 'crm-erp-business-solution' ),	
			'billing_phone' => esc_html__( 'Phone', 'crm-erp-business-solution' ),				
		);
		$columns2 = array(
			
			'total' => esc_html__( 'Totals', 'crm-erp-business-solution' )	
				
		);	
		
		if( has_filter( 'crmerpbs_user_columns' ) ) {
			
			$columns2 = apply_filters( 'crmerpbs_user_columns', $columns2 );
		}
		$columns = array_merge( $columns1, $columns2 );
		
		return $columns;
		
    }


    public function get_sortable_columns(){
		
        $sortable_columns = array(
            'ID' => array( 'ID', true ),
			'user_nicename' => array( 'user_nicename', true ),
			'user_email' => array( 'user_email', true ),
			'total' => array( 'total', true ),
        );
        return $sortable_columns;
    }

    public function get_bulk_actions(){
        $actions = array(
            'delete' => esc_html__( 'Delete', 'crm-erp-business-solution' ),	
        );
        return $actions;
    }


    public function process_bulk_action(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ){
			
			global $wpdb;
			$table_name = sanitize_text_field( $wpdb->prefix . 'users' ); // do not forget about tables prefix

			if ( 'delete' == $this->current_action() ) {
				
				if( is_array( $_REQUEST['id'] ) ) {
										
					$ids = array_map( 'intval',  $_REQUEST['id'] ) ;
					$idsToprint = implode( ',', array_map( 'intval', $ids ) );
					foreach( $ids as $id ){						
						$id = (int)$id;
						if( $id !='1' ) $wpdb->delete( $table_name, array( 'id' => $id ), array( '%d' ) );
					}
					$message = '<div class="notice updated below-h2 is-dismissible" id="message"><p>' . esc_html__( ' Users with Ids: ', 'crm-erp-business-solution' )  . esc_html( $idsToprint ) . esc_html__( ' were deleted', 'crm-erp-business-solution' )  . '</p></div>';
					if( isset( $message ) ) print wp_kses( $message, CrmErpSolution::get_instance()->allowed_html );
					
				}else {
					
					$id = (int)$_REQUEST['id'];
					if( $id !='1' ) $wpdb->delete( $table_name, array( 'id' => $id ), array( '%d' ) );
					$message = '<div class="notice updated below-h2 is-dismissible" id="message"><p>' .  esc_html__( ' User with Id: ', 'crm-erp-business-solution' )  . esc_html( $id ) . esc_html__( ' is deleted', 'crm-erp-business-solution' )  . '</p></div>';
					if( isset( $message ) ) print wp_kses( $message, CrmErpSolution::get_instance()->allowed_html );
					
				}
			}
		
		}
    }


	public function single_row_columns( $item ) {
				
       list( $columns, $hidden ) = $this->get_column_info();
	  
            foreach ( $columns as $column_name => $column_display_name ) {
                    $class = "class='".esc_attr( $column_name )." column-".esc_attr( $column_name )."' ";

                   $style = '';
                   if ( in_array( $column_name, $hidden ) )
                         $style = ' style="display:none;"';

                   $attributes = esc_attr( $class . $style );

				   $nonce = wp_create_nonce( 'crmerpbs_users_nonce' );
		
                   if ( 'cb' == $column_name ) {
					   
					   echo  "<th  class='check-column' scope='row'>";
					   echo sprintf( '<input type="checkbox" name="id[]" value="%s" />', (int)$item->ID );	
					   echo "</th>";
					   
                   }elseif ('user_login' == $column_name) {
					   
					   $tab = sanitize_text_field( $_REQUEST['tab'] );
					   $page = sanitize_text_field( $_REQUEST['tab'] );
					   
					  echo "<td ". esc_attr( $attributes ) ." >";
					   echo '<span>', esc_attr( $item->user_login );
					   echo "</span>";

						echo "<div class='row-actions'>";
						echo "<span class='view'>";
						
						echo sprintf( '<a target="blank" href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=view&id=%s&_wpnonce=%s" ) ) .'" >%s</a>', esc_attr( $tab ), (int)$item->ID, $nonce, esc_html__( 'View', 'crm-erp-business-solution' ) );						
						echo "</span> | <span class='edit'>";
						echo sprintf( '<a target="blank"  href="'. esc_url( admin_url( "user-edit.php?user_id=%s&_wpnonce=%s" ) ) .'" >%s</a>', (int)$item->ID, $nonce, esc_html__('Edit', 'crm-erp-business-solution' ) );
						echo "</span> | <span class='trash'>";
						echo sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=delete&id=%s&_wpnonce=%s" ) ) .'" >%s</a>',  esc_attr( $tab ), (int)$item->ID, $nonce, esc_html__('Delete', 'crm-erp-business-solution' ) );
						
						echo "</span></div></td>";
					
					}elseif ( 'user_segment' == $column_name ) {
						
						 echo "<td ". esc_attr( $attributes ) ." >";
	
							if( has_filter( 'crmerpbs_user_segment' ) ) {
								
								$outcome = apply_filters( 'crmerpbs_user_segment', (int)$item->ID );
								echo '<span>', esc_html( $outcome );
								echo "</span>";	
								
							}
	
							
					}elseif ( 'discount' == $column_name ) {
						 echo "<td ". esc_attr( $attributes ) ." >";
	
							if( has_filter( 'crmerpbs_user_discount' ) ) {
								$outcome = apply_filters( 'crmerpbs_user_discount', (int)$item->ID );
								echo '<span>', esc_html( $outcome );
								echo "</span>";									
							}
						
					}elseif ( 'role' == $column_name ) {
						 echo "<td ". esc_attr( $attributes ) ." >";
	
							if( has_filter( 'crmerpbs_user_role' ) ) {
								$outcome = apply_filters( 'crmerpbs_user_role', (int)$item->ID );
								echo '<span>', esc_html( $outcome );
								echo "</span>";									
							}
							
					}elseif ( 'billing_country' == $column_name ) {
					  echo "<td ". esc_attr( $attributes ) ." >";
					   $crmusers = new CRMUsers();
					   echo '<span>', array_search( $item->billing_country , $crmusers->countrycodes );
					   echo "</span>";						 
					
					
					}elseif ( 'total' == $column_name ) {
					   echo "<td ". esc_attr( $attributes ) ." >";
						
						ob_start();
						do_action( 'crmerpbs_get_customer_totals', (int)$item->ID );
						$get_customer_total_order = ob_get_contents();
						ob_end_clean();
						echo '<span>',  wp_kses( $get_customer_total_order, CrmErpSolution::get_instance()->allowed_html );			
					    echo "</span>";

                    }else {
						echo "<td ". esc_attr( $attributes ) ." >";
						echo $this->column_default( $item, $column_name );
						echo "</td>";
					} 
			} 
	} 
	
	
    public function prepare_items(){
		
        global $wpdb;
		
        $per_page = 20; // constant, how much records will be shown per page
		if(isset($_REQUEST['paged'])){
			$current_page = sanitize_text_field( $_REQUEST['paged'] );
		}else  $current_page = get_query_var('paged') ? (int) get_query_var('paged') : 1;

		$columns =  $this->get_columns();
		
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array( $columns, $hidden, $sortable );

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();


        // prepare query params, as usual current page, order by and order direction
        $paged = isset( $_REQUEST['paged'] ) ? ( $per_page * max( 0, intval( $_REQUEST['paged'] ) - 1)) : 0;
        $orderby = ( isset( $_REQUEST['orderby'] ) && in_array( $_REQUEST['orderby'], array_keys( $this->get_sortable_columns() ) ) ) ? sanitize_text_feld( $_REQUEST['orderby'] ) : 'id';
        $order = ( isset( $_REQUEST['order'] ) && in_array( $_REQUEST['order'], array( 'asc', 'desc' ) ) ) ? sanitize_text_feld( $_REQUEST['order'] ) : 'DESC';
		
        // will be used in pagination settings
		
		if( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'customers' ){
			$role = array( 'crm_customer' );	
			if( has_filter( 'crmerpbs_dif_user_role' ) ) {
				$role = apply_filters( 'crmerpbs_dif_user_role', $role );
			}
		}else $role = array( 'crm_vendor' );
		
		$total_items = new WP_User_Query( array( 'role__in' => $role  ) );
		$total_items = (int) $total_items->get_total();
		
		$meta_query = array();
			

		if( isset( $_REQUEST['vat'] ) && !empty( $_REQUEST['vat'] )){
			$vat = sanitize_text_field( $_REQUEST['vat'] );
		}

		
		if( isset( $_REQUEST['searchterm'] ) && !empty( $_REQUEST['searchterm'] )){
			$yoursearchquery = sanitize_text_field( $_REQUEST['searchterm'] );
		}else{
			$yoursearchquery = '';
		}
		if( isset( $_REQUEST['useremail'] ) && !empty( $_REQUEST['useremail'] )){
			$user = get_user_by( 'email', sanitize_email( $_REQUEST['useremail'] ) );	
		}

		if( isset( $_REQUEST['selectUsersHidden'] ) && !empty( $_REQUEST['selectUsersHidden'] )){
			$users = explode( ",", $_REQUEST['selectUsersHidden'] );
			$users = array_map( 'sanitize_text_field', $users );			
		}else $users = '';
		
		
		
			if( isset( $user ) ){
				$args  = array(

					'include'		=> (int)$user->ID,
					'role__in'      => $role,
					'paged' => (int)$current_page, // What page to get, starting from 1.
					'number' => (int)$per_page, // How many per page,
				);	
			}elseif( isset( $vat ) ){
				$args = array(  
						'meta_key'     => 'vat',
						'meta_value'   => $vat,
				);	
				
		
			}else{
				$args  = array(
					'role__in'  => $role ,
					'paged' 	=> (int)$current_page, // What page to get, starting from 1.
					'number' 	=> (int)$per_page, // How many per page,
					'search' 	=> $yoursearchquery,
					"include" 	=> $users,
				);				
			}

			if( has_filter( 'crmerpbs_query_the_user_list' ) ) {
				$args = apply_filters( 'crmerpbs_query_the_user_list', $args );
			}
			$wp_user_query = new WP_User_Query( $args );				
			$this->items = $wp_user_query->get_results();
				
		

				
        // [REQUIRED] configure pagination
        $this->set_pagination_args( array(
            'total_items' 	=> (int)$total_items, // total items defined above
            'per_page' 		=> (int)$per_page, // per page constant defined at top of method
            'total_pages' 	=> ceil( $total_items / $per_page ) // calculate pages count
        ));
    }


}


class CRMUsers{


	public $countrycodes = array("Afghanistan"=>"AF","Åland Islands"=>"AX","Albania"=>"AL","Algeria"=>"DZ","American Samoa"=>"AS","Andorra"=>"AD","Angola"=>"AO","Anguilla"=>"AI","Antarctica"=>"AQ","Antigua and Barbuda"=>"AG","Argentina"=>"AR","Armenia"=>"AM","Aruba"=>"AW","Australia"=>"AU","Austria"=>"AT","Azerbaijan"=>"AZ","Bahrain"=>"BH","Bahamas"=>"BS","Bangladesh"=>"BD","Barbados"=>"BB","Belarus"=>"BY","Belgium"=>"BE","Belize"=>"BZ","Benin"=>"BJ","Bermuda"=>"BM","Bhutan"=>"BT","Bolivia, Plurinational State of"=>"BO","Bonaire, Sint Eustatius and Saba"=>"BQ","Bosnia and Herzegovina"=>"BA","Botswana"=>"BW","Bouvet Island"=>"BV","Brazil"=>"BR","British Indian Ocean Territory"=>"IO","Brunei Darussalam"=>"BN","Bulgaria"=>"BG","Burkina Faso"=>"BF","Burundi"=>"BI","Cambodia"=>"KH","Cameroon"=>"CM","Canada"=>"CA","Cape Verde"=>"CV","Cayman Islands"=>"KY","Central African Republic"=>"CF","Chad"=>"TD","Chile"=>"CL","China"=>"CN","Christmas Island"=>"CX","Cocos (Keeling) Islands"=>"CC","Colombia"=>"CO","Comoros"=>"KM","Congo"=>"CG","Congo, the Democratic Republic of the"=>"CD","Cook Islands"=>"CK","Costa Rica"=>"CR","Côte d'Ivoire"=>"CI","Croatia"=>"HR","Cuba"=>"CU","Curaçao"=>"CW","Cyprus"=>"CY","Czech Republic"=>"CZ","Denmark"=>"DK","Djibouti"=>"DJ","Dominica"=>"DM","Dominican Republic"=>"DO","Ecuador"=>"EC","Egypt"=>"EG","El Salvador"=>"SV","Equatorial Guinea"=>"GQ","Eritrea"=>"ER","Estonia"=>"EE","Ethiopia"=>"ET","Falkland Islands (Malvinas)"=>"FK","Faroe Islands"=>"FO","Fiji"=>"FJ","Finland"=>"FI","France"=>"FR","French Guiana"=>"GF","French Polynesia"=>"PF","French Southern Territories"=>"TF","Gabon"=>"GA","Gambia"=>"GM","Georgia"=>"GE","Germany"=>"DE","Ghana"=>"GH","Gibraltar"=>"GI","Greece"=>"GR","Greenland"=>"GL","Grenada"=>"GD","Guadeloupe"=>"GP","Guam"=>"GU","Guatemala"=>"GT","Guernsey"=>"GG","Guinea"=>"GN","Guinea-Bissau"=>"GW","Guyana"=>"GY","Haiti"=>"HT","Heard Island and McDonald Islands"=>"HM","Holy See (Vatican City State)"=>"VA","Honduras"=>"HN","Hong Kong"=>"HK","Hungary"=>"HU","Iceland"=>"IS","India"=>"IN","Indonesia"=>"ID","Iran, Islamic Republic of"=>"IR","Iraq"=>"IQ","Ireland"=>"IE","Isle of Man"=>"IM","Israel"=>"IL","Italy"=>"IT","Jamaica"=>"JM","Japan"=>"JP","Jersey"=>"JE","Jordan"=>"JO","Kazakhstan"=>"KZ","Kenya"=>"KE","Kiribati"=>"KI","Korea, Democratic People's Republic of"=>"KP","Korea, Republic of"=>"KR","Kuwait"=>"KW","Kyrgyzstan"=>"KG","Lao People's Democratic Republic"=>"LA","Latvia"=>"LV","Lebanon"=>"LB","Lesotho"=>"LS","Liberia"=>"LR","Libya"=>"LY","Liechtenstein"=>"LI","Lithuania"=>"LT","Luxembourg"=>"LU","Macao"=>"MO","Macedonia, the Former Yugoslav Republic of"=>"MK","Madagascar"=>"MG","Malawi"=>"MW","Malaysia"=>"MY","Maldives"=>"MV","Mali"=>"ML","Malta"=>"MT","Marshall Islands"=>"MH","Martinique"=>"MQ","Mauritania"=>"MR","Mauritius"=>"MU","Mayotte"=>"YT","Mexico"=>"MX","Micronesia, Federated States of"=>"FM","Moldova, Republic of"=>"MD","Monaco"=>"MC","Mongolia"=>"MN","Montenegro"=>"ME","Montserrat"=>"MS","Morocco"=>"MA","Mozambique"=>"MZ","Myanmar"=>"MM","Namibia"=>"NA","Nauru"=>"NR","Nepal"=>"NP","Netherlands"=>"NL","New Caledonia"=>"NC","New Zealand"=>"NZ","Nicaragua"=>"NI","Niger"=>"NE","Nigeria"=>"NG","Niue"=>"NU","Norfolk Island"=>"NF","Northern Mariana Islands"=>"MP","Norway"=>"NO","Oman"=>"OM","Pakistan"=>"PK","Palau"=>"PW","Palestine, State of"=>"PS","Panama"=>"PA","Papua New Guinea"=>"PG","Paraguay"=>"PY","Peru"=>"PE","Philippines"=>"PH","Pitcairn"=>"PN","Poland"=>"PL","Portugal"=>"PT","Puerto Rico"=>"PR","Qatar"=>"QA","Réunion"=>"RE","Romania"=>"RO","Russian Federation"=>"RU","Rwanda"=>"RW","Saint Barthélemy"=>"BL","Saint Helena, Ascension and Tristan da Cunha"=>"SH","Saint Kitts and Nevis"=>"KN","Saint Lucia"=>"LC","Saint Martin (French part)"=>"MF","Saint Pierre and Miquelon"=>"PM","Saint Vincent and the Grenadines"=>"VC","Samoa"=>"WS","San Marino"=>"SM","Sao Tome and Principe"=>"ST","Saudi Arabia"=>"SA","Senegal"=>"SN","Serbia"=>"RS","Seychelles"=>"SC","Sierra Leone"=>"SL","Singapore"=>"SG","Sint Maarten (Dutch part)"=>"SX","Slovakia"=>"SK","Slovenia"=>"SI","Solomon Islands"=>"SB","Somalia"=>"SO","South Africa"=>"ZA","South Georgia and the South Sandwich Islands"=>"GS","South Sudan"=>"SS","Spain"=>"ES","Sri Lanka"=>"LK","Sudan"=>"SD","Suriname"=>"SR","Svalbard and Jan Mayen"=>"SJ","Swaziland"=>"SZ","Sweden"=>"SE","Switzerland"=>"CH","Syrian Arab Republic"=>"SY","Taiwan, Province of China"=>"TW","Tajikistan"=>"TJ","Tanzania, United Republic of"=>"TZ","Thailand"=>"TH","Timor-Leste"=>"TL","Togo"=>"TG","Tokelau"=>"TK","Tonga"=>"TO","Trinidad and Tobago"=>"TT","Tunisia"=>"TN","Turkey"=>"TR","Turkmenistan"=>"TM","Turks and Caicos Islands"=>"TC","Tuvalu"=>"TV","Uganda"=>"UG","Ukraine"=>"UA","United Arab Emirates"=>"AE","United Kingdom"=>"GB","United States"=>"US","United States Minor Outlying Islands"=>"UM","Uruguay"=>"UY","Uzbekistan"=>"UZ","Vanuatu"=>"VU","Venezuela, Bolivarian Republic of"=>"VE","Viet Nam"=>"VN","Virgin Islands, British"=>"VG","Virgin Islands, U.S."=>"VI","Wallis and Futuna"=>"WF","Western Sahara"=>"EH","Yemen"=>"YE","Zambia"=>"ZM","Zimbabwe"=>"ZW");


    protected static $instance = NULL;

    public static function get_instance(){
		
        if ( NULL == self::$instance )
            self::$instance = new self;

        return self::$instance;
    }
	
	public function __construct() {	
	
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'init' ) );	
		add_filter( 'crmerpbs_user_columns', array( $this, 'extra_columns' ), 10, 1 );				
		add_action( 'show_user_profile', array( $this, 'userFieldsAdd' ) );
		add_action( 'edit_user_profile', array($this, 'userFieldsAdd' ) );		
		add_action( 'crmerpbs_extraUserFields' , array( $this, 'extraUserFields' ), 10, 1 );		
		add_action( 'personal_options_update', array( $this, 'updateUserFields' ) );    
		add_action( 'edit_user_profile_update', array( $this, 'updateUserFields' ) );
		add_action( 'admin_footer', array( $this, 'ajaxEvent') );
		add_action( 'wp_ajax_queryUsers', array( $this, 'queryUsers' ) );		
		add_action( 'crmerpbs_queryUsers', array( $this, 'queryUsers' ) );
		add_action( 'wp_ajax_nopriv_getUsers', array( $this, 'query_users' ) );
		add_action( 'wp_ajax_getUsers', array( $this, 'query_users') );	
		add_action( 'wp_ajax_nopriv_getCustomers', array( $this, 'query_customers') );
		add_action( 'wp_ajax_getCustomers', array( $this, 'query_customers' ) );	
		add_action( 'wp_ajax_nopriv_getVendors', array( $this, 'query_vendors') );
		add_action( 'wp_ajax_getVendors', array( $this, 'query_vendors') );	
		add_action( 'crmerpbs_user_tickets' ,  array( $this, 'getTicketsbyUser' ),10,1 );
		add_action( 'crmerpbs_user_actions' ,  array( $this, 'getActionsbyUser' ),10,1 );
		add_action( 'crmerpbs_user_emails' ,  array( $this, 'getEmailsbyUser' ),10,1 );
		add_action( 'crmerpbs_user_orders' ,  array( $this, 'getOrdersByCustomer' ),10,1 );		
		add_action( 'crmerpbs_get_customer_total_order' ,  array( $this, 'get_customer_total_order' ),10,1 );
		add_action( 'crmerpbs_get_customer_total_order_count' ,  array( $this, 'get_customer_total_order_count' ),10,1 );
		add_action( 'crmerpbs_getTicketsCountbyUser' ,  array( $this, 'getTicketsCountbyUser' ),10,1 );
		add_action( 'crmerpbs_getTransactionProductsbyUser' ,  array( $this, 'getTransactionProductsbyUser' ),10,1 );		
		add_action( "crmerpbs_extraFilters", array( $this, 'extraFilters' ) );		
		add_action( "crmerpbs_someMoreFields", array( $this, 'someMoreFields' ),20 );	
		
		
		//add new roles for CRM ERP use
		add_role(
			'crm_vendor',
			__( 'CRM-ERP Vendor' ),
			array(
				'read'         => false,  // true allows this capability
				'edit_posts'   => false,
			)
		);
		

		add_role(
			'crm_customer',
			__( 'CRM-ERP Customer' ),
			array(
				'read'         => false,  // true allows this capability
				'edit_posts'   => false,
			)
		);
		
		add_action( 'crmerpbs_userListColumns', array( $this, 'userListColumns' ) );		
		add_action( "crmerpbs_addNew", array( $this, 'addNew' ), 10 );

	}
	
	public function init(){
		
		add_action( 'crmerpbs_get_customer_totals' , array( $this, 'get_customer_totals' ), 10, 1 );
		
	}
	

	public function menu_page(){

		add_submenu_page( "crm-erp-business-solution", esc_html__( "Customers", 'crm-erp-business-solution' ),  esc_html__( "Customers", 'crm-erp-business-solution' ) , 'crm-erp-business-solution','crm-erp-business-solution&tab=customers', array( $this, 'listView' )  );
		add_submenu_page( "crm-erp-business-solution", esc_html__( "Vendors", 'crm-erp-business-solution' ),  esc_html__( "Vendors", 'crm-erp-business-solution' ) , 'crm-erp-business-solution','crm-erp-business-solution&tab=vendors', array( $this, 'listView' )  );
		
	}



	public function extra_columns( $columns ) {
		
		$extra_column = array(
			'user_segment' => esc_html__( 'Segment', 'crm-erp-business-solution' ) . " - <br/>" . CrmErpSolution::get_instance()->proAddon(),
			'discount' => esc_html__( 'Discount', 'crm-erp-business-solution' ) . " - <br/>" . CrmErpSolution::get_instance()->proAddon(),
		);
	 
		// combine the two arrays
		$columns = array_merge( $extra_column, $columns );
	 
		return $columns;
	}	
	
	public function get_customer_totals( $id ){
				

				ob_start();
				do_action( 'crmerpbs_get_customer_total_order', $id );
				$get_customer_total_order = ob_get_contents();
			
				$outcome = '';
				
				$number  = floatval(  $this->getTransactionTotalbyUser( $id ) );
				$number2  = floatval( $get_customer_total_order );
				
				if( floatval( $this->getTransactionTotalbyUser( $id )) + floatval( $get_customer_total_order ) != 0 ){
					$color1 = 'green';
				}else $color1 = '';
				
				if( $this->getTransactionOwnedbyUser( $id ) !='0' ){
					$number3  = floatval(  $this->getTransactionOwnedbyUser( $id ) );
					$color2 = 'red';
				}else $color2 = '';
						   
						  
				if( $_REQUEST['tab'] =='customers' ){
																		
						if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
								
							if(  $number <> 0 ) $outcome .=  "<span><i class='fa fa-bar-chart'></i> ".esc_html__( 'Paid: ', 'crm-erp-business-solution' )."<i style='color:".esc_attr( $color1 ).";font-weight:bold'>". esc_html( crm_price( $number ) ) ."</i></span><br/>";
									
							if( $get_customer_total_order <> 0 )  $outcome .= "<span><i class='fa fa-shopping-cart'></i> ".esc_html__( 'Eshop orders: ', 'crm-erp-business-solution' )."<i style='color:".esc_attr( $color1 ).";font-weight:bold'>".esc_html( crm_price( $get_customer_total_order ) ) . "</span><br/>";
									
							if(  $number3 <> 0 ) $outcome .= "<span><i class='fa fa-money'></i> ".esc_html__( 'Owns: ', 'crm-erp-business-solution' ). "<i style='color:".esc_attr( $color2 ).";font-weight:bold'>". esc_html( crm_price( $number3 ) ). "</i></span>";							
						}else{
							if(  $number <> 0 ) $outcome .= "<span>".esc_html__( 'Paid: ', 'crm-erp-business-solution' )."<i style='color:".esc_attr( $color1 ).";font-weight:bold'>". esc_attr( crm_price( $number ) ). "</i></span><br/>";							
							if(  $numbe3 <> 0 ) $outcome .=  "<span >".esc_html__( 'Owns: ', 'crm-erp-business-solution' ). "<i style='color:".esc_attr( $color2 ).";font-weight:bold'>". esc_html( crm_price( $number3 ) ) . "</i></span>";								
						}

				}else{

					if(  $number <> 0 ) $outcome .= "<span>".esc_html__( 'You Paid: ', 'crm-erp-business-solution' )."<i style='color:".esc_attr( $color1 )."'>". esc_attr( crm_price( $number ) ) . "</i></span><br/>";
					
					if(  $number3 <> 0 ) $outcome .= "<span>".esc_html__( 'You own: ', 'crm-erp-business-solution' )."<i style='color:".esc_attr( $color2 ). ";font-weight:bold'>". crm_price( $number3 ). "</i></span>";					   
				}	
	
			ob_end_clean();	
			
			print wp_kses( $outcome, CrmErpSolution::get_instance()->allowed_html );
	}
	
	
	public function listView(){
		
		global $wpdb;
		
		$CrmUsers = new CrmErpSolutionUsers();
		$CrmUsers->prepare_items();

		$message = '';

		if( isset( $_REQUEST['tab'] ) ) $tab = sanitize_text_field( $_REQUEST['tab'] );
		if( isset( $_REQUEST['useremail'] ) ) $useremail = sanitize_text_field( $_REQUEST['useremail'] );
		if( isset( $_REQUEST['vat'] ) ) $vat = sanitize_text_field( $_REQUEST['vat'] );
		if( isset( $_REQUEST['searchterm'] ) ) $searchterm = sanitize_text_field( $_REQUEST['searchterm'] );
		if( isset( $_REQUEST['page'] ) ) $page = sanitize_text_field( $_REQUEST['page'] );
		?>
		<div class="wrap">

			<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
			
			<?php if ( isset( $_REQUEST['tab'] ) &&  $_REQUEST['tab'] =='customers' ){ ?>
			
				<h2><?php esc_html_e( 'Customers', 'crm-erp-business-solution' )?> <a class="add-new-h2 button-primary" href="<?php echo esc_url( admin_url("?page=crm-erp-business-solution&tab=". esc_attr( $tab )."&action=new"  ) );?>" ><?php esc_html_e( 'Add new', 'crm-erp-business-solution' )?> <i class='fa fa-plus'></i></a>
				</h2>
				
			<?php }elseif( isset( $_REQUEST['tab'] ) &&  $_REQUEST['tab'] == 'vendors') { ?>
			
				<h2><?php esc_html_e('Vendors', 'crm-erp-business-solution' )?> <a class="add-new-h2 button-primary" href="<?php echo esc_url( admin_url("?page=crm-erp-business-solution&tab=". esc_attr( $tab )."&action=new" ) ); ?>" ><?php esc_html_e( 'Add new', 'crm-erp-business-solution' )?> <i class='fa fa-plus'></i></a>
				</h2>
				
			<?php } ?>	
			
			<?php echo  wp_kses( $message , CrmErpSolution::get_instance()->allowed_html ); ?>

			<form id="users-table" method="post" class='ajaxify' >
			
				<div class='filtersList'>
						
					<span><input id="useremail" name="useremail" type="text" style="width: 100%"  value="<?php if( isset( $_REQUEST['useremail'] ) ) print esc_attr( $useremail ); ?>" placeholder="<?php esc_html_e( 'Search by Email ', 'crm-erp-business-solution' )?>" ></span>

					<span><input id="vat" name="vat" type="text" style="width: 100%" value="<?php if( isset( $_REQUEST['vat'] ) ) print esc_attr( $vat ); ?>"   placeholder="<?php esc_html_e( 'Search by Vat', 'crm-erp-business-solution' )?>" ></span>
						
					<?php do_action( 'crmerpbs_extraFilters' ); ?>
						
					<span><input id="searchterm" name="searchterm" style="width: 100%" type="text" value="<?php if( isset( $_REQUEST['searchterm'] ) ) print esc_attr( $searchterm ); ?>"  placeholder="<?php esc_html_e( 'Search..', 'crm-erp-business-solution' )?>" ></span>
											
				</div>				
				
				<input type="hidden" name="page" value="<?php if( isset( $_REQUEST['page'] ) ) print esc_attr( $page ); ?>"/>
				<?php $CrmUsers->display() ?>
			</form>

		</div>
	<?php
	}


	public function extraFilters(){ ?>
	
		<span>
			<select class='email_select_user'>
				<option value=''><?php esc_html_e( "select users by..", 'crm-erp-business-solution' ); ?></option>
				<option disabled class='proVersion' ><?php esc_html_e( "User Segment - PRO", 'crm-erp-business-solution' ); ?></option>
				<option value='product'><?php esc_html_e( "that bought a product", 'crm-erp-business-solution' ); ?></option>
				<option value='nosales'><?php esc_html_e( "with no transactions", 'crm-erp-business-solution' ); ?></option>
			</select>
									
		</span>
		
		<textarea style='display:none' name='selectUsersHidden' class='selectUsersHidden' ><?php do_action( 'crmerpbs_queryUsers' ); ?></textarea>
		
		<i class=" user_selection products">		
						
			<select id='user_product' name='product' class=" toSelect">
				<option value=''><?php esc_html_e( "Select product", 'crm-erp-business-solution' ); ?></option>
				<?php if( class_exists( 'CrmErpSolutionProducts' ) ){ ?>
					<?php 
					$prod = new CrmErpSolutionProducts();
					$prod->displaySoldProducts();
					?>
				<?php } ?>
			</select>
		</i>						
					
		<?php
	}
	
	
	public function addNew(){
		
		$message = '';
		$notice = '';
		$id = '';

		// here we are verifying does this request is post back and have correct nonce
		if ( is_admin() && current_user_can( 'crm-erp-business-solution' ) && isset( $_REQUEST['nonce'] ) && wp_verify_nonce( $_REQUEST['nonce'], basename(__FILE__) ) ) {
			
			 
			if( isset( $_POST['email'] ) && null == email_exists( $_POST['email'] ) ) {
			
				$email = sanitize_email( $_POST['email'] );

				// Generate the password and create the user
				if( is_email( $email ) ){

					if( isset( $_POST[ 'vat' ] ) && $this->checkExistingVat( $_POST[ 'vat' ] ) == '' ){
							
						$password = wp_generate_password( 12, false );
						$id = wp_create_user( $email, $password, $email );
						
						// Set the role
						$user = new WP_User( $id );
						if (isset( $_REQUEST['tab'] ) &&  $_REQUEST['tab'] == 'customers' ){ 
							$user->set_role( 'crm_customer'  );
						}elseif ( isset( $_REQUEST['tab'] ) &&  $_REQUEST['tab'] == 'vendors' ){
							$user->set_role( 'crm_vendor'  );
						}

						$message = esc_html__( 'User was successfully saved', 'crm-erp-business-solution' );
							 
					}else $notice = esc_html__( 'Vat already exists', 'crm-erp-business-solution' );
						
			  
				}else $notice = esc_html__( 'You need to enter a correct email address', 'crm-erp-business-solution' );
				 				  
			}else{
				
				$email = sanitize_email( $_POST['email'] );
				$user = get_user_by( 'email', $email );
				$id = $user->ID;
									
				
				// end if	
				 $message = esc_html__( 'User already exists - updated', 'crm-erp-business-solution' );
				 
			}
		
		}
		
		if( $id == '' ){
		
			$this->addnewUserForm( $notice , $message );
			
		}else {
			
			$userFields = array( 'email', 'description', 'first_name', 'last_name', 'vat', 'billing_phone', 'billing_company', 'billing_country', 'billing_address_1', 'billing_city', 'billing_postcode' , 'facebook' , 'instagram' );	
			
			if( has_filter( 'crmerpbs_user_fields_to_update' ) ) {
				$userFields = apply_filters( "crmerpbs_user_fields_to_update" , $userFields );
			}	
			
			foreach( $userFields as $field ){
				
				if( isset( $_POST[ $field ] ) ) {
					
					if( $_POST[ $field ] == 'vat' ){
						
						if( $this->checkExistingVat( $_POST[ 'vat' ] ) == '' ){
							 update_user_meta( $id, $field , sanitize_text_field( $_POST[ 'vat' ] ) );
						}
						
					}else update_user_meta( $id, $field , sanitize_text_field( $_POST[ $field ] ) );
					
					
				}
			}
			
			if ( !empty( $notice ) ): ?>
				<div id="notice" class="error"><p><?php echo esc_html( $notice ) ?></p></div>
			<?php endif;?>
			<?php if ( !empty( $message ) ): ?>
				<div id="message" class="updated"><p><?php echo esc_html( $message ) ?></p></div>
			<?php endif;
			
			$this->view( $id );
			
		}

	}

	public function checkExistingVat( $vat ){

			global $wpdb;
			$vat = sanitize_text_field( $vat );
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM ".sanitize_text_field( $wpdb->prefix . 'usermeta' )." WHERE meta_key =%s AND meta_value=%s ", 'vat', $vat ) );
			
			if( !empty( $cc ) ) {
				return '1';	
			
			}else return "";
	}
	
	public function addnewUserForm( $notice , $message ){
		?>
		<div class="wrap ">
			<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
			
			<?php if ( isset( $_REQUEST['tab'] ) &&  $_REQUEST['tab'] == 'customers' ){ ?>
			<h2><?php esc_html_e( 'Customer', 'crm-erp-business-solution' )?> 
				<a class="add-new-h2" href="<?php echo esc_url( admin_url( "?page=crm-erp-business-solution&tab=customers" ) ); ?>" >
					<i class='fa fa-angle-double-left '></i> <?php esc_html_e( 'back to list', 'crm-erp-business-solution' )?>
				</a>
			</h2>
			<?php }elseif( isset( $_REQUEST['tab']) &&  $_REQUEST['tab'] =='vendors') { ?>
			<h2><?php esc_html_e( 'Vendor', 'crm-erp-business-solution' )?> 
				<a class="add-new-h2" href="<?php echo esc_url( admin_url( "?page=crm-erp-business-solution&tab=vendors" ) ); ?>" >
					<i class='fa fa-angle-double-left '></i> <?php esc_html_e('back to list', 'crm-erp-business-solution' )?>
				</a>
			</h2>	
			<?php } ?>
			
			<?php if ( !empty( $notice ) ): ?>
				<div id="notice" class="error"><p><?php echo esc_html( $notice ) ?></p></div>
			<?php endif;?>
			<?php if ( !empty( $message ) ): ?>
				<div id="message" class="updated"><p><?php echo esc_html( $message ) ?></p></div>
			<?php endif;?>

			<form id="form" method="POST">
	
				<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( basename(__FILE__) )?>" />
				<!--<input type="hidden" name="id" value="<?php// echo esc_attr( $item['id'] ) ?>" />-->

				<div class="metabox-holder" id="crmusers_add">
					<div id="post-body">
						<div id="post-body-content">
							<?php $this->fieldsNew(); ?>
							<input type="submit" value="<?php esc_html_e( 'Save', 'crm-erp-business-solution' )?>" id="submit" class="button-primary" name="submit">
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php		
	}

	public function fieldsNew(){
		
		do_action( 'crmerpbs_someMoreFields' ) ; ?>
		
		<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
			<tbody>

			<?php
				
				$userFields = array( 'email', 'description', 'first_name', 'last_name', 'vat', 'billing_phone', 'billing_company', 'billing_country', 'billing_address_1', 'billing_city', 'billing_postcode' , 'facebook' , 'instagram' );
								
				foreach( $userFields as $meta ){ ?>
										
						<tr class="form-field">
												
							<th valign="top" scope="row">
								<label for="<?php print esc_attr( $meta ) ; ?>">
									<?php print strtoupper( str_replace( '_',' ', esc_attr( $meta ) ) ); ?>
								</label>
							</th>
							<td>
								<?php
									
									if( $meta == 'last_name' || $meta == 'first_name' || $meta == 'email'  ){
										?>
										<input required id="<?php print esc_attr( $meta ); ?>" name="<?php print esc_attr( $meta ); ?>" type="text" style="width: 95%" value="" size="50" class="code" placeholder="<?php print esc_attr( str_replace( '_',' ',esc_attr( $meta ) ) ); ?>" >										
										<?php 
										
									}elseif($meta == 'description'){
										?>
										<textarea id="<?php print esc_attr( $meta ); ?>" name="<?php print esc_attr( $meta ); ?>" type="number" style="width: 95%"  class="code" placeholder="<?php print esc_attr( str_replace( '_',' ',esc_attr( $meta ) ) ); ?>" ></textarea>										
										<?php 										
									}elseif($meta == 'billing_phone'){
										?>
										<input required id="<?php print esc_attr( $meta ); ?>" name="<?php print esc_attr( $meta ); ?>" type="number" style="width: 95%" value="" size="50" class="code" placeholder="<?php print esc_attr( str_replace( '_',' ',esc_attr( $meta ) ) ); ?>" >										
										<?php 
									}elseif( $meta == 'billing_country' ){ ?>
								
									 <select required name='<?php print esc_attr( $meta ); ?>'>
									 <?php foreach( $this->countrycodes as $key=>$value ){
										print  "<option value='".esc_attr( $value )."' >".esc_attr( $key )."</option>";
									 }?>
									 </select>								
									
																	
									<?php }else{
										?>
										<input id="<?php print esc_attr( $meta ); ?>" name="<?php print esc_attr( $meta ); ?>" type="text" style="width: 95%" value="" size="50" class="code" placeholder="<?php print esc_attr( str_replace( '_',' ',esc_attr( $meta ) ) ); ?>" >										
										<?php 										
										}
									?>
							</td>
				<?php } ?>	
				
				
			</tbody>
		</table>
	<?php
	}

	public function someMoreFields(){
		?>

		<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
			<tbody>
				<tr class="form-field ">
					<th class='' valign="top" scope="row">
						<label>
							<?php esc_html_e( 'User Segment in PRO Addon', 'crm-erp-business-solution' )?><?php print CrmErpSolution::get_instance()->proAddon(); ?>
						</label>
					</th>
					<td class=''>
						<select class='proVersion' disabled style="width: 95%" >
						</select>
					</td>						
				</tr>

				<tr class="form-field">
					<th valign="top" scope="row">
						<label>
							<?php esc_html_e('Discount', 'crm-erp-business-solution' )?><?php print CrmErpSolution::get_instance()->proAddon();  ?>
						</label>
					</th>	
					<td>
						<input id="discount" class='proVersion' disabled type="number" placeholder="<?php esc_html_e('Discount in PRO Addon', 'crm-erp-business-solution' )?>" />
					</td>
				</tr>
			</tbody>
		</table>
	<?php
	}

	public function updateUserFields( $user_id ) {

		if ( !current_user_can( 'edit_user', (int)$user_id ) ) { 
			return false; 
		}
		
		$userFields = array( 'email', 'description', 'first_name', 'last_name', 'vat', 'billing_phone', 'billing_company', 'billing_country', 'billing_address_1', 'billing_city', 'billing_postcode' , 'facebook' , 'instagram' );	
		if( has_filter( 'crmerpbs_user_fields_to_update' ) ) {
			$userFields = apply_filters( "crmerpbs_user_fields_to_update" , $userFields );
		}
		foreach( $userFields as $field ){
			
			if( isset( $_POST[ $field ] ) ){
				
				if( $field == 'vat' ){	
					
					$vat = sanitize_text_field( $_POST[ 'vat' ] );
					$user = get_user_by( 'id', (int)$user_id );
		
					if( $user->vat != $vat  ){
						
						if( $this->checkExistingVat( $vat ) == '' ){
							update_user_meta( (int)$user_id, $field , $vat );
						}else update_option( "crmerpbs_notice", array( 'notice' => esc_html( $vat ). esc_html__(" vat already exists", 'crm-erp-business-solution' ) , 'type' => 'error', 'dismissible' => 'is-dismissible'  ) );
							
					} 
						
				}else update_user_meta( $user_id, $field , sanitize_text_field( $_POST[ $field ] ) );
				
			}
					
		}		
				
	}


	public function view( $id ){

	if( isset( $_REQUEST['id'] ) ) $id = (int)$_REQUEST['id'];

	// Get the user object.
	$user = get_userdata( $id );

	// Get all the user roles as an array.
	$user_roles = $user->roles;
	// Check if the role you're interested in, is present in the array.
	if ( in_array( 'crm_vendor', $user_roles, true ) ) {
		$paid = esc_html__( 'ERP - YOU PAID', 'crm-erp-business-solution' );
		$own = esc_html__( 'ERP - YOU OWN', 'crm-erp-business-solution' );
	}else{
		$paid = esc_html__( 'ERP PAID', 'crm-erp-business-solution' );
		$own = esc_html__( 'ERP - OWNS', 'crm-erp-business-solution' );	
	}
	
	ob_start();
	do_action( 'crmerpbs_get_customer_total_order', $id );

	$get_customer_total_order = ob_get_contents();
	ob_end_clean();
	
	
	$user = get_user_by( 'id', $id );

	?>
	

	<hr/>
		<div class='userFlex'>
			
			<div>
				<h2 style='font-size:30px;'>
					<center>
						<?php print esc_html( get_user_meta( $id, 'first_name', true ) ); ?> <?php esc_html( print get_user_meta( $id, 'last_name', true ) ); ?>
					</center>
				</h2>	
			</div>
			
			<?php if( $user->user_email !='' ){ ?>
				<div>
					<h4>
						<a href="mailto:<?php print esc_html( $user->user_email ); ?>">
							<?php print esc_html( $user->user_email ); ?>
						</a>
					</h4>
				</div>					
			<?php } ?>			
			<?php if( get_user_meta( $id, 'user_segment', true ) !='' ){ ?>
				<div>
					<h4>
						<?php print esc_html( get_user_meta( $id, 'user_segment', true ) ); ?>
					</h4>
				</div>					
			<?php } ?>
		
			<div>
				<h4>
				<span><?php esc_html_e("Location ", 'crm-erp-business-solution' );?></span>
				<?php print esc_html( get_user_meta( $id, 'billing_city', true ) ) .", ". array_search( get_user_meta( $id, 'billing_country', true ) , $this->countrycodes ); ?>
				</h4>
			</div>
			<?php if( get_option( 'crmerpbs_enableOffers' ) ) { ?>
				<div>
					<h4>
					<span><?php esc_html_e( "Offers", 'crm-erp-business-solution' );?></span>
					<?php print esc_html( $this->getTransactionOffersbyUser( $id ) ); ?>
					</h4>
				</div>	
			<?php } ?>
			<div>
				<h4>
				<span><?php esc_html_e( "Transaction Invoices ", 'crm-erp-business-solution' );?></span>
				<?php print esc_html( $this->getTransactionInvoicebyUser( $id ) ); ?>
				</h4>
			</div>	
			
			<?php if( get_option( 'crmerpbs_enableTickets' ) ) { ?>
				<div>
					<h4>
					<span><?php esc_html_e( "Tickets", 'crm-erp-business-solution' );?></span>
					<?php do_action( "crmerpbs_getTicketsCountbyUser", $id ); ?>
					</h4>
				</div>			
			<?php } ?>
			<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $get_customer_total_order  !='' ) { ?>
				<div>
					<h4>
					<span><?php esc_html_e( "Eshop Orders", 'crm-erp-business-solution' );?></span>
					<?php do_action( "crmerpbs_get_customer_total_order_count", $id ); ?>
					</h4>
				</div>			
			<?php } ?>			
			
		</div>
	<hr/>
	<?php if( (int)$this->getTransactionTotalbyUser( $id ) != '0'  || (int)$get_customer_total_order != '0' ){ 


		$amounts = array();
		$amounts[] = array( "amount" => $this->getTransactionTotalbyUser( $id ), "name" => 'paid' );
		$amounts[] = array( "amount" => $this->getTransactionOwnedbyUser( $id ), "name" => 'owned' );
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $get_customer_total_order  !='' ) {
			$amounts[] = array( "amount" => $get_customer_total_order, "name" => 'eshop' );
		}
		
	?>

	<div class='crmflex'>

		<div>
			<canvas id="amounts" ></canvas>
		</div>

		<div>
			<table  class="widefat striped centered" style='font-size:30px;font-weight:bold;'>
			<tr>
				<th valign="top" scope="row">
				<?php print esc_html( $paid );?> 
				</th>
				<th valign="top" scope="row">
				<?php print esc_html( $own );?> 
				</th>
				
				<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
					<?php if( $get_customer_total_order  !='' ) { ?>
					<th valign="top" scope="row">
						<?php esc_html_e( "ESHOP SALES", 'crm-erp-business-solution' ); ?>
					</th>
					<?php } ?>
				<?php } ?>
				<th valign="top" scope="row">
					<?php esc_html_e( "TOTAL", 'crm-erp-business-solution' ); ?>
				</th>

			</tr>
			<tr>
				<td valign="top" scope="row">
				<?php print  esc_html( crm_price( $this->getTransactionTotalbyUser( $id ) ) ); ?>
				
				</td>
				<td valign="top" scope="row">
				<?php print esc_html( crm_price( $this->getTransactionOwnedbyUser( $id ) ) ); ?>
				</td>
				
				<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
					<?php if( $get_customer_total_order  !='' ){ ?>
						<td valign="top" scope="row">
							<?php print  esc_html( crm_price( $get_customer_total_order ) ); ?>
						</td>
					<?php } ?>
				<?php } ?>
				
				<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
					<td valign="top" scope="row">
					<?php print esc_html( crm_price( (INT)$this->getTransactionTotalbyUser( $id ) + (INT)$get_customer_total_order ) ); ?>
					</td>
				<?php } else { ?>
					<td valign="top" scope="row">
						<?php print esc_html( crm_price( (INT)$this->getTransactionTotalbyUser( $id )  ) ); ?>
					</td>			
				<?php  } ?>
			</tr>
			</table>

		</div>

	</div>			
		<script>
				var ctx = document.getElementById("amounts");
				var myChart = new Chart(ctx, {
					type: 'pie',
					data: {
						labels: [<?php foreach( $amounts as $rep ){ print '"' . esc_html( $rep['name'] ) .": ".esc_html( $rep['amount'] ). '",';};?>],
						datasets: [{
							label: '',
							data: [<?php foreach( $amounts as $rep ){ print '"' .  esc_html( $rep['amount'] ) . '",';};?>],
							backgroundColor:[<?php foreach( $amounts as $rep ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],				
							borderColor:[<?php foreach( $amounts as $rep ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],					
							borderWidth: 1
						}]
					},
					options: {
						title: {
							display: true,
							text: "<?php esc_html_e( 'Paid vs Owned', 'crm-erp-business-solution' ); ?>"
						},		
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
				});
				</script>

	<?php }// end of checking whether user has any transactions  ?>
	
	
	<div id="tabs" class='clearfix userViewPage'>
		<ul>
			<li>
				<a href="#personalinfo"><?php  esc_html_e( 'Personal Info', 'crm-erp-business-solution' );?></a>
			</li>
			<li>
				<a href="#orders"><?php  esc_html_e( 'Transactions', 'crm-erp-business-solution' );?></a>
			</li>
			
			<?php if( get_option( 'crmerpbs_enableOffers' ) ) { ?>
			
				<li>
					<a href="#offers"><?php  esc_html_e( 'Offers', 'crm-erp-business-solution' );?></a>
				</li>
				
			<?php } ?>
			<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){ ?>
			
				<li>
					<a href="#eshoporders"><?php  esc_html_e( 'Eshop Orders', 'crm-erp-business-solution' );?></a>
				</li>
				
			<?php } ?>
			
			<?php if( get_option( 'crmerpbs_enableTickets' ) ) { ?>
				<li>
					<a href="#tickets"><?php  esc_html_e( 'Tickets', 'crm-erp-business-solution' );?></a>
				</li>
			<?php } ?>
			
			<li>
				<a href="#products"><?php  esc_html_e( 'Products', 'crm-erp-business-solution' );?></a>
			</li>
			
			<?php if( get_option( 'crmerpbs_enableAppointments' ) ) { ?>
				<li>
					<a href="#appointments"><?php  esc_html_e( 'Appointments', 'crm-erp-business-solution' );?></a>
				</li>
			<?php } ?>			
			
			<?php if( get_option( 'crmerpbs_enableEmails' ) ) { ?>
				<li>
					<a href="#emails"><?php  esc_html_e( 'Emails', 'crm-erp-business-solution' );?></a>
				</li>
			<?php } ?>
			
			<?php if( get_option( 'crmerpbs_enableActions' ) ) { ?>
				<li>
					<a href="#actions"><?php  esc_html_e( 'Actions', 'crm-erp-business-solution' );?></a>
				</li>
			<?php } ?>
			<?php do_action( 'crmerpbs_user_more_tab' ); ?>
		</ul>

	<div id='personalinfo'>
		<table  class="widefat striped centered">
			<?php
			$userFields = array( 'email', 'description', 'first_name', 'last_name', 'vat', 'billing_phone', 'billing_company', 'billing_country', 'billing_address_1', 'billing_city', 'billing_postcode' , 'facebook' , 'instagram' );
			
			if( has_filter( 'crmerpbs_user_fields_to_update' ) ) {
				$userFields = apply_filters( "crmerpbs_user_fields_to_update" , $userFields ); 					
			}		
			
			foreach( $userFields as $meta ){
												
				if( get_user_meta( $id, $meta, true ) !== '' ){ ?>
					<tr>
						<td valign="top" scope="row">
							<label>
								<?php print strtoupper( str_replace( '_',' ',esc_attr( $meta ) ) ); ?>
							</label>
						</td>
													
						<td>
						<?php
							print esc_html( get_user_meta( $id, $meta, true ) );
						?>
						</td>
					</tr>
				<?php }
			}			

			?>
		</table>
	</div>


	<div id='orders'>
		<?php wp_kses( $this->getTransactionbyUser( $id ), CrmErpSolution::get_instance()->allowed_html ); ?>
	</div>
	
	<?php if( get_option( 'crmerpbs_enableOffers' ) ) { ?>
		<div id='offers'>
			<?php wp_kses( $this->getOffersbyUser( $id ), CrmErpSolution::get_instance()->allowed_html ); ?>
		</div>
	<?php } ?>

	<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){ ?>
	<div id='eshoporders'>
		<?php do_action( 'crmerpbs_user_orders', $id  ); ?>
	</div>

	<?php } ?>

	<?php if( get_option( 'crmerpbs_enableTickets' ) ) { ?>

	<div id='tickets'>
		<?php do_action( 'crmerpbs_user_tickets', $id ); ?>		
	</div>
	
	<?php } ?>

	<div id='products'>		
		<?php 			
			do_action( 'crmerpbs_getTransactionProductsbyUser', $id );
		?>		
	</div>

	<?php if( get_option( 'crmerpbs_enableAppointments' ) ) { ?>
	<div id='appointments'>
		<?php wp_kses( $this->getAppointmentsbyUser( $id ), CrmErpSolution::get_instance()->allowed_html ); ?>
	</div>
	<?php } ?>
	
	<?php if( get_option( 'crmerpbs_enableEmails' ) ) { ?>
	<div id='emails'>
		<?php 			
			do_action( 'crmerpbs_user_emails', $id );
		?>
	</div>
	<?php } ?>

	<?php if( get_option( 'crmerpbs_enableActions' ) ) { ?> 
	<div id='actions'>
		<?php do_action( 'crmerpbs_user_actions', $id ); ?>
	</div>
	<?php } ?>
	
    <?php do_action( 'crmerpbs_user_more_result', $id );	?>
	</div>


	<?php								
	}



	public function getAppointmentsbyUser( $id ){

		$meta_query = array();
		$user = array('key' => 'crmerpbs_user', 'value' => (int)$id  );
		
		array_push( $meta_query,$user );
				
		$query = new WP_Query( array(
			'post_type' => "crmerpbs_app",
			'meta_query' => $meta_query,					
			'posts_per_page' => '-1',
			'meta_key'          => 'crmerpbs_dateto',
			'orderby'           => 'meta_value',
			'order'             => 'DESC'			
		) );
		
		if ( $query ->have_posts() ){
			$headings = array( "Appointment Date", "Appointment Time", "Title", "Info", "Action");
			?>
			<table  class="widefat striped centered">
				<tr>
						<?php foreach( $headings as $heading ){ ?>
							<th><?php esc_html_e( $heading, 'crm-erp-business-solution' ); ?></th>
						<?php } ?>						
				</tr>
			<?php
			global $wpdb;
			while ( $query->have_posts() ){
				$query->the_post();

					
				print "<tr>";
				print "<td>". date( "d-m-Y", strtotime( get_post_meta( get_the_ID() , 'crmerpbs_dateto', true ) ) ) ."</td>" ;
				
				print "<td>". get_post_meta( get_the_ID() , 'crmerpbs_time', true )."</td>" ;

				print "<td> <a href='".esc_url( get_edit_post_link() )."' target='_blank' >". esc_html( get_the_title() ) .  "</a></td>" ;
				print "<td> ". esc_attr( get_the_content() ) .  "</td>" ;
				print "<td> <a href='".esc_url( get_edit_post_link() )."' target='_blank' >".esc_html__( 'edit', 'crm-erp-business-solution' )."</a></td>" ;
				print "</tr>";
			} ?>
			
			</table>
			
			<?php

		}else print  "<p>" . esc_html__( "No Appointments found" , 'crm-erp-business-solution' ) . "</p>";

		print  "<p><a target='_blank' class='button-primary' href='". esc_url( admin_url( "post-new.php?post_type=crmerpbs_app&user=".esc_attr( (int)$id ) ) )."'>".esc_html__( "Add New", 'crm-erp-business-solution' )."</a></p>";			
	}
	

	public function getTransactionsbyUser( $id ){

			global $wpdb;
			$table = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
			$cc = $wpdb->get_results( $wpdb->prepare( "SELECT sum(paid) FROM {$table} WHERE user =%d ", (int)$id ) );
			return $cc;	
			
	}


	public function getOffersbyUser( $id ){

			global $wpdb;
			$transactions = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
			$results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$transactions} WHERE user =%d and type =%s ORDER BY creationdate DESC ", (int)$id, "offer" ) );
			
			if( $results ){ 
			
			$headings = array( 'ID', 'Creation Date', 'Type', 'Status', 'Description', 'Discount', 'Sub Total', 'Tax', 'Total', 'Paid', 'Balance','Actions' );
			?>
			
			<table  class="widefat striped centered">
				<tr>
						<?php foreach( $headings as $heading ){ ?>
							<th><?php esc_html_e( $heading, 'crm-erp-business-solution' ); ?></th>
						<?php } ?>						
				</tr>
			<?php	
				foreach( $results as $res ){
					
					print "<tr>"; ?>
					<td>
						<a target='_blank' href='<?php print esc_url( admin_url( " ?page=crm-erp-business-solution&tab=offers&action=view&id=".(int)$res->id ) ); ?>' >
							<?php print esc_html( (int)$res->id ); ?>
						</a>
					</td> <?php
					print "<td>". date('d-m-Y', strtotime( $res->creationdate ) )  ."</td>" ;

					print "<td>". esc_html( $res->type   )   ."</td>" ;
					print "<td>". esc_html( $res->status )   ."</td>" ;
					print "<td>". esc_html( crm_price( $res->description ) ) ."</td>" ;
					print "<td>". esc_html( crm_price( $res->discount ) ) ."</td>" ;
					print "<td>". esc_html( crm_price( $res->total ) ) ."</td>" ;
					print "<td>". esc_html( crm_price( $res->tax ) ) ."</td>" ;
					print "<td>". esc_html( crm_price( $res->grandtotal ) ) ."</td>" ;
					print "<td>". esc_html( crm_price( $res->paid ) ) ."</td>" ;
					print "<td>". esc_html( crm_price( $res->balance ) ) ."</td>" ;
					print "<td><a target='_blank' href='". esc_url( admin_url("?page=crm-erp-business-solution&tab=offers&action=edit&id=".esc_html( (int)$res->id) ) )."'>edit</a> - <a target='_blank' href='". esc_url( admin_url("?page=crm-erp-business-solution&tab=offers&action=view&id=".esc_html( (int)$res->id ) ) )."'>".esc_html__( 'view', 'crm-erp-business-solution' )."</a></td>" ;
					print "</tr>";
					
				}
			?>
			</table>
			<?php 
			}else print "<p>".esc_html__( 'No offers found', 'crm-erp-business-solution' )."</p>";
			
			print  "<p><a target='_blank' class='button-primary' href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=offers&action=new&user=".esc_html( (int)$id ) ) )."'>".esc_html__("Add New", 'crm-erp-business-solution' )."</a></p>";			
	}


	
	public function getTransactionbyUser( $id ){

			global $wpdb;
			$transactions = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
			$results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$transactions} WHERE user =%d and type !=%s ORDER BY creationdate DESC ", (int)$id, "offer" ) );
			
			if( $results ){ 
			
			$headings = array( 'ID', 'Creation Date', 'Pay Date', 'Type', 'Status', 'Parent', 'Description', 'Discount', 'Sub Total', 'Tax', 'Total', 'Paid', 'Balance','Actions' );
			?>
			
			<table  class="widefat striped centered">
				<tr>
						<?php foreach( $headings as $heading ){ ?>
							<th><?php esc_html_e( $heading,'crm-erp-business-solution' ); ?></th>
						<?php } ?>						
				</tr>
			<?php	
				foreach( $results as $res ){

					if( strstr( $res->type,'sale' ) ){
						$tab = 'sales';
					}else $tab = 'payments';
					
					if( $res->parent =='0' ){
						$res->parent = '';
					}
					
					print "<tr>"; ?>
					
						<td>
							<a target='_blank' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab ) ."&action=view&id=".(int)$res->id ) ); ?>' >
								<?php print esc_html( (int)$res->id ); ?>
							</a>
						</td> <?php
						
						print "<td>". date('d-m-Y', strtotime( $res->creationdate ) )  ."</td>" ;
						print "<td>";
						if( !empty( $res->paydate ) ){
							print date('d-m-Y', strtotime( $res->paydate ) ) ;
						}
						print "</td>" ;
						print "<td>". esc_html( str_replace( "",'',str_replace("sale",'', $res->type ) ) )   ."</td>" ;
						print "<td>". esc_html( $res->status )   ."</td>" ;
						?>
						<td>
							<a target='_blank'  href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab ) ."&action=view&id=".esc_attr( (int)$res->parent ) ) ); ?>' >
								<?php print esc_html( $res->parent ); ?>
							</a>
						</td>
						<?php
						print "<td>". wp_kses( $res->description , CrmErpSolution::get_instance()->allowed_html ) ."</td>" ;
						print "<td>". esc_html( crm_price( $res->discount ) ) ."</td>" ;
						print "<td>". esc_html( crm_price( $res->total ) ) ."</td>" ;
						print "<td>". esc_html( crm_price( $res->tax ) ) ."</td>" ;
						print "<td>". esc_html( crm_price( $res->grandtotal ) ) ."</td>" ;
						print "<td>". esc_html( crm_price( $res->paid ) ) ."</td>" ;
						print "<td>". esc_html( crm_price( $res->balance ) ) ."</td>" ;
						print "<td>
							<a target='_blank' href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab ) ."&action=edit&id=".esc_html( (int)$res->id ) ) )."'>".esc_html__( 'edit', 'crm-erp-business-solution' )."</a> - <a target='_blank' href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab ) ."&action=view&id=".esc_html( (int)$res->id ) ) )."'>".esc_html__( 'view', 'crm-erp-business-solution' )."
							</a>
							</td>" ;
						
					print "</tr>";
					
				}
			?>
			</table>
			<?php 
			}else print "<p>".esc_html__( 'No ERP transactions found', 'crm-erp-business-solution' )."</p>";
			
			$user = get_user_by( "id", (int)$id );
			$tab = '';
			if ( in_array( 'crm_customer', (array) $user->roles ) ) {
				$tab = 'sales';
			}elseif ( in_array( 'crm_vendor', (array) $user->roles ) ) {
				$tab = 'payments';
			}
			if( has_filter( 'crmerpbs_get_user_role_by_id' ) ) {
				$tab = apply_filters( "crmerpbs_get_user_role_by_id", (int)$id ); 
			}
			print  "<p>
						<a target='_blank' class='button-primary' href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab ) ."&action=new&user=".esc_html( (int)$id ) ) )."'>".esc_html__( "Add New", 'crm-erp-business-solution' )."</a>
					</p>";
	}

	public function getTransactionInvoicebyUser( $id ){

			global $wpdb;
			
			$user = get_user_by( "id", (int)$id );
			$type = '';
			if ( in_array( 'crm_customer', (array) $user->roles ) ) {
				$type = 'saleinvoice';				
			}elseif ( in_array( 'crm_vendor', (array) $user->roles ) ) {
				$type = 'payinvoice';
			}
			if( has_filter( 'crmerpbs_get_user_role_for_transaction_type_by_id' ) ) {
				$type = apply_filters( "crmerpbs_get_user_role_for_transaction_type_by_id", (int)$id ); 			
			}
			if( !empty( $type ) ){
				
				$type= sanitize_text_field( $type );
				$table = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix				
				$cc = $wpdb->get_var( $wpdb->prepare( "SELECT count(id) FROM {$table} WHERE user =%d AND type=%s ", (int)$id, $type ) );
				
				if( !empty( $cc ) ) {
					print $cc;	
				
				}else print "-";				
			}

	}
	
	public function getTransactionOffersbyUser( $id ){

			global $wpdb;
			$table = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT count(id) FROM {$table} WHERE user =%d AND type=%s ", (int)$id, "offer" ) );
			
			if( !empty( $cc ) ) {
				return $cc;	
			
			}else return "-";
	}	
	
	public function getTransactionTotalbyUser( $id ){

			global $wpdb;
			$table = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
			
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM {$table} WHERE user =%d AND ( type=%s OR type =%s ) ", (int)$id, "saleinvoice", "payinvoice" ) );
			
			if( !empty( $cc ) ) {
				return $cc;	
			
			}else return "-";
	}

	public function getTransactionOwnedbyUser( $id ){

			global $wpdb;
			$table = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' );// do not forget about tables prefix
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM {$table} WHERE user =%d AND ( type=%s OR type =%s ) ", (int)$id, "saleinvoice", "payinvoice" ) );
			
			if( !empty( $cc ) ) {
				return $cc;	
			
			}else return "-";				
	}


	public function getTransactionProductsbyUser( $id ){

			global $wpdb;
			$transactions = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
			$transaction_items = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' ); // do not forget about tables prefix
			
			$results = $wpdb->get_results( $wpdb->prepare( ' 
				SELECT items.product_id,items.quantity
				FROM '.$transaction_items.' AS items
				INNER JOIN '.$transactions.' AS transactions
				ON transactions.id =  items.trans_id
				WHERE transactions.user  = %d ' , (int)$id ), ARRAY_A );
			
			
			if( $results ){
				
			?>
			<div class='crmflex'>
			<div>		
			<table  class="widefat striped centered">
				<td>
					<b for="type"><?php esc_html_e( 'Product', 'crm-erp-business-solution' )?></b>
				</td>
				<td >
					<b for="type"><?php esc_html_e('Quantity', 'crm-erp-business-solution' )?></b>
				</td>		
			<?php
			
					//SORT ARRAY BY VALUE DESCENDING
					$prodSales = array_column( $results, 'quantity' );
					$returnProd = array_multisort( $prodSales, SORT_DESC , $results );
					
					//GROUP BY products
					$result = array();		
					foreach ( $results as $element ) {
					   $result[$element['product_id']][] = $element;
					}
					
					//run the loop, sum the salaries by gender
					$totalAmount = 0;
					$totalQuantity = 0;
					$totalRefund = 0;					

					foreach( $result as $res ){		

						print "<tr>";
						/*SUM WITHIN MULTIDEMENSIONAL ARRAY*/
						$quant=0;
						foreach ( $res as $item ) {
							$quant += $item['quantity'];
						}
						$totalQuantity += $quant;
							$title = get_the_title( (int)$item['product_id'] );
							if( has_filter( 'crmerpbs_getProductTitle' ) ) {
								$title = apply_filters( "crmerpbs_getProductTitle" , (int)$item['product_id'] );
							}						
							$reportProducts[] = array( "name" => $title, "quantity" => $quant );
							
						echo "<td>". esc_html( $title ) . "</td><td>". esc_html( $quant ) . "</td>";	
						print "</tr>";
						
					}
					echo "<tr class='totals' style='font-weight:bold;'><td>". esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td>".esc_html( $totalQuantity )."</td></tr>";					
			?>
			
			</table>
			</div>
				<div class="chart-container" >
					<canvas id="productChart"></canvas>
				</div>
			</div>
				<script>
				var ctx = document.getElementById( "productChart" );
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: [<?php foreach( $reportProducts as $p ){ print '"' . esc_html( $p['name'] ) . '",';};?>],
						datasets: [{
							label: "<?php esc_html_e( 'Sold', 'crm-erp-business-solution' );?>",
							data: [<?php foreach( $reportProducts as $p ){ print '"' . esc_html( $p['quantity'] ) . '",';};?>],
							backgroundColor:[<?php foreach( $reportProducts as $p ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],				
							borderColor:[<?php foreach( $reportProducts as $p ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],				
							borderWidth: 1
						}]
					},
					options: {
						title: {
							display: true,
							text: "<?php esc_html_e( 'PRODUCTS', 'crm-erp-business-solution' );?>"
						},		
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
				});
				</script>	
			<?php
			}			
	}
	
	public function getTicketsCountbyUser( $id ){

		print wp_kses( CrmErpSolution::get_instance()->proAddon() , CrmErpSolution::get_instance()->allowed_html );
	}
	
	public function get_customer_total_order_count() {
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
			
			return CrmErpSolution::get_instance()->wooAddon();
		
		}

	}


	public function get_customer_total_order( $id ) {
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
			
			return esc_html__( 'Orders need ', 'crm-erp-business-solution' ). CrmErpSolution::get_instance()->wooAddon();
		
		}
	}
	
	public static function getTicketsbyUser( $id ){

		print esc_html__( 'Tickets need ', 'crm-erp-business-solution' ). wp_kses( CrmErpSolution::get_instance()->proAddon()  , CrmErpSolution::get_instance()->allowed_html );			
	}
	
	public static function getOrdersByCustomer( $id ){
		
		print esc_html__( 'Orders need ', 'crm-erp-business-solution' ). wp_kses( CrmErpSolution::get_instance()->wooAddon()  , CrmErpSolution::get_instance()->allowed_html );
			
	}
	
	public static function getActionsbyUser( $id ){

		print esc_html__( 'Actions need the ', 'crm-erp-business-solution' ). wp_kses( CrmErpSolution::get_instance()->proAddon()  , CrmErpSolution::get_instance()->allowed_html );
			
	}	

	public static function getEmailsbyUser( $id ){

		print esc_html__( 'Emails need ', 'crm-erp-business-solution' ). wp_kses( CrmErpSolution::get_instance()->proAddon()  , CrmErpSolution::get_instance()->allowed_html );
			
	}
	
	
	public function userFieldsAdd( $user ) {

		$role = array( 'crm_customer','crm_vendor' );
		if( has_filter( 'crmerpbs_dif_user_role' ) ) {
			$role = apply_filters( 'crmerpbs_dif_user_role', $role );
		}
		
		foreach( $role as $r ) {
			
			if ( in_array( $r, (array) $user->roles ) ) {
				

				$vat = get_user_meta( $user, 'vat', false );
				$facebook = get_user_meta( $user, 'facebook', false );
				$instagram = get_user_meta( $user, 'instagram', false );
				
				if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
				
				$billing_address = get_user_meta( $user, 'billing_address_1', false );
				$billing_country = get_user_meta( $user, 'billing_country', false );
				$billing_city = get_user_meta( $user, 'billing_city', false );
				$billing_phone = get_user_meta( $user, 'billing_phone', false );
				$billing_postcode = get_user_meta( $user, 'billing_postcode', false );

				
				?>
				
				<h3><?php esc_html_e( 'Contact info', 'crm-erp-business-solution' ); ?></h3>
				<table class="form-table">
					<?php if( !$billing_address ){ ?>
					 <tr>
						 <th><label for="billing_address_1"><?php esc_html_e( 'Address', 'crm-erp-business-solution' ); ?></label></th>
						 <td>
							<input type='text' name='billing_address_1'  value="<?php echo esc_attr( get_the_author_meta( 'billing_address_1', (int)$user->ID ) ); ?>" />
						 </td>
					 </tr>	
					<?php } ?>	
					<?php if(!$billing_city ){ ?>
					 <tr>
						 <th><label for="billing_city"><?php esc_html_e( 'City', 'crm-erp-business-solution' ); ?></label></th>
						 <td>
							<input type='text' name='billing_city'  value="<?php echo esc_attr( get_the_author_meta( 'billing_city', (int)$user->ID ) ); ?>" />
						 </td>
					 </tr>	
					<?php } ?>	
					<?php if(!$billing_country ){ ?>
					 <tr>
						 <th><label for="billing_country"><?php esc_html_e( 'Country', 'crm-erp-business-solution' ); ?></label></th>
						 <td>
							<input type='text' name='billing_country'  value="<?php echo esc_attr( get_the_author_meta( 'billing_country', (int)$user->ID ) ); ?>" />
						 </td>
					 </tr>	
					<?php } ?>	
					<?php if(!$billing_postcode ){ ?>
					 <tr>
						 <th><label for="billing_postcode"><?php esc_html_e( 'Postcode', 'crm-erp-business-solution' ); ?></label></th>
						 <td>
							<input type='text' name='billing_postcode'  value="<?php echo esc_attr( get_the_author_meta( 'billing_postcode', (int)$user->ID ) ); ?>" />
						 </td>
					 </tr>	
					<?php } ?>	
					<?php if(!$billing_phone ){ ?>
					 <tr>
						 <th><label for="billing_phone"><?php esc_html_e( 'Phone', 'crm-erp-business-solution' ); ?></label></th>
						 <td>
							<input type='text' name='billing_phone'  value="<?php echo esc_attr( get_the_author_meta( 'billing_phone', (int)$user->ID ) ); ?>" />
						 </td>
					 </tr>	
					<?php } ?>			
				</table>
				
				<?php } ?>
				
				<h3><?php esc_html_e( 'Extra profile information', 'crm-erp-business-solution' ); ?></h3>

				<table class="form-table">
				
				<?php do_action( 'crmerpbs_extraUserFields' , $user ) ;?>
				
				<?php if(!$vat ){ ?>
				 <tr>
					 <th><label for="vat"><?php esc_html_e( 'VAT Number', 'crm-erp-business-solution' ); ?></label></th>
					 <td>
						<input type='text' name='vat'  value="<?php echo esc_attr( get_the_author_meta( 'vat', (int)$user->ID ) ); ?>" />
					 </td>
				 </tr>	
				<?php } ?>	
				

				<?php if( !$facebook ){ ?>
				 <tr>
					 <th><label for="facebook"><?php esc_html_e( 'Facebook URL', 'crm-erp-business-solution' ); ?></label></th>
					 <td>
						<input type='text' name='facebook'  value="<?php echo esc_attr( get_the_author_meta( 'facebook', (int)$user->ID ) ); ?>" />
					 </td>
				 </tr>	
				<?php } ?>
				<?php if( !$instagram ){ ?>
				 <tr>
					 <th><label for="instagram"><?php esc_html_e( 'Instagram URL', 'crm-erp-business-solution' ); ?></label></th>
					 <td>
						<input type='text' name='instagram'  value="<?php echo esc_attr( get_the_author_meta( 'instagram', (int)$user->ID ) ); ?>" />
					 </td>
				 </tr>	
				<?php } ?>

				
				</table>
				<?php
			
			}
		
		}
	}
	
	public function extraUserFields( $user ){ 
	
		$discount = get_user_meta( $user, 'discount', false );
		$user_segment = get_user_meta( $user, 'user_segment', false );
	
		if( !$user_segment ){ ?>
			<tr class="form-field">
			<th class='' valign="top" scope="row">
				<label><?php print esc_html__( 'User Segment', 'crm-erp-business-solution' ). wp_kses( CrmErpSolution::get_instance()->proAddon() , CrmErpSolution::get_instance()->allowed_html ); ?></label>
			</th>
			<td class=''>
				<select disabled  >
					<option value=''><?php esc_html_e( "Select User Segment", 'crm-erp-business-solution' ) ;?></option>
				</select>
			</td>		

			</tr>

		 <tr>
			 <th><label><?php print esc_html__( 'Discount', 'crm-erp-business-solution' ). wp_kses( CrmErpSolution::get_instance()->proAddon() , CrmErpSolution::get_instance()->allowed_html ); ?></label></th>
			 <td>
				<input type='text' disabled  />
			 </td>
		 </tr>	
		<?php } ?>		 
	<?php	
	}
	
	public function query_users(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'getUsers' ){
			
			// get customer
			$vendor_query = new WP_User_Query(
				array(
					'role'	=> 'crm_vendor',
				)
			);
			$vends = $vendor_query->get_results();

			$role = array( 'crm_customer' );
			if( has_filter( 'crmerpbs_dif_user_role' ) ) {
				$role = apply_filters( 'crmerpbs_dif_user_role', $role );
			}
			// customer
			$crm_customer_query = new WP_User_Query(
				array(
					'role__in'      => $role ,
				)
			);
			$custs = $crm_customer_query->get_results();

			$users = array_merge( $custs, $vends );
			
			?><option value=''><?php esc_html_e( "Select user: search by name,vat or email", 'crm-erp-business-solution' ); ?></option><?php
			
			foreach($users as $res){
				
				$user_info = get_userdata( (int)$res->ID );
				
				$option =  "<option vat='".esc_attr( $user_info->vat )."' email='". sanitize_email( $user_info->user_email )."' value='".esc_attr( (int)$user_info->ID )."'>".esc_html( $user_info->first_name." " . $user_info->last_name )."</option>";
				
				if( has_filter( 'crmerpbs_user_select_list' ) ) {
					$option = apply_filters( "crmerpbs_user_select_list", (int)$res->ID );
				}
				print $option;	
				
			}	
			
		}
	}

	public function query_customers(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'getCustomers' ){
			
			$role = array( 'crm_customer' );
			if( has_filter( 'crmerpbs_dif_user_role' ) ) {
				$role = apply_filters( 'crmerpbs_dif_user_role', $role );
			}
			// crm_customer
			$crm_customer_query = new WP_User_Query(
				array(
					'role__in'      => $role ,
				)
			);
			$crmcusts = $crm_customer_query->get_results();

			// store them all as users
			
			?><option value=''><?php esc_html_e( "Select user: search by name,vat or email", 'crm-erp-business-solution' ); ?></option><?php
			foreach($crmcusts as $res){
				
				$user_info = get_userdata( (int)$res->ID );
				
				$option =  "<option vat='".esc_attr( $user_info->vat )."' email='".sanitize_email( $user_info->user_email )."' value='".esc_attr( (int)$user_info->ID )."'>".esc_html( $user_info->first_name." " . $user_info->last_name )."</option>";
				
				if( has_filter( 'crmerpbs_user_select_list' ) ) {				
					$option = apply_filters( "crmerpbs_user_select_list", (int)$res->ID );
				}
				print $option;	
				
			}
				
		}

	}

	public function query_vendors(){


		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'getVendors' ){
	
			$args = array (
				'role'       => 'crm_vendor',
				'order'      => 'ASC',
				'orderby'    => 'display_name',
				);
			$wp_user_query = new WP_User_Query( $args );
			// Get the results
			$users = $wp_user_query->get_results();
			
				?><option value=''><?php esc_html_e( "Select user: search by name,vat or email", 'crm-erp-business-solution' ); ?></option><?php
						
					
				foreach($users as $res){
					
					$user_info = get_userdata( (int)$res->ID );
					
					$option =  "<option vat='".esc_attr( $user_info->vat )."' email='".sanitize_email( $user_info->user_email )."' value='".esc_attr( (int)$user_info->ID )."'>".esc_html( $user_info->first_name." " . $user_info->last_name )."</option>";
					
					if( has_filter( 'crmerpbs_user_select_list' ) ) {
						$option = apply_filters( "crmerpbs_user_select_list", (int)$res->ID );
					}
					print $option;
				}
				
		}
			
	}

	
	public function getUsername( $id ){

		$user = get_user_by( 'id', sanitize_text_field( $id ) );
		if( $user ) return sanitize_text_field( $user->user_login );	
	}

	public function getDiscount( $id ){
		//silence is gold
	}
	
	public function queryUsers(){
		
		if ( is_admin() && current_user_can( 'crm-erp-business-solution' ) ){
			
			global $post;
			if ( isset( $_POST['nonce'] ) &&  isset( $_POST["user_type_select"] ) && wp_verify_nonce( $_POST['nonce'], 'queryUsers' ) ) {	
			

			if ( isset( $_POST['theData'] ) && $_POST["user_type_select"] =='product' ){
				$product = sanitize_text_field( $_POST['theData'] );
			}	
			if ( isset( $_POST['theData'] ) && $_POST["user_type_select"] =='nosales' ){
				$nosales = sanitize_text_field( $_POST['user_type_select'] );
			}	
				$users_arr = array();
				
				if(  isset( $product ) ){
					
					global $wpdb;
					global $post;
					$product = (int)$product;
					
					$transactions = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
					$transaction_items = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' ); // do not forget about tables prefix
						
					$results = $wpdb->get_results( $wpdb->prepare( ' 
						SELECT DISTINCT transactions.user as user
						FROM '.$transactions.' AS transactions
						INNER JOIN '.$transaction_items.' AS items
						ON transactions.id =  items.trans_id
						WHERE items.product_id  =%d ' , $product ) );
							
					if( $results ){
						
						foreach( $results as $result ){
							$user = get_user_by( 'id', (int)$result->user );
							$users_arr[] = array( "id" => $result->user , "email" => $user->user_email );
						}
													
					}
						
					
				}elseif(  isset( $nosales ) ){
					
					$users = array();
					
					$role = array( 'crm_vendor','crm_customer' );

					$args = array(  
						'fields' => 'all_with_meta', 
						'role__in' => $role, 
					);

					$users_query = new WP_User_Query( $args );				
					$results = $users_query->get_results();
					
					foreach( $results as $res ){
						
						$user_info = get_userdata( (int)$res->ID );
						$userid = (int)$user_info->ID;
						$email = sanitize_email( $user_info->user_email );
						
						array_push( $users,$email );
						
					}


					$users_arr_remove = array();
					
					global $wpdb;
											
					$transactions = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
					$results = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT user FROM ".$transactions." WHERE type='%s'  ", 'saleinvoice' ) );
							
					if($results){
						
						foreach( $results as $result ){
							$user = get_user_by( 'id', (int)$result->user );
							array_push( $users_arr_remove, sanitize_email( $user->user_email ) );
						}
													
					}
						 
					$users = array_diff( $users, $users_arr_remove );
					
					foreach( $users as $user ) {
							
							$usR = get_user_by( 'email', $user );
							
							$users_arr[] = array( "id" => (int)$usR->ID, "email" => $user );
					}
						
				}
					
				print json_encode( $users_arr );	
				wp_die();
			
			}
		
		}
	}

	public function ajaxEvent(){ ?>
		<script type="text/javascript" >

		jQuery(function ($) {
			
			function toggleEmails(){
				
					jQuery('.email_select_user').on("click", function(event){
													
							type = $(this).find('option:selected').val();
							
							var ajax_options = {
								action: 'queryUsers',
								nonce: '<?php echo wp_create_nonce( 'queryUsers'); ?>',
								ajaxurl: '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
								user_type_select: type,
								theData: type,
							};
							
							jQuery(".userEmails").html('');
							jQuery(".selectUsersHidden").html('');
							jQuery.post( ajaxurl, ajax_options, function(data) {
								var len = data.length;
								emails=[];
								ids=[];
								for( var i = 0; i<len; i++){
									
									var id = data[i]['id'];
									ids.push(id);
									
									var email = data[i]['email'];	
									 emails.push(email);
								}
								
								var ids = ids.join();
								
								var emails = emails.join();	
								jQuery(".userEmails").html(emails);		

								jQuery(".selectUsersHidden").html(ids);	
								emails=[];
								ids=[];
							},'json');							
					
					});				
				
					jQuery('.toSelect').on("click", function(event){
						type = $(".email_select_user" ).val();
						
						theValue = $(this).find('option:selected').val();
						
						var ajax_options = {
							action: 'queryUsers',
							nonce: '<?php echo wp_create_nonce( 'queryUsers'); ?>',
							ajaxurl: '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
							user_type_select: type,
							theData: theValue,
						};
						
						jQuery(".userEmails").html('');
						jQuery(".selectUsersHidden").html('');
						jQuery.post( ajaxurl, ajax_options, function(data) {
							var len = data.length;
							emails=[];
							ids=[];
							for( var i = 0; i<len; i++){
								
								var id = data[i]['id'];
								ids.push(id);
								
								var email = data[i]['email'];	
								 emails.push(email);
							}
							
							var ids = ids.join();
							
							var emails = emails.join();	
							$(".userEmails").html(emails);		

							jQuery(".selectUsersHidden").html(ids);	
							emails=[];
							ids=[];
						},'json');					
					});
					return false;
			}
			toggleEmails();
			
			jQuery( document ).ajaxComplete(function() {
			 // toggleEmails();
			});			
			
		});

		</script>
		<?php
	}	
}

$crmusers = CRMUsers::get_instance();