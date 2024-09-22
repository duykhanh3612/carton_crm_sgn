/**
 * Module for displaying "Waiting for..." dialog using Bootstrap
 */

var waitingDialog = (function ($) {

    // Creating modal dialog's DOM
	var $dialog = $(
		'<div class="modal fade waitingDialogModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
		'<div class="modal-dialog modal-m">' +
		'<div class="modal-content">' +
			'<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
			'<div class="modal-body">' +
				'<div class="progress">\n' +
					'<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>' +
				'</div>' +
			'</div>' +
		'</div>' +
		'</div>' +
		'</div>');

	return {
		/**
		 * Opens our dialog
		 * @param message Custom message
		 * @param options Custom options:
		 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
		 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
		 */
		show: function (message, options) {
			// Assigning defaults
			if (typeof message === 'undefined') {
				message = 'Loading';
			}
			if (typeof options === 'undefined') {
				options = {};
			}
			var settings = $.extend(
				{},
				{
					dialogSize: 'm',
					progressType: 'progress-bar-striped progress-bar-animated',
					backdrop: 'static',
					keyboard: 'false',
				},
				options
			);

			// Configuring dialog
			$dialog.attr({
				'data-backdrop': settings.backdrop,
				'data-keyboard': settings.keyboard,
			});

			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
			$dialog.find('.progress-bar').attr('class', 'progress-bar');
			if (settings.progressType) {
				$dialog.find('.progress-bar').addClass(settings.progressType);
			}
			$dialog.find('h3').text(message);
			// Opening dialog
			$dialog.modal();
		},
		/**
		 * Closes dialog
		 */
		hide: function () {
			setTimeout(function () {
				$dialog.modal('hide');
			}, 500);
		},
		getDialog: function () {
			return $dialog;
		},
	}

})(jQuery);
