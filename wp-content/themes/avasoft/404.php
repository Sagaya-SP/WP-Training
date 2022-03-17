<?php
get_header();
?>
<div class="container">
	<div class="row">
		<h2>Page Not Found</h2>
		<h4>Please visit our website for further research .<a href="<?php echo site_url() ; ?>">Go to Home Page</a></h4>
	</div>

	<div class="row search-something">
		<?php
		get_search_form();
		?>
	</div>
</div>
<?php
get_footer();
?>