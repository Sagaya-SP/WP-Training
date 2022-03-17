<!doctype html>
<head>
	<title><?php bloginfo('name')?></title>
	<?php
	$avasoft_theme_settings = get_option('avasoft_theme_settings');
	$fav_icon_url = $avasoft_theme_settings['fav_icon'];
	?>
	<link rel="icon" type="image/x-icon" href="<?php echo $fav_icon_url; ?>">
	<?php wp_head(); ?>
</head>
<body>
	<div class="container">
		<?php 
		$header_layout = $avasoft_theme_settings['layout_selection'];
		if($header_layout == 'rlln')
		{
			?>
			<div class="row">
				<div class="col-md-8">
					
				</div>
				<div class="col-md-4">
					<div class="<?php echo logo_class(); ?>">
						<img src="<?php echo $fav_icon_url; ?>"/>
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="row">
				<div class="col-md-4">
					<div class="<?php echo logo_class(); ?>">
						<img src="<?php echo $fav_icon_url; ?>"/>
					</div>	
				</div>
				<div class="col-md-8">
				</div>
			</div>
			<?php
		}