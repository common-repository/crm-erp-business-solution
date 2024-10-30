<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if ( !class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	
}

class CrmErpSolutionTransactions extends WP_List_Table {


    public function __construct(){
        global $status, $page;

        parent::__construct( array(
            'singular' => 'transaction',
            'plural' => 'transactions',
        ));
    }
	
	
    public function column_default( $item, $column_name ){
        return $item[$column_name];
    }

	
    public function column_name( $item ){
		
			$nonce = wp_create_nonce( 'crmerpbs_trans_nonce' );
			$tab = sanitize_text_field( $_REQUEST['tab'] );
			$page = sanitize_text_field( $_REQUEST['page'] );
			
			if ( isset( $_REQUEST['tab'] ) &&  $_REQUEST['tab'] == 'offers' ){
				$actions = array(
				'view' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=view&id=%s&_wpnonce=%s" ) ) .'" target="_blank">%s</a>', esc_html( $tab ), (int)$item['id'],$nonce, esc_html__( 'View', 'crm-erp-business-solution' ) ),
				'edit' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=edit&id=%s&user=%s&_wpnonce=%s" ) ) .'" target="_blank">%s</a>', esc_html( $tab ), (int)$item['id'],(int)$item['user'], $nonce, esc_html__( 'Edit', 'crm-erp-business-solution' ) ),
				'pdf' => sprintf( '<a  class="viewpdf" href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=redirect&do=pdf&id=%s&_wpnonce=%s" ) ) .'"  target="_blank">%s</a>', esc_html( $tab ), (int)$item['id'],$nonce, esc_html__( 'View PDF', 'crm-erp-business-solution' ) ),
				'send' => sprintf( '<a class="sendpdf" href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=redirect&do=send&id=%s&_wpnonce=%s" ) ) .'">%s</a>', esc_html( $tab ), (int)$item['id'],$nonce, esc_html__('Send by Email', 'crm-erp-business-solution' ) ),
				'invoice' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=invoice&id=%s&_wpnonce=%s" ) ) .'">%s</a>', esc_html( $tab ), (int)$item['id'],$nonce, esc_html__('Turn to Invoice', 'crm-erp-business-solution' ) ),
				'delete' => sprintf( '<a href="'. esc_url( admin_url( "?page=%s&tab=%s&action=delete&id=%s&_wpnonce=%s" ) ) .'">%s</a>',esc_html( $page ), esc_html( $tab ),  (int)$item['id'],$nonce, esc_html__('Delete', 'crm-erp-business-solution' ) ),
				);	
			}elseif( isset($_REQUEST['tab']) &&  $_REQUEST['tab'] =='sales' ){
				$actions = array(
				'view' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=view&id=%s&_wpnonce=%s"  ) ) .'" target="_blank">%s</a>', esc_html( $tab ), (int)$item['id'],$nonce, esc_html__( 'View', 'crm-erp-business-solution' ) ),
				'edit' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=edit&id=%s&user=%s&_wpnonce=%s" ) ) .'" target="_blank">%s</a>', esc_html( $tab ), (int)$item['id'],(int)$item['user'],$nonce, esc_html__( 'Edit', 'crm-erp-business-solution' ) ),
				'pdf' => sprintf( '<a  class="viewpdf" href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=redirect&do=pdf&id=%s&_wpnonce=%s" ) ) .'" target="_blank">%s</a>', esc_html( $tab ),$item['id'],$nonce, esc_html__( 'View PDF', 'crm-erp-business-solution' ) ),
				'send' => sprintf( '<a class="sendpdf" href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=redirect&do=send&id=%s&_wpnonce=%s" ) ) .'">%s</a>' , esc_html( $tab ), (int)$item['id'],$nonce, esc_html__('Send by Email', 'crm-erp-business-solution' ) ),
				'delete' => sprintf( '<a href="'. esc_url( admin_url( "?page=%s&tab=%s&action=delete&id=%s&_wpnonce=%s" ) ) .'">%s</a>',esc_html( $page ), esc_html( $tab ),  (int)$item['id'],$nonce, esc_html__( 'Delete', 'crm-erp-business-solution' ) ),
				);				
			}else{
				$actions = array(
				'view' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=view&id=%s&_wpnonce=%s" ) ) .'" target="_blank">%s</a>', esc_html( $tab ), (int)$item['id'],$nonce, esc_html__( 'View', 'crm-erp-business-solution' ) ),
				'edit' => sprintf( '<a href="'. esc_url( admin_url( "?page=crm-erp-business-solution&tab=%s&action=edit&id=%s&user=%s&_wpnonce=%s" ) ) .'" target="_blank">%s</a>', esc_html( $tab ), (int)$item['id'],(int)$item['user'],$nonce, esc_html__( 'Edit', 'crm-erp-business-solution' ) ),
				'delete' => sprintf( '<a href="'. esc_url( admin_url( "?page=%s&tab=%s&action=delete&id=%s&_wpnonce=%s" ) ) .'">%s</a>',esc_html( $page ), esc_html( $tab ),  (int)$item['id'],$nonce, esc_html__( 'Delete', 'crm-erp-business-solution' ) ),				
				);
			}


        return sprintf('%s %s',
            (int)$item['id'],
            $this->row_actions( $actions )
        );
    }
	
	
	
    public function column_cb( $item ){
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }
	
	
    public function get_columns(){
		
		if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){
			
			$columns = array(
				'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
				'id' => esc_html__( 'ID', 'crm-erp-business-solution' ),
				'name' => esc_html__( 'Offer', 'crm-erp-business-solution' ),	
				'creationdate' => esc_html__('Creation Date', 'crm-erp-business-solution' ),
				'duedate' => esc_html__( 'Due Date', 'crm-erp-business-solution' ),
				'status' => esc_html__( 'Status', 'crm-erp-business-solution' ),			
				'username' => esc_html__( 'User', 'crm-erp-business-solution' ),
				'discount' => esc_html__( 'Discount', 'crm-erp-business-solution' ),
				'total' => esc_html__( 'Total', 'crm-erp-business-solution' ),
				'tax' => esc_html__( 'Tax', 'crm-erp-business-solution' ),
				'grandtotal' => esc_html__( 'Total', 'crm-erp-business-solution' ),	
			);
		}elseif (isset($_REQUEST['tab']) && $_REQUEST['tab'] =='sales' ){
			
			$columns = array(
				'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
				'id' => esc_html__( 'ID', 'crm-erp-business-solution' ),
				'name' => esc_html__( 'Sale', 'crm-erp-business-solution' ),
				'creationdate' => esc_html__( 'Creation Date', 'crm-erp-business-solution' ),
				'duedate' => esc_html__( 'Due Date', 'crm-erp-business-solution' ),
				'paydate' => esc_html__( 'Payment Date', 'crm-erp-business-solution' ),
				'status' => esc_html__( 'Status', 'crm-erp-business-solution' ),			
				'username' => esc_html__( 'Customer', 'crm-erp-business-solution' ),
				'discount' => esc_html__( 'Discount', 'crm-erp-business-solution' ),
				'total' => esc_html__( 'Sub Total', 'crm-erp-business-solution' ),
				'tax' => esc_html__( 'Tax', 'crm-erp-business-solution' ),
				'grandtotal' => esc_html__( 'Total', 'crm-erp-business-solution' ),				
				'paid' => esc_html__( 'Paid', 'crm-erp-business-solution' ),
				'balance' => esc_html__( 'Balance', 'crm-erp-business-solution' ),
				'payment_method' => esc_html__( 'Payment Method', 'crm-erp-business-solution' ),
			);			
		}else{
			$columns = array(
			
				'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
				'id' => esc_html__( 'ID', 'crm-erp-business-solution' ),
				'name' => esc_html__( 'Transaction', 'crm-erp-business-solution' ),
				'creationdate' => esc_html__( 'Creation Date', 'crm-erp-business-solution' ),
				'duedate' => esc_html__( 'Due Date', 'crm-erp-business-solution' ),
				'paydate' => esc_html__( 'Payment Date', 'crm-erp-business-solution' ),
				'status' => esc_html__( 'Status', 'crm-erp-business-solution' ),			
				'username' => esc_html__( 'Vendor', 'crm-erp-business-solution' ),
				'discount' => esc_html__( 'Discount', 'crm-erp-business-solution' ),
				'total' => esc_html__( 'Sub Total', 'crm-erp-business-solution' ),
				'tax' => esc_html__( 'Tax', 'crm-erp-business-solution' ),
				'grandtotal' => esc_html__( 'Total', 'crm-erp-business-solution' ),					
				'paid' => esc_html__( 'Paid', 'crm-erp-business-solution' ),
				'balance' => esc_html__( 'Balance', 'crm-erp-business-solution' ),
				'payment_method' => esc_html__( 'Payment Method', 'crm-erp-business-solution' ),
										
			);			
		}

        return $columns;
    }


    public function get_sortable_columns(){
		
        $sortable_columns = array(
			'type' => array( 'type', true ),
			'parent' => array( 'parent', true ),
			'duedate' => array( 'duedate', true ),
			'paydate' => array( 'paydate', true ),
			'status' => array( 'status', true ),
            'username' => array( 'username', false ),
            'discount' => array( 'discount', false ),
			'total' => array( 'total', false ),
			'grandtotal' => array( 'grandtotal', false ),
			'payment_method' => array( 'payment_method', false ),
        );
        return $sortable_columns;
    }



    public function get_bulk_actions(){	
	
		if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){
			$actions = array(
				'invoice' => esc_html__( 'Turn to Invoice', 'crm-erp-business-solution' ),			
				'delete' =>  esc_html__( 'Delete', 'crm-erp-business-solution' ),	
			);			
		}else{
			$actions = array(
				'delete' => esc_html__( 'Delete', 'crm-erp-business-solution' ),
			);				
		}

        return $actions;
    }


    public function process_bulk_action(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ){
			
			global $wpdb;
			$table_name = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix
			$table_items = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' ); // do not forget about tables prefix
			

			if ( 'delete' === $this->current_action() ) {
				

				if ( isset( $_REQUEST['id'] ) && !empty( $_REQUEST['id'] ) ) {
					
					if( is_array( $_REQUEST['id'] ) ) {
						
						$ids = array_map( 'intval', $_REQUEST['id'] );
						$idsToprint = implode( ',', array_map( 'intval', $ids ) );
						
						foreach( $ids as $id ){	
							$id = (int)$id;
							$wpdb->delete( $table_name, array( 'id' => $id ), array( '%d' ) );
							$wpdb->delete( $table_name, array( 'parent' => $id ), array( '%d' ) );
							$wpdb->delete( $table_items, array( 'trans_id' => $id ), array( '%d' ) );						
						}
						
						$message = '<div class="updated below-h2 is-dismissible" id="message"  ><p>' . esc_html__( ' Transactions with IDs ', 'crm-erp-business-solution' ) . esc_html( $idsToprint ) . esc_html__( '  deleted', 'crm-erp-business-solution' ) . '</p></div>';
						if( isset( $message ) ) print wp_kses( $message, CrmErpSolution::get_instance()->allowed_html );
						
					}else{
						$id = (int) $_REQUEST['id'];
						$wpdb->delete( $table_name, array( 'id' => $id ), array( '%d' ) );
						$wpdb->delete( $table_name, array( 'parent' => $id ), array( '%d' ) );
						$wpdb->delete( $table_items, array( 'trans_id' => $id ), array( '%d' ) );
						
						$message = '<div class="updated below-h2 is-dismissible" id="message"  ><p>' . esc_html__( ' Transaction with ID ', 'crm-erp-business-solution' ) . esc_html( $id ) . esc_html__( '  deleted', 'crm-erp-business-solution' ) . '</p></div>';
						if( isset( $message ) ) print wp_kses( $message, CrmErpSolution::get_instance()->allowed_html );						

					
					}
					
					
				}
			
							
			}	

			if ( 'invoice' === $this->current_action() ) {
								
				
				if ( isset( $_REQUEST['id'] ) && !empty( $_REQUEST['id'] ) ) {

					$type = 'saleinvoice';
					$initial = 'offer';
					$status = 'pending';
						
					if( is_array( $_REQUEST['id'] ) ) {
						
						$ids = array_map( 'intval', $_REQUEST['id'] );
						$idsToprint = implode( ',', array_map( 'intval', $ids ) );
						
						foreach( $ids as $id ){	
						
							$id = (int)$id;
							$wpdb->update( $table_name, array( 'type' => $type, 'initialtype' => $initial, 'status' => $status ), array( 'id' => $id ) ,array( '%s','%s','%s' ), array( '%d' ) );						
						}
						
						$message = '<div class="updated below-h2 is-dismissible" id="message"  ><p>' . esc_html__( ' Offers with IDs ', 'crm-erp-business-solution' ) . esc_html( $idsToprint ) . esc_html__( '  turned to invoice', 'crm-erp-business-solution' ) . '</p></div>';
						if( isset( $message ) ) print wp_kses( $message, CrmErpSolution::get_instance()->allowed_html );
						
					}else{
						$id = (int) $_REQUEST['id'];

						$wpdb->update( $table_name, array( 'type' => $type, 'initialtype' => $initial, 'status' => $status ), array( 'id' => $id ) ,array( '%s','%s','%s' ), array( '%d' ) );
						
						$message = '<div class="updated below-h2 is-dismissible" id="message"  ><p>' . esc_html__( ' Offer with ID ', 'crm-erp-business-solution' ) . esc_html( $id ) . esc_html__( '  turned to invoice', 'crm-erp-business-solution' ) . '</p></div>';
						if( isset( $message ) ) print wp_kses( $message, CrmErpSolution::get_instance()->allowed_html );						

					
					}
										
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

				   $nonce = wp_create_nonce( 'crmerpbs_trans_nonce' );
		
                   if ( 'cb' == $column_name ) {
					   echo  "<th  class='check-column' scope='row'>";
					   echo sprintf( '<input type="checkbox" name="id[]" value="%s" />', (int)$item['id'] );	
					   echo "</th>";


				   }elseif ( 'username' == $column_name ) {
					   
					   echo "<td ". esc_attr( $attributes ) ." >";
					   
						$userR = get_user_by( "id", (int)$item['user'] );
						
						if( $userR ){
						$tab = '';
						if ( in_array( 'crm_customer', (array) $userR->roles ) ) {
							$tab = 'customers';
						}elseif ( in_array( 'crm_vendor', (array) $userR->roles ) ) {
							$tab = 'vendors';
						}
						if( has_filter( "crmerpbs_get_user_role_by_id_for_usrtab" ) ){
							$tab = apply_filters( "crmerpbs_get_user_role_by_id_for_usrtab", (int)$item['user'] ); 
						}			

						   echo '<span>', "<a href='".esc_url( admin_url("?page=crm-erp-business-solution&tab=". esc_html( $tab ) ."&action=view&id=". (int)$item['user'] ) )."' target='_blank'>". esc_html( $userR->first_name. " " . $userR->last_name )."</a>";
						   echo "</span>";	
						   
						}else print esc_html__( "User with ID: ", 'crm-erp-business-solution' ). (int)$item['user'] . esc_html__( " do not exist", 'crm-erp-business-solution' );					
					
				   }elseif( 'id' == $column_name ){
						echo "<td ". esc_attr( $attributes ) .">";
						echo $this->column_name( $item );
						echo "</td>";	
						
				   }elseif( 'discount' == $column_name || 'total' == $column_name || 'tax' == $column_name  || 'paid' == $column_name || 'grandtotal' == $column_name || 'balance' == $column_name ){
						echo "<td ". esc_attr( $attributes ) .">";
						echo  esc_html( crm_price( $item[ $column_name ] ) );
						echo "</td>";						
										
                   }else {
						echo "<td ". esc_attr( $attributes ) .">";
						echo $this->column_default( $item, $column_name );
						echo "</td>";
					} 
			} 
	}
	
    public function prepare_items(){
		
        global $wpdb;
				
        $per_page = 50; // constant, how much records will be shown per page
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array( $columns, $hidden, $sortable );

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();
				
        // will be used in pagination settings
		if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){
			$type = 'offer';
			$total_items = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(id) FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE type=%s or initialtype=%s ", $type, $type ) );
			
		}elseif ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){
			
			$total_items = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(id) FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE type=%s  ", 'saleinvoice' ) );
			
		}elseif (isset($_REQUEST['tab']) && $_REQUEST['tab'] == 'payments' ){
			
			$total_items = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(id) FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE type=%s  ", 'payinvoice' ) );
			
		}
        // prepare query params, as usual current page, order by and order direction
        $paged = isset( $_REQUEST['paged'] ) ? ( $per_page * max( 0, intval( $_REQUEST['paged'] ) - 1 ) ) : 0;
        $orderby = ( isset( $_REQUEST['orderby'] ) && in_array( $_REQUEST['orderby'], array_keys( $this->get_sortable_columns() ) ) ) ? sanitize_text_field( $_REQUEST['orderby'] ) : 'id';
        $order = ( isset( $_REQUEST['order'] ) && in_array( $_REQUEST['order'], array( 'asc', 'desc' ) ) ) ? sanitize_text_field( $_REQUEST['order'] ) : 'DESC';

		$parameters = array();
		if( !empty( $_REQUEST['status'] ) ){
				$status = sanitize_text_field( $_REQUEST['status'] );
		}else $status = '';	
		
		if( !empty( $_REQUEST['from'] ) ){
				$fromDate = date( 'Y-m-d', strtotime( $_REQUEST['from'] ) );
		}else $fromDate = '';
		
		if( !empty( $_REQUEST['to'] ) ){
			$toDate = date( 'Y-m-d', strtotime( $_REQUEST['to'] ) );
		}else $toDate = '';	

		if( !empty( $_REQUEST['user'] ) ){
			$user = sanitize_text_field( $_REQUEST['user'] );
		}else $user ='';
		
		
		
		$status = '%' . $wpdb->esc_like( $status ) . '%';
		array_push( $parameters, $status );

		if( !empty( $fromDate ) ){
			array_push( $parameters, $fromDate );
		}	
		if( !empty( $toDate ) ){
			array_push( $parameters, $toDate );
		}

		$user = '%' . $wpdb->esc_like( $user ) . '%';
		array_push( $parameters, $user );
		
			
		
		if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){
			
			$type = 'offer';
			array_push( $parameters, $type, $type );
			array_push( $parameters, $orderby, $order, $per_page, $paged );
			
			if( !empty( $fromDate ) && !empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )."   WHERE status LIKE %s  ( creationdate >=%s AND creationdate <=%s ) AND user LIKE %s AND ( type=%s || initialtype=%s ) ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );				
			}elseif( !empty( $fromDate ) && empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )."   WHERE status LIKE %s AND creationdate >=%s  AND user LIKE %s AND ( type=%s || initialtype=%s )  ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );				
			}elseif( empty( $fromDate ) && !empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE status LIKE %s AND creationdate <=%s AND user LIKE %s AND ( type=%s || initialtype=%s )  ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );										
			}else{
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )."  WHERE status LIKE %s AND user LIKE %s  AND ( type=%s || initialtype=%s )  ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );	
			}
			
		}elseif ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){
			
			array_push( $parameters, 'saleinvoice' );
			array_push( $parameters, $orderby, $order, $per_page, $paged );
			
			if( !empty( $fromDate ) && !empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )."  WHERE status LIKE %s AND ( creationdate >=%s AND creationdate <=%s ) AND user LIKE %s AND ( type =%s ) ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );				
			}elseif( !empty( $fromDate ) && empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )."  WHERE status LIKE %s AND creationdate >=%s  AND user LIKE %s AND ( type =%s ) ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );				
			}elseif( empty( $fromDate ) && !empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )."  WHERE  status LIKE %s AND creationdate <=%s AND user LIKE %s AND ( type =%s ) ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );										
			}else{
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )."  WHERE  status LIKE %s AND user LIKE %s AND ( type =%s ) ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );	
			}

		}elseif (isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'payments' ){
			
			array_push( $parameters, 'payinvoice' );
			array_push( $parameters, $orderby, $order, $per_page, $paged );
			
			if( !empty( $fromDate ) && !empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )."  WHERE ( type =%s )  AND status LIKE %s AND ( creationdate >=%s AND creationdate <=%s ) AND user LIKE %s ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );				
			}elseif( !empty( $fromDate ) && empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE ( type =%s )  AND status LIKE %s AND creationdate >=%s  AND user LIKE %s ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );				
			}elseif( empty( $fromDate ) && !empty( $toDate ) ){
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE ( type =%s )  AND status LIKE %s AND creationdate <=%s AND user LIKE %s ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );										
			}else{
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE ( type =%s ) AND status LIKE %s AND user LIKE %s ORDER BY %s %s LIMIT %d OFFSET %d ", $parameters ), ARRAY_A );	
			}
			
		}else $this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." ORDER BY %s %s LIMIT %d OFFSET %d", $orderby, $order, $per_page, $paged ), ARRAY_A );		
		
		
        $this->set_pagination_args( array(
            'total_items' => (int)$total_items, // total items defined above
            'per_page' => (int)$per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));		
		
    }

}


