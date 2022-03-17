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
global $wpdb;
$get_optin_value = get_option('option_name_api');
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	$post_id = get_the_ID();
	$get_name = get_post_meta($post_id,'name',true);
	echo $get_name;
	echo 'OPtion Value Print=== '.$get_optin_value;
	do_action('avasoft_hook');

	$string = 'This is my value';
	$value1 = apply_filters('custom_filter', $string);
	echo '<br/>Filter value 1 O/p = '. $value1;

	/*$string2 = '';
	$value2 = apply_filters('custom_filter', '');
	echo '<br/>Filter value 2 O/p '. $value2;*/



	?>
	<form action="" method="post">
		<input type="text" name="fname" value=""/>
		<input type="text" name="flname" value=""/>
		<?php
			do_action('country_list');
		?>
	<input type="submit" name="submit" value="Submit"/>
	</form>
	<?php

	$did_action_count = did_action('country_list');
	echo '<br/>Did Action=== '.$did_action_count;
	if($did_action_count == 1)
	{
		remove_action('avasoft_hook','callback_avasoft_func');
	}

	get_template_part( 'template-parts/content/content-single' );

	if ( is_attachment() ) {
		// Parent post navigation.""
		the_post_navigation(
			array(
				/* translators: %s: Parent post link. */
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentytwentyone' ), '%title' ),
			)
		);
	}

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

	// Previous/next post navigation.
	$twentytwentyone_next = is_rtl() ? twenty_twenty_one_get_icon_svg( 'ui', 'arrow_left' ) : twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right' );
	$twentytwentyone_prev = is_rtl() ? twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right' ) : twenty_twenty_one_get_icon_svg( 'ui', 'arrow_left' );

	$twentytwentyone_next_label     = esc_html__( 'Next post', 'twentytwentyone' );
	$twentytwentyone_previous_label = esc_html__( 'Previous post', 'twentytwentyone' );

	the_post_navigation(
		array(
			'next_text' => '<p class="meta-nav">' . $twentytwentyone_next_label . $twentytwentyone_next . '</p><p class="post-title">%title</p>',
			'prev_text' => '<p class="meta-nav">' . $twentytwentyone_prev . $twentytwentyone_previous_label . '</p><p class="post-title">%title</p>',
		)
	);
endwhile; // End of the loop.

get_footer();
