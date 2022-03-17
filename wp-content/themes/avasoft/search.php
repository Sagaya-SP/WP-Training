<?php
get_header();
global $query_string;

wp_parse_str( $query_string, $search_query );
$search_keyword = $search_query['s'];

$args = array(  
        'post_type' => array('post','page'),
        'post_status' => 'publish',
        'posts_per_page' => 10, 
        'orderby' => 'title', 
        'order' => 'ASC',
        's' => $search_keyword,
    );


$search = new WP_Query( $args );
if($search->have_posts())
{
	while($search->have_posts())
	{
		//the_post();
		$search->the_post();
		$post_id = get_the_ID();
		$post_title = get_the_title();
		$post_excerpt_highlight = search_excerpt_highlight();
		$post_title_hightlight = search_title_highlight();
		$post_link = get_the_permalink();
		echo '<div class="search_result">
		<a href="'.$post_link.'">'.$post_title_hightlight.'</a>
		<span class="desc">'.$post_excerpt_highlight.'</span>
		</div>';
	}
}
else
{
	echo '<h2>No Search Results Found</h2>';
}
get_footer();
?>