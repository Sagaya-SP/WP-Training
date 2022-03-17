<?php

/*
Featured Image Support
Theme Options Register
*/


//Featured Image Support Start
add_action('after_setup_theme','thumbnail_action');
function thumbnail_action()
{
	add_theme_support( 'post-thumbnails', 
     array( 'post', 'page', 'ava_books') 
	);
}
//Featured Image Support Ends


//Theme Options Register Starts
add_action( 'admin_menu', 'avasoft_option_page' );
function avasoft_option_page() {
	add_menu_page('Avasoft Option', // page <title>Title</title>
			'Theme Options', // menu link text
			'manage_options', // capability to access the page   (admin, editor, author)
			'avasoft-theme-options', // page URL slug
			'custom_callback_functions', // callback function /w content
			'dashicons-star-half' // menu icon
		);
}

function custom_callback_functions()
{
	if(isset($_POST['theme_submit']))
	{
		$avasoft_options = $_POST['avasoft'];
		//echo '<pre>'; print_r($avasoft_options); echo '</pre>';
		update_option('avasoft_theme_settings',$avasoft_options);
	}
	$avasoft_settings = get_option('avasoft_theme_settings');
	//echo '<pre>'; print_r($avasoft_settings); echo '</pre>';
	?>
	<div id="option_page">
		<span>Theme Options</span>
	</div>
	<div class="d-flex align-items-start">
		  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">General</button>
		    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Header</button>
		    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Footer</button>
		    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Typography</button>
		  </div>
		  <div class="tab-content" id="v-pills-tabContent">
		  	<form action="" method="post">
		    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
			    	<div class="form-group">
			    		<label>Fav Icon</label>
			    		<div class="fav_icon_preview"><img src="<?php echo $avasoft_settings['fav_icon']; ?>"/></div>
			    		<input type="hidden" name="avasoft[fav_icon]" class="fav_icon_url" value=""/>
			    		<input type="button" value="Upload File" id="fav_upload"/>
			    	</div>

			    	<div class="form-group">
			    		<label>Transparent Logo</label>
			    		<input type="file" name="avasoft[transparent_logo]" value="<?php echo $avasoft_settings['transparent_logo']; ?>"/>
			    	</div>
		    	<div class="form-group">
		    		<label>Logo</label>
		    		<input type="file" name="avasoft[logo]" value="<?php echo $avasoft_settings['logo']; ?>"/>
		    	</div>
		    </div>
		    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
		    	<div class="form-group">
			    		<label>Header Layout</label>
			    		<?php $settings_value = $avasoft_settings['layout_selection']; 
			    		// echo '** '.$settings_value;
			    		?>
			    		<select name="avasoft[layout_selection]" class="layout_selection">
			    			<option value="llrn" <?php echo ($settings_value === 'llrn') ? 'selected' : ''; ?>>Left Logo & Right Menu bar</option>
			    			<option value="rlln" <?php echo ($settings_value === 'rlln') ?  'selected' : ''; ?>>Right Logo & Left Menu bar</option>
			    		</select>
			    	
		    	</div>
		    </div>
		    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
		    	<div class="form-group">
		    		<label>Footer Layout</label>
		    		<?php
		    		 $footer_selection = $avasoft_settings['footer_seperation']; 
		    		?>
		    		<select name="avasoft[footer_seperation]" class="footer_layout">
		    			<option value="1" <?php echo ($footer_selection == 1) ? 'selected' : ''; ?>>1 Column</option>
		    			<option value="2" <?php echo ($footer_selection == 2) ? 'selected' : ''; ?>>2 Columns</option>
		    			<option value="3" <?php echo ($footer_selection == 3) ? 'selected' : ''; ?>>3 Columns</option>
		    			<option value="4" <?php echo ($footer_selection == 4) ? 'selected' : ''; ?>>4 Columns</option>
		    		</select>
		    	</div>	
		    </div>
		    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">	
		    </div>
		     <input type="submit" name="theme_submit" value="Save Changes"/>
		  	</form>
		    </div>
		 
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function($){

  	var mediaUploader;

  $('#fav_upload').click(function(e) {
    e.preventDefault();
    // If the uploader object has already been created, reopen the dialog
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    }, multiple: false });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function() {
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('.fav_icon_url').val(attachment.url);
      $('.fav_icon_preview').empty();
      $('.fav_icon_preview').html('<img src="'+attachment.url+'"/>');
    });
    // Open the uploader dialog
    mediaUploader.open();
  });

});
</script>
	<?php
}
//Theme Options Register Ends
?>