<?php
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CrmErpSolutionReports{
		
 
	public $wooAddon = 'https://extend-wp.com/product/crm-erp-business-solution-wordpress-woocommerce-integration';
	
	public $countrycodes = array("Afghanistan"=>"AF","Åland Islands"=>"AX","Albania"=>"AL","Algeria"=>"DZ","American Samoa"=>"AS","Andorra"=>"AD","Angola"=>"AO","Anguilla"=>"AI","Antarctica"=>"AQ","Antigua and Barbuda"=>"AG","Argentina"=>"AR","Armenia"=>"AM","Aruba"=>"AW","Australia"=>"AU","Austria"=>"AT","Azerbaijan"=>"AZ","Bahrain"=>"BH","Bahamas"=>"BS","Bangladesh"=>"BD","Barbados"=>"BB","Belarus"=>"BY","Belgium"=>"BE","Belize"=>"BZ","Benin"=>"BJ","Bermuda"=>"BM","Bhutan"=>"BT","Bolivia, Plurinational State of"=>"BO","Bonaire, Sint Eustatius and Saba"=>"BQ","Bosnia and Herzegovina"=>"BA","Botswana"=>"BW","Bouvet Island"=>"BV","Brazil"=>"BR","British Indian Ocean Territory"=>"IO","Brunei Darussalam"=>"BN","Bulgaria"=>"BG","Burkina Faso"=>"BF","Burundi"=>"BI","Cambodia"=>"KH","Cameroon"=>"CM","Canada"=>"CA","Cape Verde"=>"CV","Cayman Islands"=>"KY","Central African Republic"=>"CF","Chad"=>"TD","Chile"=>"CL","China"=>"CN","Christmas Island"=>"CX","Cocos (Keeling) Islands"=>"CC","Colombia"=>"CO","Comoros"=>"KM","Congo"=>"CG","Congo, the Democratic Republic of the"=>"CD","Cook Islands"=>"CK","Costa Rica"=>"CR","Côte d'Ivoire"=>"CI","Croatia"=>"HR","Cuba"=>"CU","Curaçao"=>"CW","Cyprus"=>"CY","Czech Republic"=>"CZ","Denmark"=>"DK","Djibouti"=>"DJ","Dominica"=>"DM","Dominican Republic"=>"DO","Ecuador"=>"EC","Egypt"=>"EG","El Salvador"=>"SV","Equatorial Guinea"=>"GQ","Eritrea"=>"ER","Estonia"=>"EE","Ethiopia"=>"ET","Falkland Islands (Malvinas)"=>"FK","Faroe Islands"=>"FO","Fiji"=>"FJ","Finland"=>"FI","France"=>"FR","French Guiana"=>"GF","French Polynesia"=>"PF","French Southern Territories"=>"TF","Gabon"=>"GA","Gambia"=>"GM","Georgia"=>"GE","Germany"=>"DE","Ghana"=>"GH","Gibraltar"=>"GI","Greece"=>"GR","Greenland"=>"GL","Grenada"=>"GD","Guadeloupe"=>"GP","Guam"=>"GU","Guatemala"=>"GT","Guernsey"=>"GG","Guinea"=>"GN","Guinea-Bissau"=>"GW","Guyana"=>"GY","Haiti"=>"HT","Heard Island and McDonald Islands"=>"HM","Holy See (Vatican City State)"=>"VA","Honduras"=>"HN","Hong Kong"=>"HK","Hungary"=>"HU","Iceland"=>"IS","India"=>"IN","Indonesia"=>"ID","Iran, Islamic Republic of"=>"IR","Iraq"=>"IQ","Ireland"=>"IE","Isle of Man"=>"IM","Israel"=>"IL","Italy"=>"IT","Jamaica"=>"JM","Japan"=>"JP","Jersey"=>"JE","Jordan"=>"JO","Kazakhstan"=>"KZ","Kenya"=>"KE","Kiribati"=>"KI","Korea, Democratic People's Republic of"=>"KP","Korea, Republic of"=>"KR","Kuwait"=>"KW","Kyrgyzstan"=>"KG","Lao People's Democratic Republic"=>"LA","Latvia"=>"LV","Lebanon"=>"LB","Lesotho"=>"LS","Liberia"=>"LR","Libya"=>"LY","Liechtenstein"=>"LI","Lithuania"=>"LT","Luxembourg"=>"LU","Macao"=>"MO","Macedonia, the Former Yugoslav Republic of"=>"MK","Madagascar"=>"MG","Malawi"=>"MW","Malaysia"=>"MY","Maldives"=>"MV","Mali"=>"ML","Malta"=>"MT","Marshall Islands"=>"MH","Martinique"=>"MQ","Mauritania"=>"MR","Mauritius"=>"MU","Mayotte"=>"YT","Mexico"=>"MX","Micronesia, Federated States of"=>"FM","Moldova, Republic of"=>"MD","Monaco"=>"MC","Mongolia"=>"MN","Montenegro"=>"ME","Montserrat"=>"MS","Morocco"=>"MA","Mozambique"=>"MZ","Myanmar"=>"MM","Namibia"=>"NA","Nauru"=>"NR","Nepal"=>"NP","Netherlands"=>"NL","New Caledonia"=>"NC","New Zealand"=>"NZ","Nicaragua"=>"NI","Niger"=>"NE","Nigeria"=>"NG","Niue"=>"NU","Norfolk Island"=>"NF","Northern Mariana Islands"=>"MP","Norway"=>"NO","Oman"=>"OM","Pakistan"=>"PK","Palau"=>"PW","Palestine, State of"=>"PS","Panama"=>"PA","Papua New Guinea"=>"PG","Paraguay"=>"PY","Peru"=>"PE","Philippines"=>"PH","Pitcairn"=>"PN","Poland"=>"PL","Portugal"=>"PT","Puerto Rico"=>"PR","Qatar"=>"QA","Réunion"=>"RE","Romania"=>"RO","Russian Federation"=>"RU","Rwanda"=>"RW","Saint Barthélemy"=>"BL","Saint Helena, Ascension and Tristan da Cunha"=>"SH","Saint Kitts and Nevis"=>"KN","Saint Lucia"=>"LC","Saint Martin (French part)"=>"MF","Saint Pierre and Miquelon"=>"PM","Saint Vincent and the Grenadines"=>"VC","Samoa"=>"WS","San Marino"=>"SM","Sao Tome and Principe"=>"ST","Saudi Arabia"=>"SA","Senegal"=>"SN","Serbia"=>"RS","Seychelles"=>"SC","Sierra Leone"=>"SL","Singapore"=>"SG","Sint Maarten (Dutch part)"=>"SX","Slovakia"=>"SK","Slovenia"=>"SI","Solomon Islands"=>"SB","Somalia"=>"SO","South Africa"=>"ZA","South Georgia and the South Sandwich Islands"=>"GS","South Sudan"=>"SS","Spain"=>"ES","Sri Lanka"=>"LK","Sudan"=>"SD","Suriname"=>"SR","Svalbard and Jan Mayen"=>"SJ","Swaziland"=>"SZ","Sweden"=>"SE","Switzerland"=>"CH","Syrian Arab Republic"=>"SY","Taiwan, Province of China"=>"TW","Tajikistan"=>"TJ","Tanzania, United Republic of"=>"TZ","Thailand"=>"TH","Timor-Leste"=>"TL","Togo"=>"TG","Tokelau"=>"TK","Tonga"=>"TO","Trinidad and Tobago"=>"TT","Tunisia"=>"TN","Turkey"=>"TR","Turkmenistan"=>"TM","Turks and Caicos Islands"=>"TC","Tuvalu"=>"TV","Uganda"=>"UG","Ukraine"=>"UA","United Arab Emirates"=>"AE","United Kingdom"=>"GB","United States"=>"US","United States Minor Outlying Islands"=>"UM","Uruguay"=>"UY","Uzbekistan"=>"UZ","Vanuatu"=>"VU","Venezuela, Bolivarian Republic of"=>"VE","Viet Nam"=>"VN","Virgin Islands, British"=>"VG","Virgin Islands, U.S."=>"VI","Wallis and Futuna"=>"WF","Western Sahara"=>"EH","Yemen"=>"YE","Zambia"=>"ZM","Zimbabwe"=>"ZW");

	public $parameters = array();
	
    protected static $instance = NULL;


    public static function get_instance()
    {
        if ( NULL == self::$instance )
            self::$instance = new self;

        return self::$instance;
    }

	
	public function __construct() {	
	
		add_action( 'admin_menu', array( $this, 'menu_page' ) );		
		add_action( 'crmerpbs_date_report',  array( $this, 'date_report' ),20 , 1 );
		add_action( 'crmerpbs_woo_report',  array( $this, 'woo_report' ),10  );
		add_action( 'crmerpbs_transactions_report',  array( $this, 'transactions_report' ),20 , 1 );
		add_action( 'admin_init', array( $this, 'extraQueryFilters' ) );	
		
	}

	public function woo_report() {
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
			
			print  esc_html__( 'Orders Report need ', 'crm-erp-business-solution' ). CrmErpSolution::get_instance()->wooAddon();
		
		}
	}
	

	public function transactions_report(){
		
		$this->select_dropdown(); 							
		$this->all_crmerp_transactions(); 
		
	}
	
	public function date_report(){
		
		$this->select_dropdown(); 							
		$this->byDate(); 
		
	}

	
	public function menu_page(){

		add_submenu_page( "crm-erp-business-solution", esc_html__("Reports", 'crm-erp-business-solution' ),  esc_html__( "Reports", 'crm-erp-business-solution' ) , 'crm-erp-business-solution','crm-erp-business-solution&tab=reports', esc_url( admin_url( 'page=crm-erp-business-solution&tab=reports' ) ) );	
		
	}
	
	
	public function reportView(){
		
		?>
		<div class='clearfix overview'>
		
			<?php $this->select_dropdown();
			
			?>
			
			<?php
			
				print "<center>";
				
				if( isset( $_POST['from'] ) && !empty( $_POST['from'] )  && isset( $_POST['to'] ) && !empty( $_POST['to'] ) ){
					
					$from  = sanitize_text_field( $_POST['from'] );					
					$to  = sanitize_text_field( $_POST['to'] );
					
					print "<h3>".date( 'd/m/Y', strtotime( esc_html( $from ) ) )." to ". date( 'd/m/Y', strtotime( esc_html( $to ) ) )."</h3>";
					
				}elseif( isset( $_POST['m'] ) && !empty( $_POST['m'] ) ){
					
					$month  = sanitize_text_field( $_POST['m'] );	
					print "<h3>".date( "F Y", strtotime( esc_html( $month )  ) )."</h3>";
					
				}elseif( isset( $_POST['selected'] ) && !empty( $_POST['selected'] ) ){
					
					$selected  = sanitize_text_field( $_POST['selected'] );
					print "<h3>". esc_html__( ' results ', 'crm-erp-business-solution' ). esc_html__( ' for ','crm-erp-business-solution' ). date( 'd/m/Y', strtotime( esc_html( $selected ) ) )." to ".date( 'd/m/Y' )."</h3>";
					
				}elseif( isset( $_POST['y'] ) && !empty( $_POST['y'] ) ){
					
					$year  = sanitize_text_field( $_POST['y'] );
					print "<h3>".esc_html( $year ). esc_html__( ' Analysis ', 'crm-erp-business-solution' )."</h3>";
					
				}else {
					
					if( isset( $_REQUEST['tab'] ) &&  $_REQUEST['tab'] == 'reports' ){
						
						print "<h3>".esc_html__( ' results ', 'crm-erp-business-solution' ). esc_html__( ' for ', 'crm-erp-business-solution' ).date('F')." </h3>";
						
					}
				}
				
				print "</center>";
			
			?>
		</div>
		
		
			<div>
				<canvas id="amounts" ></canvas>
			</div>
			
			<div class=' overview'>
						
				<?php
				$toshow = array();
				$toshow[] = array( "name"=> esc_html__( 'GRAND CRM-ERP TOTAL', 'crm-erp-business-solution' ), "amount"=> $this->displayTotalEarned() - $this->displayTotalPaid() );
				$toshow[] = array( "name"=> esc_html__( 'TOTAL SALES / paid', 'crm-erp-business-solution' ), "amount"=> $this->displayTotalEarned() );
				$toshow[] = array( "name"=> esc_html__( 'DUE TO GET PAID', 'crm-erp-business-solution' ), "amount"=> $this->displayTotalDueEarn() );
				$toshow[] = array( "name"=> esc_html__( 'TOTAL PAYMENTS / paid', 'crm-erp-business-solution' ), "amount"=> $this->displayTotalPaid() );
				$toshow[] = array( "name"=> esc_html__( 'TOTAL DUE TO PAY', 'crm-erp-business-solution' ), "amount"=> $this->displayTotalPay() );
				
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					$extra[] = array( "name"=> esc_html__( 'ESHOP SALES - needs Addon', 'crm-erp-business-solution' ), "amount"=> '' );
					$extra = apply_filters( "crmerpbs_report_view_general_eshop", $extra );
				}
				$toshow = array_merge( $toshow, $extra );	
				?>

			</div>
			
				<script>
				var ctx = document.getElementById( "amounts" );
				var myChart = new Chart(ctx, {
					type: 'horizontalBar',
					data: {
						labels: [<?php foreach( $toshow as $rep ){ print '"' . esc_html( $rep['name'] ) .": ".esc_html( crm_price( $rep['amount'] ) ). '",';};?>],
						datasets: [{
							label: '',
							data: [<?php foreach( $toshow as $rep ){ print '"' .  esc_html( $rep['amount'] ) . '",';};?>],
							backgroundColor:[<?php foreach( $toshow as $rep ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],				
							borderColor:[<?php foreach( $toshow as $rep ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],					
							borderWidth: 1
						}]
					},
					options: {
						title: {
							display: true,
							text: "<?php esc_html_e( 'GENERAL STATS', 'crm-erp-business-solution' );?>"
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

	public function extraQueryFilters(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) && isset( $_REQUEST['page'] ) && $_REQUEST['page'] == "crm-erp-business-solution" ){
						
			if( isset( $_REQUEST['from'] ) && !empty( $_REQUEST['from'] )  && isset( $_REQUEST['to'] ) && !empty( $_REQUEST['to'] )  ){			

				$from = date( 'Y-m-d', strtotime( $_REQUEST['from']) ); // or your date as well		
				$to = date( 'Y-m-d  23:59:00', strtotime( $_REQUEST['to'] ) );		
				$datediff = strtotime( $to ) - strtotime( $from );		
				$datediff = abs( round( $datediff / ( 60 * 60 * 24 ) ) );
			
			}elseif( isset( $_POST['m'] ) && !empty( $_POST['m'] ) ){
				
				$month = explode( "-", $_POST['m'] );
				
				$from = date( 'Y-m-01', strtotime( $_REQUEST['m'].'-01-01' ) );
				$to = date( 'Y-m-31', strtotime( $_REQUEST['m'].'-12-31' ) );
				$datediff = date( "t" );
				
			}elseif( isset( $_POST['y'] ) && !empty( $_POST['y'] ) ){
				
				if( date('Y') == date( $_POST['y'] ) ){
					
					$from = date( 'Y-01-01', strtotime( $_REQUEST['y'].'-01-01' ) );
					$to = date( 'Y-12-31', strtotime( $_REQUEST['y'].'-12-31' ) );
					$datediff = strtotime( $to ) - strtotime( $from );
					$datediff = abs( round( $datediff / ( 60 * 60 * 24 ) ) );	
					
				}else{
					
					$from = date( 'Y-01-01', strtotime( $_REQUEST['y'].'-01-01' ) );
					$to = date( 'Y-12-31', strtotime( $_REQUEST['y'].'-12-31' ) );			
					$datediff = 365;
					
				}
			}elseif( isset( $_POST['selected'] ) && !empty( $_POST['selected'] ) ){

				$to = date( 'Y-m-d 23:59:00' ); // or your date as well
				$from = date('Y-m-d', strtotime( $_POST['selected'] ) );			
				$datediff = strtotime( $to ) - strtotime( $from );
				$datediff = abs( round( $datediff / ( 60 * 60 * 24 ) ) );
				
			}else{
				
				if( isset( $_REQUEST['tab'] ) &&  $_REQUEST['tab'] == 'reports' ){
					$from =  date( 'Y-m-01' );
					$to = date( 'Y-m-31' );		
					$datediff = strtotime( $to ) - strtotime( $from );
					$datediff = round( $datediff / ( 60 * 60 * 24 ) );
				}
			}
			
			if( !empty( $from ) ){
				array_push( $this->parameters, sanitize_text_field( $from ) );
			}	
			if( !empty( $to ) ){
				array_push( $this->parameters, sanitize_text_field( $to ) ); 
			}
			
			if( isset( $_REQUEST['user'] ) && !empty( $_REQUEST['user'] ) ){
				array_push( $this->parameters, sanitize_text_field( $_REQUEST['user'] ) ); 
			}
			
		}
	}
	
	public function displayTotalEarned(){	
	
		global $wpdb;
				
		$parameters = array();
		array_push( $parameters, 'saleinvoice' ); 
		$parameters = array_merge( $parameters, $this->parameters );
		$parameters = array_map( 'sanitize_text_field', $parameters );

		if( count( $this->parameters  ) == 2 ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND creationdate >= %s AND creationdate <= %s " , $parameters ) );
		}elseif( count( $this->parameters  ) == 3  ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND creationdate >= %s AND creationdate <= %s AND user = %s " , $parameters ) );
		}elseif( count( $this->parameters  ) == 1  ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND user = %s " , $parameters ) );
		
		}else{
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s " , $parameters ) );
		}

		return $cc;
		
	}


	
	public function displayTotalDueEarn(){	
	
		global $wpdb;
		$parameters = array();
		array_push( $parameters, 'saleinvoice' ); 
		
		$parameters = array_merge( $parameters, $this->parameters );
		$parameters = array_map( 'sanitize_text_field', $parameters );
		
		if( count( $this->parameters  ) == 2 ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND creationdate >= %s AND creationdate <= %s " , $parameters ) );
		}elseif( count( $this->parameters  ) == 3  ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND creationdate >= %s AND creationdate <= %s AND user = %s " , $parameters ) );
		}elseif( count( $this->parameters  ) == 1  ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND user = %s " , $parameters ) );
		
		}else{
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s " , $parameters ) );
		}
		
		return  $cc;

	}	
	
	public function displayTotalPaid(){	
	
		global $wpdb;
		
		$parameters = array();
		array_push( $parameters, 'payinvoice' ); 
		$parameters = array_merge( $parameters, $this->parameters );
		$parameters = array_map( 'sanitize_text_field', $parameters );
		
		if( count( $this->parameters  ) == 2 ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND creationdate >= %s AND creationdate <= %s " , $parameters ) );
		}elseif( count( $this->parameters  ) == 3  ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND creationdate >= %s AND creationdate <= %s AND user = %s " , $parameters ) );
		}elseif( count( $this->parameters  ) == 1  ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND user = %s " , $parameters ) );
		
		}else{
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(paid) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s " , $parameters ) );
		}
		
		return $cc;

	}	

	public function displayTotalPay(){	
		global $wpdb;
		
		$parameters = array();
		array_push( $parameters, 'payinvoice' ); 
		$parameters = array_merge( $parameters, $this->parameters );
		$parameters = array_map( 'sanitize_text_field', $parameters );
		
		if( count( $this->parameters  ) == 2 ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND creationdate >= %s AND creationdate <= %s " , $parameters ) );
		}elseif( count( $this->parameters  ) == 3  ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND creationdate >= %s AND creationdate <= %s AND user = %s " , $parameters ) );
		}elseif( count( $this->parameters  ) == 1  ){
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s AND user = %s " , $parameters ) );
		
		}else{
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT sum(balance) FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type =%s " , $parameters ) );
		}
				
		return  $cc;

	}

	public function get_transaction_months(){
		
		global $wpdb;
		$months = '';

			
			if( isset( $_REQUEST['view'] ) &&  $_REQUEST['view'] == 'sales'  ) {
				$type = 'saleinvoice' ;
			}else {
				$type = 'payinvoice' ;
			}
			global $wpdb;
			
			if( ( isset( $_REQUEST['view'] ) && $_REQUEST['view'] == 'sales' ) || ( isset($_REQUEST['view'] )  &&  $_REQUEST['view'] == 'payments' ) ){
				 
				$months = $wpdb->get_results( $wpdb->prepare( " SELECT DISTINCT YEAR( creationdate ) AS year, MONTH( creationdate ) AS month FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type = %s ORDER BY creationdate DESC ", $type ), ARRAY_A );
				
			}else $months = $wpdb->get_results( "SELECT DISTINCT YEAR( creationdate ) AS year, MONTH( creationdate ) AS month FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions ORDER BY creationdate DESC ", ARRAY_A );
			
			$month_count = count( $months );
		
				
		if( has_filter( "crmerpbs_get_report_months" ) ){
			$months = apply_filters( "crmerpbs_get_report_months", $months );
		}		
		return $months;
	}	

	public function get_transaction_years(){
		
		global $wpdb;
		$years = '';

			if( isset( $_REQUEST['view'] ) &&  $_REQUEST['view'] == 'sales'  ) {
				$type = 'saleinvoice' ;
			}else {
				$type = 'payinvoice' ;
			}
			
			global $wpdb;
			
			if( ( isset( $_REQUEST['view'] ) && $_REQUEST['view'] == 'sales' ) || ( isset($_REQUEST['view'] )  &&  $_REQUEST['view'] == 'payments' ) ){
				
				$years = $wpdb->get_results( $wpdb->prepare( " SELECT DISTINCT YEAR( creationdate ) AS year FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE type = %s ORDER BY creationdate DESC " , $type ), ARRAY_A );
				
			}else $years = $wpdb->get_results( " SELECT DISTINCT YEAR( creationdate ) AS year FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions ORDER BY creationdate DESC ", ARRAY_A );
			
		
		
		
		if( has_filter( "crmerpbs_get_report_years" ) ){
			$years = apply_filters( "crmerpbs_get_report_years", $years );
		}			
		
		return $years;
		
	}
	
	public function select_dropdown() {
		
		global $wp_locale;
		
		
		$months = $this->get_transaction_months();	
		$years = $this->get_transaction_years();

		$year_count = count( $years );
			
		if ( $year_count < 1 ) {
			echo "<div class=' notice notice-error is-dismissible'><p>".esc_html__( "There are no records yet!" , 'crm-erp-business-solution' ) ."</p></div>";
		}			
			
		?>
	
		<div class='wooCalendar overview'>
		
		<form method='post'  id='selectDate' autocomplete="off" role="presentation" >
		
		<?php if( isset( $_REQUEST['view'] ) && ( $_REQUEST['view'] == 'sales' || $_REQUEST['view'] == 'payments' || $_REQUEST['view'] == 'eshop'  ||  $_REQUEST['view'] == 'year' || $_REQUEST['view'] == 'month' ) ){ ?>

			<select class='email_select_user proVersion'>
			
				<option value=''><?php esc_html_e( "Query by..", 'crm-erp-business-solution' ); ?></option>
							
				<?php $options = "<option disabled class='proVersion' value=''>". esc_html__( "User Segment", 'crm-erp-business-solution' ) . " / " .CrmErpSolution::get_instance()->proAddon(); "</option>";

				if( isset( $_REQUEST['view'] ) && (  $_REQUEST['view'] != 'year' && $_REQUEST['view'] != 'month' ) ){ 
				
					$options .= "<option class='proVersion' disabled>". esc_html__( "Product Bought", 'crm-erp-business-solution' ) . " / " .CrmErpSolution::get_instance()->proAddon(). "</option>";
					$options .= "<option class='proVersion' disabled >". esc_html__( "Product Category ", 'crm-erp-business-solution' ) . " / " .CrmErpSolution::get_instance()->proAddon() ."</option>";
				}
				$options .= "<option class='proVersion' disabled>". esc_html__( "Specific User", 'crm-erp-business-solution' ) . " / " .CrmErpSolution::get_instance()->proAddon(). "</option>";
				
				if( has_filter( "crmerpbs_report_query_options" ) ){
					
					$options = apply_filters( "crmerpbs_report_query_options", $options );
				}						
				print wp_kses( $options , CrmErpSolution::get_instance()->allowed_html );	 ?>	
				
			</select>
					
			<?php do_action( "crmerpbs_report_query" ) ; ?>						
			
			
		<?php }


		if(  isset( $_REQUEST['view'] ) &&  ( $_REQUEST['view'] == 'year' || $_REQUEST['view'] == 'month' ) ) { 
			//silence is gold
			
			
		} else{
			
			
				
			$yearsToDisplay = array();
			$monthsToDisplay = array();
			$monthsToCheck = array();
			?>
		
			<label for="filter-by-date" class="screen-reader-text">
				<?php esc_html_e( 'Filter by Month / Year' , 'crm-erp-business-solution' ); ?>
			</label>
			
			<select name="m" class='dateFilter' id="pt-filter-by-date">
			
				<option value=''><?php  esc_html_e( 'Select Month', 'crm-erp-business-solution' );?></option>
				 <?php
				$first = 0;			
				 foreach ( $months  as $month ) {
					 if ( 0 == $month['month'] )
						 continue;
						$mon = zeroise( $month['month'], 2 );
					 if( !in_array( $month['year']."-".$month['month'], $monthsToCheck ) ){
						  array_push( $monthsToCheck, $month['year']."-".$month['month'] ); 
						  $monthsToDisplay[] = array( "date" =>  strtotime( $month['year']."-".$month['month'] ) , "month" => sanitize_text_field( $month['month'] ), "year" => sanitize_text_field( $month['year'] ) );
					 }				 
				}
				$first = sanitize_text_field( $month['year'] . '-' . $mon . '-1' );
				foreach( $monthsToDisplay as $monthToDisplay ){
					print "<option value='".esc_attr( $monthToDisplay['year']. "-". zeroise( $monthToDisplay['month'], 2 )."-1" )."' >".esc_html( $wp_locale->get_month( $monthToDisplay['month'] ) ." ".  $monthToDisplay['year'] )."</option>";
				}
				
				?>
				
			</select>

			<select name="y" class='dateFilter' id="pt-filter-by-year">
			
				<option value=''><?php  esc_html_e( 'Select Year', 'crm-erp-business-solution' );?></option>
				
				 <?php
				 
				 foreach ( $years  as $year ) {
					 if ( 0 == $year['year'] )
						 continue;
					 if( !in_array( $year['year'], $yearsToDisplay ) ){
						 array_push( $yearsToDisplay, sanitize_text_field( $year['year'] ) ); 
					 }

				} 
				foreach( $yearsToDisplay as $yearToDisplay ){
					print "<option value='".esc_attr( $yearToDisplay )."' >".esc_html( $yearToDisplay )."</option>";
				}				 
				?>
			</select>

			<select name="selected" class='dateFilter'>
				<option value=""><?php  esc_html_e( 'Preselected Period', 'crm-erp-business-solution' );?></option>
				<option value="<?php print date('Y-m-d'); ?>"><?php  esc_html_e( 'Today', 'crm-erp-business-solution' );?></option>
				<option value="<?php print date('Y-m-d', strtotime("- 1 day")); ?>"><?php  esc_html_e( 'Yesterday', 'crm-erp-business-solution' );?></option>
				<option value="<?php print date('Y-m-d', strtotime("- 7 days")); ?>"><?php  esc_html_e( 'This Week', 'crm-erp-business-solution' );?></option>
				<option value="<?php print date('Y-m-d', strtotime("first day of this month")); ?>"><?php  esc_html_e( 'This Month', 'crm-erp-business-solution' );?></option>
				<option value="<?php print date('Y-m-d', strtotime("- 2 months")); ?>"><?php  esc_html_e( 'Last 2 Months', 'crm-erp-business-solution' );?></option>
				<option value="<?php print date('Y-m-d', strtotime("- 3 months")); ?>"><?php  esc_html_e( 'Last 3 Months', 'crm-erp-business-solution' );?></option>
				<option value="<?php print date('Y-m-d', strtotime("- 6 months")); ?>"><?php  esc_html_e( 'Last 6 Months', 'crm-erp-business-solution' );?></option>
				<option value="<?php print esc_attr( $first ); ?>"><?php  esc_html_e( 'Get All', 'crm-erp-business-solution' );?></option>
			</select>
			 <input  placeholder='From'  class="from datepicker dateFilter" name='from' value='' />
			 <input  placeholder='To'  class="to datepicker dateFilter"  name='to' value='' />
			 <input type='hidden' name='action' value='get_orders_archive' />
		 <?php } ?>
		 <?php wp_nonce_field( 'crm-erp-business-solution' ); ?>
		 <input type='submit' class='button button-primary' value='<?php  print esc_html__( "Search" , 'crm-erp-business-solution' ); ?>' />
		 </form>
		 
		 </div>

	<?php 
	}

	public function byDate(){
		
		do_action( "crmerpbs_query_by_dateReport_message"  ); 
		
	
		$theresults = array();
		$dates = array();
		$sales = array();
		$payments = array();
		$orders = array();
		
		global $wpdb;
		
		$parameters = array();
		
		if( isset( $_GET['view'] ) && $_GET['view'] == 'month' ){
						
			$type1 = 'salepayment';
			$type2 = 'paypayment';
			array_push( $parameters, $type1, $type2 );
			
			if( isset( $_REQUEST['user'] ) && $_REQUEST['user'] != '' ){
				$user = sanitize_text_field( $_REQUEST['user'] ); 
				array_push( $parameters, $user );
				$parameters = array_map( 'sanitize_text_field', $parameters );
				$results = $wpdb->get_results( $wpdb->prepare( "SELECT YEAR(paydate) as year, MONTH(paydate) as month, sum(paid) as paid, sum(grandtotal) as grandtotal, type  FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE ( type=%s || type=%s ) and user=%s GROUP BY DATE_FORMAT(paydate, '%Y%m'), type ORDER BY paydate DESC " , $parameters ) );
				
			}elseif( isset( $_REQUEST['selectUsersHidden'] ) && $_REQUEST['selectUsersHidden'] != '' ){
				
				$usersArray = array_map( 'intval', explode( ',', sanitize_text_field( $_REQUEST['selectUsersHidden'] ) ) );
				$placeholders = array_fill( 0, count( explode( ',', sanitize_text_field( $_REQUEST['selectUsersHidden'] ) ) ), '%s' ); // create a string of %s - one for each array value. -NEW FOR PREPARE
				$placeh = join( ',', $placeholders ); // now turn it into "%s,%s,%s" - NEW FOR PREPARE
				$parameters = array_merge( $parameters, $usersArray ); // pass the user ids
				
				$results = $wpdb->get_results( $wpdb->prepare( "SELECT YEAR(paydate) as year, MONTH(paydate) as month, sum(paid) as paid, sum(grandtotal) as grandtotal, type  FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE ( type=%s || type=%s ) and user IN (".$placeh.") GROUP BY DATE_FORMAT(paydate, '%Y%m'), type ORDER BY paydate DESC " , $parameters ) );
				
			}else{
				$parameters = array_map( 'sanitize_text_field', $parameters );
				$results = $wpdb->get_results( $wpdb->prepare( "SELECT YEAR(paydate) as year, MONTH(paydate) as month, sum(paid) as paid, sum(grandtotal) as grandtotal, type  FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE ( type=%s || type=%s ) GROUP BY DATE_FORMAT(paydate, '%Y%m'), type ORDER BY paydate DESC " , $parameters ) );
			}
					
		}else{
			
			$type1 = 'salepayment';
			$type2 = 'paypayment';
			array_push( $parameters, $type1, $type2 );
			
			if( isset( $_REQUEST['user'] ) && $_REQUEST['user'] != '' ){
				$user = sanitize_text_field( $_REQUEST['user'] ); 
				array_push( $parameters, $user );
				
				$parameters = array_map( 'sanitize_text_field', $parameters );
				$results = $wpdb->get_results( $wpdb->prepare( "SELECT YEAR(paydate) as year, sum(paid) as paid, sum(grandtotal) as grandtotal, type FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE ( type=%s || type=%s ) and user=%s GROUP BY DATE_FORMAT(paydate, '%Y'), type ORDER BY paydate DESC " , $parameters ) );
			
			}elseif( isset( $_REQUEST['selectUsersHidden'] ) && $_REQUEST['selectUsersHidden'] != '' ){
				
				$usersArray = array_map( 'intval', explode( ',', sanitize_text_field( $_REQUEST['selectUsersHidden'] ) ) );
				$placeholders = array_fill( 0, count( explode( ',', sanitize_text_field( $_REQUEST['selectUsersHidden'] ) ) ), '%s' ); // create a string of %s - one for each array value. -NEW FOR PREPARE
				$placeh = join( ',', $placeholders ); // now turn it into "%s,%s,%s" - NEW FOR PREPARE
				$parameters = array_merge( $parameters, $usersArray ); // pass the user ids
				$parameters = array_map( 'sanitize_text_field', $parameters );
				$results = $wpdb->get_results( $wpdb->prepare( "SELECT YEAR(paydate) as year, sum(paid) as paid, sum(grandtotal) as grandtotal, type FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE ( type=%s || type=%s )  and user IN (".$placeh.") GROUP BY DATE_FORMAT(paydate, '%Y'), type ORDER BY paydate DESC " , $parameters ) );
				
			}else{
				$parameters = array_map( 'sanitize_text_field', $parameters );
				$results = $wpdb->get_results( $wpdb->prepare( "SELECT YEAR(paydate) as year, sum(paid) as paid, sum(grandtotal) as grandtotal, type FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions WHERE ( type=%s || type=%s ) GROUP BY DATE_FORMAT(paydate, '%Y'), type ORDER BY paydate DESC " , $parameters ) );		
			}
						
		}
			
			if( $results ){	
				foreach ( $results as $res ){
					
					if( isset( $_GET['view'] ) && $_GET['view'] == 'month' ){
						$theresults[] = array( "date" => date("m-Y", strtotime( "01-".$res->month ."-". $res->year ) ), "paid" => sanitize_text_field( $res->paid ) , "type" =>  sanitize_text_field( $res->type ) ); 
											
						if( $res->type == 'salepayment' ){						
							$sales[] = array( "date" => date( "m-Y", strtotime( "01-".$res->month ."-". $res->year ) ) , "paid" =>  sanitize_text_field( $res->paid ) );						
						}else $payments[] = array( "date" => date( "m-Y", strtotime( "01-".$res->month ."-". $res->year ) ) , "paid" =>  sanitize_text_field( $res->paid ) );
					
					}else{
						$theresults[] = array( "date" =>  sanitize_text_field( $res->year ), "paid" =>  sanitize_text_field( $res->paid ) , "type" =>  sanitize_text_field( $res->type ) ); 
											
						if( $res->type == 'salepayment' ){						
							$sales[] = array( "date" =>  sanitize_text_field( $res->year ) , "paid" =>  sanitize_text_field( $res->paid ) );						
						}else $payments[] = array("date" =>  sanitize_text_field( $res->year ) , "paid" =>  sanitize_text_field( $res->paid ) );						
					}
				}
			}
		
		$totalSales = array_sum( array_column( $sales,'paid' ) );
		
		$totalPayments = array_sum( array_column( $payments, 'paid' ) );
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$totalOrders = '';
		}
		$reports = array();
		$reports[] = array( "amount" => $totalSales, "name" => esc_html__( "Sales" , 'crm-erp-business-solution' ) );
		$reports[] = array( "amount" => $totalPayments, "name" => esc_html__( "Payments" , 'crm-erp-business-solution' ) );
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$reports[] = array( "amount" => $totalOrders, "name" => esc_html__( "Eshop Orders *" , 'crm-erp-business-solution' ) );
		}
		?>
		<div class='crmflex'>
		<div class=''>
			<table class="widefat striped" >
				<thead>
				   <tr class="row-title">
						<th><?php  esc_html_e( 'Date', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e( 'ERP Sales', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e( 'ERP Payments/Purchases', 'crm-erp-business-solution' );?></th>
						<th>
						<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {	
							print esc_html__( 'Eshop Sales', 'crm-erp-business-solution' ). " / " . CrmErpSolution::get_instance()->wooAddon();
						} ?>
						</th>
					</tr>
				
				</thead>		
				<tbody>
					<?php
					//GROUP BY date
	
					$result = array();	
					foreach ( $theresults as $element ) {
						$result[$element['date']][] = $element;
					}
					$countResult =  count($result);

					foreach( $result as $key=>$value ){
						if( $_REQUEST['view'] =='year' ){
							array_push( $dates,$key ) ;
						}else array_push( $dates, date( "m-Y",strtotime( "01-".$key ) ) );
					}
					
					$multireports = array();
					
					//add  '-' sign to empty values from correct representation in table
					$saleDates = array_diff( $dates, array_column( $sales, 'date' ) );   
					foreach( $saleDates as $res ){	
						$sales[] = array("date" => $res, "paid" => '-' );
					}
					$paymentDates = array_diff( $dates, array_column( $payments, 'date' ) );   
					foreach( $paymentDates as $res ){	
						$payments[] = array("date" => $res, "paid" => '-' );
					}

					foreach( $dates  as $res ){
						$res = sanitize_text_field( $res );
						print "<tr>";
							print "<td>". esc_html( $res ). "</td>";

							foreach (  $sales as $sale ) {
								
								if( $res == $sale['date'] ) {
									$paid = sanitize_text_field( $sale['paid'] );
									print "<td>". esc_html( crm_price( $paid ) ). "</td>";					
									$multireports[] = array( "date" => $res ,"type" => 'sale', "paid" => $paid );					
								}
								
							}

							foreach ( $payments  as $payment ) {
							
								if( $res == $payment['date'] ) {
									$paid = sanitize_text_field( $payment['paid'] );
									print "<td>". esc_html( crm_price( $paid ) ). "</td>";
									$multireports[] = array( "date" => $res ,"type" => 'payment', "paid" => $paid );
								}
							}
																		
						print "</tr>";
						
					}
					echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td>". esc_html( crm_price( $totalSales ) )."</td><td>". esc_html( crm_price( $totalPayments ) )."</td>";
					if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {					
						print "<td>". esc_html(  crm_price( $totalOrders ) )."</td>";
						
					}
					print "</tr>";
					?>
				</tbody>
			</table>
		</div>
		<div>
			<canvas id="reportChart"></canvas>
		</div>
		
	</div>
		
	<canvas id="myChart"></canvas>
			<script>
			var ctx = document.getElementById( "reportChart" );
			var myChart = new Chart(ctx, {
				type: 'pie',
				data: {
					labels: [<?php foreach( $reports as $rep ){ print '"' . esc_html( $rep['name'] ) . '",';};?>],
					datasets: [{
						label: '',
						data: [<?php foreach( $reports as $rep ){print '"' .  esc_html( $rep['amount'] ) . '",';};?>],
						backgroundColor:[<?php foreach( $reports as $rep ){print '"' .esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],				
						borderColor:[<?php foreach( $reports as $rep ){print '"' .esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],					
						borderWidth: 1
					}]
				},
				options: {
					title: {
						display: true,
						text: ''
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
			
			
			var ctx = document.getElementById( "myChart" ).getContext("2d");

			var data = {
			  labels: [<?php foreach( $dates as $rep ){ print '"' . esc_html( $rep ). '",';};?>],
			  datasets: [{
				label: "<?php esc_html_e( 'Sales', 'crm-erp-business-solution' ); ?>",
				backgroundColor: "blue",
				data: [<?php foreach( $multireports as $rep ){if($rep['type']=='sale')print '"' . esc_html( $rep['paid'] ) . '",';};?>]
			  }, {
				label: "<?php esc_html_e( 'Payments', 'crm-erp-business-solution' ); ?>",
				backgroundColor: "red",
				data: [<?php foreach( $multireports as $rep ){if($rep['type']=='payment')print '"' . esc_html( $rep['paid'] ) . '",';};?>]
			  }, {
				label: "<?php esc_html_e( 'Orders *', 'crm-erp-business-solution' ); ?>",
				backgroundColor: "green",
				data: [<?php foreach( $multireports as $rep ){ if( $rep['type'] == 'order' ) print '"",';};?>]
			  }]
			};

			var myBarChart = new Chart(ctx, {
			  type: 'bar',
			  data: data,
			  options: {
				barValueSpacing: 20,
				scales: {
				  yAxes: [{
					ticks: {
					  min: 0,
					}
				  }]
				}
			  }
			});			
			</script>		
		<?php
	}



	public function all_crmerp_transactions(){
	
		
	if( $_SERVER['REQUEST_METHOD'] == 'POST' &&  current_user_can( 'crm-erp-business-solution' ) ) {
		
		check_admin_referer( 'crm-erp-business-solution' );
		check_ajax_referer( 'crm-erp-business-solution' );
	
		if( isset( $_POST['from'] ) && !empty( $_POST['from'] )  && isset( $_POST['to'] ) && !empty( $_POST['to'] ) ){			

			$from = date( 'Y-m-d', strtotime( $_POST['from'] ) ); // or your date as well
			$to = date( 'Y-m-d  23:59:00', strtotime( $_POST['to'] ) );
			
			$datediff = strtotime( $to ) - strtotime( $from );
			$datediff = abs( round( $datediff / ( 60 * 60 * 24 ) ) );
		
		}elseif( isset( $_POST['m'] ) && !empty( $_POST['m'] ) ){
			$month = explode( "-", $_POST['m'] );

			$from = date( 'Y-m-01', strtotime( $_REQUEST['m'].'-01-01' ) );
			$to = date( 'Y-m-31  23:59:00', strtotime( $_REQUEST['m'].'-12-31' ) );
			$datediff = date( "t" );
			
		}elseif( isset( $_POST['y']) && !empty( $_POST['y'] ) ){
			
			if( date('Y') == date( $_POST['y'] ) ){
				
				$from = date( 'Y-01-01', strtotime( $_REQUEST['y'].'-01-01' ) );
				$to = date( 'Y-12-31', strtotime( $_REQUEST['y'].'-12-31' ) );
				$datediff = strtotime( $to ) - strtotime( $from );
				$datediff = abs( round( $datediff / ( 60 * 60 * 24 ) ) );	
				
			}else{
				$from = date( 'Y-01-01', strtotime( $_REQUEST['y'].'-01-01' ) );
				$to = date( 'Y-12-31', strtotime( $_REQUEST['y'].'-12-31' ) );			
				$datediff = 365;
			}
			
		}elseif( isset( $_POST['selected'] ) && !empty( $_POST['selected'] ) ){

			$to = date( 'Y-m-d  23:59:00' ); // or your date as well
			$from = date( 'Y-m-d', strtotime( $_POST['selected'] ) );			
			$datediff = strtotime( $to ) - strtotime( $from );
			$datediff = abs( round( $datediff / ( 60 * 60 * 24 ) ) );
		}else{

			$from =  date( 'Y-m-01' );
			$to = date( 'Y-m-31' );		
			$datediff = strtotime( $to ) - strtotime( $from );
			$datediff = round( $datediff / ( 60 * 60 * 24 ) );			
		}

		
		
	}else{ //--> this month

			$from =  date( 'Y-m-01' );
			$to = date( 'Y-m-31' );			
			$datediff = strtotime( $to ) - strtotime( $from );
			$datediff = round( $datediff / ( 60 * 60 * 24 ) );	
								
	}
		
		
	global $wpdb;

	if( isset( $_GET['view'] ) ){
		if ( $_GET['view'] == 'sales' ){
			$type = 'saleinvoice';
			$paidType = 'salepayment';
			$transaction =  esc_html__( 'SALES', 'crm-erp-business-solution' );
		}else {
			$type = 'payinvoice';
			$paidType = 'paypayment';
			$transaction = esc_html__( 'PAYMENTS', 'crm-erp-business-solution' );
		}
	}
	
	// build the query & parameters
	$parameters = array();
	array_push( $parameters, $type );
	if( !empty( $from ) ){
		array_push( $parameters, $from );
	}	
	if( !empty( $to ) ){
		array_push( $parameters, $to );
	}
	array_push( $parameters, $paidType );
	
	if( !empty( $from ) ){
		array_push( $parameters, $from );
	}	
	if( !empty( $to ) ){
		array_push( $parameters, $to );
	}		
	
	$parameters = array_map( 'sanitize_text_field', $parameters );	
	$results = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE ( type=%s AND creationdate >= %s AND creationdate <= %s  ) || ( type=%s AND paydate >= %s AND paydate <= %s ) ORDER BY creationdate DESC ", $parameters ) );	
	 
		if($results ){
					
			$sales = array();
			$actualpayments = array();
			$orders = array();
			$products = array();
			$categories = array();
			$customers = array();
			$countries = array();
			$coupons = array();
			$payments = array();
			$productnames = array();
			
			$dataPoint = array();
			$catData = array();
			$couponData = array();
			$report = array();
			
			$subtotal = 0;
			$discount = 0;
			$refunds = 0;
			$shipping = 0;
			$total = 0;
			$taxes = 0;
			$numOrders = count( $results ); 
			$numPro = 0;
			$specificTotal = 0;
			$paid = 0;
			$balance = 0;
			$payresults = 0;
			$uniqueDates = array();
			
			$orderIds = array();
	
		foreach( $results as $res ){
										
				$theproducts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' )." WHERE trans_id=%d ", (int)$res->id ) );
				
				$names = array();

				$user = get_user_by( 'id', $res->user );								

				array_push( $uniqueDates, date( "d M Y", strtotime( $res->creationdate ) ) );

								
				$sales[] = array("paid" => $res->paid ,"balance" => sanitize_text_field( $res->balance ) ,"amount" => sanitize_text_field( $res->grandtotal ), "date" => date("d M Y",strtotime( $res->creationdate ) ) );
								
								
				if( strstr( $res->type,'invoice' ) ){
									
					$orders[] = array( "paid" => sanitize_text_field( $res->paid ) ,"balance"=> sanitize_text_field( $res->balance ),'refund' => '',"orderid" => (int)$res->id, "date" => date( "d M Y",strtotime( $res->creationdate ) ),"quantity" => '',"payment" => sanitize_text_field( $res->payment_method ), "amount" => sanitize_text_field( $res->grandtotal ), "refund" => '',"tax" => sanitize_text_field( $res->tax ), 'discount' => sanitize_text_field( $res->discount ), 'shipping' => '','name' => sanitize_text_field( $res->user ), 'country' => sanitize_text_field( $user->billing_country ), 'coupons' => '' ,'subtotal' => sanitize_text_field( $res->total ) );	
					$tempArr = array_unique( array_column( $orders, 'orderid' ) );
					$orders = array_intersect_key( $orders, $tempArr );	
									
				}
								
								
				if( strstr( $res->type,'payment' ) ){
									
					$actualpayments[] = array( "paid" => sanitize_text_field( $res->paid ) ,"orderid" => (int)$res->id, "date" => date( "d M Y",strtotime( $res->creationdate ) ),"payment_date" => date( "d M Y",strtotime( $res->paydate ) ),"payment" => sanitize_text_field( $res->payment_method ), 'name' => sanitize_text_field( $res->user ),'country' => sanitize_text_field( $user->billing_country ), 'parent' => sanitize_text_field( $res->parent ) );													
				}
								
				if( strstr( $res->type,'invoice' ) ){
					
					$customers[] = array( 'refund' => '',"name" => sanitize_text_field( $res->user ), "phone" => sanitize_text_field( $user->billing_phone ), "mail" => sanitize_text_field( $user->user_email ), "country" => sanitize_text_field( $user->billing_country ), "state" => sanitize_text_field( $user->billing_state ), "city" => sanitize_text_field( $user->billing_city ), "quantity" => '', "amount" => sanitize_text_field( $res->grandtotal ) , "date" =>date( "d M Y", strtotime( $res->creationdate ) ) ,"paid" => sanitize_text_field( $res->paid ), "balance" => sanitize_text_field( $res->balance ) );
									
								
					$payments[] = array("paid" => sanitize_text_field( $res->paid ) ,"balance" => sanitize_text_field( $res->balance ) ,'refund'=>'',"quantity"=>'1',"payment" => sanitize_text_field( $res->payment_method ),"amount"=> sanitize_text_field( $res->grandtotal ) , "date" => date( "d M Y", strtotime( $res->creationdate ) ) );
								
					$countries[] = array( "paid" => sanitize_text_field( $res->paid ) ,"balance" => sanitize_text_field( $res->balance ) ,'refund' => '',"name" => sanitize_text_field( $user->billing_country ), "amount" => sanitize_text_field( $res->grandtotal ), "quantity" => '1' );
				}	
								
				foreach( $theproducts as $product ) {	
						 
					$sku = get_post_meta( (int)$product->product_id, 'crmerpbs_sku', true );
												  										  
					$products[] = array( 'discount' => sanitize_text_field( $product->discount ), 'refund' => '', "name" => get_the_title( (int)$product->product_id ),"quantity" => sanitize_text_field( $product->quantity ), "payment" => sanitize_text_field( $res->payment_method ), "amount" => sanitize_text_field( $product->amount ), "date" => date( "d M Y",strtotime( $res->creationdate ) ) , 'sku' => sanitize_text_field( $sku ) , 'total' => sanitize_text_field( $product->total ) );
													
					$products = array_merge( $products, $dataPoint );
												
					if( get_post_type( (int)$product->product_id ) == 'product' || get_post_type( (int)$product->product_id ) == 'product_variation' ){
						$terms = wp_get_post_terms( (int)$product->product_id,'product_cat' , array( 'orderby' => 'id', 'order' => 'DESC' ) );
					}else{
						$terms = wp_get_post_terms( (int)$product->product_id,'off_prod_cat' , array( 'orderby' => 'id', 'order' => 'DESC' ) );
					}

																		
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
														
						if( count( $terms ) > 1 ){
							$term = array_pop( $terms );
						}													
														
						foreach ( $terms as $term ) {
							
							$categories[] = array( "paid" => sanitize_text_field( $res->paid ) ,"balance" => sanitize_text_field( $res->balance ) , 'discount' => sanitize_text_field( $res->discount ),'refund' => '', "name" => sanitize_text_field( $term->name ), "quantity" => sanitize_text_field( $product->quantity ), "amount" => sanitize_text_field( $product->total ) );
							$categories = array_merge( $categories, $catData );	
							
						}					
													} 					
					//push in arrAY FOR GROUPING	
					$numPro++;
				}//end of looping items

			$subtotal = array_sum( array_column( $orders, 'subtotal' ) );
			$discount = array_sum( array_column( $orders, 'discount' ) );
			$shipping += 0;
			$total = array_sum( array_column( $orders, 'amount' ) );
			$refunds += 0;
			$taxes = array_sum( array_column( $orders, 'tax' ) );
			$paid = array_sum( array_column( $orders, 'paid' ) );
			$balance = array_sum( array_column( $orders, 'balance' ) );
			$numPro = array_sum( array_column( $products, 'quantity' ) );
			$payresults = array_sum( array_column( $actualpayments, 'paid' ) );
			
	   }
	   			
		$specificTotal = array_sum( array_column( $products, 'amount') );
		$coupSales = array_column( $sales, 'date' );
		$returnCoup = array_multisort( $coupSales, SORT_ASC , $sales );			
		$salesToFor = array();		
		//GROUP SALES BY DATE
		foreach ( $sales as $element ) {
			$salesToFor[$element['date']][] = $element;
		}	
		$totalAmount = 0;
		foreach( $salesToFor as $res ){			
			//SUM WITHIN MULTIDEMENSIONAL ARRAY
			$am = 0;
			foreach ($res as $item ) {
				$am += $item['amount'];
			}				
			$totalAmount+= $am;
		}
		

		if( $subtotal !='' ){
		   $uniqueDates = array_unique( $uniqueDates );
		   $saleEvery = $datediff / count( $uniqueDates );
			$avg = round( $subtotal / $datediff , 2 );
			$net = $subtotal - $discount;
		}else{
			$numOrders=0;
			$saleEvery =0;
			$foreCast =0;
			$net = $subtotal - $discount;
			$avg = round( $subtotal / $datediff , 2 );
		}



	?>
		
		<div class='overview clearfix'>
			<center>
			<?php 
			if( isset( $_POST['from'] ) && !empty( $_POST['from'] )  && isset( $_POST['to'] ) && !empty( $_POST['to'] ) ){
				print "<h3>". esc_html__( 'Analysis for period', 'crm-erp-business-solution' )." ".date( 'd/m/Y',strtotime( esc_attr( $_POST['from'] ) ) )." to ".date( 'd/m/Y',strtotime( esc_attr( $_POST['to'] ) ) )."</h3>";
			}elseif( isset( $_POST['m'] ) && !empty($_POST['m'])){
				print "<h3>". esc_html__( 'Analysis for ', 'crm-erp-business-solution' ).date( "F Y",strtotime( esc_attr( $_POST['m'] ) ) )."</h3>";
			}elseif( isset( $_POST['selected'] ) && !empty( $_POST['selected'] ) ){
				print "<h3>". esc_html__('Analysis for period', 'crm-erp-business-solution' )." ".date( 'd/m/Y', strtotime( esc_attr( $_POST['selected'] ) ) )." to ".date('d/m/Y')."</h3>";			
			}elseif( isset( $_POST['y'] ) && !empty( $_POST['y'] ) ){
				print "<h3>".esc_html( $_POST['y'] )." ". esc_html__('Analysis', 'crm-erp-business-solution' )."</h3>";
			}else print "<h3>". esc_html__('This Month Analysis', 'crm-erp-business-solution' )."</h3>";
			
			
			?>
			</center>
			
			<?php if( $subtotal !='' || $payresults !='' ){ ?>
			
					<div class='columns4 report_widget'>
						<h3 class='text-center'><i class='fa fa-2x fa-signal' ></i> <?php  print esc_html__( 'TOTAL ', 'crm-erp-business-solution' ). esc_html( $transaction );?> <br/><span><?php print esc_html( crm_price( $total ) ); ?></span></h3>
					</div>	
										
					<div class='columns4 report_widget'>
						<h3 class='text-center'><i class='fa fa-2x fa-signal' ></i> <?php  print esc_html( $transaction ). esc_html__( ' before Taxes', 'crm-erp-business-solution' );?> <br/><span><?php print esc_html( crm_price( $subtotal ) ); ?></span></h3>
					</div>						

					<div class='columns4 report_widget'>
						<h3 class='text-center'><i class='fa fa-2x fa-percent' ></i> <?php  print esc_html__( 'TAXES', 'crm-erp-business-solution' );?>  <br/><span><?php print esc_html( crm_price( $taxes ) ) ; ?></span></h3>
					</div>	
						
					
					<div class='columns4 report_widget'>
						<h3 class='text-center'><i class='fa fa-2x fa-tag' ></i> <?php  print esc_html__( 'DISCOUNT', 'crm-erp-business-solution' );?>  <br/><span><?php print esc_html(crm_price( $discount ) ); ?></span></h3>
					</div>			
					<div class='columns4 report_widget'>
						<h3 class='text-center'><i class='fa fa-2x fa-pie-chart' ></i> <?php  print esc_html__( '# OF ', 'crm-erp-business-solution' ).esc_html__(' PRODUCTS', 'crm-erp-business-solution' );?> <br/><span><?php print esc_html( $numPro ); ?></span></h3>
					</div>	
					<div class='columns4 report_widget'>
						<h3 class='text-center'><i class='fa fa-2x fa-pie-chart' ></i> <?php  print esc_html__( '# OF ', 'crm-erp-business-solution' ). esc_html( $transaction );?>  <br/><span><?php print esc_html( $numOrders ); ?></span></h3>
					</div>	
					
					
					<div class='columns4 report_widget'>
						<h3 class='text-center'><i class='fa fa-2x fa-money' ></i> <?php print esc_html__( 'TOTAL PAID', 'crm-erp-business-solution' );?> <br/><span><?php print esc_html( crm_price( $paid ) ); ?></span></h3>
					</div>	
					<div class='columns4 report_widget'>
						<h3 class='text-center'><i class='fa fa-2x fa-balance-scale' ></i> <?php  print esc_html__( 'BALANCE', 'crm-erp-business-solution' );?>  <br/><span><?php print esc_html( crm_price( $balance ) ); ?></span></h3>
					</div>	

					
					<div class='columns4 report_widget em'>
						<h3 class='text-center'><i class='fa fa-2x fa-filter' ></i> <?php  print esc_html__( 'AVG NET ', 'crm-erp-business-solution' ). esc_html( $transaction ). esc_html__(' AMOUNT/day', 'crm-erp-business-solution' );?>  <br/><span><?php print esc_html( crm_price( $avg ) ) ; ?></span></h3>
					</div>						
					<div class='columns4 report_widget em'>
						<h3 class='text-center'><i class='fa fa-2x fa-clock-o' ></i> <?php  print esc_html( $transaction ) .  esc_html__( ' EVERY', 'crm-erp-business-solution' );?>  <br/><span><?php print floor( esc_html( $saleEvery ) ); ?></span> <?php  print esc_html__('DAYS', 'crm-erp-business-solution' );?></h3>	
					</div>	
					<div class='columns2 report_widget '>
						<h3 class='text-center'><i class='fa fa-2x fa-line-chart' ></i> <?php  print  esc_html__( ' PAID WITHIN GIVEN PERIOD', 'crm-erp-business-solution' );?>  <br/><span><?php print  esc_html( crm_price( $payresults ) ); ?></span></h3>	
					</div>						
			<?php }else{
				
				print "<center><b>" . esc_html__( ' No Results ', 'crm-erp-business-solution' ) . "</b></center>";
				
			 } ?>
			
		</div>
		
		
		<?php if( $subtotal !='' || $payresults !='' ){ ?>
		
			<div id="tabs2" class='clearfix'>
				<ul>
					<li><a href="#orders"><?php esc_html_e( 'Transactions', 'crm-erp-business-solution' ). " ". esc_html( $transaction );?></a></li>
					<li><a href="#paid"><?php esc_html_e( 'Payments', 'crm-erp-business-solution' );?></a></li>
					<?php if( !isset( $_REQUEST['user'] ) || ( isset( $_REQUEST['user' ]) && $_REQUEST['user'] == '' ) ){	?>			
						<li><a href="#customers"><?php  esc_html_e( 'Customers', 'crm-erp-business-solution' );?></a></li>
					<?php } ?>
					<li><a href="#products"><?php  esc_html_e( 'Products', 'crm-erp-business-solution' );?></a></li>
					<li><a href="#categories"><?php  esc_html_e( 'Categories', 'crm-erp-business-solution' );?></a></li>
					<li><a href="#countries"><?php  esc_html_e( 'Countries', 'crm-erp-business-solution' );?></a></li>
					<li><a href="#payment"><?php  esc_html_e( 'Payment Methods', 'crm-erp-business-solution' );?></a></li>
				</ul>

			<?php $this->orders( $orders ); ?>
			<?php $this->paid( $actualpayments ); ?>
			<?php $this->payments( $payments ); ?>
			<?php 
				if( !isset( $_REQUEST['user'] ) || ( isset( $_REQUEST['user'] ) && $_REQUEST['user'] == '' ) ){
					$this->customers($customers); 
				}	
			?>
			<?php $this->countries( $countries ); ?>
			<?php $this->products( $products ); ?>
			<?php $this->categories( $categories ); ?>
			
			
			</div>
			
		<?php } ?>
		
		<?php    
		
		}else{
			print "<center>";
			if( isset( $_POST['from'] ) && !empty( $_POST['from'] )  && isset( $_POST['to'] ) && !empty( $_POST['to'] ) ){
				
				print "<h3>".esc_html__( 'No ', 'crm-erp-business-solution' ). esc_html( $transaction ) .esc_html__(' for ', 'crm-erp-business-solution' ).date( 'd/m/Y',strtotime( esc_html( $_POST['from'])))." to ".date( 'd/m/Y', strtotime( esc_html( $_POST['to'] ) ) )."</h3>";
				
			}elseif( isset( $_POST['m'] ) && !empty( $_POST['m'] ) ){
				
				print "<h3>".esc_html__( 'No ', 'crm-erp-business-solution' ). esc_html( $transaction ) .esc_html__(' for ', 'crm-erp-business-solution' ).date( "F Y",strtotime( esc_html( $_POST['m'] ) ) )."</h3>";
				
			}elseif( isset( $_POST['selected'] ) && !empty( $_POST['selected'] ) ){
				
				print "<h3>".esc_html__( 'No ', 'crm-erp-business-solution' ). esc_html( $transaction ) .esc_html__(' for ', 'crm-erp-business-solution' ).date( 'd/m/Y', strtotime( esc_html( $_POST['selected'] ) ) )." to ".date('d/m/Y')."</h3>";
				
			}elseif( isset( $_POST['y'] ) && !empty( $_POST['y'] ) ){
				
				print "<h3>".esc_html__( 'No ', 'crm-erp-business-solution' ). esc_html( $transaction ) .esc_html__(' for ', 'crm-erp-business-solution' ).esc_html( $_POST['y'] ).esc_html__(' Analysis ', 'crm-erp-business-solution' )."</h3>";
				
			}else print "<h3>".esc_html__( 'No ', 'crm-erp-business-solution' ). esc_html( $transaction ) .esc_html__(' for ', 'crm-erp-business-solution' ).date('F')." </h3>";

			
			print "</center>";	
		}
	
	}


	public function totalBalance( $id ){	
	
		global $wpdb;
		
				
		$cc = $wpdb->get_row( $wpdb->prepare( "SELECT balance,parent FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE  id =%d ", (int)$id ) );	
		
		if( $cc->balance !== '' ){
			return  sanitize_text_field( $cc->balance );
		}else{
			
			global $wpdb;
						
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT balance FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE type LIKE '%invoice%' AND  id =%d ", (int)$cc->parent ) );	
			return  $cc;			
		}
	}

	public function total( $id ){	
	
		global $wpdb;
						
		$cc = $wpdb->get_row( $wpdb->prepare( "SELECT grandtotal,parent FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE   id =%d ", (int)$id ) );	
		
		if( $cc->grandtotal !== '' ){
			return  sanitize_text_field( $cc->grandtotal );
		}else{
			
			global $wpdb;
		
			$cc = $wpdb->get_var( $wpdb->prepare( "SELECT grandtotal FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE type LIKE '%invoice%' AND  id =%d ", (int)$cc->parent ) );		
			return $cc;
		}

	}
	
	public function orders( $orders ){ 
		

	?>
	
		<div class='column1' id='orders'>
		<?php if( $orders ){ ?>
		
		<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) { ?>		
			<h3 class='text-center'><i class='fa fa-pie-chart' ></i> <?php  esc_html_e( 'ORDERS', 'crm-erp-business-solution' );?> </h3>
		<?php }elseif( isset($_REQUEST['view'])  && $_REQUEST['view'] =='sales' ){ ?>
			<h3 class='text-center'><i class='fa fa-pie-chart' ></i> <?php  esc_html_e('ERP SALES', 'crm-erp-business-solution' );?> </h3>
		<?php }else{ ?>
			<h3 class='text-center'><i class='fa fa-pie-chart' ></i> <?php  esc_html_e('ERP PAYMENTS', 'crm-erp-business-solution' );?> </h3>
		<?php } ?>
		
		<table class="widefat striped" >
			<thead>
			   <tr class="row-title">
					<th><?php  esc_html_e( 'Order ID', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Creation Date', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Payment Method', 'crm-erp-business-solution' );?></th>
					<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) { ?><th><?php  esc_html_e('Coupons', 'crm-erp-business-solution' );?></th> <?php } ?>
					<th><?php  esc_html_e( 'Cust Name', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Cust Country', 'crm-erp-business-solution' );?></th>
					
					<?php if( isset($_REQUEST['view'])  && $_REQUEST['view'] == 'eshop' ) { ?>
						<th><?php  esc_html_e( 'Net Sales', 'crm-erp-business-solution' );?></th>
					<?php }elseif( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'sales' || $_REQUEST['view'] == 'payments' ){ ?>
						<th><?php  esc_html_e( 'Amount after Discount before Tax', 'crm-erp-business-solution' );?></th>
					<?php } ?>
					<th><?php  esc_html_e( 'Discount', 'crm-erp-business-solution' );?></th>
					<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) { ?><th><?php  esc_html_e( 'Shipping Cost', 'crm-erp-business-solution' );?></th> <?php } ?>
					<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) { ?><th><?php  esc_html_e( 'Refunds', 'crm-erp-business-solution' );?></th> <?php } ?>
					<th><?php  esc_html_e( 'Taxes', 'crm-erp-business-solution' );?></th>
					
					<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) { ?>
						<th><?php  esc_html_e( 'Total of Sales', 'crm-erp-business-solution' );?></th>	
					<?php }elseif( isset( $_REQUEST['view'] )  && $_REQUEST['view'] =='sales' || $_REQUEST['view'] == 'payments' ){ ?>
						<th><?php  esc_html_e('Total', 'crm-erp-business-solution' );?></th>	
					<?php } ?>
					<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) { ?><th><?php  esc_html_e( 'Paid', 'crm-erp-business-solution' );?></th> <?php } ?>
					<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) { ?><th><?php  esc_html_e( 'Balance', 'crm-erp-business-solution' );?></th> <?php } ?>
					
					
				</tr>
			</thead>		
			<tbody>
		<?php
			$result = array();	
			$totalAmount = 0;
			$totalQuantity = 0;
			if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] =='eshop' ) $totalShipping = 0;
			$totalDiscount=0;
			if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] =='eshop' ) $totalRefund = 0;
			
			if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) $totalPaid = 0;
			if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) $totalBalance = 0;
			
			$totalSub = 0;
			$totalTax = 0;
			
			foreach( $orders as $item ){			
				print "<tr>";
                if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
					$total = $item['amount'] - $item['refund'];			
				}else {
					$total = $item['amount'];					
				}
				
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
					$totalAmount+= $item['amount'] - $item['refund'];
				}else $totalAmount += $item['amount'];
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) $totalShipping += $item['shipping'];
				$totalDiscount += $item['discount'];
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) $totalRefund += $item['refund'];
				$totalSub += $item['subtotal'];
				$totalTax += $item['tax'];
	
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) $totalPaid += $item['paid'];
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) $totalBalance += $item['balance'];
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) {					
					
					$item['country']!='' ? $item['country'] = WC()->countries->countries[esc_attr($item['country'])] : $item['country']='';
					?><td>
					<a target='blank' href="<?php print esc_url( admin_url( "/admin.php?page=wc-orders&action=edit&id=".(int)$item['orderid']."&action=edit" ) ) ;?>"><?php echo (int)$item['orderid']; ?></a>
					<?php echo "</td><td>".esc_html( $item['date'] ). "</td><td>".esc_html( $item['payment'] ). "</td><td>".esc_html( $item['coupons'] ). "</td><td>".esc_html( $item['name'] ). "</td><td>".$item['country']. "</td><td>". crm_price( esc_html( $item['subtotal'] )) . "</td><td>". crm_price( esc_html( $item['discount'] ) ) . "</td><td>". crm_price( esc_html( $item['shipping'] ) ) . "</td><td>". crm_price( esc_html( $item['refund'] ) ) . "</td><td>". crm_price( esc_html( $item['tax'] ) ) . "</td><td>". crm_price( esc_html( $total ) ) . "</td>";	
				
				}else{ 
					if( $_REQUEST['view'] == 'sales' ){
						$type = 'sales';
					}else $type = 'payments';
					
					$user = get_user_by( "id", sanitize_text_field( $item['name'] ) );
					
					$tab = '';
					if ( in_array( 'crm_customer', (array) $user->roles ) ) {
						$tab = 'customers';
					}elseif ( in_array( 'crm_vendor', (array) $user->roles ) ) {
						$tab = 'vendors';
					}
 								
					if( has_filter( 'crmerpbs_get_user_role_by_id_for_usrtab' ) ) {
						$tab = apply_filters( "crmerpbs_get_user_role_by_id_for_usrtab", sanitize_text_field( $item['name'] ) ); 								
					}					

					$theUser = "<a href='".esc_url( admin_url("?page=crm-erp-business-solution&tab=".esc_html( $tab )."&action=view&id=".(int)$item['name'] ) )."' target='_blank'>". esc_html( $user->first_name. " " . $user->last_name )."</a>";						
				?>
					<td>
					<a target='blank' href="<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=sales&action=view&id=".(int)$item['orderid'] ) );?>"><?php print (int)$item['orderid']; ?></a>
					<?php echo "</td><td>". esc_html( $item['date'] ) . "</td><td>".esc_html( $item['payment'] ) . "</td><td>". wp_kses( $theUser , CrmErpSolution::get_instance()->allowed_html ). "</td><td>".array_search( $item['country'] , $this->countrycodes ). "</td><td>". esc_html( $item['subtotal'] ).get_option('crmerpbscurrencySymbol') . "</td><td>". crm_price(esc_html( $item['discount'] ) ). "</td><td>". crm_price( esc_html( $item['tax'] ) ) . "</td><td>". crm_price( esc_html( $total ) ) . "</td><td>". crm_price( esc_html( $item['paid'] ) ) . "</td><td>". crm_price( esc_html( $item['balance'] ) ) . "</td>";						
				 }
				print "</tr>";
				
			}
			if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) {
				echo "<tr class='totals'><td>". esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td></td><td></td><td></td><td></td><td></td><td>".crm_price( esc_html( $totalSub ) )."</td><td>".crm_price( esc_html( $totalDiscount ) )."</td><td>".crm_price( esc_html( $totalShipping ) )."</td><td>".crm_price( esc_html( $totalRefund ) )."</td><td>".crm_price( esc_html( $totalTax ) )."</td><td>".crm_price( esc_html( $totalAmount ) )."</td></tr>";				
			}else{
				echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td></td><td></td><td></td><td></td><td>".crm_price( esc_html( $totalSub ) )."</td><td>".crm_price( esc_html( $totalDiscount ) )."</td><td>".crm_price( esc_html( $totalTax ) )."</td><td>".crm_price( esc_html( $totalAmount ) )."</td><td>".crm_price( esc_html( $totalPaid ) )."</td><td>".crm_price( esc_html( $totalBalance ) )."</td></tr>";				
			}
			
			?>
		   </tbody>
			   <?php 
				$reportTools = "<button class='excel_download proVersion ' ><i class='fa fa-file-excel-o '></i> ". esc_html__( 'Export - PRO', 'crm-erp-business-solution' ). "</button><input type='text' disabled placeholder='". esc_html__( 'Search...', 'crm-erp-business-solution' ). "'></input>";
				
				if( has_filter( 'crmerpbs_report_tools' ) ) {					
					$reportTools = apply_filters( "crmerpbs_report_tools", $reportTools ); 
				}
				
				print wp_kses( $reportTools , CrmErpSolution::get_instance()->allowed_html );
				?>
		</table>
		
		<?php }else print "<h3>".esc_html__( 'No data', 'crm-erp-business-solution' )."</h3>"; ?>
		</div>
	
	<?php
	}

	public function paid( $paid ){ ?>
	
		<div class='column1' id='paid'>
		<?php if( $paid ){ ?>
		

		<h3 class='text-center'><i class='fa fa-pie-chart' ></i> <?php  esc_html_e('CLEARED PAYMENTS', 'crm-erp-business-solution' );?> </h3>

		
		<table class="widefat striped" >
			<thead>
			   <tr class="row-title">
					<th><?php  esc_html_e( 'Order ID', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Parent Transaction', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Creation Date', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Payment Date', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Payment Method', 'crm-erp-business-solution' );?></th>				
					<th><?php  esc_html_e( 'Cust Name', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Country', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Paid', 'crm-erp-business-solution' );?></th>
					
					
				</tr>
			</thead>		
			<tbody>
		<?php
			$result = array();	
			$totalAmount = 0;

			
			if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) $totalPaid = 0;
			
			$totalSub = 0;
			$totalTax = 0;
			
			foreach( $paid as $item ){			
				print "<tr>";
                
				$total = $item['paid'];					
								
				$totalAmount += $item['paid'];
				

					if( $_REQUEST['view'] == 'sales' ){
						$type = 'sales';
					}else $type = 'payments';
					
					$user = get_user_by( "id", sanitize_text_field( $item['name'] ) );
					
					$tab = '';
					if ( in_array( 'crm_customer', (array) $user->roles ) ) {
						$tab = 'customers';
					}elseif ( in_array( 'crm_vendor', (array) $user->roles ) ) {
						$tab = 'vendors';
					}
					if( has_filter( 'crmerpbs_get_user_role_by_id_for_usrtab' ) ) {
						$tab = apply_filters( "crmerpbs_get_user_role_by_id_for_usrtab", sanitize_text_field( $item['name'] ) ); 								
					}	 								
					

					$theUser = "<a href='".esc_url( admin_url("?page=crm-erp-business-solution&tab=".esc_html( $tab )."&action=view&id=".(int)$item['name'] ) )."' target='_blank'>". esc_html( $user->first_name. " " . $user->last_name )."</a>";						
				?>
					<td>
					<a target='blank' href="<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=sales&action=view&id=".(int)$item['orderid'] ) );?>"><?php print (int)$item['orderid']; ?></a>
					</td>
					<td>
					<a target='blank' href="<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=sales&action=view&id=".esc_attr( $item['parent'] ) ) );?>"><?=$item['parent']; ?></a>
					</td>					
					<?php echo "<td>". esc_html( $item['date'] ) . "</td><td>". esc_html( $item['payment_date'] ) . "</td><td>".esc_html( $item['payment'] ) . "</td><td>". $theUser . "</td><td>".array_search( $item['country'] , $this->countrycodes ). "</td><td>". crm_price( esc_html( $item['paid'] ) ) . "</td>";						
				 
				print "</tr>";
				
			}
			
			echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td></td><td></td><td></td><td></td><td></td><td></td><td>".crm_price( esc_html( $totalAmount ) )."</td></tr>";				
			
			
			?>
		   </tbody>
			   <?php 
				$reportTools = "<button class='excel_download proVersion ' ><i class='fa fa-file-excel-o '></i> ". esc_html__( 'Export - PRO', 'crm-erp-business-solution' ). "</button><input type='text' disabled placeholder='". esc_html__( 'Search...', 'crm-erp-business-solution' ). "'></input>";
				
				if( has_filter( 'crmerpbs_report_tools' ) ) {					
					$reportTools = apply_filters( "crmerpbs_report_tools", $reportTools ); 
				}
				
				print wp_kses( $reportTools , CrmErpSolution::get_instance()->allowed_html );
				?>
		</table>
		
		<?php }else print "<h3>".esc_html__( 'No data for payments', 'crm-erp-business-solution' )."</h3>"; ?>
		</div>
	
	<?php
	}
	
	public function payments( $payments ){ ?>
	
		<div id='payment'>
		
		<?php if( $payments ){ ?>
		
			<div class='columns2'>
			<h3 class='text-center'><i class='fa fa-money' ></i> <?php  esc_html_e( 'PAYMENT METHODS', 'crm-erp-business-solution' );?></h3>
			<table class="widefat striped" >
				<thead>
				   <tr class="row-title">
						<th><?php  esc_html_e( 'Payment Method', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e( 'Orders', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e( 'Total', 'crm-erp-business-solution' );?></th>
					</tr>
				</thead>		
				<tbody>
			<?php

			if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) {
				
				$paid = 0;
				$balance=0;	
					
				foreach ( $payments as $element ) {
					$paid += $element['paid'];
					$balance += $element['balance'];					
				}
			}
				//SORT ARRAY BY VALUE DESCENDING
				$paySales = array_column( $payments, 'amount' );
				$returnPay = array_multisort( $paySales, SORT_DESC , $payments );	


				//GROUP BY PAYMENT METHOD
				$result = array();		
				foreach ( $payments as $element ) {
				   $result[$element['payment']][] = $element;
				}
				//run the loop, sum the salaries by gender
				$totalAmount = 0;
				$totalQuantity = 0;

					
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) $totalPaid = 0;
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) $totalBalance = 0;
				
				foreach( $result as $res ){			
					print "<tr>";
					/*SUM WITHIN MULTIDEMENSIONAL ARRAY*/
					$am = 0;
					$quant = 0;


					foreach ( $res as $item ) {
						if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) {
							$am += $item['amount'] - $item['refund'];
						}else {
							$am += $item['amount'];	
						}
						$quant += $item['quantity'];
					}
					
					$totalAmount += $am;
					$totalQuantity += $quant;

					$reportPayment[] = array( "name" => $item['payment'], "payment" => $am );
					
					if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ){					
						echo "<td>". esc_html( $item['payment'] ). "</td><td>". esc_html( $quant ) . "</td><td>". crm_price( esc_html( $am ) ) . "</td>";	
					}else echo "<td>".esc_html( $item['payment'] ). "</td><td>". esc_html( $quant ) . "</td><td>". crm_price( esc_html( $am ) ) . "</td>";	
					print "</tr>";
					
				}
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ){
					echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td>".esc_html( $totalQuantity )."</td><td>".crm_price( esc_html( $totalAmount ) )."</td></tr>";	
				}else echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td>". esc_html( $totalQuantity ) ."</td><td>".crm_price( esc_html( $totalAmount ) )."</td></tr>";			
			?>
			   </tbody>
			   <?php 
				$reportTools = "<button class='excel_download proVersion ' ><i class='fa fa-file-excel-o '></i> ". esc_html__( 'Export - PRO', 'crm-erp-business-solution' ). "</button><input type='text' disabled placeholder='". esc_html__( 'Search...', 'crm-erp-business-solution' ). "'></input>";
				
				if( has_filter( 'crmerpbs_report_tools' ) ) {					
					$reportTools = apply_filters( "crmerpbs_report_tools", $reportTools ); 
				}
				
				print wp_kses( $reportTools , CrmErpSolution::get_instance()->allowed_html );
				?>
			</table>
			</div>
				<div class="chart-container columns2" style="position: relative">
					<canvas id="byPayment"></canvas>
				</div>
				<script>
				var ctx = document.getElementById( "byPayment" );
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: [<?php foreach( $reportPayment as $t ){ print '"' . esc_html( $t['name'] ) . '",';};?>],
						datasets: [{
							label: "<?php esc_html_e( 'Payment Methods', 'crm-erp-business-solution' ); ?>",
							data: [<?php foreach( $reportPayment as $t ){print '"' . esc_html( $t['payment'] ) . '",';};?>],			
							backgroundColor: [
								<?php foreach( $reportPayment as $t ){print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ) . '",';};?>],
							borderColor: [
								<?php foreach( $reportPayment as $t ){print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ) . '",';};?>],
							borderWidth: 1
						}]
					},
					options: {
						title: {
							display: true,
							text: "<?php esc_html_e( 'Payment Methods', 'crm-erp-business-solution' ); ?>"
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
		<?php }else print "<h3>".esc_html__( 'No data for payments', 'crm-erp-business-solution' )."</h3>"; ?>
		</div>
	<?php
	}
	
	public function customers( $customers ){ ?>
	
		<div class='column1' id='customers'>
		
		<?php if( $customers ){ ?>
		<h3 class='text-center'><i class='fa fa-users' ></i> <?php  esc_html_e( 'CUSTOMERS', 'crm-erp-business-solution' );?> </h3>
		<table class="widefat striped" id='custs'>
			<thead>
			   <tr class="row-title">
					<th><?php  esc_html_e( 'Customer Name', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Phone', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Email', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'Country', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'State', 'crm-erp-business-solution' );?></th>
					<th><?php  esc_html_e( 'City', 'crm-erp-business-solution' );?></th>
					<?php  if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){ ?><th><?php  esc_html_e( 'Quantity', 'crm-erp-business-solution' );?></th><?php } ?>
					<th><?php  esc_html_e( 'Total', 'crm-erp-business-solution' );?></th>
					<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) { ?><th><?php  esc_html_e( 'Paid', 'crm-erp-business-solution' );?></th> <?php } ?>
					<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ) { ?><th><?php  esc_html_e( 'Balance', 'crm-erp-business-solution' );?></th> <?php } ?>					
				</tr>
			</thead>		
			<tbody>
		<?php
			//SORT ARRAY BY VALUE DESCENDING
			$custSales = array_column( $customers, 'amount' );
			$returnCust = array_multisort( $custSales, SORT_DESC , $customers );		
			//GROUP BY CUSTOMER
			$result = array();		
			foreach ( $customers as $element ) {
			   $result[$element['name']][] = $element;
			}
			//run the loop, sum the salaries by gender
			$totalAmount = 0;
			$totalQuantity = 0;
			$totalPaid = 0;
			$totalBalance = 0;
			foreach( $result as $res ){			
				print "<tr>";
				/*SUM WITHIN MULTIDEMENSIONAL ARRAY*/
				$am = 0;
				$quant = 0;
				$paid = 0;
				$balance = 0;
				
				foreach ( $res as $item ) {
					 if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
						$am += $item['amount'] - $item['refund'];
					 }else {
						 $am += $item['amount'];
						 $paid += $item['paid'];
						 $balance += $item['balance'];
					 }
					if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) $quant += $item['quantity'];

				}
				$totalAmount += $am;
				
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ){
					$totalPaid += $paid;
					$totalBalance += $balance;
				}
				
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ) $totalQuantity += $quant;
				
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
					
					$item['country']!='' ? $item['country'] = WC()->countries->countries[$item['country']] : $item['country']='';
					echo "<td>". esc_html( $item['name'] ) . "</td><td>".esc_html( $item['phone'] ) . "</td><td>". esc_html( $item['mail'] ) . "</td><td>".$item['country']. "</td><td>". esc_html( $item['state'] ) . "</td><td>". esc_html( $item['city'] ) . "</td><td>". esc_html( $quant ) . "</td><td>". crm_price( esc_html( $am ) ) . "</td>";						
				}else {

					$user = get_user_by( "id", sanitize_text_field( $item['name'] ) ); 
					
					$tab = '';
					
					if ( in_array( 'crm_customer', (array) $user->roles ) ) {
						$tab = 'customers';
					}elseif ( in_array( 'crm_vendor', (array) $user->roles ) ) {
						$tab = 'vendors';
					}
					 	 							
					if( has_filter( 'crmerpbs_get_user_role_by_id_for_usrtab' ) ) {
						$tab = apply_filters( "crmerpbs_get_user_role_by_id_for_usrtab", sanitize_text_field( $item['name'] ) ); 								
					}					

					$theUser = "<a href='".esc_url( admin_url( "?page=crm-erp-business-solution&tab=".esc_attr( $tab )."&action=view&id=".(int)$item['name'] ) )."' target='_blank'>". esc_html( $user->first_name. " " . $user->last_name )."</a>";
					
					echo "<td>".$theUser. "</td><td>". esc_html( $item['phone'] ). "</td><td>". esc_html( $item['mail'] ) . "</td><td>".array_search( $item['country'] , $this->countrycodes). "</td><td>". esc_html( $item['state'] ) . "</td><td>". esc_html( $item['city'] ) . "</td><td>". crm_price( esc_html( $am ) ) . "</td><td>". crm_price( esc_html( $paid ) ) . "</td><td>". crm_price( esc_html( $balance ) ) . "</td>";						
				}

				print "</tr>";
				
			}
			if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
				echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td></td><td></td><td></td><td></td><td></td><td>".esc_html( $totalQuantity ) ."</td><td>".crm_price( esc_html( $totalAmount ) )."</td></tr>";
			}else{
				echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td></td><td></td><td></td><td></td><td></td><td>".crm_price( esc_html( $totalAmount ) )."</td><td>".crm_price( esc_html( $totalPaid ) )."</td><td>".crm_price( esc_html( $totalBalance ) )."</td></tr>";				
			}
		?>
		   </tbody>
			   <?php 
				$reportTools = "<button class='excel_download proVersion ' ><i class='fa fa-file-excel-o '></i> ". esc_html__( 'Export - PRO', 'crm-erp-business-solution' ). "</button><input type='text' disabled placeholder='". esc_html__( 'Search...', 'crm-erp-business-solution' ). "'></input>";
				
				if( has_filter( 'crmerpbs_report_tools' ) ) {					
					$reportTools = apply_filters( "crmerpbs_report_tools", $reportTools ); 
				}
				
				print wp_kses( $reportTools , CrmErpSolution::get_instance()->allowed_html );
				?>
		</table>
		<?php }else print "<h3>".esc_html__( 'No data for customers', 'crm-erp-business-solution' )."</h3>"; ?>
		</div>		
	<?php
	
	}
	
	
	public function countries( $countries ){ ?>
	
		<div  id='countries'>
		<?php if( $countries ){ ?>
			<div class='columns2' >
			<h3 class='text-center'><i class='fa fa-globe' ></i> <?php  esc_html_e( 'COUNTRIES', 'crm-erp-business-solution' );?></h3>
			<table class="widefat striped" >
				<thead>
				   <tr class="row-title">
						<th><?php  esc_html_e( 'Country', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e( 'Orders', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e( 'Total', 'crm-erp-business-solution' );?></th>						
					</tr>
				</thead>		
				<tbody>
			<?php
				//SORT ARRAY BY VALUE DESCENDING
				$countSales = array_column( $countries, 'amount' );
				$returnCount = array_multisort( $countSales, SORT_DESC , $countries );		
			
				//GROUP BY country
				$result = array();		
				foreach ( $countries as $element ) {
				   $result[$element['name']][] = $element;
				}
				//run the loop, sum the salaries by gender
				$totalAmount = 0;
				$totalQuantity = 0;
				$totalPaid = 0;
				$totalBalance = 0;
				foreach( $result as $res ){			
					print "<tr>";
					/*SUM WITHIN MULTIDEMENSIONAL ARRAY*/
					$am = 0;
					$quant = 0;
					$paid = 0;
					$balance = 0;
					foreach( $res as $item ) {
						if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
							$am += $item['amount'] - $item['refund'];
						}else $am += $item['amount'];
						$quant += $item['quantity'];
						
						if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ){
							$paid += $item['paid'];
							$balance += $item['balance'];
						}

					}
					$totalAmount += $am;
					$totalQuantity += $quant;
					if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ){
						$totalPaid += $paid;
						$totalBalance += $balance;
					}
					
					if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
						//$item['name']!='' ? $item['name'] = WC()->countries->countries[$item['name']] : $item['name']='';
						$reportCountries[] = array( "name" => array_search( $item['name'] , $this->countrycodes), "quantity" => $quant, "payment" => $am );
					}else $reportCountries[] = array( "name" => $item['name'], "quantity" => $quant, "payment" => $am );
					
					if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
						//$item['name']!='' ? $item['name'] = WC()->countries->countries[$item['name']] : $item['name']='';
						echo "<td>".array_search( $item['name'] , $this->countrycodes). "</td><td>". esc_html( $quant ). "</td><td>". crm_price( esc_html( $am ) ) . "</td>";	
					}else echo "<td>".array_search( $item['name'] , $this->countrycodes). "</td><td>".  esc_html( $quant ) . "</td><td>". crm_price( esc_html( $am ) ) . "</td>";	
					print "</tr>";
					
				}
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
					echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td>".$totalQuantity."</td><td>".crm_price($totalAmount)."</td></tr>";
				}else{
					echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td>".$totalQuantity."</td><td>".crm_price($totalAmount)."</td></tr>";
				}
							
			?>
			   </tbody>
			   <?php 
				$reportTools = "<button class='excel_download proVersion ' ><i class='fa fa-file-excel-o '></i> ". esc_html__( 'Export - PRO', 'crm-erp-business-solution' ). "</button><input type='text' disabled placeholder='". esc_html__( 'Search...', 'crm-erp-business-solution' ). "'></input>";
				
				if( has_filter( 'crmerpbs_report_tools' ) ) {					
					$reportTools = apply_filters( "crmerpbs_report_tools", $reportTools ); 
				}
				
				print wp_kses( $reportTools , CrmErpSolution::get_instance()->allowed_html );
				?>
			</table>
			</div>		
				<div class="chart-container columns2" >
					<canvas id="byCountry"></canvas>
				</div>

				<script>
				var ctx = document.getElementById( "byCountry" );
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: [<?php foreach( $reportCountries as $t ){ print '"' . esc_html( $t['name'] ) . '",';};?>],
						datasets: [{
							label: "<?php esc_html_e( 'Countries', 'crm-erp-business-solution' ); ?>",
							data: [<?php foreach( $reportCountries as $t ){ print '"' . esc_html( $t['payment'] ) . '",';};?>],			
							backgroundColor: [
								<?php foreach( $reportCountries as $t ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ) . '",';};?>],
							borderColor: [
								<?php foreach( $reportCountries as $t ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ) . '",';};?>],
							borderWidth: 1
						}]
					},
					options: {
						title: {
							display: true,
							text:  "<?php esc_html_e( 'Countries', 'crm-erp-business-solution' ); ?>"
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
		<?php }else print "<h3>".esc_html__('No data for countries', 'crm-erp-business-solution' )."</h3>"; ?>
		</div>	
	<?php
	}
	
	public function products( $products ){ ?>
	
		<div id='products'>
		
		<?php if( $products ){ ?>
			<div class='column1'>
			<h3 class='text-center'><i class='fa fa-pie-chart' ></i> <?php  esc_html_e( 'PRODUCTS', 'crm-erp-business-solution' );?></h3>
			
			<center><i><?php esc_html_e( "Amounts before tax and total discount", 'crm-erp-business-solution' ); ?></i><center>
			
			<table class="widefat striped" >
				<thead>
				   <tr class="row-title">
						<th><?php  esc_html_e('Product', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e('SKU', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e('Quantity', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e('Amount', 'crm-erp-business-solution' );?></th>
						<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ){ ?><th><?php  esc_html_e( 'Discount', 'crm-erp-business-solution' );?></th> <?php } ?>
						<?php if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] != 'eshop' ){ ?><th><?php  esc_html_e( 'Total', 'crm-erp-business-solution' );?></th> <?php } ?>
					</tr>
				</thead>		
				<tbody>
			<?php
		
				//SORT ARRAY BY VALUE DESCENDING
				$prodSales = array_column( $products, 'amount' );
				$returnProd = array_multisort( $prodSales, SORT_DESC , $products );
				
				//GROUP BY products
				$result = array();		
				foreach ( $products as $element ) {
				   $result[$element['name']][] = $element;
				}
				
				//run the loop, sum the salaries by gender
				$totalAmount = 0;
				$totalQuantity = 0;
				$totalTotal = 0;
				$totalDiscount = 0;
				$totalRefund = 0;
				
				foreach($result as $res){			
					print "<tr>";
					/*SUM WITHIN MULTIDEMENSIONAL ARRAY*/
					$am = 0;
					$quant = 0;
					$amount = 0;
					$disc = 0;
					$total = 0;
					foreach ( $res as $item ) {
						if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
							$am += $item['amount'] - $item['refund'] - $item['discount'];
						}else{
							$am += $item['amount'];						
							$disc += $item['discount'];
							$total += $item['total'];
						}
						$quant += $item['quantity'];
						
						if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
							$totalRefund = $item['refund'];
						}
					}
					$totalAmount += $am;
					$totalQuantity += $quant;
					$totalDiscount += $disc;
					$totalTotal += $total;
					
					$reportProducts[] = array( "name" => $item['name'], "quantity" => $am,"amount" => $am );
					
					if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
						echo "<td>". esc_html( $item['name'] ) . "</td><td>". esc_html( $item['sku'] ) . "</td><td>". esc_html( $quant ) . "</td><td>". crm_price( esc_html( $am ) ) . "</td>";	
					}else{
						echo "<td>". esc_html( $item['name'] ) . "</td><td>". esc_html( $item['sku'] ) . "</td><td>".  esc_html( $quant ) . "</td><td>". crm_price( esc_html( $am ) ) . "</td><td>". crm_price( esc_html( $disc ) ). "</td><td>". crm_price( esc_html( $total ) ) . "</td>";	
					}
					
					print "</tr>";
					
				}
				if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
					echo "<tr class='totals'><td>". esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td></td><td>". esc_html( $totalQuantity ) ."</td><td>".crm_price( esc_html( $totalAmount ) )."</td></tr>";
				}else echo "<tr class='totals'><td>".esc_html__( 'TOTALS', 'crm-erp-business-solution' )."</td><td></td><td>". esc_html( $totalQuantity ) ."</td><td>". crm_price( esc_html( $totalAmount ) ) . "</td><td>". crm_price( esc_html( $totalDiscount ) ) . "</td><td>".crm_price( esc_html( $totalTotal ) )."</td></tr>";
			?>
			   </tbody>
			   <?php 
				$reportTools = "<button class='excel_download proVersion ' ><i class='fa fa-file-excel-o '></i> ". esc_html__( 'Export - PRO', 'crm-erp-business-solution' ). "</button><input type='text' disabled placeholder='". esc_html__( 'Search...', 'crm-erp-business-solution' ). "'></input>";
				
				if( has_filter( 'crmerpbs_report_tools' ) ) {					
					$reportTools = apply_filters( "crmerpbs_report_tools", $reportTools ); 
				}
				
				print wp_kses( $reportTools , CrmErpSolution::get_instance()->allowed_html );
				?>
			</table>
			</div>		
			<div class="chart-container column1" >
				<canvas id="productChart"></canvas>
			</div>

			<script>
			var ctx = document.getElementById( "productChart" );
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: [<?php foreach($reportProducts as $p){print '"' . $p['name'] . '",';};?>],
					datasets: [{
						label: "<?php esc_html_e( '# of Sales', 'crm-erp-business-solution' ) ; ?>",
						data: [<?php foreach( $reportProducts as $p ){ print '"' . esc_html( $p['amount'] ) . '",';};?>],
						backgroundColor:[<?php foreach( $reportProducts as $p ){print '"' .esc_html( CrmErpSolution::get_instance()->getRandomColor() ) . '",';};?>],				
						borderColor:[<?php foreach( $reportProducts as $p ){print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ). '",';};?>],				
						borderWidth: 1
					}]
				},
				options: {
					title: {
						display: true,
						text: "<?php esc_html_e( 'PRODUCTS', 'crm-erp-business-solution' ) ; ?>"
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
			
		<?php }else print "<h3>".esc_html__( 'No data for products', 'crm-erp-business-solution' )."</h3>"; ?>
		</div>		
	<?php

	}
	
	public function categories( $categories ){
			
	?>
		<div id='categories'>
		<?php if($categories){ ?>
			<div class='columns2'>
			<h3 class='text-center'><i class='fa fa-tag' ></i> <?php  esc_html_e( 'CATEGORIES', 'crm-erp-business-solution' );?></h3>
			<center><i><?php esc_html_e( "Amounts before tax and total discount", 'crm-erp-business-solution' ); ?></i><center>
			<table class="widefat striped" >
				<thead>
				   <tr class="row-title">
						<th><?php  esc_html_e( 'Category', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e( '# of Products', 'crm-erp-business-solution' );?></th>
						<th><?php  esc_html_e( 'Total', 'crm-erp-business-solution' );?></th>
					</tr>
				</thead>		
				<tbody>
			<?php
				//SORT ARRAY BY VALUE DESCENDING
				$catSales = array_column( $categories, 'amount' );
				$returnCat = array_multisort( $catSales, SORT_DESC , $categories );		
				//GROUP BY products
				$result = array();		
				foreach ( $categories as $element ) {
				   $result[$element['name']][] = $element;
				}
				//run the loop, sum the salaries by gender
				$totalAmount = 0;
				$totalQuantity = 0;
				$totalRefund = 0;
				foreach( $result as $res ){			
					print "<tr>";
					/*SUM WITHIN MULTIDEMENSIONAL ARRAY*/
					$am = 0;
					$quant = 0;
					foreach ( $res as $item ) {
						
						if( isset( $_REQUEST['view'] )  && $_REQUEST['view'] == 'eshop' ){
							$am += $item['amount'] - $item['refund'] - $item['discount'];
							$totalRefund = $item['refund'];
						}else $am += $item['amount'];
					    
						$quant += $item['quantity'];
                         
					}
					$totalAmount += $am;
					$totalQuantity += $quant;
					
						$reportCategories[] = array( "name" => $item['name'], "amount" => $am );
						
					echo "<td>".$item['name']. "</td><td>". $quant . "</td><td>". crm_price( $am ) . "</td>";	
					print "</tr>";
					
				}
				echo "<tr class='totals'><td>".esc_html__('TOTALS', 'crm-erp-business-solution' )."</td><td>". esc_html( $totalQuantity ) ."</td><td>".crm_price( esc_html( $totalAmount ) )."</td></tr>";			
			?>
			   </tbody>
			   <?php 
				$reportTools = "<button class='excel_download proVersion ' ><i class='fa fa-file-excel-o '></i> ". esc_html__( 'Export - PRO', 'crm-erp-business-solution' ). "</button><input type='text' disabled placeholder='". esc_html__( 'Search...', 'crm-erp-business-solution' ). "'></input>";
				
				if( has_filter( 'crmerpbs_report_tools' ) ) {					
					$reportTools = apply_filters( "crmerpbs_report_tools", $reportTools ); 
				}
				
				print wp_kses( $reportTools , CrmErpSolution::get_instance()->allowed_html );
				?>
			</table>
			</div>
			<div class="chart-container columns2" >
				<canvas id="couponCategories"></canvas>
			</div>
			<script>
			var ctx = document.getElementById( "couponCategories" );
			var myChart = new Chart(ctx, {
				type: 'pie',
				data: {
					labels: [<?php foreach( $reportCategories as $rep ){ print '"' . esc_html( $rep['name'] ) . '",';};?>],
					datasets: [{
						label: '',
						data: [<?php foreach( $reportCategories as $rep ){ print '"' . esc_html( $rep['amount'] ) . '",';};?>],
						backgroundColor:[<?php foreach( $reportCategories as $rep ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ) . '",';};?>],				
						borderColor:[<?php foreach( $reportCategories as $rep ){ print '"' . esc_html( CrmErpSolution::get_instance()->getRandomColor() ) . '",';};?>],					
						borderWidth: 1
					}]
				},
				options: {
					title: {
						display: true,
						text: "<?php esc_html_e( 'Categories', 'crm-erp-business-solution' );?>"
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
		<?php }else print "<h3>".esc_html__('No data for categories', 'crm-erp-business-solution' )."</h3>"; ?>
		</div>	
	
	<?php	

	}

}
$CrmErpSolutionReports = CrmErpSolutionReports::get_instance();