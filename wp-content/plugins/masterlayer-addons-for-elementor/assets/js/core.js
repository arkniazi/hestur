// Carousel Box
(function($, window, document, undefined) {
    "use strict";

    var masterCarouselBox = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterCarouselBox.prototype = {
        defaults: {
            contain: !1,
            imagesLoaded: !0,
            arrowShape: "M38.1,47.1L35.2,50l22.6,22.6l2.8-2.8L40.9,50l19.7-19.7l-2.8-2.8L46.5,38.7L38.1,47.1z",
            // M8,12.1l8.7-8.7c0.3-0.3,0.3-0.8,0-1.1c-0.3-0.3-0.8-0.3-1.1,0l-9.2,9.2c-0.3,0.3-0.3,0.8,0,1.1l9.2,9.2c0.3,0.3,0.8,0.3,1.1,0s0.3-0.8,0-1.1L8,12.1z

            percentPosition: !1,
            adaptiveHeight: !1,
            cellAlign: "left",
            groupCells: !0,
            dragThreshold: 20,
            wrapAround: !1,
            autoPlay: !1,
            navArrow: 1,
            filters: !1,
            equalHeightCells: !1,
            randomVerOffset: !1,
            draggable: !0,

            column: 3,
            gap: "30px",
            fullRight: !1,
            prevNextButtons: !1,
            arrowStyle: "arrow-style-1",
            arrowPosition: "middle",
            arrowMiddleOffset: "0px",
            arrowTopOffset: "40px",
            pageDots: !1,
            dotStyle: "dot-style-1",
            dotOffset: "40px",
            filter: !1
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.build();
            this.event();
            return this;
        },
        build: function() {
            var
            t = this,
            css = "",
            cls = "",
            arr = [],
            a = t.args.column,
            b = t.args.gap,
            c = t.args.fullRight,
            d = t.args.prevNextButtons,
            e = t.args.arrowStyle,
            f = t.args.arrowPosition,
            g = t.args.arrowMiddleOffset,
            h = t.args.arrowTopOffset,
            i = t.args.arrowShape,
            j = t.args.pageDots,
            k = t.args.dotStyle,
            l = t.args.dotOffset,
            m = t.args.filter,
            n = t.args.fullRightOpacity,
            o = t.args.cellAlign,
            z = t.$elm.attr("class").split(" ");

            $(z).each(function(i, e) { 
                e.indexOf("mlr-") == 0 && (cls = "." + z[0] + "." + e)
            })

            if (m) {
                var id = "filter-" + (new Date).getTime();
                t.$elm.alterClass("filter-*", id)
                t.filter(id)
            }

            t.$elm.alterClass("column-*", "column-" + a + "-gap-" + b),
            t.$elm.alterClass("gap-*", "gap-" + b),
            t.$elm.alterClass("arrow-style-*", "arrow-style-" + a + "-gap-" + b),
            t.$elm.alterClass("arrow-position-*", "arrow-position-" + f),
            j && t.$elm.alterClass("bullets-*", "bullets-" + l),
            o == "center" && t.$elm.addClass("center-mode"); 

            if ( !t.$elm.find('.flickity-viewport').length ) {
                t.$elm.children().addClass("item-carousel")  
            }
              
            c && (n = n ? "opacity:" + n + ";" : "",
                css += cls + " .item-carousel {" + n + "}",
                css += "@media screen and (max-width: 767px) {" + cls + ".master-project-carousel .item-carousel {" + "opacity:0;" + "}}"),

            css += cls + " .item-carousel.is-selected {" + "opacity:1;" + "}\n",
            css && $("#master-dynamic").length
                ? ((arr = $("#master-dynamic").html().split("\n")),
                  $.each(arr, function(i, e) {
                      e && e.indexOf(cls) > -1 && arr.splice(e, 1)
                  }),
                  $("#master-dynamic").empty().append(arr.join("\n")).append(css))
                : $("head").append("<style type='text/css' id='master-dynamic'>" + css + "</style>")

            t.$elm.waitForImages(function() { 
                t.$elm.flickity(t.args);
                if (c) {
                    var
                    u = t.$elm,
                    v = u.width(),
                    w = t.$elm.find(".flickity-viewport"),
                    x = window.innerWidth - (v + w.offset().left),
                    y = $("<div />").addClass("flickity-aside-wrap");

                    c && w.wrap(y).css("overflow", "visible")
                    .parent().css({"padding-right": x, "margin-right": -x, "overflow": "hidden"})
                }
                
            })  
        },
        filter: function(id) {
            var
            t = this,
            css = "",
            cls = "#" + id,
            arr = [],
            a = t.args.filterAll,
            b = t.args.filterCat,
            c = b.split(","),
            d = t.args.filterAlign,
            e = t.args.filterMargin,
            f = t.args.filterMarginMobi,
            g = t.args.filterMarginSmobi,
            y = $('<div class="master-spacer" data-config=\'{"desktop": "50px", "mobi": "50px", "smobi": "50px"}\'></div>'),
            z = $("<div />").attr("id", id).addClass("carousel-filter");
            
            t.$elm.before(z)
            a && $('<div class="filter-item" data-filter="*">All</div>').appendTo(z)
            for (var i1 = 0; i1 < c.length; i1++) {
                $('<div class="filter-item" data-filter="' + c[i1].replace(" ", "-").toLowerCase() + '">' + c[i1] + '</div>').appendTo(z)
            }

            d && z.alterClass("align-*", "align-" + d)
            e = e ? "margin:" + e + ";" : "",
            f = f ? "margin:" + f + ";" : "",
            g = g ? "margin:" + g + ";" : "",

            f ? css += "@media screen and (max-width: 991px) and (min-width: 768px) {" + cls + " {" + f + "}}" : css += "",
            g ? css += "@media only screen and (max-width: 767px) {" + cls + " {" + g + "}}" : css += "",
            css += cls + " {" + e + "}\n",

            css && $("#master-dynamic").length
                ? ((arr = $("#master-dynamic").html().split("\n")),
                  $.each(arr, function(i, e) {
                      e && e.indexOf(cls) > -1 && arr.splice(e, 1)
                  }),
                  $("#master-dynamic").empty().append(arr.join("\n")).append(css))
                : $("head").append("<style type='text/css' id='master-dynamic'>" + css + "</style>")
        },
        event: function() {
            var 
            t = this;

            // Filter
            $(".carousel-filter .filter-item").on("click", function() {
                var 
                a = $(this).parent().attr("id"),
                b = $(this).data("filter");
                
                if (b !== "*") {
                    var
                    c = $("." + a + " .item-carousel").not("." + b),
                    d = $("." + a + " .item-carousel." + b);
                    c.hide()
                    d.show()
                } else {
                    $("." + a + " .item-carousel").show()
                }

                // Remove other element before destroy
                $("." + a).find(".ctr-edit").remove(),
                t.args.fullRight && t.$elm.find(".flickity-viewport").unwrap()

                t.$elm.flickity("destroy");
                t.$elm.waitForImages(function() {
                    t.$elm.flickity(t.args);
                })
                
                t.$elm.waitForImages(function() { 
                    if (t.args.fullRight) {
                        var
                        u = $(t.elm).data("flickity"),
                        v = u.size.width,
                        w = $(u.viewport),
                        x = window.innerWidth - (v + w.offset().left),
                        y = $("<div />").addClass("flickity-aside-wrap");

                        var z = $("<div />").addClass("flickity-aside-wrap");
                        t.$elm.find(".flickity-viewport").wrap(y).css("overflow", "visible")
                            .parent().css({"padding-right": x, "margin-right": -x, "overflow": "hidden"})
                    }
                })           
            })

            // Position
            var selected = t.$elm.find('.item-carousel.is-selected');
            selected.first().addClass('left');
            selected.last().addClass('right');

            // Selected change
            t.$elm.on( 'select.flickity', function( event, index ) {
                var selected = t.$elm.find('.item-carousel.is-selected'),
                    item = t.$elm.find('.item-carousel');

                item.removeClass('left right');
                selected.first().addClass('left');
                selected.last().addClass('right');                  
            });

            // Center
            if ( t.args.cellAlign == 'center' ) {
                var selected = t.$elm.find('.item-carousel.is-selected'),
                    item = t.$elm.find('.item-carousel');

                // Init
                if ( selected.length > 1 ) {
                    var column = selected.length,
                        centerIndex = selected.index() + Math.floor(column/2);
                    item.removeClass('center');
                    item.eq(centerIndex).addClass('center');
                } else {
                    item.removeClass('center');
                    selected.addClass('center');
                }

                // Selected change
                t.$elm.on( 'select.flickity', function( event, index ) {
                    var selected = t.$elm.find('.item-carousel.is-selected'),
                        item = t.$elm.find('.item-carousel');

                    if ( selected.length > 1 ) {
                        var column = selected.length,
                        centerIndex = selected.index() + Math.floor(column/2);
                        item.removeClass('center');
                        item.eq(centerIndex).addClass('center');
                    } else {
                        $(item).removeClass('center');
                        $(selected).addClass('center');
                    }                    
                });
            }
        }
    };

    masterCarouselBox.defaults = masterCarouselBox.prototype.defaults;

    $.fn.masterCarouselBox = function(opts) {
        return this.each(function() {
            new masterCarouselBox(this, opts).init();
        });
    };
}(jQuery, window, document));

