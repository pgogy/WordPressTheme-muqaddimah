<?php

function muqaddimah_get_categories($id){

	$post_categories = wp_get_post_categories($id);
	$cats = array();
		
	foreach($post_categories as $c){
		$cat = get_category( $c );
		$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug, 'link' => get_category_link($c) );
	}
	
	return $cats;

}

function muqaddimah_get_categories_links($id){

	$html = array();
	$cats = muqaddimah_get_categories($id);
	
	foreach($cats as $cat){
		$html[] = "<a href='" . $cat['link'] ."'>" . $cat['name'] . "</a>";
	}
	
	
	if(count($html)==0){
		$html[] = _x("No Categories", "No Categories", "muqaddimah");
	}
	
	return $html;

}

function muqaddimah_body_class(){

	if(is_author()){
		return "author";
	}
	
}

function muqaddimah_get_tags($id){

	$post_tags = wp_get_post_tags($id);
	$cats = array();
		
	foreach($post_tags as $c){
		$cat = get_tag( $c );
		$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug, 'link' => get_tag_link($c) );
	}
	
	return $cats;

}

function muqaddimah_get_tags_links($id){

	$html = array();
	$cats = muqaddimah_get_tags($id);
	
	foreach($cats as $cat){
		$html[] = "<a href='" . $cat['link'] ."'>" . $cat['name'] . "</a>";
	}
	
	if(count($html)==0){
		$html[] = _x("No Tags", "No tags found", "muqaddimah");
	}
	
	return $html;

}

function muqaddimah_entry_meta() {
	
	?><div>
		<h6 class='meta_label'><?PHP echo _x('Categories', 'Categories', 'muqaddimah'); ?></h6><span><?PHP echo implode(" / ", muqaddimah_get_categories_links(get_the_ID())); ?></span>
	</div>
	<div>
		<h6 class='meta_label'><?PHP echo _x('Tags', 'Tags', 'muqaddimah'); ?></h6><span><?PHP echo get_the_tag_list(" ", " / ", " "); ?></span>
	</div>
	<?PHP if(get_theme_mod("author")=="on"){ ?>
	<div>
		<h6 class='meta_label'><?PHP echo _x('Author', 'Post Author', 'muqaddimah'); ?></h6><span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span></h6>
	</div>
	<div>
		<h6 class='meta_label'><?PHP echo _x('Published', 'Published', 'muqaddimah'); ?></h6><span><a href="<?php echo get_permalink( get_the_ID() ); ?>"><?php the_date(); ?></a></span></h6>
	</div>
	<?PHP
	}
	
}

function muqaddimah_post_title_background() {

	$hex = muqaddimah_hex2rgb(get_theme_mod("site_post_background_colour"));

	if(strlen(get_the_title())>50){ 
		$extra = "top:-20px; position: relative;";
	}else{
		$extra = "";
	}

	if(get_post_thumbnail_id(get_the_ID())!=""){
		?>margin-top:5px;  background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75); <?PHP echo $extra;		
	}else{

		global $post;
		$colour = get_post_meta($post->ID, "muqaddimah_post_colour", true);
		if($colour){
			?>background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75); <?PHP
			echo $extra;		
		}
	}
	
}

function muqaddimah_category_title_background($term) {

	$hex = muqaddimah_hex2rgb(get_theme_mod("site_post_background_colour"));

	$thumbnail = get_option( 'muqaddimah_picture_' . $term . '_thumbnail_id', 0 );
	
	if($thumbnail){
		
		?>margin-top: 10px; background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75); <?PHP		
	
	}else{

		$colour = get_option( 'muqaddimah_' . $term . '_colour');
		
		if($colour){
			
			?> background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.75); <?PHP		
		
		}
		
	}

}

function muqaddimah_post_colour_background() {

	global $post;
	$colour = get_post_meta($post->ID, "muqaddimah_post_colour", true);
	?> background-color:<?PHP echo $colour;?>; <?PHP
	
}

function muqaddimah_post_thumbnail() {

	if(get_post_thumbnail_id(get_the_ID())!=""){
		
		$id = get_the_ID();

		echo get_the_post_thumbnail($id, array(90,90), array("class" => "post-thumbnail-article"));
	
	}
	
}

