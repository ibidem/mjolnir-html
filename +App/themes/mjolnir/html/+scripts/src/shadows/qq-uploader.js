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
//					name = $element.attr('data-uploader-name'),
					upload_button = $element.attr('data-upload-button-upload'),
					cancel_button = $element.attr('data-upload-button-cancel'),
					fail_message = $element.attr('data-upload-fail-message'),
//					form = $element.attr('data-upload-form'),
					image_uploader = $element.attr('data-upload-image-uploader'),
					preview_id = $element.attr('data-preview-id'),
					field_id = $element.attr('data-field-id'),
					width = $element.attr('data-preview-width'),
					height = $element.attr('data-preview-height');

				new qq.FileUploader({

					'element': body_element,
					'multiple': false,
					allowedExtensions: [],

					'onComplete': function (id, filename, response) {
						var path;

						if (image_uploader === "true") {	
							path = mjb.mjolnir.routes.thumbnail
								.replace(':image', mjb.mjolnir.config.base.urlpath + response['path'].replace('\\', '/'))
								.replace(':width', typeof width !== 'undefined' ? width : 100)
								.replace(':height', typeof height !== 'undefined' ? height : 100)

							$('#'+field_id).val(response['path']);

							if (response['success'] && image_uploader === 'true') {
								$('#'+preview_id).attr('src', path);
								$('#'+preview_id).removeClass('off');
							}
							else {
								$('#'+preview_id).addClass('off');
							}
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