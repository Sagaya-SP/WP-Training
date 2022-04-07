<?php

//add in adminmenu starts
add_action( 'admin_menu', 'onboard_plugin_func_call' );
  function onboard_plugin_func_call() {
	add_menu_page('EMP Onboarding', // page <title>Title</title>
			'EMP Onboarding', // menu link text
			'manage_options', // capability to access the page   (admin, editor, author)
			'emp-onboarding', // page URL slug
			'emp_onboarding_callback', // callback function /w content
			'dashicons-admin-users' // menu icon
		);
}
//add in adminmenu ends


function emp_onboarding_callback()
{
	echo "Employee Onboarding backend file access";
	
}

add_shortcode('hw', 'hello');
	function hello() {
		return 'Hello, World!';
	}


?>