/*global jQuery, document, window */
(function($) {

/**
 * Responsive iframes
 */
function adjustIframes() {
	$('iframe').each(function() {
		var $this   = $(this),
		proportion  = $this.data('proportion'),
		actual_w    = $this.width();

		if ( $this.attr('width') === '' ) {
			$this.attr('width', 480);
			$this.attr('height', 385);
		}

		var iframe_w = $this.attr('width');

		if ( ! proportion ) {
			proportion = $this.attr('height') / iframe_w;
			$this.data( 'proportion', proportion );
		}

		if ( actual_w != iframe_w ) {
			$this.css( 'height', Math.round( actual_w * proportion ) + 'px' );
		}
	});
}
$(window).on('resize load', adjustIframes);

})(jQuery);