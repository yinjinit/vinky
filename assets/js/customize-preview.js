( function( api, $ ) {
	api( 'logo_width', function( setting ) {
		setting.bind( function( value ) {
			if ( value.desktop !== '' ||
				value.tablet !== '' ||
				value.mobile !== '' ) {
				_.each( value, function( val, device ) {
					document.documentElement.style.setProperty( '--site-identity--' + device + '-width', val );
				} );
			} else {
				api.preview.send( 'refresh' );
			}
		} );
	} );

	api( 'all_fonts', function( setting ) {
		setting.bind( function( value ) {
			var fonts;

			if ( ! value ) {
				return;
			}

			fonts = JSON.parse( value );

			$( 'link.vinky-google-font' ).remove();

			_.each( fonts, function( variants, font ) {
				var link;

				variants.sort();

				link = encodeURI( '//fonts.googleapis.com/css2?family=' + font + ':ital,wght@' + variants.join( ';' ) + '&display=swap' );

				if ( font in vinkyCustomizer.googleFonts ) {
					$( 'head' ).append( '<link class="vinky-google-font" href="' + link + '"  rel="stylesheet">' );
				}
			} );
		} );
	} );

	api( 'content_width', function( setting ) {
		setting.bind( function( value ) {
			document.documentElement.style.setProperty( '--responsive--content-width', value );
		} );
	} );
}( wp.customize, jQuery, _ ) );
