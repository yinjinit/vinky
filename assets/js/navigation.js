/**
 * Custom modules for global Javascript actions.
 *
 * @package
 */

/**
 * Menu Toggle Behaviors
 *
 * @param {string} id - The ID.
 */
var vinkyNavMenu = function( id ) {
	var wrapper = document.body, // Element to which a CSS class is added when a mobile nav menu is open
		mobileButton = document.getElementById( id + '-mobile-menu' );

	if ( mobileButton ) {
		mobileButton.onclick = function() {
			wrapper.classList.toggle( id + '-nav-open' );
			wrapper.classList.toggle( 'lock-scrolling' );
			vinkyToggleAriaExpanded( mobileButton );
			mobileButton.focus();
		};
	}

	/**
	 * Trap keyboard navigation in the menu modal.
	 */
	document.addEventListener( 'keydown', function( event ) {
		var modal, elements, selectors, lastEl, firstEl, activeEl, tabKey, shiftKey,
			escKey;

		if ( ! wrapper.classList.contains( id + '-nav-open' ) ) {
			return;
		}

		modal = document.querySelector( '.' + id + '-navigation' );
		selectors = 'input, a, button';
		elements = modal.querySelectorAll( selectors );
		elements = Array.prototype.slice.call( elements );
		tabKey = event.key === 'Tab';
		shiftKey = event.shiftKey;
		escKey = event.key === 'Escape';
		activeEl = window.document.activeElement;
		lastEl = elements[ elements.length - 1 ];
		firstEl = elements[ 0 ];

		if ( escKey ) {
			event.preventDefault();
			wrapper.classList.remove( id + '-nav-open', 'lock-scrolling' );
			vinkyToggleAriaExpanded( mobileButton );
			mobileButton.focus();
		}

		if ( ! shiftKey && tabKey && lastEl === activeEl ) {
			event.preventDefault();
			firstEl.focus();
		}

		if ( shiftKey && tabKey && firstEl === activeEl ) {
			event.preventDefault();
			lastEl.focus();
		}

		// If there are no elements in the menu, don't move the focus
		if ( tabKey && firstEl === lastEl ) {
			event.preventDefault();
		}
	} );

	document.getElementById( 'site-navigation' ).querySelectorAll( '.menu-wrapper > .menu-item-has-children' ).forEach( function( li ) {
		li.addEventListener( 'mouseenter', function() {
			vinkySubmenuPosition( li );
		} );
		li.addEventListener( 'mouseleave', function() {
			this.classList.remove( 'hover' );
		} );
	} );
};

/**
 * Toggle an attribute's value
 *
 * @param {Element} el - The element.
 * @since 1.0.0
 */
function vinkyToggleAriaExpanded( el ) {
	if ( 'true' !== el.getAttribute( 'aria-expanded' ) ) {
		el.setAttribute( 'aria-expanded', 'true' );
	} else {
		el.setAttribute( 'aria-expanded', 'false' );
	}
}

/**
 * Changes the position of submenus so they always fit the screen horizontally.
 *
 * @param {Element} li - The li element.
 */
function vinkySubmenuPosition( li ) {
	var subMenu = li.querySelector( 'ul.sub-menu' ),
		rect = subMenu.getBoundingClientRect(),
		right = Math.round( rect.right ),
		left = Math.round( rect.left ),
		windowWidth = Math.round( window.innerWidth );

	if ( right > windowWidth ) {
		subMenu.classList.add( 'submenu-right' );
	} else if ( document.body.classList.contains( 'rtl' ) && left < 0 ) {
		subMenu.classList.add( 'submenu-left' );
	}
}

( function() {
	window.addEventListener( 'load', function() {
		new vinkyNavMenu( 'primary' );
	} );
}() );
