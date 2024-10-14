/**
 * Get Started button on dashboard notice.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

jQuery(document).ready(function($) {
    var WpAjaxurl       = mtAdminObject.ajax_url;
    var _wpnonce        = mtAdminObject._wpnonce;
    var buttonStatus    = mtAdminObject.buttonStatus;

    /**
     * Popup on click demo import if mysterythemes demo importer plugin is not activated.
     */
    if( buttonStatus === 'disable' ) $( '.news-portal-demo-import' ).addClass( 'disabled' );

    switch( buttonStatus ) {
        case 'activate' :
            $( '.news-portal-get-started' ).on( 'click', function() {
                var _this = $( this );
                news_portal_do_plugin( 'news_portal_activate_plugin', _this );
            });
            $( '.news-portal-activate-demo-import-plugin' ).on( 'click', function() {
                var _this = $( this );
                news_portal_do_plugin( 'news_portal_activate_plugin', _this );
            });
            break;
        case 'install' :
            $( '.news-portal-get-started' ).on( 'click', function() {
                var _this = $( this );
                news_portal_do_plugin( 'news_portal_install_plugin', _this );
            });
            $( '.news-portal-install-demo-import-plugin' ).on( 'click', function() {
                var _this = $( this );
                news_portal_do_plugin( 'news_portal_install_plugin', _this );
            });
            break;
        case 'redirect' :
            $( '.news-portal-get-started' ).on( 'click', function() {
                var _this = $( this );
                location.href = _this.data( 'redirect' );
            });
            break;
    }
    
    news_portal_do_plugin = function ( ajax_action, _this ) {
        $.ajax({
            method : "POST",
            url : WpAjaxurl,
            data : ({
                'action' : ajax_action,
                '_wpnonce' : _wpnonce
            }),
            beforeSend: function() {
                var loadingTxt = _this.data( 'process' );
                _this.addClass( 'updating-message' ).text( loadingTxt );
            },
            success: function( response ) {
                if( response.success ) {
                    var loadedTxt = _this.data( 'done' );
                    _this.removeClass( 'updating-message' ).text( loadedTxt );
                }
                location.href = _this.data( 'redirect' );
            }
        });
    }

    $('.mt-action-btn').click(function(){
        var _this = $(this), actionBtnStatus = _this.data('status'), pluginSlug = _this.data('slug');
        console.log(actionBtnStatus);
        switch(actionBtnStatus){
            case 'install':
                news_portal_do_free_plugin( 'news_portal_install_free_plugin', pluginSlug, _this );
                break;

            case 'active':
                news_portal_do_free_plugin( 'news_portal_activate_free_plugin', pluginSlug, _this );
                break;
        }

    });

    news_portal_do_free_plugin = function ( ajax_action, pluginSlug, _this ) {
        $.ajax({
            method : "POST",
            url : WpAjaxurl,
            data : ({
                'action' : ajax_action,
                'plugin_slug': pluginSlug,
                '_wpnonce' : _wpnonce
            }),
            beforeSend: function() {
                var loadingTxt = _this.data( 'process' );
                _this.addClass( 'updating-message' ).text( loadingTxt );
            },
            success: function( response ) {
                if( response.success ) {
                    var loadedTxt = _this.data( 'done' );
                    _this.removeClass( 'updating-message' ).text( loadedTxt );
                }
                location.href = _this.data( 'redirect' );
            }
        });
    }

});