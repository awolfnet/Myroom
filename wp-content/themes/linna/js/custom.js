/**
 * Custom javascript code to enhance theme.
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

/**
 * Header sticky polyfill,
 * If browser doesn't support position fixed attribute then use this plugin to mimic same effect
 */
if (typeof Stickyfill !== 'undefined') {
	const stickies = document.querySelectorAll( '.site-position-sticky' )
	Stickyfill.add( stickies );
}

/**
 * Site Sidebar Toggle.
 *
 * @type {Function}
 */
function site_sidebar_toggle() {
	const sidebar = document.querySelector( '.site-sidebar' );
	if (sidebar) {
		sidebar.toggleAttribute( 'open' )
	}
}

/**
 * Open site sidebar.
 *
 * @type {Element}
 */
const site_sidebar_opener = document.querySelectorAll( '.site-sidebar-toggle' );
if (site_sidebar_opener) {
	const countToggle = site_sidebar_opener.length;
	for (let i = 0; i < countToggle; i++) {
		site_sidebar_opener[i].addEventListener( 'click', site_sidebar_toggle );
	}
}

/**
 * Show or hide child menu.
 *
 * @type {Element}
 */
const submenu_expand = document.querySelectorAll( '.submenu-expand, [aria-haspopup="true"]' );
if (submenu_expand) {
	const count_buttons = submenu_expand.length;
	for (let i = 0; i < count_buttons; i++) {
		submenu_expand[i].addEventListener(
			'click',
			function () {
				const item = this.parentElement.querySelector( 'a' );
				if (item.hasAttribute( 'aria-expanded' )) {
					const attribute = item.getAttribute( 'aria-expanded' );

					if (attribute === 'true') {
						item.setAttribute( 'aria-expanded', 'false' )
					} else {
						item.setAttribute( 'aria-expanded', 'true' )
					}
				}
			}
		);
	}
}
