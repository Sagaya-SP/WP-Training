<?php
add_shortcode('custom_form', 'custom_form_cb_func');

function custom_form_cb_func()
{
	$output = '
	<form action="" method="post" class="custom_form_submit">
		<input type="text" name="first_name" class="first_name" value=""/>
		<input type="text" name="last_name" class="last_name" value=""/>
		<input type="email" name="email" class="email_field" value=""/>
		<input type="text" name="phone_no" class="phone_no" value=""/>
		<select class="city_selection">
			<option value="chennai">Chennai</option>
			<option value="kovai">Kovai</option>
			<option value="tveli">TVeli</option>
			<option value="trichy">Trichy</option>
			<option value="madurai">Madurai</option>
		</select>
		<input type="date" name="date" class="date" value=""/>
		<input type="submit" name="form_submit" class="cf_submit" value="Store the Value"/>
	</form>
	';

	return $output;
}
?>