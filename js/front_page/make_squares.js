jQuery(document).ready( function(){
	jQuery( ".home article" )
		.each(
			function(index,value){
				width = jQuery(value).width();
				jQuery(value)
					.css("height", width);
				jQuery(value)
					.children()
					.first()
					.css("margin-top", ((width - 75) / 2));			
			}
		);

	}
);