<?php

//add in adminmenu starts
add_action( 'admin_menu', 'seo_plugin_func_call' );
  function seo_plugin_func_call() {
	add_menu_page('AVASOFT SEO', // page <title>Title</title>
			'AVASOFT SEO', // menu link text
			'manage_options', // capability to access the page   (admin, editor, author)
			'avasoft-seo', // page URL slug
			'ava_seo_callback', // callback function /w content
			'dashicons-admin-site-alt3' // menu icon
		);
}
//add in adminmenu ends



function ava_seo_callback()
{
	echo "seo backend file access";

}


?>