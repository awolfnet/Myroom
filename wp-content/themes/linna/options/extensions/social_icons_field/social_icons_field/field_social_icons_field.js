/*global jQuery, document, redux_change, redux*/

(function ($) {
	"use strict";

	/*redux.field_objects = redux.field_objects || {};
	redux.field_objects.sortable = redux.field_objects.sortable || {};*/

	// var scroll = '';

	// redux.field_objects.sortable.init = function( selector ) {

	function init_color_picker() {
		$( '.color_field' ).each(
			function () {
				$( this ).wpColorPicker();
			}
		);
	}

	var selector;
	if ( ! selector) {
		selector = $( document ).find( ".socials-sortable" );
		init_color_picker();
	}

	$( selector ).each(
		function () {
			var el = $( this );
			el.sortable(
				{
					handle: ".drag",
					placeholder: "placeholder",
					opacity: 0.7,
					scroll: false,
					out: function (event, ui) {
						if ( ! ui.helper) {
							return;
						}
						if (ui.offset.top > 0) {
							scroll = 'down';
						} else {
							scroll = 'up';
						}
					},

					over: function (event, ui) {
						scroll = '';
					},

					deactivate: function (event, ui) {
						scroll = '';
					},

					update: function (event, ui) {
						// console.log('here');
						redux_change( $( this ) );
					}
				}
			);/*

				el.find( '.checkbox_sortable' ).on(
					'click', function() {
						if ( $( this ).is( ":checked" ) ) {
							el.find( '#' + $( this ).attr( 'rel' ) ).val( 1 );
						} else {
							el.find( '#' + $( this ).attr( 'rel' ) ).val( '' );
						}
					}
				);*/

			el.next( '.sortable-add-new-item' ).on(
				'click',
				function (e) {
					var $default = $(this).siblings( '.hidden-default-li' ).find('li').clone().first();/*.prop('outerHTML')*/
					var $key     = Math.max.apply(
						1,
						el.find( 'li' ).map(
							function (k, v) {
								return parseInt( v.dataset.count );
							}
						)
					) + 1;

					if ($key < 0) {
						$key = 0;
					}

					var $elSvgValue             = $default.find( '.value-svg' );
					var $elHrefValue            = $default.find( '.value-href' );
					var $elBackgroundColorValue = $default.find( '.value-backgroundcolor' );
					var $elColorValue           = $default.find( '.value-color' );
					var $showBtn                = $default.find( '[data-target]' );
					var $chosenIconWrap         = $default.find( '.site-menu-chosen-icon' );

					$default.attr( 'data-count', $key );

					$elSvgValue.attr( 'name', $elSvgValue.attr( 'data-name' ).replace( '%1$s', $key ) );
					$elSvgValue.attr( 'id', $elSvgValue.attr( 'id' ).replace( '%1$s', $key ) );
					$elSvgValue.attr( 'value', $elSvgValue.attr( 'value' ).replace( '%3$s', '' ) );

					$elHrefValue.attr( 'name', $elHrefValue.attr( 'data-name' ).replace( '%1$s', $key ) );
					$elHrefValue.attr( 'id', $elHrefValue.attr( 'id' ).replace( '%1$s', $key ) );
					$elHrefValue.attr( 'value', $elHrefValue.attr( 'value' ).replace( '%5$s', '' ) );

					$elBackgroundColorValue.attr( 'name', $elBackgroundColorValue.attr( 'data-name' ).replace( '%1$s', $key ) );
					$elBackgroundColorValue.attr( 'id', $elBackgroundColorValue.attr( 'id' ).replace( '%1$s', $key ) );
					$elBackgroundColorValue.attr( 'value', $elBackgroundColorValue.attr( 'value' ).replace( '%6$s', '' ) );
					$elBackgroundColorValue.attr( 'class', $elBackgroundColorValue.attr( 'class' ).replace( '%8$s', 'color_field' ) );

					$elColorValue.attr( 'name', $elColorValue.attr( 'data-name' ).replace( '%1$s', $key ) );
					$elColorValue.attr( 'id', $elColorValue.attr( 'id' ).replace( '%1$s', $key ) );
					$elColorValue.attr( 'value', $elColorValue.attr( 'value' ).replace( '%7$s', '' ) );
					$elColorValue.attr( 'class', $elColorValue.attr( 'class' ).replace( '%8$s', 'color_field' ) );

					$showBtn.attr( 'data-target', $showBtn.attr( 'data-target' ).replace( '%1$s', $key ) );
					$showBtn.attr( 'data-chosen', $showBtn.attr( 'data-chosen' ).replace( '%3$s', '' ) );

					$chosenIconWrap.attr( 'data-editby', $chosenIconWrap.attr( 'data-editby' ).replace( '%1$s', $key ) );
					$chosenIconWrap.html( '' );
					// $input.getAttribute('name');

					// $input.val('');

					$elBackgroundColorValue.wpColorPicker();
					$elColorValue.wpColorPicker();

					el.append( $default );
					el.sortable( 'refresh' );

				}
			);

			document.querySelector( 'html' ).addEventListener(
				'click',
				function (e) {

					if (e.target.getAttribute( 'data-remove-item' ) === '') {
						e.preventDefault();

						if (window.confirm( "Do you really want to remove this item?" )) {
							$( e.target ).parents( 'li' ).remove();

							el.sortable( 'refresh' );
						}
					}

				}
			)
		}
	);

	function getNode(n, v) {
		var issvg = false;
		if (n == 'svg') {
			issvg = true;
		}

		n = document.createElementNS( "http://www.w3.org/2000/svg", n );
		for (var p in v) {
			n.setAttributeNS( null, p.replace( 'column', ':' ), v[p] );
		}

		if (issvg) {
			n.setAttributeNS( 'http://www.w3.org/XML/1998/namespace', "xml:space", "preserve" );
		}
		return n
	}

	document.querySelector( 'html' ).addEventListener(
		'click',
		function (e) {
			// console.log(e.target);
			// console.log(e.target.getAttribute('show-icons'));
			if (e.target.getAttribute( 'data-show-icons' ) === '') {
				e.preventDefault();
				// console.log($(e.target));
				var elShowIcons   = $( e.target ),
					elTarget      = elShowIcons.data( 'target' ),
					elTargetInput = elShowIcons.siblings( '[name="' + elTarget + '"]' );

				// console.log('$(\'#\' + elTarget)', elTarget);

				if ( ! $( '#icons-box' ).length) {
					$( 'body' ).append( '<div id="icons-box" style="display:none;"></div>' )
				}

				// alert('Got this from the server: ' + response);
				var elIconsBox = $( '#icons-box' );

				elIconsBox.html( '' );

				var spinner = getNode( "svg", {width: '64px', height: '64px', viewBox: '0 0 128 128'} );
				var gg      = getNode( "g" );

				spinner.style.margin  = '160px auto';
				spinner.style.display = 'block';

				elIconsBox[0].appendChild( spinner );
				spinner.appendChild( gg )

				var all = [
					{
						key: 'path',
						vals: {
							d: 'M64 0L40.08 21.9a10.98 10.98 0 0 0-5.05 8.75C34.37 44.85 64 60.63 64 60.63V0z',
							fill: '#ffb118'
						}
				},
					{
						key: 'path',
						vals: {
							d: 'M128 64l-21.88-23.9a10.97 10.97 0 0 0-8.75-5.05C83.17 34.4 67.4 64 67.4 64H128z',
							fill: '#80c141'
						}
				},
					{
						key: 'path',
						vals: {
							d: 'M63.7 69.73a110.97 110.97 0 0 1-5.04-20.54c-1.16-8.7.68-14.17.68-14.17h38.03s-4.3-.86-14.47 10.1c-3.06 3.3-19.2 24.58-19.2 24.58z',
							fill: '#cadc28'
						}
				},
					{
						key: 'path',
						vals: {
							d: 'M64 128l23.9-21.88a10.97 10.97 0 0 0 5.05-8.75C93.6 83.17 64 67.4 64 67.4V128z',
							fill: '#cf171f'
						}
				},
					{
						key: 'path',
						vals: {
							d: 'M58.27 63.7a110.97 110.97 0 0 1 20.54-5.04c8.7-1.16 14.17.68 14.17.68v38.03s.86-4.3-10.1-14.47c-3.3-3.06-24.58-19.2-24.58-19.2z',
							fill: '#ec1b21'
						}
				},
					{
						key: 'path',
						vals: {
							d: 'M0 64l21.88 23.9a10.97 10.97 0 0 0 8.75 5.05C44.83 93.6 60.6 64 60.6 64H0z',
							fill: '#018ed5'
						}
				},
					{
						key: 'path',
						vals: {
							d: 'M64.3 58.27a110.97 110.97 0 0 1 5.04 20.54c1.16 8.7-.68 14.17-.68 14.17H30.63s4.3.86 14.47-10.1c3.06-3.3 19.2-24.58 19.2-24.58z',
							fill: '#00bbf2'
						}
				},
					{
						key: 'path',
						vals: {
							d: 'M69.73 64.34a111.02 111.02 0 0 1-20.55 5.05c-8.7 1.14-14.15-.7-14.15-.7V30.65s-.86 4.3 10.1 14.5c3.3 3.05 24.6 19.2 24.6 19.2z',
							fill: '#f8f400'
						}
				},
					{key: 'circle', vals: {cx: '64', cy: '64', r: '2.03'}},
					{
						key: 'animateTransform',
						vals: {
							attributeName: 'transform',
							type: 'rotate',
							from: '0 64 64',
							to: '-360 64 64',
							dur: '1500ms',
							repeatCount: 'indefinite'
						}
				},
				];

				$.each(
					all,
					function (k, v) {
						var ff = getNode( v.key, v.vals );
						gg.appendChild( ff )
					}
				);

				tb_show( "Choose Icon", "#TB_inline?inlineId=icons-box" );

				// console.log(elShowIcons[0].getAttribute('data-chosen'));
				var data = {
					'action': 'svg_icon_list',
					'icon': elShowIcons[0].getAttribute( 'data-chosen' )
				};
				// return;
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				jQuery.post(
					ajax_object.ajax_url,
					data,
					function (response) {

						$( '#TB_ajaxContent' ).html( '<div>' + response + '</div>' );

						var elIconsBoxContent      = $( '.icons-box-content' ),
							elIconsBoxInnerContent = elIconsBoxContent.find( '.icons-box-inner-content' ),
							elChosenIcon           = $( '.chosen-icon' );

						$( '.btn-from-tb' ).on(
							'click',
							function () {
								// alert(123);
								tb_remove();
							}
						);

						$( '.site-icon-search' ).on(
							'keyup',
							function () {
								var val = $( this ).val();
								// console.log(123, val);
								// alert(123);
								if ( ! val.length) {
									elIconsBoxInnerContent.find( '.site-icon-col' ).removeClass( 'hide show' );
								} else {
									// console.log(elIconsBoxInnerContent.find('.site-icon-col svg[data-title*='+val+']'));
									elIconsBoxInnerContent.find( '.site-icon-col svg[data-title*=' + val + ']' ).parents( '.site-icon-col' ).removeClass( 'hide' ).addClass( 'show' );
									elIconsBoxInnerContent.find( '.site-icon-col svg:not([data-title*=' + val + '])' ).parents( '.site-icon-col' ).removeClass( 'show' ).addClass( 'hide' );
								}
							}
						);

						$( '.site-icon-btn' ).on(
							'click',
							function () {
								elChosenIcon.html( '' );

								if ($( this ).parent().hasClass( 'chosen' )) {
									$( this ).parent().removeClass( 'chosen' );
									return;
								}

								elIconsBoxContent.find( '.chosen' ).removeClass( 'chosen' );
								$( this ).parent().addClass( 'chosen' );
								elChosenIcon.html( $( this ).parent().clone() )

								// tb_remove();
							}
						);

						$( '.site-clear' ).on(
							'click',
							function () {
								elChosenIcon.html( '' );
								elIconsBoxContent.find( '.chosen' ).removeClass( 'chosen' );

								// tb_remove();
							}
						);

						$( '.site-confirm' ).on(
							'click',
							function () {
								// elChosenIcon.html('');
								// elIconsBoxContent.find('.chosen').removeClass('chosen');

								var chosen        = $( '.chosen-icon .chosen' ),
									chosenSvgHtml = '';

								if (chosen.length) {
									chosenSvgHtml = chosen.find( 'svg' )[0]
								}

								elTargetInput.val( chosen.data( 'xlink' ) );
								// console.log(elTargetInput.val());
								// console.log(elShowIcons);
								elShowIcons[0].setAttribute( 'data-chosen', chosen.data( 'xlink' ) );

								// console.log(xlink);

								/* var svg = false;
								if(xlink.length){
								svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
								var use = document.createElementNS('http://www.w3.org/2000/svg', 'use');
								// use.setAttribute('xlink:href', xlink);

								use.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', xlink);

								svg.appendChild(use);
								}*/

								// console.log(chosen);
								elShowIcons.siblings( '[data-editby="' + elTarget + '"]' ).html('');
								if (chosen) {
									elShowIcons.siblings( '[data-editby="' + elTarget + '"]' ).html( chosenSvgHtml )
								}

								// elTargetInput.closest('.site-menu-chosen-icon').html(svg);
								tb_remove();
							}
						);
					}
				);
			}
		}
	);
})( jQuery );
