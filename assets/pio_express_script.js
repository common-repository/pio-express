// Color picker
jQuery(document).ready(function($) {
	$('.color-picker').wpColorPicker();
});

// upload logo/ background-image
jQuery(document).ready(function($) {
	var file_frame;
	if (wp.media) {
		var wp_media_post_id = wp.media.model.settings.post.id;// Store the old id

		jQuery('.upload_image_button').on('click', function(event) {

			event.preventDefault();
			var imgname = this.getAttribute("data-img-type");

			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Select a image to upload',
				button: {
					text: 'Use this image',
				},
				library:{
					type:['image/png',
					'image/jpg',
					'image/jpeg',
					'image/gif']
				},
				multiple: false
			});

			file_frame.on('select', function() {
				attachment = file_frame.state().get('selection').first().toJSON();
				if (imgname == 'logo') {
					$('#image-preview').attr('src', attachment.url).css('width', 'auto');
					$('#logo_attachment_id').val(attachment.id);
				}
				else if (imgname == 'background') {
					if($('#image-preview_bg').length){
						$('#image-preview_bg').attr('src', attachment.url).css('width', 'auto');
					}else{
						$('.background-image-wrapper').html("<img id='image-preview_bg' src='" +  attachment.url + "' height='100'>")
					}
					$('#logo_attachment_bg_id').val(attachment.id);
				}
			});

			file_frame.open();
		});
	}

	$('.login_page_bg').click(function() {
		var targetBox = $(this).data("target");
		$(".box").not(targetBox).hide();
		$(targetBox).show();
	});
});

// accordion script
jQuery(document).on('click', '.acc-panel .collapse', function(){
	var thisElement = jQuery(this);
	var parentPanel = thisElement.closest('.acc-panel');
	jQuery('.acc-panel').not(parentPanel).removeClass('active');
	parentPanel.toggleClass('active');
})