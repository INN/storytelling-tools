( function( blocks, element ) {
	var el = element.createElement,
		query = blocks.query;

	function RandomImage( props ) {
		var src = 'http://lorempixel.com/400/200/' + props.category;

		return el( 'img', {
			src: src,
			alt: props.category
		} );
	}

	blocks.registerBlockType( 'myplugin/random-image', {
		title: 'Random Image',

		icon: 'format-image',

		category: 'embed',

		attributes: {
			category: query.attr( 'img', 'alt' )
		},

		edit: function( props ) {
			var category = props.attributes.category,
				children;

			function setCategory( event ) {
				var selected = event.target.querySelector( 'option:checked' );
				props.setAttributes( { category: selected.value } );
				event.preventDefault();
			}

			children = [];
			if ( category ) {
				children.push( RandomImage( { category: category } ) );
			}

			children.push(
				el( 'select', { value: category, onChange: setCategory },
					el( 'option', null, '- Select -' ),
					el( 'option', { value: 'sports' }, 'Sports' ),
					el( 'option', { value: 'animals' }, 'Animals' ),
					el( 'option', { value: 'nature' }, 'Nature' )
				)
			);

			return el( 'form', { onSubmit: setCategory }, children );
		},

		save: function( props ) {
			return RandomImage( { category: props.attributes.category } );
		}
	} );
} )(
	window.wp.blocks,
	window.wp.element
);
