<?php

include('lib/theme-functions.php');
include('lib/registers.php');
include('lib/custom-hooks.php');
include('lib/shortcodes.php');
include('lib/global-ajax-calls.php');
//Chooks
//Shortcodes
//Ajax Files

function logo_class()
{
	$logo_class = 'logo';
	return $logo_class;
}

function paginateSearch(){

	global $wp_query;

	$searchPages = $wp_query->max_num_pages;
	echo '<pre>'; print_r($searchPages); echo '</pre>';
	$theBig = 999999999;

	$paginateSearchArgs = array(

	'base' => str_replace($theBig,'%#%',esc_url (get_pagenum_link($theBigNumber))),

	'format' => '?page = %#%',

	'current' =>  max(1, get_query_var ('paged')),

	'total' => $searchPages

	);

	echo paginate_links($paginateSearchArgs);

}
?>