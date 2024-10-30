(function( $ ) {

	/*DATEPICKER*/
    $('.datepicker').datepicker({
	   dateFormat: 'yy-mm-dd',
       showButtonPanel: true
    });	

	
    $(".crmerpbs #tabs").tabs();
	$(".crmerpbs .subtabs").tabs();	 
    $(".crmerpbs #accordion" ).accordion();

		$("#crmerpbs button.proVersion, #crmerpbs input.proVersion ").click(function(e){
			window.open( crmerpbs.proAddon, '_blank');

		});
		$("#crmerpbs button.wooVersion").click(function(e){
			window.open( crmerpbs.wooAddon, '_blank');

		});		
		//INTRO
		$("#crmerpbsmodal .crmerpbsclose").click(function(e){
			e.preventDefault();
			$("#crmerpbsmodal").fadeOut();
			localStorage.setItem('hideIntro', '1');

		});		

		var modal = document.getElementById('crmerpbsmodal');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target === modal) {
				modal.style.display = "none";
				localStorage.setItem('hideIntro', '1');
			}
		}
		
		$(".openIntro").click(function(e){
			e.preventDefault();
			$("#crmerpbsmodal").fadeIn();
		});	

	
		//EXTENSIONS
		$(".crm_extensions").click(function(e){
			e.preventDefault();
			
			if( $('#crmerpbs_extensions_popup').length > 0 ) {
			
				$(".crmerpbs .get_ajax #crmerpbs_extensions_popup").fadeIn();
				
				$("#crmerpbs_extensions_popup .crmerpbsclose").click(function(e){
					e.preventDefault();
					$("#crmerpbs_extensions_popup").fadeOut();
				});		
				var extensions = document.getElementById('crmerpbs_extensions_popup');
				window.onclick = function(event) {
					if (event.target === extensions) {
						extensions.style.display = "none";
						localStorage.setItem('hideIntro', '1');
					}
				}					
			}else{
				var action = 'extensions';
				$.ajax({
					type: 'POST',
					url: crmerpbs.ajax_url,
					data: { 
						"action": action
					},							
					 beforeSend: function(data) {								
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$('.crmerpbs').addClass('loading');
					},								
					success: function (response) {
						$('.crmerpbs').removeClass('loading');
						if( response !='' ){
							$('.crmerpbs .get_ajax' ).css('visibility','hidden');
							$('.crmerpbs .get_ajax' ).append( response );
							$('.crmerpbs .get_ajax #crmerpbs_extensions_popup' ).css('visibility','visible');
							$(".crmerpbs .get_ajax #crmerpbs_extensions_popup").fadeIn();
							
							$("#crmerpbs_extensions_popup .crmerpbsclose").click(function(e){
								e.preventDefault();
								$("#crmerpbs_extensions_popup").fadeOut();
							});		
							var extensions = document.getElementById('crmerpbs_extensions_popup');
							window.onclick = function(event) {
								if (event.target === extensions) {
									extensions.style.display = "none";
									localStorage.setItem('hideIntro', '1');
								}
							}							
						}
					},
					error:function(response){
						console.log('ERROR');
					}
				});			
			}
		});	
		

			



		

		//get Users with Ajax
		
		if (  $('.crmerpbs_title').length > 0 && ( window.location.href.indexOf("sales") !== -1  || window.location.href.indexOf("offers") !== -1  || window.location.href.indexOf("crmerpbs_app") !== -1 || window.location.href.indexOf("payments") !== -1  && window.location.href.indexOf("new") !== -1  || window.location.href.indexOf("edit") !== -1 ) || ( window.location.href.indexOf("crmpro_appointments") !== -1 ) && window.location.href.indexOf("user") == -1 ) {
			
			if (window.location.href.indexOf("sales") !== -1 ){
				var action = 'getCustomers';
			}else if (window.location.href.indexOf("offers") !== -1 || window.location.href.indexOf("crmerpbs_app") !== -1 ){
				var action = 'getUsers';				
			}else if (window.location.href.indexOf("payments") !== -1 ){
				var action = 'getVendors';
			}else var action = 'getUsers';
			
			if ( window.location.href.indexOf("user") !== -1   ){
				// if get parameter is passed for user we do not mess with ajax
				
			}else{
			
			
				$.ajax({
					type: 'POST',
					url: crmerpbs.ajax_url,
					data: { 
						"action": action
					},							
					 beforeSend: function(data) {								
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$('.crmerpbs').addClass('loading');
					},								
					success: function (response) {
						$('.crmerpbs').removeClass('loading');
						if( response !='' ){
							$("#user").html(response).show();
							
							if(  $("#user").find('option').length === 1  ){
								
							}else if(  $("#user").find('option').length >=2 ){	
								$("#user").select2();
							}else if(  $("#user").find('option').length === 0  ){
								$("#user").hide();
								if(window.location.href.indexOf("new") !== -1 ){
									//alert('no user found');
								}
							}
							
						}
					},
					error:function(response){
						console.log('ERROR');
					}
				});
			
			}
		}
		
		
		//get Products with Ajax 
				
		function delay(callback, ms) {
		  var timer = 0;
		  return function() {
			var context = this, args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
			  callback.apply(context, args);
			}, ms || 0);
		  };
		}	
		
		$(".productsearch").on('click',function() {
			$(this).find(".prodWrap").closest( "#searchproduct" ).focus();
		});
		$("#searchproduct").on('keyup', delay(function (e) {
			$(this).closest(".prodWrap").addClass('active');
				var datastring = 'action=displayProducts';
				var product = $(this).val();
				$.ajax({
					type: 'POST',
					url: crmerpbs.ajax_url,
					data: { 
						"action": "displayProducts",
						"searchproduct": product,
						"element": $(this).val()
					},							
					 beforeSend: function(data) {								
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$('.crmerpbs').addClass('loading');
					},								
					success: function (response) {
						$('.crmerpbs').removeClass('loading');
						if( response !='' ){
							
							$(".prodWrap.active #product").html(response).show();
							
							if( $(".prodWrap.active #product").find('option').length > 1 ){
								
								$('.prodWrap.active #product').prepend("<option selected value=''>"+crmerpbs.select+"</option>"); 
							}         
                                 
							if(  $(".prodWrap.active #product").find('option').length === 1  ){
								$(".prodWrap.active #product").trigger('change');
							}else if(  $(".prodWrap.active #product").find('option').length === 0  ){
								$(".prodWrap.active #product").hide();
								//alert('no product found');
							}else if( $(".prodWrap.active #product").find('option').length >= 7 ){
								$(".prodWrap.active #product").select2();
							}
							
							$(".prodWrap").removeClass('active');						
						}
					},
					error:function(response){
						console.log('ERROR');
					}
				});   
				
		}, 500));


		$("#product").on( "change",function(){	
			$(this).closest(".prodWrap").find("#searchproduct").val( $("option:selected", this).html() );
			$(this).hide();
			$(this).closest(".prodWrap").find(".select2").hide();
			//if ($(this).hasClass("select2-hidden-accessible")) $(this).select2('destroy'); 
		});	
	
	//activate select2 on specific 
	$( ".crmerpbs .select2, .crmerpbs #user_product:not(.noselect) , .crmerpbs #cat" ).select2();
	if( $('.crmerpbs #parent').is(':hidden') ){
	}else $('.crmerpbs #parent').select2();
	
	$( document ).ajaxStop(function() {
		checkModal();
	});

	function checkModal(){
		if( localStorage.getItem("crmModal" ) ){
			$(".goFull").hide();
			$(".closeFull").show();
		}
	}
	checkModal();

	$(".goFull").on("click",function(){
		localStorage.setItem("crmModal", '1');
		$(this).hide();
		$(".closeFull").show();		
		$("#collapse-button").trigger("click");
	});
	$(".closeFull").on("click",function(){
		$(".goFull").show();
		$(this).hide();
		$("#collapse-button").trigger("click");
		localStorage.removeItem("crmModal" );
	});	


  //COMPANY IMAGE UPLOAD IN GENERAL SETTINGS
	  var mediaUploader;

	  $('#crmerpbs_companyImage').click(function(e) {
		e.preventDefault();
		// If the uploader object has already been created, reopen the dialog
		  if (mediaUploader) {
		  mediaUploader.open();
		  return;
		}
		// Extend the wp.media object
		mediaUploader = wp.media.frames.file_frame = wp.media({
		  title: 'Choose Image',
		  button: {
		  text: 'Choose Image'
		}, multiple: true });
		
		mediaUploader.on('select', function() {
			
			var crmerpbs_attachment = mediaUploader.state().get('selection').toJSON();
			
			var crmerpbs_pics_array_url = [];
			
			$.each(crmerpbs_attachment, function() {
				crmerpbs_pics_array_url.push(this.url);
				$('.uploader_p').html("<img src='"+this.url+"'  width='100' />");
			});	 
			
			$('.removeImage').css('display','block');
			$(".existing").show();
			$(".uploader_p").show();		
			

			$(".crmerpbs_pics_url").each(function(i) {
			   $(this).val(crmerpbs_pics_array_url[i]);
			   
				$('.existing').css('display','none');
			});					
		});	
		

		// Open the uploader dialog
		mediaUploader.open();
		
	  });
  
  //REMOVE IMAGE IN SETTINGS 
	 $(".crmerpbs .removeImage").on('click',function(e){
		 e.preventDefault();
		$(".crmerpbs_pics_url").val('');
		$(".existing").hide();
		$(".uploader_p").hide();
		$(this).hide();
	  });
  
		$( "#crmerpaccordion" ).accordion({
			collapsible: true
		});
	
    $(function() {
        $('.crmerpbs .color').wpColorPicker();
    });


	
	//initialise total start
	
	totalAmount = $("#total").val();
	vatPercent = crmerpbs.vat / 100;
		
		
		
		var totalDiscount = $(".crmerpbs #totaldiscount").val();
		var discount = 0;
		var  sum = 0;
		
		$(".price").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				sum += !isNaN( val ) ? val : 0;
			}
		});		
		
		$(".discount").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				discount += !isNaN( val ) ? val : 0;
			}
		});
		total = (sum-discount) - totalDiscount;

	
		$("#total").val(total);
		$("#tax").val(total * vatPercent);
		$("#grandtotal").val( (total * vatPercent) + total );
	
	
	$(".crmerpbs #product").on("change",function(){
		
		if (window.location.href.indexOf("sales") !== -1) {

				if(  $("option:selected", this).attr('stock') !=''  && $("option:selected", this).attr('stock') <=0  ){
					
					if(confirm("This product is out of stock, you still want to use?")){
						$(this).closest('.prodWrap').find(".price").removeAttr('disabled');
						$(this).closest('.prodWrap').find(".quantity").removeAttr('disabled');	
						$(this).closest('.prodWrap').find(".discount").removeAttr('disabled');			
						$(this).closest('.prodWrap').find(".quantity").val('1');
						$(this).closest('.prodWrap').find(".price").val($("option:selected", this).attr('price') );
						$(this).closest('.prodWrap').find(".price").removeAttr('max');
						$(this).closest('.prodWrap').find(".quantity").removeAttr('max');
					}else{
						$(this).closest('.prodWrap').find(".quantity").val('0');
						$(this).closest('.prodWrap').find(".quantity").attr('max','0');
						$(this).closest('.prodWrap').find(".price").val("0");
						$(this).closest('.prodWrap').find(".price").attr('disabled','disabled');
						$(this).closest('.prodWrap').find(".quantity").attr('disabled','disabled');
						$(this).closest('.prodWrap').find(".discount").attr('disabled','disabled');
						$(this).closest('.prodWrap').find(".price").attr('max','0');						
					}

				}else{
					$(this).closest('.prodWrap').find(".quantity").val('1');
					$(this).closest('.prodWrap').find(".price").val($("option:selected", this).attr('price') );
				}				
		
		}else{			
				$(this).closest('.prodWrap').find(".quantity").val('1');
				$(this).closest('.prodWrap').find(".price").val($("option:selected", this).attr('price') );
		}
		


		
		totalDiscount = $(".crmerpbs #totaldiscount").val();
		var sum = 0;
		var discount = 0;
		
		
		$(".price").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				sum += !isNaN( val ) ? val : 0;
			}
		});
		
		
		$(".discount").each(function(){

			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				discount += !isNaN( val ) ? val : 0;
			}
		});
		
		total = (sum-discount) - totalDiscount;	
		$("#total").val(total);
		$("#tax").val(total * vatPercent);
		$("#grandtotal").val( (total * vatPercent) + total );
	});
	
	
	$(".crmerpbs #totaldiscount").on("change",function(){
		
			var sum = 0;
			var discount = 0;
			$(".price").each(function() {
				var val = $.trim( $(this).val() );
				if ( val ) {
					val = parseFloat( val.replace( /^\$/, "" ) );
					sum += !isNaN( val ) ? val : 0;
				}
			});
			totalAmount = sum;	
			$("#total").val(totalAmount);
			
			$(".discount").each(function(){
				var val = $.trim( $(this).val() );
				if ( val ) {
					val = parseFloat( val.replace( /^\$/, "" ) );
					discount += !isNaN( val ) ? val : 0;
				}
			});
			
			totalAmount = sum-discount;
			
			var discount=$(this).val();
			total = totalAmount-discount;
			
			totalAmount = total;
			$("#total").val(totalAmount);
	
			$("#tax").val(totalAmount * vatPercent);
			$("#grandtotal").val( (totalAmount * vatPercent) + totalAmount );	
	});

	
	$(".crmerpbs .quantity").on("change",function(){		
		var price= $(this).closest('.prodWrap').find("option:selected").attr('price') ;
		var newprice=0;	
		var discount=0;	
		totalDiscount = $(".crmerpbs #totaldiscount").val();
		
		if( $(".crmerpbs #product option:selected", this).attr('stock') <=0 ){
			newprice = 0;
		}else newprice = price * $(this).val();
		
		$(this).closest('.prodWrap').find(".price").val( newprice );

		var sum = 0;
		$(".price").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				sum += !isNaN( val ) ? val : 0;
			}
		});
		
		$(".discount").each(function(){
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				discount += !isNaN( val ) ? val : 0;
			}
		});

		totalAmount = (sum-discount) - totalDiscount;		
		$("#total").val(totalAmount);	
		$("#tax").val(totalAmount * vatPercent);
		$("#grandtotal").val( (totalAmount * vatPercent) + totalAmount );		
	});
	
	
	$(".crmerpbs .price").on("change",function(){		
		var sum = 0;
		var discount = 0;
		totalDiscount = $(".crmerpbs #totaldiscount").val();
		
		$(".price").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				sum += !isNaN( val ) ? val : 0;
			}
		});

		$(".discount").each(function(){
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				discount += !isNaN( val ) ? val : 0;
			}
		});
		
		total = (sum-discount) - totalDiscount;		
		$("#total").val(total);	
		$("#tax").val(total * vatPercent);
		$("#grandtotal").val( (total * vatPercent) + total );
	});

	$(".crmerpbs .discount").on("change",function(){	

		totalDiscount = $(".crmerpbs #totaldiscount").val();
		var discount = 0;
		var  sum = 0;
		
		$(".price").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				sum += !isNaN( val ) ? val : 0;
			}
		});		
		
		$(".discount").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				discount += !isNaN( val ) ? val : 0;
			}
		});
						
		total = (sum-discount) - totalDiscount;		

		$("#total").val(total);
		$("#tax").val(total * vatPercent);
		$("#grandtotal").val( (total * vatPercent) + total );
	});


	$(".crmerpbs #tax").on("change",function(){	

		totalDiscount = $(".crmerpbs #totaldiscount").val();
		var discount = 0;
		var  sum = 0;
		
		$(".price").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				sum += !isNaN( val ) ? val : 0;
			}
		});		
		
		$(".discount").each(function() {
			var val = $.trim( $(this).val() );
			if ( val ) {
				val = parseFloat( val.replace( /^\$/, "" ) );
				discount += !isNaN( val ) ? val : 0;
			}
		});
						
		total = (sum-discount) - totalDiscount;		

		$("#total").val(total);
		$("#grandtotal").val( parseInt(total) + parseInt($(this).val()) );
	});

	
	$(".crmerpbs #paid").on("change",function(){
		
		if( $(this).val() !='' ){
			$(".crmerpbs #paydate").prop('required', true );
		}else $(".crmerpbs #paydate").prop('required', false );
		
	});
	
	  $(".crmerpbs .plus").on('click', function(){
		var numItems = $('.prodWrap').length;
		if(numItems<106){
			
		   $(".crmerpbs .prodWrap").find(".select2").each(function(index)
			{
				if ($(this).data('select2')) {
					$(this).select2('destroy');
				  } 
			});		
			
			var ele = $(this).closest('.prodWrap').clone(true);
			
			
			
			$('#product',ele).attr('name','product'+numItems);
			$('#product',ele).val('');

			$('.quantity',ele).attr('name','quantity'+numItems);
			$('.quantity',ele).val('1');

			$('.price',ele).attr('name','price'+numItems);
			$('.price',ele).val('');
			
			$('.discount',ele).attr('name','proddiscount'+numItems);
			$('.discount',ele).val('');

            $(ele).attr('name','prod'+numItems);
            
			$('.minus',ele).css('visibility','visible');
			
			$('#searchproduct',ele).val('');
			$('#product',ele).css('display','none');
			
			$(this).closest('.prodWrap').after(ele);
			
			
			$(this).css('visibility','hidden');	
						
			
		}else $(this).css('visibility','hidden');		
	  });
	  
	  $(".crmerpbs .minus").on('click', function(){
		  
			var ele = $(this).closest('.prodWrap').remove();
			var numItems = $('.prodWrap').length;

			
			if(numItems<106){
				$(this).css('visibility','visible');
			}
			
			if(numItems === 1){				
				$(".crmerpbs .plus").css('visibility','visible');
				$(".crmerpbs .plus").show();					
			}
			
			if(numItems === 2){	
				$('input[name=price1]').closest('.prodWrap').find('.plus').css('visibility','visible');			
			}

	  });


	  $(".crmerpbs .plusSetting").on('click', function(){
		var numItems = $(this).closest('div').length;
		if(numItems<6){
			var ele = $(this).closest('div').clone(true);			
			
			$(".multipleInput",ele).val('');
			
			$('.minusSetting',ele).css('visibility','visible');
			
			$(this).closest('div').after(ele);
			
			$(this).css('visibility','hidden');		
		}else $(this).css('visibility','hidden');		
	  });
	  
	  $(".crmerpbs .minusSetting").on('click', function(){
		  
			var ele = $(this).closest('div').remove();
			var numItems = $('div').length;
			
			if(numItems<6){
				$(this).css('visibility','visible');
			}
			
			if(numItems === 1){				
				$(".crmerpbs .plusSetting").css('visibility','visible');
				$(".crmerpbs .plusSetting").show();					
			}

	  });

	
	$(".parentWrap ").hide();
	$(".duedateWrap ").hide();
	$(".paidWrap ").hide();

	
	$(".crmerpbs #type").on("change",function(){
		
		
		if( $(this).val() !='saleinvoice' && $(this).val() !='payinvoice' && $(this).val() !='offer' ){
			$(".userWrap ").hide();
			$(".duedateWrap ").hide();
			$(".discountWrap ").hide();	
			$(".parentWrap ").show();
			$(".paidWrap ").hide();
			
		}else{
			$(".userWrap ").show();
			$(".duedateWrap ").show();
			$(".discountWrap ").show();	
			$(".parentWrap ").hide();
			$(".paidWrap ").show();	
	
		}
		if( $(".crmerpbs #type").val() ==='offer'){
			$(".paidWrap ").hide();	
		}		
		
	});
	

	var element = $(".crmerpbs #parent").find('option:selected'); 
	var balance = element.attr("balance");
	
	var user = element.attr("user");
	
	if( user !='' ){
		$("#user").attr("val", user );
	}		
	if( balance !='' ){
		$("#total").attr("max", balance );
	}
	var newelement = $(".crmerpbs #parent");
	var balance2 = newelement.attr("balance");
	if( balance2 !='' ){
		$("#total").attr("max", balance2 );
		$("#total").attr("val", balance2 );
	}
	
	$(".crmerpbs #parent").on("change",function(){
		if( $(this).val() !='' ){
			$(".prodWrap ").hide();	

			var element = $(this).find('option:selected'); 
			var balance = element.attr("balance");
			var user = element.attr("user");
			
			if( user !='' ){
				$("#user").val( user );
			}

			
			if( balance !='' ){
				$("#total").attr("max", balance );
			}
			
		}else $(".prodWrap ").show();	
	});




	$("#total").on("change",function(){
		var value = parseInt($(this).val() );
		var max = parseInt($(this).attr('max'));
		//if (typeof max !== typeof undefined && max !== false) {
			if(max < value ){
				$(this).val(max) ;
				alert("Maximum is " + max);
			}
		//}
	});
			
	
	$(window).load(function() {
		
		var numItems = $('.prodWrap').length;
		if(numItems===1){
			$('.plus').css('visibility','visible');
		}

		var numItems = $('.multipleItems').length;
		if(numItems===1){
			$('.minusSetting').css('visibility','visible');
		}

		var typVal = $(".crmerpbs #type").val(); 

	
		if( typVal !='saleinvoice'  && typVal !='payinvoice'  && typVal !='offer'){
			$(".userWrap ").hide();
			$(".duedateWrap ").hide();
			$(".discountWrap ").hide();	
			$(".parentWrap ").show();
			//$(".paidWrap ").hide();
			$(".prodWrap ").hide();				
		}else{
			$(".userWrap ").show();
			$(".duedateWrap ").show();
			$(".discountWrap ").show();	
			$(".parentWrap ").hide();	
			$(".paidWrap ").show();	
			$(".prodWrap ").show();	
		}

		if( $(".crmerpbs #type").val() ==='offer'){
			$(".paidWrap ").hide();	
			$(".duedateWrap ").hide();
		}

		$('.crmerpbsForm td.column-balance').each(function() {
			balance  = 	$(this).text();
			if (balance > 0 ){
				$(balance).css('color','red');
			}			
		});

		
	});

	
	$(".segments , .roles, .products, .wooCalendar .categorys , .wooCalendar .users ").hide();
	$(".toSelect").val($(".toSelect option:first").val());
	 var email_select_user = $(".email_select_user").find('option:selected');
	 userValue = $(email_select_user).val() ;
	 if(userValue){
		 //alert(userValue);
		$(".user_selection").hide();
		 $( "."+userValue+"s" ).show();		 
	 }


	$(".email_select_user").on('change',function(){
		val=$(this).val();
		
		$(".user_selection").hide();
		$( "."+val +"s").show();
		$(".toSelect").val($(".toSelect option:first").val());
		
		
		if(val=='product'){

			if (window.location.href.indexOf("eshop") !== -1 ){
				var action = 'getEshopProducts';
			}else if (window.location.href.indexOf("sales") !== -1 ){
				var action = 'getTransactionProducts';				
			}else if (window.location.href.indexOf("payments") !== -1 ){
				var action = 'getTransactionProducts';
			}else var action = 'getProducts';
			
				$.ajax({
					type: 'POST',
					url: crmerpbs.ajax_url,
					data: { 
						"action": action,
						//"searchproduct": product
					},							
					 beforeSend: function(data) {								
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$('.crmerpbs').addClass('loading');
						
					},								
					success: function (response) {
						$('.crmerpbs').removeClass('loading');
						if( response !='' ){
							$("#user_product").html(response).show();
							
							if(  $("#user_product").find('option').length === 1  ){
								$("#user_product").show();
							}else if(  $("#user_product").find('option').length === 0  ){
								$("#user_product").hide();
								alert('no product found');
							}
							
						}
					},
					error:function(response){
						console.log('ERROR');
					}
				});
				
		}
		if(val=='user'){
			
			if (window.location.href.indexOf("sales") !== -1 ){
				var action = 'getCustomers';
			}else if (window.location.href.indexOf("payments") !== -1 ){
				var action = 'getVendors';
			}else var action = 'getUsers';
			
				$.ajax({
					type: 'POST',
					url: crmerpbs.ajax_url,
					data: { 
						"action": action
					},							
					 beforeSend: function(data) {								
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$('.crmerpbs').addClass('loading');
					},								
					success: function (response) {
						$('.crmerpbs').removeClass('loading');
						if( response !='' ){
							$("#user").html(response).show();
							
							if(  $("#user").find('option').length === 1  ){
								
							}else if(  $("#user").find('option').length >= 2  ){	
								$("#user").select2();
							}else if(  $("#user").find('option').length === 0  ){
								$("#user").hide();
								alert('no user found');
							}
							
						}
					},
					error:function(response){
						console.log('ERROR');
					}
				});			
		}
		
	});
	

	//CALENDAR OF EVENTS
	$(".calendar_toggler").on("click",function(){
		$("#calendar").slideToggle();
		$("#reponse").slideToggle();
	});
	$(".list_toggler").on("click",function(){
		$("#calendar").hide();
		$("#reponse").hide();
	});
	
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header :{
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },		
        events: jQuery.parseJSON(crmerpbs.events),
        displayEventTime: true,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: false,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
			

				var ajax_options = {
					action: 'addEvent',
					data: 'title=' + title + '&start=' + start + '&end=' + end,
					nonce: 'addEvent',
					url: crmerpbs.ajaxurl,
				};			
				
				$.post( crmerpbs.ajaxurl, ajax_options, function(data) {
					console.log(data);
					displayMessage("Added Successfully");
				});
				
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },
        
        editable: false,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
							console.log(response);
                            displayMessage("Updated Successfully");
                        }
                    });
                },
    });

	function displayMessage(message) {
			$(".response").html("<div class='success'>"+message+"</div>");
		setInterval(function() { $(".success").fadeOut(); }, 1000);
	}

	/*	REPORTS	*/
	load();
	$( document ).ajaxComplete(function() {
	  load();
	});

	function load(){


		/*DATEPICKER*/
		$('.crmerpbs .datepicker').datepicker({
		   //dateFormat: 'yy-mm-dd', //maybe you want something like this
		   dateFormat: 'dd-mm-yy',
			showButtonPanel: true
		});
		
		/*ACTIVATE ACCORDION*/
			$( ".crmerpbs  #accordion" ).accordion({
				collapsible: true
			});
			
		/*ACTIVATE TABS*/
			$( ".crmerpbs #tabs" ).tabs();
			$( ".crmerpbs #tabs2" ).tabs();
			$( ".crmerpbs #tabs3" ).tabs();
	}
	
	
 		$("#crmerpbs_signup").on('submit',function(e){
			e.preventDefault();	
			var dat = $(this).serialize();
			$.ajax({
				
				url:	"https://extend-wp.com/wp-json/signups/v2/post",
				data:  dat,
				type: 'POST',							
				beforeSend: function(data) {								
						console.log(dat);
				},					
				success: function(data){
					alert(data);
				},
				complete: function(data){
					dismiss();
				}				
			});	
		});
		

		function dismiss(){
			
				var ajax_options = {
					action: 'push_not',
					data: 'title=1',
					nonce: 'push_not',
					url: crmerpbs.ajax_url,
				};			
				
				$.post( crmerpbs.ajax_url, ajax_options, function(data) {
					$(".crmerpbs_notification").fadeOut();
				});
				
				
		}
		
		$(".crmerpbs_notification .dismiss").on('click',function(e){
				dismiss();
				console.log('clicked');
				
		});		
			
})( jQuery )	