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
					name = $element.attr('data-uploader-name'),
					upload_button = $element.attr('data-upload-button-upload'),
					cancel_button = $element.attr('data-upload-button-cancel'),
					fail_message = $element.attr('data-upload-fail-message'),
					form = $element.attr('data-upload-form'),
					image_uploader = $element.attr('data-upload-image-uploader');

				new qq.FileUploader({

					'element': body_element,
					'multiple': false,
					allowedExtensions: [],

					'onComplete': function (id, filename, response) {
						var imageContainer, path;

						if (image_uploader === "true") {

							imageContainer = $('.qq-file-preview', $element);
							path = mjolnir.thumbs
								.replace(':image', mjolnir.base_path+response['path'].replace('\\', '/'))
								.replace(':width', 100)
								.replace(':height', 100)


							$('.uploader-input', $element).detach();
							$('<input form="'+form+'" class="uploader-input" type="hidden" name="'+name+'" value="'+response["path"]+'" />').prependTo($element);
							$('.uploader-preview-image', $element).detach();

							if (response['success'] && image_uploader === 'true') {
								$('<img class="uploader-preview-image" src="'+path+'"/>').prependTo(imageContainer);
								$(imageContainer).addClass('has-image');
							}

							$element.siblings('.file-preview').detach();

						}

						$('.uploader-context', $element).removeClass('has-image');
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