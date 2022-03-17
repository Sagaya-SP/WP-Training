<?php
/**
* Template Name: Rafi's Custom Page
*
*/
get_header();
global $post;
?>
<div class="container">
	<div class="row first-fold">
		first fold content goes here
	</div>

	<div class="row second-fold">
		second fold content goes here
	</div>

	<div class="row third-fold">
		<?php
		//get_template_part('template-parts/content/functionality-1.php');
		include('template-parts/content/functionality-1.php');
		$page_id = $post->ID;
		$get_dynamic_value = get_post_meta($page_id,'name',true);
		echo 'Entered Value is == '.$get_dynamic_value;
		?>
	</div>
	<div class="forth-fold">
		<?php
		include('template-parts/content/functionality-2.php');
		//get_template_part('template-parts/content/functionality-2.php');
		?>
	</div>
</div>
<?php
get_footer();
?>