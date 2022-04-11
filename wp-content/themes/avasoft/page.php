<?php 
get_header();
global $wpdb;

$post_id = get_the_ID();
//the_title();
//the_content();
Echo '"""Get The Function""<br/>';
echo $post_id;
echo '<br/>TITLE***'.get_the_title();
echo '<br/>get_the_content**'.get_the_content();
echo '***<br/>';

Echo '<br/>"""The Function""<br/>';
the_ID();
echo 'the TITLE***<br/>';
the_title();
echo '<br/>***The Content***<br/>';
the_content();

get_footer();
?>