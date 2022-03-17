<?php
//Page template goes here
get_header();
//echo 'Default Template got invoked';
global $wpdb,$post;
$post_id = get_the_ID();
$post_title = get_the_title();
$post_content = get_the_content();
$permalink = get_the_permalink();
echo $permalink;
//get_search_form(); 


//This shortcode runs from Plugin
echo 'Plugin Based Shortcode==';
echo do_shortcode('[custom_plugin_sc post_type="post" limit="-1" cat="" order="DESC" orderby="post_title"]');

global $query_string;
wp_parse_str( $query_string, $search_query );
$search_query_string = $search_query['search'];

$form = get_search_form_by_sagaya($permalink,$search_query_string );
echo $form;

if(isset($search_query_string) && !empty($search_query_string))
{
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			echo 'Page Number==='.$paged;

	       echo   'If condtion';
			$args = array(  
		        'post_type' => array('post','page'),
		        'post_status' => 'publish',
		        'posts_per_page' => 10, 
		        'orderby' => 'title', 
		        'order' => 'ASC',
		        's' => $search_query_string,
		        'paged' => $paged, 
		    );

		$search = new WP_Query( $args );
		$id_result = array();
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
				$id_result = $post_id;
			}
			echo 'Pagintation goes herr===';
			//echo '<pre>'; print_r($search); echo '</pre>';

			$search_post = $search->found_post;
			$max_pages = $search->max_num_pages;
			$query_string = $_GET['search'];
			$proper_url = $permalink.'?search='.$query_string;
			for($i=1;$i<=$max_pages;$i++)
			{
				?>
				<div class="pagination" id="blog-pagination">
					<span class="page_no" data_page_no="page_<?php echo $i; ?>"><a href="<?php echo $proper_url.'&paged='.$i;  ?>"><?php echo $i; ?></a></span>
				</div>
				<?php
			}
            ?>
            
                              <?php if( get_previous_posts_link('&larr; ', $search->max_num_pages ) ) : ?>
                              <span class="previous" ><?php previous_posts_link( '&rarr; ', $search->max_num_pages  ); ?></span>
                             <?php endif; ?>
                             <?php if( get_next_posts_link('&rarr; ', $search->max_num_pages ) ) : ?>
                              <span class="next"><?php next_posts_link( '&rarr;', $search->max_num_pages  ); ?></span>
                              <?php endif; ?>
                            </div>
            <?php
            //paginateSearch(); 
            echo '*** '.wpbeginner_numeric_posts_nav($search); 
		}
		else
		{
			echo 'Displaying the nested else condition';
			echo '<h2>No Search Results Found dasdfads</h2>';
		}

}
else
{
	echo 'No Result Found';
	echo '<h2>'.$post_title.'</h2>';
	echo $post_content;
}


get_footer();
?>