<?php
	
	if ( has_nav_menu( "primary" ) ) {
		
		?><nav id="primary-navigation" class="site-navigation nav-menu-standard" role="navigation"><?PHP

		wp_nav_menu( 
				array( 
					'theme_location' => 'primary', 
					'menu_class' => 'nav-menu-standard',
					'walker' => new Walker_Menu(),
				)
			);

		?></nav><?PHP
				
	}

?>