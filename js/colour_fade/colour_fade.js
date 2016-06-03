jQuery(document).ready( function(){
	jQuery( ".category article .entry-header" )
		.each(
			function(index,value){

				jQuery(value)
					.on("mouseenter", function() {
					
						color = jQuery( value )
							.parent()
							.css("background-color");
							
						color = jQuery( value )
							.parent()
							.css("background");
					
						jQuery( value )
							.parent()
							.attr("color", color);
					
						jQuery( value )
							.parent()
							.animate({
							  backgroundColor: muqaddimah_fade_to,
							}, 500 );

						event.stopPropagation();
					});
					
				jQuery(value)
					.on("mouseleave", function() {
						
						color = jQuery( value )
							.parent()
							.attr("color");
						
						jQuery( value )
						.parent()
						.animate({
						  backgroundColor: color,
						}, 500 );
				});
				
			}
		);	
});