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


    $('.custom_form_submit').submit(function(e)
    {
        e.preventDefault();
        console.log('Testing the form');
        var first_name = $('.first_name').val();
        var last_name = $('.last_name').val();
        var email = $('.email_field').val();
        var phone_no = $('.phone_no').val();
        var city_selection = $('.city_selection').val();
        var date = $('.date').val();
        var msg_field = 
        console.log(first_name);
        console.log(last_name);
        console.log(email);
        console.log(phone_no);
        console.log(city_selection);
        console.log(date);
        $.ajax({
            type : "POST",
            url : "/wp-training/wp-admin/admin-ajax.php",
            data : {
                action: "cf_form_selection",
                f_name: first_name,
                last_name: last_name,
                email: email,
                phone_no: phone_no,
                city_selection: city_selection,
                date: date,
            },
            success: function(response) {
                console.log(response);
                $('.custom_form_submit').trigger("reset");
            }
        });
    });

    $('.fetch_output').click(function(e)
    {
        console.log('Fetch Button Clicked');
       // e.preventDefault();
        $.ajax({
            type : "POST",
            url : "/wp-training/wp-admin/admin-ajax.php",
            data : {
                action: "sql_data",
            },
            beforeSend:
            success: function(response) {
                console.log(response);
                $('.output_loader').empty();
                $('.output_loader').html(response);
            }
        });
    })
});