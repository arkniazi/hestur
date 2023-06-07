;(function($) {
    'use strict';

    // PreLoader
    var preLoader = function() {
        if ( $().animsition ) {             
            $('.animsition').animsition({
                inClass: 'fade-in',
                outClass: 'fade-out',
                inDuration: 1500,
                outDuration: 800,
                loading: true,
                loadingParentElement: 'body',
                loadingClass: 'animsition-loading',
                timeout: false,
                timeoutCountdown: 5000,
                onLoadEvent: true,
                browser: [
                    '-webkit-animation-duration',
                    '-moz-animation-duration',
                    'animation-duration'
                    ],
                overlay: false,
                overlayClass: 'animsition-overlay-slide',
                overlayParentElement: 'body',
                transition: function(url){ window.location.href = url; }
            });
        }
    };

    // Menu Search Icon
    var searchIcon = function() {
        var search_wrap = $('.search-style-fullscreen');
        var search_trigger = $('.header-search-trigger');
        var search_field = search_wrap.find('.search-field');

        search_trigger.on('click', function(e) {
            if ( ! search_wrap.hasClass('search-opened') ) {
                search_wrap.addClass('search-opened');
                search_field.show().get(0).focus();

            } else if (search_field.val() == '') {
                if ( search_wrap.hasClass('search-opened') )
                    search_wrap.removeClass('search-opened').find('.search-field').hide();
                else search_field.get(0).focus();

            } else {
                 search_wrap.find('form').get(0).submit();
            }

            $('html').addClass( 'disable-scroll' );
            e.preventDefault();
            return false;
        });

        search_wrap.find('.search-close').on('click', function(e) {
            search_wrap.removeClass('search-opened');
            $('html').removeClass( 'disable-scroll' );
            e.preventDefault();
            return false;
        });
    };

    // Menu Cart Icon
    var cartIcon = function() {
        $( document ).on( 'woocommerce-cart-changed', function( e, data ) {
            if ( parseInt(data.items_count,10) >= 0 ) {
                $('.shopping-cart-items-count')
                    .text( data.items_count )
            }
        } );
    };

    // Mobile Navigation
    var mobileNav = function() {
        var menuType = 'desktop';

        $(window).on('load resize', function() {
            var
            mode = 'desktop',
            wrapMenu = $('.site-header-inner .wrap-inner .append'),
            navExtw = $('.mobi-nav-extra'),
            navExt = $('.mobi-nav-extra').children('.ext').filter(':not(".menu-logo")'),
            navLogo = $('.mobi-nav-extra').children('.menu-logo');

            if ( matchMedia( 'only screen and (max-width: 991px)' ).matches )
                mode = 'mobile';

            if ( mode != menuType ) {
                menuType = mode;

                if ( mode == 'mobile' ) {
                    if ( $('#main-nav').length ) {
                        $('.mobile-button').show();

                        $('#main-nav').attr('id', 'main-nav-mobi')
                            .appendTo('body')
                            .children('.menu').prepend(navLogo).append(navExt)
                                .find('li:has(ul)')
                                .children('ul')
                                    .removeAttr('style')
                                    .hide()
                                    .before('<span class="arrow"></span>');
                    }
                } else {

                    $('.mobile-button').removeClass('hide');
                    $('html').removeClass( 'disable-scroll' );
                    $( '.mobi-overlay' ).removeClass('show');
                    $('.mobile-button').hide();

                    $('#main-nav-mobi').attr('id', 'main-nav')
                        .removeAttr('style')
                        .prependTo(wrapMenu)
                            .find('.ext').appendTo(navExtw)
                        .parent().siblings('#site-header')
                            .find('#main-nav .sub-menu')
                                .removeAttr('style')
                            .prev().remove();
                }
            }
        });

        $('.mobi-overlay').on('click', function() {
            $('.mobile-button').removeClass('hide');
            $(this).removeClass('show');
            $("#main-nav-mobi").animate({ left: "-300px" }, 300, 'easeInOutExpo')
            $('html').removeClass( 'disable-scroll' );
        } );

        $(document).on('click', '.mobile-button', function() {
            $('.mobile-button').addClass('hide');
            $( '.mobi-overlay' ).addClass('show');
            $('html').addClass( 'disable-scroll' );
            $("#main-nav-mobi").animate({ left: "0"}, 300, 'easeInOutExpo')
        })

        $(document).on('click', '#main-nav-mobi .arrow', function() {
            $(this).toggleClass('active').next().stop().slideToggle();
        })
    };

    var fixNav = function() {
        var
        nav = $('#main-nav'),
        wNav = $('.widget_nav_menu'),
        docW = $(window).width(),
        c = $('.site-header-inner'),
        cl = c.offset().left,
        cw = c.width();

        if ( nav )
            nav.find('.sub-menu').each(function() {
            var
            off = $(this).offset(),
            l = off.left,
            w = $(this).width(),
            il = l - cl,
            over = ( il + w >= cw );

            if ( over )
                $(this).addClass('left');
            });

        if ( wNav.length != 0 )
            wNav.find('a:empty')
                .closest('li').remove();
    };

    // One Page
    var onePage = function() {
        $('#menu-one-page li').filter(':first').addClass('current-menu-item');

        $('#menu-one-page li a').on('click',function() {
            var anchor = $(this).attr('href').split('#')[1];

            if ( anchor ) {
                if ( $('#'+anchor).length > 0 ) {
                    var headerHeight = 0;

                    var target = $('#' + anchor).offset().top - headerHeight;

                    $('html,body').animate({scrollTop: target}, 1000, 'easeInOutExpo');
               }
            }
            return false;
        });

        $(window).on("scroll", function() {
            var scrollPos = $(window).scrollTop();

            if ( $('body').hasClass('header-fixed') ) {
                var headerHeight = $('#site-header').height();
                scrollPos = scrollPos + headerHeight;
            }

            $('#menu-one-page .menu-item a').each(function () {
                var link = $(this);
                var block = $( link.attr("href") );

                if ( block.offset().top <= scrollPos 
                    && block.offset().top + block.height() > scrollPos ) {
                    $('#menu-one-page li').removeClass("current-menu-item");
                    link.parent().addClass("current-menu-item");
                } else {
                    link.parent().removeClass("current-menu-item");
                }
            });
        });
    };

    // Responsive Videos
    var responsiveVideos = function() {
        if ( $().fitVids ) {
            $('.sublime-container').fitVids();
        }
    };

    // Header Fixed
    var headerFixed = function() {
        if ( $('body').hasClass('header-fixed') ) {
            var nav = $('#site-header');

            if ( nav.length ) {
                var
                offsetTop = nav.offset().top,
                headerHeight = nav.height(),
                injectSpace = $('<div>', {
                    height: headerHeight
                });
                if ( $('body').hasClass('header-style-1') ) {
                    injectSpace.insertAfter(nav)
                }

                $(window).on('load scroll', function(){
                    if ( $(window).scrollTop() > offsetTop + headerHeight ) {
                        nav.addClass('fixed-hide');
                        injectSpace.show();
                    } else {
                        nav.removeClass('fixed-hide');
                        injectSpace.hide();
                    }

                    if ( $(window).scrollTop() > 500 ) {
                        nav.addClass('fixed-show');
                    } else {
                        nav.removeClass('fixed-show');
                    }
                })
            }
        }     
    };

    // Scroll to Top
    var scrollToTop = function() {
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 800 ) {
                $('#scroll-top').addClass('show');
            } else {
                $('#scroll-top').removeClass('show');
            }
        });

        $('#scroll-top').on('click', function() {
            var rocket = $(this);
            $(this).addClass('flyout');
            setTimeout(function(){ $('html, body').animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo'); }, 250);
        return false;
        });
    };

    // Scroll ID
    var scrollID = function() {
        // Select all links with hashes
        $('a[href*="#"]')
            // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .not('[href*="#tab-"]')
            .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
                && 
                location.hostname == this.hostname
            )   {
                // Figure out element to scroll to
                var target = $(this.hash);
                  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                  // Does a scroll target exist?
                  if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, 'easeInOutExpo', function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                    });
                }
            }
        });
    };

    // Featured Media
    var featuredMedia = function() {
        if ( $().slick ) {
            $('.blog-gallery').slick({
                arrows: false,
                dots: true,
                infinite: true,
                speed: 300,
                fade: true,
                cssEase: 'linear'
            });
        }
    };

    // Related Post
    var relatedPost = function() {
        if ( $().slick ) {
            $('.related-post').slick({
                dots: false,
                arrows: false,
                infinite: false,
                speed: 300,
                slidesToShow: 2,
                slidesToScroll: 2,
                responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
                ]
            });
        }
    };

    // Widget Spacer
    var widgetSpacer = function() {
        $(window).on('load resize', function() {
            var mode = 'desktop';

            if ( matchMedia( 'only screen and (max-width: 991px)' ).matches )
                mode = 'mobile';

            $('.spacer').each(function(){
                if ( mode == 'mobile' ) {
                    $(this).attr('style', 'height:' + $(this).data('mobi') + 'px')
                } else {
                    $(this).attr('style', 'height:' + $(this).data('desktop') + 'px')
                }
            })
        });
    };

    // logoWidget
    var logoWidget = function() {
        var footer = $('#footer'),
            logo = footer.attr('class');

        if ( logo && footer.attr('class') != 'green' ) {
            footer.find( '.'+logo ).show().siblings().hide();

        }
    };

    // Quantity Button
    var quantityButton = function() {
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.plus, .minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    };

    var footerFixed = function(){
        siteFooter();
        function siteFooter() {
            var siteContent = $('.footer-fixed #main-content');
            var siteContentHeight = siteContent.height();
            var siteFooter = $('.footer-fixed .footer-wrap');
            var siteFooterHeight = siteFooter.height();

            $(window).on('load resize', function() {
                if ( matchMedia( 'only screen and (min-width: 1170px)' ).matches ) {
                    siteFooter.css({position: "fixed",
                        "z-index": "1",
                        "width": "100%",
                        "padding-top": "700px",
                        "bottom": "0",});

                    siteContent.css({
                        "margin-bottom" : siteFooterHeight + 0
                    });
                }

                if ( matchMedia( 'only screen and (max-width: 991px)' ).matches ) {
                    siteFooter.css({position: "unset", "padding-top": "0"});

                    siteContent.css({
                        "margin-bottom" : 0,
                    });
                }
            });
        };
    };

    var buttonHover = function() {
        $('.master-button').each(function() {

            $(this).mouseenter(function(e) {
               var parentOffset = $(this).offset(); 
              
               var relX = e.pageX - parentOffset.left;
               var relY = e.pageY - parentOffset.top;
               $(this).find('.hover-effect').css({"left": relX, "top": relY });
            });

            $(this).mouseleave(function(e) {
                 var parentOffset = $(this).offset(); 
                 var relX = e.pageX - parentOffset.left;
                 var relY = e.pageY - parentOffset.top;
                 $(this).find('.hover-effect').css({"left": relX, "top": relY });
            });
        })
    }

    var resizeWindow = function() {
        setTimeout(function(){
            $(window).trigger('resize'); 
        },300)
    }
    
    mobileNav();
    onePage();
    headerFixed();
    scrollToTop();
    widgetSpacer();
    footerFixed();
    // Dom Ready
    $(function() {
        preLoader();
        searchIcon();
        cartIcon();
        fixNav();
        featuredMedia();
        //relatedPost();
        responsiveVideos();
        logoWidget();
        quantityButton(); 
        scrollID();
        buttonHover();
        resizeWindow();
    });
})(jQuery);


