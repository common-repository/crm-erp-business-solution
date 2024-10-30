<?php
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CrmErpSolutionProducts{
	

    protected static $instance = NULL;


    public static function get_instance()
    {
        if ( NULL === self::$instance )
            self::$instance = new self;

        return self::$instance;
    }
	

	public function __construct() {	
	
		if( get_option( "crmerpbs_enableProducts" ) ){

			add_action( "init", array( $this,"offlineProducts" ) );
			add_action( "admin_init", array( $this,"metaBox" ) );
			add_action( "admin_init", array( $this,"init" ) );
			add_action( "save_post", array( $this,"saveFields" ) );	
			add_action( 'admin_menu', array( $this,'menu_page') );				
			add_filter( 'manage_crmerpbs_products_posts_columns', array( $this,'addColumnHeader' ) );				
			add_filter( "manage_edit-crmerpbs_products_sortable_columns", array( $this,"addColumnHeader" ) );	
			add_filter( "manage_crmerpbs_products_columns", array( $this,"column_order" ) );
			add_filter( 'manage_edit-crmerpbs_products_columns', array( $this,"column_order" ) );			
			add_filter( 'pre_get_posts', array( $this, 'searchfilter') );	
			
			add_action( "init", array( $this,"offlineProducts" ) );
			
			add_action( "crmerpbs_wholesaleInList", array( $this,'wholesaleInList' ),10,1 );
			add_action( "crmerpbs_stockInList", array( $this,'stockInList' ),10,1 );
			add_action( "crmerpbs_more_prod_fields", array( $this,'wholesaleField' ),10 );
			add_action( "crmerpbs_more_prod_fields", array( $this,'stockField' ),10 );
			
			add_filter( 'post_updated_messages', array( $this, 'crmerpbs_products_cpt_messages' ) );
			
		}

			add_action( 'wp_ajax_nopriv_displayProducts', array( $this,'displayProducts' ) );
			add_action( 'wp_ajax_displayProducts', array( $this,'displayProducts' ) );		
			add_action( 'wp_ajax_nopriv_getTransactionProducts', array( $this,'displaySoldProductsTransactions' ) );
			add_action( 'wp_ajax_getTransactionProducts', array( $this,'displaySoldProductsTransactions' ) );
			add_action( 'wp_ajax_nopriv_getProducts', array( $this,'displaySoldProducts' ) );
			add_action( 'wp_ajax_getProducts', array( $this,'displaySoldProducts' ) );				
			
			
	}

	public function init(){
		
		if( get_option( "crmerpbs_enableProducts" ) ){
			
			add_action( 'restrict_manage_posts', array( $this,'filter_products' ) , 10, 2 );
			add_action( 'manage_crmerpbs_products_posts_custom_column', array( $this,'addAdColumns' ),10, 2 );	

		}
	}

	
	public function offlineProducts(){
		  register_post_type( 'crmerpbs_products',
			array(
			  'labels' => array(
				'name' => esc_html__( 'Offline Products' ,'crm-erp-business-solution' ),
				'singular_name' => esc_html__( 'Offline Product','crm-erp-business-solution' ),
				'search_items' =>  esc_html__( 'Search Offline Products' ,'crm-erp-business-solution' ),
				'all_items' => esc_html__( 'All Offline Products' ,'crm-erp-business-solution' ),
				'parent_item' => esc_html__( 'Parent Offline Product','crm-erp-business-solution' ),
				'parent_item_colon' => esc_html__( 'Parent Offline Product:','crm-erp-business-solution' ),
				'edit_item' => esc_html__( 'Edit Offline Product', 'crm-erp-business-solution' ), 
				'update_item' => esc_html__( 'Update Offline Product' , 'crm-erp-business-solution' ),
				'add_new_item' => esc_html__( 'Add New Offline Product' , 'crm-erp-business-solution' ),
				'add_new'            => esc_html__( 'New Offline Product', 'crm-erp-business-solution' ),
				'new_item_name' => esc_html__( 'New Offline Product Name', 'crm-erp-business-solution' ),
				'view_item' => esc_html__( 'View Offline Product', 'crm-erp-business-solution' ),
				'edit_item'   => esc_html__( 'Edit Offline Product', 'crm-erp-business-solution' ),
				'new_item'           => esc_html__( 'New Offline Product', 'crm-erp-business-solution' ),
				'menu_name' => esc_html__( 'Offline Products', 'crm-erp-business-solution' ),
				'not_found' => esc_html__('No Products found', 'crm-erp-business-solution' ),
			
			  ),
			  'description' => esc_html__( 'Adding and editing my Offline Products', 'crm-erp-business-solution' ),
			  'menu_icon'   => 'dashicons-tag',
			  'supports' => array( 'title', 'thumbnail' , 'editor' ),
				'show_in_rest'       => true,
				'rest_base'          => 'crmerpbs_products',
				'rest_controller_class' => 'WP_REST_Posts_Controller',	
				'capability_type' => 'page',
				'hierarchical' => false,
				'menu_position'      => null,
				'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
				'publicly_queryable' => true,  // you should be able to query it
				'show_ui' => true,  // you should be able to edit it in wp-admin
				//'show_in_menu'       => false,
				'menu_position'      => null,
				'show_in_menu'       => false,
				'exclude_from_search' => true,  // you should exclude it from search results
				'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
				'has_archive' => true,  // it shouldn't have archive page
				
				'rewrite' => false,  // it shouldn't have rewrite rules
			)
		  );
		   $labels = array(
			'name' => esc_html__( 'Category', 'crm-erp-business-solution' ),
			'singular_name' => esc_html__( 'Category', 'crm-erp-business-solution' ),
			'search_items' =>  esc_html__( 'Search Category','crm-erp-business-solution' ),
			'all_items' => esc_html__( 'All Category' , 'crm-erp-business-solution' ),
			'parent_item' => esc_html__( 'Parent Category' , 'crm-erp-business-solution' ),
			'parent_item_colon' => esc_html__( 'Parent Category:' , 'crm-erp-business-solution' ),
			'edit_item' => esc_html__( 'Edit Category', 'crm-erp-business-solution' ), 
			'update_item' => esc_html__( 'Update Category', 'crm-erp-business-solution' ),
			'add_new_item' => esc_html__( 'Add New Category', 'crm-erp-business-solution' ),
			'new_item_name' => esc_html__( 'New Type Category', 'crm-erp-business-solution' ),
			'menu_name' => esc_html__( 'Category' , 'crm-erp-business-solution' ),
		  ); 	
		  register_taxonomy( 'off_prod_cat', array( 'crmerpbs_products' ), array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_admin_column' => true,
			'query_var' => true,
				'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
				'publicly_queryable' => true,  // you should be able to query it
				'show_ui' => true,  // you should be able to edit it in wp-admin
				'exclude_from_search' => true,  // you should exclude it from search results
				'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
				'has_archive' => false,  // it shouldn't have archive page
				'rewrite' => false,  // it shouldn't have rewrite rules		   		   
		  ));

		   $labels = array(
			'name' => esc_html__( 'Brand', 'crm-erp-business-solution' ),
			'singular_name' => esc_html__( 'Brand', 'crm-erp-business-solution' ),
			'search_items' =>  esc_html__( 'Search Brand', 'crm-erp-business-solution' ),
			'all_items' => esc_html__( 'All Brand' , 'crm-erp-business-solution' ),
			'parent_item' => esc_html__( 'Parent Brand' , 'crm-erp-business-solution' ),
			'parent_item_colon' => esc_html__( 'Parent Brand:' , 'crm-erp-business-solution' ),
			'edit_item' => esc_html__( 'Edit Brand', 'crm-erp-business-solution'  ), 
			'update_item' => esc_html__( 'Update Brand', 'crm-erp-business-solution' ),
			'add_new_item' => esc_html__( 'Add New Brand', 'crm-erp-business-solution' ),
			'new_item_name' => esc_html__( 'New Type Brand', 'crm-erp-business-solution' ),
			'menu_name' => esc_html__( 'Brand' , 'crm-erp-business-solution' ),
		  ); 	
		  register_taxonomy( 'off_prod_brand', array( 'crmerpbs_products' ), array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_admin_column' => true,
			'query_var' => true,
				'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
				'publicly_queryable' => true,  // you should be able to query it
				'show_ui' => true,  // you should be able to edit it in wp-admin
				'exclude_from_search' => true,  // you should exclude it from search results
				'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
				'has_archive' => false,  // it shouldn't have archive page
				'rewrite' => false,  // it shouldn't have rewrite rules		   
		   
			'supports' => array( 'title', 'editor', 'image' ),
		  ));
		  
	}

	/**
	 * crmerpbs_products CPT updates messages.
	 */
	 
	public function crmerpbs_products_cpt_messages( $messages ) {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages['crmerpbs_products'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => esc_html__( 'Offline Product updated.', 'crm-erp-business-solution' ),
			2  => esc_html__( 'Custom field updated.', 'crm-erp-business-solution' ),
			3  => esc_html__( 'Custom field deleted.', 'crm-erp-business-solution' ),
			4  => esc_html__( 'Offline Product updated.', 'crm-erp-business-solution' ),
			5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Offline Product restored to revision from %s', 'crm-erp-business-solution' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => esc_html__( 'Offline Product published.', 'crm-erp-business-solution' ),
			7  => esc_html__( 'Offline Product saved.', 'crm-erp-business-solution' ),
			8  => esc_html__( 'Offline Product submitted.', 'crm-erp-business-solution' ),
			9  => sprintf(
				esc_html__( 'Offline Product scheduled for: <strong>%1$s</strong>.', 'crm-erp-business-solution' ),
				date_i18n( esc_html__( 'M j, Y @ G:i', 'crm-erp-business-solution' ), strtotime( $post->post_date ) )
			),
			10 => esc_html__( 'Offline Product draft updated.', 'crm-erp-business-solution' )
		);
		return $messages;
	}
	
	public function metaBox( $post ){
		
		add_meta_box( "prodPrice", esc_html__( 'Product Info', 'crm-erp-business-solution' ), array( $this, "priceCreate" ) , "crmerpbs_products", "normal", "high" ); 
		
	}	
	

	public function addColumnHeader( $columns ) {
			
		$columns['Image']  = esc_html__( 'Image', 'crm-erp-business-solution' );
		$columns['SKU']  = esc_html__( 'Sku', 'crm-erp-business-solution' );
		$columns['Brand']  = esc_html__( 'Brand', 'crm-erp-business-solution' );
		$columns['Category']  = esc_html__( 'Category', 'crm-erp-business-solution' );
		$columns['WholesalePrice']  = esc_html__( 'Wholesale Price', 'crm-erp-business-solution' );	
		$columns['Stock']  = esc_html__( 'Stock', 'crm-erp-business-solution' );
		$columns['Price']  = esc_html__( 'Retail Price', 'crm-erp-business-solution' );
		
		return $columns;

	}

	public function stockInList(){
		print CrmErpSolution::get_instance()->proAddon();
	}
	
	public function wholesaleInList(){
		print CrmErpSolution::get_instance()->proAddon();
	}
	
	public function addAdColumns( $column_name, $post_id ) {
		
			global $post;
			
			if( $column_name === 'Image' ) {
				
				$image = get_the_post_thumbnail( (int)$post_id, array( 50, 50) );
				if( $image !='' ) {
					print wp_kses( $image , CrmErpSolution::get_instance()->allowed_html );
				}
				
			}	
			
			if( $column_name === 'SKU' ) {
				$sku = get_post_meta( (int)$post_id, "crmerpbs_sku", true );
				
				if( $sku != '' ) {
					echo esc_html( $sku );
				}
			}

			if( $column_name === 'Price' ) {
				$price = get_post_meta( (int)$post_id, "crmerpbs_price", true );
				
				if( $price !='' ) {
					echo esc_html( crm_price( $price ) );
				}
			}
			
			if( $column_name === 'WholesalePrice' ) {
				
				do_action( "crmerpbs_wholesaleInList", (int)$post_id );
			}
		
			
			if( $column_name === 'Stock' ) {
				
				do_action( "crmerpbs_stockInList", (int)$post_id );
			}
			
			if( $column_name === 'Category' ) {

				$terms = get_the_terms( (int)$post_id, 'off_prod_cat' );
										 
				if ( $terms && ! is_wp_error( $terms ) ) : 
				 
					$cat_links = array();
				 
					foreach ( $terms as $term ) {
						$cat_links[] = $term->name;
					}
										 
					$cat = join( ", ", $cat_links );
					?>
				 
					<p class="">
						<?php printf( esc_html__( '%s', 'crm-erp-business-solution' ), esc_html( $cat ) ); ?>
					</p>
				<?php endif; 
				
			}	
			
			if( $column_name === 'Brand' ) {

				$terms = get_the_terms( (int)$post_id, 'off_prod_brand' );
										 
				if ( $terms && ! is_wp_error( $terms ) ) : 
				 
					$brand_links = array();
				 
					foreach ( $terms as $term ) {
						$brand_links[] = $term->name;
					}
										 
					$brand = join( ", ", $brand_links );
					?>
				 
					<p class="">
						<?php printf( esc_html__( '%s', 'crm-erp-business-solution' ), esc_html( $brand ) ); ?>
					</p>
				<?php endif; 
				
			}	
			
	}

	public function column_order( $columns ) {
		
			unset( $columns );
			
			$columns = array(
			
				'cb' => '<input type="checkbox" />', //Render the checkbox
				//'id' => __('ID', 'crm-erp-business-solution' ),
				'Image' => esc_html__( 'Image', 'crm-erp-business-solution' ),
				'title' => esc_html__( 'Title', 'crm-erp-business-solution' ),
				'Brand' => esc_html__( 'Brand', 'crm-erp-business-solution' ),
				'Category' => esc_html__( 'Category', 'crm-erp-business-solution' ),
				'SKU' => esc_html__( 'SKU', 'crm-erp-business-solution' ),
				'Price' => esc_html__( 'Retail Price', 'crm-erp-business-solution' ),
				'WholesalePrice' => esc_html__( 'Wholesale Price', 'crm-erp-business-solution' ),				
				'Stock' => esc_html__( 'Stock', 'crm-erp-business-solution' ),
				'Date' => esc_html__( 'Date', 'crm-erp-business-solution' ),
							
			);		
			
			return $columns;
	}
		
	public function wholesaleField( ){	?>
	
		<p><label ><?php print esc_html__( 'Wholesale Price', 'crm-erp-business-solution' ). CrmErpSolution::get_instance()->proAddon() ; ?></label> <input  disabled  name='crmerpbs_wholesaleprice'  /></p> 
	<?php
	}

	public function stockField( ){	?>
	
		<p><label ><?php print esc_html__( 'Stock', 'crm-erp-business-solution' ). CrmErpSolution::get_instance()->proAddon() ; ?></label> <input  disabled  name='crmerpbs_quantity'  /></p> 
	<?php
	}
	
	public function priceCreate( $post ){
		
		$sku = get_post_meta( (int)$post->ID, 'crmerpbs_sku' , true ) ;
		$sku = sanitize_text_field( $sku );
		
        ?>   <p><label ><?php esc_html_e( 'SKU', 'crm-erp-business-solution' )?></label> <input name='crmerpbs_sku' value='<?php print esc_attr( $sku ); ?>' /></p>    <?php	


		
		$price = get_post_meta( (int)$post->ID, 'crmerpbs_price' , true ) ;		
		$price = sanitize_text_field( $price );
		
        ?>   <p><label ><?php esc_html_e( 'Retail Price', 'crm-erp-business-solution' )?></label> <input name='crmerpbs_price' value='<?php print esc_attr( $price ); ?>' /></p>    <?php	
			
		do_action( "crmerpbs_more_prod_fields" );	
		
	}

	
	public function saveFields(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ) {	
		
			global $post;
			
			if( isset( $post->ID ) && get_post_type( (int)$post->ID ) == 'crmerpbs_products' ){
				
				
				if( isset( $_POST[ "crmerpbs_sku" ] ) ){
					
					if ( !empty( $_POST[ "crmerpbs_sku" ] ) ) {
						
						$sku = sanitize_text_field( $_POST[ "crmerpbs_sku" ] ) ;
						
						update_post_meta( (int)$post->ID, "crmerpbs_sku", $sku );	
						 
					}
				}		
				
				if( isset( $_POST[ 'crmerpbs_price' ] ) ){
					
					if ( !empty( $_POST[ "crmerpbs_price" ] ) ) {
						
						$price = sanitize_text_field( $_POST[ "crmerpbs_price" ] );
						
						update_post_meta( (int)$post->ID, "crmerpbs_price", $price );	       
					}
				}
			
			}
		
		}

		
	}

	public function menu_page() {
		
		add_submenu_page( "crm-erp-business-solution", esc_html__( "Offline Products", 'crm-erp-business-solution' ), esc_html__( "Offline Products", 'crm-erp-business-solution' ), 'crm-erp-business-solution', esc_url( admin_url( 'edit.php?post_type=crmerpbs_products' ) ) , NULL );
		
	}

	public function filter_products( $post_type, $which ) {

		// Apply this only on a specific post typeaka offline products
		if ( 'crmerpbs_products' !== $post_type )
			return;

		// A list of taxonomy slugs to filter by
		$taxonomies = array( 'off_prod_brand', 'off_prod_cat' );

		foreach ( $taxonomies as $taxonomy_slug ) {

			// Retrieve taxonomy data
			$taxonomy_obj = get_taxonomy( $taxonomy_slug );
			$taxonomy_name = sanitize_text_field( $taxonomy_obj->labels->name );

			// Retrieve taxonomy terms
			$terms = get_terms( $taxonomy_slug );

			// Display filter HTML
			echo "<select name='". esc_attr( $taxonomy_slug ) . "' id='". esc_attr( $taxonomy_slug ) . "' class='postform'>";
			echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'crm-erp-business-solution' ), $taxonomy_name ) . '</option>';
			foreach ( $terms as $term ) {
				printf(
					'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
					esc_attr( $term->slug ),
					( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] === $term->slug ) ) ? ' selected="selected"' : '' ),
					esc_attr( $term->name ),
					(int)$term->count
				);
			}
			echo '</select>';
		}
	}
	

	public function searchSoldProductForm(){
		?>
		<i class='fa fa-search productsearch' style='cursor:pointer;'></i>
		<input type="text" id="searchproduct"  name="searchproduct" placeholder='<?php esc_html_e( "Select product: search by sku/name", 'crm-erp-business-solution' ); ?>' />	
		<?php
	}
	
	public function searchProductForm(){
		
		$required = 'required';
		if( isset( $_REQUEST['action'] ) && $_REQUEST['action'] =='new' && isset( $_REQUEST['parent'] ) ) $required = '';
		?>
		<i class='fa fa-search productsearch' style='width:10%;cursor:pointer;'></i>
		<input type="text" id="searchproduct" <?php print esc_attr( $required ); ?> style='width:85%' name="searchproduct" placeholder='<?php esc_html_e( "Select product: search by sku/name", 'crm-erp-business-solution' ); ?>' />	
		<select id='product' style='display:none;width:100%'  name='product' class="code "></select>
		<?php
	}

	public function searchfilter( $query ) {
		
		if( $title = $query->get( '_meta_or_title' ) ){
			
			$title = sanitize_title( $title );
			add_filter( 'get_meta_sql', function( $sql ) use ( $title )
			{
				global $wpdb;

				// Only run once:
				static $nr = 0; 
				if( 0 != $nr++ ) return $sql;

				// Modify WHERE part:
				$sql['where'] = sprintf(
					" AND ( %s OR %s ) ",
					$wpdb->prepare( "{$wpdb->posts}.post_title LIKE  '%s'", '%' . $wpdb->esc_like( $title ) . '%' ),
					mb_substr( $sql['where'], 5, mb_strlen( $sql['where'] ) )
				);
				return $sql;
			});
		}
	}


	public function displayProducts(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) && isset( $_REQUEST['searchproduct'] ) && !empty( $_REQUEST['searchproduct'] ) ){
		
			$product = sanitize_text_field( $_REQUEST['searchproduct'] );	
			
			$args = array(
				'post_type'      => array( 'crmerpbs_products' ),
				'posts_per_page' => -1,
				'post_status'		 => 'publish',
				'_meta_or_title' => $product,
				'meta_query' => array(
					'relation' => 'OR',
					array(
					   'key'     => '_sku',
					   'value'   => $product,
					   'compare' => 'LIKE'
					),				
					array(
					   'key'     => "crmerpbs_sku",
					   'value'   => $product,
					   'compare' => 'LIKE'
					),					
				),			
			);
			
			$loop = new WP_Query( $args );
			
			while ( $loop->have_posts() ) : $loop->the_post();
			
				global $post;
				
				$id = (int)get_the_ID();
				$price = sanitize_text_field( get_post_meta( get_the_ID(), 'crmerpbs_price', true ) );
				$stock = sanitize_text_field( get_post_meta( get_the_ID(), 'crmerpbs_quantity', true ) );	
				$sku = sanitize_text_field( get_post_meta( get_the_ID(), 'crmerpbs_sku', true ) );
				$title = sanitize_title( get_the_title() );
				
				$option = "<option stock='".esc_attr( $stock )."' sku = '".esc_attr( $sku )."'  price='".esc_attr( $price )."' value='".(int)$id ."'>".esc_attr( $title )."</option>";
				if( has_filter( 'crmerpbs_product_select_list' ) ) {
					$option = apply_filters( 'crmerpbs_product_select_list', (int)$id );
				}
				print $option;
						
			endwhile;

			wp_reset_query();
		
		}
	
	}


	public function displaySoldProducts(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' )  ){
			
			$price = sanitize_text_field( get_post_meta( get_the_ID(), 'crmerpbs_price', true ) );
			$stock = sanitize_text_field( get_post_meta( get_the_ID(), 'crmerpbs_quantity', true ) );	
			
			global $wpdb;
			$result = $wpdb->get_results( "SELECT DISTINCT product_id FROM ".$wpdb->prefix."crmerpbs_transaction_items  " );
			if( $result ){
				foreach( $result as $res ) {
					
					$sku = sanitize_text_field( get_post_meta( $res->product_id, "crmerpbs_sku", true ) );
					if( has_filter( 'crmerpbs_get_sku' ) ) {
						$sku = apply_filters( "crmerpbs_get_sku", (int)$res->product_id );	
					}
					echo  "<option  sku = '".esc_attr( $sku )."' value='". (int)$res->product_id ."'>". esc_html( get_the_title( (int)$res->product_id ) )."</option>";
					
				
				}
			}
			
			do_action( "crmerpbs_query_sold_products" );

		}
	}


	public function displaySoldProductsTransactions(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ){
			
			global $wpdb;
			$result = $wpdb->get_results( "SELECT DISTINCT product_id FROM ".$wpdb->prefix."crmerpbs_transaction_items  " );
			
			if( $result ){
				foreach( $result as $res ) {
					
					$sku = sanitize_text_field( get_post_meta( $res->product_id, 'crmerpbs_sku', true ) );
					if( has_filter( 'crmerpbs_get_sku' ) ) {
						$sku = apply_filters( "crmerpbs_get_sku", (int)$res->product_id );
					}
					echo "<option  sku = '".esc_attr( $sku )."' value='".esc_attr( $res->product_id )."'>". esc_html( get_the_title( (int)$res->product_id ) ) ."</option>";
				}
			}
		
		}
	
	}
	
}

$CrmErpSolutionProducts = CrmErpSolutionProducts::get_instance();