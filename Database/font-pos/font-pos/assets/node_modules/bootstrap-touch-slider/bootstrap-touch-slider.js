/*Bootstrap Carousel Touch Slider.
 http://bootstrapthemes.co
 
 Credits: Bootstrap, jQuery, TouchSwipe, Animate.css, FontAwesome
 
 */

( function ( $ ) {
    "use strict";

    $.fn.bsTouchSlider = function ( options ) {
        var carousel = $( ".carousel" );
        return this.each( function ( ) {

            function doAnimations( elems ) {
                //Cache the animationend event in a variable
                var animEndEv = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                elems.each( function ( ) {
                    var $this = $( this ),
                        $animationType = $this.data( 'animation' );
                    $this.addClass( $animationType ).one( animEndEv, function ( ) {
                        $this.removeClass( $animationType );
                    } );
                } );
            }

            //Variables on page load
            var $firstAnimatingElems = carousel.find( '.carousel-item:first' ).find( "[data-animation ^= 'animated']" );
            //Initialize carousel
            carousel.carousel( );
            //Animate captions in first slide on page load
            doAnimations( $firstAnimatingElems );
            //Other slides to be animated on carousel slide event
            carousel.on( 'slide.bs.carousel', function ( e ) {
                var $animatingElems = $( e.relatedTarget ).find( "[data-animation ^= 'animated']" );
                doAnimations( $animatingElems );
            } );
           

        } );
    };


} )( jQuery );


