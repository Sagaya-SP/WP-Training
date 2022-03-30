<?php

add_action( 'wp_ajax_nopriv_get_data', 'get_data' );
add_action( 'wp_ajax_get_data', 'get_data' );

function get_data() {
	global $wpdb;
	$page_no = $_POST['page_no'];
    echo '<br/>'.$page_no;
    $args = array(  
		        'post_type' => array('page'),
		        'post_status' => 'publish',
		        'posts_per_page' => 2, 
		        'orderby' => 'title', 
		        'order' => 'ASC',
		        'paged' => $page_no, 
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
    die();
    }

?>