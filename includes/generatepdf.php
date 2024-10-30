<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include_once( plugin_dir_path(__FILE__) ."../topdf/fpdf.php" );
include_once( plugin_dir_path(__FILE__) ."../topdf/tfpdf.php" );
include_once( plugin_dir_path(__FILE__) ."../topdf/pdf-helper-class.php" );

class CrmErpSolutionInvoice{
		
    public function __construct() {

		add_action( 'wp_ajax_nopriv_generatePDF', array( $this, 'generate') );
		add_action( 'wp_ajax_generatePDF', array( $this, 'generate') );
		add_action( 'admin_init', array( $this, 'samplePdf') );
		
    }

	public function hex2dec($couleur = "#000000"){
		$R = substr($couleur, 1, 2);
		$rouge = hexdec($R);
		$V = substr($couleur, 3, 2);
		$vert = hexdec($V);
		$B = substr($couleur, 5, 2);
		$bleu = hexdec($B);
		$tbl_couleur = array();
		$tbl_couleur['R']=$rouge;
		$tbl_couleur['V']=$vert;
		$tbl_couleur['B']=$bleu;
		return $tbl_couleur;
	}
	

	public function generate( $args, $product, $quantity, $sku, $amount ){
		
		if( $args['do'] ){
			
				
			$currency =  sanitize_text_field( get_option( 'crmerpbs_currencySymbol' ) );
			$company_name = sanitize_text_field( get_option( 'crmerpbs_companyName' ) );
			$company_address = sanitize_text_field( get_option( 'crmerpbs_companyAddress' ) );
			$company_phone = sanitize_text_field( get_option( 'crmerpbs_companyPhone' ) );		
			$company_vat = sanitize_text_field( get_option( 'crmerpbs_companyVat' ) );
			$company_mobile = sanitize_text_field( get_option( 'crmerpbs_companyMobile' ) );
			$company_image = sanitize_text_field( get_option( 'crmerpbs_companyImage' ) );
			$notes = esc_attr( get_option( 'crmerpbs_invoiceNotes' ) );
			$thankyou = sanitize_text_field( get_option( 'crmerpbs_invoiceThankyou' ) );
			$start = sanitize_text_field( get_option( 'crmerpbs_invoiceStart' ) );				
			$headingsBackground =  $this->hex2dec( sanitize_hex_color( get_option( 'crmerpbs_headingsBackground' ) ) );
			$headingsColor = $this->hex2dec( sanitize_hex_color( get_option( 'crmerpbs_headingsColor' ) ) );
			$generalColor = $this->hex2dec( sanitize_hex_color( get_option( 'crmerpbs_generalColor' ) ) );
			$thankyouColor = $this->hex2dec( sanitize_hex_color( get_option( 'crmerpbs_thankyouColor' ) ) );	
				
			$doc_type = sanitize_text_field( $args['doc_type'] );
			$document = sanitize_text_field( $args['document_type'] );

			if($args['invoicenr']){
				$invoicenr = sanitize_text_field( $args['invoicenr'] );
			}else $invoicenr = '';
					

			if($args['id']){
				$id = sanitize_text_field( $args['id'] );
			}else $id='';	

			if($args['creationdate']){
				$creationdate = sanitize_text_field( $args['creationdate'] );
			}else $creationdate='';

			if($args['total']){
				$total = sanitize_text_field( $args['total'] );
			}else $total='';

			if($args['tax']){
				$tax = sanitize_text_field( $args['tax'] );
			}else $tax='';

			if($args['grandtotal']){
				$grandtotal = sanitize_text_field( $args['grandtotal'] );
			}else $grandtotal='';

			if($args['discount']){
				$discount = sanitize_text_field( $args['discount'] );
			}else $discount='';

			if($args['payment_method']){
				$payment_method = sanitize_text_field( $args['payment_method'] );
			}else $payment_method='';


			if($args['user_first_name']){
				$user_first_name = sanitize_text_field( $args['user_first_name'] );
			}else $user_first_name='';

			if($args['user_last_name']){
				$user_last_name = sanitize_text_field( $args['user_last_name'] );	
			}else $user_last_name='';

			if($args['user_vat']){
				$user_vat = sanitize_text_field( $args['user_vat'] );
			}else $user_vat='';

			if($args['user_address']){
				$user_address = sanitize_text_field( $args['user_address'] );
			}else $user_address='';

			if($args['user_city']){
				$user_city = sanitize_text_field( $args['user_city'] );
			}else $user_city='';

			if($args['user_country']){
				$user_country = sanitize_text_field( $args['user_country'] );
			}else $user_country='';


			if($args['user_postcode']){
				$user_postcode = sanitize_text_field( $args['user_postcode'] );
			}else $user_postcode='';

			if($args['user_phone']){
				$user_phone = sanitize_text_field( $args['user_phone'] );
			}else $user_phone='';

			if( $args['duedate'] && $args['duedate'] != '0000-00-00' ){
				$duedate = DATE("d-m-Y",STRTOTIME($args['duedate']));
			}else $duedate='';

			if($args['paydate']){
				$paydate = DATE("d-m-Y",STRTOTIME($args['paydate']));
			}else $paydate='';

			if($args['status']){
				$status = sanitize_text_field( $args['status'] );
			}else $status='';

			if($args['balance']){
				$balance = sanitize_text_field( $args['balance'] );
			}else $balance='';


			header('Content-type: application/pdf');
			$pdf = new PDF();
			$pdf->AliasNbPages();

			$pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
			$pdf->AddFont('DejaVu','B','DejaVuSans-Bold.ttf',true);
			$pdf->AddFont('DejaVu','I','DejaVuSans-Oblique.ttf',true);

			$pdf->AddPage();
			/*output the result*/

			/*set font to arial, bold, 14pt*/
			$pdf->SetFont('DejaVu','B',20);

			/*Cell(width , height , text , border , end line , [align] )*/

			$pdf->SetFont('DejaVu','B',10);
			$pdf->setTextColor($generalColor['R'],$generalColor['V'],$generalColor['B']);


			if( $company_image != '') $pdf->Cell(27 ,5,'',0,0);


			$pdf->Cell(82 ,8,esc_html( $company_name ),0,0);

			if( $company_image != '') {
				$pdf->CellFitScale(82 ,8,ucfirst( esc_html( $document ) ),0,1,'R');
			}else $pdf->CellFitScale(109 ,8,ucfirst( esc_html( $document ) ),0,1,'R');

			$pdf->SetFont('DejaVu','',10);

			if( $company_image != '') $pdf->Cell(27 ,5,'',0,0 );

			$pdf->CellFitScale(82 ,5, esc_html( $company_address ),0,0 );

			if( $company_image != '') {
				$pdf->CellFitScale(60 ,5,ucfirst( esc_html( $document ) ). ' ' . esc_html__( 'Date: ', 'crm-erp-business-solution' ) ,0,0,'R');
			}else $pdf->CellFitScale(87 ,5,ucfirst( esc_html( $document ) ). ' ' . esc_html__( 'Date: ', 'crm-erp-business-solution' ),0,0,'R');
				

			$pdf->Cell(20 ,5, esc_html( $creationdate ) ,0,1,'R');

			if( $company_image != '')  $pdf->Cell(27 ,5,'',0,0);

			if( $company_vat  != '' ) {	
				$pdf->CellFitScale(82 ,5, esc_html__( 'VAT: ', 'crm-erp-business-solution' ) . esc_html( $company_vat ), 0 ,0 );
			}else $pdf->Cell(82 ,5, '', 0 ,0 );

			if($args['type']!='offer'){
				
				if( $company_image != '') {
					$pdf->CellFitScale(60 ,5, esc_html( $document ).' #:',0,0,'R');
				}else $pdf->CellFitScale(87 ,5, esc_html( $document ).' #:',0,0,'R');
				
			}else	$pdf->Cell(60 ,5,'',0,0,'R');

			if($args['doc_id'] !='' ){
				if($args['type']!='offer'){
					$pdf->Cell(20 ,5, esc_html( $args['doc_id'] ) ,0,1,'R');
				}else	$pdf->Cell(20 ,5,'' ,0,1,'R');
			}else {
				if($args['type']!='offer'){
					$pdf->CellFitScale(20 ,5, esc_html( $id ) ,0,1,'R');
				}else	$pdf->Cell(20 ,5,'' ,0,1,'R');
			}



			if( $company_image != '') $pdf->Cell(27 ,5,'',0,0);

			$pdf->CellFitScale(82 ,5, esc_html( $company_phone ) . " " . esc_html( $company_mobile ),0,0 );

			if($status !='paid'){
				
				if($duedate !=''){
					
					if( $company_image != '') {
						$pdf->CellFitScale(60 ,5, esc_html__( 'Due Date: ', 'crm-erp-business-solution' ) ,0,0,'R');
					}else $pdf->CellFitScale(87 ,5, esc_html__( 'Due Date: ', 'crm-erp-business-solution' ) ,0,0,'R');
					
					$pdf->CellFitScale(20 ,5, esc_html( $duedate ) ,0,1,'R');
				
				}
				
			}else{
				
				if($paydate !=''){
					if( $company_image != '') {
						$pdf->CellFitScale(60 ,5, esc_html__( 'Payment Date: ', 'crm-erp-business-solution' ) ,0,0,'R');
					}else $pdf->CellFitScale(87 ,5, esc_html__( 'Payment Date: ', 'crm-erp-business-solution' ) ,0,0,'R');	

					$pdf->CellFitScale(20 ,5, esc_html( $paydate ) ,0,1,'R');
				}
			}


			$pdf->setFillColor( $headingsBackground['R'],$headingsBackground['V'],$headingsBackground['B'] );
			$pdf->setTextColor( $headingsColor['R'],$headingsColor['V'],$headingsColor['B'] );

			$pdf->Cell(0 ,10,'' ,0,1);
			$pdf->SetFont('DejaVu','B',10);

			if($args['type'] && $args['type']=='offer'){
				$pdf->CellFitScale(80 ,7, esc_html( $document ). esc_html__( 'To', 'crm-erp-business-solution' ) ,0,1,'L',1);
			}else $pdf->CellFitScale(80 ,7, esc_html__( 'Bill To', 'crm-erp-business-solution' ) ,0,1,'L',1);

			$pdf->setTextColor( $generalColor['R'],$generalColor['V'],$generalColor['B'] );


			$pdf->SetFont('DejaVu','',10);
			$pdf->CellFitScale(80 ,5, esc_html( $user_first_name . " " . $user_last_name ),0,1 );
			if(!empty($user_address)) $pdf->CellFitScale(80 ,5, wp_kses( $user_address . " " . $user_city  , CrmErpSolution::get_instance()->allowed_html ),0,1 );
			if(!empty($user_postcode))$pdf->CellFitScale(80 ,5, wp_kses( $user_postcode . " " . $user_country, CrmErpSolution::get_instance()->allowed_html ),0,1 );
			if(!empty($user_vat))$pdf->CellFitScale(80 ,5, esc_html__( 'VAT: ', 'crm-erp-business-solution' ) . esc_html( $user_vat ) ,0,1 );
			if(!empty($user_phone))$pdf->CellFitScale(80 ,5, esc_html__( 'PHONE: ', 'crm-erp-business-solution' ) . esc_html( $user_phone ),0,1 );


			$pdf->SetFont('DejaVu','B',10);
			$pdf->Cell(189 ,10,'',0,1);


			if($args['doc_type'] && $args['doc_type']== 2 ){
				$pdf->Cell(186 ,6, esc_html( $document ). ' ',1,1,'C',1);
				$pdf->SetFont('DejaVu','',10);
				$nb=$pdf->WordWrap( wp_kses( $args['description'], CrmErpSolution::get_instance()->allowed_html ),186 );
				$pdf->Cell(186 ,6,'',0,1,'C');
				$pdf->Write(5,$args['description']);
				
			}

			if($args['doc_type'] && $args['doc_type']== 1 && $args['parent'] != 0 ){
				
				$pdf->Cell(186 ,6, esc_html( $document ) . esc_html__( ' for Invoice #', 'crm-erp-business-solution' ) . esc_html( $invoicenr ),1,0,'C',1 );

			}

			if( isset( $args['doc_type'] ) && ( $args['doc_type'] != 1 || $args['parent'] == 0 ) ){
				
				$pdf->Cell(50 ,10,'',0,1);


				$pdf->SetTextColor( $headingsColor['R'],$headingsColor['V'],$headingsColor['B'] );	
				$pdf->SetFont('DejaVu','B',10);
				
				$pdf->CellFitScale(5 ,6,'AA',1,0,'C',1);
				$pdf->CellFitScale(20 ,6, esc_html__( 'SKU', 'crm-erp-business-solution' ) ,1,0,'C',1 );
				$pdf->CellFitScale(108 ,6, esc_html__( 'Description', 'crm-erp-business-solution' ),1,0,'C',1 );
				$pdf->CellFitScale(15 ,6, esc_html__( 'Qty', 'crm-erp-business-solution' ),1,0,'C',1 );
				$pdf->CellFitScale(15 ,6,esc_html__( 'Unit Price', 'crm-erp-business-solution' ),1,0,'C',1 );
				$pdf->CellFitScale(25 ,6,esc_html__( 'Total', 'crm-erp-business-solution' ),1,1,'C',1 );
				
				$pdf->SetFont('DejaVu','',10);
					$i=1;
				

				$pdf->setTextColor($generalColor['R'],$generalColor['V'],$generalColor['B']);

				foreach( $product as $prod => $n ) {
					$prodTotal = (int)$quantity[$prod] * (int)$amount[$prod];
					$unitprice = (int)$amount[$prod] / (int)$quantity[$prod] ;
					$pdf->CellFitScale(5 ,6,$i,1,0);
					$pdf->CellFitScale(20 ,6, esc_html( $sku[$prod] ),1,0 );
					$pdf->CellFitScale(108 ,6, esc_html( $n ),1,0 );
					$pdf->CellFitScale(15 ,6, esc_html( $quantity[$prod] ),1,0,'R' );
					$pdf->CellFitScale(15 ,6, esc_html( $unitprice . $currency ),1,0,'R' );
					$pdf->CellFitScale(25 ,6, esc_html( $amount[$prod]  . $currency ),1,1,'R' );
					$i++;
				}				
			}		

			$pdf->Cell(188 ,6,'',0,1);


			if( isset($args['doc_type']) && ( $args['doc_type'] != 1 || $args['parent'] === 0 ) ){

				$pdf->Cell( 133 ,6,'',0,0 );
				$pdf->SetFont('DejaVu','B',10 );
				$pdf->CellFitScale( 30 ,6,esc_html__( 'Subtotal', 'crm-erp-business-solution' ),0,0,'R');
				$pdf->SetFont('DejaVu','',10 );
				$pdf->Cell( 25 ,6, esc_html( $total . $currency ),0,1,'R');

				if( isset($args['shipping']) && !empty($args['shipping'])){
					$pdf->Cell( 133 ,6,'',0,0 );
					$pdf->SetFont('DejaVu','B',10 );
					$pdf->CellFitScale( 30 ,6,esc_html__( 'Shipping', 'crm-erp-business-solution' ),0,0,'R' );
					$pdf->SetFont('DejaVu','',10 );
					$pdf->Cell( 25 ,6, esc_html( $args['shipping'] . $currency ),0,1,'R' );	
				}

				if( !empty($discount)){
					$pdf->Cell(133 ,6,'',0,0);
					$pdf->SetFont('DejaVu','B',10);
					$pdf->CellFitScale(30 ,6,esc_html__( 'Discount', 'crm-erp-business-solution' ),0,0,'R' );
					$pdf->SetFont('DejaVu','',10);
					$pdf->Cell(25 ,6, esc_html( $discount . $currency ),0,1,'R' );
				}

				
				$pdf->Cell(133 ,6,'',0,0);
				$pdf->SetFont('DejaVu','B',10);
				$pdf->CellFitScale(30 ,6,esc_html__( 'Tax', 'crm-erp-business-solution' ),0,0,'R' );
				$pdf->SetFont('DejaVu','',10);
				$pdf->Cell(25 ,6, esc_html( $tax . $currency ),0,1,'R' );

			}



			if( $args['doc_type'] && $args['doc_type'] != 1 && $args['parent'] != 0 ){
				
				$pdf->Cell(133 ,6,'',0,0);
				$pdf->SetFont('DejaVu','B',10);	
				$pdf->CellFitScale(30 ,6,esc_html__( 'Total', 'crm-erp-business-solution' ),0,0,'R');
				$pdf->SetFont('DejaVu','',10);
				$pdf->Cell(25 ,6, esc_html( $grandtotal . $currency ),0,1,'R' );
			}ELSE{
				$pdf->Cell(133 ,6,'',0,0);
				$pdf->SetFont('DejaVu','B',10);
				$pdf->CellFitScale(30 ,6,esc_html__( 'Total', 'crm-erp-business-solution' ),0,0,'R');
				$pdf->SetFont('DejaVu','',10);
				$pdf->Cell(25 ,6, esc_html( $grandtotal . $currency ),0,1,'R');	
			}

			if( $args['type'] !='offer' ) {
				
				if($status !='paid'){
					$pdf->Cell(133 ,6,'',0,0);
					$pdf->SetFont('DejaVu','B',10);
					$pdf->CellFitScale(30 ,6,esc_html__( 'Balance', 'crm-erp-business-solution' ),0,0,'R' );
					$pdf->SetFont('DejaVu','',10);
					$pdf->Cell(25 ,6, esc_html( $balance . $currency ),0,1,'R' );
				}else{
					$pdf->Cell(133 ,6,'',0,0);
					$pdf->SetFont('DejaVu','B',10);
					$pdf->CellFitScale(30 ,6,esc_html__( 'Status', 'crm-erp-business-solution' ),0,0,'R' );
					$pdf->SetFont('DejaVu','',10);
					$pdf->Cell(25 ,6,'PAID',0,1,'R');
					
				}

			}

			if( $args['type'] !='offer' ) {
				
				$pdf->Cell(133 ,6,'',0,0);
				$pdf->Cell(30 ,6,'',0,0);
				$pdf->Cell(25 ,6,'',0,1,'R');

				if(!empty($payment_method)){
					$pdf->Cell(133 ,6,'',0,0);
					$pdf->SetFont('DejaVu','B',10);
					$pdf->CellFitScale(55 ,6, esc_html__( 'Payment Method ', 'crm-erp-business-solution' ) ,0,1,'R');
					$pdf->SetFont('DejaVu','',10);
					$pdf->Cell(133 ,6,'',0,0);
					$pdf->Cell(55 ,6, esc_html( $payment_method ),0,1,'R' );
				}
			}ELSE{
				
				if(!empty($payment_method)){
					$pdf->Cell( 25 ,6,'',0,0,'L' );
					$pdf->SetFont( 'DejaVu','B',10 );
					$pdf->CellFitScale( 30 ,6,esc_html__( 'Payment Method ', 'crm-erp-business-solution' ) ,0,0,'L' );
					$pdf->SetFont('DejaVu','',10);
					$pdf->Cell( 25 ,6, esc_html( $payment_method ),0,0,'L' );
				}
			}

			$pdf->Cell( 0 ,20,'',0,1 );

			if( $notes !='' && $args['type'] !='offer' ){
				

				$pdf->SetFillColor( $headingsBackground['R'],$headingsBackground['V'],$headingsBackground['B'] );

				$pdf->SetTextColor( $headingsColor['R'],$headingsColor['V'],$headingsColor['B'] );
				$pdf->SetFont( 'DejaVu','I',20 );
				$pdf->Cell( 90,10, esc_html__( 'Notes', 'crm-erp-business-solution' ) ,0,0,'L',1 );

			}

			if($thankyou !='' && $args['type'] !='offer' ){
				$pdf->SetFont( 'DejaVu','I',20 );
				$pdf->SetTextColor( $thankyouColor['R'],$thankyouColor['V'],$thankyouColor['B'] );
				 
				$pdf->Cell( 96,10,  wp_kses( $thankyou, CrmErpSolution::get_instance()->allowed_html ),0,1,'R' );
			}

			if($notes !='' && $args['type'] !='offer' ){
				
				$pdf->setTextColor( $generalColor['R'],$generalColor['V'],$generalColor['B'] );
				$pdf->SetFont( 'DejaVu','',10 );
				$pdf->Cell( 0 ,10,'',0,1 );

				$nb=$pdf->WordWrap( $notes,90 );
				$notes = $pdf->WriteHTML( wp_kses( $notes, CrmErpSolution::get_instance()->allowed_html ) );

			}

			$filename = "pdf-".$args['doc_id'].".pdf";
			if( $args['do'] == 'pdf' ){
				
				ob_get_clean();
				
				$pdf->Output( 'D',  $filename );
				
				$this->deleteFontFiles();				
				exit;


			}elseif( $args['do'] =='send' ){
				
				$filename = plugin_dir_path(__FILE__) . "pdf-". $args['doc_id'].".pdf";
				
				$pdf->Output('F', $filename, true ); // to parent/parent folder
				
				if( !isset( $args['woo'] ) ) $this->sendDocument( $args['id'], sanitize_text_field( $args['parent'] ) , sanitize_text_field( $args['doc_type'] ), sanitize_text_field( $args['document_type'] ) , $args['description'], sanitize_text_field( $args['doc_id'] ), sanitize_email( $args['user_email'] ) );
				
				
			}else return false;


			ob_end_flush(); 
			
				
			
		}

	}
		

		
	public function sendDocument( $id , $parent, $doc_type, $document_type, $description, $doc_id ,$user ){
			
			$mail_attachment = plugin_dir_path( __FILE__ )."pdf-".esc_html( $doc_id ).".pdf";
						
			$headers[] = "Content-Type: text/html; charset=UTF-8";
						
			if( !empty( get_option( 'crmerpbs_fromName' ) ) ){
				$fromname   = sanitize_text_field( get_option( 'crmerpbs_fromName' ) );
			}else $fromname = sanitize_text_field( get_bloginfo( 'name' ) );

			if( !empty( get_option( 'crmerpbs_fromEmail' ) ) ){
				$fromemail   = sanitize_text_field( get_option( 'crmerpbs_fromEmail' ) );
			}else $fromemail = sanitize_text_field( get_bloginfo( 'admin_email' ) );
								
			$headers[] = "From: ". esc_html( $fromname )." <". esc_html( $fromemail ).">";
					
			if( $doc_type == '2' ){
				$subject = sanitize_text_field( $document_type ) . esc_html__( " from ", 'crm-erp-business-solution' ).sanitize_text_field( get_option( 'crmerpbs_companyName' ) );
				$subject = wp_kses( $subject  , CrmErpSolution::get_instance()->allowed_html );
				$content = wp_kses( $description , CrmErpSolution::get_instance()->allowed_html );
			}elseif( $doc_type == '1' ){
				$subject = sanitize_text_field( $document_type ) . esc_html__( " for Invoice #", 'crm-erp-business-solution' ). sanitize_text_field( $parent )." | ".sanitize_text_field( get_option( 'crmerpbs_companyName' ) );
				$subject = wp_kses( $subject  , CrmErpSolution::get_instance()->allowed_html );
				$content = sanitize_text_field( $document_type ) . esc_html__( " for Invoice #", 'crm-erp-business-solution' ). sanitize_text_field( $parent )." | ".sanitize_text_field( get_option( 'crmerpbs_companyName' ) ). "<hr/><br/>". $description;
				$content = wp_kses( $content  , CrmErpSolution::get_instance()->allowed_html );
			}else{
				$subject = sanitize_text_field( $document_type ) . esc_html__( " #", 'crm-erp-business-solution' ). sanitize_text_field( $doc_id )."  | ".sanitize_text_field( get_option( 'crmerpbs_companyName' ) );
				$content = sanitize_text_field( $document_type ) . esc_html__( "#", 'crm-erp-business-solution' ). sanitize_text_field( $doc_id ) ."  | ".sanitize_text_field( get_option( 'crmerpbs_companyName' ) ). "<hr/>";	
				
				$subject = wp_kses( $subject  , CrmErpSolution::get_instance()->allowed_html );
				$content = wp_kses( $content  , CrmErpSolution::get_instance()->allowed_html );
			}
			
			$user = sanitize_email( $user ); 
			
			$send = wp_mail( $user , $subject, $content, $headers, $mail_attachment );
			
			if( isset( $_REQUEST['action'] ) && $_REQUEST['action'] =='redirect' ){
				$tab = sanitize_text_field( $_REQUEST['tab'] ) ;
			}else $tab='';
			
			if( !$send ) {	
				
				update_option( "crmerpbs_notice", array( 'notice' =>  esc_html__( "Error sending email to ", 'crm-erp-business-solution' ) .esc_html( $user ), 'type' => 'error', 'dismissible' => 'is-dismissible'  ) );
				wp_redirect( admin_url( "?page=crm-erp-business-solution&tab=". esc_html( $tab ) ) );
				
			}else {	
				unlink(  $mail_attachment  ); 

				update_option( "crmerpbs_notice", array( 'notice' =>  esc_html__( "Invoice sent to user with Email ", 'crm-erp-business-solution' ) .esc_html( $user ), 'type' => 'success', 'dismissible' => 'is-dismissible'  ) );
				wp_redirect( admin_url( "?page=crm-erp-business-solution&tab=". esc_html( $tab ) ) );
				
			}
			
			$this->deleteFontFiles();	

		}

								
	public function samplePdf(){
		
		if( is_admin() && current_user_can( 'crm-erp-business-solution' ) && isset( $_REQUEST['do'] ) && $_REQUEST['do'] == 'pdf' && wp_verify_nonce( $_REQUEST['_nonce'],  'crmerpbs_sample_pdf' ) ){
			
				$doc_id = sanitize_text_field( get_option( 'crmerpbs_invoiceTransPrefix' ). '1' );				
				$post_data['user'] =  sanitize_text_field( '' );
				$post_data['do'] =  sanitize_text_field( 'pdf' );		
				$post_data['doc_id'] = sanitize_text_field( '1' );
				$post_data['id'] = sanitize_text_field( '1' );
				$post_data['creationdate'] = date("d-m-Y") ;				
				$product = array('product 1','product 2','product 3');
				$quantity = array('1','1','1');
				$sku = array('prod1','prod2','prod3');
				$amount = array('40','30','30');				
				$post_data['total'] = sanitize_text_field( '100' ) ;
				$post_data['tax'] = sanitize_text_field( '24' );
				$post_data['grandtotal'] = sanitize_text_field( '114' );
				$post_data['discount'] = sanitize_text_field( '10' );
				$post_data['payment_method'] = esc_html__( 'Cash', 'crm-erp-business-solution' );
				$post_data['type'] = sanitize_text_field( 'saleinvoice' );
				$post_data['description'] = sanitize_text_field( '' );
				$post_data['doc_type'] = sanitize_text_field( 0 );				
				$post_data['document_type'] = sanitize_text_field( esc_html__( 'Invoice', 'crm-erp-business-solution' ) );
				$post_data['invoicenr'] = sanitize_text_field( '1' );
				$post_data['parent'] = '0';						 			
				$post_data['duedate'] = sanitize_text_field( '' );	
				$post_data['paydate'] = esc_html( date('d-m-Y') );	
				$post_data['balance'] = sanitize_text_field( '' );	
				$post_data['status'] = sanitize_text_field( 'paid' );					
				$post_data['user_first_name'] = sanitize_text_field( 'first_name' );
				$post_data['user_email'] = sanitize_text_field( 'user_email' );					
				$post_data['user_last_name'] = sanitize_text_field( 'user_last_name' );
				$post_data['user_vat'] = sanitize_text_field( 'user_vat' );						
				$post_data['user_address'] = sanitize_text_field( 'billing_address' );
				$post_data['user_city'] = sanitize_text_field( 'billing_city' );						
				$post_data['user_country'] = sanitize_text_field( 'billing_country' );
				$post_data['user_postcode'] = sanitize_text_field( 'user_postcode' );
				$post_data['user_phone'] = sanitize_text_field( 'user_phone' );					

				$this->generate( $post_data, $product, $quantity, $sku, $amount );
				
				$this->deleteFontFiles();	

		}
	}
	
	public function deleteFontFiles(){

			//if files from unifont created delete them - used in cases where user takes plugin zip from one site to other manually
			$location1 = plugin_dir_path( __FILE__ )."../topdf/font/unifont/dejavusans.cw.dat";	
			$location2 = plugin_dir_path( __FILE__ )."../topdf/font/unifont/dejavusans.mtx.php";	
			$location3 = plugin_dir_path( __FILE__ )."../topdf/font/unifont/dejavusans-bold.cw.dat";	
			$location4 = plugin_dir_path( __FILE__ )."../topdf/font/unifont/dejavusans-bold.mtx.php";	
			$location5 = plugin_dir_path( __FILE__ )."../topdf/font/unifont/dejavusans-oblique.cw.dat";	
			$location6 = plugin_dir_path( __FILE__ )."../topdf/font/unifont/dejavusans-oblique.mtx.php";	
			$location7 = plugin_dir_path( __FILE__ )."../topdf/font/unifont/dejavusans.cw127.php";
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
		
}