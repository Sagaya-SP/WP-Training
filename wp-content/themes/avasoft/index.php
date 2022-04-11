<?php
get_header();

global $wpdb, $post;

if(have_posts())
{ 
	the_post();
	if(is_single())  //Check whether the front end page is blog type
	{
		echo 'Post Invoked';
		get_template_part('single.php');
	}
	if(is_page())   //Default Template loops out here
	{
		echo 'Page invoked';
		get_template_part('page.php');
		//the_content();
	}
}


get_footer();
?>