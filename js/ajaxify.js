(function( $ ) {
		
	ajaxify();

	function ajaxify(){

		
		$( ".crmerpbs form.ajaxify" ).submit(function(e){
			
			e.preventDefault();
			
					var data = $(this).serialize();
					$.ajax({
						type: 'POST',
						url: window.location.href,
						data: data,	
						 beforeSend: function(data) {								
							//$("html, body").animate({ scrollTop: 0 }, "slow");
							$('.crmerpbs').addClass('loading');
						},								
						success: function (response) {
							$('.crmerpbs').removeClass('loading');
							if( response !='' ){
								$( "body" ).html( response );
						
							}
						},
						error:function(response){
							console.log('error');
						}
					});						
		});
		
	}

})( jQuery )	