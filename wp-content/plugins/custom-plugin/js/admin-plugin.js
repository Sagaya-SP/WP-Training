$(document).ready(function()
{

	$('.custom_plugin_post_type').on('change', function() {
		console.log('Select dropdown function');
  		var post_type = this.value;
  		if(post_type.length != '')
		{
			$('.selected_post_type').empty();
			$('.post_type_span').show();
			$('.selected_post_type').text(post_type);
		}
		else
		{
			$('.post_type_span').hide();
		}
	});


	$("input.custom_plugin_limit").keyup(function(event){
		var varable = $(this).val();
		if(varable.length != '')
		{
			$('.entered_post_limit').empty();
			$('.post_type_limit').show();
			$('.entered_post_limit').text(varable);
		}
		else
		{
			$('.post_type_limit').hide();
		}
		//console.log(varable);
  		//$("span").text(i += 1);
	});
});