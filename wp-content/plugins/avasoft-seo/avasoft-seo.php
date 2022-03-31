<?php
/**
 * 
 *
 * Plugin Name: AVASOFT SEO
 * Description: AVASOFT Plugin is an Awesome Plugin built for SEO Purpose.
 * Version:     1.1
 * Author:      Avasoft
  */

//include library files
include('lib/custom-hooks.php');
include('lib/custom-metabox.php');



  //Enqueue scripts frontend starts
  add_action('wp_enqueue_scripts','frontend_script');   
  function frontend_script()
  {
     
      wp_enqueue_style('frontend-css',plugin_dir_url( __FILE__ ).'css/front-end.css');     
      wp_enqueue_script('frontend-js',plugin_dir_url( __FILE__ ).'js/front-end.js',array('jquery-inbuilt'));
  }
   //Enqueue scripts frontend ends

   //Enqueue scripts admin starts
  add_action( 'admin_enqueue_scripts', 'admin_script');  
  function admin_script()
  {
    wp_enqueue_style('admin-css',plugin_dir_url( __FILE__ ).'css/admin-css.css');
    wp_enqueue_script('admin-js',plugin_dir_url( __FILE__ ).'js/admin.js',array('jquery-inbuilt'));
  }
//Enqueue scripts admin ends





  ?>