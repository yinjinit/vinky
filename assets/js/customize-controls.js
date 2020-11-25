( function( api, $ ) {
	api.bind( 'ready', function() {
		vinkyInitDeviceButtons();
	} );

	api.bind( 'change', function() {
		// Show/hide controls based on their dependencies.
		vinkyUpdateDependencies();
	} );

	api.bind( 'pane-contents-reflowed', function() {
		// Show/hide controls based on their dependencies.
		vinkyUpdateDependencies();

		// Re-order the controls based on the parent/child relations.
		vinkyInitGroup();
	} );

	api.controlConstructor[ 'vky-group' ] = api.Control.extend( {
		ready: function() {
			var control = this;

			control.container.on( 'click', '.vky-toggle-indicator', function() {
				var $this = $( this );

				$this.toggleClass( 'open' );

				if ( $this.hasClass( 'open' ) ) {
					control.container.find( '.vky-headline' ).siblings( '.vky-fields-wrapper' ).fadeIn();
				} else {
					control.container.find( '.vky-headline' ).siblings( '.vky-fields-wrapper' ).fadeOut();
				}
			} );
		},
	} );

	api.controlConstructor[ 'vky-slider' ] = api.Control.extend( {
		ready: function() {
			var control = this,
				linker = control.container.find( 'input[type="hidden"]' ),
				slider = control.container.find( 'input[type="range"]' ),
				stepper = control.container.find( 'input[type="number"]' ),
				resetBtn = control.container.find( '.vky-reset-slider' );

			slider.on( 'input change', function() {
				var val = slider.val(),
					values = linker.val().split( ',' );

				values = updateValuesByDevice( values, val );

				stepper.val( val );
				linker.val( values.join() ).trigger( 'change' );
			} );

			stepper.on( 'input change', function() {
				slider.val( stepper.val() );
				linker.val( stepper.val() ).trigger( 'change' );
			} );

			resetBtn.on( 'click', function() {
				var defaultVal = linker.data( 'reset_value' );

				slider.val( defaultVal );
				stepper.val( defaultVal );
				linker.val( defaultVal ).trigger( 'change' );
			} );
		},
	} );

	api.controlConstructor[ 'vky-all-fonts' ] = api.Control.extend( {
		ready: function() {
			var control = this,
				linker = control.container.find( 'input[type="hidden"]' ),
				existingFonts,
				availableVariants,
				allVariantsMapping = {
					'0,100': 'Thin 100',
					'1,100': 'Thin 100 Italic',
					'0,200': 'Extra-Light 200',
					'1,200': 'Extra-Light 200 Italic',
					'0,300': 'Light 300',
					'1,300': 'Light 300 Italic',
					'0,400': 'Regular 400',
					'1,400': 'Regular 400 Italic',
					'0,500': 'Medium 500',
					'1,500': 'Medium 500 Italic',
					'0,600': 'Semi-Bold 600',
					'1,600': 'Semi-Bold 600 Italic',
					'0,700': 'Bold 700',
					'1,700': 'Bold 700 Italic',
					'0,800': 'Extra-Bold 800',
					'1,800': 'Extra-Bold 800 Italic',
					'0,900': 'Black 900',
					'1,900': 'Black 900 Italic',
				};

			existingFonts = ! linker.val() ? {} : JSON.parse( linker.val() );

			_.each( existingFonts, function( selectedVariants, font ) {
				var selectedFontHtml = '<li><label><strong>' + font + '</strong><span' +
					' class="delete-font">Remove Font</span></label></li>',
					selectedFontEle;

				control.container.find( '.vky-selected-fonts' )
					.append( selectedFontHtml );

				selectedFontEle = control.container.find( '.vky-selected-fonts li:last-child label' );

				selectedFontEle
					.append( '<select class="vky-control-font-variants" data-font="' + font + '" multiple></select>' );

				availableVariants = getFontVariants( font, Object.keys( allVariantsMapping ) );

				_.each( availableVariants, function( variant ) {
					var text = variant,
						optHtml;

					if ( allVariantsMapping.hasOwnProperty( variant ) ) {
						text = allVariantsMapping[ variant ];
					}

					optHtml = '<option value="' + variant + '"';

					if ( selectedVariants.indexOf( variant ) !== -1 ) {
						optHtml += ' selected';
					}

					optHtml += '>' + text + '</option>';

					selectedFontEle.find( 'select' ).append( optHtml );
				} );
			} );

			control.container.find( '.vky-control-all-fonts' ).select2();
			control.container.find( '.vky-control-font-variants' ).select2();

			control.container.on( 'click', 'button.add-new-font', function() {
				var allFonts = control.container.find( '.vky-control-all-fonts' ),
					newValue = allFonts.val(),
					newFont,
					newFontVariants;

				if ( ! newValue ) {
					return;
				}

				existingFonts = ! linker.val() ? {} : JSON.parse( linker.val() );

				newFont = allFonts.find( 'option:selected' ).text();

				if ( existingFonts.hasOwnProperty( newFont ) ) {
					return;
				}

				existingFonts[ newFont ] = {};

				// Update customize linker with updated fonts.
				linker.val( JSON.stringify( existingFonts ) );

				control.container.find( '.vky-selected-fonts' ).append( '<li><label><strong>' + newFont + '</strong><span class="delete-font">Remove Font</span></label></li>' );

				availableVariants = getFontVariants( newFont, Object.keys( allVariantsMapping ) );

				control.container.find( '.vky-selected-fonts li:last-child label' )
					.append( '<select class="vky-control-font-variants" data-font="' + newFont + '" multiple></select>' );

				newFontVariants = control.container.find( '.vky-selected-fonts select[data-font="' + newFont + '"]' );

				_.each( availableVariants, function( variant ) {
					var text = variant;

					if ( allVariantsMapping.hasOwnProperty( variant ) ) {
						text = allVariantsMapping[ variant ];
					}

					newFontVariants.append( '<option value="' + variant + '">' + text + '</option>' );
				} );

				newFontVariants.select2( {
					placeholder: 'Select a variant',
				} );
			} );

			control.container.on( 'click', '.delete-font', function() {
				$( this ).closest( 'li' ).remove();
				updateSelectedFonts( control );
			} );

			control.container.on( 'change', '.vky-control-font-variants', function() {
				updateSelectedFonts( control );
			} );
		},
	} );

	api.controlConstructor[ 'vky-color' ] = api.Control.extend( {
		ready: function() {
			var control = this;

			control.container.find( '.vky-color-picker-alpha' ).wpColorPicker();
		},
	} );

	/**
	 * Update visibility of controls depending on this control.
	 *
	 * @return {void}
	 */
	function vinkyUpdateDependencies() {
		_.each( Object.keys( vinkyControls.dependencies ), function( id ) {
			var visibility = vinkyGetVisibility( id );

			if ( visibility === true ) {
				api.control( id ).container.fadeIn();
			} else {
				api.control( id ).container.fadeOut();
			}
		} );
	}

	/**
	 * Get visibility of a Customizer control.
	 *
	 * @param {string} controlId - Control Id.
	 *
	 * @return {boolean} Returns true if the control is shown.
	 */
	function vinkyGetVisibility( controlId ) {
		var dependency = vinkyControls.dependencies[ controlId ],
			conditions,
			operator,
			visibility,
			i;

		conditions = dependency.conditions;

		if ( ! _.isUndefined( conditions ) ) {
			operator = dependency.operator ? dependency.operator.toLowerCase() : 'and';

			// Use for-loop for breaking in the meanwhile.
			for ( i = 0; i < conditions.length; i++ ) {
				visibility = getVisibilityByCondition( conditions[ i ] );

				if ( ( operator === 'or' && visibility === true ) || ( operator === 'and' && visibility === false ) ) {
					break;
				}
			}
		} else {
			visibility = getVisibilityByCondition( dependency );
		}

		return visibility;
	}

	/**
	 * Get visibility of a dependency condition.
	 *
	 * @param {Array} condition - Array of condition compare.
	 *
	 * @return {boolean} Returns true if the condition is satisfied.
	 */
	function getVisibilityByCondition( condition ) {
		var visibility;

		if ( _.isUndefined( vinkyControls.dependencies[ condition[ 0 ] ] ) ) {
			visibility = api.control( condition[ 0 ] ).active();
		} else {
			visibility = vinkyGetVisibility( condition[ 0 ] );
		}

		if ( visibility === true ) {
			visibility = compare( condition );
		}

		return visibility;
	}

	/**
	 * Compare values
	 *
	 * @param {Array} condition - The condition for a dependency.
	 *
	 * @return {boolean} - Returns a boolean result.
	 */
	function compare( condition ) {
		var id = condition[ 0 ],
			operator = condition[ 1 ],
			compared = condition[ 2 ],
			setting = api.control( id ).setting(),
			result = false;

		switch ( operator ) {
			case '===':
				result = ( setting === compared ) ? true : false;
				break;
			case '!==':
				result = ( setting !== compared ) ? true : false;
				break;
		}

		return result;
	}

	/**
	 * Update values by current device.
	 *
	 * @param {Array|string} values - Value array. Each array values are mapped to device in order of desktop, tablet, mobile.
	 * @param {string} val - Value to be used for update first param.
	 *
	 * @return {Array} Values array which comes from first param.
	 */
	function updateValuesByDevice( values, val ) {
		var device = wp.customize.previewedDevice.get(),
			availableDevices = [ 'desktop', 'tablet', 'mobile' ];

		var index = availableDevices.indexOf( device ),
			i = values.length + 1;

		while ( i++ <= index ) {
			values.push( '' );
		}

		values[ index ] = val;

		return values;
	}

	function vinkyInitGroup() {
		_.each( vinkyControls.relations, function( children, parentId ) {
			var parent = api.control( parentId );

			if ( parent ) {
				_.each( children, function( childId ) {
					var child = api.control( childId );

					if ( child ) {
						parent.container.find( 'ul.vky-fields' ).append( child.container );
					}
				} );
			}
		} );
	}

	function vinkyInitDeviceButtons() {
		$( '.customize-control .devices button' ).on( 'click', function() {
			if ( $( this ).hasClass( 'active' ) ) {
				return;
			}

			api.previewedDevice.set( $( this ).data( 'device' ) );
		} );

		api.previewedDevice.bind( function( newDevice ) {
			$( '.customize-control .devices button' )
				.removeClass( 'active' )
				.attr( 'aria-pressed', false );

			$( '.customize-control .devices button.preview-' + newDevice )
				.addClass( 'active' )
				.attr( 'aria-pressed', true );
		} );
	}

	function getFontVariants( font, defaults ) {
		var variants;

		if ( vinkyControls.customFonts &&
			vinkyControls.customFonts.hasOwnProperty( font ) &&
			vinkyControls.customFonts[ font ].variants
		) {
			variants = vinkyControls.fonts[ font ].variants;
		} else if ( vinkyControls.googleFonts &&
			vinkyControls.googleFonts.hasOwnProperty( font ) &&
			vinkyControls.googleFonts[ font ].variants
		) {
			variants = vinkyControls.googleFonts[ font ].variants;
		} else {
			variants = defaults;
		}

		return variants;
	}

	/**
	 * Update Selected Fonts Linker and trigger update for customize preview.
	 *
	 * @param {Object} control - Customizer control.
	 */
	function updateSelectedFonts( control ) {
		var existingFonts = {},
			linker = control.container.find( 'input[type="hidden"]' );

		control.container.find( '.vky-control-font-variants' ).each( function() {
			var font = $( this ).data( 'font' );
			existingFonts[ font ] = $( this ).val();
		} );

		linker.val( JSON.stringify( existingFonts ) ).trigger( 'change' );
	}
}( wp.customize, jQuery ) );
