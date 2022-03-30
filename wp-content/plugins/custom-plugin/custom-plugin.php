<?php
/**
 * 
 *
 * Plugin Name: Custom Plugin
 * Description: Custom Plugin is an Awesome Plugin built for SEO Purpose.
 * Version:     1.6.2
 * Author:      Avasoft
  */


add_action('wp_enqueue_scripts','css_js_func_call',3);   //Calling JS & Css for frontend view
function css_js_func_call()
{
	wp_enqueue_style('custom-plugin-css',plugin_dir_url( __FILE__ ).'css/custom-plugin.css');
	wp_enqueue_script('custom-plugin-js',plugin_dir_url( __FILE__ ).'js/plugin.js',array('jquery-inbuilt'));
}

add_action( 'admin_enqueue_scripts', 'admin_level_script');

function admin_level_script()
{
	wp_enqueue_script('custom-plugin-js',plugin_dir_url( __FILE__ ).'js/admin-plugin.js',array('jquery-inbuilt'));
}

/**
 * Deactivation hook.
 */
function pluginprefix_deactivate() {
    // Unregister the post type, so the rules are no longer in memory.
    remove_shortcode('custom_plugin_sc');
    // Clear the permalinks to remove our post type's rules from the database.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivate' );



add_action( 'admin_menu', 'custom_plugin_func_call' );
add_shortcode('custom_plugin_sc','custom_plugin_sc_func'); 

global $wpdb;
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE `{$wpdb->base_prefix}seo` (
  id INT NOT NULL,
  post_id varchar(255) NOT NULL,
  post_name varchar(255) NOT NULL,
  meta_title varchar(255),
  meta_description varchar(255),
  keywords varchar(255),
  user_id bigint(20) UNSIGNED NOT NULL,
  created_at datetime NOT NULL,
  expires_at datetime NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);


/*$sql_query = $wpdb->query("ALTER TABLE `tr_seo` ADD seo_col_add Varchar(100)");
if(!is_wp_error($sql_query ))
{
	echo 'Success Alter';
}*/

function custom_plugin_func_call() {
	add_menu_page('Custom Plugin', // page <title>Title</title>
			'Custom Plugin', // menu link text
			'manage_options', // capability to access the page   (admin, editor, author)
			'custom-plugin-build', // page URL slug
			'custom_plugin_callback' // callback function /w content
			//'dashicons-star-half' // menu icon
		);
}

function custom_plugin_callback()
{
	if(isset($_POST['custom_plugin_submit']))
	{
		$custom_plugin_data = $_POST['custom_plugin'];

		echo '<pre>'; print_r($custom_plugin_data); echo '</pre>';
		$existing_shortcodes = get_option('custom_plugin_data');  //For updating the Existing Shortcode list
		//echo '<pre>***'; print_r($existing_shortcodes); echo '</pre>';

		if(empty($existing_shortcodes))
		{
			$existing_shortcodes = array();	
		}

		if(sizeof($custom_plugin_data) && array_keys($custom_plugin_data))
		{
			$custom_plugin_data = array_merge($existing_shortcodes,$custom_plugin_data);
			update_option('custom_plugin_data',$custom_plugin_data);

		}	

		global $wpdb;
		

		$table = $wpdb->prefix.'options';
		$data = array(
			'option_name' => 'custom_plugin_datum', 
			'option_value' => $custom_plugin_data[0]['post_type']
		);
		//$format = array('%s','%d');
		$insert_row = $wpdb->insert($table,$data);
		echo '<pre>'; print_r($wpdb); echo '</pre>';
		$my_id = $wpdb->insert_id;
		echo '*** '.$my_id;
		echo $wpdb->print_error();
		//$final_output = get_option('custom_plugin_data'); 
		//echo '<pre>'; print_r($final_output); echo '</pre>';
	}
	
	$output = '<h2>Displaying Post Shortcode Plugin</h2>';
	
		$output .= '<table class="wp-list-table widefat fixed striped table-view-list posts">
   		<thead>
      	<tr>
         <th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><span>Shortcode</span><span class="sorting-indicator"></span></th>
      	</tr>
   		</thead>
	   <tbody id="the-list">';
	   $final_output = get_option('custom_plugin_data');
	   $final_output_size = sizeof($final_output);
	   for($i=0;$i<$final_output_size;$i++)
	   {
	   	     $post_type = $final_output[$i]['post_type'];
	   	     $limit = $final_output[$i]['limit'];

	   	     $post_type_variable = $limit_variable = '';
	   	     if(!empty($post_type))
	   	     {
	   	     	$post_type_variable = 'post_type="'.$post_type.'"';
	   	     }

	   	     if(!empty($limit))
	   	     {
	   	     	$limit_variable = 'posts_per_page="'.$limit.'"';
	   	     }

	   		 $output .= '<tr class="iedit author-self level-0 post-42 type-post status-publish format-standard hentry category-test-category">
	         <td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
	            <strong>[custom_plugin_sc '.$post_type_variable.' '.$limit_variable.']</strong>
	         </td>
	      </tr>';
	   }
	     
	   $output .= '</tbody>
	</table>';

	$post_types = get_post_types();
	$unset_array = array('attachment','revision','nav_menu_item','custom_css','customize_changeset'); 
	foreach($unset_array as $key=>$value)
	{
		//echo $value
		unset($post_types[$value]);
	}
	//echo '<pre>'; print_r($post_types); echo '</pre>';

	$output .= '<form method="post" class="custom_plugin_form">
			<label>Choose Post Type</label>
			<select name="custom_plugin[0][post_type]" class="custom_plugin_post_type">
			   <option value="">Select Post Type</option>';
			foreach($post_types as $key=>$post_type)
			{
				$output .= '<option value="'.$post_type.'">'.$post_type.'</option>';
			}
			$output .= '</select>

			<label>Limit</label>
			<input type="text" name="custom_plugin[0][limit]" class="custom_plugin_limit" value="">
			<span class="notify">If you want to show all the post Enter -1</span>
			<input type="submit" name="custom_plugin_submit" value="Save Shortcode">
	</form>';
	echo $output;


	?>
	<div id="shortcode_displayer">
		<span class="">[custom_plugin_sc <span class="post_type_span" style="display:none;">post_type="<span class="selected_post_type"></span>"</span> <span class="post_type_limit" style="display:none;">posts_per_page="<span class="entered_post_limit"></span>"</span>]</span>
	</div>
	<?php
	//die();
}


function custom_plugin_sc_func($atts)
{
	$output = '';

	$args = shortcode_atts( array(
		'post_type'   => 'post',
		'limit'=>-1,
		'post_status' => 'publish',
		'cat'=> '',
		'orderby'=> 'date',
        'order' => 'DESC'
	),$atts);


/*Fetch the Values from the shortcode attributes by Custom*/
	$post_type = $args['post_type'];
	$post_per_page = $args['limit'];
	$category = $args['cat'];
	$orderby = $args['orderby'];
	$order = $args['order'];



	$posts = new WP_Query(
		array(
        'cat' => array($category),
        'post_status' => 'publish',
        'post_type' => $post_type,
        'posts_per_page' => $post_per_page,
        'orderby'=> $orderby,
        'order' => $order
        )
	);

	if ($posts->have_posts()) {
		while ($posts->have_posts()) {
			$posts->the_post();
			$post_id = get_the_ID();
			$post_title = get_the_title();
			$post_link = get_the_permalink();
			$post_excerpt = get_the_excerpt();

			if(has_post_thumbnail($post_id) )
			{
				$media_id = get_post_thumbnail_id($post_id);
				//echo $media_id;
				$image_src = wp_get_attachment_image_src($media_id,'medium');
				//echo '<pre>'; print_r($image_src); echo '</pre>';
				$image = $image_src[0];
			}
			else
			{
				$image = site_url().'/wp-content/uploads/2022/02/cat-img-04.jpg';
			}

			$output .= '<div class="plugin_div">
				<div class="featured_image"><img src="'.$image.'"></div>
			<span class="custom_plugin_post">'.$post_title.'</span>
			<div class="post_excerpt">'.$post_excerpt.'</div>
			<div class="read_more"><a href="'.$post_link.'">Read More</a></div>
			</div>';
		} 
	}

	return $output;

}
?>