function muqaddimah_post_thumbnail_background() {

	global $post;
	$colour = get_post_meta($post->ID, "muqaddimah_post_colour", true);
	?>margin-top: 10px; background-color:<?PHP echo $colour;?>; <?PHP
	
}

function muqaddimah_category_thumbnail_background($term) {

	$thumbnail = get_option( 'muqaddimah_picture_' . $term . '_thumbnail_id', 0 );
	
	if($thumbnail){
		
		?> background:url('<?PHP echo wp_get_attachment_url($thumbnail); ?>') 0px 0px / cover no-repeat; <?PHP
	
	}else{

		$colour = get_option( 'muqaddimah_' . $term . '_colour');
		
		if($colour){
			
			?> background:<?PHP echo $colour; ?>; <?PHP
		
		}
		
	}

}

function muqaddimah_header_image(){
	
	if(get_header_image()!=""){

		?> style="background:url('<?PHP header_image(); ?>') 0px 0px / cover no-repeat; height:300px" <?PHP
	
	}
	
}

function muqaddimah_archive_title(){

	if(isset($_GET['cat'])){
		$term = $_GET['cat'];
	}else{
		$term = get_term_by( "slug", $_GET['tag'], "post_tag" );
		$term = $term->term_id;
	}

	?><header class="page-header">
		<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			$thumbnail = get_option( 'muqaddimah_' . $term . '_thumbnail_id', 0 );
			if($thumbnail){
				$html = 'background:url(' . wp_get_attachment_url($thumbnail) . ') 0px 0px / cover no-repeat;';
				the_archive_description( '<div class="taxonomy-description"><div class="taxonomy_picture" style="' . $html . '"></div><div class="taxonomy_content">', '</div></div>' );
			}else{
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			}
		?>
	</header><?PHP

}

function muqaddimah_author_title(){

	?><header class="page-header">
		<?php
			echo '<h1 class="page-title">' . ucfirst(get_the_author_meta("display_name")) . '</h1>';
			if(get_the_author_meta("description")!=""){
				echo '<div class="taxonomy-description">' . get_the_author_meta("description") . '</div>';
			}
		?>
	</header><?PHP

}

function muqaddimah_child_categories(){

	?><footer class="page-footer">
		<h1 class="page-title"><?PHP echo _x('Related Categories', "Similar Categories", 'muqaddimah'); ?></h1>
		<div class="taxonomy-description"><?PHP
		
			$category = get_category($_GET['cat']);
			
			$childcats = get_categories('child_of=' . $category->parent . '&hide_empty=1&exclude=' . $_GET['cat']);
			$output = array();
			foreach ($childcats as $childcat) {
				if (cat_is_ancestor_of($ancestor, $childcat->cat_ID) == false){
					$output[] = '<a href="'.get_category_link($childcat->cat_ID).'">' . $childcat->cat_name . '</a>';
					$ancestor = $childcat->cat_ID;
				}
			}
			
			echo implode(" / ", $output);
			
		?></div>
	</footer><?PHP

}

function muqaddimah_posts_authors_list($type, $id){

	$the_query = new WP_Query( array($type => $id, 'posts_per_page' => 99) );
	
	$authors = array();

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$authors[] = get_the_author_meta('ID');
		}
	} 
	
	wp_reset_postdata();
	
	return $authors;
	
}

function muqaddimah_posts_authors_html($type, $id){

	$authors = array_unique(muqaddimah_posts_authors_list($type, $id));

	$output = array();
	foreach($authors as $author){
		$output[] = "<a href='" . get_author_posts_url($author) . "'>" . ucfirst(get_the_author_meta( 'display_name', $author )) . "</a>";
	}
	
	echo implode(" / ", $output);

}

function muqaddimah_post_authors($type, $id){
	?><footer class="page-footer">
		<h1 class="page-title"><?PHP echo _x('Authors', "WordPress authors", 'muqaddimah'); ?></h1>
		<div class="taxonomy-description" id='tag_cloud'><?PHP
		
			muqaddimah_posts_authors_html($type, $id);
			
		?></div>
	</footer><?PHP
}

