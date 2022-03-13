<div class="cnf-wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	<p>Insert the e-mail where newsletter registrations will be sent to.</p>
	<form action="<?php menu_page_url('cool-newsletter-slug') ?>" method="POST">
		email: <input type = "email" value = "<?php echo self::$option_value ?>" size = "50" name = "email-submit">
		<input class = "button button-primary" type = "submit" value = "Save settings">
	</form>
	<!-- <p>Για να εμφανίσετε τη φόρμα newsletter σε ένα έγγραφο, κάντε copy-paste την παρακάτω εντολή.</p> -->
	<p>To insert the newsletter form in a post type, copy-paste the code below.</p>
	<?php echo "<b>[" . CNLF::SHORTCODE . "]</b>" ?>
</div>