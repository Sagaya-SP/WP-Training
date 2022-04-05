<?php
/**
Template Name: Ajax Loader
*/
get_header();
?>
<div class="container">
	<div class="loader_div">
	<?php
		$args = array(  
		        'post_type' => array('page'),
		        'post_status' => 'publish',
		        'posts_per_page' => 2, 
		        'orderby' => 'title', 
		        'order' => 'ASC',
		    );

	$query = new WP_Query( $args );
		if($query->have_posts())
		{	
			while($query->have_posts())
			{
				$query->the_post();
				$post_id = get_the_ID();
				$post_title = get_the_title();
				$post_excerpt_highlight = search_excerpt_highlight();
				$post_title_hightlight = search_title_highlight();
				$post_link = get_the_permalink();
				echo '<div class="search_result">
				<a href="'.$post_link.'">'.$post_title_hightlight.'</a>
				</div>';
			}
		}	
?>
	</div>
	<button class="loader_click" data-load-next="2">Load Next Post</button>
</div>




<?php

echo do_shortcode('[custom_form]');


get_footer();
?>