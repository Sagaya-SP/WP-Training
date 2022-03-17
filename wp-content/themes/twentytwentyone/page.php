<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
global $post;
$get_optin_value = get_option('option_name_api');
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	$post_id = get_the_ID();
	$get_name = get_post_meta($post_id,'name',true);
	echo 'OPtion Value Print=== '.$get_optin_value;

	echo do_shortcode('[my_first_shortcode]');

	if(isset($_POST['submit']))
	{
		$content = $_POST['content'];
		$color =$_POST['color'];
		$url =$_POST['url']; 
		echo do_shortcode('[multiple_sc url="'.$url.'" color="'.$color.'" content="'.$content.'"]');
		echo do_shortcode('[enclosed]'.$content.'[/enclosed]');
	}

	//Multiple Shortcodes
	//echo do_shortcode('[multiple_sc]');

	

	get_template_part( 'template-parts/content/content-page' );

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile; // End of the loop.

get_footer();
