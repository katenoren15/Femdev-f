(function($) {
    "use strict";



    /*==========================================================
    			custom function
    ======================================================================*/
    function xsFunction() {
        var xsContact = $('.xs-contact-form-wraper'),
            xsMap = $('.map-wraper-v2');

        xsMap.css('height', xsContact.outerHeight());
    }

    function email_patern(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $(window).on('load', function() {

        // custom xs function init
        xsFunction();

        setTimeout(() => {
            $('#preloader').fadeOut();
        }, 500);

        /*==========================================================
        		portfolio gird
        ======================================================================*/
        if ($('.xs-portfolio-grid').length > 0) {
            var $portfolioGrid = $('.xs-portfolio-grid'),
                colWidth = function() {
                    var w = $portfolioGrid.width(),
                        columnNum = 1,
                        columnWidth = 0;
                    if (w > 1200) {
                        columnNum = 3;
                    } else if (w > 900) {
                        columnNum = 3;
                    } else if (w > 600) {
                        columnNum = 2;
                    } else if (w > 450) {
                        columnNum = 2;
                    } else if (w > 385) {
                        columnNum = 1;
                    }
                    columnWidth = Math.floor(w / columnNum);
                    $portfolioGrid.find('.xs-portfolio-grid-item').each(function() {
                        var $item = $(this),
                            multiplier_w = $item.attr('class').match(/xs-portfolio-grid-item-w(\d)/),
                            multiplier_h = $item.attr('class').match(/xs-portfolio-grid-item-h(\d)/),
                            width = multiplier_w ? columnWidth * multiplier_w[1] : columnWidth,
                            height = multiplier_h ? columnWidth * multiplier_h[1] * 0.4 - 12 : columnWidth * 0.5;
                        $item.css({
                            width: width,
                            //height: height
                        });
                    });
                    return columnWidth;
                },
                isotope = function() {
                    $portfolioGrid.isotope({
                        resizable: false,
                        itemSelector: '.xs-portfolio-grid-item',
                        masonry: {
                            columnWidth: colWidth(),
                            gutterWidth: 3
                        }
                    });
                };
            isotope();
            $(window).resize(isotope);
        } // End is_exists

    }); // END load Function 

    $(document).ready(function() {

        // custom xs function init
        xsFunction();



        /*==========================================================
        		mega navigation menu init
        ======================================================================*/
        if ($('.xs-menus').length > 0) {
            $('.xs-menus').xs_nav({
                mobileBreakpoint: 992,
            });
        }


        /*==========================================================
        		back to top
        ======================================================================*/
        $(document).on('click', '.xs-back-to-top', function(event) {
            event.preventDefault();
            /* Act on the event */

            $('html, body').animate({
                scrollTop: 0,
            }, 1000);
        });


        /*==========================================================
        		map window opener add class
        ======================================================================*/
        $(document).on('click', '.xs-window-opener', function() {
            // body...
            event.preventDefault();

            var main_wraper = $('.xs-widnow-wraper'),
                active_class = 'active';

            if ($(this).parent().parent().hasClass(active_class)) {
                $(this).parent().parent().removeClass(active_class);
            } else {
                $(this).parent().parent().addClass(active_class);
            }
        });

        /*=====================================================
        		Contact From dynamic
         =====================================================*/

    }); // end ready function

    $(window).on('scroll', function() {

    }); // END Scroll Function 

    $(window).on('resize', function() {
        // custom xs function init
        xsFunction();
    }); // End Resize




})(jQuery);