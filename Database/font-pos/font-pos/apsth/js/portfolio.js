/*----------------------------*/
// This is for the portfolio 3 Filterable Portfolio
/*----------------------------*/
$(document).ready(function(){
      // filter items on button click
        $('.portfolio3 .filterby').on('click', 'a', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
        // init Isotope
        var $grid = $('.portfolio-box').isotope({
            itemSelector: '.filter',
            percentPosition: true,
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.filter',
            }
        });
        //****************************
          // Isotope Load more button
          //****************************
          var initShow = 4; //number of images loaded on init & onclick load more button
          var counter = initShow; //counter for load more button
          var iso = $grid.data('isotope'); // get Isotope instance

          loadMore(initShow); //execute function onload

          function loadMore(toShow) {
            $grid.find(".hidden").removeClass("hidden");

            var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
              return item.element;
            });
            $(hiddenElems).addClass('hidden');
            $grid.isotope('layout');

            //when no more to load, hide show more button
            if (hiddenElems.length == 0) {
              $("#load-more").hide();
            } 
            else {
              $("#load-more").show();
            };

          }

          //append load more button
          $grid.after('<div class="text-center"><a id="load-more" class="btn btn-info btn-md btn-arrow m-t-20" href="javascript:void(0)"> <span>Load More <i class="ti-arrow-right"></i></span></a></div>');

          //when load more button clicked
          $(".portfolio3 #load-more").click(function() {
            if ($('#filters').data('clicked')) {
              //when filter button clicked, set initial value for counter
              counter = initShow;
              j$('#filters').data('clicked', false);
            } else {
              counter = counter;
            };

            counter = counter + initShow;

            loadMore(counter);
          });
    });

/*----------------------------*/
// This is for the portfolio 4 Masonry Filterable Portfolio
/*----------------------------*/
$(document).ready(function(){
      // filter items on button click
        $('.portfolio4 .filterby').on('click', 'a', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
        // init Isotope
        var $grid = $('.portfolio-box4').isotope({
            itemSelector: '.filter',
            percentPosition: true,
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.filter',
            }
        });
        //****************************
          // Isotope Load more button
          //****************************
          var initShow = 6; //number of images loaded on init & onclick load more button
          var counter = initShow; //counter for load more button
          var iso = $grid.data('isotope'); // get Isotope instance

          loadMore(initShow); //execute function onload

          function loadMore(toShow) {
            $grid.find(".hidden").removeClass("hidden");

            var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
              return item.element;
            });
            $(hiddenElems).addClass('hidden');
            $grid.isotope('layout');

            //when no more to load, hide show more button
            if (hiddenElems.length == 0) {
              $("#load-more").hide();
            } 
            else {
              $("#load-more").show();
            };

          }

          //append load more button
          $grid.after('<div class="text-center"><a id="load-more" class="btn btn-info btn-md btn-arrow m-t-20" href="javascript:void(0)"> <span>Load More <i class="ti-arrow-right"></i></span></a></div>');

          //when load more button clicked
          $(".portfolio4 #load-more").click(function() {
            if ($('#filters').data('clicked')) {
              //when filter button clicked, set initial value for counter
              counter = initShow;
              j$('#filters').data('clicked', false);
            } else {
              counter = counter;
            };

            counter = counter + initShow;

            loadMore(counter);
          });
    });

/**--------------------------------**/
// portfolio 5
/**--------------------------------**/
$('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') + '<small>by Jon Doe</small>';
                }
            }
        });