class CRMTransactions{


	public $table_db_version = '1';


    protected static $instance = NULL;

    public static function get_instance(){
		
        if ( NULL == self::$instance )
            self::$instance = new self;

        return self::$instance;
    }
	
	public function __construct() {	
		add_action( 'admin_menu', array( $this,'menu_page' ) );		
		register_activation_hook(__FILE__, array( $this,'tableInstall' ) );
		add_action('plugins_loaded', array( $this,'tableCheck' ) );
	}

	
	public function menu_page(){
		
	   add_submenu_page( "crm-erp-business-solution" , esc_html__( "Sales", 'crm-erp-business-solution' ),  esc_html__( "Sales", 'crm-erp-business-solution' ) , 'crm-erp-business-solution','crm-erp-business-solution&tab=sales', esc_url( admin_url( 'page=crm-erp-business-solution&tab=sales' ) ) );
	   add_submenu_page( "crm-erp-business-solution" , esc_html__( "Payments", 'crm-erp-business-solution' ),  esc_html__( "Payments", 'crm-erp-business-solution' ) , 'crm-erp-business-solution','crm-erp-business-solution&tab=payments', esc_url( admin_url( 'page=crm-erp-business-solution&tab=payments' ) ) );
	   add_submenu_page( "crm-erp-business-solution" , esc_html__( "Offers", 'crm-erp-business-solution' ),  esc_html__( "Offers", 'crm-erp-business-solution' ) , 'crm-erp-business-solution','crm-erp-business-solution&tab=offers', esc_url( admin_url( 'page=crm-erp-business-solution&tab=offers' ) ) );
		  
	}


	public function tableInstall(){
		
		global $wpdb;

		$table_name = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix

		$sql = "CREATE TABLE " . $table_name . " (
				id INT NOT NULL AUTO_INCREMENT, 
				PRIMARY KEY  (id),
				name tinytext NOT NULL,
				creationdate DATETIME NULL,
				duedate DATE NULL,
				paydate DATETIME NULL,
				KEY duedate (duedate) ,
				status VARCHAR(20) NULL,
				type VARCHAR(20) NULL, 
				initialtype VARCHAR(20) NULL,
				KEY type (type),
				parent INT(15) NULL,
				user INT(50) NULL,
				KEY user (user),
				description MEDIUMTEXT NOT NULL,
				username VARCHAR(200) NULL,
				discount DECIMAL(5,2) NULL,
				total DECIMAL(5,2) NOT NULL,
				tax DECIMAL(5,2) NULL,
				grandtotal DECIMAL(5,2) NULL,
				paid DECIMAL(5,2) NULL,
				balance DECIMAL(5,2) NULL,
				payment_method VARCHAR(20) NULL,
				document BOOLEAN,
				document_type VARCHAR(20) NULL
		);";

