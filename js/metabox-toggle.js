jQuery(document).ready( function() {
	jQuery('#page_template').change(function() {
		jQuery('#team-designation').toggle(jQuery(this).val() === 'page-templates/template-team.php');
	}).change();
});
