var image = {
	id: settings.image.id,
	url: settings.image.url,
	size: settings.image_size,
	dimension: settings.image_custom_dimension,
	model: view.getEditModel()
};

var image_url  = elementor.imagesManager.getImageUrl( image );
var image_html = '';

if ( image_url ) {
	var ensureAttachmentData = function( id ) {
		if ( 'undefined' === typeof wp.media.attachment( id ).get( 'caption' ) ) {
			wp.media.attachment( id ).fetch().then(
				function( data ) {
						view.render();
				}
			);
		}
	}

	var link_url;

	if ( 'custom' === settings.link_to ) {
		link_url = settings.link.url;
	}

	if ( 'file' === settings.link_to ) {
		link_url = settings.image.url;
	}

	var image_wrap_shape_class = settings.shape ? ' elementor-image-shape-' + settings.shape : '';

	image_html = '<div class="elementor-image' + image_wrap_shape_class + '">';

	if ( link_url ) {
		image_html += '<a class="image-wrap elementor-clickable" data-elementor-open-lightbox="' + settings.open_lightbox + '" href="' + link_url + '">';
	}else{
		image_html += '<div class="image-wrap">';
	}

	image_html += '<img src="' + image_url + '" />';

	if ( link_url ) {
		image_html += '</a>';
	}else{
		image_html += '</div>';
	}

	image_html += '</div>';
}

var title       = settings.title_title;
var description = settings.title_description;

if ( '' !== settings.link_title.url ) {
	title = '<a href="' + settings.link_title.url + '">' + title + '</a>';
}

if ( '' !== settings.link_description.url ) {
	description = '<a href="' + settings.link_description.url + '">' + description + '</a>';
}

view.addRenderAttribute( 'title_title', 'class', [ 'mobius-elementor-timeline-title', 'elementor-size-' + settings.size_title ] );
view.addRenderAttribute( 'title_description', 'class', [ 'mobius-elementor-timeline-description', 'elementor-size-' + settings.size_description ] );

view.addInlineEditingAttributes( 'title_title' );
view.addInlineEditingAttributes( 'title_description' );

var title_html       = '<' + settings.header_size_title + ' ' + view.getRenderAttributeString( 'title_title' ) + '>' + title + '</' + settings.header_size_title + '>';
var description_html = '<' + settings.header_size_description + ' ' + view.getRenderAttributeString( 'title_description' ) + '>' + description + '</' + settings.header_size_description + '>';

print( '<div class="mobius-studio-timeline-item">' + image_html + '<div class="contents">' + title_html + description_html + '</div></div>' );
