<?php
 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
 
 class CrmErpSolutionInit{
	
	public $tab;
	public $activeTab;
		
	public $allowed_html = array(
            'a' => array(
                'style' => array(),
                'href' => array(),
                'title' => array(),
                'class' => array(),
                'id'=>array(),
				'target'=>array(),
            ),
			'i' => array('style' => array(),'class' => array(),'id'=>array() ),
            'br' => array('style' => array(),'class' => array(),'id'=>array() ),
            'em' => array('style' => array(),'class' => array(),'id'=>array() ),
            'strong' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h1' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h2' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h3' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h4' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h5' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h6' => array('style' => array(),'class' => array(),'id'=>array() ),
            'img' => array('style' => array(),'class' => array(),'id'=>array() ),
            'p' => array('style' => array(),'class' => array(),'id'=>array() ),
            'div' => array('style' => array(),'class' => array(),'id'=>array() ),
            'section' => array('style' => array(),'class' => array(),'id'=>array() ), 
            'ul' => array('style' => array(),'class' => array(),'id'=>array() ),
            'li' => array('style' => array(),'class' => array(),'id'=>array() ),
            'ol' => array('style' => array(),'class' => array(),'id'=>array() ),
            'video' => array('style' => array(),'class' => array(),'id'=>array() ),
            'blockquote' => array('style' => array(),'class' => array(),'id'=>array() ),
            'figure' => array('style' => array(),'class' => array(),'id'=>array() ),
            'figcaption' => array('style' => array(),'class' => array(),'id'=>array() ),
            'style' => array(),
            'button' => array(
                'class' => array(),            
            ),

            'input' => array(
                'type' => array(), 
				'class' => array(), 				
				'placeholder' => array(), 
				'disabled' => array(),		
            ),				
            'option' => array(
                'value' => array(),
                'stock' => array(),
                'quantity' => array(),
                'price' => array(),
                'id' => array(),              
            ),			
            'iframe' => array(
                'height' => array(),
                'src' => array(),
                'width' => array(),
                'allowfullscreen' => array(),
                'style' => array(),
                'class' => array(),
                'id'=>array()                
            ),             
            'img' => array(
                'alt' => array(),
                'src' => array(),
                'title' => array(),
                'style' => array(),
                'class' => array(),
				'width' => array(),
				'height' => array(),
                'id'=>array()
            ), 
            'video' => array(
                'width' => array(),
                'height' => array(),
                'controls'=>array(),
                'class' => array(),
                'id'=>array()
            ),  
            'source' => array(
                'src' => array(),
                'type' => array(),
                'class' => array(),
                'id'=>array()
            ),             
        );	

	// function to query, display & finally delete an admin notice for this plugin

	public function notice() {
		
		$notice = get_option( "crmerpbs_notice", array() );
		// if a notice exists dipplay it in admin_notices section		
		if( !empty( $notice ) ){
					
			printf( '<div class="notice notice-%1$s %2$s"><p>%3$s</p></div>',
				esc_html( $notice['type'] ),
				esc_html( $notice['dismissible'] ),
				esc_html( $notice['notice'] )
			);
	
		}
		
		// Now delete the option
		if( ! empty( $notice ) ) {
			delete_option( "crmerpbs_notice", array() );
		}
	}
	
	public function random_color_part() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT );
	}

	public function getRandomColor() {
		return "#".$this->random_color_part() . $this->random_color_part() . $this->random_color_part();
	}
	
	public function adminHeader(){
		
			print "<h1 class='crmerpbs_title'>
			<a  href='". esc_url( admin_url( '?page=crm-erp-business-solution' ) )."'>
			<img src='". esc_url( plugins_url( "images/crmerpbs.png", __FILE__ )) ."'  /></a> 
			<button class='button-primary goFull'><i class='fa fa-desktop'></i>". esc_html__( " toggle Fullscreen", 'crm-erp-business-solution' ) ."</button> 
			<button  class='button-primary closeFull' style='display:none'><i class='fa fa-desktop'></i>". esc_html__( " toggle Fullscreen", 'crm-erp-business-solution' ) ."  </button> <button class='button-primary openIntro'><i class='fa fa-play'></i>". esc_html__( " Show Intro", 'crm-erp-business-solution' ) ."</button>
			<button class='button-primary crmsettings'><a  href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=settings" ) )."'><i class='fa fa-cog '></i> ". esc_html__( " Settings", 'crm-erp-business-solution' ) ."</a></button>
			<button class='button-primary crm_extensions'><i class='fa fa-puzzle-piece'></i>". esc_html__( " Extensions", 'crm-erp-business-solution' ) ."</button></h1>";
			
			add_action( 'admin_footer', array( $this, 'intro' ) );
	}
	
	public function adminSettings(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ){

			?>
			<div class='result'><?php $this->adminProcessSettings(); ?> </div>
			
			<?php
		
			do_action(  "crmerpbs_admintabs" );			
			
			if( isset( $_GET['tab'] ) ){
				
				$this->activeTab = sanitize_text_field( $_GET['tab'] ) ;
				
				if( isset( $_GET['action'] ) ) $this->activeAction = sanitize_text_field( $_GET['action'] ) ;
				
			}else $this->activeTab = '';			
			
			if( $this->activeTab == 'customers' || $this->activeTab == 'vendors') {
				
				if( isset( $_GET['action'] )  && $this->activeAction == 'new'  ) {
					do_action( "crmerpbs_addNew" );
				} 
				if( isset( $_GET['action'] )  && $this->activeAction == 'edit'  ) {
					CRMUsers::get_instance()->listView();
				} 
				if( isset( $_GET['action'] )  && $this->activeAction == 'view'  ) {
					CRMUsers::get_instance()->view( $_GET['id'] );
				}				
				if( isset( $_GET['action'] )  && $this->activeAction == 'delete' )  {
					CRMUsers::get_instance()->listView();
				}
				
				if( !isset( $_GET['action'] ) ){
					CRMUsers::get_instance()->listView();
				}
				
			}elseif( $this->activeTab == 'sales' || $this->activeTab == 'payments' || $this->activeTab == 'offers' ){
				

				if( isset( $_GET['action'] )  && $this->activeAction == 'new' ) {

					CRMTransactions::get_instance()->addNew();
				} 
				if( isset( $_GET['action'] )  && $this->activeAction == 'edit' ) {
					CRMTransactions::get_instance()->addNew();
				} 
				if( isset( $_GET['action'] )  && $this->activeAction == 'invoice' ) {
					CRMTransactions::get_instance()->listView();
				} 				
				if( isset( $_GET['action'] )  && $this->activeAction == 'view' ) {
					CRMTransactions::get_instance()->view();
				}

				if( isset( $_GET['do'] )  && ( $_GET['do'] == 'pdf' || $_GET['do'] == 'send' ) ) {
					CRMTransactions::get_instance()->crm_generatePdf( (int)$_GET['id'] );
				}

				
				if( isset( $_GET['action'] )  && $this->activeAction == 'delete' )  {
					CRMTransactions::get_instance()->listView();
				}

				
				if( !isset($_GET['action']) ){
					CRMTransactions::get_instance()->listView();
				}	
					
				
			}elseif( $this->activeTab == 'reports'  ) {
								
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
					$this->tab = array( '' => esc_html__( 'General', 'crm-erp-business-solution' ), 'sales' => esc_html__( 'ERP Sales', 'crm-erp-business-solution' ) , 'payments' =>esc_html__( 'ERP Payments/Purchases', 'crm-erp-business-solution' ),'eshop' => esc_html__( 'Eshop Orders', 'crm-erp-business-solution' ) , 'year' => esc_html__( 'Paid By Year', 'crm-erp-business-solution' ) , 'month'=> esc_html__( 'Paid By Month', 'crm-erp-business-solution' ) );
				}else{
					$this->tab = array( ''=> esc_html__( 'General', 'crm-erp-business-solution' ) , 'sales'=> esc_html__( 'ERP Sales', 'crm-erp-business-solution' ) ,'payments'=> esc_html__( 'ERP Payments/Purchases', 'crm-erp-business-solution' ),'year'=> esc_html__( 'Paid By Year', 'crm-erp-business-solution' ),'month'=> esc_html__( 'Paid By Month', 'crm-erp-business-solution' ) );
				}
				if( has_filter( "crmerpbs_report_tabs" ) ){
					$this->tab  = apply_filters( "crmerpbs_report_tabs", esc_html( $this->tab ) );
				}					
				
				if( isset( $_GET['tab'] ) && $_GET['tab'] == 'reports' ){
					
					$this->activeTab = sanitize_text_field( $_GET['tab'] );
					
				}else $this->activeTab = '';
				echo '<h2 class="nav-tab-wrapper" >';
				
				foreach( $this->tab as $tab => $name ){
					
					if( isset( $_GET['view'] ) ){
						$class = ( $tab == sanitize_text_field( $_GET['view'] ) ) ? ' nav-tab-active' : '';
					}else $class = ( $tab == sanitize_text_field( $this->activeTab ) ) ? ' nav-tab-active' : '';
					
						
						echo "<a class='nav-tab".esc_attr( $class )." contant' href='?page=crm-erp-business-solution&tab=reports&view=".esc_attr( $tab ) ."'>".esc_attr( $name ) ."</a>";
									
				}
				echo '</h2>';
				
				if( isset( $_GET['view'] ) && $_GET['view'] == '' || ( !isset( $_GET['view'] ) && isset( $_GET['tab'] ) && $_GET['tab'] =='reports' ) ){
					CrmErpSolutionReports::get_instance()->reportView();
				?>				


				<?php }elseif( isset( $_GET['view'] ) && ( $_GET['view'] == 'eshop' ) ){ ?>
					<div class='report_widge'>
						<?php do_action( 'crmerpbs_woo_report' ); ?>	
					</div>
					

				<?php }elseif( isset( $_GET['view'] ) && ( $_GET['view'] == 'sales' || $_GET['view'] == 'payments' ) ){ ?>
					<div class='report_widge'>
						<?php do_action( 'crmerpbs_transactions_report' ); ?>	
					</div>
					

				<?php }elseif( isset( $_GET['view'] ) && $_GET['view'] == 'year' ){ ?>
					<div class='report_widge'>
						<?php do_action( 'crmerpbs_date_report' ); ?>							
					</div>
					
				<?php }elseif( isset( $_GET['view'] ) && $_GET['view'] == 'month' ){ ?>
					<div class='report_widge'>
						<?php do_action( 'crmerpbs_date_report' ); ?>
					</div>
					
				<?php }
				
				do_action( 'crmerpbs_reports' );
					
			}elseif( $this->activeTab == 'settings' ){
				?>
				
				<form method="post" id='crmerpbsForm' class='ajaxify' > 
					
					<div id="tabs" class='clearfix'>
						<ul>
							<li><a href="#general"><?php  esc_html_e( 'General','crm-erp-business-solution' );?></a></li>
							<li><a href="#company"><?php  esc_html_e( 'Company Info', 'crm-erp-business-solution' );?></a></li>
							<li><a href="#documents"><?php  esc_html_e( 'Documents','crm-erp-business-solution' );?></a></li>
							<li><a href="#transactions"><?php  esc_html_e( 'Transactions','crm-erp-business-solution' );?></a></li>
							<li><a href="#users"><?php  esc_html_e( 'Users','crm-erp-business-solution' );?></a></li>
							
							<?php do_action( 'crmerpbs_more_options_tab' ); ?>							
							<?php do_action( 'crmerpbs_woocommerce_settings_tab' ); ?>
							
						</ul>					

						<div id='general'>
							<?php 
							settings_fields( 'crmerpbs_general-options' );
							do_settings_sections( 'crmerpbs_general-options' );
							?>
						</div>
						
						<div id='users'>
							<?php 
							settings_fields( 'crmerpbs_users-options' );
							do_settings_sections( 'crmerpbs_users-options' );
							?>
						</div>
						<div id='documents'><?php
							//set link to check sample pdf invoice
							$nonce = wp_create_nonce( 'crmerpbs_sample_pdf' );
							$doc = new CrmErpSolutionInvoice();
							$doc->samplePdf();
							?>						
							<h3>
							<center>
								<a target='' class='button-primary viewpdf' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=settings&do=pdf&_nonce=".$nonce ) ); ?>' >
								<i class='fa fa-file-pdf-o'></i> <?php esc_html_e( "Sample Document", 'crm-erp-business-solution' ); ?></a>
							</center>
							<?php 
							settings_fields( 'crmerpbs_documents-options' );
							do_settings_sections( 'crmerpbs_documents-options' );
							?>
						</div>						
						<div id='transactions'>
							<?php 
							settings_fields( 'crmerpbs_transactions-options' );
							do_settings_sections( 'crmerpbs_transactions-options' );
							?>
						</div>
						<div id='company'>
						
							
							<?php 							
							settings_fields( 'crmerpbs_company-options' );
							do_settings_sections( 'crmerpbs_company-options' );
							?>
						</div>

						
						<?php do_action( 'crmerpbs_more_options' ); ?>
					
						
						<?php do_action( 'crmerpbs_woocommerceoptions' ); ?>
						


					</div>
					<input type='hidden' name='crmerpbs_ProcessSettings' value='1' />
				<?php
				
				
				wp_nonce_field( 'crm-erp-business-solution' );
				submit_button();				
				
				?></form>
				
			<?php
			}elseif( $this->activeTab == 'general' || $this->activeTab == '' ){

				do_action( 'crmerpbs_generalView' );			
				echo "<br/><hr/><br/>";	
				CrmErpSolutionReports::get_instance()->reportView();
				
			}
			do_action( 'crmerpbs_more_views' );
			
			
			
		}//check if user has access to plugin
			
	}
	
	public function generalView(){
		
				foreach( $this->tab as $tab => $name ){
					
					if( $tab != 'general' ){
					$class = ( $tab == $this->activeTab ) ? ' av-tab-active' : '';

						if( $tab == 'appointments' ){
							echo "<div class='report_widget columns6 em'><a class='". esc_attr( $class ) ." contant' href='edit.php?post_type=crmerpbs_app'>". wp_kses(  $name , $this->allowed_html ) ."</a></div>";
						}elseif( $tab == 'products' ){										
							echo "<div class='report_widget columns6 em'><a class='". esc_attr( $class ) ." contant' href='edit.php?post_type=crmerpbs_products'>". wp_kses(  $name , $this->allowed_html ) ."</a></div>";								
						}elseif( $tab == 'tickets' ){	
							echo "<div class='report_widget columns6 em'><a class='". esc_attr( $class ) ." contant' href='edit.php?post_type=crmerpbs_tickets'>". wp_kses(  $name , $this->allowed_html ) ."</a></div>";
						}else{

							if( $tab == 'payments' ){
								$name = str_replace( "/","<br/>",$name  );
							}								
							echo "<div class='report_widget columns6 em'><a class='". esc_attr( $class ) ." contant' href='?page=crm-erp-business-solution&tab=".esc_attr( $tab )."'>". wp_kses(  $name , $this->allowed_html ) ."</a></div>";
							
						}					

					}				
				}				
	}

	public function adminTabs(){
			
			if( get_option( "crmerpbs_enableOffers" ) ){

				if( get_option( "crmerpbs_enableProducts" ) ){
					

					$tabs = array( 'general' => '<i class="fa fa-home"></i>','customers' => '<i class="fa fa-user"></i> '.esc_html__( 'Customers', 'crm-erp-business-solution' ) ,'vendors'=>'<i class="fa fa-user"></i> '.esc_html__( 'Vendors', 'crm-erp-business-solution' ) ,'sales'=>'<i class="fa fa-money"></i> '.esc_html__( 'Sales', 'crm-erp-business-solution' ) , 'payments' => esc_html__( 'Payments/Purchases', 'crm-erp-business-solution' ) ,'offers'=>'<i class="fa fa-tags"></i> '.esc_html__( 'Offers', 'crm-erp-business-solution' ) ,'products'=>'<i class="fa fa-cube"></i> '.esc_html__( 'Offline Products' , 'crm-erp-business-solution' ) );
					
				}else{
					
					$tabs = array( 'general'=>'<i class="fa fa-home"></i>','customers'=>'<i class="fa fa-user"></i> '.esc_html__( 'Customers', 'crm-erp-business-solution' ) ,'vendors'=>'<i class="fa fa-user"></i> '.esc_html__( 'Vendors', 'crm-erp-business-solution' ) ,'sales'=>'<i class="fa fa-money"></i> '.esc_html__( 'Sales', 'crm-erp-business-solution' ) , 'payments' => esc_html__( 'Payments/Purchases', 'crm-erp-business-solution' ) ,'offers'=>'<i class="fa fa-tags"></i> '.esc_html__( 'Offers', 'crm-erp-business-solution' ) );	
				}
				
								
			}else{

				if( get_option( "crmerpbs_enableProducts" ) ){
					
					$tabs = array( 'general'=>'<i class="fa fa-home"></i>','customers'=>'<i class="fa fa-user"></i> '.esc_html__( 'Customers', 'crm-erp-business-solution' ) ,'vendors'=>'<i class="fa fa-user"></i> '.esc_html__( 'Vendors', 'crm-erp-business-solution' ) ,'sales'=>'<i class="fa fa-money"></i> '.esc_html__( 'Sales', 'crm-erp-business-solution' ) , 'payments' => esc_html__( 'Payments/Purchases', 'crm-erp-business-solution' ) ,'products'=>'<i class="fa fa-cube"></i> '.esc_html__( 'Offline Products' , 'crm-erp-business-solution' ) );					
				}else{
					$tabs = array( 'general'=>'<i class="fa fa-home"></i>','customers'=>'<i class="fa fa-user"></i> '.esc_html__( 'Customers', 'crm-erp-business-solution' ) ,'vendors'=>'<i class="fa fa-user"></i> '.esc_html__( 'Vendors', 'crm-erp-business-solution' ) ,'sales'=>'<i class="fa fa-money"></i> '.esc_html__( 'Sales', 'crm-erp-business-solution' ) , 'payments' => esc_html__( 'Payments/Purchases', 'crm-erp-business-solution' ) );
				}
				
							
			}
			
			$this->tab = $tabs;

			if( get_option( "crmerpbs_enableAppointments" ) || isset( $_REQUEST[ "crmerpbs_enableAppointments" ] ) ) { 
				$appointments = array('appointments'=>'<i class="fa fa-calendar"></i> '. esc_html__( 'Appointments', 'crm-erp-business-solution' ) );
				$this->tab = array_merge( $this->tab , $appointments );
			}
			
			$rest = array( 'reports'=>'<i class="fa fa-bar-chart"></i> '. esc_html__( 'Reports', 'crm-erp-business-solution' ) );
			$this->tab = array_merge( $this->tab , $rest );


			if( has_filter( "crmerpbs_admin_tabs" ) ){
				$this->tab = apply_filters( "crmerpbs_admin_tabs", $this->tab );
			}	
		
			if( isset( $_GET['tab'] ) ){
				$this->activeTab = sanitize_text_field( $_GET['tab'] );
				
			}elseif( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'crmerpbs_app' ){
				
				$this->activeTab = 'appointments' ;
				
							
			}elseif( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'crmerpbs_products' ){
				
				$this->activeTab = 'products' ;
				
			}else $this->activeTab = '' ;	
			
			if( $this->activeTab != 'general' && $this->activeTab != ''  || !isset( $_GET['page'] )  ){
				
				echo '<h2 class="nav-tab-wrapper crmerpnav" >';
				
					foreach( $this->tab as $tab => $name ){
						$class = ( $tab == $this->activeTab ) ? ' nav-tab-active' : '';
						
						if($tab == 'appointments'){
							echo "<a class='nav-tab".esc_attr( $class )." contant' href='edit.php?post_type=crmerpbs_app'>". wp_kses(  $name , $this->allowed_html ) ."</a>";
						}elseif($tab == 'products'){
										
							echo "<a class='nav-tab".esc_attr( $class )." contant' href='edit.php?post_type=crmerpbs_products'>". wp_kses(  $name , $this->allowed_html ) ."</a>";
						}elseif($tab == 'tickets'){	
							echo "<a class='nav-tab".esc_attr( $class )." contant' href='edit.php?post_type=crmerpbs_tickets'>". wp_kses(  $name , $this->allowed_html ) ."</a>";
						}else{
										
							echo "<a class='nav-tab".esc_attr( $class )." contant' href='?page=crm-erp-business-solution&tab=".esc_attr( $tab )."'>". wp_kses(  $name , $this->allowed_html ) ."</a>";
							
						}
					}
				
				echo '</h2>';
			}

			?><div class='crmerpbs_result'></div> <?php	
	}
	
	

	
	public function adminFooter(){ ?>	
		<hr>
		<div></div>
		<?php $this->rating(); ?>
		
		<a target='_blank' class='extendwp_logo' href='https://extend-wp.com/wordpress-premium-plugins/'>
			<img  src='<?php echo esc_url( plugins_url( 'images/extendwp.png', __FILE__ ) ); ?>' alt='<?php esc_html__( "Get more plugins by extendWP", 'crm-erp-business-solution' ) ; ?>' title='<?php esc_html__( "Get more plugins by extendWP", 'crm-erp-business-solution' ) ; ?>' />
		</a><div class='get_ajax'></div>
		<?php 
		
	}
	
	public function rating(){
	?>
		<div class="notices notice-success rating is-dismissible">

			<?php esc_html_e( "You like this plugin? ", 'crm-erp-business-solution' ); ?><i class='fa fa-smile-o' ></i> <?php esc_html_e( "Then please give us ", 'crm-erp-business-solution' ); ?>
				<a target='_blank' href='https://wordpress.org/support/plugin/crm-erp-business-solution/reviews/#new-post'>
					<i class='fa fa-star' ></i><i class='fa fa-star' ></i><i class='fa fa-star' ></i><i class='fa fa-star' ></i><i class='fa fa-star' ></i>
				</a>

		</div> 	
	<?php	
	}
	
	public function general_options(){
		
		
		add_settings_field( 'enableEmails',esc_html__( "Enable Emails", 'crm-erp-business-solution' )." <a class='proVersion' target='_blank' href='".esc_url( $this->proAddon )."'>".esc_html__("PRO", 'crm-erp-business-solution') ."</a>", array( $this, 'enableEmails'),  "crmerpbs_general-options", "crmerpbs_general" );			
		register_setting( "crmerpbs_general", "crmerpbs_enableEmails" );
		
		add_settings_field( 'enableActions',esc_html__( "Enable Actions", 'crm-erp-business-solution' )." <a class='proVersion' target='_blank' href='".esc_url( $this->proAddon )."'>".esc_html__("PRO", 'crm-erp-business-solution') ."</a>", array( $this, 'enableActions'),  "crmerpbs_general-options", "crmerpbs_general" );			
		register_setting( "crmerpbs_general", "crmerpbs_enableActions" );		

		add_settings_field( 'enableTickets',esc_html__( "Enable Tickets", 'crm-erp-business-solution' )." <a class='proVersion' target='_blank' href='".esc_url( $this->proAddon )."'>".esc_html__("PRO", 'crm-erp-business-solution') ."</a>", array( $this, 'enableTickets'), "crmerpbs_general-options", "crmerpbs_general" );			
		register_setting( "crmerpbs_general", "crmerpbs_enableTickets" );

		add_settings_field( 'enableStock',esc_html__( "Enable Product Stock Inventory", 'crm-erp-business-solution' )." <a class='proVersion' target='_blank' href='".esc_url( $this->proAddon )."'>".esc_html__("PRO", 'crm-erp-business-solution') ."</a>", array( $this, 'enableStock'), "crmerpbs_general-options", "crmerpbs_general" );			
		register_setting( "crmerpbs_general", "crmerpbs_enableTickets" );
		
		add_settings_field( 'userSegment', esc_html__( "User Segmentation", 'crm-erp-business-solution' )." <a class='proVersion' target='_blank' href='".esc_url( $this->proAddon )."'>".esc_html__("PRO", 'crm-erp-business-solution') ."</a>", array( $this, 'userSegment'), "crmerpbs_users-options", "crmerpbs_users" );			
		register_setting( "crmerpbs_users", "crmerpbs_userSegment" );


		add_settings_field( 'userDiscount', esc_html__( "User Discount (%)", 'crm-erp-business-solution' )." <a class='proVersion' target='_blank' href='".esc_url( $this->proAddon )."'>".esc_html__("PRO", 'crm-erp-business-solution') ."</a>", array( $this, 'userDiscount'), "crmerpbs_users-options", "crmerpbs_users" );			
		register_setting( "crmerpbs_users", "crmerpbs_userDiscount" );	
		
	}
	
	public function adminPanels(){
				
		add_settings_section( "crmerpbs_general", "", null, "crmerpbs_general-options" );
		add_settings_section( "crmerpbs_transactions", "", null, "crmerpbs_transactions-options" );
		add_settings_section( "crmerpbs_company", "", null, "crmerpbs_company-options" );
		add_settings_section( "crmerpbs_users", "", null, "crmerpbs_users-options" );
		

		
		add_settings_field( 'accessRole', esc_html__( "Plugin Access Role (apart from admin)", 'crm-erp-business-solution' ), array( $this, 'accessRole' ),  "crmerpbs_general-options", "crmerpbs_general" );			
		register_setting( "crmerpbs_general", "crmerpbs_accessRole" );
		

		add_settings_field( 'enableAppointments',esc_html__( "Enable Appointments", 'crm-erp-business-solution' ), array( $this, 'enableAppointments' ), "crmerpbs_general-options", "crmerpbs_general" );			
		register_setting( "crmerpbs_general", "crmerpbs_enableAppointments" );

		
		add_settings_field('enableOffers',esc_html__( "Enable Offers", 'crm-erp-business-solution' ), array( $this, 'enableOffers' ),  "crmerpbs_general-options", "crmerpbs_general" );			
		register_setting( "crmerpbs_general", "crmerpbs_enableOffers" );
		
		
		do_action( "crmerpbs_general_options" ); 

		add_settings_field( 'deleteSettings',esc_html__( "Delete settings on uninstall", 'crm-erp-business-solution' ), array( $this, 'deleteSettings' ),  "crmerpbs_general-options", "crmerpbs_general");			
		register_setting( "crmerpbs_general", "crmerpbs_deleteSettings" );

		add_settings_field( 'deleteTables', esc_html__( "Delete tables on uninstall", 'crm-erp-business-solution' ), array( $this, 'deleteTables' ), "crmerpbs_general-options", "crmerpbs_general" );			
		register_setting( "crmerpbs_general", "crmerpbs_deleteTables" );
		
		
		add_settings_field( 'defaultVat', esc_html__( "Default tax", 'crm-erp-business-solution' ) ." % ". esc_html__( "for transactions", 'crm-erp-business-solution' ), array( $this, 'defaultVat' ),  "crmerpbs_transactions-options", "crmerpbs_transactions" );			
		register_setting( "crmerpbs_transactions", "crmerpbs_currencySymbol" );
		
		add_settings_field( 'currencySymbol', esc_html__( "Choose Currency", 'crm-erp-business-solution' ), array( $this, 'currencySymbol' ),  "crmerpbs_transactions-options", "crmerpbs_transactions");			
		register_setting( "crmerpbs_transactions", "crmerpbs_currencySymbol" );

		add_settings_field( 'paymentMethod', esc_html__( "Payment Methods", 'crm-erp-business-solution' ), array( $this, 'paymentMethod' ), "crmerpbs_transactions-options", "crmerpbs_transactions");			
		register_setting( "crmerpbs_transactions", "crmerpbs_paymentMethod" );

		add_settings_field( 'onlySelectDocuments', esc_html__( "Invoice on Transaction only on Demand", 'crm-erp-business-solution' ), array( $this, 'onlySelectDocuments'), "crmerpbs_transactions-options", "crmerpbs_transactions" );			
		register_setting( "crmerpbs_transactions", "crmerpbs_onlySelectDocuments" );			

		add_settings_field( 'companyName', esc_html__( "Company Name", 'crm-erp-business-solution' ), array( $this, 'companyName' ), "crmerpbs_company-options", "crmerpbs_company" );			
		register_setting( "crmerpbs_company", "crmerpbs_companyName" );


		add_settings_field( 'companyImage', esc_html__( "Company Image", 'crm-erp-business-solution' ), array( $this, 'companyImage' ), "crmerpbs_company-options", "crmerpbs_company" );			
		register_setting( "crmerpbs_company", "crmerpbs_companyImage" );
		
		
		add_settings_field( 'companyVat', esc_html__( "Company Vat", 'crm-erp-business-solution' ), array( $this, 'companyVat' ), "crmerpbs_company-options", "crmerpbs_company" );			
		register_setting( "crmerpbs_company", "crmerpbs_companyVat" );
		
		
		add_settings_field( 'companyPhone', esc_html__( "Company Phone", 'crm-erp-business-solution' ), array( $this, 'companyPhone' ), "crmerpbs_company-options", "crmerpbs_company" );			
		register_setting( "crmerpbs_company", "crmerpbs_companyPhone" );

		add_settings_field( 'companyMobile', esc_html__( "Company Mobile", 'crm-erp-business-solution' ), array( $this, 'companyMobile' ), "crmerpbs_company-options", "crmerpbs_company" );			
		register_setting( "crmerpbs_company", "crmerpbs_companyMobile" );
		
		add_settings_field( 'companyAddress', esc_html__( "Company Adress", 'crm-erp-business-solution' ), array( $this, 'companyAddress' ),  "crmerpbs_company-options", "crmerpbs_company" );			
		register_setting( "crmerpbs_company", "crmerpbs_companyAddress" );

	
	}


	public function companyAddress(){

		if( isset( $_REQUEST['crmerpbs_companyAddress'] ) ){
			$companyAddress =  wp_kses( $_REQUEST[ 'crmerpbs_companyAddress' ], $this->allowed_html );
		}elseif( get_option( 'crmerpbs_companyAddress' ) !='' ){
			$companyAddress = wp_kses( get_option( 'crmerpbs_companyAddress' ), $this->allowed_html );
		}else $companyAddress = '';
		

		echo wp_editor( apply_filters( $companyAddress, $companyAddress ), 'crmerpbs_companyAddress', array( "wpautop" => true, 'textarea_name' => 'crmerpbs_companyAddress', 'textarea_rows' => '5','editor_height' => 225)  );	
	}

	public function companyName(){
		
		if( isset( $_REQUEST['crmerpbs_companyName'] ) ){
			$companyName =  sanitize_text_field( $_REQUEST[ 'crmerpbs_companyName'] );
		}elseif( get_option( 'crmerpbs_companyName' ) !='' ){
			$companyName = sanitize_text_field( get_option( 'crmerpbs_companyName' ) );
		}else $companyName = '';
		?>
			<input type="text"  name="crmerpbs_companyName" id="crmerpbs_companyName" placeholder='<?php print esc_html__('name', 'crm-erp-business-solution' ); ?>' value="<?php echo  esc_attr( $companyName ); ?>"  />
		<?php
	}
	
	public function companyPhone(){
		if( isset( $_REQUEST[ 'crmerpbs_companyPhone'] ) ){
			$companyPhone =  sanitize_text_field( $_REQUEST[ 'crmerpbs_companyPhone'] );
		}elseif( get_option( 'crmerpbs_companyPhone' ) !='' ){
			$companyPhone = sanitize_text_field( get_option( 'crmerpbs_companyPhone' ) );
		}else $companyPhone = '';
		?>
			<input type="text"  name="crmerpbs_companyPhone" id="crmerpbs_companyPhone" placeholder='<?php print esc_html__('phone', 'crm-erp-business-solution' ); ?>' value="<?php echo  esc_attr( $companyPhone ); ?>"  />
		<?php
	}
	
	public function companyMobile(){
		if( isset( $_REQUEST[ 'crmerpbs_companyMobile'] ) ){
			$companyMobile =  sanitize_text_field( $_REQUEST[ 'crmerpbs_companyMobile' ] );
		}elseif( get_option( 'crmerpbs_companyMobile' ) !='' ){
			$companyMobile = sanitize_text_field( get_option( 'crmerpbs_companyMobile' ) );
		}else $companyMobile = '';
		?>
			<input type="text"  name="crmerpbs_companyMobile" id="crmerpbs_companyMobile" placeholder='<?php print esc_html__( 'mobile phone', 'crm-erp-business-solution' ); ?>' value="<?php echo  esc_attr( $companyMobile ); ?>"  />
		<?php
	}
	public function companyVat(){
		if( isset( $_REQUEST[ 'crmerpbs_companyVat'] ) ){
			$companyVat =  sanitize_text_field( $_REQUEST[ 'crmerpbs_companyVat'] );
		}elseif( get_option( 'crmerpbs_companyVat' ) !='' ){
			$companyVat = sanitize_text_field( get_option( 'crmerpbs_companyVat' ) );
		}else $companyVat = '';
		?>
			<input type="text"  name="crmerpbs_companyVat" id="crmerpbs_companyVat" placeholder='<?php print esc_html__( 'vat number', 'crm-erp-business-solution' ); ?>' value="<?php echo  esc_attr( $companyVat ); ?>"  />
		<?php
	}

	public function defaultVat(){
		if( isset( $_REQUEST[ 'crmerpbs_defaultVat'] ) ){
			$defaultVat =  sanitize_text_field( $_REQUEST[ 'crmerpbs_defaultVat'] );
		}elseif( get_option( 'crmerpbs_defaultVat' ) !='' ){
			$defaultVat =  sanitize_text_field( get_option( 'crmerpbs_defaultVat' ) );
		}else $defaultVat = '';
		?>
			<input type="text"  name="crmerpbs_defaultVat" id="crmerpbs_defaultVat" placeholder='<?php print esc_html__('Default Tax percentage for transactions', 'crm-erp-business-solution' ); ?>' value="<?php echo esc_attr( $defaultVat ); ?>"  />
		<?php
	}



	public function companyImage(){

		if( get_option( 'crmerpbs_companyImage' ) !='' ){
			$companyImage = sanitize_text_field( get_option( 'crmerpbs_companyImage' ) );
		}elseif(  isset( $_REQUEST[ 'crmerpbs_companyImage'] ) ){
			$companyImage =  sanitize_text_field( $_REQUEST[ 'crmerpbs_companyImage'] );			
		}else $companyImage = '';
		
		?>			
			<input id="crmerpbs_companyImage" type="button" class="button" value="<?php esc_html_e( "Upload /select Image",'crm-erp-business-solution' ); ?>" />
			
			<p class='uploader_p'></p>
		<?php
				if(!empty( $companyImage ) ){
					print "<img class='existing' src='".esc_url( $companyImage )."' width='100' />";
					echo "<br/><button class='button-primary removeImage' >".esc_html__( "Remove Image", 'crm-erp-business-solution' )."</button>";
				}
				echo "<input type='hidden' name='crmerpbs_pic_url' placeholder='".esc_html__( "image url",'crm-erp-business-solution' )."' class='crmerpbs_pics_url'  
				value='". esc_attr( $companyImage )."'
				/>";
				
	}


	public function currencySymbol(){

		if( get_option( 'crmerpbs_currencySymbol' ) !='' ){
			$currencySymbol = sanitize_text_field( get_option( 'crmerpbs_currencySymbol' ) );
		}elseif(  isset( $_REQUEST[ 'crmerpbs_currencySymbol'] ) ){
			$currencySymbol =  sanitize_text_field( $_REQUEST[ 'crmerpbs_currencySymbol'] );			
		}else $currencySymbol = '';
		

		?>
			<select name="crmerpbs_currencySymbol"   placeholder='<?php print esc_html__( "handle custom fields", 'crm-erp-business-solution' ); ?>' >
				<option  value=''  ><?php print esc_html__( "Select..",'crm-erp-business-solution' ); ?></option>
				<?php 
				foreach( $this->currency_symbols() as $key=>$value ){
					?>
				<option  value='<?php print esc_attr( $value ); ?>' <?php if( $currencySymbol == html_entity_decode( $value) ) print "selected='selected'"; ?> ><?php print esc_html( $key . " ".$value ); ?></option>	
					<?php
				}
				?>
			</select>		
		<?php
	}
	
	public function paymentMethod(){
		
		if( isset( $_REQUEST[ 'crmerpbs_paymentMethod' ] ) ){
			
			$paymentMethod =  sanitize_text_field( $_REQUEST[ 'crmerpbs_paymentMethod' ] );
			$methods = $_REQUEST[ 'crmerpbs_paymentMethod' ];
			
		}elseif( get_option( 'crmerpbs_paymentMethod' )!='' ){
			
			$paymentMethod = sanitize_text_field( get_option( 'crmerpbs_paymentMethod' ) );
			$methods = explode( ",", $paymentMethod );
			
		}else $paymentMethod = '';
		$count = 0;
		if( !empty( $methods ) ){
			
			foreach( $methods as $method ){
				$method = sanitize_text_field( $method );
				?>
				<div class="paymentWrap multipleItems">
					<input type="text"  class='multipleInput' id='paymentMethod' name="crmerpbs_paymentMethod[]" id="crmerpbs_paymentMethod" placeholder='<?php print esc_html__('Payment method', 'crm-erp-business-solution' ); ?>' value="<?php echo  esc_attr( $method ); ?>"  /> 
					
					<?php  if( $count >= 0 ){ ?>
						<span  class='totalWrap plusSetting' style='visibility:visible' ><i class='fa fa-plus'></i></span> <span  class='totalWrap minusSetting'   ><i class='fa fa-minus'></i></span>
					<?php }else{ ?>
						<span  class='totalWrap plusSetting' style='visibility:hidden' ><i class='fa fa-plus'></i></span> <span  class='totalWrap minusSetting' style='visibility:hidden'  ><i class='fa fa-minus'></i></span>
					<?php } ?>
				</div>			
				<?php
				
				$count++;
			}
		}else{
							
			?><div class="paymentWrap">
				<input type="text" name="crmerpbs_paymentMethod[]" id="crmerpbs_paymentMethod" placeholder='<?php print esc_html__( 'Payment method','crm-erp-business-solution' ); ?>' value="<?php echo  esc_attr( $paymentMethod ); ?>"  /> <span  class='totalWrap plusSetting' ><i class='fa fa-plus'></i></span> <span  class='totalWrap minusSetting' style='visibility:hidden'  ><i class='fa fa-minus'></i></span>

			</div>
			<?php
		}
			
	}

	public function onlySelectDocuments(){
		
		if( isset ( $_REQUEST[ 'crmerpbs_onlySelectDocuments' ] ) ){
			$onlySelectDocuments =  sanitize_text_field( $_REQUEST[ 'crmerpbs_onlySelectDocuments' ] );
		}else $onlySelectDocuments = sanitize_text_field( get_option( 'crmerpbs_onlySelectDocuments' ) ); 
		?>
			<input type="checkbox" name="crmerpbs_onlySelectDocuments" id="crmerpbs_onlySelectDocuments" value='true'  <?php if( $onlySelectDocuments == 'true' ) print "checked"; ?> />
		<?php
	}

	
	public function userSegment(){
					
			?>
			<input type="text"   class='proVersion' disabled placeholder='<?php echo  esc_html__( ' PRO Addon', 'crm-erp-business-solution' ); ?>'  />
			<?php
		
	}

	public function userDiscount(){
		
			?>
			<input type="text"  disabled class='multipleInput proVersion'  placeholder='<?php echo  esc_html__( ' PRO Addon', 'crm-erp-business-solution' ); ?>'    /> 
			<?php
	
	}

	public function enableAppointments(){
		
		if( isset( $_REQUEST[ 'crmerpbs_enableAppointments' ] ) ){
			
			$enableAppointments = sanitize_text_field( $_REQUEST[ 'crmerpbs_enableAppointments' ] );
			
		}else $enableAppointments = sanitize_text_field( get_option( 'crmerpbs_enableAppointments' ) ); 
		?>
			<input type="checkbox" name="crmerpbs_enableAppointments" id="crmerpbs_enableAppointments" value='true'  <?php if( $enableAppointments == 'true' ) print "checked"; ?> />
		<?php
	}

	public function enableTickets(){
		
		if( isset( $_REQUEST[ 'crmerpbs_enableTickets' ] ) ){
			
			$enableTickets =  sanitize_text_field( $_REQUEST[ 'crmerpbs_enableTickets' ] );
			
		}else $enableTickets = sanitize_text_field( get_option( 'crmerpbs_enableTickets' ) ); 
		?>
			<input disabled type="checkbox" name="crmerpbs_enableTickets" id="crmerpbs_enableTickets" value='true'  />
		<?php
		
	}

	public function enableStock(){
		
		if( isset( $_REQUEST[ 'crmerpbs_enableStock' ] ) ){
			
			$enableStock =  sanitize_text_field( $_REQUEST[ 'crmerpbs_enableStock' ] );
			
		}else $enableStock = sanitize_text_field( get_option( 'crmerpbs_enableStock' ) ); 
		?>
			<input disabled type="checkbox" name="crmerpbs_enableStock" id="crmerpbs_enableStock" value='true'  />
		<?php
		
	}
	
	public function enableActions(){
		
		if( isset( $_REQUEST[ 'crmerpbs_enableActions' ] ) ){
			$enableActions =  sanitize_text_field( $_REQUEST[ 'crmerpbs_enableActions' ] );
		}else $enableActions = sanitize_text_field( get_option( 'crmerpbs_enableActions' ) ); 
		
		?>
			<input disabled type="checkbox" name="crmerpbs_enableActions" id="crmerpbs_enableActions" value='true'   />
		<?php
		
	}

	public function enableEmails(){
		
		?>
			<input disabled type="checkbox" name="crmerpbs_enableEmails" id="crmerpbs_enableEmails" value='true'   />
		<?php
	}


	public function deleteSettings(){
		
		if( isset( $_REQUEST[ 'crmerpbs_deleteSettings' ] ) ){
			$deleteSettings =  sanitize_text_field( $_REQUEST[ 'crmerpbs_deleteSettings' ] );
		}else $deleteSettings = sanitize_text_field( get_option( 'crmerpbs_deleteSettings' ) ); 
		?>
			<input type="checkbox" name="crmerpbs_deleteSettings" id="crmerpbs_deleteSettings" value='true'  <?php if( $deleteSettings == 'true' ) print "checked"; ?> />
		<?php
		
	}

	public function deleteTables(){
		
		if( isset( $_REQUEST[ 'crmerpbs_deleteTables' ] ) ){
			
			$deleteTables =  sanitize_text_field( $_REQUEST[ 'crmerpbs_deleteTables' ] );
		}else $deleteTables = sanitize_text_field( get_option( 'crmerpbs_deleteTables' ) );
		?>
			<input type="checkbox" name="crmerpbs_deleteTables" id="crmerpbs_deleteTables" value='true'  <?php if( $deleteTables == 'true' ) print "checked"; ?> />
		<?php
	}

	public function enableOffers(){
		
		if( isset( $_REQUEST[ 'crmerpbs_enableOffers' ] ) ){
			$enableOffers =  sanitize_text_field( $_REQUEST[ 'crmerpbs_enableOffers' ] );
		}else $enableOffers = sanitize_text_field( get_option( 'crmerpbs_enableOffers' ) ); 
		
		?>
			<input type="checkbox" name="crmerpbs_enableOffers" id="crmerpbs_enableOffers" value='true'  <?php if( $enableOffers == 'true' ) print "checked"; ?> />
		<?php
	}



	public function accessRole() {
		// determine role that will have access to the plugin
		
		if( isset( $_REQUEST[ 'crmerpbs_accessRole' ] ) ){
			$accessRole =  sanitize_text_field( $_REQUEST[ 'crmerpbs_accessRole' ] );
		}else $accessRole = sanitize_text_field( get_option( 'crmerpbs_accessRole' ) );		
		?>
		<div class="form-field">
		<?php
		global $wp_roles;
		$all_roles = $wp_roles->roles;		
		
		print "<select name='crmerpbs_accessRole' >";
			print "<option value=''>".esc_html__( "Select Role...", 'crm-erp-business-solution' ) ."</option>";
			
			foreach( $all_roles as $key=>$value ){
				
				if ( $key != 'administrator' ){ ?>
				
					<option <?php if( $accessRole == $key ) print 'selected=selected'; ?> value='<?php print esc_attr( $key ) ; ?>' ><?php print esc_attr( $value['name'] ) ; ?></option> 		
				<?php
				
				}
			}
		print "</select>";
		?>
 
		</div>
	<?php
	}
	
	public function adminProcessSettings(){
		
	if($_SERVER['REQUEST_METHOD'] == 'POST' && current_user_can( 'crm-erp-business-solution' ) && isset( $_POST[ 'crmerpbs_ProcessSettings' ] ) ){
		
			check_admin_referer( 'crm-erp-business-solution' );
			check_ajax_referer( 'crm-erp-business-solution' );	
			
			$documents = new CrmErpSolutionDocuments();
			$documents->adminProcessSettings();	
			

			
			if( isset( $_REQUEST[ 'crmerpbs_accessRole' ] ) && !empty(  $_REQUEST[ 'crmerpbs_accessRole' ] ) ){
				$accessRole = sanitize_text_field( $_REQUEST[ 'crmerpbs_accessRole' ] );
			
				update_option( 'crmerpbs_accessRole' ,$accessRole );
				
			}else {
				if( get_option( 'crmerpbs_accessRole' ) ){
					$role = get_role( get_option( 'crmerpbs_accessRole' ) );
					$role->remove_cap( 'crm-erp-business-solution' );					
				}				
				update_option( 'crmerpbs_accessRole','' );
			}
			
			if( isset( $_REQUEST[ 'crmerpbs_enableOffers' ] ) && !empty( $_REQUEST[ 'crmerpbs_enableOffers' ] ) ){
				$enableOffers = sanitize_text_field( $_REQUEST[ 'crmerpbs_enableOffers' ] );
				update_option( 'crmerpbs_enableOffers' ,$enableOffers );
				
			}else update_option( 'crmerpbs_enableOffers','' );
		

			if( isset( $_REQUEST[ 'crmerpbs_deleteSettings' ] ) && !empty( $_REQUEST[ 'crmerpbs_deleteSettings' ] ) ){
				$deleteSettings = sanitize_text_field( $_REQUEST[ 'crmerpbs_deleteSettings' ] );
				update_option( 'crmerpbs_deleteSettings' ,$deleteSettings );
				
			}else update_option( 'crmerpbs_deleteSettings','' );
			
			if( isset( $_REQUEST[ 'crmerpbs_deleteTables' ]  ) && !empty( $_REQUEST[ 'crmerpbs_deleteTables' ] ) ){
				$deleteTables = sanitize_text_field( $_REQUEST[ 'crmerpbs_deleteTables' ] );
				update_option( 'crmerpbs_deleteTables' ,$deleteTables );
				
			}else update_option( 'crmerpbs_deleteTables','' );
			


			if( isset( $_REQUEST[ 'crmerpbs_enableAppointments' ] ) && !empty( $_REQUEST[ 'crmerpbs_enableAppointments' ] ) ){
				$enableAppointments = sanitize_text_field( $_REQUEST[ 'crmerpbs_enableAppointments' ] );
				update_option( 'crmerpbs_enableAppointments', $enableAppointments );
				
			}else update_option( 'crmerpbs_enableAppointments','' );
			
			
			if( isset( $_REQUEST[ 'crmerpbs_currencySymbol' ] ) ){
				update_option( 'crmerpbs_currencySymbol', sanitize_text_field( $_REQUEST[ 'crmerpbs_currencySymbol' ] ) );				
			}
		
			if( isset( $_REQUEST[ 'crmerpbs_companyAddress' ] ) ){
			   $companyAddress =  sanitize_text_field( $_REQUEST[ 'crmerpbs_companyAddress' ] );
			   update_option( 'crmerpbs_companyAddress',$companyAddress ); 
			}
					
	
			if( isset( $_REQUEST[ 'crmerpbs_companyName' ] ) ){
			   $companyName =  update_option( 'crmerpbs_companyName', sanitize_text_field( $_REQUEST[ 'crmerpbs_companyName' ] ) );
			}				
			if( isset($_REQUEST[ 'crmerpbs_companyVat']) ){
			   $companyVat =  update_option( 'crmerpbs_companyVat', sanitize_text_field( $_REQUEST[ 'crmerpbs_companyVat' ] ) );
			}	
			if( isset( $_REQUEST[ 'crmerpbs_companyPhone' ] ) ){
			   $companyVat =  update_option( 'crmerpbs_companyPhone', sanitize_text_field( $_REQUEST[ 'crmerpbs_companyPhone' ] ) );
			}
			if( isset( $_REQUEST['crmerpbs_companyMobile'] ) ){
			   $companyVat =  update_option( 'crmerpbs_companyMobile', sanitize_text_field( $_REQUEST[ 'crmerpbs_companyMobile' ] ) );
			}	

			if( isset( $_REQUEST[ 'crmerpbs_defaultVat' ] ) ){
			   $defaultVat =  update_option( 'crmerpbs_defaultVat', sanitize_text_field( $_REQUEST[ 'crmerpbs_defaultVat' ] ) );
			}
			
			if( isset( $_REQUEST[ 'crmerpbs_onlySelectDocuments' ] ) ){
			   $onlySelectDocuments =  update_option( 'crmerpbs_onlySelectDocuments', sanitize_text_field( $_REQUEST[ 'crmerpbs_onlySelectDocuments' ] ) );
			}else delete_option('crmerpbs_onlySelectDocuments' );


			if( isset($_REQUEST['crmerpbs_pic_url']) ){
				 $companyImage =  update_option( 'crmerpbs_companyImage', sanitize_text_field( $_REQUEST[ 'crmerpbs_pic_url' ] ) );
			}else update_option( 'crmerpbs_companyImage','' );



			if( isset( $_REQUEST[ 'crmerpbs_paymentMethod' ] ) ){
				$payme = implode( ",", $_REQUEST[ 'crmerpbs_paymentMethod' ] );
			   $paymentMethod =  update_option( 'crmerpbs_paymentMethod' , sanitize_text_field( $payme ) );
			}
				
			
		}
	}
	
	
	public function checkPrice(){
		
		if ( !function_exists( 'crm_price' ) ) {
			function crm_price( $price ){
				
				if( (int)$price <> 0 ){
					return $price . get_option( 'crmerpbs_currencySymbol' );
				}else return '-';
			}
		}

	}


	public function currency_symbols(){
		$currency_symbols = array(
			'AED' => '&#1583;.&#1573;', // ?
			'AFN' => '&#65;&#102;',
			'ALL' => '&#76;&#101;&#107;',
			'AMD' => '',
			'ANG' => '&#402;',
			'AOA' => '&#75;&#122;', // ?
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&#402;',
			'AZN' => '&#1084;&#1072;&#1085;',
			'BAM' => '&#75;&#77;',
			'BBD' => '&#36;',
			'BDT' => '&#2547;', // ?
			'BGN' => '&#1083;&#1074;',
			'BHD' => '.&#1583;.&#1576;', // ?
			'BIF' => '&#70;&#66;&#117;', // ?
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => '&#36;&#98;',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTN' => '&#78;&#117;&#46;', // ?
			'BWP' => '&#80;',
			'BYR' => '&#112;&#46;',
			'BZD' => '&#66;&#90;&#36;',
			'CAD' => '&#36;',
			'CDF' => '&#70;&#67;',
			'CHF' => '&#67;&#72;&#70;',
			'CLF' => '', // ?
			'CLP' => '&#36;',
			'CNY' => '&#165;',
			'COP' => '&#36;',
			'CRC' => '&#8353;',
			'CUP' => '&#8396;',
			'CVE' => '&#36;', // ?
			'CZK' => '&#75;&#269;',
			'DJF' => '&#70;&#100;&#106;', // ?
			'DKK' => '&#107;&#114;',
			'DOP' => '&#82;&#68;&#36;',
			'DZD' => '&#1583;&#1580;', // ?
			'EGP' => '&#163;',
			'ETB' => '&#66;&#114;',
			'EUR' => '&#8364;',
			'FJD' => '&#36;',
			'FKP' => '&#163;',
			'GBP' => '&#163;',
			'GEL' => '&#4314;', // ?
			'GHS' => '&#162;',
			'GIP' => '&#163;',
			'GMD' => '&#68;', // ?
			'GNF' => '&#70;&#71;', // ?
			'GTQ' => '&#81;',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => '&#76;',
			'HRK' => '&#107;&#110;',
			'HTG' => '&#71;', // ?
			'HUF' => '&#70;&#116;',
			'IDR' => '&#82;&#112;',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'IQD' => '&#1593;.&#1583;', // ?
			'IRR' => '&#65020;',
			'ISK' => '&#107;&#114;',
			'JEP' => '&#163;',
			'JMD' => '&#74;&#36;',
			'JOD' => '&#74;&#68;', // ?
			'JPY' => '&#165;',
			'KES' => '&#75;&#83;&#104;', // ?
			'KGS' => '&#1083;&#1074;',
			'KHR' => '&#6107;',
			'KMF' => '&#67;&#70;', // ?
			'KPW' => '&#8361;',
			'KRW' => '&#8361;',
			'KWD' => '&#1583;.&#1603;', // ?
			'KYD' => '&#36;',
			'KZT' => '&#1083;&#1074;',
			'LAK' => '&#8365;',
			'LBP' => '&#163;',
			'LKR' => '&#8360;',
			'LRD' => '&#36;',
			'LSL' => '&#76;', // ?
			'LTL' => '&#76;&#116;',
			'LVL' => '&#76;&#115;',
			'LYD' => '&#1604;.&#1583;', // ?
			'MAD' => '&#1583;.&#1605;.', //?
			'MDL' => '&#76;',
			'MGA' => '&#65;&#114;', // ?
			'MKD' => '&#1076;&#1077;&#1085;',
			'MMK' => '&#75;',
			'MNT' => '&#8366;',
			'MOP' => '&#77;&#79;&#80;&#36;', // ?
			'MRO' => '&#85;&#77;', // ?
			'MUR' => '&#8360;', // ?
			'MVR' => '.&#1923;', // ?
			'MWK' => '&#77;&#75;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => '&#77;&#84;',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => '&#67;&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#65020;',
			'PAB' => '&#66;&#47;&#46;',
			'PEN' => '&#83;&#47;&#46;',
			'PGK' => '&#75;', // ?
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#71;&#115;',
			'QAR' => '&#65020;',
			'RON' => '&#108;&#101;&#105;',
			'RSD' => '&#1044;&#1080;&#1085;&#46;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'RWF' => '&#1585;.&#1587;',
			'SAR' => '&#65020;',
			'SBD' => '&#36;',
			'SCR' => '&#8360;',
			'SDG' => '&#163;', // ?
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&#163;',
			'SLL' => '&#76;&#101;', // ?
			'SOS' => '&#83;',
			'SRD' => '&#36;',
			'STD' => '&#68;&#98;', // ?
			'SVC' => '&#36;',
			'SYP' => '&#163;',
			'SZL' => '&#76;', // ?
			'THB' => '&#3647;',
			'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
			'TMT' => '&#109;',
			'TND' => '&#1583;.&#1578;',
			'TOP' => '&#84;&#36;',
			'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => '',
			'UAH' => '&#8372;',
			'UGX' => '&#85;&#83;&#104;',
			'USD' => '&#36;',
			'UYU' => '&#36;&#85;',
			'UZS' => '&#1083;&#1074;',
			'VEF' => '&#66;&#115;',
			'VND' => '&#8363;',
			'VUV' => '&#86;&#84;',
			'WST' => '&#87;&#83;&#36;',
			'XAF' => '&#70;&#67;&#70;&#65;',
			'XCD' => '&#36;',
			'XDR' => '',
			'XOF' => '',
			'XPF' => '&#70;',
			'YER' => '&#65020;',
			'ZAR' => '&#82;',
			'ZMK' => '&#90;&#75;', // ?
			'ZWL' => '&#90;&#36;',
		);
		return $currency_symbols;
	}

	public function extensions(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ){
			
			$response = wp_remote_get( "https://extend-wp.com/wp-json/products/v2/product/category/crm-erp" );
			if( is_wp_error( $response ) ) {
				return;
			}		
			$posts = json_decode( wp_remote_retrieve_body( $response ) );

			if( empty( $posts ) ) {
				return;
			}

			if( !empty( $posts ) ) {
				echo "<div id='crmerpbs_extensions_popup'>";
					echo "<div class='crmerpbs_extensions_content'>";	
						?>
						<span class="crmerpbsclose">&times;</span>
						<h2><i><?php esc_html_e( 'Extend CRM ERP & meet you Business Needs!','crm-erp-business-solution' ); ?></i></h2>
						<hr/>
						<?php
						foreach( $posts as $post ) {

							if( class_exists( $post->class ) ){
								
								echo "<div class='columns2 crm_opacity'><img src='".esc_url( $post->image )."' />
								<h3>". esc_html( $post->title ) . "</h3>
								<div>". wp_kses( $post->excerpt, $this->allowed_html )."</div>
								<h4><i>". esc_html__( 'installed', 'crm-erp-business-solution' ) . "</i> <i class='fa fa-2x fa-check'></i></h4>
								</div>";
								
							}else{
								
								echo "<div class='columns2'><a target='_blank' href='".esc_url( $post->url )."' /><img src='".esc_url( $post->image )."' /></a>
								<h3><a target='_blank' href='".esc_url( $post->url )."' />". esc_html( $post->title ) . "</a></h3>
								<div>". wp_kses( $post->excerpt, $this->allowed_html )."</div>
								<a class='button_extensions button-primary' target='_blank' href='".esc_url( $post->url )."' />". esc_html__( 'Get it here', 'crm-erp-business-solution' ) . " <i class='fa fa-angle-double-right'></i></a>
								</div>";								
							}
							

						}
					echo '</div>';
				echo '</div>';	
			}
		
		}
	}

	public function wooInt(){ 
		
		if ( class_exists( 'WooCommerce' ) && !class_exists( 'CrmErpSolutionWoo' ) ) {
			?>
			<div class='introwidget crmprofeatures columns3'>							
									
				<h3>
					<img style='height:50px' src='<?php print esc_url( plugins_url( "images/woo.png", __FILE__ ) ) ;?>'  /> <br/>
					<?php print wp_kses( $this->wooAddon(), $this->allowed_html ) ; ?>
					</h3> 
				</div>
			<?php
		}
	}
	
	public function wooAddon(){
		return " <a class='proVersion' target='_blank' href='".esc_url( $this->wooAddon )."' >".esc_html__( 'WooCommerce Integration Addon', 'crm-erp-business-solution' )."</a>";
	}
	
	public function proAddon(){
		return " <a class='proVersion' target='_blank' href='".esc_url( $this->proAddon )."' >".esc_html__( 'Pro Addon', 'crm-erp-business-solution' )."</a>";
	}
	
	public function intro(){
		
		add_action( 'crmerpbs_wooInt',  array( $this,'wooInt' ),9, 1  );
		
		$step1 ='';
		$step2 ='';
		$step3 ='';
		$step4 ='';
		$step5 ='';
				
		if( get_option( 'crmerpbs_companyAddress' ) && get_option( 'crmerpbs_companyName' ) ) {
			$step1 ='active';
		}
				
		global $wpdb;
				
		$cc = $wpdb->get_var( "SELECT id FROM ".sanitize_text_field( $wpdb->prefix.'crmerpbs_transactions' )."  " );
				
		if( $cc ) $step4 = 'active';
		
		$args = array (
			'role'       => 'crm_customer',
			'order'      => 'ASC',
			'orderby'    => 'display_name',
		);
		$customers_query = new WP_User_Query( $args );
		// Get the results
		$customers = $customers_query->get_results();	
		if( count( $customers )  <> 0 ) {
			$step2 ='active';
			$customers = '<span style="color:green"><i class="fa fa-check"></i> '.count( $customers ).esc_html__( " CRM Customers already added" , 'crm-erp-business-solution' ) .'</span>';	
			$customersMessage = '';
		}else {
			$customers = '<span style="color:red">'.esc_html__( "No CRM Customers added yet" , 'crm-erp-business-solution' ) .'</span>';
			$customersMessage = '<span style="color:red">'.esc_html__( "Add Customers first" , 'crm-erp-business-solution' ) .'</span>';
		}
		$args = array (
			'role'       => 'crm_vendor',
			'order'      => 'ASC',
			'orderby'    => 'display_name',
		);
		$vendors_query = new WP_User_Query( $args );
		// Get the results
		$vendors = $vendors_query->get_results();	
		if( count( $vendors )  <> 0 ) {
			$vendors = '<span style="color:green"><i class="fa fa-check"></i> '.count( $vendors ).esc_html__( " CRM Vendors already added" , 'crm-erp-business-solution' ) .'</span>';
			$vendorsMessage = '';
		}else {
			$vendors = '<span style="color:red">'.esc_html__( "No CRM Vendors added yet" , 'crm-erp-business-solution' ) .'</span>';
			$vendorsMessage = '<span style="color:red">'.esc_html__( "Add Vendors first" , 'crm-erp-business-solution' ) .'</span>';
		}


		$args = array(
			'post_type' => array('crmerpbs_products' ),
			'posts_per_page' => 1,
		);
					
		$products = new WP_Query( $args );
				
		if( $products->have_posts() ) {
			$step3 ='active';
			$products = '<span style="color:green"><i class="fa fa-check"></i> '. esc_html( $products->post_count ) . esc_html__( " Offline Products already added" ,'crm-erp-business-solution' ) .'</span>';	
			$productsMessage = '';
		}else {
			$products = '<span style="color:red">'.esc_html__( "No Offline Products added yet" , 'crm-erp-business-solution' ) .'</span>';
			$productsMessage = '<span style="color:red">'.esc_html__( "Add Products first" , 'crm-erp-business-solution' ) .'</span>';
		}
				
		$appargs = array(
			'post_type' => array('crmerpbs_app' ),
			'posts_per_page' => 1,
		);
					
		$appointments = new WP_Query( $appargs );	
		if( $appointments->have_posts() ) {
			$step5 ='active';
		}
		?>

					<div class='crmerpbsintro crmerpbsmodal ' id='crmerpbsmodal' >
						
						<div class='crmerpbsmodal-content'>
							<span class="crmerpbsclose">&times;</span>
							
							<center>							
							<h2><?php esc_html_e( "Welcome to CRM ERP Business Solution for WordPress & WooCommerce", 'crm-erp-business-solution' ) ; ?> </h2>
							<p><i><?php esc_html_e( "Record & Track your Transactions, Customers, Vendors, Appointments, Products, Print and Send by Email Invoices &Offers & view your Reports!" , 'crm-erp-business-solution' ) ;?> </i></p>
							</center>
							
							</hr/>

							
							<div class='progress_container'>
								<ul class="progressbar">
								  <li class="<?php print esc_attr( $step1 );?> ">
									<a target='_blank' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=settings" ) ) ; ?>'><?php esc_html_e( "set your settings", 'crm-erp-business-solution' ) ; ?></a>
								  </li>								
								  <li class="<?php print esc_attr( $step2 );?>">
									<?php esc_html_e( "add customers", 'crm-erp-business-solution' ) ; ?><br/>
									<?php esc_html_e( " & vendors", 'crm-erp-business-solution' ) ; ?>
								  <li class="<?php print esc_attr( $step3 );?>">
									<?php esc_html_e( "add products", 'crm-erp-business-solution' ) ; ?>
								  </li>
								  <li class="<?php print esc_attr( $step4 );?>">
									<?php esc_html_e( "add sales, offers", 'crm-erp-business-solution' ) ; ?><br/>
									<?php esc_html_e( " & purchases", 'crm-erp-business-solution' ) ; ?>										  
								  </li>
								  <li class="<?php print esc_attr( $step5 );?>">
									<?php esc_html_e( "set appointments", 'crm-erp-business-solution' ) ; ?>
								  </li>
								</ul>	
							</div>
							<div class='theflex'>
							<div class='introwidget columns3'>
								<h3><i class='fa fa-user'></i> <a target='_blank' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=customers&action=new" ) ) ; ?>'><?php esc_html_e( "Add your Customers", 'crm-erp-business-solution' ) ; ?></a></h3>
								<?php print wp_kses( $customers, $this->allowed_html ) ; ?>
							</div>
							<div class='introwidget columns3'>
								<h3><i class='fa fa-user'></i> <a target='_blank' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=vendors&action=new" ) ) ; ?>'><?php esc_html_e( "Add your Vendors", 'crm-erp-business-solution' ) ; ?></a></h3> 
								<?php print wp_kses( $vendors, $this->allowed_html ) ; ?>
							</div>	
							<div class='introwidget columns3'>
								<h3><i class='fa fa-cube'></i> <a target='_blank' href='<?php print esc_url( admin_url( "post-new.php?post_type=crmerpbs_products" ) ) ; ?>'><?php esc_html_e( "Add your Offline Products", 'crm-erp-business-solution' ) ; ?></a></h3>
								<?php print wp_kses( $products, $this->allowed_html ) ; ?>								
							</div>		
							<div class='introwidget columns3'>
																
								<?php if( $customersMessage !='' ) { ?>
									<h3><i class='fa fa-money'></i> <?php esc_html_e( "Add Sales but..", 'crm-erp-business-solution' ) ; ?> </h3> 
									<?php print wp_kses( $customersMessage, $this->allowed_html ) ; ?>
								<?php }else{ ?>
									<h3><i class='fa fa-money'></i> <a target='_blank' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=sales&action=new" ) ) ; ?>'><?php esc_html_e( "Add Sales", 'crm-erp-business-solution' ) ; ?></a></h3>   
								<?php } ?>	
							</div>	
							<div class='introwidget columns3'>
							
								<?php if( $vendorsMessage !='' ) { ?>

									<h3><i class='fa fa-money'></i> <?php esc_html_e( "Add Payments/purchases but..", 'crm-erp-business-solution' ) ; ?></h3> 	
									<?php print wp_kses( $vendorsMessage, $this->allowed_html ) ; ?>
								<?php }else{ ?>
									<h3><i class='fa fa-money'></i> <a target='_blank' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=payments&action=new" ) ) ; ?>'><?php esc_html_e( "Add Payments/purchases", 'crm-erp-business-solution' ) ; ?></a></h3> 								
								<?php } ?>								
							</div>
							<div class='introwidget columns3'>
								
								<h3><i class='fa fa-file-pdf-o'></i> <?php esc_html_e( "Send Invoices", 'crm-erp-business-solution' ) ; ?></h3>  
								
							</div>							
							<div class='introwidget columns3'>
								
								<?php if( $customersMessage !='' ) { ?>
									<h3><i class='fa fa-tag'></i> <?php esc_html_e( "Add Offer but..", 'crm-erp-business-solution' ) ; ?> </h3> 
									<?php print wp_kses( $customersMessage, $this->allowed_html ) ; ?>
								<?php }else{ ?>
									<h3><i class='fa fa-tag'></i> <a target='_blank' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=offers&action=new" ) ) ; ?>'><?php esc_html_e( "Create & Send Offers", 'crm-erp-business-solution' ) ; ?></a></h3>  
								<?php } ?>								
								
							</div>

							<div class='introwidget  columns3'>
								
								<?php if( $customersMessage !='' ) { ?>
									<h3><i class='fa fa-calendar'></i> <?php esc_html_e( "Add Appointments but..", 'crm-erp-business-solution' ) ; ?></h3> 
								<?php }else{ ?>
									<h3><i class='fa fa-calendar'></i> <a target='_blank' href='<?php print esc_url( admin_url( "post-new.php?post_type=crmerpbs_app" ) ) ; ?>'><?php esc_html_e( "Add Appointments", 'crm-erp-business-solution' ) ; ?></a></h3> 
								<?php } ?>									
								<?php print wp_kses( $customersMessage, $this->allowed_html ) ; ?>
								<?php print wp_kses( $vendorsMessage, $this->allowed_html ) ; ?>
							</div>	

							<div class='introwidget columns3'>
								<h3><i class='fa fa-bar-chart'></i> <a target='_blank' href='<?php print esc_url( admin_url( "?page=crm-erp-business-solution&tab=reports" ) ) ; ?>'><?php esc_html_e( "View your Reports", 'crm-erp-business-solution' ) ; ?> </a></a></h3> 
							</div>
							
							<?php do_action( 'crmerpbs_wooInt' ); ?>
							
							<div class='introwidget crmprofeatures columns3'>
								
								<h3>
									<i class='fa fa-pie-chart'></i> <?php esc_html_e( "Categorize CRM ERP Users", 'crm-erp-business-solution' ) ; ?>
									<?php print wp_kses( $this->proAddon(), $this->allowed_html ); ?>
								</h3>    
								
							</div>	
							<div class='introwidget crmprofeatures columns3'>
								
								<h3>
									<i class='fa fa-cube'></i> <?php esc_html_e( "Product Stock Inventory", 'crm-erp-business-solution' ) ; ?>
									<?php print wp_kses( $this->proAddon(), $this->allowed_html ); ?>
								</h3>    
								
							</div>	
							<div class='introwidget crmprofeatures columns3'>
								
								<h3>
									<i class='fa fa-tag'></i> <?php esc_html_e( "Add Wholesale Prices to Products", 'crm-erp-business-solution' ) ; ?>
									<?php print wp_kses( $this->proAddon(), $this->allowed_html ); ?>
								</h3>    
								
							</div>								
							<div class='introwidget crmprofeatures columns3'>
								
								<h3>
									<i class='fa fa-headphones'></i> <?php esc_html_e( "Add Customers Tickets", 'crm-erp-business-solution' ) ; ?>
									<?php print wp_kses( $this->proAddon(), $this->allowed_html ); ?>
								</h3>    
								
							</div>	

	
							<div class='introwidget crmprofeatures columns3'>
								 
									<h3>
										<i class='fa fa-envelope'></i> <?php esc_html_e( "Send Emails in Bulk to Customers", 'crm-erp-business-solution' ) ; ?>
										<?php print wp_kses( $this->proAddon(), $this->allowed_html ); ?>
									</h3>
							</div>
							
							<div class='introwidget crmprofeatures columns3'>
								<h3>
									<i class='fa fa-upload'></i> <?php esc_html_e( "Bulk Import/Export your Data", 'crm-erp-business-solution' ) ; ?>
									<?php print wp_kses( $this->proAddon(), $this->allowed_html ); ?>
								</h3>  
								
							</div>	
							<div class='introwidget crmprofeatures columns3'>							
								
									<h3>
										<i class='fa fa-map-marker'></i> <?php esc_html_e( "Track your Customers' Action on site", 'crm-erp-business-solution' ) ; ?> 
										<?php print wp_kses( $this->proAddon(), $this->allowed_html ); ?>
									</h3> 
							</div>	
							

							
							<?php do_action( 'crmerpbs_more_in_intro' ); ?>
							</div>
						</div>
					
					</div>


				<?php
				?>
				<script>
				(function( $ ) {
					if( !localStorage.getItem('hideIntro') ) $(".crmerpbsmodal").slideDown();
				})( jQuery )
				</script>					
				<?php
			
		}	
	
 }