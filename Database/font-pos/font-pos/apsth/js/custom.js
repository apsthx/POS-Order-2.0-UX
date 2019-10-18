/*
Template Name: Wrapkit Ui Kit
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
$(function () {
    "use strict";
    // ============================================================== 
    //This is for preloader
    // ============================================================== 
    $(function () {
        $(".preloader").fadeOut();
    });
    // ============================================================== 
    // For page-wrapper height
    // ============================================================== 
    var set = function () {
        var topOffset = 390;        
        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $(".page-wrapper").css("min-height", (height) + "px");
        }
       
    };
    $(window).ready(set);
    $(window).on("resize", set);

    // ============================================================== 
    //Tooltip
    // ============================================================== 
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    // ============================================================== 
    //Popover
    // ============================================================== 
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    // ============================================================== 
    // For mega menu
    // ============================================================== 
    jQuery(document).on('click', '.mega-dropdown', function (e) {
        e.stopPropagation()
    });
     jQuery(document).on('click', '.navbar-nav > .dropdown', function(e) {
         e.stopPropagation();
    });
    $(".dropdown-submenu").click(function(){
              $(".dropdown-submenu > .dropdown-menu").toggleClass("show");                     
    });
    // ============================================================== 
    // Resize all elements
    // ============================================================== 
    $("body").trigger("resize"); 
    // ============================================================== 
    //Fix header while scroll
    // ============================================================== 
     var wind = $(window);
         wind.on("load", function() {
            var bodyScroll = wind.scrollTop(),
                navbar = $(".topbar");
            if (bodyScroll > 100) {
                navbar.addClass("fixed-header animated slideInDown")
            } else {
                navbar.removeClass("fixed-header animated slideInDown")
            }
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 200) {
                $('.topbar').addClass('fixed-header animated slideInDown');
                $('.bt-top').addClass('visible');
            } else {
                $('.topbar').removeClass('fixed-header animated slideInDown');
                $('.bt-top').removeClass('visible');
            }
        });
    // ============================================================== 
    // Animation initialized
    // ============================================================== 
    AOS.init();
    // ============================================================== 
    // Back to top
    // ============================================================== 
    $('.bt-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
    // ============================================================== 
    // Modal video stop on close
    // ============================================================== 
    $('.modal').on('hidden.bs.modal', function () {
        callPlayer('yt-player', 'stopVideo');
    });
    // ============================================================== 
    // Perfact scrollbar
    // ============================================================== 
    $('.pre-scroll, .h17-main-nav').perfectScrollbar();
    // ============================================================== 
    // This is for the remove target blank from href
    // ============================================================== 
    $('a[target="_blank"]').removeAttr('target');
    
});