// Project Grid
(function( $, window, document, undefined ) {
    "use strict";

    var masterPortfolio = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config" );
    };

    masterPortfolio.prototype = {
        defaults: {
            filters: ".projects-filter",
            layoutMode: "grid",
            defaultFilter: "*",
            gapHorizontal: 30,
            gapVertical: 30,
            showNavigation: !0,
            showPagination: !0,
            gridAdjustment: "responsive",
            rewindNav: !1,
            auto: !1,
            mediaQueries: [{
                width: 1200,
                cols: 3,
            }, {
                width: 992,
                cols: 2,
            }, {
                width: 768,
                cols: 2,
            }, {
                width: 480,
                cols: 1,
            }],
            columns: "3,2,2,1",
            filterStyle: "filter-style-1",
            filterColor: "light",
            displayType: 'bottomToTop',
            displayTypeSpeed: 300
        },

        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.build();
            return this;
        },
        build: function() {
            var
            t = this,
            css = "",
            cls = "",
            arr = [],
            a = t.config.columns,
            b = t.args.mediaQueries,
            c = t.args.filterStyle,
            d = t.args.filterColor,
            e = t.args.filterMargin,
            z = t.$elm.attr("class").split(" ");


            $(z).each(function(i, e) { 
                e.indexOf("mlr-") == 0 && (cls = "." + z[0] + "." + e)
            }),

            t.$elm.find(".projects-filter").alterClass("filter-style-*", c),
            t.$elm.find(".projects-filter").alterClass("filter-color-*", "filter-color" + d),

            b = a == "1,1,1,1" ? [{"width": 1170, "cols": 1},{"width": 930, "cols": 1},{"width": 650, "cols": 1},{"width": 480, "cols": 1}] : b,
            b = a == "2,2,2,1" ? [{"width": 1170, "cols": 2},{"width": 930, "cols": 2},{"width": 650, "cols": 2},{"width": 480, "cols": 1}] : b,
            b = a == "3,3,2,1" ? [{"width": 1170, "cols": 3},{"width": 930, "cols": 3},{"width": 650, "cols": 2},{"width": 480, "cols": 1}] : b,
            b = a == "4,3,2,1" ? [{"width": 1170, "cols": 4},{"width": 930, "cols": 3},{"width": 650, "cols": 2},{"width": 480, "cols": 1}] : b,
            t.args.mediaQueries = b;

            if ( t.args.layoutMode == 'mosaic' && matchMedia( 'only screen and (max-width: 1300px)' ).matches ) {
                t.args.gridAdjustment = 'responsive';
                t.args.sortToPreventGaps = true;
            }
            t.$elm.waitForImages( function() {
                t.$elm.find('.galleries').cubeportfolio( t.args ); 
            } );

            e = e ? "margin:" + e + " !important;" : "",

            css += cls + " .projects-filter {" + e + "}\n",
            css && $("#master-dynamic").length
                ? ((arr = $("#master-dynamic").html().split("\n")),
                  $.each(arr, function(i, e) {
                      e && e.indexOf(cls) > -1 && arr.splice(e, 1)
                  }),
                  $("#master-dynamic").empty().append(arr.join("\n")).append(css))
                : $("head").append("<style type='text/css' id='master-dynamic'>" + css + "</style>")
        },
    };

    masterPortfolio.defaults = masterPortfolio.prototype.defaults;

    $.fn.masterPortfolio = function(opts) {
        return this.each(function() {
            new masterPortfolio(this, opts).init();
        });


    };
}(jQuery, window, document));

