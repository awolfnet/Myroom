/* global jQuery, ajax_object */
jQuery( document ).ready(
	function($) {

		function getNode(n, v) {
			var issvg = false;
			if (n === 'svg') {
				issvg = true;
			}

			n = document.createElementNS( "http://www.w3.org/2000/svg", n );
			for (var p in v) {
				n.setAttributeNS( null, p.replace( 'column',':' ), v[p] );
			}

			if (issvg) {
				n.setAttributeNS( 'http://www.w3.org/XML/1998/namespace', "xml:space", "preserve" );
			}
			return n
		}

		document.querySelector( 'html' ).addEventListener(
			'click',
			function (e) {
				if (e.target.getAttribute( 'show-icons' ) === '') {
					e.preventDefault();
					var elShowIcons = $( e.target ),
					elTarget        = elShowIcons.data( 'target' ),
					elTargetInput   = $( '#' + elTarget ),
					elIconsBox      = $( '#icons-box' );

					if ( ! elIconsBox.length) {
						$( 'body' ).append( '<div id="icons-box" style="display:none;"></div>' );
						elIconsBox = $( '#icons-box' );
					}

					elIconsBox.html( '' );

					var spinner = getNode( "svg", { width: '64px', height: '64px', viewBox: '0 0 128 128' } );
					var gg      = getNode( "g" );

					spinner.style.margin  = '160px auto';
					spinner.style.display = 'block';

					elIconsBox[0].appendChild( spinner );
					spinner.appendChild( gg )

					var all = [
					{key: 'path', vals: {d: 'M64 0L40.08 21.9a10.98 10.98 0 0 0-5.05 8.75C34.37 44.85 64 60.63 64 60.63V0z', fill: '#ffb118'}},
					{key: 'path', vals: {d: 'M128 64l-21.88-23.9a10.97 10.97 0 0 0-8.75-5.05C83.17 34.4 67.4 64 67.4 64H128z', fill: '#80c141'}},
					{key: 'path', vals: {d: 'M63.7 69.73a110.97 110.97 0 0 1-5.04-20.54c-1.16-8.7.68-14.17.68-14.17h38.03s-4.3-.86-14.47 10.1c-3.06 3.3-19.2 24.58-19.2 24.58z', fill: '#cadc28'}},
					{key: 'path', vals: {d: 'M64 128l23.9-21.88a10.97 10.97 0 0 0 5.05-8.75C93.6 83.17 64 67.4 64 67.4V128z', fill: '#cf171f'}},
					{key: 'path', vals: {d: 'M58.27 63.7a110.97 110.97 0 0 1 20.54-5.04c8.7-1.16 14.17.68 14.17.68v38.03s.86-4.3-10.1-14.47c-3.3-3.06-24.58-19.2-24.58-19.2z', fill: '#ec1b21'}},
					{key: 'path', vals: {d: 'M0 64l21.88 23.9a10.97 10.97 0 0 0 8.75 5.05C44.83 93.6 60.6 64 60.6 64H0z', fill: '#018ed5'}},
					{key: 'path', vals: {d: 'M64.3 58.27a110.97 110.97 0 0 1 5.04 20.54c1.16 8.7-.68 14.17-.68 14.17H30.63s4.3.86 14.47-10.1c3.06-3.3 19.2-24.58 19.2-24.58z', fill: '#00bbf2'}},
					{key: 'path', vals: {d: 'M69.73 64.34a111.02 111.02 0 0 1-20.55 5.05c-8.7 1.14-14.15-.7-14.15-.7V30.65s-.86 4.3 10.1 14.5c3.3 3.05 24.6 19.2 24.6 19.2z', fill: '#f8f400'}},
					{key: 'circle', vals: {cx: '64', cy: '64', r: '2.03'}},
					{key: 'animateTransform', vals: {attributeName: 'transform', type: 'rotate', from: '0 64 64', to: '-360 64 64', dur: '1500ms', repeatCount: 'indefinite'}},
					];

					$.each(
						all,
						function (k, v) {
							var ff = getNode( v.key, v.vals );
							gg.appendChild( ff )
						}
					);

					tb_show( "Choose Icon", "#TB_inline?inlineId=icons-box" );

					var data = {
						'action': 'svg_icon_list', // Php function name.
						'icon': (elShowIcons[0] && elShowIcons[0].getAttribute( 'data-chosen' )) || '' // Some parameter to send ajax function.
					};

					console.log(elShowIcons);

					jQuery.post(
						ajax_object.ajax_url,
						data,
						function(response) {

							$( '#TB_ajaxContent' ).html( '<div>' + response + '</div>' );

							var elIconsBoxContent  = $( '.icons-box-content' ),
							elIconsBoxInnerContent = elIconsBoxContent.find( '.icons-box-inner-content' ),
							elChosenIcon           = $( '.chosen-icon' );

							$( '.btn-from-tb' ).on(
								'click',
								function () {
									tb_remove();
								}
							);

							$( '.site-icon-search' ).on(
								'keyup',
								function () {
									var val = $( this ).val();

									if ( ! val.length) {
										elIconsBoxInnerContent.find( '.site-icon-col' ).removeClass( 'hide show' );
									} else {
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
								}
							);

							$( '.site-clear' ).on(
								'click',
								function () {
									elChosenIcon.html( '' );
									elIconsBoxContent.find( '.chosen' ).removeClass( 'chosen' );
								}
							);

							$( '.site-confirm' ).on(
								'click',
								function () {

									var chosen    = $( '.chosen-icon .chosen' ),
									chosenSvgHtml = '';

									if (chosen.length) {
										chosenSvgHtml = chosen.find( 'svg' )[0] || ''
									}

									elTargetInput.val( chosen.data( 'xlink' ) || '' );

									elShowIcons[0].setAttribute( 'data-chosen', chosen.data( 'xlink' ) || '' );

									document.querySelector( '[data-editby="' + elTarget + '"]' ).innerHTML = '';
									if (chosen) {
										document.querySelector( '[data-editby="' + elTarget + '"]' ).append( chosenSvgHtml )
									}

									tb_remove();
								}
							);
						}
					);
				}
			}
		);
	}
);
