<?PHP

	if(get_theme_mod("search")=="on"){

	?><div id="searchform">
		<form action="<?PHP echo home_url(); ?>" method="GET">
			<input type="text" class='muqaddimah_search_box' name="s" value="Search...." />
			<input type="submit" value="<?PHP echo __("search", "muqaddimah"); ?>" />
		</form>
	</div><?PHP
	
	}
	
?>