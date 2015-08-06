;(function($) {
	(function() {
		$( document ).on( 'click', '._bar-language-item > a', function(event) {
			// Bail if there isn’t any language identifier.
			if ( $(this).attr('rel') === undefined ) {
				alert( _bar.message );
				return;
			}

			event.preventDefault();

			// Store link data.
			_bar.target = {
				url      : $(this).attr( 'href' ),
				language : $(this).attr( 'rel' )
			};

			// Data to be sent.
			_bar.post = {
				action   : '_bar_update_site_language',
				language : _bar.target.language,
				nonce    : _bar.nonce
			};

			// Post it.
			$.post( _bar.ajaxurl, _bar.post, 'json' )
			.done(function (response) {
				window.location.reload(true);
			})
			.fail(function (response) {
				alert( _bar.message );
				window.location = _bar.target.url;
			});
		});
	})();
}(jQuery));