// Slick Slider
(function( $, window, document, undefined ) {
    'use strict';

    var masterSlick = function( elm, opts ) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config" );
    };

    masterSlick.prototype = {
        defaults: {
        },

        init: function() {
            $('.master-testimonial-slider').each(function () {
                var slickNav = $(this).find('.slick-slider-nav'),
                    slickContent = $(this).find('.slick-content-item');

                if ( slickContent.length ) {        
                    var navItem = slickContent.find('.slick-nav-item').remove();
                    navItem.appendTo(slickNav);
                }

            });

            var $containers = $('.master-testimonial-slider .slick-container');

            if (!$containers.length) return;

            var defaults = {
                speed: 700,
                infinite: true,
                focusOnSelect: true,
            };

            $containers.each(function() {
                var $container = $(this);
                var $sliders = $container.find('.slick-slider, .slick-slider-nav');

                $sliders.each(function() {
                    var $slider = $(this);
                    var options = $slider.data('slick');
                    if (options === undefined || options === null) options = {};
                    options = $.extend({}, defaults, options);
                    if ($slider.data('navTarget') !== undefined && $slider.data('navTarget').length) {
                        options.asNavFor = $($slider.data('navTarget'));
                    }
                    var instance = $slider.slick(options);

                    // Adding slider instance to object
                    if (this.unifato === undefined) this.unifato = {};
                    this.unifato.slick = {};
                    this.unifato.slick.instance = instance;
                });
            });
        },
    };

    $.fn.masterSlick = function( opts ) {
        return this.each( function() {
            new masterSlick( this, opts ).init();
        } );
    };
}( jQuery, window, document ));

