
jQuery().ready(function() {
	jQuery("#post").validate({
		rules: {
			customtypes_telefono: {
			  number: true,
			  range: [600000000, 999999999]
			},
			_wp_attachment_image_alt: {
				required: true
			}
		}
	});
	jQuery("#attachment_alt").validate({
		required: true
	});
});