<?php
//All Shortcodes Goes here-----


//Self Closed Shorttcodes
add_shortcode('my_first_shortcode','sc_call_function');

function sc_call_function()
{
	/*$output = '<h2>Simple Shortcode</h2>';
	$output .= 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. Wikipedia';*/

	$output = '
	<form action="" method="post" class="form_actions">
		<div class="form-groups">
			<input type="text" name="content" value=""/>
			<input type="text" name="color" value=""/>
			<input type="text" name="url" value=""/>
			<input type="submit" name="submit" vaue=""/>
		</div>
	</form>
	';

	return $output;
}

//Attributed Shortcodes
add_shortcode('multiple_sc','mul_sc_callback');

function mul_sc_callback($my_attributes)
{	
	$args = shortcode_atts( array(
		'url' => '#',
		'color' => 'red',
		'content' => 'Default Content for Link',
	), $my_attributes );

	$url = $args['url'];
	$color_given = $args['color'];
	$content = $args['content'];

	$output = '<br/>Multiple Params SC== <a href="'.$url.'" style="color:'.$color_given.'">'.$content.'</a>';

	return $output;
}

add_shortcode('enclosed','enclosed_callback');

function enclosed_callback($attr,$content)
{
	$args = shortcode_atts( array(
		'url' => '#',
		'color' => 'red',
		'content' => 'Enclosed Sc\'s Content',
	), $attr );

	$url = $args['url'];
	$color_given = $args['color'];
	$attr_content = $args['content'];
	//$content = $args['content'];

	$output = '<br/>Enclosed tag sc=  Attr Content == '.$attr_content.'<a href="'.$url.'" style="color:'.$color_given.'">'.stripslashes($content).'</a>';

	return $output;
}