		$tr_items_table = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' ) ; // do not forget about tables prefix
		$sql2 = "CREATE TABLE " . $tr_items_table . " (
			id INT NOT NULL AUTO_INCREMENT, 
			PRIMARY KEY  (id),
			creationdate DATETIME NULL,
			paydate DATE NULL,
			KEY paydate (paydate),
			trans_id INT(50),
			product_id INT(50) NULL,
			quantity INT(50) NULL,
			discount DECIMAL(5,2) NULL,		
			amount DECIMAL(5,2) NULL,
			total DECIMAL(5,2) NULL
		);";	

		// we do not execute sql directly
		// we are calling dbDelta which cant migrate database
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		dbDelta( $sql2 );

		// save current database version for later use (on upgrade)
		add_option( 'crmerpbs_transactions_table_db_version', sanitize_text_field( $this->table_db_version ) );

		/**
		*  new version of table
		*/
		$installed_ver = get_option( 'crmerpbs_transactions_table_db_version' );
		if ( $installed_ver != $this->table_db_version ) {
			$sql = "CREATE TABLE " . $table_name . " (
				id INT NOT NULL AUTO_INCREMENT, 
				PRIMARY KEY  (id),
				name tinytext NOT NULL,
				creationdate DATETIME NULL,
				duedate DATE NULL,
				paydate DATETIME NULL,
				KEY duedate (duedate) ,
				status VARCHAR(20) NULL,
				type VARCHAR(20) NULL,
				initialtype VARCHAR(20) NULL,
				KEY type (type),
				parent INT(15) NULL,
				user INT(50) NULL,
				KEY user (user),
				description MEDIUMTEXT NOT NULL,
				username VARCHAR(200) NULL,
				discount DECIMAL(5,2) NULL,
				total DECIMAL(5,2) NOT NULL,
				tax DECIMAL(5,2) NULL,
				grandtotal DECIMAL(5,2) NULL,
				paid DECIMAL(5,2) NULL,
				balance DECIMAL(5,2) NULL,
				payment_method VARCHAR(20) NULL,
				document BOOLEAN,
				document_type VARCHAR(20) NULL
				
			);";
			$sql2 = "CREATE TABLE " . $tr_items_table . " (
			id INT NOT NULL AUTO_INCREMENT, 
			PRIMARY KEY  (id),
			creationdate DATETIME NULL,
			paydate DATE NULL,
			KEY paydate (paydate),
			trans_id INT(50),
			product_id INT(50) NULL,
			quantity INT(50) NULL,
			discount DECIMAL(5,2) NULL,		
			amount DECIMAL(5,2) NULL,
			total DECIMAL(5,2) NULL
			);";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
			dbDelta( $sql2 );
			
			// notice that we are updating option, rather than adding it
			update_option( 'crmerpbs_transactions_table_db_version', sanitize_text_field( $this->table_db_version ) );
		}
	}


	public function tableCheck(){
		
		if ( get_site_option( 'crmerpbs_transactions_table_db_version' ) != $this->table_db_version ) {
			$this->tableInstall();
		}
	}


	public function listView(){
		
		global $wpdb;

		$transactions = new CrmErpSolutionTransactions();
		$transactions->prepare_items();
		
		$message = '';
		
		?>
		<div class="wrap">
			
			<!--ABOVE TABLE-->
			
			<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
			<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){ ?>
				
				<h2>
					<?php if( isset( $_REQUEST['user'] ) && !empty( $_REQUEST['user'] ) ){ ?>
					
						<?php esc_html_e( 'Offers List to ', 'crm-erp-business-solution' ); 
						
						$user = get_user_by('id' , (int)$_REQUEST['user'] );
						
						if( $user ) print esc_html( $user->first_name . " " . $user->last_name );
						
					}else{ ?>
						<?php esc_html_e( 'Offers List to Customers / Vendors', 'crm-erp-business-solution' )?> 
					<?php } ?>				
				
					<a class="add-new-h2 button-primary" href="<?php echo esc_url( admin_url(  'admin.php?page=crm-erp-business-solution&tab=offers&action=new' ) );?>"><?php esc_html_e( 'Add new', 'crm-erp-business-solution' )?> <i class='fa fa-plus'></i></a>
				</h2>
			<?php }elseif ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
			
				<h2>
					<?php if( isset( $_REQUEST['user'] ) &&  !empty( $_REQUEST['user'] ) && $_POST['action'] != 'delete' ){ ?>
						
						<?php esc_html_e( 'Offline Sales to ', 'crm-erp-business-solution' ); 
						
						$user = get_user_by('id' ,(int)$_REQUEST['user'] );
						if( $user ) print esc_html( $user->first_name . " " . $user->last_name );
						
					}else{ ?>
						<?php esc_html_e( 'Offline Sales to Customers', 'crm-erp-business-solution' ); ?> 
					<?php } ?>
				<br/> 
					<?php if( (int)CrmErpSolutionReports::get_instance()->displayTotalEarned() > 0 ){ ?>
						<?php esc_html_e( 'Total paid: ', 'crm-erp-business-solution' )?><span  style='color:green'><?php print esc_html( crm_price( CrmErpSolutionReports::get_instance()->displayTotalEarned() ) ) ; ?></span>				
					<?php } ?>
					<?php if( (int)CrmErpSolutionReports::get_instance()->displayTotalDueEarn() > 0 ){ ?>
						<?php esc_html_e( '- To get paid: ', 'crm-erp-business-solution' )?><span  style='color:red'><?php print esc_html( crm_price( CrmErpSolutionReports::get_instance()->displayTotalDueEarn() ) ) ; ?></span>
					<?php } ?>
					 <br/><br/>	
					<a class="add-new-h2 button-primary" href="<?php echo esc_url( admin_url(  'admin.php?page=crm-erp-business-solution&tab=sales&action=new' ) );?>"><?php esc_html_e('Add new', 'crm-erp-business-solution' )?> <i class='fa fa-plus'></i></a>
				</h2>		
			<?php }else { ?>
				<h2>
				
					<?php if( isset( $_REQUEST['user'] ) && $_POST['action'] != 'delete' ){ ?>
						<?php esc_html_e( 'Payments to ', 'crm-erp-business-solution' )?>
						<?php 
						$user = get_user_by('id' ,(int)$_REQUEST['user'] );
						if( $user ) print esc_html( $user->first_name . " " . $user->last_name );
						
					}else{ ?>
						<?php esc_html_e( 'Payments to Vendors ', 'crm-erp-business-solution' )?> 
					<?php } ?>

				<br/>
					<?php if( (int)CrmErpSolutionReports::get_instance()->displayTotalPaid() >0 ){ ?>
						<?php esc_html_e( 'Total paid: ', 'crm-erp-business-solution' )?><span  style='color:green'><?php print esc_html( crm_price( CrmErpSolutionReports::get_instance()->displayTotalPaid() ) ) ; ?></span>					
					<?php } ?>
					<?php if( (int)CrmErpSolutionReports::get_instance()->displayTotalPay() >0 ){ ?>
						<?php esc_html_e( '- To pay: ', 'crm-erp-business-solution' )?><span  style='color:red'><?php print esc_html( crm_price( CrmErpSolutionReports::get_instance()->displayTotalPay() ) ); ?></span>
					<?php } ?>					
					<br/>	<br/>		
					<a class="add-new-h2 button-primary" href="<?php echo esc_url( admin_url( '?page=crm-erp-business-solution&tab=payments&action=new' ) );?>"><?php esc_html_e( 'Add new', 'crm-erp-business-solution' )?> <i class='fa fa-plus'></i></a>
				</h2>	
			<?php } ?>
							

			<form id="transactions-table" method="post" class='ajaxify' >
				
				<div class="filtersList">
					<?php $users = new CRMUsers(); ?>
					<select id='user' name='user' class="code">
						<option><?php print esc_html__( "Search By User", 'crm-erp-business-solution' ); ?></option>
						
						<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
							<?php if( method_exists( 'CRMUsers','query_customers' ) ){ ?>
								<?php $users->query_customers(); ?>
							<?php } ?>
						<?php }elseif ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){ ?>
							<?php if( method_exists( 'CRMUsers','query_users' ) ){ ?>
								<?php $users->query_customers(); ?>
							<?php } ?>	
							<?php if( method_exists( 'CRMUsers','query_vendors' ) ){ ?>
								<?php $users->query_vendors(); ?>
							<?php } ?>						
						<?php }else{ ?>
							<?php if( method_exists( 'CRMUsers','query_vendors' ) ){ ?>
								<?php $users->query_vendors(); ?>
							<?php } ?>				
						<?php } ?>
					</select>

					<input id="from" name="from" type="text" style="width: 45%" class="datepicker"  size="10" class="code" placeholder="<?php esc_html_e( 'From date', 'crm-erp-business-solution' )?>" >

					<input id="to" name="to" type="text" style="width: 45%" class="datepicker"  size="10" class="code" placeholder="<?php esc_html_e( 'To date', 'crm-erp-business-solution' )?>" >
						
					<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] != 'offers' ){ ?>
					
						<select id="status" name="status" type="text" style="width: 45%">
							<option value='' ><?php esc_html_e( 'Select Status...', 'crm-erp-business-solution' )?></option>
							<option value='paid' ><?php esc_html_e( 'Paid', 'crm-erp-business-solution' )?></option>
							<option value='pending' ><?php esc_html_e( 'Pending', 'crm-erp-business-solution' )?></option>						
						</select>
						
					<?php } 
						$page = sanitize_text_field( $_REQUEST['page'] );
					?>
					<input type="hidden" name="page" value="<?php echo esc_attr( $page ) ?>"/>
				</div>
				<?php $transactions->display() ?>
			</form>
			
			<!--BELOW TABLE-->

		</div>
		<?php
	}

	public function getUsername( $id ){

		$user = get_user_by( 'id', (int)$id );
		if( $user ) return sanitize_text_field( $user->user_login );	
	}
	
	public function addNew(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) ) { 
		
			global $wpdb;
			$table_name = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' ); // do not forget about tables prefix	

			$message = '';
			$notice = '';

			$current = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
			
			// this is default $item which will be used for new records
			$default = array(
				'id' => 0,
				'status' => '',
				'type' => '',
				'parent' => '',
				'creationdate' => $current,
				'duedate' => '',
				'paydate' => '',
				'description' => '',
				'user' => null,
				'username' => null,
				'discount' => '',
				'total' => null,
				'tax' => null,
				'grandtotal' => null,
				'paid' => null,
				'payment_method' => null,
				'document' => null,
				'document_type' => null,
				
			);
							
			if ( isset( $_REQUEST['nonce'] ) && wp_verify_nonce( $_REQUEST['nonce'], 'crmerpbs_add_new_trans' ) ) {
				// combine our default item with request params
				$item = shortcode_atts( $default, $_REQUEST );
				// sanitize all
				$item = array_map( 'sanitize_text_field', $item );
				
				// validate data, and if all ok save item to database
				// if id is zero insert otherwise update
				$item_valid = $this->validate( $item );
				if ( $item_valid == true ) {
					
									
					  $transaction_items = sanitize_text_field( $wpdb->prefix . "crmerpbs_transaction_items" ); // table to store products for each transaction
						
					  $products = array();
					  
						if( isset( $_POST['product'] ) ){
							
							if( isset( $_POST['proddiscount'] ) && $_POST['proddiscount'] !='' ){
								$total = sanitize_text_field( $_POST['price'] ) - sanitize_text_field( $_POST['proddiscount'] );
							}else $total = sanitize_text_field( $_POST['price'] );
							
							$prod1 =  array (
								  'product_id' => sanitize_text_field( $_POST['product'] ),
								  'quantity' => sanitize_text_field( $_POST['quantity'] ),
								  'amount' => sanitize_text_field( $_POST['price'] ),
								  'discount' => sanitize_text_field( $_POST['proddiscount'] ),
								  'total' => $total
								);
							$products["product_1"][] = $prod1;	
						}
						
						//create array for more products if plus sign clicked by user to add in transaction
						$i;
						for( $i=0 ; $i <= 160; $i++ ){
							if( isset( $_POST['product'.$i] ) ){
								
								if( isset( $_POST['proddiscount'.$i] ) && $_POST['proddiscount'.$i] !='' ){
									$total = sanitize_text_field( $_POST['price'.$i] ) - sanitize_text_field( $_POST['proddiscount'.$i] );
								}else $total = sanitize_text_field( $_POST['price'.$i] );
												
								$prod[$i] =  array (
									  'product_id' => sanitize_text_field( $_POST['product'.$i] ),
									  'quantity' => sanitize_text_field( $_POST['quantity'.$i] ),
									  'amount' => sanitize_text_field( $_POST['price'.$i] ),
									  'discount' => sanitize_text_field( $_POST['proddiscount'.$i] ),
									  'total' => $total
									);
								$products["product".$i][] = $prod[$i];
							}				
						}
				
				
					
					if ( $item['id'] == 0 ) {
						if( $item['type'] != 'saleinvoice' && $item['type'] != 'payinvoice' ) {
							$item['name'] =  $item['type']. " for ".$item['parent']."  ". date('d-m-Y',strtotime( $current) ). "-: ". $this->getUsername( $item['user'] );
							
							if( $item['type'] != 'offer' ){
								$item['grandtotal'] = $item['total'];
								//$item['paid'] = $item['total'];	new check
								//$item['status'] = 'paid';				new check
								if( $item['type'] == 'salepayment' || $item['type'] == 'paypayment' ) { 
									$item['status'] = 'paid';	
									$item['paid'] = $item['total'];
								}
								
							}else{
								$item['grandtotal'] = $item['total'] + $item['tax'];
							}
								
							if( $item['type'] != 'offer') $item['status'] = 'paid';
							
						}else $item['name'] =  date( 'd-m-Y', strtotime( $current ) ). "-: ". $this->getUsername( (int)$item['user'] );
						$item['username'] = $this->getUsername($item['user']);
						
						if( $item['type'] == 'saleinvoice' || $item['type'] == 'payinvoice' )  $item['status'] = 'pending';	
						if( $item['type'] == 'offer' ) $item['status'] = 'pending';					
						

						$result = $wpdb->insert( $table_name, $item );

						if ( $result ) {
						
						$item['id'] = $wpdb->insert_id;
						
						// NEW TEST || if during transaction we also have payment, insert the payment
						if( $item['paid'] != null ){
							if( $item['type'] == 'saleinvoice' || $item['type'] == 'payinvoice' ) {
								
								if( $item['type'] == 'saleinvoice' ){
									$type = 'salepayment';
								}elseif( $item['type'] == 'payinvoice' ){
									$type = 'paypayment';
								}
								if( !empty( $item['document'] ) && $item['type'] == 'salepayment' ) {
									
								}
								$wpdb->insert( $table_name, array(
								   "creationdate" => $current,
								   "name" =>  date( 'd-m-Y', strtotime( $current ) ). "-: ". sanitize_text_field( $this->getUsername( (int)$item['user'] ) ),
								   "status" => 'paid',
								   "parent" => (int)$item['id'],
								   "type" => sanitize_text_field( $type ),
								   "paid" => sanitize_text_field( $item['paid'] ),
								   "total" => sanitize_text_field( $item['paid'] ),
								   "grandtotal" => sanitize_text_field( $item['paid'] ),
								   "paydate" => sanitize_text_field( $item['paydate'] ),
								   "user" => sanitize_text_field( $item['user'] ),
								   "payment_method" => sanitize_text_field( $item['payment_method'] ),
								   "username" => sanitize_text_field( $this->getUsername( $item['user'] ) ),
								   "document" => 1,
									
								));
							}
						}
						// insert the payment
						

							//add document if selected
							$doc = new CrmErpSolutionDocuments();

							if( !empty( $item['document'] ) && $item['type'] == 'saleinvoice' ) {
								
								if( $item['document_type'] != NULL ) {
									$doc->addDocument( (int)$item['id'], 1 );
								}else {
									$doc->addDocument( (int)$item['id'],0 );
								}
							}
							
							if( !empty( $item['document'] ) && $item['type'] == 'salepayment' ) {
								
								$doc->addDocument( (int)$item['id'], 1 );
														
							}
							
							$item['duedate'] = date('Y-m-d', strtotime($item['duedate']) );
							
							if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] !='offers' ){
							
								if( $item['type'] == 'salepayment' || $item['type'] == 'paypayment' ) {
									
									$item['status'] = 'paid';
									$this->updatePaid( $item['total'], $item['parent'] );					
								}elseif($item['type'] == 'offer'){
									//do nothing
								}else{
									$this->updatePaidInvoice( $item['total'], $item['id'] );
								}
							
							}
							
							if($item['type'] == 'saleinvoice' || $item['type'] == 'payinvoice' || $item['type'] == 'offer' ) {
								
								foreach( $products as $product ){
									foreach($product as $p){				
									  $wpdb->insert( $transaction_items, array(
											'trans_id' => (int)$item['id'],
											'product_id' => (int)$p['product_id'],
											'quantity' => (int)$p['quantity'],
											'amount' => sanitize_text_field( $p['amount'] ),
											'discount' => sanitize_text_field( $p['discount'] ),
											'total' => sanitize_text_field( $p['total'] ),
											),array( '%d','%d','%d','%s','%s','%s' )                    
										);	
										
										if( $item['type'] != 'offer' ){
											
											do_action( "crmerpbs_stockUpdate" , (int)$p['product_id'],(int)$p['quantity'],sanitize_text_field( $item['type']) );
										}
									}
								}

							}					
			
							$message = esc_html__( 'Transaction was successfully saved', 'crm-erp-business-solution' );
							update_option( "crmerpbs_notice", array( 'notice' => $item['id']. esc_html__(" Transaction was successfully saved", 'crm-erp-business-solution' ) , 'type' => 'success', 'dismissible' => 'is-dismissible'  ) );
						} else {
							$notice = esc_html__( 'There was an error while saving Transaction', 'crm-erp-business-solution' );
							update_option( "crmerpbs_notice", array( 'notice' => esc_html__(" There was an error while saving Transaction", 'crm-erp-business-solution' ) , 'type' => 'success', 'dismissible' => 'is-dismissible'  ) );
						}
					
						if( $item['type'] == 'saleinvoice' || $item['type'] == 'salepayment')  $redirect = "sales";
						if( $item['type'] == 'payinvoice'  || $item['type'] == 'paypayment')  $redirect = "payments";
						if( $item['type'] == 'offer' ) $redirect = "offers";
						
						$tab = sanitize_text_field( $_REQUEST['tab'] );
						wp_redirect( admin_url()."/admin.php?page=crm-erp-business-solution&tab=". esc_html( $tab ) ."&action=view&id=".(int)$item['id'] );
						
					} else {
						
						//TRANSACTION UPDATE CASE 
						
						$item['username'] = $this->getUsername( (int)$item['user'] );
						$result = $wpdb->update( $table_name, $item, array('id' => (int)$item['id'] ) );
						
						if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] != 'offers' ){
							
							if( $item['type'] != 'saleinvoice' && $item['type'] != 'payinvoice') {
								$item['paid'] = $item['total'];
								$this->updatePaid( sanitize_text_field( $item['total'] ), (int)$item['parent'] );					
							}else $this->updatePaidInvoice( sanitize_text_field( $item['total'] ), (int)$item['id'] );
						
						}


						$table_items = sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' ); // do not forget about tables prefix
						
						$wpdb->delete( esc_html( $table_items ), array( 'trans_id' => (int)$item['id'] ) );	
						
						if( $item['type'] == 'saleinvoice' || $item['type'] == 'payinvoice' || $item['type'] == 'offer' ) {
							
							foreach( $products as $product ){
								foreach( $product as $p ){

								  $wpdb->insert( $transaction_items, array(
										'trans_id' => (int)$item['id'],
										'product_id' => (int)$p['product_id'],
										'quantity' => (int)$p['quantity'],
										'amount' => sanitize_text_field( $p['amount'] ),
										'discount' => sanitize_text_field( $p['discount'] ),
										'total' => sanitize_text_field(  $p['total'] ),
										),array( '%d','%d','%d','%s','%s','%s' )                    
									);	
									
									if( $item['type'] != 'offer' ){
										do_action( "crmerpbs_stockUpdate" , (int)$p['product_id'], (int)$p['quantity'], sanitize_text_field( $item['type'] ) );
									}
								}
							}

						}					

						
						if ( $result ) {
							$message = esc_html__( 'Transaction was successfully updated', 'crm-erp-business-solution' );
						} else {
							$notice = esc_html__( 'There was an error while updating Transaction', 'crm-erp-business-solution' );
						}

						
					}
				} else {
					// if $item_valid not true it contains error message(s)
					$notice = $item_valid;
				}
			}else {
				// if this is not post back we load item to edit or give new one to create
				$item = $default;
				if ( isset( $_REQUEST['id'] ) ) {
					$item = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ". sanitize_text_field( $table_name )." WHERE id = %d", (int)$_REQUEST['id'] ), ARRAY_A );
					if ( !$item ) {
						$item = $default;
						$notice = esc_html__( 'Transaction not found', 'crm-erp-business-solution' );
					}
				}
			}
		
		}
		?>
		<div class="wrap">
			<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
			
			<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){ ?>
				<h2><?php esc_html_e( 'Offer', 'crm-erp-business-solution' )?> 
					<a class="add-new-h2 " href="<?php echo esc_url( admin_url( '?page=crm-erp-business-solution&tab=offers' ) );?>">
						<i class='fa fa-angle-double-left '></i> <?php esc_html_e( 'back to list', 'crm-erp-business-solution' )?>
					</a>
				</h2>
			<?php }elseif (isset($_REQUEST['tab']) && $_REQUEST['tab'] =='sales' ){ ?>
				<h2><?php esc_html_e( 'Sale Transaction', 'crm-erp-business-solution' )?> 
					<a class="add-new-h2 " href="<?php echo esc_url( admin_url( '?page=crm-erp-business-solution&tab=sales' ) );?>">
						<i class='fa fa-angle-double-left '></i> <?php esc_html_e( 'back to list', 'crm-erp-business-solution' )?>
					</a>
				</h2>		
			<?php }else{ ?>
			
				<h2><?php esc_html_e( 'Payment Transaction', 'crm-erp-business-solution' )?> 
					<a class="add-new-h2 " href="<?php echo esc_url( admin_url( '?admin.php?page=crm-erp-business-solution&tab=payments' ) );?>">
						<i class='fa fa-angle-double-left '></i> <?php esc_html_e( 'back to list', 'crm-erp-business-solution' )?>
					</a>
				</h2>	
			<?php } ?>


			<?php if ( !empty( $notice ) ): ?>
				<div id="notice" class="error is-dismissible"><p><?php echo esc_html( $notice ) ?></p></div>
			<?php endif;?>
			<?php if ( !empty( $message ) ): ?>
				<div id="message" class="updated is-dismissible"><p><?php echo esc_html( $message ) ?></p></div>
			<?php endif;?>


			<form id="form" method="POST">
			
				<input type="hidden" name="nonce" class='ajaxify' value="<?php echo wp_create_nonce( 'crmerpbs_add_new_trans' )?>"/>
				<?php /* NOTICE: here we storing id to determine will be item added or updated */ ?>
				<input type="hidden" name="id" value="<?php echo (int)$item['id'] ?>"/>

				<div class="metabox-holder" id="poststuff">
					<div id="post-body">
						<div id="post-body-content">
							<?php $this->fieldsNew( $item ); ?>
							<input type="submit" value="<?php esc_html_e( 'Save', 'crm-erp-business-solution' )?>" id="submit" class="button-primary" name="submit">
						</div>
					</div>
				</div>
			</form>

		</div>
		<?php
	}
	
	public function fieldsNew( $item ){ 
	
		$item = array_map( 'sanitize_text_field', $item );
		if( isset( $_REQUEST['balance'] ) ) $balance =  sanitize_text_field( $_REQUEST['balance'] );
		if( isset( $_REQUEST['parent'] )  ) $parent =  sanitize_text_field( $_REQUEST['parent'] );
		if( get_option( 'crmerpbs_defaultVat' ) )  $vat =  sanitize_text_field( get_option( 'crmerpbs_defaultVat' ) );
		?>
	
		<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
			<tbody>
			
			<?php if ( !isset( $_GET['parent'] ) ) { ?>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="type"><?php esc_html_e( 'Type of Transaction', 'crm-erp-business-solution' )?></label>
					</th>
					<td>
						<select id='type' name='type' class="code" >
							<?php //if( !empty( $item['type'] ) ) {  ?> <!--<option selected value='<?php //echo esc_attr( $item['type'] )?>'><?php //echo esc_attr( ucfirst( $item['type'] ) )?></option>--> <?php //} ?>
								<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){ ?>
									<option selected value='offer'><?php esc_html_e( "Offer", 'crm-erp-business-solution' ); ?></option>
									
								<?php }elseif ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
									<option value='saleinvoice'><?php esc_html_e( "New", 'crm-erp-business-solution' ); ?></option>
									<option value='salepayment'><?php esc_html_e( "Pay Existing Transaction", 'crm-erp-business-solution' ); ?></option>							
								<?php }else{ ?>
									<option value='payinvoice'><?php esc_html_e( "New", 'crm-erp-business-solution' ); ?></option>
									<option value='paypayment'><?php esc_html_e( "Pay Existing Transaction", 'crm-erp-business-solution' ); ?></option>
								<?php } ?>
						</select>
					</td>
				</tr>	
				
				<tr class="form-field duedateWrap">
					<th valign="top" scope="row">
						<label for="name"><?php esc_html_e( 'Due Date', 'crm-erp-business-solution' )?></label>
					</th>
					<td>
						<input id="duedate" name="duedate" type="text" style="width: 95%" class="datepicker" value="<?php echo esc_attr( $item['duedate'] )?>"
								size="50" class="code" placeholder="<?php esc_html_e( 'Due date', 'crm-erp-business-solution' )?>" >
					</td>
				</tr>
			
			<?php }else{ ?>
					<?php if (isset( $_GET['parent'] ) ){ ?>
						<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
							<input type='hidden' name='type' value='salepayment' />
						<?php }else{ ?>
							<input type='hidden' name='type' value='paypayment' />
						<?php } ?>
					
					<?php } ?>
				<?php } ?>
			
			<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){ ?>
				<tr class="form-field descriptionWrap" >
					<th valign="top" scope="row">
						<label for="type"><?php esc_html_e( 'Some Text', 'crm-erp-business-solution' )?></label>
					</th>
					<td colspan="4">
						<textarea id="description" name="description" placeholder="<?php esc_html_e('Add Some text for your Offer', 'crm-erp-business-solution' )?>"  style="width: 95%" ><?php echo esc_attr( $item['description'] )?></textarea>
					</td>
				</tr>	
			<?php } ?>
			
			<?php if ( !isset( $_GET['parent'] ) ) { ?>
				<tr class="form-field parentWrap" >
					<th valign="top" scope="row">
						<label for="type"><?php esc_html_e( 'Parent Transaction', 'crm-erp-business-solution' )?></label>
					</th>
					<td>
						<select id='parent' name='parent' class="code">
							<option value=''><?php esc_html_e( "Search..", 'crm-erp-business-solution' ); ?></option>
							<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
									<?php $this->getTransactionParent(); ?>
							<?php }else{ ?>
									<?php $this->getTransactionParentPayments(); ?>
							
							<?php } ?>
						</select>
					</td>
				</tr>
			<?php }else{ ?>
				<input type='hidden' id='parent'  name='parent' balance='<?php if( isset( $_REQUEST['balance'] )  ) print esc_attr( $balance ); ?>' value='<?php print esc_attr( $parent ); ?>' />
			<?php } ?>
			
				
		<?php
		
		if( isset( $_GET['user'] ) ) {
			$userR = get_user_by( "id", (int)$_REQUEST['user'] );
			print "<tr class='form-field userWrap'><td>";
			
			$input  = "<input type='hidden' id='user' name='user'  value='".(int)$_REQUEST['user']."' />";
			
			if( has_filter( 'crmerpbs_get_user_for_new_transaction' ) ) {
				$input = apply_filters( "crmerpbs_get_user_for_new_transaction", (int)$_REQUEST['user'] ); 								
			}
			print $input;
			
			print "</td></tr> ";
			
			print "<b>".esc_html__( "for user ", 'crm-erp-business-solution' ). esc_html( $userR->first_name ). " " . esc_html( $userR->last_name ).  "</b>";
		}else{
			
		?>
		
			<tr class="form-field userWrap">
				<th valign="top" scope="row">
					<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
						<label for="type"><?php esc_html_e( 'Customer', 'crm-erp-business-solution' )?></label>
					<?php }elseif (isset($_REQUEST['tab']) && $_REQUEST['tab'] =='offers' ){ ?>
						<label for="type"><?php esc_html_e( 'User', 'crm-erp-business-solution' )?></label>
					<?php }else{ ?>
						<label for="type"><?php esc_html_e( 'Vendor', 'crm-erp-business-solution' )?></label>
					<?php } ?>
				</th>
				<td>
					<select id='user'  required name='user' class="code">
						<option value=''><?php esc_html_e( "Select user: search by name,vat or email", 'crm-erp-business-solution' ); ?></option>
						<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
													
								<?php CRMUsers::get_instance()->query_customers(); ?>
								
						<?php }elseif (isset($_REQUEST['tab']) && $_REQUEST['tab'] == 'offers' ){ ?>
						
								<?php CRMUsers::get_instance()->query_customers(); ?>
								<?php CRMUsers::get_instance()->query_vendors(); ?>
								
						<?php }else{ ?>
						
								<?php CRMUsers::get_instance()->query_vendors(); ?>
								
						<?php } ?>
					</select>
				</td>
			</tr>	
			
		<?php } ?>	

				
				<?php if( isset( $_REQUEST['id'] ) && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'edit' ){
					$this->getTransactionProducts( (int)$_REQUEST['id'] );
				}else{ ?>
				
				<tr class="form-field prodWrap">
				<th valign="top" scope="row">
					<label for="type"><?php esc_html_e( 'Product', 'crm-erp-business-solution' )?></label>
				</th>
				<td>		

				<?php if( class_exists( 'CrmErpSolutionProducts') ){ ?>
					<?php 
					$prod = new CrmErpSolutionProducts();
					$prod->searchProductForm();
					?>
				<?php } ?>
			

				 </td>	
				<td class='totalWrap'>
					<input class="quantity" name="quantity" type="number" style="width: 95%"  min='0' value=""
							size="100" class="code" placeholder="<?php esc_html_e( 'Quantity', 'crm-erp-business-solution' )?>" >
				</td>		

				<td class='totalWrap'>
					<input class="price" step='any' name="price" type="number" style="width: 95%"  min='0' value=""
							size="50" class="code" placeholder="<?php esc_html_e( 'Price', 'crm-erp-business-solution' )?>" >
				</td>	

				<td class='totalWrap'>
					<input class="discount code" step='any' name="proddiscount" type="number" min='0' style="width: 95%" value=""
							size="50"  placeholder="<?php esc_html_e( 'Discount', 'crm-erp-business-solution' )?>" >
				</td>	
				
				<td  class='totalWrap plus' ><i class='fa fa-plus'></i></td>	 		
				<td  class='totalWrap minus' style='visibility:hidden'><i class='fa fa-minus'></i></td>	
				</tr>		
				<?php } ?>

			
			<tr class="form-field ">
				<th class='discountWrap' valign="top" scope="row">
					<label for="discount"><?php esc_html_e( 'Discount', 'crm-erp-business-solution' )?></label>
				</th>
				<td class='discountWrap'>
					<input id="totaldiscount" name="discount" type="number" min='0' style="width: 95%" min="0" value="<?php echo esc_attr( $item['discount'] )?>"
							size="50" class="code" placeholder="<?php esc_html_e( 'Discount on Total', 'crm-erp-business-solution' )?>" >
				</td>

				<th valign="top" scope="row" class='totalWrap'>
					<label for="total"><?php esc_html_e( 'Total', 'crm-erp-business-solution' )?></label>
				</th>
				


				
				<td class='totalWrap'>
					<input id="total" name="total" step='any' type="number" style="width: 95%" value="<?php echo esc_attr( $item['total'] )?>"
							size="50" class="code" min="0"  placeholder="<?php esc_html_e( 'Total', 'crm-erp-business-solution' )?>" required>
				</td>		
				
			</tr>
		
		
			<tr class="form-field paidWrap">
				<th valign="top" scope="row" class='totalWrap'>
					<label for="tax"><?php esc_html_e( 'Tax ', 'crm-erp-business-solution' )?><?php if( get_option( 'crmerpbsdefaultVat' ) )print esc_html( $vat ). "%"; ?></label>
				</th>
				<td class='totalWrap'>
					<input id="tax" name="tax" step='any' type="number" style="width: 95%" value="<?php echo esc_attr( $item['tax'] )?>"
							size="50" class="code" min="0" placeholder="<?php esc_html_e('Tax', 'crm-erp-business-solution' )?>" required>
				</td>	
				<th valign="top" scope="row" class='totalWrap'>
					<label for="grandtotal"><?php esc_html_e( 'Grand Total', 'crm-erp-business-solution' )?></label>
				</th>	
				<td class='totalWrap'>
					<input id="grandtotal" name="grandtotal" step='any' type="number" style="width: 95%" value="<?php echo esc_attr( $item['grandtotal'] )?>"
							size="50" class="code" min="0" readonly placeholder="<?php esc_html_e('Grand Total', 'crm-erp-business-solution' )?>" required>
				</td>			
			</tr>
	
		
			
			<tr class="form-field paidWrap">
				<th class='' valign="top" scope="row">
					<label for="paid"><?php esc_html_e( 'Paid', 'crm-erp-business-solution' )?></label>
				</th>
				
				
				<td class=''>
					<input id="paid" name="paid" type="number" style="width: 95%" min="0" max='<?php if(isset( $item['balance'] ) ) echo esc_attr( $item['balance'] )?>' step='any' value="<?php echo esc_attr( $item['paid'] )?>"
							size="50" class="code" placeholder="<?php esc_html_e( 'Paid amount', 'crm-erp-business-solution' )?>" >
				</td>		
				
			</tr>
			
			<?php if( get_option( 'crmerpbs_paymentMethod' )  && $_REQUEST['tab'] != 'offers' ) { 
				$paymentMethod = get_option( 'crmerpbs_paymentMethod' );
				$methods = explode( ",", $paymentMethod );
				
				if( !empty( $methods ) ){ ?>
				<tr class="form-field totalWrap">
				
					<th class='' valign="top" scope="row">
						<label for="payment_method"><?php esc_html_e( 'Payment Method', 'crm-erp-business-solution' )?></label>
					</th>
					
					<td class=''>
						<select id="payment_method" name="payment_method"  style="width: 95%" >
						
							<option value=''><?php esc_html_e( "Select..", 'crm-erp-business-solution' ); ?></option>
							
							<?php if( !empty( $item['payment_method'] ) ) { ?> 
							
							<option selected value='<?php echo esc_attr( $item['payment_method'] )?>'><?php echo esc_attr(ucfirst( $item['payment_method'] ) )?></option> 
							
							<?php }else{ 
							
								foreach( $methods as $method ){	
									
									$method = sanitize_text_field( $method );
									?>
									
									<option value='<?php print esc_html( $method ) ;?>'><?php print esc_html( ucfirst( $method ) ) ;?></option>
									
								<?php }
								
								} ?>
						</select>
					</td>		

			
				</tr>
				<?php } ?>
			<?php } ?>

			<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] !== 'offers' ){ ?>
			<tr class="form-field payWrap ">
				<th valign="top" scope="row">
					<label for="paydate"><?php esc_html_e( 'Payment Date', 'crm-erp-business-solution' )?></label>
				</th>
				<td>
					<input id="paydate" name="paydate" type="text" style="width: 95%" class="datepicker" value="<?php echo esc_attr( $item['paydate'] )?>"
							size="50" class="code" placeholder="<?php esc_html_e( 'Payment date', 'crm-erp-business-solution' )?>" >
				</td>
			</tr>
			<?php } ?>
			
			
			<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
			
				<?php if( get_option( 'crmerpbs_onlySelectDocuments' ) ) { ?>
				<tr class="form-field paidWrap">
					<th class='' valign="top" scope="row">
						<label for="document"><?php esc_html_e( 'Need Invoice?', 'crm-erp-business-solution' )?></label>
						 <input id="document" type='checkbox' name="document"   <?php if( !empty( $item['document'] ) ) { ?> checked='checked' <?php } ?> value='1' />
					</th>
									
				</tr>
				<?php }else{ ?>
					<tr class="form-field paidWrap">
						<th class='' valign="top" scope="row">
							<input id="document"  style='visibility:hidden' type='checkbox' name="document"   checked='checked' value='1' />
						</th>								
					</tr>					
				<?php } ?>
				
				<?php if( get_option( 'crmerpbs_activateReceipts' ) ) { ?>
					<tr class="form-field paidWrap">
						<th class='' valign="top" scope="row">
							<label for="document_type"><?php esc_html_e( 'Receipt as Document', 'crm-erp-business-solution' )?></label>
							<input id="document_type" type='checkbox' name="document_type"   <?php if( !empty( $item['document_type'] ) ) { ?> checked='checked' <?php } ?> value='1' />
						</th>								
					</tr>					
				<?php } ?>
				
			<?php } ?>
			
			</tbody>
		</table>
		<?php
	}


	public function validate( $item ){
		$messages = array();

		if ( empty( $item['total'] ) ) $messages[] = esc_html__( 'Total is required', 'crm-erp-business-solution' );
		if ( empty( $item['user'] ) ) $messages[] = esc_html__( 'User is required', 'crm-erp-business-solution' );
		

		if ( empty( $messages ) ) return true;
		return implode( ' - ', $messages );
	}


	public function getTransactionParent(){

			global $wpdb;

			$result = $wpdb->get_results( $wpdb->prepare( "SELECT id,username,user,creationdate,balance,grandtotal FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE type=%s && ( parent IS NULL || parent=0 ) and ( balance <>0 || balance IS NULL ) ", 'saleinvoice' ) );
			$count = 0;
			
			foreach( $result as $res ){
				
			if( $res->balance !='' || $res->balance !=0 ){
				$balance = sanitize_text_field( $res->balance );
			}else $balance =  sanitize_text_field( $res->grandtotal );			
				
				print  "<option user = '".esc_attr( $res->user )."' balance = '".esc_attr( $balance )."' value='".esc_attr( $res->id )."'>ID:".esc_attr( $res->id ). " - date: ". date( 'd-m-Y', strtotime( $res->creationdate ) ). " - user: ". esc_attr( $res->username )."</option>";
				$count++;
			}	
	}

	public function view(){ ?>

		<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){ ?>
			<h2><?php esc_html_e('Offer', 'crm-erp-business-solution' )?> 
				<a class="add-new-h2 " href="<?php echo esc_url( admin_url(  'admin.php?page=crm-erp-business-solution&tab=offers' ) ); ?>" >
					<i class='fa fa-angle-double-left'></i> <?php esc_html_e( 'back to list', 'crm-erp-business-solution' )?>
				</a>
			</h2>
		<?php }elseif (isset($_REQUEST['tab']) && $_REQUEST['tab'] =='sales' ){ ?>
			<h2><?php esc_html_e('Sale Transaction', 'crm-erp-business-solution' )?> 
				<a class="add-new-h2 " href="<?php echo esc_url( admin_url(  'admin.php?page=crm-erp-business-solution&tab=sales' ) ); ?>" >
					<i class='fa fa-angle-double-left'></i> <?php esc_html_e( 'back to list', 'crm-erp-business-solution' )?>
				</a>
			</h2>		
		<?php }else{ ?>
		
			<h2><?php esc_html_e('Payment Transaction',  'crm-erp-business-solution' )?> 
				<a class="add-new-h2 " href="<?php echo esc_url( admin_url(  'admin.php?page=crm-erp-business-solution&tab=payments' ) ); ?>" >
					<i class='fa fa-angle-double-left'></i> <?php esc_html_e( 'back to list', 'crm-erp-business-solution' )?>
				</a>
			</h2>	
		<?php } ?>
		
		<?php
		
		if( isset( $_REQUEST['id'] ) ){
			
			$nonce = wp_create_nonce( 'crmerpbs_trans_nonce' );

			global $wpdb;
			
			$transaction = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE id =%d ", (int)$_REQUEST['id'] ) );
			
			if( $transaction ){
				?>

				<div id="tabs">
				
				<ul>
					
					<?php if( $transaction->type !=='offer' ){ ?>
						<li ><a href='#details'><?php esc_html_e( 'Order Details', 'crm-erp-business-solution' )?></a></li>
						<?php if( $transaction->type =='saleinvoice' || $transaction->type =='payinvoice' ){ ?>
							<li ><a href='#payments'><?php esc_html_e( 'Payments', 'crm-erp-business-solution' )?></a></li>
						<?php } ?>
					<?php }else{  ?>
						<li ><a href='#details'><?php esc_html_e('Offer Details', 'crm-erp-business-solution' )?></a></li>
					<?php } ?>
				</ul>
				
				<div id='details'>

				<?php if ( $transaction->type =='offer' ){ ?>
					<p><?php print wp_kses( $transaction->description, CrmErpSolution::get_instance()->allowed_html ); ?></p>
				<?php } ?>
				
				<table class='widefat striped' > 
				<tr>
					<?php 
						if( $transaction->type =='saleinvoice' || $transaction->type =='payinvoice' ){
							$headings = array( esc_html__( "DATE", 'crm-erp-business-solution' ),esc_html__( "NAME", 'crm-erp-business-solution' ),esc_html__( "USERNAME", 'crm-erp-business-solution' ),esc_html__( "STATUS", 'crm-erp-business-solution' ),esc_html__( "DISCOUNT", 'crm-erp-business-solution' ),esc_html__( "SUB TOTAL", 'crm-erp-business-solution' ),esc_html__( "TAX", 'crm-erp-business-solution' ),esc_html__( "TOTAL", 'crm-erp-business-solution' ),esc_html__( "PAID", 'crm-erp-business-solution' ),esc_html__( "BALANCE", 'crm-erp-business-solution' ) );
						}else{
							if( $transaction->type =='offer' ){
								$headings = array(esc_html__( "DATE", 'crm-erp-business-solution' ),esc_html__( "NAME", 'crm-erp-business-solution' ),esc_html__( "USERNAME", 'crm-erp-business-solution' ),esc_html__( "TYPE", 'crm-erp-business-solution' ),esc_html__( "STATUS", 'crm-erp-business-solution' ),esc_html__( "DISCOUNT", 'crm-erp-business-solution' ),esc_html__( "SUB TOTAL", 'crm-erp-business-solution' ),esc_html__( "TAX", 'crm-erp-business-solution' ),esc_html__( "TOTAL",  'crm-erp-business-solution' ) );
							}else{
								$headings = array(esc_html__( "DATE", 'crm-erp-business-solution' ),esc_html__( "PARENT", 'crm-erp-business-solution' ),esc_html__( "NAME", 'crm-erp-business-solution' ),esc_html__( "USERNAME", 'crm-erp-business-solution' ),esc_html__( "TYPE", 'crm-erp-business-solution' ),esc_html__( "STATUS", 'crm-erp-business-solution' ),esc_html__( "DISCOUNT", 'crm-erp-business-solution' ),esc_html__( "SUB TOTAL", 'crm-erp-business-solution' ),esc_html__( "TAX", 'crm-erp-business-solution' ),esc_html__( "TOTAL",  'crm-erp-business-solution' ) );								
							}
						
						}
						 foreach( $headings as $heading ){ ?>
							<th><?php esc_html_e( $heading, 'crm-erp-business-solution' ); ?></th>
						<?php } 					
					?>
				</tr>
				<tr>
				
				<?php
					$userR = get_user_by( "id", (int)$transaction->user );
					if( $userR ){
						$tab = '';
						if ( in_array( 'crm_customer', (array) $userR->roles ) ) {
							$tab = 'customers';
						}elseif ( in_array( 'crm_vendor', (array) $userR->roles ) ) {
							$tab = 'vendors';
						}
						if( has_filter( 'crmerpbs_get_user_role_by_id_for_usrtab' ) ) {
							$tab = apply_filters( "crmerpbs_get_user_role_by_id_for_usrtab", (int)$transaction->user ); 
						}
					}
				?>
					<?php if( $transaction->type =='saleinvoice' || $transaction->type =='payinvoice' ){ ?>
						<th><?php print date( "d-m-Y",strtotime( $transaction->creationdate ) ); ?></th>
						<th><?php print esc_html( $transaction->name ); ?></th>
						
						<?php if( $userR ) { ?>
						
							<th><?php print "<a href='".esc_url( admin_url("?page=crm-erp-business-solution&tab=".esc_attr( $tab ) ."&action=view&id=".(int)$transaction->user ) )."' target='_blank'>". esc_html( $userR->first_name. " " . $userR->last_name )."</a>"; ?></th>
						
						<?php }else { ?>
							<?php print "<th>".esc_html__( "User does not exist anymore", 'crm-erp-business-solution' ). "</th>"; ?>
						<?php } ?>
						
						
						<th><?php print esc_html( $transaction->status ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->discount ) ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->total ) ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->tax ) ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->grandtotal ) ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->paid ) ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->balance ) ); ?></th>
					<?php }else{ 
							$tabs = sanitize_text_field( $_REQUEST['tab'] );
					?>
						<th><?php print date( "d-m-Y",strtotime( $transaction->creationdate ) ); ?></th>
						
						<?php if( $transaction->type !='offer' ){ ?>
							<th><a href='<?php print esc_url( admin_url( "admin.php?page=crm-erp-business-solution&tab=". esc_html( $tabs )."&action=view&id=".(int)$transaction->parent) ); ?>' ><?php print esc_html( $transaction->parent ); ?></a></th>
						<?php } ?>
						
						<th><?php print esc_html( $transaction->name ); ?></th>
						
						<?php if( $userR ) { ?>
						
							<th><?php print "<a href='".esc_url( admin_url( "?page=crm-erp-business-solution&tab=".$tab."&action=view&id=". (int)$transaction->user ) )."' target='_blank'>". esc_html( $userR->first_name. " " . $userR->last_name )."</a>"; ?></th>
						
						<?php }else { ?>
							<?php print "<th>".esc_html__( "User does not exist anymore", 'crm-erp-business-solution' ). "</th>"; ?>
						<?php } ?>						
						
						<th><?php print esc_html( $transaction->type ); ?></th>
						<th><?php print esc_html( $transaction->status ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->discount ) ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->total ) ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->tax ) ); ?></th>
						<th><?php print esc_html( crm_price( $transaction->grandtotal ) ); ?></th>
					<?php } ?>				
				</tr>			

				</table>			
				<?php
				
				if( $transaction->type =='saleinvoice' || $transaction->type =='payinvoice' ){
				
				$result = $wpdb->get_results( $wpdb->prepare( "SELECT product_id,discount,quantity,amount,total FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' )." WHERE trans_id=%d ", (int)$_REQUEST['id'] ) );
				$count = 0;	
				if( $result ){
				?>
				<br/><br/>			
				<table class='widefat striped' > 
				<tr>				
					<th><?php esc_html_e( "PRODUCT", 'crm-erp-business-solution' ) ; ?></th>
					<th><?php esc_html_e( "QUANTITY", 'crm-erp-business-solution' ) ; ?></th>
					<th><?php esc_html_e( "AMOUNT", 'crm-erp-business-solution' ) ; ?></th>
					<th><?php esc_html_e( "DISCOUNT", 'crm-erp-business-solution' ) ; ?></th>
					<th><?php esc_html_e( "TOTAL", 'crm-erp-business-solution' ) ; ?></th>
				</tr>
				<?php
				foreach( $result as $res ){
					
					$title = get_the_title( (int)$res->product_id );
					if( has_filter( 'crmerpbs_getProductTitle' ) ) {
						$title = apply_filters( "crmerpbs_getProductTitle" , (int)$res->product_id );
					}
					print "<tr><td>". esc_html( $title ) ."</td><td>".(int)$res->quantity."</td><td>". esc_html( $res->amount )."</td><td>".esc_html( crm_price( $res->discount ) )."</td><td>".esc_html( crm_price( $res->total ) )."</td>" ;
					
					$count++;
				}
				
				$i=0;
						
				
				?>
				</table>
				<?php } } ?>
				</div>
				
				<?php if ( $transaction->type !=='offer'  ){ ?>
				
					<?php if( $transaction->type =='saleinvoice' || $transaction->type =='payinvoice' ){ ?>
					
					<div id='payments'>
					
						<?php
							
						$payments = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE  parent=%d ", (int)$_REQUEST['id'] ) );
						
						if( $payments ){
		
							?>			
							<table class='widefat striped' > 
							<tr>
								
								<th><?php esc_html_e( "PAYMENT ID", 'crm-erp-business-solution' ) ; ?></th>
								<th><?php esc_html_e( "PAYMENT DATE", 'crm-erp-business-solution' ) ; ?></th>
								<th><?php esc_html_e( "PAID", 'crm-erp-business-solution' ) ; ?></th>
								<?php if( $_REQUEST['tab'] !=='payments'  ){ ?>
									<th><?php esc_html_e( "ACTIONS", 'crm-erp-business-solution' ) ; ?></th>
								<?php } ?>

							</tr>
							<?php
						
							$tab = sanitize_text_field( $_REQUEST['tab'] );
							foreach( $payments as $res ){
								
								if( $_REQUEST['tab'] == 'payments'  ){
									
									print 
									"<tr>
										<td>".(int)$res->id."</td>
										<td>".date( "d-m-Y", strtotime( $res->paydate ) )."</td>
										<td>". esc_html( $res->paid )."</td>
									</tr>";
									
								}else{
									
									if( $userR ) {
										
										$message = "<a class='viewpdf' href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab )."&action=view&do=pdf&id=".(int)$res->id."&_wpnonce=".$nonce ) ) ."' 'target=_blank'><i class='fa fa-file-pdf-o'></i> ".esc_html__( "Generate PDF Receipt", 'crm-erp-business-solution' )."</a>";
										
									}else  $message =  esc_html__( "Document not Available as User does not exist anymore", 'crm-erp-business-solution' );
									
									print "<tr><td>".(int)$res->id."</td><td>".date( "d-m-Y", strtotime( $res->paydate ) )."</td><td>". esc_html( $res->paid )."</td>" ;
									print "<td>". wp_kses( $message, CrmErpSolution::get_instance()->allowed_html ) ."</td></tr>";
									
								}

								$count++;
							}
						
							?>
							</table>
							
							<?php			
						}
						?>
						<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
						<?php if ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'offers' ){ ?>
							
						<?php }elseif ( isset( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'sales' ){ ?>
							<?php if( $transaction->status !='paid' ){ ?>
								<h2>	
									<a class="add-new-h2" href="<?php echo esc_url( admin_url( "?page=crm-erp-business-solution&tab=sales&action=new&user=". (int)$transaction->user ."&parent=".(int)$_REQUEST['id']."&balance=".esc_attr( $transaction->balance ) ) );?>"><?php esc_html_e( 'Add new Payment', 'crm-erp-business-solution' )?></a>
								</h2>
							<?php } ?>	
						<?php }else { ?>
							<?php if( $transaction->status !='paid' ){ ?>
								<h2>	
									<a class="add-new-h2" href="<?php echo esc_url( admin_url( "?page=crm-erp-business-solution&tab=payments&action=new&user=". (int)$transaction->user ."&parent=".(int)$_REQUEST['id']."&balance=".esc_attr( $transaction->balance ) ) );?>"><?php esc_html_e( 'Add new Payment', 'crm-erp-business-solution' )?></a>
								</h2>
							<?php } ?>	
						<?php } ?>						
							
					
					</div>
					<?php } ?>
				<?php } ?>
				</div><?php
				
				if( $_REQUEST['tab'] !=='payments'  ){
					if( $userR ) {
						
						$tab = sanitize_text_field( $_REQUEST['tab'] );
						
						if ( $transaction->type != 'payinvoice' && $transaction->type != 'paypayment' ){
							
							if ( $transaction->type == 'offer' ){
								
								print "<p><a  class='viewpdf'  href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab )."&action=view&do=pdf&id=". (int)$_REQUEST['id']."&_wpnonce=".esc_attr( $nonce ) ) )."' ><i class='fa fa-file-pdf-o'></i> ".esc_html__( "Generate PDF Offer", 'crm-erp-business-solution' )."</a></p>";
								
								print "<p><a  class='sendpdf'  href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab )."&action=view&do=send&id=". (int)$_REQUEST['id']."&_wpnonce=".esc_attr( $nonce ) ) ) ."' ><i class='fa fa-envelope'></i> ".esc_html__( "Email Offer to User", 'crm-erp-business-solution' )."</a></p>";
								
							}else{
								$doc = new CrmErpSolutionDocuments();
								
								if( $transaction->document_type != NULL || $transaction->type == 'salepayment'  ){							
									$document_type = esc_html__( "Receipt", 'crm-erp-business-solution' ); 							
								}else $document_type = esc_html__( "Invoice", 'crm-erp-business-solution' );
								
								if( $doc->checkDocument( (int)$_REQUEST['id'],0 ) == false ){
									print "<p><a  class='viewpdf' tab='".esc_html( $tab )."' id='".(int)$_REQUEST['id']."' _wpnonce ='trans_nonce' do='pdf'   href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab )."&action=view&do=pdf&id=". (int)$_REQUEST['id']."&_wpnonce=".esc_attr( $nonce ) ) )."' ><i class='fa fa-file-pdf-o'></i> ".esc_html__( "Generate PDF ", 'crm-erp-business-solution' ). esc_html( $document_type ) . "</a></p>";
								

								}else{
									
									print "<p><a class='viewpdf' href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab )."&action=view&do=pdf&id=". (int)$_REQUEST['id']."&_wpnonce=".esc_attr( $nonce ) ) )."' ><i class='fa fa-file-pdf-o'></i> ".esc_html__( "View PDF ", 'crm-erp-business-solution' ) . esc_html( $document_type ) . "</a></p>";
									
								}
								print "<p><a  class='sendpdf' href='". esc_url( admin_url( "?page=crm-erp-business-solution&tab=". esc_attr( $tab )."&action=view&do=send&id=". (int)$_REQUEST['id']."&_wpnonce=".esc_attr( $nonce ) ) )."' ><i class='fa fa-envelope'></i> ".esc_html__( "Email ", 'crm-erp-business-solution' ) . esc_html( $document_type ) . esc_html__( " to User", 'crm-erp-business-solution' ) . "</a></p>";					
							}
						
						}

					}else print esc_html__( "Document not Available as User does not exist anymore", 'crm-erp-business-solution' );
				}
			}	
		}
	}




	public function getTransactionProducts( $id ){

			global $wpdb;
			$total_items = $wpdb->get_results( $wpdb->prepare( "SELECT product_id,discount,quantity,amount,total FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' )." WHERE trans_id=%d  ", (int)$id ) );
			$count = 0;


			
			foreach( $result as $res ){ 

				$discount = sanitize_text_field( $res->discount );
				$quantity = sanitize_text_field( $res->quantity );
				$amount = sanitize_text_field( $res->amount );
				$product_id = sanitize_text_field( $res->product_id );			
				$title = get_the_title( (int)$product_id );
				if( has_filter( 'crmerpbs_getProductTitle' ) ) {
					$title = apply_filters( "crmerpbs_getProductTitle" , (int)$product_id );	
				}
				

				?>
				
				<tr class="form-field prodWrap">
				<?php
				$prod = new CrmErpSolutionProducts();
				?>
				
				<th valign="top" scope="row">
					<label for="type"><?php esc_html_e( 'Product', 'crm-erp-business-solution' )?></label>
				</th>
				<td>		

					<i class='fa fa-search productsearch' style='width:10%;cursor:pointer;'></i>
					<input type="text" id="searchproduct" style='width:85%' name="searchproduct" placeholder='<?php esc_html_e( "Select product: search by sku/name", 'crm-erp-business-solution' ); ?>'  value='<?php print esc_html( $title ); ?>' />	
		
					<select id='product' style='display:none;width:100%'   name='product<?php if($count>=1)print $count;?>' class="code">
						<option value=''><?php esc_html_e( "Select product", 'crm-erp-business-solution' ); ?></option>
						<?php
						print  "<option selected value='".esc_attr( $product_id )."'>". esc_html( $title )."</option>";
						?>
						
					</select>
				 </td>	
				<td class='totalWrap'>
					<input class="quantity" name="quantity<?php if($count>=1)print esc_attr( $count ) ;?>" type="number" style="width: 95%" min="0" size="100" class="code" placeholder="<?php esc_html_e('Quantity', 'crm-erp-business-solution' )?>" value='<?php print esc_attr( $quantity ); ?>' >
				</td>		

				<td class='totalWrap'>
					<input class="price" name="price<?php if($count>=1)print esc_attr( $count ) ;?>" type="number" style="width: 95%" min="0"	size="50" class="code" placeholder="<?php esc_html_e('Price', 'crm-erp-business-solution' )?>" value='<?php print esc_attr( crm_price( $amount ) ); ?>' >
				</td>	

				<td class='totalWrap'>
					<input class="discount code" name="proddiscount<?php if($count>=1)print esc_attr( $count ) ;?>" type="number"  min="0" style="width: 95%"  placeholder="<?php esc_html_e('Product Discount', 'crm-erp-business-solution' )?>"  value='<?php print esc_attr( crm_price( $discount ) ); ?>' >
				</td>	
				
				<?php if($count>=1){?>
					<td  class='totalWrap plus' ><i class='fa fa-plus'></i></td> <td  class='totalWrap minus' ><i class='fa fa-minus'></i></td>
				<?php }else{ ?>
					<td  style='visibility:hidden' class='totalWrap plus' ><i class='fa fa-plus'></i></td><td  style='visibility:hidden' class='totalWrap minus' ><i class='fa fa-minus'></i></td>
				<?php } 

				$count++;
				
				?>
			</tr>
			<?php
			}				
	}


	public function getTransactionParentPayments(){

			global $wpdb;

			$result = $wpdb->get_results( $wpdb->prepare( "SELECT id,username,creationdate,balance,total FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE type=%s && ( parent IS NULL || parent=0 ) and ( balance <> 0 || balance IS NULL )  ", 'payinvoice' ) );
			$count = 0;

			foreach( $result as $res ){
				
				if( $res->balance !='' || $res->balance !=0 ){
					$balance = sanitize_text_field( $res->balance );
				}else $balance =  sanitize_text_field( $res->grandtotal );			
				
				$username = sanitize_text_field( $res->username );	
				$id = sanitize_text_field( $res->id );
				$creationdate = sanitize_text_field( $res->creationdate );
				
				print  "<option balance = '". esc_attr( $balance ) ."' value='". (int)$id  ."'>ID:".(int)$id . " - date: ". date( 'd-m-Y', strtotime( $creationdate ) ). " - user: ". esc_attr( $username ) ."</option>";
				
				$count++;
			}	
	}

	public function updatePaid( $amount, $parentid ){

			global $wpdb;
					
			//UPDATE PAID AMOUNT OF INVOICE
			
			$result = $wpdb->get_row( $wpdb->prepare( "SELECT paid,grandtotal FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE id=%d  ", (int)$parentid ) );
			$paid = sanitize_text_field( $result->paid );
			
			if( empty( $paid ) ){
				
				$sum = $wpdb->get_var( $wpdb->prepare( "SELECT sum(grandtotal) FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE parent=%d  ", (int)$parentid ) );
				if( empty( $sum ) ) $sum = $amount;
				

				$wpdb->update( sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions", array( 'paid'=>$sum ), array( 'id' => (int)$parentid ) ,array( '%s' ), array( '%d' ) );
	
				
			}else{
				
				$sum = $paid + $amount;

				$wpdb->update( sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions", array( 'paid'=>$sum ), array( 'id' => (int)$parentid ) ,array( '%s' ), array( '%d' ) );				
			}
		
			
			//UPDATE BALANCE OF INVOICE
			
			$result = $wpdb->get_row( $wpdb->prepare( "SELECT paid,grandtotal FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE id =%d  ", (int)$parentid ) );
			$paid = sanitize_text_field( $result->paid );
			$total = sanitize_text_field( $result->grandtotal );			
			$balance = $total - $paid;
			
	
			$wpdb->update( sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions", array( 'balance'=>$balance ), array( 'id' => (int)$parentid ) ,array( '%s' ), array( '%d' ) );	
			
			$paydate = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
			//UPDATE STATUS OF INVOICE
			$result = $wpdb->get_row( $wpdb->prepare( "SELECT balance FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE id =%d  ", (int)$parentid ) );
			$balance = sanitize_text_field( $result->balance );
				
			if( (int)$balance <=0 ) {
				
				$status = 'paid';

				$wpdb->update( sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions", array( 'status'=>$status, 'paydate'=> $paydate ), array( 'id' => (int)$parentid ) ,array( '%s', '%s' ), array( '%d' ) );
			}
			
	}

	public function updatePaidInvoice( $amount, $id ){
		
			global $wpdb;
			
			//UPDATE BALANCE OF INVOICE
			
			$result = $wpdb->get_row( $wpdb->prepare( "SELECT paid,grandtotal FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE id =%d  ", (int)$id ) );
			
			$paid = sanitize_text_field( $result->paid );
			$total = sanitize_text_field( $result->grandtotal );			
			$balance = $total - $paid;
			

			$wpdb->update( sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions", array( 'balance'=>$balance ), array( 'id' => (int)$id ) ,array( '%s' ), array( '%d' ) );
			
			$paydate = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
			
			//UPDATE STATUS OF INVOICE
			$result = $wpdb->get_row( $wpdb->prepare( "SELECT balance FROM ".sanitize_text_field( $wpdb->prefix."crmerpbs_transactions" )." WHERE id =%d  ", (int)$id ) );
			
			$balance = sanitize_text_field( $result->balance );
			
			if( (int)$balance <=0 ) {
				
				$status = 'paid';

				$wpdb->update( sanitize_text_field( $wpdb->prefix )."crmerpbs_transactions", array( 'status'=>$status, 'paydate'=> $paydate ), array( 'id' => (int)$id ) ,array( '%s', '%s' ), array( '%d' ) );
			
			}

	}



	
	public function crm_generatePdf( $id ){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'crmerpbs_trans_nonce' ) ) { 


		if( get_option( 'crmerpbs_companyAddress' ) && get_option( 'crmerpbs_companyName' ) ) {
		
			global $wpdb;
			
			$transaction = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transactions' )." WHERE id =%d  ", (int)$id ) );
					
			if( $transaction->parent =='0' ){
				
				$result = $wpdb->get_results( $wpdb->prepare( "SELECT product_id,discount,quantity,amount,total FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' )." WHERE trans_id=%d  ", (int)$id ) );
				
			}else{
				
				$parent = sanitize_text_field( $transaction->parent );
				
				$result = $wpdb->get_results( $wpdb->prepare( "SELECT product_id,discount,quantity,amount,total FROM ".sanitize_text_field( $wpdb->prefix . 'crmerpbs_transaction_items' )." WHERE trans_id=%d  ", (int)$parent ) );
				
			}
			
			$doc = new CrmErpSolutionDocuments();

			if( $transaction->type == 'saleinvoice' && $transaction->document_type != NULL ) {
				
				$doc->addDocument( (int)$transaction->id, 1 );
				$document = esc_html__( 'Receipt', 'crm-erp-business-solution' ); 
				$doc_type = 1 ;
			}
			
			if( $transaction->type == 'saleinvoice' && $transaction->document_type == NULL ) {
				
				$doc->addDocument( (int)$transaction->id, 0 );
				$document = esc_html__( 'Invoice', 'crm-erp-business-solution' ); 
				$doc_type = 0 ;
			}
			
			if( $transaction->type == 'salepayment' ) {
				
				$doc->addDocument( (int)$transaction->id, 1 );
				$document = esc_html__( 'Receipt', 'crm-erp-business-solution' ); 
				$doc_type = 1 ;
			}
			
			if( $transaction->type == 'offer' ){
				
				$document = esc_html__( 'Offer', 'crm-erp-business-solution' ); 
				$doc_type = 2 ;
			}
			
							
			$count = 0;	

				$product = array();
				$quantity = array();
				$sku = array();
				$amount = array();

				foreach( $result as $res ){

					$title = get_the_title( (int)$res->product_id );
					if( has_filter( 'crmerpbs_getProductTitle' ) ) {
						$title = apply_filters( "crmerpbs_getProductTitle" , (int)$res->product_id );
					}
			
					$code = get_post_meta( (int)$res->product_id, 'crmerpbs_sku', true );
					
					if( has_filter( 'crmerpbs_get_sku' ) ) {
						$code = apply_filters( "crmerpbs_get_sku", (int)$res->product_id );	
					}
					array_push( $product, sanitize_text_field( $title ) );
					array_push( $quantity, sanitize_text_field( $res->quantity ) );
					array_push( $amount, sanitize_text_field( $res->amount ) );
					array_push( $sku, sanitize_text_field( $code ) );
					
					$count++;
				}
				$i=0;
						
				$user =  get_user_by( "id", (int)$transaction->user ) ;

				
				$doc_id = $wpdb->get_row( $wpdb->prepare( "SELECT doc_id FROM ".$wpdb->prefix ."crmerpbs_documents WHERE trans_id =%d  ", (int)$id ) );
				
				
				
				if( $doc_id ){
					$doc_id = get_option( 'crmerpbs_invoiceTransPrefix' ). (int)$doc_id->doc_id;
				}else $doc_id = get_option( 'crmerpbs_invoiceTransPrefix' ). (int)$transaction->id ;
								
				
				$post_data['user'] =  (int)$transaction->user ;
				$post_data['do'] =  sanitize_text_field( $_REQUEST['do'] );		
				$post_data['doc_id'] = sanitize_text_field( $doc_id );
				$post_data['id'] = (int)$transaction->id ;
				$post_data['creationdate'] = date("d-m-Y",strtotime( $transaction->creationdate ) ) ;
				$post_data['total'] = sanitize_text_field( $transaction->total ) ;
				$post_data['tax'] = sanitize_text_field( $transaction->tax );
				$post_data['grandtotal'] = sanitize_text_field( $transaction->grandtotal );
				$post_data['discount'] = sanitize_text_field( $transaction->discount );
				$post_data['payment_method'] = sanitize_text_field( $transaction->payment_method );
				$post_data['type'] = sanitize_text_field( $transaction->type );
				$post_data['description'] = sanitize_text_field( $transaction->description );
				$post_data['doc_type'] = sanitize_text_field( $doc_type );
				
				$post_data['document_type'] = sanitize_text_field( $document );
				
				if( $transaction->parent == '0' ){ 
					$post_data['invoicenr'] = sanitize_text_field( $transaction->document );
					$post_data['parent'] = '0';
						
				}else{ 
					$post_data['invoicenr'] = sanitize_text_field( $transaction->parent );						
					$post_data['parent'] = sanitize_text_field( $transaction->parent );						
				} 
				
				$post_data['duedate'] = sanitize_text_field( $transaction->duedate );	
				$post_data['paydate'] = sanitize_text_field( $transaction->paydate );	
				$post_data['balance'] = sanitize_text_field( $transaction->balance );	
				$post_data['status'] = sanitize_text_field( $transaction->status );	
				
				if( $user ){
					$post_data['user_first_name'] = sanitize_text_field( $user->first_name );
					$post_data['user_email'] = sanitize_text_field( $user->user_email );					
					$post_data['user_last_name'] = sanitize_text_field( $user->last_name );
					$post_data['user_vat'] = sanitize_text_field( $user->vat );						
					$post_data['user_address'] = sanitize_text_field( $user->billing_address_1 );
					$post_data['user_city'] = sanitize_text_field( $user->billing_city );						
					$post_data['user_country'] = sanitize_text_field( $user->billing_country );
					$post_data['user_postcode'] = sanitize_text_field( $user->billing_postcode );
					$post_data['user_phone'] = sanitize_text_field( $user->billing_phone );					
				}else{
					$post_data['user_first_name'] =  esc_html__( 'No user found for document ', 'crm-erp-business-solution' );						
					$post_data['user_last_name']= '';
					$post_data['user_vat'] = '';						
					$post_data['user_address'] = '';
					$post_data['user_city'] = '';				
					$post_data['user_country'] = '';
					$post_data['user_postcode'] = '';
					$post_data['user_phone'] = '';	
					$post_data['user_email'] = '';						
				}				


				$doc = new CrmErpSolutionInvoice();
				$doc->generate( $post_data, $product, $quantity, $sku, $amount );				
				
		}else{ ?>
				<script type = "text/javascript">			
					alert( "<?php esc_html_e( 'To generate documents please go to settings and fill Company name and Address', 'crm-erp-business-solution' ) ; ?>" ); 
				</script>				
		<?php }	

		}
	}
}

$crmTransactions = CRMTransactions::get_instance();