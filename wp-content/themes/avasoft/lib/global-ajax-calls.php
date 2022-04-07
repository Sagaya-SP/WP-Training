<?php

add_action( 'wp_ajax_nopriv_get_data', 'get_data' );
add_action( 'wp_ajax_get_data', 'get_data' );

function get_data() {
	global $wpdb;
	$page_no = $_POST['page_no'];
    echo '<br/>'.$page_no;
    $args = array(  
		        'post_type' => array('page'),
		        'post_status' => 'publish',
		        'posts_per_page' => 2, 
		        'orderby' => 'title', 
		        'order' => 'ASC',
		        'paged' => $page_no, 
		    );
    $query = new WP_Query( $args );
	if($query->have_posts())
		{	
			while($query->have_posts())
			{
				$query->the_post();
				$post_id = get_the_ID();
				$post_title = get_the_title();
				$post_excerpt_highlight = search_excerpt_highlight();
				$post_title_hightlight = search_title_highlight();
				$post_link = get_the_permalink();
				echo '<div class="search_result">
				<a href="'.$post_link.'">'.$post_title_hightlight.'</a>
				</div>';
			}
		}	
    die();
    }



add_action( 'wp_ajax_nopriv_cf_form_selection', 'cf_form_selection' );
add_action( 'wp_ajax_cf_form_selection', 'cf_form_selection' );

function cf_form_selection()
{
	global$wpdb;
	$form_name = 'Custom Form';
	$f_name =  $_POST['f_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone_no = $_POST['phone_no'];
	$city_selection = $_POST['city_selection'];
	$date = $_POST['date'];
	$table_name = $wpdb->prefix.'custom_cf';

	$insert = $wpdb->insert($table_name, array(
    'form_name' => $form_name,
    'first_name' => $f_name,
    'last_name' => $last_name, // ... and so on
    'email' => $email, 
    'phone_no' => $phone_no, 
    'message' => 'Testing the Form', 
    'city' => $city_selection, 
    'registerdate' => $date
	));

	if(!is_wp_error($insert))
	{
		echo 'Success insertion';
	}
	else
	{
		echo 'fAILED';
	}
	die();
}

add_action( 'wp_ajax_nopriv_sql_data', 'sql_data' );
add_action( 'wp_ajax_sql_data', 'sql_data' );
function sql_data()
{
	global $wpdb;
	$table_name = $wpdb->prefix.'custom_cf';
	$sql_query = 'SELECT * from '.$table_name.' WHERE registerdate BETWEEN';

	$date_lt_5 = "'2022-03-01' AND '2022-03-05'";
	$date_lt_6 = "'2022-03-06' AND '2022-03-15'";

	$date_lt_array =array(
		"'2022-03-01' AND '2022-03-05'",
		"'2022-03-06' AND '2022-03-15'") ;

	$sql_query_5 = "SELECT * from ".$table_name." WHERE registerdate BETWEEN '2022-03-01' AND '2022-03-05'";
	$sql_query_6 = "SELECT * from ".$table_name." WHERE registerdate BETWEEN '2022-03-06' AND '2022-03-15'";
		
	$dynamic_query_5 = $sql_query.' '.$date_lt_5;
	$dynamic_query_6 = $sql_query.' '.$date_lt_6;

	$dynamic_query_by_array_5 = $sql_query.' '.$date_lt_array[0];
	$dynamic_query_by_array_6 =  $sql_query.' '.$date_lt_array[1];

	//echo $sql_query_5.'<br/>';   //SELECT * from tr_custom_cf WHERE registerdate BETWEEN '2022-03-01' AND '2022-03-05'
	//echo $dynamic_query_5.'<br/>'; //SELECT * from tr_custom_cf WHERE registerdate BETWEEN '2022-03-01' AND '2022-03-05'
	$prepare_query = $wpdb->prepare($dynamic_query_by_array_5); //SELECT * from tr_custom_cf WHERE registerdate BETWEEN '2022-03-01' AND '2022-03-05'
	$get_result = $wpdb->get_results($prepare_query,ARRAY_A);
	$table = 'Clicked';
	//echo '<pre>'; print_r($get_result); echo '</pre>';
	$table .= '<table>
	<thead>
	<tr>
	<th>ID</th>
	<th>Form Name</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Phone No.</th>
	<th>Register Date</th>
	</tr>
	</thead>
	<tbody>';

	for($i=0;$i<sizeof($get_result);$i++)
	{
		$id = $get_result[$i]['id'];
		$form_name = $get_result[$i]['form_name'];
		$first_name = $get_result[$i]['first_name'];
		$last_name = $get_result[$i]['last_name'];
		$email = $get_result[$i]['email'];
		$phone_no = $get_result[$i]['phone_no'];
		$registerdate = $get_result[$i]['registerdate'];
		$table .= '<tr>
		<td>'.$id.'</td>
		<td>'.$form_name.'</td>
		<td>'.$first_name.'</td>
		<td>'.$last_name.'</td>
		<td>'.$email.'</td>
		<td>'.$phone_no.'</td>
		<td>'.$registerdate.'</td>
		</tr>';

	}

	$table .= '</tbody></table>';
	echo $table;
	die();

	/* 
	if(date < 05/03/2022 && date >= 01/03/2022)
	{
		select * dfadf where 

	}
	else if(date < 15/03/2022 && date >= 06/03/2022)
	{
		select * asdf where 
	}
	*/
}
?>