(function( $, window, document, undefined ) {
    'use strict';

    var masterSlick2 = function( elm, opts ) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config" );
    };

    masterSlick2.prototype = {
        defaults: {
        },

        init: function() {
            var t = this;
            var $containers = $('.master-team-slider .slick-container');
            if (!$containers.length) return;
            var defaults = {
                speed: 700,
                infinite: true,
                focusOnSelect: true,
            };

            t.$elm.waitForImages(function() {
                $containers.each(function() {
                    var $container = $(this);
                    var $sliders = $container.find('.slick-slider, .slick-slider-nav');

                    $sliders.each(function() {
                        var $slider = $(this);
                        var options = $slider.data('slick');
                        if (options === undefined || options === null) options = {};
                        options = $.extend({}, defaults, options);
                        if ($slider.data('navTarget') !== undefined && $slider.data('navTarget').length) {
                            options.asNavFor = $($slider.data('navTarget'));
                        }
                        var instance = $slider.slick(options);

                        // Adding slider instance to object

                        if (this.unifato === undefined) this.unifato = {};
                        this.unifato.slick = {};
                        this.unifato.slick.instance = instance;
                    });
                });
            })
            
        },
    };

    $.fn.masterSlick2 = function( opts ) {
        return this.each( function() {
            new masterSlick2( this, opts ).init();
        } );
    };
}( jQuery, window, document ));

(function($, window, document, undefined) {
    "use strict";

    var masterFancyImage = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterFancyImage.prototype = {
        defaults: {
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.detect();
            this.initIO();
            return this;
        },
        initIO: function e() {
            var t = this;
            new IntersectionObserver(
                function e(i, n) {
                    i.forEach(function (e) {
                        e.isIntersecting && (t.build(), n.unobserve(e.target));
                    });
                },
                { threshold: 0.35 }
            ).observe(t.elm);
        },
        detect: function() {
            var t = this;

            t.$elm.waitForImages(function() {
                var a = $(window).width(),
                    b = t.$elm.width(),
                    c = t.$elm.offset().left, d;
                
                t.$elm.is(".stretch-right")
                && (d = a - (b + c), t.$elm.css("marginRight", -d + "px")),
                t.$elm.is(".stretch-left")
                && (d = c, t.$elm.css("marginLeft", -d + "px")),
                t.$elm.is(".stretch-custom") 
                && t.$elm.offset().left <= 0 
                && t.$elm.css("marginLeft", 0);            
            });
        },
        build: function() {
            this.$elm.addClass("is-in-view");
        }
    };

    masterFancyImage.defaults = masterFancyImage.prototype.defaults;

    $.fn.masterFancyImage = function(opts) {
        return this.each(function() {
            new masterFancyImage(this, opts).init();
        });
    };
}(jQuery, window, document));
