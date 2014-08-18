(function($){

    if(typeof $.browser === 'undefined') {
        jQuery.uaMatch = function( ua ) {
            ua = ua.toLowerCase();

            var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
                /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
                /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
                /(msie) ([\w.]+)/.exec( ua ) ||
                ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
                [];

            return {
                browser: match[ 1 ] || "",
                version: match[ 2 ] || "0"
            };
        };

        matched = jQuery.uaMatch( navigator.userAgent );
        browser = {};

        if ( matched.browser ) {
            browser[ matched.browser ] = true;
            browser.version = matched.version;
        }

        // Chrome is Webkit, but Webkit is also Safari.
        if ( browser.chrome ) {
            browser.webkit = true;
        } else if ( browser.webkit ) {
            browser.safari = true;
        }

        jQuery.browser = browser;

        jQuery.sub = function() {
            function jQuerySub( selector, context ) {
                return new jQuerySub.fn.init( selector, context );
            }
            jQuery.extend( true, jQuerySub, this );
            jQuerySub.superclass = this;
            jQuerySub.fn = jQuerySub.prototype = this();
            jQuerySub.fn.constructor = jQuerySub;
            jQuerySub.sub = this.sub;
            jQuerySub.fn.init = function init( selector, context ) {
                if ( context && context instanceof jQuery && !(context instanceof jQuerySub) ) {
                    context = jQuerySub( context );
                }

                return jQuery.fn.init.call( this, selector, context, rootjQuerySub );
            };
            jQuerySub.fn.init.prototype = jQuerySub.fn;
            var rootjQuerySub = jQuerySub(document);
            return jQuerySub;
        };
    }

})(jQuery);

var YIT_Browser = {

    isTablet : function() {
        var device = jQuery( 'body' ).hasClass( 'responsive' ) || jQuery( 'body' ).hasClass( 'iPad' ) || jQuery( 'body' ).hasClass( 'Blakberrytablet' ) || jQuery( 'body' ).hasClass( 'isAndroidtablet' ) || jQuery( 'body' ).hasClass( 'isPalm' );
        var size   = jQuery( window ).width() <= 1024 && jQuery( window ).width() >= 768;

        return device && size ;
    },

    isPhone : function () {
        var device = jQuery( 'body' ).hasClass( 'responsive' ) || jQuery( 'body' ).hasClass( 'isIphone' ) || jQuery( 'body' ).hasClass( 'isWindowsphone' ) || jQuery( 'body' ).hasClass( 'isAndroid' ) || jQuery( 'body' ).hasClass( 'isBlackberry' );
        var size   = jQuery( window ).width() <= 480 && jQuery( window ).width() >= 320;

        return device && size ;
    },

    isViewportBetween : function( high, low ) {
        if( low == 'undefinied' )
        { low = 0; }

        if( !low )
        { return jQuery( window ).width() < high; }
        else
        { return jQuery( window ).width() < high && jQuery( window ).width() > low; }
    },

    isLowResMonitor: function () {
        return jQuery( window ).width() < 1200;
    },

    isMobile: function() {
        return this.isTablet() || this.isPhone();
    },



    isIE: function() {
        return jQuery.browser.msie;
    },

    isIE8: function() {
        return this.isIE() && jQuery.browser.version == '8.0';
    },

    isIE9: function() {
        return this.isIE() && jQuery.browser.version == '9.0';
    },

    isIE10: function() {
        return this.isIE() && jQuery.browser.version == '10.0';
    }

};



// sticky footer plugin
(function($){
    var footer;

    $.fn.extend({
        stickyFooter: function(options) {
            footer = this;

            positionFooter();

            $(window)
                .on('sticky', positionFooter)
                .scroll(positionFooter)
                .resize(positionFooter);

            function positionFooter() {
                var docHeight = $(document.body).height() - $("#sticky-footer-push").height();

                if(docHeight < $(window).height()){
                    var diff = $(window).height() - docHeight;
                    if (!$("#sticky-footer-push").length > 0) {
                        $(footer).before('<div id="sticky-footer-push"></div>');
                    }

                    if( $('#wpadminbar').length > 0 ) {
                        diff -= 28;
                    }
                    $("#sticky-footer-push").height(diff);
                }
            }
        }
    });
})(jQuery);



