/**
 * Custom scripts for Radio Image Control
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

wp.customize.controlConstructor['np-radio-image'] = wp.customize.Control.extend({
	ready: function() {
		'use strict';
		var control = this;

		// Change the value
		this.container.on( 'click', 'input', function() {
			control.setting.set( jQuery( this ).val() );
		});
	}
});