;(function($) {
	(function() {
		$( document ).on( 'click', '._bar-language-item > a', function(event) {
			// Bail if there isn’t any language identifier.
			if ( $(this).attr('rel') === undefined ) {
				alert( _bar.language.message );
				return;
			}

			event.preventDefault();

			// Store link data.
			_bar.language.target = {
				url      : $(this).attr( 'href' ),
				language : $(this).attr( 'rel' )
			};

			// Data to be sent.
			_bar.language.post = {
				action   : '_bar_update_site_language',
				language : _bar.language.target.language,
				nonce    : _bar.language.nonce
			};

			// Post it.
			$.post( _bar.language.ajaxurl, _bar.language.post, 'json' )
			.done(function (response) {
				window.location.reload(true);
			})
			.fail(function (response) {
				alert( _bar.language.message );
				window.location = _bar.language.target.url;
			});
		});
	})();
}(jQuery));
