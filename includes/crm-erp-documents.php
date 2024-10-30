<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CrmErpSolutionDocuments{


	public $table_db_version = '1'; 
			
	public function __construct(){
		add_action( "admin_init", array( $this, 'adminPanels' ) );	
		register_activation_hook( __FILE__, array( $this,'tableInstall' ) );
		add_action( 'plugins_loaded', array( $this,'tableCheck' ) );		
	}

	public function tableInstall(){
		global $wpdb;


		$sql = "CREATE TABLE ".sanitize_text_field( $wpdb->prefix )."crmerpbs_documents (
			id int(11) NOT NULL AUTO_INCREMENT,
			PRIMARY KEY  (id),
			doc_id int(11) NOT NULL,
			KEY doc_id (doc_id),
			trans_id int(11) NOT NULL,
			order_id int(11) NULL,
			type int(11) NOT NULL	
		);";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		// save current database version for later use (on upgrade)
		add_option( 'crm_documents_table_db_version', sanitize_text_field( $this->table_db_version ) );

		/**
		*  new version of table
		*/
		$installed_ver = get_option( 'crmerpbs_documents_table_db_version' );
		if ( $installed_ver != $this->table_db_version ) {
			$sql = "CREATE TABLE ".sanitize_text_field( $wpdb->prefix )."crmerpbs_documents (
			id int(11) NOT NULL AUTO_INCREMENT,
			PRIMARY KEY  (id),
			doc_id int(11) NOT NULL,
			KEY doc_id (doc_id),
			trans_id int(11) NOT NULL,
			order_id int(11) NULL,
			type int(11) NOT NULL
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			// notice that we are updating option, rather than adding it
			update_option( 'crmerpbs_documents_table_db_version', sanitize_text_field( $this->table_db_version ) );
		}
	}


	public function tableCheck()
	{
		if ( get_site_option( 'crmerpbs_documents_table_db_version' ) != $this->table_db_version ) {
			$this->tableInstall();
		}
	}


	public function headingsBackground(){
		if( isset( $_REQUEST[ 'crmerpbs_headingsBackground' ] ) ){
			$headingsBackground =  sanitize_hex_color( $_REQUEST[ 'crmerpbs_headingsBackground' ] );
		}elseif( get_option( 'crmerpbs_headingsBackground' )!='' ){
			$headingsBackground = sanitize_hex_color( get_option( 'crmerpbs_headingsBackground' ) );
		}		
		?>
			<input type="text" name="crmerpbs_headingsBackground" class='color' id="crmerpbs_headingsBackground" value="<?php if( isset( $headingsBackground ) ) echo  esc_attr( $headingsBackground ) ; ?>" />
		<?php
	}

	public function headingsColor(){
		
		if( isset( $_REQUEST[ 'crmerpbs_headingsColor' ] ) ){
			$headingsColor =  sanitize_hex_color( $_REQUEST[ 'crmerpbs_headingsColor' ] );
		}elseif( get_option( 'crmerpbs_headingsColor' ) !='' ){
			$headingsColor = sanitize_hex_color( get_option( 'crmerpbs_headingsColor' ) );
		}	
		
		?>
			<input type="text" name="crmerpbs_headingsColor" class='color' id="crmerpbs_headingsColor" value="<?php if( isset( $headingsColor ) ) echo  esc_attr( $headingsColor ) ; ?>" />
		<?php
	}
	public function generalColor(){
		
		if( isset( $_REQUEST[ 'crmerpbs_generalColor' ] ) ){
			$generalColor =  sanitize_hex_color($_REQUEST[ 'crmerpbs_generalColor' ] );
		}elseif( get_option( 'crmerpbs_generalColor' ) !='' ){
			$generalColor =  sanitize_hex_color( get_option( 'crmerpbs_generalColor' ) );
		}	
		
		?>
			<input type="text" name="crmerpbs_generalColor" class='color' id="crmerpbs_generalColor" value="<?php if( isset( $generalColor ) ) echo  esc_attr( $generalColor ) ; ?>" />
		<?php
	}

	public function thankyouColor(){
		
		if( isset( $_REQUEST[ 'crmerpbs_thankyouColor' ] ) ){
			$thankyouColor =  sanitize_hex_color( $_REQUEST[ 'crmerpbs_thankyouColor' ] );
		}elseif( get_option( 'crmerpbs_thankyouColor' ) !=''){
			$thankyouColor = sanitize_hex_color( get_option( 'crmerpbs_thankyouColor' ) );
		}	
		
		?>
			<input type="text" name="crmerpbs_thankyouColor" class='color' id="crmerpbs_thankyouColor" value="<?php if( isset( $thankyouColor ) ) echo  esc_attr( $thankyouColor ) ; ?>" />
		<?php
	}
	public function invoiceNotes(){
		
		$invoiceNotes = '';
		if( isset( $_REQUEST[ 'crmerpbs_invoiceNotes' ] ) ){
			$invoiceNotes =  wp_kses( $_REQUEST[ 'crmerpbs_invoiceNotes' ], CrmErpSolution::get_instance()->allowed_html );
		}else{
			$invoiceNotes = wp_kses( get_option( 'crmerpbs_invoiceNotes' ), CrmErpSolution::get_instance()->allowed_html );
		}
		echo wp_editor( apply_filters( $invoiceNotes, $invoiceNotes ), 'crmerpbs_invoiceNotes', array("wpautop" => true, 'textarea_name' => 'crmerpbs_invoiceNotes', 'textarea_rows' => '5','editor_height' => 225 )  );	
	}
	
	public function invoiceThankyou(){
		
		$invoiceThankyou = '';
		if( isset( $_REQUEST[ 'crmerpbs_invoiceThankyou' ] ) ){
			$invoiceThankyou =  sanitize_text_field( $_REQUEST[ 'crmerpbs_invoiceThankyou' ] );
		}elseif( get_option( 'crmerpbs_invoiceThankyou' ) !='' ){
			$invoiceThankyou = sanitize_text_field( get_option( 'crmerpbs_invoiceThankyou' ) );
		}
		
		?>
			<input type="text"  name="crmerpbs_invoiceThankyou" id="crmerpbs_invoiceThankyou" placeholder='<?php print esc_html__('Thank you text for print document',"CrmErpSolution" ); ?>' value="<?php echo esc_attr( $invoiceThankyou ); ?>"  />
		<?php
	}
	public function invoiceStart(){
		
		$invoiceStart = '';
		if( isset( $_REQUEST[ 'crmerpbs_invoiceStart' ] ) ){
			$invoiceStart =  sanitize_text_field( $_REQUEST[ 'crmerpbs_invoiceStart' ] );
		}elseif( get_option( 'crmerpbs_invoiceStart' ) !='' ){
			$invoiceStart = sanitize_text_field( get_option( 'crmerpbs_invoiceStart' ) );
		}
		
		?>
			<input type="number"  name="crmerpbs_invoiceStart" id="crmerpbs_invoiceStart" placeholder='<?php print esc_html__( 'New start nr for invoice', "CrmErpSolution" ); ?>' value="<?php echo  esc_attr( $invoiceStart ); ?>"  />
		<?php
	}

	public function invoicePrefix(){
		
		if( isset( $_REQUEST[ 'crmerpbs_invoiceTransPrefix' ] ) ){
			$invoicePrefix = sanitize_text_field( $_REQUEST[ 'crmerpbs_invoiceTransPrefix' ] );
		}else $invoicePrefix = sanitize_text_field( get_option( 'crmerpbs_invoiceTransPrefix' ) ); 
		?>
			<input type="text" name="crmerpbs_invoiceTransPrefix" id="crmerpbs_invoiceTransPrefix" value="<?php echo  esc_attr( $invoicePrefix ); ?>"  />
		<?php
		
	}

	public function activateReceipts(){
		
		if( isset ( $_REQUEST[ 'crmerpbs_activateReceipts' ] ) ){
			$activateReceipts =  sanitize_text_field( $_REQUEST[ 'crmerpbs_activateReceipts' ] );
		}else $activateReceipts = sanitize_text_field( get_option( 'crmerpbs_activateReceipts' ) ); 
		?>
			<input type="checkbox" name="crmerpbs_activateReceipts" id="crmerpbs_activateReceipts" value='true'  <?php if( $activateReceipts == 'true' ) print "checked"; ?> />
		<?php
	}
	
	public function adminPanels(){
		
		add_settings_section( "crmerpbs_documents", "", null, "crmerpbs_documents-options" );

		add_settings_field( 'activateReceipts', esc_html__( "Activate Receipts to select instead of Invoice for Sale Transactions", "CrmErpSolution" ), array( $this, 'activateReceipts'),  "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_documents", "crmerpbs_activateReceipts" );	
		
		add_settings_field( 'generalColor', esc_html__( "Document General Color", "CrmErpSolution" ) , array( $this, 'generalColor' ),  "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_documents", "crmerpbs_generalColor" );
		
		add_settings_field( 'headingsBackground', esc_html__( "Document Headings Background", "CrmErpSolution" ), array( $this, 'headingsBackground' ),  "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_documents", "crmerpbs_headingsBackground" );	

		add_settings_field( 'headingsColor', esc_html__( "Document Headings Color", "CrmErpSolution" ), array( $this, 'headingsColor'),  "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_documents", "crmerpbs_headingsColor" );

		add_settings_field( 'thankyouColor', esc_html__( "Document ThankYou Message Color", "CrmErpSolution" ) , array( $this, 'thankyouColor'), "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_documents" , "crmerpbs_thankyouColor" );


			
		add_settings_field( 'invoiceThankyou', esc_html__( "Document Thank you Message", "CrmErpSolution" ) , array( $this, 'invoiceThankyou'),  "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_invoiceThankyou", "crmerpbs_invoiceThankyou" );

		add_settings_field( 'invoiceNotes', esc_html__( "Document Notes", "CrmErpSolution" ) , array($this, 'invoiceNotes'),  "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_invoiceNotes", "crmerpbs_invoiceNotes" );

		add_settings_field( 'invoiceTransPrefix', esc_html__( "Sale Transactions Document prefix", "CrmErpSolution" ) , array( $this, 'invoicePrefix'), "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_documents" , "crmerpbs_invoiceTransPrefix" );	
		
		add_settings_field( 'invoiceStart', esc_html__( "Sale Transactions Document Start Number", "CrmErpSolution" ) , array( $this, 'invoiceStart'), "crmerpbs_documents-options", "crmerpbs_documents" );			
		register_setting( "crmerpbs_invoiceStart", "crmerpbs_invoiceStart" );
		
	}


	
	public function adminProcessSettings(){

		if( $_SERVER['REQUEST_METHOD'] == 'POST' && current_user_can( 'crm-erp-business-solution' ) ){
		
			check_admin_referer( 'crm-erp-business-solution' );
			check_ajax_referer( 'crm-erp-business-solution' );
			
			if( isset( $_REQUEST[ "crmerpbs_headingsBackground" ] ) ){
				update_option( "crmerpbs_headingsBackground" , sanitize_text_field( $_REQUEST[ "crmerpbs_headingsBackground" ] ) );	
				
			}
			if( isset($_REQUEST[ "crmerpbs_headingsColor" ] ) ){
				update_option( "crmerpbs_headingsColor" , sanitize_text_field( $_REQUEST[ "crmerpbs_headingsColor"  ] ) );	
				
			}			
			if( isset($_REQUEST[ "crmerpbs_generalColor" ] ) ){
				update_option( "crmerpbs_generalColor" , sanitize_text_field( $_REQUEST[ "crmerpbs_generalColor" ] ) );	
				
			}
			if( isset($_REQUEST[ "crmerpbs_thankyouColor" ] ) ){
				update_option( "crmerpbs_thankyouColor" , sanitize_text_field( $_REQUEST[ "crmerpbs_thankyouColor" ] ) );	
				
			}	

			if( isset($_REQUEST[ "crmerpbs_invoiceNotes" ] ) ){
			   update_option( "crmerpbs_invoiceNotes", sanitize_textarea_field( $_REQUEST[ "crmerpbs_invoiceNotes" ] ) ); 
			}
			
			if( isset( $_REQUEST[ 'crmerpbs_invoiceStart' ] ) ){
			   $invoiceStart =  update_option( 'crmerpbs_invoiceStart', sanitize_text_field( $_REQUEST[ 'crmerpbs_invoiceStart' ] ) );
			}	
			
			if( isset($_REQUEST[ 'crmerpbs_invoiceThankyou' ] ) ){
			   $invoiceThankyou =  update_option( 'crmerpbs_invoiceThankyou', sanitize_text_field( $_REQUEST[ 'crmerpbs_invoiceThankyou' ] ) );
			}	
			if( isset( $_REQUEST[ 'crmerpbs_invoiceTransPrefix' ] ) ){
			   $invoicePrefix =  update_option( 'crmerpbs_invoiceTransPrefix', sanitize_text_field( $_REQUEST[ 'crmerpbs_invoiceTransPrefix' ] ) );
			}	

			if( isset( $_REQUEST[ 'crmerpbs_activateReceipts' ] ) ){
			   $activateReceipts =  update_option( 'crmerpbs_activateReceipts', sanitize_text_field( $_REQUEST[ 'crmerpbs_activateReceipts' ] ) );
			}else delete_option( 'crmerpbs_activateReceipts' );
						
		}		
	}

	public function checkDocument( $id, $type ){
		
			global $wpdb;

			$transaction = $wpdb->get_row( $wpdb->prepare( "SELECT trans_id FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_documents WHERE trans_id =%d and type=%s ", (int)$id, $type ) );
			
			if( $transaction ){
				return true;	
			}else return false;
			
	}



	public function addDocument( $id, $type ){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ) {
			
			global $wpdb;
			$type = sanitize_text_field( $type );

			$transaction = $wpdb->get_row( $wpdb->prepare( "SELECT trans_id FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_documents WHERE trans_id =%d and type=%s ", (int)$id, $type ) );
			
			
			$doc = $wpdb->get_row( $wpdb->prepare( "SELECT doc_id FROM ".sanitize_text_field( $wpdb->prefix )."crmerpbs_documents WHERE type=%s ", $type ) );
			
			if( !$transaction && $doc &&  get_option( 'crmerpbs_invoiceStart' ) =='' ){
				$doc =  sanitize_text_field( $doc->doc_id );
				$doc++;	
			}elseif( !$transaction && $doc &&  get_option( 'crmerpbs_invoiceStart' ) !='' ){
				$doc =  sanitize_text_field( get_option( 'crmerpbs_invoiceStart' ) );
				$doc++;
				update_option( 'crmerpbs_invoiceStart', (int)$doc );	
							
			}elseif( !$transaction && get_option( 'crmerpbs_invoiceStart' ) !='' ){
				$doc =  sanitize_text_field( get_option( 'crmerpbs_invoiceStart' ) ) ;
				$doc++;
				update_option( 'crmerpbs_invoiceStart', (int)$doc );	
						
			}else $doc=1;
			
			if( !$transaction ){
				
				$wpdb->insert( sanitize_text_field( $wpdb->prefix )."crmerpbs_documents" , array(
					'trans_id' => (int)$id,
					'doc_id' => (int)$doc,
					'type' => (int)$type,
					), array('%d','%d','%s' )                    
				);				
			}else return true;
		
		}	
	}

	public function deleteDocument( $id ){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ) {
			
			if ( !empty( $id ) ) {
				global $wpdb;
				$id = (int)$id;
				$wpdb->delete( sanitize_text_field( $wpdb->prefix )."crmerpbs_documents", array( 'trans_id' => $id ) );
			}
		
		}
		
	}

		
	
}


$doc = new CrmErpSolutionDocuments();