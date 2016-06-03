jQuery(document).ready( function(){
	jQuery( "#show_comment_area" )
		.on("click", function(event){
				if(jQuery("#comments").is(":visible")){
					jQuery("#comments")
						.slideUp(500);
					jQuery( "#show_comment_area" )
						.html("+ Show Comments");
				}else{
					jQuery("#comments")
						.slideDown(500);
					jQuery( "#show_comment_area" )
						.html("- Hide Comments");
				}
			}
		);

	}
);