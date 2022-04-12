<?php
//Enqueue Admin Dependent CSS & JS
//Enqueue Frontend Dependent CSS & JS

//Enqueue Admin Dependent CSS & JS START
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style',2);
function wpdocs_enqueue_custom_admin_style() {

        wp_register_script('jquery-inbuilt','http://code.jquery.com/jquery-1.11.3.min.js');
        wp_register_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css', false, '1.0.0' );
        wp_register_style( 'custom_admin_css', get_template_directory_uri() . '/admin/admin-style.css', false, '1.0.0' );
        wp_register_script( 'bootstrap_bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', false, '1.0.0' );
        wp_register_script( 'custom_js', get_template_directory_uri() . '/js/custom.js', false, '1.0.0' );
   		wp_enqueue_media();

        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap_bundle'); 
        wp_enqueue_script('custom_js'); 
        wp_enqueue_style( 'bootstrap_css' );
        wp_enqueue_style( 'custom_admin_css' );
}
//Enqueue Admin Dependent CSS & JS Ends


//Enqueue Frontend Dependent CSS & JS Start
add_action('wp_enqueue_scripts','front_end_call_functions',1);
function front_end_call_functions()
{
    wp_enqueue_script('jquery-inbuilt','http://code.jquery.com/jquery-1.11.3.min.js');
	wp_enqueue_script( 'bootstrap_bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', false, '1.0.0' );
	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css', false, '1.0.0' );
	wp_enqueue_style( 'custom_style_css', get_template_directory_uri() . '/style.css', false, '1.0.0' );
    wp_enqueue_script( 'custom_js', get_template_directory_uri() . '/js/custom.js', false, '1.0.0' );
    
    
}
//Enqueue Frontend Dependent CSS & JS Ends

add_action('wp_head','title_tag_updates');

function title_tag_updates()
{
	if(is_search())
	{
		echo '<title>Search Page Results</title>';
	}
	
}


function search_title_highlight() {
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

    return $title;
}

function search_excerpt_highlight() {
    $excerpt = get_the_excerpt();
    $keys = implode('|', explode(' ', get_search_query()));
    $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);

    return '<p>' . $excerpt . '</p>';
}


function get_search_form_by_sagaya($permalink,$search_query_string)
{
    $output = '
    <form role="search" action="'.$permalink.'"  method="get" class="custom_search_form">
        <input type="text" name="search" value="'.$search_query_string.'" id="s" class="search_field"/>
        <input type="submit" value="submit"/>
    </form>
    ';

    return $output;
}

add_action( 'pre_get_posts', 'search_filter' );
function search_filter($query) {

  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('paged', ( get_query_var('paged') ) ? get_query_var('paged') : 1 );
      //$query->set('posts_per_page',10);
    }
  }
}

function wpbeginner_numeric_posts_nav($wp_query) {
 
  /* if( is_singular() )
    {
        return;
    } */

    //echo '<pre>'; print_r($wp_query); echo '</pre>';
    //global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )                  //1,2
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {                //3,4,5
        $links[] = $paged - 1;  //2 page no. url
        $links[] = $paged - 2;  //1 page no. url
    }
 
    if ( ($paged + 2) <= $max ) {     
        $links[] = $paged + 2;  //5
        $links[] = $paged + 1;  //4
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );   
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() ){
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
    }
 
}



//REST API

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://avamigstg.wpengine.com/wp-json/wp/v2/posts',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;


/*$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://avasoftstg.wpengine.com/wp-json/wp/v2/posts',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: aiovg_rand_seed=259876495'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$response_array = json_decode($response,true);
echo '<pre>'; print_r($response_array); echo '</pre>'; */

/*
Post method  -- To create New Entry  (Insert/Create) - POST
Get method  - To fetch the Entry (Read)  - GET
Modify Method - To Update anything (Edit) - PUT
Delete method - To remove something (Delete) - DELETE

*/

//add_filter('rest_pre_serve_request', 'serve_static_resources', 11, 4);


//

add_action( 'rest_api_init', 'hook_function');
function hook_function() {
  register_rest_route( 'myplugin', '/test/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'my_awesome_func',
  ));
} 

add_action( 'rest_api_init', 'empty_hook_function');
function empty_hook_function() {
  register_rest_route( 'myplugin', '/test/page/', array(
    'methods' => 'GET',
    'callback' => 'my_awesome_func_new',
  ));
}

function my_awesome_func_new(WP_REST_Request $request)
{
$per_page = $request->get_param( 'per_page' );
$order_field = $request->get_param( 'order_field' );
$sort = $request->get_param( 'sort' );
$paged = $request->get_param( 'page' );
//echo $per_page;

global $wpdb;
 $args = array(
       // ID of a page, post, or custom type
      'post_type' => array('post','page'),
      'posts_per_page' => $per_page,
      'orderby' => $order_field ,
      'order' => $sort
      //'paged' => $paged
    );

    //echo '<pre>'; print_r($args); echo '</pre>';

    $my_posts = new WP_Query($args);

    //$result = 'No Post Found';
    $i = 0;
    if($my_posts->have_posts())
    {
        $max_pages = $my_posts->max_num_pages;
        $total = $my_posts->found_posts;
        while($my_posts->have_posts())
        {
            $my_posts->the_post();
            $id =  get_the_ID();
            $title = get_the_title();
            $content = get_the_content();
            $permalink = get_the_permalink();
            $featured_image_id = get_post_thumbnail_id(get_the_ID());
            $featured_image = '';
            if(!empty($featured_image_id))
            {
                $featured_image = wp_get_attachment_image_url($featured_image_id);
            }
            
            $result[$i] = array(
                'id' => $id,
                'title' => $title,
                'description'=>$content,
                'permalink'=>$permalink,
                'featured_image'=>$featured_image
            ); 
            $i++;
        }
    }

            $response = new WP_REST_Response($result, 200);

            $response->header( 'X-WP-Total', $total ); 
            $response->header( 'X-WP-TotalPages', $max_pages );
   

    //echo '<pre>'; print_r($result); echo '</pre>';
    //echo json_encode($result);
    return $response;

}


function my_awesome_func(WP_REST_Request $request)
{ 

    $res_id = $request['id'];

    //echo $post_limit;
    $args = array(
       // ID of a page, post, or custom type
      'p'=> $res_id,
      'post_type' => array('post','page')
    );

    $my_posts = new WP_Query($args);
    $result = array();
    $result = 'No Post Found';
    if($my_posts->have_posts())
    {
        while($my_posts->have_posts())
        {
            $my_posts->the_post();
            $title = get_the_title();
            $content = get_the_content();
            $permalink = get_the_permalink();
            $featured_image_id = get_post_thumbnail_id(get_the_ID());
            $featured_image = '';
            if(!empty($featured_image_id))
            {
                $featured_image = wp_get_attachment_image_url($featured_image_id);
            }
            
            $result = array(
                'title' => $title,
                'description'=>$content,
                'permalink'=>$permalink,
                'featured_image'=>$featured_image
            ); 
        }
    }

    echo json_encode($result);
}



$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/wp-training/wp-json/myplugin/test/page?order_field=id&sort=DESC',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 200,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);
echo $response;

$response_array = json_decode($response,true);
echo '<pre>'; print_r($response_array); echo '</pre>';
//echo sizeof($response_array);
?>