/**
 * Shadow wrapper for qq.uploader
 */
;(function ($) {
	
	$.jshadow({
		'name': 'qq-uploader',
		'wrapper': '[data-qq-uploader-context]',

		'init': function () {
			$('.uploader-context').each(function () {
				var $element = $(this),
					body_element = $('.uploader-body', $element).get(0),
					upload_action = $element.attr('data-uploader-action'),
					upload_button = $element.attr('data-upload-button-upload'),
					cancel_button = $element.attr('data-upload-button-cancel'),
					fail_message = $element.attr('data-upload-fail-message'),
					uploader_type = $element.attr('data-upload-uploader-type'),
					preview_id = $element.attr('data-preview-id'),
					preview_width = $element.attr('data-preview-width'),
					preview_height = $element.attr('data-preview-height'),
					field_id = $element.attr('data-field-id'),
					width = $element.attr('data-preview-width'),
					height = $element.attr('data-preview-height');

				new qq.FileUploader({

					'element': body_element,
					'multiple': false,
					allowedExtensions: [],

					'onComplete': function (id, filename, response) {
						var path;

						if (uploader_type === "image") {
							path = mjb.mjolnir.routes.thumbnail
								.replace(':image', mjb.mjolnir.config.base.urlpath + response['path'].replace('\\', '/'))
								.replace(':width', typeof width !== 'undefined' ? width : 100)
								.replace(':height', typeof height !== 'undefined' ? height : 100);

							$('#'+field_id).val(response['path']);

							if (response['success']) {
								$('#'+preview_id).attr('src', path);
								$('#'+preview_id).removeClass('off');
							}
							else {
								$('#'+preview_id).addClass('off');
							}
						}
						else if (uploader_type === 'video') {
							// calculate mimetype
							var basefile = response['path'].replace('\\', '/').replace(/\.[^\.]+$/, '');
							
							$('#'+field_id).val(response['path']);

							var $preview = $('#'+preview_id);
							
							var html = '<div class="video"><video width="'+preview_width+'" height="'+preview_height+'" controls>';
							$.each(mjb.mjolnir.uploads.video.formats, function (ext, mime) {
								html += '<source type="'+mime+'" src="' + mjb.mjolnir.config.base.urlbase + basefile + '.' + ext +'"/>';
							});
							html += '</video></div>';
							
							$preview.html(html);
							$preview.removeClass('off');
						}
						else { // unknown uploader type
							console.log('Unknown type.');
						}
					},

					'uploadButtonText': upload_button,
					'cancelButtonText': cancel_button,
					'failUploadText': fail_message,

					'action': upload_action
				});
			});
		}
	});
	
}(window.jQuery));