//Menu
jQuery(document).ready(function($){
    var show_dropdown = function()
    {
        var options;

        containerWidth = $('#header').width();
        marginRight = $('#nav ul.level-1 > li').css('margin-right');
        submenuWidth = $(this).find('ul.sub-menu').outerWidth();
        offsetMenuRight = $(this).position().left + submenuWidth;
        leftPos = -18;

        if ( offsetMenuRight > containerWidth )
            options = { left:leftPos - ( offsetMenuRight - containerWidth ) };
        else
            options = {};

        $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).css(options).stop(true, true).fadeIn(300);
    }

    var hide_dropdown = function()
    {
        $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).fadeOut(300);
    }

    $('#nav ul > li').hover( show_dropdown, hide_dropdown );

    $('#nav ul > li').each(function(){
        var $this_item = $(this);
        if( $('ul', this).length > 0 ) {
            $(this).children('a').append('<span class="sf-sub-indicator"> &raquo;</span>');

            var add_padding;
            (add_padding = function(){
                $this_item.children('a').css('padding-right', '').css({ paddingRight:parseInt($this_item.children('a').css('padding-right'))+16 });
            })();

            $(window).resize( add_padding );
        }
    });

    $('#nav li:not(.megamenu) ul.sub-menu li, #nav li:not(.megamenu) ul.children li').hover(
        function()
        {
            if ( $(this).closest('.megamenu').length > 0 )
                return;

            var options;

            containerWidth = $('#header').width();
            containerOffsetRight = $('#header').offset().left + containerWidth;
            submenuWidth = $('ul.sub-menu, ul.children', this).parent().width();
            offsetMenuRight = $(this).offset().left + submenuWidth * 2;
            leftPos = -10;

            if ( offsetMenuRight > containerOffsetRight )
                $(this).addClass('left');

            $('ul.sub-menu, ul.children', this).stop(true, true).fadeIn(300);
        },

        function()
        {
            if ( $(this).closest('.megamenu').length > 0 )
                return;

            $('ul.sub-menu, ul.children', this).fadeOut(300);
        }
    );

    /* megamenu check position */
    $('#nav .megamenu').mouseover(function(){

        var main_container_width = $('.container').width();
        var main_container_offset = $('.container').offset();
        var parent = $(this);
        var megamenu = $(this).children('ul.sub-menu');
        var width_megamenu = megamenu.outerWidth();
        var position_megamenu = megamenu.offset();
        var position_parent = parent.position();

        var position_right_megamenu = position_parent.left + width_megamenu;

        // adjust if the right position of megamenu is out of container
        if ( position_right_megamenu > main_container_width ) {
            megamenu.offset( { top:position_megamenu.top, left:main_container_offset.left + ( main_container_width - width_megamenu ) } );
        }
    });

//    if ( $('body').hasClass('isMobile') && ! $('body').hasClass('iphone') && ! $('body').hasClass('ipad') ) {
//        $('.sf-sub-indicator').parent().click(function(){
//            $(this).parent().toggle( show_dropdown, function(){ document.location = $(this).children('a').attr('href') } )
//        });
//    }

    if ( $('body').hasClass('isMobile') && ! $('body').hasClass('iphone') && ! $('body').hasClass('ipad') ) {
        $('.menu-item').click(function( e ){
            e.stopPropagation();
            // Remove Link from item on level 1 for dropdown menu
            $('li.megamenu > a, .dropdown > a, .menu-item-has-children > a' ).attr('href', '#');
            var _submenu = $('.submenu', this);
            if( _submenu.length ) {
                e.preventDefault();
                if( _submenu.is(':hidden') ) { show_dropdown( _submenu ); }
                else { hide_dropdown( _submenu ); }
            }
        });
    }


});
