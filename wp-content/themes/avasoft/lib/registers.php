<?php
/*
Table of Contents
1. Registering the Sidebars
3. Registering the Menus
2. Register the Custom Post Types
4. Registering the Taxonomies

*/

//1. Registering the Sidebars Starts

add_action( 'widgets_init', 'Main_Sidebar' );
function Main_Sidebar() {
/* Register the 'primary' sidebar. */
register_sidebar(
	array(
	'id' => 'primary',
	'name' => __( 'Main Sidebar' ),
	'description' => __( 'A short description of the sidebar.' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	)
);

register_sidebar(
	array(
	'id' => 'blog-right-sidebar',
	'name' => __( 'Blog Right Sidebar' ),
	'description' => __( 'Displays in Blog page RIght side.' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	)
);

register_sidebar(
	array(
	'id' => 'blog-left-sidebar',
	'name' => __( 'Blog Left Sidebar' ),
	'description' => __( 'Displays in Blog page Left side.' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	)
);


 for($i=1;$i<=3;$i++)
	{
		register_sidebar(
		array(
		'id' => 'footer-'.$i,
		'name' => __( 'Footer Col '.$i ),
		'description' => __( 'Displays Col '.$i.' of footer.' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		)
			);
	}

	$sidebar_array = array(
		'product-right-sidebar' => 'Product Right Sidebar',
		'product-left-sidebar' => 'Product Left Sidebar',
	);

	foreach($sidebar_array as $index => $value)
	{
			register_sidebar(
				array(
				'id' => $index,
				'name' => __( $value ),
				'description' => __( 'Displays '.$value. 'in Product Page' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				)
			);
	}
}
//1. Registering the Sidebars Ends


//3. Registering the Menus Starts
function register_menus() { 
   register_nav_menus(
			array(
				'primary' => 'Primary menu',
				'footer'  => 'Footer menu',
			)
		);
} 
add_action('init', 'register_menus');
//3. Registering the Menus Ends


//2. Register the Custom Post Types Starts
add_action('init','AVA_book_post_type');

function AVA_book_post_type(){
	$args = array(
	'public' => true,
	'label' => 'AVA Books',
	'description' => 'Library of books',
	'show_ui' => true,
	'show_in_menu' => true,
	'menu_icon' => 'dashicons-book',
	'menu_position' => 15,
	'supports' => array('title', 'editor', 'thumbnail', 'author', 'excerpt'),
	);
	register_post_type('ava_books',$args);
}
//2. Register the Custom Post Types Ends 	


//4. Registering the Taxonomies Start
add_action('init','author_function');
function author_function(){
	$lables = array(
	'name' => 'Authors',
	'singular_name' => 'Author',
	'edit_item' => 'Edit Author',
	'add_new_item' => 'Add New Author',
	'new_item_name' => 'New Author Name',
	'update_item'=>'Update Author',
	'menu_name' => 'Authors',
	);

	//Register taxonomy

	$arg = array(
	'hierarchical' => true,
	'labels' => $lables,
	'show_ui' => true,
	'show_admin_column' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'ava-authors'),
	);
	register_taxonomy('ava_authors','ava_books',$arg);
}
//4. Registering the Taxonomies Ends

?>