function muqaddimah_posts_content($type, $id){

	$the_query = new WP_Query( array($type => $id, 'posts_per_page' => 99) );
	
	$content = "";

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$content .= str_replace("\r", "", str_replace("\n", "", str_replace(".", "", preg_replace("/(?![=$'%-])\p{P}/u", " ", strip_tags(strtolower(get_the_content()))))));
		}
	} 
	
	wp_reset_postdata();
	
	return $content;
	
}

function muqaddimah_tag_cloud($title, $content){
	?><footer class="page-footer">
		<h1 class="page-title"><?PHP echo $title; ?></h1>
		<div class="taxonomy-description" id='tag_cloud'><?PHP
		
			muqaddimah_tag_cloud_tags($content);
			
		?></div>
	</footer><?PHP
}

function muqaddimah_tag_cloud_tags($content){
	
	$words = explode(" ", $content);
	$words = array_filter($words);
	$words = array_slice($words, 0, max(100, (integer) (count($words) / 10)));

	?>
	<script src="<?PHP echo get_template_directory_uri(); ?>/js/tagcloud/d3.lib.js"></script>
	<script src="<?PHP echo get_template_directory_uri(); ?>/js/tagcloud/d3.tagcloud.js"></script>
	<script src="<?PHP echo get_template_directory_uri(); ?>/js/tagcloud/d3.click.js"></script>
	<script>
	  var fill = d3.scale.category20();
	  half_width = (jQuery('#tag_cloud').width()/2);
	  d3.layout.cloud().size([jQuery('#tag_cloud').width(), 300])
		  .words([
			<?PHP
				foreach($words as $word){
					if(trim($word)!="" && strlen($word) > 3){
						echo '"' . trim($word) . '",';
					}
				}
			?>
			].map(function(d) {
			return {text: d, size: 10 + Math.random() * 90};
		  }))
		  .padding(5)
		  .rotate(function() { return ~~(Math.random() * 2) * 90; })
		  .fontSize(function(d) { return d.size; })
		  .on("end", draw)
		  .start();
	  function draw(words) {
		d3.select("#tag_cloud").append("svg")
			.attr("width", jQuery('#tag_cloud').width())
			.attr("height", 300)
		  .append("g")
			.attr("transform", "translate(" + half_width + ",150)")
		  .selectAll("text")
			.data(words)
		  .enter()
		  .append("text")
			.style("font-size", function(d) { return d.size + "px"; })
			.style("cursor", "pointer")
			.attr("text-anchor", "middle")
			.attr("transform", function(d) {
			  return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
			})
			.text(function(d) { return d.text; });
	  }
	</script><?PHP
	
}

function muqaddimah_head_extra_js(){
	?>
		<script>
			var search_url = "<?PHP echo home_url() . "?s="; ?>";
			var muqaddimah_fade_to = "<?PHP echo get_theme_mod("site_fade_to_colour"); ?>";
		</script>
	<?PHP
}

function muqaddimah_featured_posts_content($type, $id){

	if($type == "category"){
		$new_type = "category__and";
		$id = array($id, get_option("muqaddimah_featured"));
		$the_query = new WP_Query( array($new_type => $id, 'posts_per_page' => 99) );
	}else{
		$the_query = new WP_Query( array($type => $id, 'posts_per_page' => 99, 'category__and' => get_option("muqaddimah_featured")) );
	}
	
	if ( $the_query->have_posts() ) {

		?><footer class="page-footer featured-content">
			<h1 class="page-title"><?PHP echo _x('Featured Content', "Content chosen to be featured", 'muqaddimah'); ?></h1>
		</footer>
		<div class="featured-content">
			<?PHP
				
				muqaddimah_featured_posts_content_html($the_query, $type);
				
			?>
		</div><?PHP
	
	}else{
	
		wp_reset_postdata();
	
	}
	
}

function muqaddimah_featured_posts_content_html($the_query, $type){

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			get_template_part("parts/content/content-" . $type);
		}
	} 
	
	wp_reset_postdata();
	
}