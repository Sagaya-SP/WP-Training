$(document).ready(function()
{
	//console.log('Custom Js loading');
	$('.loader_click').click(function()
	{
		var page_number = $(this).attr('data-load-next');
		console.log('Button clicked');
		$.ajax({
            type : "POST",
            url : "/wp-training/wp-admin/admin-ajax.php",
            data : {
            	action: "get_data",
            	page_no: page_number
            },
            success: function(response) {
                /*alert("Your vote could not be added");
                alert(response); */
                var page_no_update = parseInt(1) + parseInt(page_number);
                $('.loader_click').attr('data-load-next',page_no_update);
                console.log(response);
                $('.loader_div').append(response);
            }
        });
	});
});